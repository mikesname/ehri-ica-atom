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

class Actor extends BaseActor
{

public function __toString()
  {

  return $this->getAuthorizedFormOfName();
  }

public function getOtherNames()
  {
  $c = new Criteria();
  $c->addJoin(actorNamePeer::NAME_TYPE_ID, TermPeer::ID);
  $c->add(actorNamePeer::ACTOR_ID, $this->getId());

  $names = actorNamePeer::doSelect($c);
  $otherNames = array();

  foreach ($names as $name)
    {
    $otherNames[] = array('id' => $name->getId(), 'name' => $name->getName(), 'nameType' => $name->getTerm(), 'note' => $name->getNameNote());
    }

  return $otherNames;
  }

public function setOtherNames($otherName, $nameTypeId, $nameNote)
  {
  $newName = new actorName();
  $newName->setActorId($this->getId());
  $newName->setName($otherName);
  $newName->setNameTypeId($nameTypeId);
  $newName->setNameNote($nameNote);
  $newName->save();
  }

public function setActorNote($userId, $note, $noteTypeId)
  {
  $newNote = new Note();
  $newNote->setActorId($this->getId());
  $newNote->setUserId($userId);
  $newNote->setNote($note);
  $newNote->setNoteTypeId($noteTypeId);
  $newNote->save();
  }

public function getActorNotes()
  {
  $c = new Criteria();
  $c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);
  $c->add(NotePeer::ACTOR_ID, $this->getId());

  $notes = NotePeer::doSelect($c);
  $actorNotes = array();

  foreach ($notes as $note)
    {
    $actorNotes[] = array('noteId' => $note->getId(), 'note' => $note->getNote(), 'noteType' => $note->getTerm(), 'noteAuthor' => $note->getUser(), 'updated' => $note->getUpdatedAt());
    }

  return $actorNotes;
  }

public function getContactInformation()
  {
  $c = new Criteria();
  $c->add(contactInformationPeer::ACTOR_ID, $this->getId());
  $c->addDescendingOrderByColumn(contactInformationPeer::PRIMARY_CONTACT);
  $contactInformation = contactInformationPeer::doSelect($c);

  return $contactInformation;
  }

public function getPrimaryContact()
  {
  $c = new Criteria();
  $c->add(contactInformationPeer::ACTOR_ID, $this->getId());
  $c->add(contactInformationPeer::PRIMARY_CONTACT, true);
  $primaryContact = contactInformationPeer::doSelectOne($c);

  if ($primaryContact)
    {
    return $primaryContact;
    }
  else
    {
    $c = new Criteria();
    $c->add(contactInformationPeer::ACTOR_ID, $this->getId());

    return contactInformationPeer::doSelectOne($c);
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


//one-to-many Term relationships

public function getTermName($termId)
  {

  return TermPeer::retrieveByPk($termId);
  }

public function getTypeOfEntity()
  {

  return $this->getTermName($this->getTypeOfEntityId());
  }

public function getStatus()
  {

  return $this->getTermName($this->getStatusId());
  }

public function getLevelOfDetail()
  {

  return $this->getTermName($this->getLevelOfDetailId());
  }


//many-to-many Term Relationships

public function setTermRelationship($termId, $relationshipTypeId = NULL, $relationshipNote = NULL)
  {
  $newTermRelationship = new actorTermRelationship();
  $newTermRelationship->setTermId($termId);
  $newTermRelationship->setRelationshipTypeId($relationshipTypeId);
  $newTermRelationship->setRelationshipNote($relationshipNote);
  $newTermRelationship->setActorId($this->getId());
  $newTermRelationship->save();
  }


public function getTermRelationships($relationshipTypeId = 'all')
  {
  $c = new Criteria();
  $c->add(actorTermRelationshipPeer::ACTOR_ID, $this->getId());

  if ($relationshipTypeId != 'all')
    {
    $c->add(actorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $relationshipTypeId);
    }

  $relationships = actorTermRelationshipPeer::doSelect($c);
  $termRelationships = array();

  foreach ($relationships as $relationship)
    {
    $termRelationships[] = array('relationshipId' => $relationship->getId(), 'termName' => $relationship->getTermRelatedByTermId());
    }

  return $termRelationships;
  }

public function getLanguages()
  {

  return $this->getTermRelationships($relationshipTypeId = 19);
  }

public function getScripts()
  {

  return $this->getTermRelationships($relationshipTypeId = 20);
  }

public function getDatesOfExistence()
  {
  $c = new Criteria();
  $c->add(EventPeer::ACTOR_ID, $this->getId());
  $c->add(EventPeer::EVENT_TYPE_ID, 352);
  $event = EventPeer::doSelectOne($c);

  return $event;
  }

public function getDatesOfChanges()
  {
  //TO DO

  return NULL;
  }

public function getPlaces()
  {
  //TO DO

  return NULL;
  }

public function getRelatedActors()
  {
  //TO DO

  return NULL;
  }

public function getInformationObjectRelationships($roleType = 'all')
  {
  $c = new Criteria();
  $c->add(EventPeer::ACTOR_ID, $this->getId());
  switch ($roleType)
    {
    case 'creator' :
      $c->add(EventPeer::ACTOR_ROLE_ID, 344);
      break;
    }
  $c->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);
  $c->addGroupByColumn(EventPeer::INFORMATION_OBJECT_ID);
  //$c->addAscendingOrderByColumn(InformationObjectPeer:: );
  $events = EventPeer::doSelect($c);

  $informationObjectRelationships = array();
  foreach($events as $event)
    {
    $informationObjectRelationships[] = array('eventId' => $event->getId(), 'actorRole' => $event->getTermRelatedByActorRoleId(), 'informationObjectId' => $event->getInformationObjectId(), 'informationObject' => $event->getInformationObject());
    }

  return $informationObjectRelationships;
  }


}


//enable sfPropelActAsNestedSetBehaviorPlugin to allow for hierarchical relationships
$columns_map = array('left'   => ActorPeer::TREE_LEFT_ID,
                           'right'  => ActorPeer::TREE_RIGHT_ID,
                           'parent' => ActorPeer::TREE_PARENT_ID,
                           'scope'  => ActorPeer::TREE_ID);

      sfPropelBehavior::add('Actor', array('actasnestedset' => array('columns' => $columns_map)));
