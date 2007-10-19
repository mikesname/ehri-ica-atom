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

require_once 'lib/model/om/BaseRepository.php';

class Repository extends BaseRepository {

public function __toString()
{
  return (string) $this->getActor()->getAuthorizedFormOfName();
}

//many-to-many Term Relationships

public function setTermRelationship($termId, $relationshipTypeId = NULL, $relationshipNote = NULL)
  {
  $newTermRelationship = new repositoryTermRelationship();
  $newTermRelationship->setTermId($termId);
  $newTermRelationship->setRelationshipTypeId($relationshipTypeId);
  $newTermRelationship->setRelationshipNote($relationshipNote);
  $newTermRelationship->setRepositoryId($this->getId());
  $newTermRelationship->save();
  }

public function getTermRelationships($relationshipTypeId = 'all')
  {
  $c = new Criteria();
  $c->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

  if ($relationshipTypeId != 'all')
    {
    $c->add(repositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $relationshipTypeId);
    }

  $relationships = repositoryTermRelationshipPeer::doSelect($c);
  $termRelationships = array();

  foreach ($relationships as $relationship)
    {
    $termRelationships[] = array('relationshipId' => $relationship->getId(), 'termName' => $relationship->getTermRelatedByTermId());
    }

  return $termRelationships;
  }

public function getLanguages()
  {

  return $this->getTermRelationships($relationshipTypeId = 63);
  }

public function getScripts()
  {

  return $this->getTermRelationships($relationshipTypeId = 64);
  }

public function setRepositoryNote($userId, $note, $noteTypeId)
  {
  $newNote = new Note();
  $newNote->setRepositoryId($this->getId());
  $newNote->setUserId($userId);
  $newNote->setNote($note);
  $newNote->setNoteTypeId($noteTypeId);
  $newNote->save();
  }

public function getRepositoryNotes()
  {
  $c = new Criteria();
  $c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);
  $c->add(NotePeer::REPOSITORY_ID, $this->getId());

  $notes = NotePeer::doSelect($c);
  $repositoryNotes = array();

  foreach ($notes as $note)
    {
    $repositoryNotes[] = array('noteId' => $note->getId(), 'note' => $note->getNote(), 'noteType' => $note->getTerm(), 'noteAuthor' => $note->getUser(), 'updated' => $note->getUpdatedAt());
    }

  return $repositoryNotes;
  }

public function getCountry()
  {
  $actor = ActorPeer::retrieveByPk($this->getActorId());

  $country = null;

  if ($actor->getPrimaryContact())
    {
    $country = $actor->getPrimaryContact()->getCountry();
    }

  return $country;
  }

public function getRepositoryHoldings()
{
  $c = new Criteria();
  $c->add(informationObjectPeer::REPOSITORY_ID, $this->getId());
  $c->add(informationObjectPeer::TREE_PARENT_ID, null, Criteria::ISNULL);
  $c->addAscendingOrderByColumn(informationObjectPeer::TITLE);
  $holdings = informationObjectPeer::doSelect($c);

  return $holdings;
}

} // Repository
