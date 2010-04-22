<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * @package    qubit
 * @subpackage actor
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    $Id$
 */
class QubitActor extends BaseActor
{
  const ROOT_ID = 3;

  public function __toString()
  {
    $authorizedFormOfName = $this->getAuthorizedFormOfName();
    if (empty($authorizedFormOfName))
    {
      $authorizedFormOfName = $this->getAuthorizedFormOfName(array('sourceCulture' => true));
    }

    return (string) $authorizedFormOfName;
  }

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    switch ($name)
    {
      case 'language':
      case 'script':
        if (!isset($this->values[$name]))
        {
          $criteria = new Criteria;
          $this->addPropertysCriteria($criteria);
          $criteria->add(QubitProperty::NAME, $name);

          if (1 == count($query = QubitProperty::get($criteria)))
          {
            $this->values[$name] = $query[0];
          }
        }

        if (isset($this->values[$name]))
        {
          return unserialize($this->values[$name]->__get('value', $options + array('sourceCulture' => true)));
        }

        return;
    }

    return call_user_func_array(array($this, 'BaseActor::__get'), $args);
  }

  public function __set($name, $value)
  {
    $args = func_get_args();

    $options = array();
    if (2 < count($args))
    {
      $options = $args[2];
    }

    switch ($name)
    {
      case 'language':
      case 'script':

        if (!isset($this->values[$name]))
        {
          $criteria = new Criteria;
          $this->addPropertysCriteria($criteria);
          $criteria->add(QubitProperty::NAME, $name);

          if (1 == count($query = QubitProperty::get($criteria)))
          {
            $this->values[$name] = $query[0];
          }
          else
          {
            $this->values[$name] = new QubitProperty;
            $this->values[$name]->name = $name;
            $this->propertys[] = $this->values[$name];
          }
        }

        $this->values[$name]->__set('value', serialize($value), $options + array('sourceCulture' => true));

        return $this;
    }

    return call_user_func_array(array($this, 'BaseActor::__set'), $args);
  }

  public function updateLuceneIndex()
  {
    // Don't index root object
    if (self::ROOT_ID == $this->id)
    {
      return;
    }

    $search = new QubitSearch;
    $query = new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($this->id, 'id'));

    foreach ($search->getEngine()->getIndex()->find($query) as $hit)
    {
      $search->getEngine()->getIndex()->delete($hit->id);
    }

    foreach ($this->actorI18ns as $actorI18n)
    {
      $doc = new Zend_Search_Lucene_Document;

      $doc->addField(Zend_Search_Lucene_Field::Keyword('id', $this->id));
      $doc->addField(Zend_Search_Lucene_Field::Keyword('className', $this->className));

      $doc->addField(Zend_Search_Lucene_Field::Keyword('culture', $actorI18n->culture));

      if (isset($actorI18n->authorizedFormOfName))
      {
        $doc->addField(Zend_Search_Lucene_Field::UnStored('authorizedFormOfName', $actorI18n->authorizedFormOfName));
      }

      $search->getEngine()->getIndex()->addDocument($doc);
    }

    $search->getEngine()->getIndex()->commit();
  }

  public function save($connection = null)
  {
    // Make sure all orphan actors are parented to ROOT
    if ((!isset($this->id) || QubitActor::ROOT_ID != $this->id) && !isset($this->parentId))
    {
      $this->parentId = QubitActor::ROOT_ID;
    }

    parent::save($connection);

    // Save related event objects
    foreach ($this->events as $event)
    {
      // Update search index for related info object
      $event->setIndexOnSave(true);
      $event->actor = $this;

      try
      {
        $event->save();
      }
      catch (PropelException $e)
      {
      }
    }

    $this->updateLuceneIndex();

    return $this;
  }

  public function delete($connection = null)
  {
    $search = new QubitSearch;
    $query = new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($this->id, 'id'));

    foreach ($search->getEngine()->getIndex()->find($query) as $hit)
    {
      $search->getEngine()->getIndex()->delete($hit->id);
    }

    return parent::delete($connection);
  }

  public static function getRoot()
  {
    return self::getById(self::ROOT_ID);
  }

  public static function getAllExceptUsers($options = array())
  {
    //returns all Actor objects except those that are
    //also an instance of the User class
    $criteria = new Criteria;
    $criteria->add(QubitObject::CLASS_NAME, 'QubitActor');

    // sort by name
    $criteria->addAscendingOrderByColumn('authorized_form_of_name');

    // Do fallback
    $context = sfContext::getInstance();
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitActor', $options);

    return QubitActor::get($criteria);
  }

  /**
   * Return an options_for_select array
   *
   * @param mixed $default current selected value for select list
   * @param array $options optional parameters
   * @return array options_for_select compatible array
   */
  public static function getOptionsForSelectList($default, $options = array())
  {
    $actors = self::getAllExceptUsers($options);

    foreach ($actors as $actor)
    {
      // Don't display actors with no name
      if ($name = $actor->getAuthorizedFormOfName($options))
      {
        $selectOptions[$actor->getId()] = $name;
      }
    }

    return options_for_select($selectOptions, $default, $options);
  }

  /**
   * Append criteria to get only Actor objects that are NOT
   * a users or repository.
   *
   * @param Criteria $criteria current search criteria
   * @return Criteria modified criteria object
   */
  public static function addGetOnlyActorsCriteria($criteria)
  {
    $criteria->addJoin(QubitActor::ID, QubitObject::ID);
    $criteria->add(QubitObject::CLASS_NAME, 'QubitActor');

    return $criteria;
  }

  /**
   * Returns only Actor objects, excluding those
   * that are an instance of the User or Repository class
   *
   * @return QubitQuery array of QubitActor objects
   */
  public static function getOnlyActors($criteria=null, $options=array())
  {
    if (is_null($criteria))
    {
      $criteria = new Criteria;
    }

    $criteria = QubitActor::addGetOnlyActorsCriteria($criteria);

    return self::get($criteria);
  }

  public static function getAllNames()
  {
    $actors = self::getOnlyActors();
    $allActorNames = array();
    foreach ($actors as $actor)
    {
      $actorId = $actor->getId();
      $allActorNames[] = array('actorId' => $actorId, 'nameId' => null, 'name' => $actor->getAuthorizedFormOfName());
      $actorNames = array();
      $actorNames = $actor->getOtherNames();
      foreach ($actorNames as $name)
      {
        $allActorNames[] = array('actorId' => $actorId, 'nameId' => $name->getId(), 'name' => $name.' ('.$name->getType().')');
      }
    }

    return $allActorNames;
  }

  /**
   * Add a related property to this actor.
   *
   * @param string $name  name of property
   * @param string $value value of property
   * @param string $options array of optional parameters
   * @return QubitActor this object
   */
  public function addProperty($name, $value, $options = array())
  {
    $property = QubitProperty::addUnique($this->getId(), $name, $value, $options);

    return $this;
  }

  public function getProperties($name = null, $scope = null)
  {
    $criteria = new Criteria;
    $criteria->add(QubitProperty::OBJECT_ID, $this->getId());
    if ($name)
    {
      $criteria->add(QubitProperty::NAME, $name);
    }
    if ($scope)
    {
      $criteria->add(QubitProperty::SCOPE, $scope);
    }

    return QubitProperty::get($criteria);
  }

  public function getActorNotes()
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    $criteria->add(QubitNote::SCOPE, 'QubitActor');
    QubitNote::addOrderByPreorder($criteria);

    return QubitNote::get($criteria);
  }

  public function getContactInformation()
  {
    $criteria = new Criteria;
    $criteria->add(QubitContactInformation::ACTOR_ID, $this->getId());
    $criteria->addDescendingOrderByColumn(QubitContactInformation::PRIMARY_CONTACT);
    $contactInformation = QubitContactInformation::get($criteria);

    return $contactInformation;
  }

  public function getPrimaryContact()
  {
    $criteria = new Criteria;
    $criteria->add(QubitContactInformation::ACTOR_ID, $this->getId());
    $criteria->add(QubitContactInformation::PRIMARY_CONTACT, true);
    $primaryContact = QubitContactInformation::getOne($criteria);

    if ($primaryContact)
    {
      return $primaryContact;
    }
    else
    {
      $criteria = new Criteria;
      $criteria->add(QubitContactInformation::ACTOR_ID, $this->getId());

      return QubitContactInformation::getOne($criteria);
    }
  }

  protected $SubjectHitCount = null;

  public function setSubjectHitCount($count)
  {
    $this->SubjectHitCount = $count;
  }

  public function getSubjectHitCount()
  {
    return $this->SubjectHitCount;
  }


  //many-to-many Term Relations
  public function setTermRelation($termId, $relationNote = null)
  {
    $newTermRelation = new QubitObjectTermRelation;
    $newTermRelation->setTermId($termId);

    //TODO: move to QubitNote
    //  $newTermRelation->setRelationNote($relationNote);
    $newTermRelation->setObjectId($this->getId());
    $newTermRelation->save();
  }

  public function getTermRelations($taxonomyId = 'all')
  {
    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->getId());

    if ($taxonomyId != 'all')
    {
      $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTERM::ID);
      $criteria->add(QubitTerm::TAXONOMY_ID, $taxonomyId);
    }

    return QubitObjectTermRelation::get($criteria);
  }

  public function getDatesOfChanges()
  {
    //TO DO

    return null;
  }

  /**
   * Get actor-to-actor relations linked to this actor
   *
   * @return QubitQuery collection of QubitRelation objects
   */
  public function getActorRelations()
  {
    $criteria = new Criteria;

    $criteria->addJoin(QubitRelation::TYPE_ID, QubitTerm::ID, Criteria::INNER_JOIN);

    $criterion1 = $criteria->getNewCriterion(QubitRelation::OBJECT_ID, $this->getId(), Criteria::EQUAL);
    $criterion2 = $criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $this->getId(), Criteria::EQUAL);
    $criterion3 = $criteria->getNewCriterion(QubitTerm::TAXONOMY_ID, QubitTaxonomy::ACTOR_RELATION_TYPE_ID, Criteria::EQUAL);
    $criterion1->addOr($criterion2);
    $criterion1->addAnd($criterion3);
    $criteria->add($criterion1);
    $criteria->addAscendingOrderByColumn(QubitRelation::TYPE_ID);
    $criteria->addDescendingOrderByColumn(QubitRelation::START_DATE);

    return QubitRelation::get($criteria);
  }

  public function getInformationObjectRelations()
  {
    $criteria = new Criteria;
    $criteria->add(QubitEvent::ACTOR_ID, $this->getId());
    $criteria->addJoin(QubitEvent::INFORMATION_OBJECT_ID, QubitInformationObject::ID);
    $criteria->addAscendingOrderByColumn(QubitEvent::TYPE_ID);

    // Sort info objects alphabetically (w/ fallback)
    $criteria->addAscendingOrderByColumn('title');
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitInformationObject');

    return QubitEvent::get($criteria);
  }

  /**
   * Add search criteria for find records updated in last $numberOfDays
   *
   * @param Criteria $criteria current search criteria
   * @param string $cutoff earliest date to show
   * @return Criteria modified criteria object
   */
  public static function addRecentUpdatesCriteria($criteria, $cutoff)
  {
    $criteria->add(QubitActor::UPDATED_AT, $cutoff, Criteria::GREATER_EQUAL);

    return $criteria;
  }

  /**
   * Search for an actor by the AUTHORIZED_FORM_OF_NAME i18n column. Optionally
   * limit search to a specific culture.
   *
   * @param string $name search string
   * @param array $options optional parameters
   * @return QubitActor found actor
   */
  public static function getByAuthorizedFormOfName($name, $options = array())
  {
    $criteria = new Criteria();
    $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID, Criteria::INNER_JOIN);
    $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $name, Criteria::EQUAL);

    if (isset($options['culture']))
    {
      $criteria->addAnd(QubitActorI18n::CULTURE, $options['culture'], Criteria::EQUAL);
    }

    return QubitActor::getOne($criteria, $options);
  }

  public function getLabel()
  {
    $label = null;
    if (null !== $this->descriptionIdentifier)
    {
      $label .= $this->descriptionIdentifier;
    }
    if (null !== $value = $this->getAuthorizedFormOfName(array('cultureFallback' => true)))
    {
      $label = (0 < strlen($label)) ? $label.' - '.$value : $value;
    }

    return $label;
  }
}
