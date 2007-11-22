<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class InformationObject extends BaseInformationObject
{

public function __toString()
  {

  return $this->getTitle();
  }

public function getLabel()
  {
  $label = $this->getLevelOfDescription();

  if ($this->getIdentifier())
    {
    $label .= ' '.$this->getIdentifier();
    }

  if ($label)
    {
    $label .= ': ';
    }

  $label .= $this->getTitle();

  return $label;
  }


//one-to-many Term relationships

public function getTermName($termId)
  {

  return TermPeer::retrieveByPk($termId);
  }

public function getLevelOfDescription()
  {

  return $this->getTermName($this->getLevelOfDescriptionId());
  }


public function setInformationObjectNote($userId, $note, $noteTypeId)
  {
  $newNote = new Note();
  $newNote->setInformationObjectId($this->getId());
  $newNote->setUserId($userId);
  $newNote->setNote($note);
  $newNote->setNoteTypeId($noteTypeId);
  $newNote->save();
  }

public function getInformationObjectNotes($noteTypeId = null, $excludeNoteTypeId = null)
  {
  $c = new Criteria();
  $c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);
  $c->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());
  if($noteTypeId)
    {
    $c->add(NotePeer::NOTE_TYPE_ID, $noteTypeId);
    }
  if($excludeNoteTypeId)
    {
    $c->add(NotePeer::NOTE_TYPE_ID, $excludeNoteTypeId, Criteria::NOT_EQUAL);
    }

  $notes = NotePeer::doSelect($c);
  $informationObjectNotes = array();

  foreach ($notes as $note)
    {
    $informationObjectNotes[] = array('noteId' => $note->getId(), 'note' => $note->getNote(), 'noteType' => $note->getTerm(), 'noteAuthor' => $note->getUser(), 'updated' => $note->getUpdatedAt());
    }

  return $informationObjectNotes;
  }


//Actor-Event Relationships
public function getActors($actorRoleTypeId)
  {
  $c = new Criteria();
  $c->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());
  $c->add(EventPeer::ACTOR_ROLE_ID, $actorRoleTypeId);
  $events = EventPeer::doSelect($c);

  $actors = array();
  foreach($events as $event)
    {
    $actors[] = $event->getActor();
    }

  return $actors;
  }

public function getCreators()
  {
  $c = new Criteria();
  $c->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());
  $c->add(EventPeer::ACTOR_ROLE_ID, 344);
  $c->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);
  $c->addGroupByColumn(EventPeer::ACTOR_ID);
  $c->addAscendingOrderByColumn(ActorPeer::AUTHORIZED_FORM_OF_NAME);
  $events = EventPeer::doSelect($c);

  $actors = array();
  foreach($events as $event)
    {
    $actors[] = $event->getActor();
    }

  return $actors;
  }

public function getCreationEvents()
  {
  $c = new Criteria();
  $c->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());
  $c->addDescendingOrderByColumn(EventPeer::START_DATE);
  $events = EventPeer::doSelect($c);

  $creationEvents = array();
  foreach($events as $event)
    {
    if(($event->getActorRoleId() == 344) or ($event->getEventTypeId() == 341))
      {
      $creationEvents[] = array('eventId' => $event->getId(), 'creatorId' => $event->getActorId(), 'creatorName' => $event->getActor(), 'dateDisplay' => $event->getDescription());
      }
    }

  return $creationEvents;
  }

public function getActorAccessPoints()
  {

  return null;
  }

public function getDates($eventType = 'creation')
  {
  $c = new Criteria();
  $c->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());
  switch ($eventType)
    {
    case 'creation' :
      $c->add(EventPeer::EVENT_TYPE_ID, 341);
      break;
    }
  $c->addDescendingOrderByColumn(EventPeer::START_DATE);
  $events = EventPeer::doSelect($c);

  $eventDates = array();
  foreach($events as $event)
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

//many-to-many Term Relationships

public function setTermRelationship($termId, $relationshipTypeId = NULL, $relationshipNote = NULL)
  {
  $newTermRelationship = new InformationObjectTermRelationship();
  $newTermRelationship->setTermId($termId);
  $newTermRelationship->setRelationshipTypeId($relationshipTypeId);
  $newTermRelationship->setRelationshipNote($relationshipNote);
  $newTermRelationship->setInformationObjectId($this->getId());
  $newTermRelationship->save();
  }

