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

  public function save($connection = null)
  {
    parent::save($connection);

    SearchIndex::updateTranslatedLanguages($this);
  }

  /**
   * Additional actions to take on delete
   *
   */
  public function delete($connection = null)
  {
    $this->deletePhysicalObjectRelations();

    parent::delete($connection);

    SearchIndex::deleteIndexDocument($this);
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
    if ($from != '')
    {
      $criteria->add(QubitInformationObject::UPDATED_AT, $from, Criteria::GREATER_EQUAL);
    }

    if ($until != '')
    {
      $criteria->add(QubitInformationObject::UPDATED_AT, $until, Criteria::LESS_EQUAL);
    }
    if ($set != '')
    {
      $criteria->add(QubitInformationObject::LFT, $set['lft'], Criteria::GREATER_EQUAL);
      $criteria->add(QubitInformationObject::RGT, $set['rgt'], Criteria::LESS_EQUAL);
    }
    $criteria->add(QubitInformationObject::PARENT_ID, null, Criteria::ISNOTNULL);
    $criteria->addAscendingOrderByColumn(QubitInformationObject::UPDATED_AT);
    return QubitInformationObject::get($criteria);
  }

  /**
   * Get minimum updated_date in the information objects.
   * @return date the minimum updated_date
   */
  public static function getMinUpdatedAt()
  {
    $connection = Propel::getConnection();
    $query = 'SELECT MIN('.QubitInformationObject::UPDATED_AT.') AS MIN FROM '.QubitInformationObject::TABLE_NAME;

    $statement = $connection->prepare($query);
    $statement->execute();
    $resultset = $statement->fetch();
    $min = $resultset['MIN'];
    return $min;
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
   * Add a name access point to this info object
   *
   * @param integer $actorId primary key of actor
   * @param integer $eventTypeId foriegn key to QubitTerm for event type taxonomy
   * @return QubitInformationObject this object
   */
  public function addNameAccessPoint($actorId, $eventTypeId)
  {
    // Only add new related QubitEvent relation if an indentical relationship
    // doesn't already exist
    if ($this->getNameAccessPoint($actorId, $eventTypeId) === null)
    {
      $newNameAccessPoint = new QubitEvent;
      $newNameAccessPoint->setActorId($actorId);
      $newNameAccessPoint->setTypeId($eventTypeId);
      $newNameAccessPoint->setInformationObjectId($this->getId());
      $newNameAccessPoint->save();
    }

    return $this;
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
  public function addTermRelation($termId, $relationNote = null)
  {
    // Don't add a term relation to this information object that already exists.
    if ($this->getTermRelation($termId) === null)
    {
      $newTermRelation = new QubitObjectTermRelation;
      $newTermRelation->setObject($this);
      $newTermRelation->setTermId($termId);
      //TODO: move to QubitNote
      //  $newTermRelation->setRelationNote($relationNote);
      $newTermRelation->save();
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
    QubitProperty::addUnique($this->getId(), $name, $value, $options);

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

  /********************
        Notes
  *********************/

  public function setNote(array $options = array())
  {
    $newNote = new QubitNote;
    $newNote->setObject($this);
    $newNote->setScope('QubitInformationObject');
    $newNote->setUserId($options['userId']);
    $newNote->setContent($options['note']);
    $newNote->setTypeId($options['noteTypeId']);
    $newNote->save();
  }

  public function getNotesByType(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    if (isset($options['noteTypeId']))
    {
      $criteria->add(QubitNote::TYPE_ID, $options['noteTypeId']);
    }
    if (isset($options['exclude']))
    {
      // Turn exclude string into an array
      $excludes = (is_array($options['exclude'])) ? $options['exclude'] : array($options['exclude']);

      foreach ($excludes as $exclude)
      {
        $criteria->addAnd(QubitNote::TYPE_ID, $exclude, Criteria::NOT_EQUAL);
      }
    }

    return QubitNote::get($criteria);
  }

  public function getNotesByTaxonomy(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    if (isset($options['taxonomyId']))
    {
      $criteria->add(QubitTerm::TAXONOMY_ID, $options['taxonomyId']);
    }

    return QubitNote::get($criteria);
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

    $subjects = $this->getSubjectAccessPoints();
    if ($subjects)
    {
      foreach ($subjects as $subject)
      {
        $subjectString .= $subject->getTerm(array('culture' => $language)).' ';
      }
    }

    return $subjectString;
  }

  public function getPlacesString($language)
  {
    $placeString = '';

    $places = $this->getPlaceAccessPoints();
    if ($places)
    {
      foreach ($places as $place)
      {
        $placeString .= $place->getTerm(array('culture' => $language)).' ';
      }
    }

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
      $relation->setObject($this);
      $relation->setSubject($physicalObject);
      $relation->setTypeId(QubitTerm::HAS_PHYSICAL_OBJECT_ID);
      $relation->save();
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
          $thumbnail = QubitDigitalObject::getGenericRepresentation($digitalObject->getMimeType());
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

  /**
   * Decide whether to show child digital objects as a compound object based
   * on 'display_as_compound_object' toggle and available digital objects.
   *
   * @return boolean
   */
  public function showAsCompoundDigitalObject($usageId)
  {
    // Return false if this object has it's own digital object image to display
    if (null !== $digitalObject = $this->getDigitalObject())
    {
      if ($digitalObject->getRepresentationByUsage($usageId))
      {
        return false;
      }
    }

    // Return false if "show compound" toggle is not set to '1' (yes)
    $showCompoundProp = QubitProperty::getOneByObjectIdAndName($this->getId(), 'display_as_compound_object');
    if (null === $showCompoundProp || '1' != $showCompoundProp->getValue(array('sourceCulture' => true)) )
    {
      return false;
    }

    // Return false if this object has no children with digital objects
    $criteria = new Criteria;
    $criteria->addJoin(QubitInformationObject::ID, QubitDigitalObject::INFORMATION_OBJECT_ID, Criteria::INNER_JOIN);
    $criteria->add(QubitInformationObject::PARENT_ID, $this->id, Criteria::EQUAL);

    if (0 === count(QubitDigitalObject::get($criteria)))
    {
      return false;
    }

    return true;
  }

    /**
   * Setter for "display_as_compound_object" property
   *
   * @param string $value new value for property
   * @return QubitInformationObject this object
   */
  public function setDisplayAsCompoundObject($value)
  {
    $displayAsCompoundProp = QubitProperty::getOneByObjectIdAndName($this->getId(), 'display_as_compound_object');
    if (is_null($displayAsCompoundProp))
    {
      $displayAsCompoundProp = new QubitProperty;
      $displayAsCompoundProp->setObjectId($this->getId());
      $displayAsCompoundProp->setName('display_as_compound_object');
      $displayAsCompoundProp->setScope('information_object');
    }

    $displayAsCompoundProp->setValue($value, array('sourceCulture' => true));
    $displayAsCompoundProp->save();

    return $this;
  }

  /**
   * Getter for related "display_as_compound_object" property
   *
   * @return string property value
   */
  public function getDisplayAsCompoundObject()
  {
    $displayAsCompoundProp = QubitProperty::getOneByObjectIdAndName($this->getId(), 'display_as_compound_object');
    if (null !== $displayAsCompoundProp)
    {

      return $displayAsCompoundProp->getValue(array('sourceCulture' => true));
    }
  }

  /**************
  Import methods
  ***************/

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
    // only create an Actor and linked Event if the event type is indicated
    if (isset($options['event_type_id']))
    {
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

      // create an event object to link the information object and actor
      $event = new QubitEvent;
      $event->setInformationObjectId($this->getId());
      $event->setActorId($actor->getId());
      $event->setTypeId($options['event_type_id']);
      if (isset($options['dates']))
      {
        $event->setDateDisplay($options['dates']);
      }

      $event->save();
    }
  }

  public function setHistoryByOrigination($history)
  {
    if (count($actors = $this->getActors()) > 0)
    {
      $actors[0]->setHistory($history);
      $actors[0]->save();
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
      $event->setInformationObjectId($this->getId());
      $event->setTypeId($eventTypeId);
      $event->setStartDate($normalizedDate['start']);
      $event->setEndDate($normalizedDate['end']);
      $event->setDateDisplay($date);
      $event->save();
    }
  }

  private function getDefaultDateValue($date)
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

      if ($options['location'])
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
}
