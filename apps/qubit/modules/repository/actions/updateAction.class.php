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

/**
 * Controller for updating a Repository.
 *
 * @package    qubit
 * @subpackage repository
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class RepositoryUpdateAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $this->repository = new QubitRepository;

      //set the user navigation context to 'add'
      $this->getUser()->setAttribute('nav_context_module', 'add');
    }
    else
    {
      $this->repository = QubitRepository::getById($this->getRequestParameter('id'));
      $this->forward404Unless($this->repository);
    }

    $this->repository->setId($this->getRequestParameter('id'));

    $this->updateActorAttributes($this->repository);
    $this->updateRepositoryAttributes($this->repository);
    $this->updateOtherNames($this->repository);
    $this->updateTermOneToManyRelations($this->repository);
    $this->updateProperties($this->repository);
    $this->updateContactInformation($this->repository);
    $this->updateRepositoryNotes($this->repository);

    if (sfContext::getInstance()->getActionName() == 'update')
    {
      // update the search index and return user to the default edit template
      // in case this is a generic 'update' action that is not associated with
      // a specific template (e.g. updateISDIAH)
      //
      // update the search index for those informationObjects that are linked to this Repository
      if (count($holdings = $this->repository->getRepositoryHoldings()) > 0)
      {
        foreach ($holdings as $informationObject)
        {
          SearchIndex::updateTranslatedLanguages($informationObject);
        }
      }

      // return to edit template
      return $this->redirect(array('module' => 'repository', 'action' => 'edit', 'id' => $this->repository->getId()));
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
    // Add multiple languages of repository description
    if ($language_codes = $this->getRequestParameter('language_code'))
    {
      // If string, turn into single element array
      $language_codes = (is_array($language_codes)) ? $language_codes : array($language_codes);

      foreach ($language_codes as $language_code)
      {
        if (strlen($language_code))
        {
          $repository->addProperty('language_of_repository_description', $language_code, array('scope' => 'languages'));
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add multiple scripts of repository description
    if ($script_codes = $this->getRequestParameter('script_code'))
    {
      // If string, turn into single element array
      $script_codes = (is_array($script_codes)) ? $script_codes : array($script_codes);

      foreach ($script_codes as $script_code)
      {
        if (strlen($script_code))
        {
          $repository->addProperty('script_of_repository_description', $script_code, array('scope' => 'languages'));
          $this->foreignKeyUpdate = true;
        }
      }
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
      if (($this->getRequestParameter('contact_type')) ||
      ($this->getRequestParameter('contact_person')) ||
      ($this->getRequestParameter('street_address')) ||
      ($this->getRequestParameter('city')) ||
      ($this->getRequestParameter('region')) ||
      ($this->getRequestParameter('country_code')) ||
      ($this->getRequestParameter('postal_code')) ||
      ($this->getRequestParameter('telephone')) ||
      ($this->getRequestParameter('fax')) ||
      ($this->getRequestParameter('email')) ||
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
    if ($this->getRequestParameter('note'))
    {
      $repository->setRepositoryNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('note'), $this->getRequestParameter('note_type_id'));
    }
  }
}
