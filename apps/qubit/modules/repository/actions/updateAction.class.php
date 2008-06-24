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

class RepositoryUpdateAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $repository = new QubitRepository;

      //set the user navigation context to 'add'
      $this->getUser()->setAttribute('nav_context_module', 'add');
    }
    else
    {
      $repository = QubitRepository::getById($this->getRequestParameter('id'));
      $this->forward404Unless($repository);
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
          $this->updateActorAttributes($repository);
          $this->updateRepositoryAttributes($repository);
          $this->updateOtherNames($repository);
          $this->updateTermOneToManyRelations($repository);
          $this->updateProperties($repository);
          $this->updateContactInformation($repository);
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

  public function updateActorAttributes($repository)
    {
      $repository->setAuthorizedFormOfName($this->getRequestParameter('authorized_form_of_name'));
      $repository->setHistory($this->getRequestParameter('history'));
      $repository->setMandates($this->getRequestParameter('mandates'));
      $repository->setInternalStructures($this->getRequestParameter('internal_structures'));
      $repository->save();
    }

  public function updateRepositoryAttributes($repository)
  {
  $repository->setIdentifier($this->getRequestParameter('identifier'));
  $repository->setGeoculturalContext($this->getRequestParameter('geocultural_context'));
  $repository->setCollectingPolicies($this->getRequestParameter('collecting_policies'));
  $repository->setBuildings($this->getRequestParameter('buildings'));
  $repository->setHoldings($this->getRequestParameter('holdings'));
  $repository->setFindingAids($this->getRequestParameter('finding_aids'));
  $repository->setOpeningTimes($this->getRequestParameter('opening_times'));
  $repository->setAccessConditions($this->getRequestParameter('access_conditions'));
  $repository->setDisabledAccess($this->getRequestParameter('disabled_access'));
  $repository->setResearchServices($this->getRequestParameter('research_services'));
  $repository->setReproductionServices($this->getRequestParameter('reproduction_services'));
  $repository->setPublicFacilities($this->getRequestParameter('public_facilities'));
  $repository->setDescIdentifier($this->getRequestParameter('desc_identifier'));
  $repository->setDescInstitutionIdentifier($this->getRequestParameter('desc_institution_identifier'));
  $repository->setDescRules($this->getRequestParameter('desc_rules'));
  $repository->setDescSources($this->getRequestParameter('desc_sources'));
  $repository->setDescRevisionHistory($this->getRequestParameter('desc_revision_history'));

  $repository->save();
  }

  public function updateTermOneToManyRelations($repository)
    {
    if ($this->getRequestParameter('type_id'))
      {
      $repository->setTypeId($this->getRequestParameter('type_id'));
      }
    else
      {
      $repository->setTypeId(null);
      }

    if ($this->getRequestParameter('desc_status_id'))
      {
      $repository->setDescStatusId($this->getRequestParameter('desc_status_id'));
      }
      else
      {
      $repository->setDescStatusId(null);
      }

    if ($this->getRequestParameter('desc_detail_id'))
      {
      $repository->setDescDetailId($this->getRequestParameter('desc_detail_id'));
      }
    else
      {
      $repository->setDescDetailId(null);
      }

    $repository->save();
    }

  public function updateProperties($repository)
    {
      if ($this->getRequestParameter('language_code'))
        {
          $repository->setProperty($this->getRequestParameter('language_code'), $name = 'language_of_repository_description', $scope = 'languages');
        }

      if ($this->getRequestParameter('script_code'))
        {
           $repository->setProperty($this->getRequestParameter('script_code'), $name = 'script_of_repository_description', $scope = 'scripts');
        }
    }

  public function updateOtherNames($repository)
    {
    if ($this->getRequestParameter('other_name'))
      {
      $repository->setOtherNames($this->getRequestParameter('other_name'), $this->getRequestParameter('other_name_type_id'), $this->getRequestParameter('other_name_note'));
      }
    }

  public function updateContactInformation($repository)
    {
    if ($repository->getId())
      {
      if (($this->getRequestParameter('contact_type')) or
        ($this->getRequestParameter('contact_person')) or
        ($this->getRequestParameter('street_address')) or
        ($this->getRequestParameter('city')) or
        ($this->getRequestParameter('region')) or
        ($this->getRequestParameter('country_code')) or
        ($this->getRequestParameter('postal_code')) or
        ($this->getRequestParameter('telephone')) or
        ($this->getRequestParameter('fax')) or
        ($this->getRequestParameter('email')) or
        ($this->getRequestParameter('website')))
        {
        $contactInformation = new QubitContactInformation;
        $contactInformation->setActorId($repository->getId());
        $contactInformation->setContactType($this->getRequestParameter('contact_type'));
        $contactInformation->setPrimaryContact($this->getRequestParameter('primary_contact'));
        $contactInformation->setContactPerson($this->getRequestParameter('contact_person'));
        $contactInformation->setStreetAddress($this->getRequestParameter('street_address'));
        $contactInformation->setCity($this->getRequestParameter('city'));
        $contactInformation->setRegion($this->getRequestParameter('region'));
        $contactInformation->setCountryCode($this->getRequestParameter('country_code'));
        $contactInformation->setPostalCode($this->getRequestParameter('postal_code'));
        $contactInformation->setTelephone($this->getRequestParameter('telephone'));
        $contactInformation->setFax($this->getRequestParameter('fax'));
        $contactInformation->setEmail($this->getRequestParameter('email'));
        $contactInformation->setWebsite($this->getRequestParameter('website'));
        $contactInformation->setNote($this->getRequestParameter('contact_information_note'));

        $contactInformation->save();

        if ($contactInformation->getPrimaryContact())
          {
          $contactInformation->makePrimaryContact();
          }
        }
      }
    }

  public function updateRepositoryNotes($repository)
    {
    if ($this->getRequestParameter('content'))
      {
      $repository->setRepositoryNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('content'), $this->getRequestParameter('note_type_id'));
      }
    }
}
