<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Controller for editing repository information.
 *
 * @package    qubit
 * @subpackage repository
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class RepositoryEditAction extends sfAction
{
  public function execute($request)
  {
    $this->repository = new QubitRepository;

    if (isset($request->id))
    {
      if (null === $this->repository = QubitRepository::getById($request->id))
      {
        $this->forward404();
      }
    }

    $this->contactInformation = $this->repository->getContactInformation();
    $this->newContactInformation = new QubitContactInformation;

    //Other Forms of Name
    $this->otherNames = $this->repository->getOtherNames();
    $otherNameTypes = array();
    foreach (QubitTerm::getActorNameTypes() as $type)
    {
      $otherNameTypes[$type->getId()] = $type->getName(array('cultureFallback' => true));
    }
    $this->otherNameTypes = $otherNameTypes;

    //Properties
    $this->languageCodes = $this->repository->getProperties($name = 'language_of_repository_description');
    $this->scriptCodes = $this->repository->getProperties($name = 'script_of_repository_description');

    //Notes
    $this->notes = $this->repository->getRepositoryNotes();
    $this->noteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::NOTE_TYPE_ID);

    // Add javascript libraries to allow multiple instance select boxes
    $this->getResponse()->addJavaScript('/vendor/jquery/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');

    if ($request->isMethod('post'))
    {
      $this->processForm();

      // return to show template
      return $this->redirect(array('module' => 'repository', 'action' => 'show', 'id' => $this->repository->getId()));
    }
  }

  protected function processForm()
  {
    $this->updateActorAttributes();
    $this->updateRepositoryAttributes();
    $this->updateOtherNames();
    $this->updateTermOneToManyRelations();
    $this->updateProperties();
    $this->updateContactInformation();
    $this->updateRepositoryNotes();
  }

  public function updateActorAttributes()
  {
    $this->repository->setAuthorizedFormOfName($this->getRequestParameter('authorized_form_of_name'));
    $this->repository->setHistory($this->getRequestParameter('history'));
    $this->repository->setMandates($this->getRequestParameter('mandates'));
    $this->repository->setInternalStructures($this->getRequestParameter('internal_structures'));
    $this->repository->save();
  }

  public function updateRepositoryAttributes()
  {
    $this->repository->setIdentifier($this->getRequestParameter('identifier'));
    $this->repository->setGeoculturalContext($this->getRequestParameter('geocultural_context'));
    $this->repository->setCollectingPolicies($this->getRequestParameter('collecting_policies'));
    $this->repository->setBuildings($this->getRequestParameter('buildings'));
    $this->repository->setHoldings($this->getRequestParameter('holdings'));
    $this->repository->setFindingAids($this->getRequestParameter('finding_aids'));
    $this->repository->setOpeningTimes($this->getRequestParameter('opening_times'));
    $this->repository->setAccessConditions($this->getRequestParameter('access_conditions'));
    $this->repository->setDisabledAccess($this->getRequestParameter('disabled_access'));
    $this->repository->setResearchServices($this->getRequestParameter('research_services'));
    $this->repository->setReproductionServices($this->getRequestParameter('reproduction_services'));
    $this->repository->setPublicFacilities($this->getRequestParameter('public_facilities'));
    $this->repository->setDescIdentifier($this->getRequestParameter('desc_identifier'));
    $this->repository->setDescInstitutionIdentifier($this->getRequestParameter('desc_institution_identifier'));
    $this->repository->setDescRules($this->getRequestParameter('desc_rules'));
    $this->repository->setDescSources($this->getRequestParameter('desc_sources'));
    $this->repository->setDescRevisionHistory($this->getRequestParameter('desc_revision_history'));

    $this->repository->save();
  }

  public function updateTermOneToManyRelations()
  {
    if ($this->getRequestParameter('type_id'))
    {
      $this->repository->setTypeId($this->getRequestParameter('type_id'));
    }
    else
    {
      $this->repository->setTypeId(null);
    }

    if ($this->getRequestParameter('desc_status_id'))
    {
      $this->repository->setDescStatusId($this->getRequestParameter('desc_status_id'));
    }
    else
    {
      $this->repository->setDescStatusId(null);
    }

    if ($this->getRequestParameter('desc_detail_id'))
    {
      $this->repository->setDescDetailId($this->getRequestParameter('desc_detail_id'));
    }
    else
    {
      $this->repository->setDescDetailId(null);
    }

    $this->repository->save();
  }

  public function updateProperties()
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
          $this->repository->addProperty('language_of_repository_description', $language_code, array('scope' => 'languages'));
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
          $this->repository->addProperty('script_of_repository_description', $script_code, array('scope' => 'languages'));
          $this->foreignKeyUpdate = true;
        }
      }
    }
  }

  public function updateOtherNames()
  {
    if ($this->getRequestParameter('other_name'))
    {
      $this->repository->setOtherNames($this->getRequestParameter('other_name'), $this->getRequestParameter('other_name_type_id'), $this->getRequestParameter('other_name_note'));
    }
  }

  public function updateContactInformation()
  {
    if ($this->repository->getId())
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
        $contactInformation->setActorId($this->repository->getId());
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

  public function updateRepositoryNotes()
  {
    if ($this->getRequestParameter('note'))
    {
      $this->repository->setRepositoryNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('note'), $this->getRequestParameter('note_type_id'));
    }
  }
}
