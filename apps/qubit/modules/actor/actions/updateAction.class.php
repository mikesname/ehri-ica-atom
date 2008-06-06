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

class ActorUpdateAction extends sfAction
{
  public function execute($request)
  {
  if (!$this->getRequestParameter('id', 0))
    {
    $actor = new QubitActor;

    //set the user navigation context to 'add'
    $this->getUser()->setAttribute('nav_context_module', 'add');
    }
   else
    {
    $actor = QubitActor::getById($this->getRequestParameter('id'));
    $this->forward404Unless($actor);
    }

    $actor->setId($this->getRequestParameter('id'));

    if ($this->getRequestParameter('dateId'))
      {
      $date = QubitEvent::getById($this->getRequestParameter('dateId'));
      }
    else
      {
      $date = new QubitEvent;
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
          $this->updateTermOneToManyRelations($actor);
          $this->updateProperties($actor);
//          $this->updateObjectTermRelations($actor);
          $this->updateDates($actor, $date);
          $this->updateActorNotes($actor);
          //$this->updateInformationObjectRelations($actor);
          //$this->updateRecursiveRelations($actor);
          //$this->updateContactInformation($actor);

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
  $actor->setCorporateBodyIdentifiers($this->getRequestParameter('corporate_body_identifiers'));
  $actor->setHistory($this->getRequestParameter('history'));
  $actor->setPlaces($this->getRequestParameter('places'));
  $actor->setLegalStatus($this->getRequestParameter('legal_status'));
  $actor->setFunctions($this->getRequestParameter('functions'));
  $actor->setMandates($this->getRequestParameter('mandates'));
  $actor->setInternalStructures($this->getRequestParameter('internal_structures'));
  $actor->setGeneralContext($this->getRequestParameter('general_context'));
  $actor->setDescriptionIdentifier($this->getRequestParameter('description_identifier'));
  $actor->setInstitutionResponsibleIdentifier($this->getRequestParameter('institution_responsible_identifier'));
  $actor->setRules($this->getRequestParameter('rules'));
  $actor->setSources($this->getRequestParameter('sources'));
  $actor->setRevisionHistory($this->getRequestParameter('revision_history'));

  $actor->save();
  }

  public function updateOtherNames($actor)
    {
    if ($this->getRequestParameter('name'))
      {
      $actor->setOtherNames($this->getRequestParameter('name'), $this->getRequestParameter('type_id'), $this->getRequestParameter('note'));
      }
    }

  public function updateActorNotes($actor)
    {
    if ($this->getRequestParameter('content'))
      {
      $actor->setActorNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('content'), $this->getRequestParameter('note_type_id'));
      }
    }

  public function updateTermOneToManyRelations($actor)
    {
    if ($this->getRequestParameter('entity_type_id'))
      {
      $actor->setEntityTypeId($this->getRequestParameter('entity_type_id'));
      }
    else
      {
      $actor->setEntityTypeId(null);
      }

    if ($this->getRequestParameter('description_status_id'))
      {
      $actor->setDescriptionStatusId($this->getRequestParameter('description_status_id'));
      }
      else
      {
      $actor->setDescriptionStatusId(null);
      }

    if ($this->getRequestParameter('description_detail_id'))
      {
      $actor->setDescriptionDetailId($this->getRequestParameter('description_detail_id'));
      }
    else
      {
      $actor->setDescriptionDetailId(null);
      }

    $actor->save();
    }

  public function updateProperties($actor)
    {
      if ($this->getRequestParameter('language_code'))
        {
          $actor->setProperty($this->getRequestParameter('language_code'), $name = 'language_of_actor_description', $scope = 'languages');
        }

      if ($this->getRequestParameter('script_code'))
        {
           $actor->setProperty($this->getRequestParameter('script_code'), $name = 'script_of_actor_description', $scope = 'scripts');
        }
    }

  public function updateObjectTermRelations($actor)
    {
    }

  public function updateEventRelations($actor)
    {
    //used to be updateInformationObjectRelations - TO DO: update to handle relations via Event object

    if ($this->getRequestParameter('informationObjectId'))
      {
      if ($this->getRequestParameter('actor_role_id'))
        {
        $actorRoleId = $this->getRequestParameter('actor_role_id');
        }
      else
        {
        //default role is Creator
        $actorRoleId = QubitTerm::EXISTENCE_ID;
        }

      $actor->addInformationObjectRelation($this->getRequestParameter('informationObjectId'), $actorRoleId,$this->getRequestParameter('relation_dates'));

      SearchIndex::updateIndexDocument($this->getRequestParameter('informationObjectId'));
      }
    }

  public function updateDates($actor, $date)
    {
     if (($this->getRequestParameter('start_date')) or ($this->getRequestParameter('description')))
      {
      $date->setTypeId(QubitTerm::EXISTENCE_ID);
      $date->setActorId($actor->getId());
      $date->setStartDate($this->getRequestParameter('start_date').'-01-01');
      if ($this->getRequestParameter('end_date') == '')
        {
          $date->setEndDate(null);
        }
      else
        {
          $date->setEndDate($this->getRequestParameter('end_date').'-01-01');
        }
      if ($this->getRequestParameter('description'))
        {
        $date->setDescription($this->getRequestParameter('description'));
        }
      else
        {
        $dateString = $this->getRequestParameter('start_date');
        if ($this->getRequestParameter('end_date'))
          {
            $dateString .= ' - '.$this->getRequestParameter('end_date');
          }
        $date->setDescription($dateString);
        }

      $date->save();
      }
    }
}
