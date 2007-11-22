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
      $repository = new Repository();

      //set the user navigation context to 'add'
      $this->getUser()->setAttribute('nav_context_module', 'add');
    }
    else
    {
      $repository = RepositoryPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($repository);
    }

    if ($repository->getActorId())
    {
    $actor = ActorPeer::retrieveByPk($repository->getActorId());
    }
    else
    {
    $actor = new Actor();
    }

    $repository->setId($this->getRequestParameter('id'));

    //save fields by template
    switch ($this->getRequestParameter('template'))
        {
        case 'anotherTemplate' :
          //save stuff
          break;
        //default template is 'ISAAR'
        case 'isaar' :
        default :
          $this->updateActor($repository, $actor);
          $this->updateRepositoryAttributes($repository);
          //$this->updateOtherNames($actor);
          $this->updateTermOneToManyRelationships($repository);
          $this->updateTermManyToManyRelationships($repository);
          $this->updateContactInformation($actor);
          $this->updateRepositoryNotes($repository);

          break;
        }


    //set view template
    switch ($this->getRequestParameter('template'))
      {
      case 'anotherTemplate' :
        return $this->redirect('repository/edit?id='.$repository->getId().'&template=editAnotherTemplate');
      //default template is ISIAH)
      case 'isiah' :
      default :
        return $this->redirect('repository/edit?id='.$repository->getId().'&template=editISIAH');
      }

  }

  public function updateActor($repository, $actor)
    {
    if ($this->getRequestParameter('actor_id'))
      {
      $repository->setActorId($this->getRequestParameter('actor_id'));
      $repository->save();
      }
    else if ($this->getRequestParameter('NewActorAuthorizedName'))
      {
      $actor->setAuthorizedFormOfName($this->getRequestParameter('NewActorAuthorizedName'));
      $actor->save();
      $actorId = $actor->getId();
      $repository->setActorId($actorId);
      $repository->save();
      }
    }

  public function updateRepositoryAttributes($repository)
  {
  $repository->setIdentifier($this->getRequestParameter('identifier'));
  $repository->setOfficersInCharge($this->getRequestParameter('officers_in_charge'));
  $repository->setGeoculturalContext($this->getRequestParameter('geocultural_context'));
  $repository->setCollectingPolicies($this->getRequestParameter('collecting_policies'));
  $repository->setBuildings($this->getRequestParameter('buildings'));
  $repository->setHoldings($this->getRequestParameter('holdings'));
  $repository->setFindingAids($this->getRequestParameter('finding_aids'));
  $repository->setOpeningTimes($this->getRequestParameter('opening_times'));
  $repository->setAccessConditions($this->getRequestParameter('access_conditions'));
  $repository->setDisabledAccess($this->getRequestParameter('disabled_access'));
  $repository->setTransport($this->getRequestParameter('transport'));
  $repository->setResearchServices($this->getRequestParameter('research_services'));
  $repository->setReproductionServices($this->getRequestParameter('reproduction_services'));
  $repository->setPublicFacilities($this->getRequestParameter('public_facilities'));
  $repository->setDescriptionIdentifier($this->getRequestParameter('description_identifier'));
  $repository->setInstitutionIdentifier($this->getRequestParameter('institution_identifier'));
  $repository->setRules($this->getRequestParameter('rules'));
  $repository->setSources($this->getRequestParameter('sources'));

  $repository->save();
  }

  public function updateTermOneToManyRelationships($repository)
    {
    if ($this->getRequestParameter('repository_type_id'))
      {
      $repository->setRepositoryTypeId($this->getRequestParameter('repository_type_id'));
      }
    else
      {
      $repository->setRepositoryTypeId(null);
      }

    if ($this->getRequestParameter('status_id'))
      {
      $repository->setStatusId($this->getRequestParameter('status_id'));
      }
      else
      {
      $repository->setStatusId(null);
      }

    if ($this->getRequestParameter('level_of_detail_id'))
      {
      $repository->setLevelOfDetailId($this->getRequestParameter('level_of_detail_id'));
      }
    else
      {
      $repository->setLevelOfDetailId(null);
      }

    $repository->save();
    }

  public function updateTermManyToManyRelationships($repository)
    {
    if ($this->getRequestParameter('language_id'))
      {
      $repository->setTermRelationship($termId = $this->getRequestParameter('language_id'), $relationshipTypeId = 63);
      }

    if ($this->getRequestParameter('script_id'))
      {
      $repository->setTermRelationship($termId = $this->getRequestParameter('script_id'), $relationshipTypeId = 64);
      }

    }


  public function updateContactInformation($actor)
    {
    if ($actor->getId())
      {
      if (($this->getRequestParameter('contact_type')) or
        ($this->getRequestParameter('street_address')) or
        ($this->getRequestParameter('city')) or
        ($this->getRequestParameter('region')) or
        ($this->getRequestParameter('country_id')) or
        ($this->getRequestParameter('postal_code')) or
        ($this->getRequestParameter('telephone')) or
        ($this->getRequestParameter('fax')) or
        ($this->getRequestParameter('email')) or
        ($this->getRequestParameter('website')))
        {
        $contactInformation = new ContactInformation();
        $contactInformation->setActorId($actor->getId());
        $contactInformation->setContactType($this->getRequestParameter('contact_type'));
        $contactInformation->setPrimaryContact($this->getRequestParameter('primary_contact'));
        $contactInformation->setStreetAddress($this->getRequestParameter('street_address'));
        $contactInformation->setCity($this->getRequestParameter('city'));
        $contactInformation->setRegion($this->getRequestParameter('region'));
        if ($this->getRequestParameter('country_id'))
          {
          $contactInformation->setCountryId($this->getRequestParameter('country_id'));
          }
        $contactInformation->setPostalCode($this->getRequestParameter('postal_code'));
        $contactInformation->setTelephone($this->getRequestParameter('telephone'));
        $contactInformation->setFax($this->getRequestParameter('fax'));
        $contactInformation->setEmail($this->getRequestParameter('email'));
        $contactInformation->setWebsite($this->getRequestParameter('website'));
        $contactInformation->setNote($this->getRequestParameter('contactInformationNote'));

        $contactInformation->save();

        if ($contactInformation->getPrimaryContact() == TRUE)
          {
          $contactInformation->makePrimaryContact();
          }
        }
      }
    }

  public function updateRepositoryNotes($repository)
    {
    if ($this->getRequestParameter('note'))
      {
      $repository->setRepositoryNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('note'), $this->getRequestParameter('note_type_id'));
      }
    }


  public function handleError()
  {
    // repository/validate/update.yml will throw error if actor_id is null
    // now check to see if user has entered a new actor name
    if ($this->getRequestParameter('NewActorAuthorizedName'))
      {
      $this->execute();
      }
    else
      {
      //TO DO: need to get 'fillin' via validation/update.yml working so that form doesn't lose values
      $this->forward('repository', 'create');
      }
   }

}
