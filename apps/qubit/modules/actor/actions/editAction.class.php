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
    $this->form = new sfForm;

    $this->actor = new QubitActor;

    if (isset($request->id))
    {
      $this->actor = QubitActor::getById($request->id);

      if (!isset($this->actor))
      {
        $this->forward404();
      }

      // Add optimistic lock
      $this->form->setDefault('serialNumber', $this->actor->serialNumber);
      $this->form->setValidator('serialNumber', new sfValidatorInteger);
      $this->form->setWidget('serialNumber', new sfWidgetFormInputHidden);
    }

    //Other Forms of Name
    $this->otherNames = $this->actor->getOtherNames();
    $this->newName = new QubitActorName;

    //Properties
    $this->languageCodes = $this->actor->getProperties($name = 'language_of_actor_description');
    $this->scriptCodes = $this->actor->getProperties($name = 'script_of_actor_description');

    //Notes
    $this->maintenanceNotes = $this->actor->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));

    //Actor Relations
    $this->actorRelations = $this->actor->getActorRelations();
    $this->actorRelationCategories = QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_RELATION_TYPE_ID);

    //Related resources (events)
    $this->events = $this->actor->getEvents();
    $this->eventTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::EVENT_TYPE_ID);
    $this->resourceTypeTerms = array(QubitTerm::getById(QubitTerm::ARCHIVAL_MATERIAL_ID));

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
    $this->getResponse()->addJavaScript('/vendor/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');

    if ($request->isMethod('post'))
    {
      $this->updateActorAttributes();
      $this->updateTermOneToManyRelations();
      $this->updateProperties();
      $this->updateActorRelations();
      $this->deleteActorRelations();
      $this->updateEvents();
      $this->deleteEvents();
      $this->updateNotes();
      $this->deleteNotes();

      $this->actor->save();

      $this->updateOtherNames();

      //set redirect if actor edit was called from another module
      if ($this->getRequestParameter('repositoryReroute'))
      {
        $this->redirect('repository/edit?id='.$this->getRequestParameter('repositoryReroute'));
      }

      if ($this->getRequestParameter('informationObjectReroute'))
      {
        $this->redirect('informationobject/edit?id='.$this->getRequestParameter('informationObjectReroute'));
      }

      $this->redirect(array('module' => 'actor', 'action' => 'show', 'id' => $this->actor->getId()));
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

  }

  public function updateOtherNames()
  {
    if ($this->getRequestParameter('new_name'))
    {
      $this->actor->setOtherNames($this->getRequestParameter('new_name'), $this->getRequestParameter('new_name_type_id'), $this->getRequestParameter('new_name_note'));
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

  /**
   * Update actor relationships
   *
   * @return ActorEditAction $this object
   */
  protected function updateActorRelations()
  {
    if ($this->hasRequestParameter('updateActorRelations'))
    {
      // Data from YUI dialog
      $actorRelationData = $this->getRequestParameter('updateActorRelations');
    }
    else
    {
      // Data from plain html folm
      $actorRelationData = array($this->getRequestParameter('editActorRelation'));
    }

    foreach ($actorRelationData as $actorRelationRow)
    {
      // If no actor name specified then don't update this actor relation
      if (0 == strlen($relatedActorName = $actorRelationRow['actorName']))
      {
        continue;
      }

      // If related actor doesn't exist, create a new actor
      if (null === ($relatedActor = QubitActor::getByAuthorizedFormOfName($relatedActorName)))
      {
        $relatedActor = new QubitActor;
        $relatedActor->setAuthorizedFormOfName($relatedActorName);
        $relatedActor->save();
      }

      // Create/edit relation
      if (isset($actorRelationRow['id']))
      {
        if (null === ($relation = QubitRelation::getById($actorRelationRow['id'])))
        {
          throw new sfException('Relation id '.$actorRelationRow['id'].' does not exist.');
        }
        else
        {
          // Update related actor based on current direction of relationship
          if ($this->actor->getId() == $relation->getSubjectId())
          {
            $relation->setObjectId($relatedActor->getId());
          }
          else if ($this->actor->getId() == $relation->getObjectId())
          {
            $relation->setSubjectId($relatedActor->getId());
          }
          else
          {
            throw new sfException('Invalid relation.');
          }
        }
      }
      else
      {
        $relation = new QubitRelation;
        $relation->setSubjectId($this->actor->getId());
        $relation->setObjectId($relatedActor->getId());
      }

      $relation->setTypeId($actorRelationRow['categoryId']);
      $relation->setStartDate(QubitDate::standardize($actorRelationRow['startDate']));
      $relation->setEndDate(QubitDate::standardize($actorRelationRow['endDate']));

      // Save new relation and related actor
      $relatedActor->save();
      $relation->save();

      // Add notes (after save of $relation so we have an object_id)
      $relation->updateNote($actorRelationRow['description'], QubitTerm::RELATION_NOTE_DESCRIPTION_ID);
      $relation->updateNote($actorRelationRow['dateDisplay'], QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID);
    }

    return $this;
  }

  protected function deleteActorRelations()
  {
    if ($this->hasRequestParameter('deleteRelations'))
    {
      foreach ((array) $this->getRequestParameter('deleteRelations') as $relationId => $value)
      {
        $relation = QubitRelation::getById($relationId);
        $relation->delete();
      }
    }
  }
  /**
   * Add or update events related to this actor
   *
   * @return ActorEditAction this object
   */
  protected function updateEvents()
  {
    if ($this->hasRequestParameter('updateEvents'))
    {
      // The 'updateEvents' array is created by the actorEventDialog.js
      $updateEvents = $this->getRequestParameter('updateEvents');
    }
    else if ($this->hasRequestParameter('newEvent'))
    {
      // The 'newEvent' array means a non-javascript form submission
      $updateEvents = array($this->getRequestParameter('newEvent'));
    }
    else
    {
      return;
    }

    // Loop through actor events
    foreach ($updateEvents as $eventFormData)
    {
      // Create new event or update an existing one
      if (isset($eventFormData['id']))
      {
        if (null === $event = QubitEvent::getById($eventFormData['id']))
        {
          continue; // If we can't find the object, then skip this row
        }
      }
      else
      {
        $event = new QubitEvent;
      }

      // Assign resource to event
      if (0 == strlen($eventFormData['resourceTitle']))
      {
        continue; // If no resource name, don't update event
      }
      else
      {
        // Create resource object (only type is "archival material" right now)
        if (QubitTerm::ARCHIVAL_MATERIAL_ID == $eventFormData['resourceTypeId'])
        {
          // Check if info object already exists
          $criteria = new Criteria;
          $criteria->addJoin(QubitInformationObject::ID, QubitInformationObjectI18n::ID, Criteria::INNER_JOIN);
          $criteria->add(QubitInformationObjectI18n::TITLE, $eventFormData['resourceTitle'], Criteria::EQUAL);
          if (null === ($resource = QubitInformationObject::getOne($criteria)))
          {
            $resource = new QubitInformationObject;
            $resource->setTitle($eventFormData['resourceTitle']);
            $resource->setCollectionTypeId($eventFormData['resourceTypeId']);
            $resource->setParentId(QubitInformationObject::ROOT_ID);
            $resource->save();
          }
        }
        else
        {
          continue;
        }

        // Assign resource to event
        $event->setInformationObjectId($resource->getId());
      }

      // Update other event properties
      $event->setActorId($this->actor->getId());
      $event->setTypeId($eventFormData['typeId']);
      $event->setDateDisplay($eventFormData['dateDisplay']);
      $event->setStartDate(QubitDate::standardize($eventFormData['startDate']));
      $event->setEndDate(QubitDate::standardize($eventFormData['endDate']));

      $event->save();
    }

    return $this;
  }

  /**
   * Delete related events that are marked for deletion.
   *
   * @return ActorEditAction $this object
   */
  public function deleteEvents()
  {
    if (is_array($deleteEvents = $this->getRequestParameter('deleteEvents')) && count($deleteEvents))
    {
      foreach ($deleteEvents as $deleteId => $doDelete)
      {
        if (null !== ($event = QubitEvent::getById($deleteId)))
        {
          $event->delete();
        }
      }
    }

    return $this;
  }

  public function updateNotes()
  {
    // Update maintenance notes (multiple)
    foreach ((array) $this->getRequestParameter('new_maintenance_note') as $newNote)
    {
      if (0 < strlen($newNote))
      {
        $this->actor->setNote(array('userId' => $userId, 'note' => $newNote, 'noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));
      }
    }

    return $this;
  }

  /**
   * Delete related notes marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteNotes()
  {
    if (is_array($deleteNotes = $this->request->getParameter('delete_notes')) && count($deleteNotes))
    {
      foreach ($deleteNotes as $noteId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($deleteNote = QubitNote::getById($noteId)))
        {
          $deleteNote->delete();
        }
      }
    }
  }

}
