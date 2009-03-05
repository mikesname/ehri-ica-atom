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
  public function __toString()
  {
    $authorizedFormOfName = $this->getAuthorizedFormOfName();
    if (empty($authorizedFormOfName))
    {
      $authorizedFormOfName = $this->getAuthorizedFormOfName(array('sourceCulture' => true));
    }

    return (string) $authorizedFormOfName;
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
    $culture = $context->getUser()->getCulture();
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitActor', $culture, $options);

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
   * Get a paginated hitlist of actors
   *
   * @param string   $culture primary language for list
   * @param Criteria $criteria Propel Criteria object
   * @param array    $options array of optional function parameters
   * @return QubitQuery collection of QubitInformationObject objects
   */
  public static function getList($culture, $options=array())
  {
    $criteria = new Criteria;

    $cultureFallback = (isset($options['cultureFallback'])) ? $options['cultureFallback'] : false;
    $sort = (isset($options['sort'])) ? $options['sort'] : null;
    $page = (isset($options['page'])) ? $options['page'] : 1;

    if (isset($options['repositoryId']))
    {
      $criteria->add(QubitInformationObject::REPOSITORY_ID, $options['repositoryId']);
    }

    if (isset($options['collectionType']))
    {
      $criteria->add(QubitInformationObject::COLLECTION_TYPE_ID, $options['collectionType']);
    }

    // Add criteria to exclude actors that are users or repository objects
    $criteria = QubitActor::addGetOnlyActorsCriteria($criteria);

    // Add sort criteria
    switch($sort)
    {
      case 'typeDown':
        $fallbackTable = 'QubitTerm';
        $criteria->addJoin(QubitActor::ENTITY_TYPE_ID, QubitTerm::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('name');
        break;
      case 'typeUp':
        $fallbackTable = 'QubitTerm';
        $criteria->addJoin(QubitActor::ENTITY_TYPE_ID, QubitTerm::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('name');
        break;
      case 'nameDown':
        $fallbackTable = 'QubitActor';
        $criteria->addDescendingOrderByColumn('authorized_form_of_name');
        break;
      case 'nameUp':
      default:
        $fallbackTable = 'QubitActor';
        $criteria->addAscendingOrderByColumn('authorized_form_of_name');
    }

    // Do source culture fallback
    if ($cultureFallback === true)
    {
      // Return a QubitQuery object
      $options = array('returnClass'=>'QubitActor');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $fallbackTable, $culture, $options);
    }
    else
    {
      // Do straight joins without fallback
      $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID);
      $criteria->addJoin(QubitActor::ENTITY_TYPE_ID, QubitTermI18n::ID, Criteria::LEFT_JOIN);
      $criteria->add(QubitActorI18n::CULTURE, $culture);
      $criteria->add(QubitTermI18n::CULTURE, $culture);
    }

    // Page results
    $pager = new QubitPager('QubitActor');
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();

    return $pager;
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

  public static function getAccessPointSelectList()
  {
    $actors = self::getAllExceptUsers();
    $selectList = array();
    if (count($actors) > 0)
    {
      foreach ($actors as $actor)
      {
        $actorName = $actor->getAuthorizedFormOfName(array('cultureFallback'=>true));
        //use 'Family name, first name' format if available
        /*
        if ($actor->getEntityTypeId() == QubitTerm::PERSON_ID)
        {
        foreach ($actor->getOtherNames() as $name)
        {
        if ($name->getTypeId() == QubitTerm::FAMILY_NAME_FIRST_NAME_ID)
        {
        $actorName = $name;
        break;
        }
        }
        }
        */
        $selectList[$actor->getId()] = $actorName;
      }
    }

    return $selectList;
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

  public function getOtherNames()
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitActorName::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitActorName::ACTOR_ID, $this->getId());

    return QubitActorName::get($criteria);
  }

  public function setOtherNames($otherName, $nameTypeId, $nameNote)
  {
    $newName = new QubitActorName;
    $newName->setActorId($this->getId());
    $newName->setName($otherName);
    $newName->setTypeId($nameTypeId);
    $newName->setNote($nameNote);
    $newName->save();
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

  public function setActorNote($userId, $note, $noteTypeId)
  {
    $newNote = new QubitNote;
    $newNote->setObjectId($this->getId());
    $newNote->setScope('QubitActor');
    $newNote->setUserId($userId);
    $newNote->setContent($note);
    $newNote->setTypeId($noteTypeId);
    $newNote->save();
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

  public function getRelatedActors()
  {
    //TO DO

    return null;
  }

  public function getInformationObjectRelations()
  {
    $criteria = new Criteria;
    $criteria->add(QubitEvent::ACTOR_ID, $this->getId());
    $criteria->addJoin(QubitEvent::INFORMATION_OBJECT_ID, QubitInformationObject::ID);
    $criteria->addAscendingOrderByColumn(QubitEvent::TYPE_ID);

    return QubitEvent::get($criteria);
  }
}
