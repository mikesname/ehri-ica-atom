<?php
/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * Extended methods for Information object model
 *
 * @package qubit
 * @subpackage datamodel
 * @author Jack Bates
 * @author Peter Van Garderen
 * @author David Juhasz <david@artefactual.com>
 * @version svn:$Id$
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
  
  /**
   * Get a paginated hitlist information objects
   *
   * @param string   $culture primary language for list
   * @param Criteria $criteria Propel Criteria object
   * @param array    $options array of optional function parameters
   * @return QubitQuery collection of QubitInformationObject objects
   */
  public static function getList($culture, $criteria, $options = array())
  {
    // Only get the top-level info object (collections and orphans)
    if (isset($options['parentId']))
    {
      $criteria->add(QubitInformationObject::PARENT_ID, $options['parentId'], Criteria::EQUAL);
    }
    
    $cultureFallback = (isset($options['cultureFallback'])) ? $options['cultureFallback'] : false;
    $sort = (isset($options['sort'])) ? $options['sort'] : null;
    $page = (isset($options['page'])) ? $options['page'] : 1;
    
    if (isset($options['repositoryId']))
    {
      $criteria->add(QubitInformationObject::REPOSITORY_ID,  $options['repositoryId']);
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
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $fallbackTable, $culture, $options);
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

  public function getLabel($truncate = null)
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

    if (is_null($title = $this->getTitle()))
    {
      $title = $this->getTitle(array('sourceCulture' => true));
    }
    
    $label .= $title;

    if ($truncate !== null)
    {
      $label = truncate_text($label, $truncate);
    }


  //TODO: will return an array, only display first one?
  /*
  if ($this->getDates($eventType = 'creation'))
  {
    $label .= ' ['.$this->getDates($eventType = 'creation').']';
  }
  */

    return $label;
  }

  public function getCollectionRoot()
  {
    return $this->getAncestors()->orderBy('lft')->offsetGet(1, array('defaultValue' => $this));
  }

  public function setNote($userId, $note, $noteTypeId)
  {
    $newNote = new QubitNote;
    $newNote->setObject($this);
    $newNote->setScope('QubitInformationObject');
    $newNote->setUserId($userId);
    $newNote->setContent($note);
    $newNote->setTypeId($noteTypeId);
    $newNote->save();
  }

  public function getNotesByType($noteTypeId = null, $excludeNoteTypeId = null)
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    if ($noteTypeId)
      {
      $criteria->add(QubitNote::TYPE_ID, $noteTypeId);
      }
    if ($excludeNoteTypeId)
      {
      $criteria->add(QubitNote::TYPE_ID, $excludeNoteTypeId, Criteria::NOT_EQUAL);
      }

    return QubitNote::get($criteria);
  }

  //Actor-Event Relations
  public function getActors($actorRoleTypeId = null)
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitEvent::ACTOR_ID);
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    if ($actorRoleTypeId)
    {
      $criteria->add(QubitEvent::ACTOR_ROLE_ID, $actorRoleTypeId);
    }
    $criteria->addGroupByColumn(QubitEvent::ACTOR_ID);

    return QubitActor::get($criteria);
  }

  public function getCreators()
  {
    $criteria = new Criteria;
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    $criteria->add(QubitEvent::ACTOR_ROLE_ID, QubitTerm::CREATOR_ID);
    $criteria->addJoin(QubitEvent::ACTOR_ID, QubitActor::ID);
    $criteria->addGroupByColumn(QubitEvent::ACTOR_ID);
    //$criteria->addAscendingOrderByColumn(QubitActorI18n::AUTHORIZED_FORM_OF_NAME);
    $events = QubitEvent::get($criteria);

    $actors = array();
    foreach ($events as $event)
    {
      $actors[] = $event->getActor();
    }

    return $actors;
  }

  public function getActorEvents($typeId = null)
  {
    $criteria = new Criteria;
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    if ($typeId)
     {
     $criteria->add(QubitEvent::TYPE_ID, $typeId);
     }
    $criteria->addDescendingOrderByColumn(QubitEvent::START_DATE);

    return QubitEvent::get($criteria);
  }

  public function getCreationEvents()
  {
    $criteria = new Criteria;
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    $criteria->addDescendingOrderByColumn(QubitEvent::START_DATE);
    // check for Events that have a creator OR are of the type 'creation'
    $crit0 = $criteria->getNewCriterion(QubitEvent::TYPE_ID, QubitTerm::CREATION_ID);
    $crit1 = $criteria->getNewCriterion(QubitEvent::ACTOR_ROLE_ID, QubitTerm::CREATOR_ID);
    $crit0->addOr($crit1);
    $criteria->add($crit0);

    return QubitEvent::get($criteria);
  }

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

  public function getDates($eventType = 'creation')
  {
    $criteria = new Criteria;
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    switch ($eventType)
      {
        case 'creation' :
        $criteria->add(QubitEvent::TYPE_ID, QubitTerm::CREATION_ID);
        break;
      }
    $criteria->addDescendingOrderByColumn(QubitEvent::START_DATE);
    $events = QubitEvent::get($criteria);

    $eventDates = array();
    foreach ($events as $event)
    {
      $eventDates[] = $event->getDescription(array('cultureFallback' => true));
    }

    return $eventDates;
  }

  public function getDatesOfDescription()
  {
  //from system event object

  return null;
  }

  
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
    if ($this->getTermRelation($termId) === NULL)
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

  /**
   * Add a property related to this information object
   * 
   * @param string $name  Name of property
   * @param string $value Value of property
   * @param string $scope Add scope note (optional)
   * @return QubitInformationObject this information object
   */
  public function addProperty($name, $value, $scope = null)
  {
    // Only add this property if an identical one does NOT exist already
    if ($this->getProperty($name, $value, $scope) === null) {
	    $newCode = new QubitProperty;
	    $newCode->setObjectId($this->getId());
	    $newCode->setName($name);
	    $newCode->setValue($value);
	    $newCode->setScope($scope);
	    $newCode->save();
    }
    
    return $this;
  }
  
  /**
   * Get an existing property related to this information object.
   * 
   * @param string $name  name of property
   * @param string $value value of property
   * @param string $scope scope note (default: null)
   * @return mixed QubitProperty if match found, null if no match
   */
  public function getProperty($name, $value, $scope = null)
  {
    $criteria = new Criteria;
    $criteria->add(QubitProperty::OBJECT_ID, $this->getId());
    $criteria->add(QubitProperty::NAME, $name);
    $criteria->add(QubitProperty::VALUE, $value);
    $criteria->add(QubitProperty::SCOPE, $scope);
    
    return QubitProperty::getOne($criteria);
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
  
  /**
   * Add a name access point to this info object
   * 
   * @param integer $actorId primary key of actor
   * @param integer $actorRoleId foriegn key to QubitTerm for actor role taxonomy
   * @return QubitInformationObject this object
   */
  public function addNameAccessPoint($actorId, $actorRoleId)
  {
    // Only add new related QubitEvent relation if an indentical relationship
    // doesn't already exist
    if ($this->getNameAccessPoint($actorId, $actorRoleId) === NULL)
    {
	    $newNameAccessPoint = new QubitEvent;
	    $newNameAccessPoint->setActorId($actorId);
	    $newNameAccessPoint->setActorRoleId($actorRoleId);
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
    $actorEvents =  $this->informationObject->getActorEvents();
    foreach ($actorEvents as $event)
    {
      if ($event->getActorId())
      {
        $this->nameAccessPoints[] = $event;
      }
    }
  }
  
  /**
   * Get name access point by $actorId and $actorRoleId (should be unique)
   * 
   * @param integer $actorId foreign key to QubitActor::ID
   * @param integer $actorRoleId foreign key to QubitTerm (actor role taxonomy)
   * @return QubitEvent object or NULL if no matching relation found
   */
  public function getNameAccessPoint($actorId, $actorRoleId)
  {
    $criteria = new Criteria;
    
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->getId());
    $criteria->add(QubitEvent::ACTOR_ID, $actorId);
    $criteria->add(QubitEvent::ACTOR_ROLE_ID, $actorRoleId);
    
    return QubitEvent::getOne($criteria);
  }

  public function getMediaTypes()
  {
    //TO DO: get via linked digital objects & physical objects
  }

  public function getReferenceCode(array $options = array())
  {
    // set default value
    $options += array('standard' => 'isad');

    $countryCode = null;
    $repositoryCode = null;
    $identifiers = array();
    // if current informationObject is related to a Repository record
    // get its country and repository code from that related record
    // otherwise go up the ancestor tree until hitting a node that has a related
    // Repository record with country and repository code info
    foreach ($this->getAncestors()->andSelf()->orderBy('lft') as $ancestor)
    {
      if (null !== $repository = $ancestor->getRepository())
      {
        $countryCode = $repository->getPrimaryContact()->getCountryCode().' ';
        $repositoryCode = $repository->getIdentifier().' ';
      }

      // while going up the ancestor tree, build an array of identifiers that can be output
      // as one compound identifier string for Reference Code display
      if ($ancestor->getIdentifier())
      {
        $identifiers[] = $ancestor->getIdentifier();
      }
    }

    // output a Reference Code according to the rules of a particular standard
    switch ($options['standard'])
    {
      case 'isad':
        // TODO: This should work in future, without requiring the foreach() loop above:
        // return $this->getAncestors->andSelf->orderBy('rgt')->getRepository()->getPrimaryContact()->getCountryCode().' '.$this->getAncestors->andSelf()->getRepository()->getIdentifier().' '.implode('-', $this->getAncestors()->andSelf()->getIdentifier());
        return $countryCode.$repositoryCode.implode('-', $identifiers);
      case 'dublincore':
        return $identifierString;
      case 'ead':
        return $identifierString;
    }
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

//generate strings for search index:
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

  // -------------------------------------------------------------------------
  // Physical Object Relationship
  // -------------------------------------------------------------------------

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
   * Get a physical object related to this info object
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
}
