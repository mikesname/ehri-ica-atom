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
 * Extended methods for Information object model
 *
 * @package qubit
 * @subpackage model
 * @author Jack Bates <jack@artefactual.com>
 * @author Peter Van Garderen <peter@artefactual.com>
 * @author David Juhasz <david@artefactual.com>
 * @author Mathieu Fortin Library and Archives Canada <mathieu.fortin@lac-bac.gc.ca>
 * @version svn: $Id$
 */
class QubitInformationObject extends BaseInformationObject
{
  const ROOT_ID = 1;

  /**
   * When cast as a string, return  i18n-ized object title with fallback to
   * source culture
   *
   * @return string title value with fallback to source culture
   */
  public function __toString()
  {
    if (null === $title = $this->getTitle())
    {
      $title = $this->getTitle(array('sourceCulture' => true));
    }

    return (string) $title;
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
      case 'languageOfDescription':
      case 'script':
      case 'scriptOfDescription':

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

    return call_user_func_array(array($this, 'BaseInformationObject::__get'), $args);
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
      case 'languageOfDescription':
      case 'script':
      case 'scriptOfDescription':

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

    return call_user_func_array(array($this, 'BaseInformationObject::__set'), $args);
  }

  public function save($connection = null)
  {
    parent::save($connection);

    // Save related information objects
    foreach ($this->informationObjectsRelatedByparentId as $child)
    {
      $child->setIndexOnSave(false);
      $child->setParentId($this->id);

      try
      {
        $child->save();
      }
      catch (PropelExceptino $e)
      {
      }
    }

    // Save updated related event objects (update search index after updating
    // all related objects that are included in the index document)
    foreach ($this->events as $event)
    {
      $event->setIndexOnSave(false);
      $event->informationObject = $this;

      try
      {
        $event->save();
      }
      catch (PropelException $e)
      {
      }
    }

    // Save updated properties
    foreach ($this->propertys as $property)
    {
      $property->setIndexOnSave(false);
      $property->object = $this;

      try
      {
        $property->save();
      }
      catch (PropelException $e)
      {
      }
    }

    // Save new digital objects
    // TODO: Allow adding additional DOs as derivatives
    foreach ($this->digitalObjects as $digitalObject)
    {
      $digitalObject->indexOnSave = false;
      $digitalObject->informationObject = $this;

      try
      {
        $digitalObject->save();
      }
      catch (PropelException $e)
      {
      }

      break; // only save one digital object per info object
    }

    // Save updated Status
    foreach ($this->statuss as $status)
    {
      $status->setIndexOnSave(false);
      $status->setObject($this);
      $status->save();
    }

    SearchIndex::updateTranslatedLanguages($this);

    return $this;
  }

  public static function getRoot()
  {
    return self::getById(self::ROOT_ID);
  }

  /**
   * Additional actions to take on delete
   *
   */
  public function delete($connection = null)
  {
    $this->deletePhysicalObjectRelations();

    // Delete name access point relations
    $criteria = new Criteria;
    $criteria = $this->addrelationsRelatedBysubjectIdCriteria($criteria);
    $criteria->add(QubitRelation::TYPE_ID, QubitTerm::NAME_ACCESS_POINT_ID);

    if ($nameAccessPointRelations = QubitRelation::get($criteria))
    {
      foreach ($nameAccessPointRelations as $nameAccessPointRelation)
      {
        $nameAccessPointRelation->delete();
      }
    }

    parent::delete($connection);

    SearchIndex::deleteTranslatedLanguages($this);
  }

  public function getLabel(array $options = array())
  {
    sfLoader::loadHelpers('Text');

    $label = $this->getLevelOfDescription();

    if ($this->getIdentifier())
    {
      $label .= ' '.$this->getIdentifier();
    }

    if ($label)
    {
      $label .= ' - ';
    }

    if (strlen($title = $this->getTitle()) < 1)
    {
      $title = $this->getTitle(array('sourceCulture' => true));
    }

    $label .= $title;

    if (isset($options['truncate']))
    {
      $label = truncate_text($label, $options['truncate']);
    }

    $publicationStatus = $this->getPublicationStatus();
    if ($publicationStatus->statusId == QubitTerm::PUBLICATION_STATUS_DRAFT_ID)
    {
      $label .= ' ('.$publicationStatus->status.')';
    }

    //TODO: will return an array, only display first one?
    /*
    if ($informationObject->getDates($eventType = 'creation'))
    {
    $label .= ' ['.$informationObject->getDates($eventType = 'creation').']';
    }
    */

    return $label;
  }

