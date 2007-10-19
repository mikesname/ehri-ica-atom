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

class updateAction extends sfAction
{
  public function execute()
  {

    if (!$this->getRequestParameter('id', 0))
    {
      $informationObject = new informationObject();

      $this->getUser()->setAttribute('nav_context_module', 'add');
    }
    else
    {
      $informationObject = informationObjectPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($informationObject);
    }

    $informationObject->setId($this->getRequestParameter('id'));
    $newCreationEvent = new Event();

    //save fields by template
    switch ($this->getRequestParameter('template'))
        {
        case 'anotherTemplate' :
          //save stuff
          break;
        //default template is 'ISAD'
        case 'isad' :
        default :
          $this->updateInformationObjectAttributes($informationObject);
          $this->updateInformationObjectNotes($informationObject);
          $this->updateOneToManyRelationships($informationObject);
          $this->updateTermManyToManyRelationships($informationObject);
          $this->updateHierarchicalRelationships($informationObject);
          $this->updateCreationEvent($informationObject, $newCreationEvent);
          //$this->updateRecursiveRelationships($informationObject);

          break;
        }

    //set collection type
    if ($this->getRequestParameter('collection_type_id'))
      {
      $informationObject->setCollectionTypeId($this->getRequestParameter('collection_type_id'));
      }
    else
      {
      //set default to 'archival material'
      $informationObject->setCollectionTypeId(325);
      }

    //update information object in the search index
    SearchIndex::updateIndexDocument($informationObject->getId());


    //set view template
    switch ($this->getRequestParameter('template'))
      {
      case 'anotherTemplate' :
        return $this->redirect('informationobject/edit?id='.$informationObject->getId().'&template=editAnotherTemplate');
        break;
      case 'isad' :
        return $this->redirect('informationobject/edit?id='.$informationObject->getId().'&template=isad');
        break;
      default :
        return $this->redirect('informationobject/edit?id='.$informationObject->getId());
      }

  }


  public function updateInformationObjectAttributes($informationObject)
  {
  $informationObject->setTitle($this->getRequestParameter('title'));
  $informationObject->setAlternateTitle($this->getRequestParameter('alternate_title'));
  $informationObject->setIdentifier($this->getRequestParameter('identifier'));
  $informationObject->setVersion($this->getRequestParameter('version'));
  $informationObject->setExtentAndMedium($this->getRequestParameter('extent_and_medium'));
  $informationObject->setArchivalHistory($this->getRequestParameter('archival_history'));
  $informationObject->setAcquisition($this->getRequestParameter('acquisition'));
  $informationObject->setScopeAndContent($this->getRequestParameter('scope_and_content'));
  $informationObject->setAppraisal($this->getRequestParameter('appraisal'));
  $informationObject->setAccruals($this->getRequestParameter('accruals'));
  $informationObject->setArrangement($this->getRequestParameter('arrangement'));
  $informationObject->setAccessConditions($this->getRequestParameter('access_conditions'));
  $informationObject->setReproductionConditions($this->getRequestParameter('reproduction_conditions'));
  $informationObject->setPhysicalCharacteristics($this->getRequestParameter('physical_characteristics'));
  $informationObject->setFindingAids($this->getRequestParameter('finding_aids'));
  $informationObject->setLocationOfOriginals($this->getRequestParameter('location_of_originals'));
  $informationObject->setLocationOfCopies($this->getRequestParameter('location_of_copies'));
  $informationObject->setRelatedUnitsOfDescription($this->getRequestParameter('related_units_of_description'));
  $informationObject->setRules($this->getRequestParameter('rules'));

  $informationObject->save();
  }

  public function updateInformationObjectNotes($informationObject)
    {
    if ($this->getRequestParameter('new_title_note'))
      {
      $informationObject->setInformationObjectNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('new_title_note'), 317);
      }

