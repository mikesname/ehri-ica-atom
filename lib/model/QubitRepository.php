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

class QubitRepository extends BaseRepository
{
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

public function setRepositoryNote($userId, $note, $noteTypeId)
  {
    $newNote = new QubitNote;
    $newNote->setObjectId($this->getId());
    $newNote->setScope('QubitRepository');
    $newNote->setUserId($userId);
    $newNote->setContent($note);
    $newNote->setTypeId($noteTypeId);
    $newNote->save();
  }

public function getRepositoryNotes()
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    $criteria->add(QubitNote::SCOPE, 'QubitRepository');
    QubitNote::addOrderByPreorder($criteria);

    return QubitNote::get($criteria);
  }

public function getCountry()
  {
  return format_country($this->getPrimaryContact()->getCountryCode());
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

public function getRepositoryHoldings()
  {
    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::REPOSITORY_ID, $this->getId());
    $holdings = QubitInformationObject::get($criteria);

    return $holdings;
  }

public static function getRepositories($sort=null, $countryId=null)
  {
    $criteria = new Criteria;

    //Establish sort order
    switch($sort)
      {
      case 'idDown' :
        $criteria->addDescendingOrderByColumn(self::ID);
        break;
      case 'idUp' :
        $criteria->addAscendingOrderByColumn(self::ID);
        break;
      case 'nameDown' :
//      $criteria->addDescendingOrderByColumn(ActorI18n::AUTHORIZED_FORM_OF_NAME);
        break;
      default :
        case 'nameUp' :
//      $criteria->addAscendingOrderByColumn(ActorI18n::AUTHORIZED_FORM_OF_NAME);
        break;
      }

    return QubitRepository::get($criteria);
  }
}