  /**
   * Get a paginated hitlist information objects
   *
   * @param string   $culture primary language for list
   * @param Criteria $criteria Propel Criteria object
   * @param array    $options array of optional function parameters
   * @return QubitQuery collection of QubitInformationObject objects
   */
  public static function getList($options = array())
  {
    $criteria = new Criteria;

    // Only get the top-level info object (collections and orphans)
    if (isset($options['parentId']))
    {
      $criteria->add(QubitInformationObject::PARENT_ID, $options['parentId'], Criteria::EQUAL);
    }

    if (isset($options['culture']))
    {
      $culture = $options['culture'];
    }
    else
    {
      $culture = sfContext::getInstance()->getUser()->getCulture();
    }

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

    // Sort results
    switch($sort)
    {
      case 'titleDown':
        $fallbackTable = 'QubitInformationObject';
        $criteria->addDescendingOrderByColumn('title');
        break;
      case 'repositoryUp':
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('authorized_form_of_name');
        break;
      case 'repositoryDown':
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('authorized_form_of_name');
        break;
      case 'titleUp':
      default:
        $fallbackTable = 'QubitInformationObject';
        $criteria->addAscendingOrderByColumn('title');
    }

    // Do source culture fallback
    if ($cultureFallback === true)
    {
      // Return a QubitQuery object of class-type QubitInformationObject
      $options = array('returnClass'=>'QubitInformationObject');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $fallbackTable, $options);
    }
    else
    {
      // Do straight joins without fallback
      $criteria->addJoin(QubitInformationObject::ID, QubitInformationObjectI18n::ID);
      $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitActorI18n::ID, Criteria::LEFT_JOIN);
      $criteria->add(QubitInformationObjectI18n::CULTURE, $culture);
    }

    // Page results
    $pager = new QubitPager('QubitInformationObject');
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  /**
   * Get all information objects updated between two dates
   * @date from, the inferior limit date
   * @date util, the superior limit date
   * @return QubitQuery collection of QubitInformationObjects
   */
  public static function getUpdatedRecords($from = '', $until = '', $set = '')
  {
    $criteria = new Criteria;

    $criteria->addJoin(QubitInformationObject::ID, QubitObject::ID);
    if ($from != '')
    {
      $criteria->add(QubitObject::UPDATED_AT, $from, Criteria::GREATER_EQUAL);
    }

    if ($until != '')
    {
      $criteria->add(QubitObject::UPDATED_AT, $until, Criteria::LESS_EQUAL);
    }
    if ($set != '')
    {
      $criteria->add(QubitInformationObject::LFT, $set['lft'], Criteria::GREATER_EQUAL);
      $criteria->add(QubitInformationObject::RGT, $set['rgt'], Criteria::LESS_EQUAL);
    }
    $criteria->add(QubitInformationObject::PARENT_ID, null, Criteria::ISNOTNULL);
    $criteria->addAscendingOrderByColumn(QubitObject::UPDATED_AT);
    return QubitInformationObject::get($criteria);
  }

  public function setMaterialType($materialType)
  {
    // add the materialType to term list (assuming it's a new subject)
    // TODO: check first to see if this term exists, in which case, just get its ID
    $newTerm = new QubitTerm;
    $newTerm->setTaxonomyId(QubitTaxonomy::MATERIAL_TYPE_ID);
    $newTerm->setName($materialType);
    $newTerm->save();

    // associate this new subject term with this information object
    $this->addTermRelation($newTerm->getId());
  }

  public function getMaterialTypes()
  {
    return $this->getTermRelations(QubitTaxonomy::MATERIAL_TYPE_ID);
  }

  public function getMediaTypes()
  {
    //TO DO: get via linked digital objects & physical objects
  }

  public function getRepositoryCountry()
  {
    if ($this->getRepositoryId())
    {
      return $this->getRepository()->getCountry();
    }
    else
    {
      return null;
    }
  }

  /**
   * Wrapper for getRepository method to allow inheriting repo from ancestors
   *
   * @param array $options optional parameters
   * @return QubitRepository repository object
   */
  public function getRepository(array $options = array())
  {
    $repositoryId = parent::offsetGet('repositoryId', $options);
    $repository = QubitRepository::getById($repositoryId);

    if (isset($options['inherit']) && false !== $options['inherit'])
    {
      if (null === $repository)
      {
        // Ascend up object hierarchy until a related repository is found
        foreach ($this->getAncestors() as $ancestor)
        {
          if (null !== $repository = $ancestor->getRepository())
          {
            break;
          }
        }
      }
    }

    return $repository;
  }

  /**************************
     Nested Set (Hierarchy)
  ***************************/

  /**
   * Get direct descendants of current object.
   *
   * @param array $options optional parameters
   * @return QubitQuery collection of children
   */
  public function getChildren($options = array())
  {
    $c = new Criteria;
    $c->add(QubitInformationObject::PARENT_ID, $this->id, Criteria::EQUAL);

    $sortBy = (isset($options['sortBy'])) ? $options['sortBy'] : 'lft';

    switch ($sortBy)
    {
      case 'identifierTitle':
        $c = QubitCultureFallback::addFallbackCriteria($c, 'QubitInformationObject');
        $c->addAscendingOrderByColumn('identifier');
        $c->addAscendingOrderByColumn('title');
        break;
      case 'title':
        $c = QubitCultureFallback::addFallbackCriteria($c, 'QubitInformationObject');
        $c->addAscendingOrderByColumn('title');
        break;
      case 'none':
      case 'lft':
      default:
        $c->addAscendingOrderByColumn('lft');
    }

    return QubitInformationObject::get($c, $options);
  }

  /**
   * Get all info objects that have the root node as a parent, and have children
   * (not orphans)
   *
   * @return QubitQuery collection of QubitInformationObjects
   */
  public static function getCollections()
  {
    $criteria = new Criteria;
    $criteria->addAlias('parent', QubitInformationObject::TABLE_NAME);
    $criteria->addJoin(QubitInformationObject::PARENT_ID, 'parent.id');

    // For a node with no children: rgt = (lft+1); therefore search for nodes
    // with: rgt > (lft+1)
    $criteria->add(QubitInformationObject::RGT, QubitInformationObject::RGT.' > ('.QubitInformationObject::LFT.' + 1)', Criteria::CUSTOM);
    $criteria->add('parent.lft', 1, Criteria::EQUAL);

    return QubitInformationObject::get($criteria);
  }

  public function getCollectionRoot()
  {
    return $this->ancestors->andSelf()->orderBy('lft')->__get(1);
  }

  public function setRoot()
  {
    $criteria = new Criteria;
    $criteria = QubitInformationObject::addRootsCriteria($criteria);
    $parentId = QubitInformationObject::getOne($criteria)->getId();

    $this->setParentId($parentId);
  }

  /***********************
   Actor/Event relations
  ************************/

  public function getActors($options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitEvent::ACTOR_ID);
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());

    if (isset($options['eventTypeId']))
    {
      $criteria->add(QubitEvent::TYPE_ID, $options['eventTypeId']);
    }

    if (isset($options['cultureFallback']) && true === $options['cultureFallback'])
    {
      $criteria->addAscendingOrderByColumn('authorized_form_of_name');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitActor', $options);
    }

    return QubitActor::get($criteria);
  }

  public function getCreators($options = array())
  {
    return $this->getActors($options + array('eventTypeId' => QubitTerm::CREATION_ID));
  }

  public function getPublishers()
  {
    return $this->getActors($options = array('eventTypeId' => QubitTerm::PUBLICATION_ID));
  }

  public function getContributors()
  {
    return $this->getActors($options = array('eventTypeId' => QubitTerm::CONTRIBUTION_ID));
  }

  public function getActorEvents(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    $criteria->add(QubitEvent::ACTOR_ID, null, Criteria::ISNOTNULL);
    if (isset($options['eventTypeId']))
    {
      $criteria->add(QubitEvent::TYPE_ID, $options['eventTypeId']);
    }
    $criteria->addDescendingOrderByColumn(QubitEvent::START_DATE);

    return QubitEvent::get($criteria);
  }

  public function getCreationEvents()
  {
    return $this->getActorEvents($options = array('eventTypeId' => QubitTerm::CREATION_ID));
  }

  //TODO: like getCreationEvents, use the getActorEvents method. Need to find out how to pass
  //the additional '$criteria->add(QubitEvent::DATE_DISPLAY, null, Criteria::ISNOTNULL)' as an $option
  public function getDates(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitEvent::ID, QubitEventI18n::ID, Criteria::INNER_JOIN);
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    $criteria->add(QubitEventI18n::DATE_DISPLAY, null, Criteria::ISNOTNULL);

    try
    {
      $criteria->add(QubitEventI18n::CULTURE, sfContext::getInstance()->getUser()->getCulture());
    }
    catch (sfException $e)
    {
    }

    if (isset($options['type_id']))
    {
      $criteria->add(QubitEvent::TYPE_ID, $options['type_id']);
    }
    $criteria->addDescendingOrderByColumn(QubitEvent::START_DATE);

    return QubitEvent::get($criteria);
  }

  public function getDatesOfDescription()
  {
    //from system event object

    return null;
  }

  /**
   * Get an array of name access points related to this InformationObject.
   *
   * @return array of related QubitEvent objects.
   */
  public function getNameAccessPoints()
  {
    $this->nameAccessPoints = array();
    $actorEvents = $this->informationObject->getActorEvents();
    foreach ($actorEvents as $event)
    {
      if ($event->getActorId())
      {
        $this->nameAccessPoints[] = $event;
      }
    }
  }

  /**
   * Get name access point by $actorId and $eventTypeId (should be unique)
   *
   * @param integer $actorId foreign key to QubitActor::ID
   * @param integer $eventTypeId foreign key to QubitTerm (even type taxonomy)
   * @return QubitEvent object or NULL if no matching relation found
   */
  public function getNameAccessPoint($actorId, $eventTypeId)
  {
    $criteria = new Criteria;

    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    $criteria->add(QubitEvent::ACTOR_ID, $actorId);
    $criteria->add(QubitEvent::TYPE_ID, $eventTypeId);

    return QubitEvent::getOne($criteria);
  }

  /********************
     Term relations
  *********************/

  /**
   * Add a many-to-many Term relation to this information object.
   *
   * @param integer $termId primary key of QubitTerm
   * @param string  $relationNote descriptive string (optional)
   * @return QubitInformationObject $this
   */
  public function addTermRelation($termId, $options = array())
  {
    // Don't add a term relation to this information object that already exists.
    if ($this->getTermRelation($termId) === null)
    {
      $newTermRelation = new QubitObjectTermRelation;
      $newTermRelation->setTermId($termId);

      $this->objectTermRelationsRelatedByobjectId[] = $newTermRelation;
    }

    return $this;
  }

  public function getTermRelations($taxonomyId = 'all')
  {
    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->getId());

    if ($taxonomyId != 'all')
    {
      $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID);
      $criteria->add(QubitTerm::TAXONOMY_ID, $taxonomyId);
    }

    return QubitObjectTermRelation::get($criteria);
  }

  /**
   * Get related term object by id (should be unique)
   *
   * @param
   */
  public function getTermRelation($termId)
  {
    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->getId());
    $criteria->add(QubitObjectTermRelation::TERM_ID, $termId);

    return QubitObjectTermRelation::getOne($criteria);
  }

  public function setSubjectAccessPoint($subject)
  {
    // add the subject to term list (assuming it's a new subject)
    // TODO: check first to see if this term exists, in which case, just get its ID
    $newTerm = new QubitTerm;
    $newTerm->setTaxonomyId(QubitTaxonomy::SUBJECT_ID);
    $newTerm->setName($subject);
    $newTerm->save();

    // associate this new subject term with this information object
    $this->addTermRelation($newTerm->getId());
  }

  public function getSubjectAccessPoints()
  {
    return $this->getTermRelations(QubitTaxonomy::SUBJECT_ID);
  }

  public function getPlaceAccessPoints()
  {
    return $this->getTermRelations(QubitTaxonomy::PLACE_ID);
  }

  /**************
    Properties
  ***************/

  /**
   * Add a property related to this information object
   *
   * @param string $name  Name of property
   * @param string $value Value of property
   * @param string $options array of optional parameters
   * @return QubitInformationObject this information object
   */
  public function addProperty($name, $value, $options = array())
  {
    // Don't re-add a property that exists already
    if (null != $this->id && QubitProperty::isExistent($this->id, $name, $value, $options))
    {
      return;
    }

    $property = new QubitProperty;
    $property->setName($name);
    $property->setValue($value, $options);

    if (isset($options['scope']))
    {
      $property->setScope($options['scope']);
    }

    // Add property to related items, to save with QubitInfoObject::save();
    $this->propertys[] = $property;

    return $this;
  }

  /**
   * Return all properties related to this information object,
   * with option of filtering by name and/or scope
   *
   * @param string $name filter results by name (optional)
   * @param string $scope filter results by scope (optional)
   * @return QubitQuery list of QubitProperty objects matching criteria
   */
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

  /**
   * Get first matching related property by name (optionally scope).
   * Return an empty QubitProperty object if a matching one doesn't exist.
   *
   * @param string $name
   * @param array $options
   * @return QubitProperty
   */
  public function getPropertyByName($name, $options = array())
  {
    if (null === $property = QubitProperty::getOneByObjectIdAndName($this->getId(), $name, $options))
    {
      $property = new QubitProperty;
    }

    return $property;
  }

  /**
   * Save a related property and create a new property if a matching one doesn't
   * already exist.
   *
   * @param string $name name of property
   * @param string $value new value to set
   * @param array $options array of options
   * @return QubitInformationObject
   */
  public function saveProperty($name, $value, $options = array())
  {
    // Get existing property if possible
    if (null === ($property = QubitProperty::getOneByObjectIdAndName($this->getId(), $name, $options)))
    {
      // Create a new property if required
      $property = new QubitProperty;
      $property->setObjectId($this->getId());
      $property->setName($name);

      if (isset($options['scope']))
      {
        $property->setScope($options['scope']);
      }
    }

    $property->setValue($value, $options);
    $property->save();

    return $this;
  }

  /*****************************************
        Generate Strings for Search Index
  ******************************************/

  public function getCreatorsNameString()
  {
    if ($this->getCreators())
    {
      $creatorNameString = '';
      $creators = $this->getCreators();
      foreach ($creators as $creator)
      {
        $creatorNameString .= $creator->getAuthorizedFormOfName().' ';
        foreach ($creator->getOtherNames() as $otherName)
        {
          $creatorNameString .= $otherName->getName().' ';
        }
      }

      return $creatorNameString;
    }
    else
    {
      return null;
    }
  }

  public function getCreatorsHistoryString()
  {
    if ($this->getCreators())
    {
      $creatorHistoryString = '';
      $creators = $this->getCreators();
      foreach ($creators as $creator)
      {
        $creatorHistoryString .= $creator->getHistory().' ';
      }

      return $creatorHistoryString;
    }
    else
    {
      return null;
    }
  }

  public function getDatesString()
  {
    if ($this->getDates())
    {
      $datesString = '';
      $dates = $this->getDates();
      foreach ($dates as $date)
      {
        $datesString .= $date->getDateDisplay().' ';
      }

      return $datesString;
    }
    else
    {
      return null;
    }
  }

  public function getSubjectsString($language)
  {
    $subjectString = '';
    $subjects = array();

    $subjectAps = $this->getSubjectAccessPoints();
    if ($subjectAps)
    {
      foreach ($subjectAps as $subjectAp)
      {
        $subjectTerm = $subjectAp->getTerm();
        $subjects[] = $subjectTerm->getName(array('culture' => $language));

        if (0 < count($equivalentTerms = $subjectTerm->getEquivalentTerms(array('direction' => 'subjectToObject'))))
        {
          foreach ($equivalentTerms as $eqTerm)
          {
            $subjects[] = $eqTerm->getName(array('culture' => $language));
          }
        }
      }

      $subjectString = implode(' ', $subjects);
    }

    return $subjectString;
  }

  public function getPlacesString($language)
  {
    $placeString = '';
    $places = array();

    $placeAps = $this->getPlaceAccessPoints();
    if ($placeAps)
    {
      foreach ($placeAps as $placeAp)
      {
        $placeTerm = $placeAp->getTerm();
        $places[] = $placeTerm->getName(array('culture' => $language));

        if (0 < count($equivalentTerms = $placeTerm->getEquivalentTerms(array('direction' => 'subjectToObject'))))
        {
          foreach ($equivalentTerms as $eqTerm)
          {
            $places[] = $eqTerm->getName(array('culture' => $language));
          }
        }
      }
    }

    $placeString = implode(' ', $places);

    return $placeString;
  }

  public function getNameAccessPointsString($language)
  {
    $nameAccessPointString = '';

    $names = $this->getActors();
    if ($names)
    {
      foreach ($names as $name)
      {
        $nameAccessPointString .= $name->getAuthorizedFormOfName(array('culture' => $language)).' ';
      }
    }

    return $nameAccessPointString;
  }

  /********************
    Physical Objects
  *********************/

  /**
   * Add a relation from this info object to a phyical object. Check to make
   * sure the relationship is unique.
   *
   * @param QubitPhysicalObject $physicalObject Subject of relationship
   * @return QubitInformationObject this object
   */
  public function addPhysicalObject($physicalObject)
  {
    // Verify that $physicalObject is really a Physical Object and
    // Don't add an identical info object -> physical object relationship
    if (get_class($physicalObject) == 'QubitPhysicalObject' && $this->getPhysicalObject($physicalObject->getId()) === null)
    {
      $relation = new QubitRelation;
      $relation->setSubject($physicalObject);
      $relation->setTypeId(QubitTerm::HAS_PHYSICAL_OBJECT_ID);

      $this->relationsRelatedByobjectId[] = $relation;
    }

    return $this;
  }

  /**
   * Get a specific physical object related to this info object
   *
   * @param integer $physicalObjectId the id of the related physical object
   * @return mixed the QubitRelation object on success, null if no match found
   */
  public function getPhysicalObject($physicalObjectId)
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::OBJECT_ID, $this->getId());
    $criteria->add(QubitRelation::SUBJECT_ID, $physicalObjectId);

    return QubitRelation::getOne($criteria);
  }

  /**
   * Get all physical objects related to this info object
   *
   */
  public function getPhysicalObjects()
  {
    $relatedPhysicalObjects = QubitRelation::getRelatedSubjectsByObjectId('QubitPhysicalObject', $this->getId(), array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    return $relatedPhysicalObjects;
  }

  /**
   * Cascade delete child records in q_relation
   *
   */
  protected function deletePhysicalObjectRelations()
  {
    $relations = QubitRelation::getRelationsByObjectId($this->getId(),
    array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    foreach ($relations as $relation)
    {
      $relation->delete();
    }
  }

  /******************
    Digital Objects
  ******************/

  /**
   * Get all digital objects from descendants of current
   * object
   *
   * @return array  of thumbnail representations
   */
  public function getDescendantThumbnails()
  {
    $thumbnails = array();

    $descendants = $this->getDescendants();
    foreach ($descendants as $descendant)
    {
      if ($digitalObject = $descendant->getDigitalObject())
      {
        $thumbnail = $digitalObject->getRepresentationByUsage(QubitTerm::THUMBNAIL_ID);

        if (!$thumbnail)
        {
          $thumbnail = QubitDigitalObject::getGenericRepresentation($digitalObject->getMimeType(), QubitTerm::THUMBNAIL_ID);
          $thumbnail->setParent($digitalObject);
        }

        $thumbnails[] = $thumbnail;
      }
    }

    return $thumbnails;
  }

    /**
   * Get the digital object related to this information object. The
   * informationObject to digitalObject relationship is "one to zero or one".
   *
   * @return mixed QubitDigitalObject or null
   */
  public function getDigitalObject()
  {
    $digitalObjects = $this->getDigitalObjects();
    if (count($digitalObjects) > 0)
    {
      return $digitalObjects[0];
    }
    else
    {
      return null;
    }
  }


  /****************
   Import methods
  *****************/

  /**
   * Wrapper for QubitDigitalObject::importFromUri() method
   *
   * @param string $uri URI of remote file
   * @return QubitInformationObject $this
   *
   * @TODO allow for different usage types
   */
  public function importDigitalObjectFromUri($uri)
  {
    $digitalObject = new QubitDigitalObject;
    $digitalObject->setUsageId(QubitTerm::MASTER_ID);
    $digitalObject->importFromUri($uri);

    $this->digitalObjects[] = $digitalObject;
  }

  /**
   * Wrapper for QubitDigitalObject::importFromBase64() method
   *
   * @param string $encodedString base-64 encoded data
   * @param string $filename name of destination file
   * @return QubitInformationObject $this
   *
   * @TODO allow for different usage types
   */
  public function importDigitalObjectFromBase64($encodedString, $filename)
  {
    $digitalObject = new QubitDigitalObject;
    $digitalObject->setUsageId(QubitTerm::MASTER_ID);
    $digitalObject->importFromBase64($encodedString, $filename);

    $this->digitalObjects[] = $digitalObject;
  }

  public function setRepositoryByName($name)
  {
    // see if Repository record already exists, if so link to it
    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID);
    $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $name);
    if ($actor = QubitActor::getOne($criteria))
    {
      if ($actor->getClassName() == 'QubitRepository')
      {
        $this->setRepositoryId($actor->getId());
      }
      //TODO: figure out how to create a Repository from an existing Actor
      //e.g. if the Actor record exists but it is not yet been used as a Repository
    }
    else
    {
      // if the repository does not already exist, create a new Repository and link to it
      $repository = new QubitRepository;
      $repository->setAuthorizedFormOfName($name);
      $repository->save();
      $this->setRepositoryId($repository->getId());
    }
  }

  public function setRepositoryAddress($address)
  {
    if ($repository = $this->getRepository())
    {
      if ($primaryContact = $repository->getPrimaryContact())
      {
        if (is_null($primaryContact->getStreetAddress()))
        {
          $primaryContact->setStreetAddress($address);
          $primaryContact->save();
        }
      }
      else
      {
        $contactInformation = new QubitContactInformation;
        $contactInformation->setStreetAddress($address);
        $contactInformation->setPrimaryContact(true);
        $contactInformation->setActorId($repository->getId());
        $contactInformation->save();
      }
    }
  }

  public function setActorByName($name, $options)
  {
    // only create an linked Actor if the event or relation type is indicated
    if (!isset($options['event_type_id']) && !isset($options['relation_type_id']))
    {

      return;
    }

    // see if the Actor record already exists, if not create it
    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID);
    $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $name);

    if (null === $actor = QubitActor::getOne($criteria))
    {
      $actor = new QubitActor;
      $actor->setAuthorizedFormOfName($name);
      if (isset($options['entity_type_id']))
      {
        // set actor entityTypeId
        $actor->setEntityTypeId($options['entity_type_id']);
      }
      if (isset($options['source']))
      {
        // set actor entityTypeId
        $actor->setSources($options['source']);
      }
      if (isset($options['rules']))
      {
        // set actor entityTypeId
        $actor->setRules($options['rules']);
      }
      if (isset($options['history']))
      {
        $actor->setHistory($options['history']);
      }
      $actor->save();
    }

    if (isset($options['event_type_id']))
    {
      // create an event object to link the information object and actor
      $event = new QubitEvent;
      $event->setActorId($actor->getId());
      $event->setTypeId($options['event_type_id']);
      if (isset($options['dates']))
      {
        $event->setDateDisplay($options['dates']);
      }

      $this->events[] = $event;
    }
    else if (isset($options['relation_type_id']))
    {
      // only add Actor as name access point if they are not already linked to
      // an event (i.e. they are not already a "creator", "accumulator", etc.)
      $existingRelation = false;
      foreach ($this->events as $existingEvent)
      {
        if ($actor->id == $existingEvent->actorId)
        {
          $existingRelation = true;
          break;
        }
      }

      if (!$existingRelation)
      {
        $relation = new QubitRelation;
        $relation->objectId = $actor->id;
        $relation->typeId = QubitTerm::NAME_ACCESS_POINT_ID;

        $this->relationsRelatedBysubjectId[] = $relation;
      }
    }
  }

  /**
   * Import actor history from on <bioghist> tag in EAD2002
   *
   * @param $history string actor history
   */
  public function setHistoryByOrigination($history)
  {
    // Check events array for related events/actors (we may not have saved this
    // data to the database yet)
    if (0 < count($relatedEvents = $this->events))
    {
      foreach ($relatedEvents as $event)
      {
        if (null !== ($actor = $event->getActor()))
        {
          $actor->setHistory($history);
          $actor->save();
          break;
        }
      }
    }
  }

  public function setLevelOfDescriptionByName($name)
  {
    // don't proceed if the 'otherlevel' value is passed
    if ($name !== 'otherlevel')
    {
      // see if Level of Description term already exists, if so link to it
      $criteria = new Criteria;
      $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID);
      $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
      $criteria->add(QubitTermI18n::NAME, $name);
      if ($term = QubitTermI18n::getOne($criteria))
      {
        $this->setLevelOfDescriptionId($term->getId());
      }
      else
      {
        // if the Level of Description term does not already exist, create a new Level and link to it
        $term = new QubitTerm;
        $term->setTaxonomyId(QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID);
        $term->setName($name);
        $term->setRoot();
        $term->save();
        $this->setLevelOfDescriptionId($term->getId());
      }
    }
  }

  public function setDates($date, $options)
  {
    // parse the normalized dates into an Event start and end date
    $normalizedDate = array();
    if (isset($options['normalized_dates']))
    {
      preg_match('/(?P<start>\d{4}(-\d{2})?(-\d{2})?)\/?(?P<end>\d{4}(-\d{2})?(-\d{2})?)?/', $options['normalized_dates'], $matches);
      $normalizedDate['start'] = new DateTime($this->getDefaultDateValue($matches['start']));
      if ($matches['end'])
      {
        $normalizedDate['end'] = new DateTime($this->getDefaultDateValue($matches['end']));
      }
      else
      {
        $normalizedDate['end'] = null;
      }
    }
    else
    {
      $normalizedDate['start'] = null;
      $normalizedDate['end'] = null;
    }

    // determine the Event type
    if (isset($options['date_type']))
    {
      $eventType = $options['date_type'];
      // see if Event Type already exists, if so use it
      $criteria = new Criteria;
      $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::EVENT_TYPE_ID);
      $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
      $criteria->add(QubitTermI18n::NAME, $eventType);
      if ($term = QubitTermI18n::getOne($criteria))
      {
        $eventTypeId = $term->getId();
      }
      else
      {
        // if the Event Type does not already exist, create a new type and use it
        $term = new QubitTerm;
        $term->setTaxonomyId(QubitTaxonomy::EVENT_TYPE_ID);
        $term->setName($eventType);
        $term->setRoot();
        $term->save();
        $eventTypeId = $term->getId();
      }
    }
    else
    {
      // set event type to 'creation' by default
      $eventTypeId = QubitTerm::CREATION_ID;
    }

    // assign the dates to the same event as the creator for this information object
    // if there is more than one creator, assign it to the first one that is returned
    if (count($creationEvents = $this->getCreationEvents()) > 0)
    {
      $event = $creationEvents[0];
      $event->setIndexOnSave(false);
      $event->setStartDate($normalizedDate['start']);
      $event->setEndDate($normalizedDate['end']);
      $event->setTypeId($eventTypeId);
      $event->setDateDisplay($date);
      $event->save();
    }
    else
    {
      // if this information object is not linked to a creator, create an event object
      // and link it to the information object
      $event = new QubitEvent;
      $event->setTypeId($eventTypeId);
      $event->setStartDate($normalizedDate['start']);
      $event->setEndDate($normalizedDate['end']);
      $event->setDateDisplay($date);

      $this->events[] = $event;
    }
  }

  protected function getDefaultDateValue($date)
  {
    if (strlen($date) == 4)
    {
      return $date.'-01-01';
    }
    else if (strlen($date) == 7)
    {
      return $date.'-01';
    }

    return $date;
  }

  public function setIdentifierWithCodes($identifier, $options)
  {
    $this->setIdentifier($identifier);

    if ($repository = QubitRepository::getById($this->getRepositoryId()))
    {
      // if the repository doesn't already have a code, set it using the <unitid repositorycode=""> value
      if (isset($options['repositorycode']))
      {
        if (!$repository->getIdentifier())
        {
          $repository->setIdentifier($options['repositorycode']);
          $repository->save();
        }
      }
      // if the repository doesn't already have an country code, set it using the <unitid countrycode=""> value
      if (isset($options['countrycode']))
      {
        if (!$repository->getCountryCode())
        {
          if ($primaryContact = $repository->getPrimaryContact())
          {
            $primaryContact->setCountryCode(strtoupper($options['countrycode']));
            $primaryContact->save();
          }
          else if (count($contacts = $repository->getContactInformation()) > 0)
          {
            $contacts[0]->setCountryCode(strtoupper($options['countrycode']));
            $contacts[0]->save();
          }
          else
          {
            $contactInformation = new QubitContactInformation;
            $contactInformation->setCountryCode(strtoupper($options['countrycode']));
            $contactInformation->setActorId($repository->getId());
            $contactInformation->save();
          }
        }
      }
    }
  }

  public function setTermRelationByName($term, $options)
  {
    // see if subject term already exists
    $criteria = new Criteria;
    $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
    $criteria->add(QubitTerm::TAXONOMY_ID, $options['taxonomyId']);
    $criteria->add(QubitTermI18n::NAME, $term);
    if ($existingTerm = QubitTerm::getOne($criteria))
    {
      $this->addTermRelation($existingTerm->getId());
    }
    else
    {
      $newTerm = new QubitTerm;
      $newTerm->setTaxonomyId($options['taxonomyId']);
      $newTerm->setName($term);
      $newTerm->setRoot();
      $newTerm->save();
      if (isset($options['source']))
      {
        $newTerm->setNote(null, $options['source'], QubitTerm::SOURCE_NOTE_ID);
      }
      // associate this new subject term with this information object
      $this->addTermRelation($newTerm->getId());
    }
  }

  public function setPhysicalObjectByName($physicalObjectName, $options)
  {
    // see if physical object already exists, otherwise create a new physical object
    $criteria = new Criteria;
    $criteria->addJoin(QubitPhysicalObject::ID, QubitPhysicalObjectI18n::ID);
    $criteria->add(QubitPhysicalObjectI18n::NAME, $physicalObjectName);
    if ($existingPhysicalObject = QubitPhysicalObject::getOne($criteria))
    {
      $this->addPhysicalObject($existingPhysicalObject);
    }
    else
    {
      $newPhysicalObject = new QubitPhysicalObject;
      $newPhysicalObject->setName($physicalObjectName);

      // see if physical object type already exists, otherwise create a new one
      if ($options['type'])
      {
        $criteria = new Criteria;
        $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
        $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::PHYSICAL_OBJECT_TYPE_ID);
        $criteria->add(QubitTermI18n::NAME, $options['type']);
        if ($physicalObjectType = QubitTerm::getOne($criteria))
        {
          $newPhysicalObject->setTypeId($physicalObjectType->getId());
        }
        else
        {
          $newTerm = new QubitTerm;
          $newTerm->setTaxonomyId(QubitTaxonomy::PHYSICAL_OBJECT_TYPE_ID);
          $newTerm->setName($options['type']);
          $newTerm->setParentId(QubitTerm::CONTAINER_ID);
          $newTerm->save();
          $newPhysicalObject->setTypeId($newTerm->getId());
        }
      }

      if (isset($options['location']))
      {
        $newPhysicalObject->setLocation($options['location']);
      }
      $newPhysicalObject->save();
      $this->addPhysicalObject($newPhysicalObject);
    }
  }

  /**************
  OAI methods
  ***************/

  /**
   * Get Record by Oai identifier
   * @param integer $identifier, the oai_identifier
   * @return QubitQuery collection of QubitInformationObjects
   */
  public static function getRecordByOaiID($oai_local_identifier)
  {
    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::OAI_LOCAL_IDENTIFIER, $oai_local_identifier);
    return QubitInformationObject::get($criteria)->offsetGet(0, array('defaultValue' => null));
  }


  /**
   * Get Oai identifier
   * @param
   * @return String containing OAI-compliant Identifier
   */

  public function getOaiIdentifier()
  {
    $domain = sfContext::getInstance()->getRequest()->getHost();
    $oaiRepositoryCode = QubitSetting::getSettingByName('oai_repository_code')->getValue(array('sourceCulture'=>true));
    $oaiIdentifier = 'oai:'.$domain.':'.$oaiRepositoryCode.'_'.$this->getOaiLocalIdentifier();

    return $oaiIdentifier;
  }

  /**
   * Set source Oai identifier
   * @param
   * @return String set the OAI Identifier returned from the source repository as part of an OAI response
   */

  public function setSourceOaiIdentifier($value)
  {
    $this->addProperty('source_oai_identifier', $value, $options = array('scope' => 'oai', 'sourceCulture' => true));
  }

  public function getSourceOaiIdentifier()
  {
    return $this->getPropertyByName('source_oai_identifier');
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
    $criteria->add(QubitInformationObject::UPDATED_AT, $cutoff, Criteria::GREATER_EQUAL);

    return $criteria;
  }

  /*****************************************************
   Search Index methods
  *****************************************************/

  public static function getByCulture($culture, $options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitInformationObject::ID, QubitInformationObjectI18n::ID, Criteria::INNER_JOIN);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $culture, Criteria::EQUAL);

    return QubitInformationObject::get($criteria, $options);
  }

  /*****************************************************
   Publication Status
  *****************************************************/
  public function getPublicationStatus()
  {
    // Ascend up object hierarchy until a publication status is found
    // right up to the root object if necessary (which is set to 'draft' by default)
    foreach ($this->ancestors->andSelf()->orderBy('rgt') as $ancestor)
    {
      $status = $ancestor->getStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID));
      if (isset($status) && null !== $status->statusId)
      {
        return $status;
      }
    }
  }

  /**
   * Speed-optimized method for checking if information object has children
   * which doesn't require hitting database.
   *
   * @return boolean - true if has children
   */
  public function hasChildren()
  {
    return ($this->rgt - $this->lft) > 1;
  }
}