public function getTermRelationships($relationshipTypeId = 'all')
  {
  $c = new Criteria();
  $c->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

  if ($relationshipTypeId != 'all')
    {
    $c->add(InformationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $relationshipTypeId);
    }

  $relationships = InformationObjectTermRelationshipPeer::doSelect($c);
  $termRelationships = array();

  foreach ($relationships as $relationship)
    {
    $termRelationships[] = array('relationshipId' => $relationship->getId(), 'termId' => $relationship->getTermId(), 'termName' => $relationship->getTermRelatedByTermId());
    }

  return $termRelationships;
  }


public function getLanguages()
  {

  return $this->getTermRelationships($relationshipTypeId = 335);
  }

public function getScripts()
  {

  return $this->getTermRelationships($relationshipTypeId = 334);
  }

public function getSubjectAccessPoints()
  {

  return $this->getTermRelationships($relationshipTypeId = 336);
  }

public function getPlaceAccessPoints()
  {

  return $this->getTermRelationships($relationshipTypeId = 337);
  }



public function getMediaTypes()
  {
  //TO DO: get via linked digital objects & physical objects

  return null;
  }


public function getRepositoryLink()
  {
  $repositoryLink = null;

  if ($this->getRepositoryId())
    {
    $repositoryLink = array('repositoryName' => $this->getRepository(), 'repositoryId' => $this->getRepositoryId());
    }
  else
    {
    if($this->getTreeId())
      {
      foreach ($this->getPath() as $ancestorNode)
        {
        if ($ancestorNode->getRepositoryId())
          {
          $repositoryLink = array('repositoryName' => $ancestorNode->getRepository(), 'repositoryId' => $ancestorNode->getRepositoryId());
          break;
          }
        }
       }
     }

  return $repositoryLink;
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
       /*
       $creatorNameString .= $creator->getOtherNames().' ";
       */
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

public function getSubjectsString($c = null)
  {
  $subjectString = '';

  $subjects = $this->getSubjectAccessPoints();
  if($subjects)
    {
    foreach ($subjects as $subject)
      {
      $subjectString .= $subject.' ';
      }
    }

  $actorSubjects = $this->getActorAccessPoints();
  if($actorSubjects)
    {
    foreach ($actorSubjects as $subject)
      {
      $subjectString .= $subject.' ';
      }
    }

  return $subjectString;
  }


public function getInformationObjectPicklist()
  {
  //create hierarchy picklist
  $c = new Criteria();
  $c->addDescendingOrderByColumn(InformationObjectPeer::TREE_ID);
  $c->addAscendingOrderByColumn(InformationObjectPeer::TREE_LEFT_ID);
  $allInformationObjects = InformationObjectPeer::doSelect($c);
  $informationObjectPicklist = array();
  $informationObjectPicklist[null] = '';

  foreach ($allInformationObjects as $pickListOption)
   {
   if($pickListOption->getId() !== $this->getId())
      {
      $indent = '';
      for ($count=$pickListOption->getLevel(); $count>0; $count--)
        {
        $indent .= "--";
        }
      $informationObjectPicklist[$pickListOption->getId()] = $indent.$pickListOption->getLabel();
      }
    }

 return $informationObjectPicklist;

 }


 public function getParent()
  {
  if ($this->getTreeParentId())
    {
    $parent = InformationObjectPeer::retrieveByPk($this->getTreeParentId());
    }
  else
    {
    $parent = NULL;
    }

  return $parent;
  }


public function getHierarchyIndent()
  {
  $level = $this->getLevel();
  return (($level * 20) + $level);
  }

public function getCollection()
  {
  if ($this->getTreeId())
    {
    $c = new Criteria();
    $collection = InformationObjectPeer::retrieveByPk($this->getTreeId());

    return $collection->getTitle();
    }
   else
    {

    return '---';
    }
  }


}

//enable sfPropelActAsNestedSetBehaviorPlugin to allow for hierarchical relationships
$columns_map = array('left'   => InformationObjectPeer::TREE_LEFT_ID,
                           'right'  => InformationObjectPeer::TREE_RIGHT_ID,
                           'parent' => InformationObjectPeer::TREE_PARENT_ID,
                           'scope'  => InformationObjectPeer::TREE_ID);

      sfPropelBehavior::add('InformationObject', array('actasnestedset' => array('columns' => $columns_map)));
