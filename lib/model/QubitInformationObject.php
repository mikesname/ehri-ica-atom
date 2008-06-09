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

class QubitInformationObject extends BaseInformationObject
{
  public function __toString()
  {
    if (null === $title = $this->getTitle())
    {
      $title = $this->getTitle(array('sourceCulture' => true));
    }

    return (string) $title;
  }

  public static function getList($sort = 'titleUp', $repositoryId = null, $collectionTypeId = null)
    {
    $criteria = new Criteria;
    //select only collection root nodes and orphans
    $criteria = QubitInformationObject::addRootsCriteria($criteria);
    $root = QubitInformationObject::getOne($criteria);

    switch ($sort)
      {
        case 'titleUp' :
          $criteria->addJoin(QubitInformationObject::ID, QubitInformationObjectI18n::ID);
          $criteria->addAscendingOrderByColumn(QubitInformationObjectI18n::TITLE);
        case 'titleDown' :
          $criteria->addJoin(QubitInformationObject::ID, QubitInformationObjectI18n::ID);
          $criteria->addDescendingOrderByColumn(QubitInformationObjectI18n::TITLE);
      }

    return $root->getInformationObjectsRelatedByParentId();
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

    if ($truncate !== null)
    {
      $label .= truncate_text($title, $truncate);
    }
    else
    {
      $label .= $title;
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
      $eventDates[] = $event->getDescription();
    }

    return $eventDates;
  }

  public function getDatesOfDescription()
  {
  //from system event object

  return null;
  }

  //many-to-many Term Relations

  public function setTermRelation($termId, $relationNote = null)
  {
    $newTermRelation = new QubitObjectTermRelation;
    $newTermRelation->setTermId($termId);
//TODO: move to QubitNote
//  $newTermRelation->setRelationNote($relationNote);
    $newTermRelation->setObject($this);
    $newTermRelation->save();
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

  public function setProperty($code, $name = null, $scope = null)
  {
    $newCode = new QubitProperty;
    $newCode->setObjectId($this->getId());
    $newCode->setScope($scope);
    $newCode->setName($name);
    $newCode->setValue($code);
    $newCode->save();
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

public function setSubjectAccessPoint($subject)
  {
  // add the subject to term list (assuming it's a new subject)
  // TODO: check first to see if this term exists, in which case, just get its ID
  $newTerm = new QubitTerm;
  $newTerm->setTaxonomyId(QubitTaxonomy::SUBJECT_ID);
  $newTerm->setName($subject);
  $newTerm->save();

  // associate this new subject term with this information object
  $this->setTermRelation($newTerm->getId());
  }

public function getSubjectAccessPoints()
  {
  return $this->getTermRelations(QubitTaxonomy::SUBJECT_ID);
  }

public function getPlaceAccessPoints()
  {
  return $this->getTermRelations(QubitTaxonomy::PLACE_ID);
  }

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
}