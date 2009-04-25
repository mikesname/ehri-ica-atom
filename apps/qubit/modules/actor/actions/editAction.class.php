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
 * Controller for editing actor information.
 *
 * @package    qubit
 * @subpackage actor
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class ActorEditAction extends sfAction
{
  public function execute($request)
  {
    $this->actor = new QubitActor;

    if (isset($request->id))
    {
      if (null === $this->actor = QubitActor::getById($request->id))
      {
        $this->forward404();
      }
    }

    //Other Forms of Name
    $this->otherNames = $this->actor->getOtherNames();
    $this->newName = new QubitActorName;

    //Properties
    $this->languageCodes = $this->actor->getProperties($name = 'language_of_actor_description');
    $this->scriptCodes = $this->actor->getProperties($name = 'script_of_actor_description');

    //Notes
    $this->notes = $this->actor->getActorNotes();
    $this->noteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::NOTE_TYPE_ID);

    if ($this->getRequestParameter('repositoryReroute'))
    {
      $this->repositoryReroute = $this->getRequestParameter('repositoryReroute');
    }
    else
    {
      $this->repositoryReroute = null;
    }

    if ($this->getRequestParameter('informationObjectReroute'))
    {
      $this->informationObjectReroute = $this->getRequestParameter('informationObjectReroute');
    }
    else
    {
      $this->informationObjectReroute = null;
    }

    // Add javascript libraries to allow multiple instance select boxes
    $this->getResponse()->addJavaScript('/vendor/jquery/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');

    if ($request->isMethod('post'))
    {
      $this->updateActorAttributes();
      $this->updateOtherNames();
      $this->updateTermOneToManyRelations();
      $this->updateProperties();
      //$this->updateObjectTermRelations();
      $this->updateActorNotes();
      //$this->updateInformationObjectRelations();
      //$this->updateRecursiveRelations();
      //$this->updateContactInformation();

      //set redirect if actor edit was called from another module
      if ($this->getRequestParameter('repositoryReroute'))
      {
        return $this->redirect('repository/edit?id='.$this->getRequestParameter('repositoryReroute'));
      }

      if ($this->getRequestParameter('informationObjectReroute'))
      {
        return $this->redirect('informationobject/edit?id='.$this->getRequestParameter('informationObjectReroute'));
      }

      return $this->redirect(array('module' => 'actor', 'action' => 'show', 'id' => $this->actor->getId()));
    }
  }

  public function updateActorAttributes()
  {
    $this->actor->setAuthorizedFormOfName($this->getRequestParameter('authorized_form_of_name'));
    $this->actor->setDatesOfExistence($this->getRequestParameter('dates_of_existence'));
    $this->actor->setCorporateBodyIdentifiers($this->getRequestParameter('corporate_body_identifiers'));
    $this->actor->setHistory($this->getRequestParameter('history'));
    $this->actor->setPlaces($this->getRequestParameter('places'));
    $this->actor->setLegalStatus($this->getRequestParameter('legal_status'));
    $this->actor->setFunctions($this->getRequestParameter('functions'));
    $this->actor->setMandates($this->getRequestParameter('mandates'));
    $this->actor->setInternalStructures($this->getRequestParameter('internal_structures'));
    $this->actor->setGeneralContext($this->getRequestParameter('general_context'));
    $this->actor->setDescriptionIdentifier($this->getRequestParameter('description_identifier'));
    $this->actor->setInstitutionResponsibleIdentifier($this->getRequestParameter('institution_responsible_identifier'));
    $this->actor->setRules($this->getRequestParameter('rules'));
    $this->actor->setSources($this->getRequestParameter('sources'));
    $this->actor->setRevisionHistory($this->getRequestParameter('revision_history'));

    $this->actor->save();
  }

  public function updateOtherNames()
  {
    if ($this->getRequestParameter('new_name'))
    {
      $this->actor->setOtherNames($this->getRequestParameter('new_name'), $this->getRequestParameter('new_name_type_id'), $this->getRequestParameter('new_name_note'));
    }
  }

  public function updateActorNotes()
  {
    if ($this->getRequestParameter('note'))
    {
      $this->actor->setActorNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('note'), $this->getRequestParameter('note_type_id'));
    }
  }

  public function updateTermOneToManyRelations()
  {
    if ($this->getRequestParameter('entity_type_id'))
    {
      $this->actor->setEntityTypeId($this->getRequestParameter('entity_type_id'));
    }
    else
    {
      $this->actor->setEntityTypeId(null);
    }

    if ($this->getRequestParameter('description_status_id'))
    {
      $this->actor->setDescriptionStatusId($this->getRequestParameter('description_status_id'));
    }
    else
    {
      $this->actor->setDescriptionStatusId(null);
    }

    if ($this->getRequestParameter('description_detail_id'))
    {
      $this->actor->setDescriptionDetailId($this->getRequestParameter('description_detail_id'));
    }
    else
    {
      $this->actor->setDescriptionDetailId(null);
    }

    $this->actor->save();
  }

  public function updateProperties()
  {
    // Add multiple languages of actor description
    if ($language_codes = $this->getRequestParameter('language_code'))
    {
      // If string, turn into single element array
      $language_codes = (is_array($language_codes)) ? $language_codes : array($language_codes);

      foreach ($language_codes as $language_code)
      {
        if (strlen($language_code))
        {
          $this->actor->addProperty('language_of_actor_description', $language_code, array('source_culture'=>true, 'scope' => 'languages'));
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add multiple scripts of actor description
    if ($script_codes = $this->getRequestParameter('script_code'))
    {
      // If string, turn into single element array
      $script_codes = (is_array($script_codes)) ? $script_codes : array($script_codes);

      foreach ($script_codes as $script_code)
      {
        if (strlen($script_code))
        {
          $this->actor->addProperty($name = 'script_of_actor_description', $script_code, array('source_culture'=>true, 'scope' => 'scripts'));
          $this->foreignKeyUpdate = true;
        }
      }
    }
  }

  public function updateObjectTermRelations()
  {
  }

  public function updateEventRelations()
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

      $this->actor->addInformationObjectRelation($this->getRequestParameter('informationObjectId'), $actorRoleId, $this->getRequestParameter('relation_dates'));
    }
  }
}