     if ($this->getRequestParameter('note'))
      {
      $informationObject->setInformationObjectNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('note'), $this->getRequestParameter('note_type_id'));
      }

    }

  public function updateOneToManyRelationships($informationObject)
    {
    if ($this->getRequestParameter('level_of_description_id'))
      {
      $informationObject->setLevelOfDescriptionId($this->getRequestParameter('level_of_description_id'));
      }

    if ($this->getRequestParameter('repository_id'))
      {
      $informationObject->setRepositoryId($this->getRequestParameter('repository_id'));
      }

    $informationObject->save();
    }

  public function updateTermManyToManyRelationships($informationObject)
    {
    if ($this->getRequestParameter('language_id'))
      {
      $informationObject->setTermRelationship($this->getRequestParameter('language_id'), $relationshipTypeId = 335);
      }

    if ($this->getRequestParameter('script_id'))
      {
      $informationObject->setTermRelationship($this->getRequestParameter('script_id'), $relationshipTypeId = 334);
      }

    if ($this->getRequestParameter('subject_id'))
      {
      $informationObject->setTermRelationship($this->getRequestParameter('subject_id'), $relationshipTypeId = 336);
      }

    if ($this->getRequestParameter('place_id'))
      {
      $informationObject->setTermRelationship($this->getRequestParameter('place_id'), $relationshipTypeId = 337);
      }

    $informationObject->save();
    }

  public function updateHierarchicalRelationships($informationObject)
    {
    //save parent hierarchical relationship
    if ($this->getRequestParameter('parent_id'))
      {
      $parentId = $this->getRequestParameter('parent_id');
      $parent = informationObjectPeer::retrieveByPk($parentId);

      //is parent already in a hierarchical relationship? If false, make it a root node first
      if (!$parent->getTreeId())
        {
        $parent->makeRoot();
        $parent->setTreeId($parent->getId());
        $parent->save();
        }

      //add node
      $informationObject->insertAsLastChildOf($parent);
      $informationObject->setTreeId($parent->getTreeId());

      //save the new child node
      $informationObject->save();

      //reload parent to update left/right values
      $parent->reload();
      }

    }


  public function updateCreationEvent($informationObject, $newCreationEvent)
    {
    //add creator
    if ($this->getRequestParameter('actor_id'))
      {
      $newCreationEvent->setActorId($this->getRequestParameter('actor_id'));
      $newCreationEvent->setInformationObjectId($informationObject->getId());
      $newCreationEvent->setActorRoleId(344);
      $newCreationEvent->save();
      }
    elseif ($this->getRequestParameter('newActorAuthorizedName'))
      {
      $actor = new Actor();
      $actor->setAuthorizedFormOfName($this->getRequestParameter('newActorAuthorizedName'));
      $actor->save();
      $newCreationEvent->setActorId($actor->getId());
      $newCreationEvent->setInformationObjectId($informationObject->getId());
      $newCreationEvent->setActorRoleId(344);
      $newCreationEvent->save();
      }

    //add creation event date/date range
    if (($this->getRequestParameter('creationYear')) or ($this->getRequestParameter('newCreationDateNote')))
      {
      $newCreationEvent->setEventTypeId(341);
      $newCreationEvent->setInformationObjectId($informationObject->getId());
      $newCreationEvent->setStartDate($this->getRequestParameter('creationYear').'-01-01');
      $newCreationEvent->setEndDate($this->getRequestParameter('endYear').'-01-01');

      if ($this->getRequestParameter('newCreationDateNote'))
        {
        $newCreationEvent->setDescription($this->getRequestParameter('newCreationDateNote'));
        }
      else
        {
        $dateString = $this->getRequestParameter('creationYear');
        if ($this->getRequestParameter('endYear'))
          {
          $dateString .= ' - '.$this->getRequestParameter('endYear');
          }
        $newCreationEvent->setDescription($dateString);
        }

      $newCreationEvent->save();
      }

    }

}