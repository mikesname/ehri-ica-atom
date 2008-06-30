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

public static function getAllExceptUsers()
  {
    //returns all Actor objects except those that are
    //also an instance of the User class
    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitUser::ID, Criteria::LEFT_JOIN);
    $criteria->add(QubitUser::ID);

    return self::get($criteria);
  }

public static function getOnlyActors()
  {
    //returns only Actor objects, excluding those
    //that are an instance of the User or Repository class
    $criteria = new Criteria;
    $criteria->addJoin(QubitActor::ID, QubitUser::ID, Criteria::LEFT_JOIN);
    $criteria->add(QubitUser::ID);
    $criteria->addJoin(QubitActor::ID, QubitRepository::ID, Criteria::LEFT_JOIN);
    $criteria->add(QubitRepository::ID);

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
          $actorName = $actor->getAuthorizedFormOfName();
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

public function getDatesOfExistence()
  {
  $criteria = new Criteria;
  $criteria->add(QubitEvent::ACTOR_ID, $this->getId());
  $criteria->add(QubitEvent::TYPE_ID, QubitTerm::EXISTENCE_ID);
  $event = QubitEvent::getOne($criteria);

  return $event;
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

public function getInformationObjectRelations($roleType = 'all')
  {
  $criteria = new Criteria;
  $criteria->add(QubitEvent::ACTOR_ID, $this->getId());
  switch ($roleType)
    {
    case 'creator' :
      $criteria->add(QubitEvent::ACTOR_ROLE_ID, 344);
      break;
    }
  $criteria->addJoin(QubitEvent::INFORMATION_OBJECT_ID, QubitInformationObject::ID);
  $criteria->addGroupByColumn(QubitEvent::INFORMATION_OBJECT_ID);
  //$criteria->addAscendingOrderByColumn(QubitInformationObject:: );

  return QubitEvent::get($criteria);
  }
}
