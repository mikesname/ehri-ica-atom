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
    $actor = new Actor();

    //set the user navigation context to 'add'
    $this->getUser()->setAttribute('nav_context_module', 'add');
    }
   else
    {
    $actor = ActorPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($actor);
    }

    $actor->setId($this->getRequestParameter('id'));

    if ($this->getRequestParameter('dateId'))
      {
      $date = EventPeer::retrieveByPK($this->getRequestParameter('dateId'));
      }
    else
      {
      $date = new Event();
      }

    //save fields by template
    switch ($this->getRequestParameter('template'))
        {
        case 'anotherTemplate' :
          //save stuff
          break;
        //default template is 'ISAAR'
        case 'isaar' :
        default :
          $this->updateActorAttributes($actor);
          $this->updateOtherNames($actor);
          $this->updateTermOneToManyRelationships($actor);
          $this->updateTermManyToManyRelationships($actor);
          //$this->updateContactInformation($actor);
          $this->updateDates($actor, $date);
          //$this->updateInformationObjectRelationships($actor);
          $this->updateActorNotes($actor);
          //$this->updateRecursiveRelationships($actor);

          break;
        }

  //set redirect if actor edit was called from another module
    if ($this->getRequestParameter('repositoryReroute'))
      {
      return $this->redirect('repository/edit?id='.$this->getRequestParameter('repositoryReroute'));
      }

    if ($this->getRequestParameter('informationObjectReroute'))
      {
      return $this->redirect('informationobject/edit?id='.$this->getRequestParameter('informationObjectReroute'));
      }



    //set view template
    switch ($this->getRequestParameter('template'))
      {
      case 'anotherTemplate' :
        return $this->redirect('actor/edit?id='.$actor->getId().'&template=editAnotherTemplate');
      //default template is ISAAR)
      case 'isaar' :
        return $this->redirect('actor/edit?id='.$actor->getId().'&template=isaar');
      default :
        return $this->redirect('actor/edit?id='.$actor->getId());

      }

  } //close execute()


  public function updateActorAttributes($actor)
  {
  $actor->setAuthorizedFormOfName($this->getRequestParameter('authorized_form_of_name'));
  $actor->setIdentifiers($this->getRequestParameter('identifiers'));
  $actor->setHistory($this->getRequestParameter('history'));
  $actor->setLegalStatus($this->getRequestParameter('legal_status'));
  $actor->setFunctions($this->getRequestParameter('functions'));
  $actor->setMandates($this->getRequestParameter('mandates'));
  $actor->setInternalStructures($this->getRequestParameter('internal_structures'));
  $actor->setGeneralContext($this->getRequestParameter('general_context'));
  $actor->setAuthorityRecordIdentifier($this->getRequestParameter('authority_record_identifier'));
  $actor->setInstitutionIdentifier($this->getRequestParameter('institution_identifier'));
  $actor->setRules($this->getRequestParameter('rules'));
  $actor->setSources($this->getRequestParameter('sources'));

  $actor->save();
  }

  public function updateOtherNames($actor)
    {
    if ($this->getRequestParameter('name'))
      {
      $actor->setOtherNames($this->getRequestParameter('name'), $this->getRequestParameter('name_type_id'), $this->getRequestParameter('name_note'));
      }
    }

  public function updateActorNotes($actor)
    {
    if ($this->getRequestParameter('note'))
      {
      $actor->setActorNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('note'), $this->getRequestParameter('note_type_id'));
      }
    }

  public function updateTermOneToManyRelationships($actor)
    {
    if ($this->getRequestParameter('type_of_entity_id'))
      {
      $actor->setTypeOfEntityId($this->getRequestParameter('type_of_entity_id'));
      }
    else
      {
      $actor->setTypeofEntityId(null);
      }

    if ($this->getRequestParameter('status_id'))
      {
      $actor->setStatusId($this->getRequestParameter('status_id'));
      }
      else
      {
      $actor->setStatusId(null);
      }

    if ($this->getRequestParameter('level_of_detail_id'))
      {
      $actor->setLevelOfDetailId($this->getRequestParameter('level_of_detail_id'));
      }
    else
      {
      $actor->setLevelOfDetailId(null);
      }

    $actor->save();
    }

  public function updateTermManyToManyRelationships($actor)
    {
    if ($this->getRequestParameter('language_id'))
      {
      $actor->setTermRelationship($termId = $this->getRequestParameter('language_id'), $relationshipTypeId = 19);
      }

    if ($this->getRequestParameter('script_id'))
      {
      $actor->setTermRelationship($termId = $this->getRequestParameter('script_id'), $relationshipTypeId = 20);
      }

    }

  public function updateEventRelationships($actor)
    {
    //used to be updateInformationObjectRelationships - TO DO: update to handle relationships via Event object


    if ($this->getRequestParameter('informationObjectId'))
      {
      if ($this->getRequestParameter('actor_role_id'))
        {
        $actorRoleId = $this->getRequestParameter('actor_role_id');
        }
      else
        {
        //default role is Creator
        $actorRoleId = 379;
        }

      $actor->addInformationObjectRelationship($this->getRequestParameter('informationObjectId'), $actorRoleId,$this->getRequestParameter('relationship_dates'));

      SearchIndex::updateIndexDocument($this->getRequestParameter('informationObjectId'));
      }
    }

  public function updateDates($actor, $date)
    {
     if (($this->getRequestParameter('start_date')) or ($this->getRequestParameter('description')))
      {
      $date->setEventTypeId(352);
      $date->setActorId($actor->getId());
      $date->setStartDate($this->getRequestParameter('start_date').'-01-01');
      $date->setEndDate($this->getRequestParameter('end_date').'-01-01');

      if ($this->getRequestParameter('description'))
        {
        $date->setDescription($this->getRequestParameter('description'));
        }
      else
        {
        $dateString = $this->getRequestParameter('start_date');
        $dateString .= ' - '.$this->getRequestParameter('end_date');
        $date->setDescription($dateString);
        }

      $date->save();
      }
    }


}
