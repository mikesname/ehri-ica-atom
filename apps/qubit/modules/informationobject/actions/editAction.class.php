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
 * Get current state data for information object edit form.
 *
 * @package    qubit
 * @subpackage informationobject
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class InformationObjectEditAction extends sfAction
{
  public function execute($request)
  {
    $this->informationObject = new QubitInformationObject;

    if (isset($request->id))
    {
      $this->informationObject = QubitInformationObject::getById($request->id);

      // Check that object exists and that it is not the root
      if (!isset($this->informationObject) || !isset($this->informationObject->parent))
      {
        $this->forward404();
      }
    }

    $request->setAttribute('informationObject', $this->informationObject);

    $this->warnings = array();

    // Add javascript libraries to allow selecting multiple access points
    $this->getResponse()->addJavaScript('/vendor/jquery/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');

    // Determine if user has edit priviliges
    $this->editTaxonomyCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'term'))
    {
      $this->editTaxonomyCredentials = true;
    }

    //Actor (Event) Relations
    $this->actorEvents = $this->informationObject->getEvents();
    $this->newActorEvent = new QubitEvent;
    $this->creators = $this->informationObject->getCreators();
    $this->actorEventTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::EVENT_TYPE_ID);
    $this->defaultActorEventType = QubitTerm::CREATION_ID;
    $this->actorEventPlaces = QubitTerm::getOptionsForSelectList(QubitTaxonomy::PLACE_ID, $options = array('include_blank' => true));

    //Properties
    $this->languageCodes = $this->informationObject->getProperties($name = 'information_object_language');
    $this->scriptCodes = $this->informationObject->getProperties($name = 'information_object_script');
    $this->descriptionLanguageCodes = $this->informationObject->getProperties($name = 'language_of_information_object_description');
    $this->descriptionScriptCodes = $this->informationObject->getProperties($name = 'script_of_information_object_description');

    //Notes
    $this->notes = $this->informationObject->getNotes();
    $this->noteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::NOTE_TYPE_ID);
    $this->titleNotes = $this->informationObject->getNotesByType($options = array ('noteTypeId' => QubitTerm::TITLE_NOTE_ID));
    $this->publicationNotes = $this->informationObject->getNotesByType($options = array ('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));

    //Access Points
    $this->newSubjectAccessPoint = new QubitObjectTermRelation;
    $this->newPlaceAccessPoint = new QubitObjectTermRelation;
    $this->subjectAccessPoints = $this->informationObject->getSubjectAccessPoints();
    $this->placeAccessPoints = $this->informationObject->getPlaceAccessPoints();
    $this->nameSelectList = QubitActor::getAccessPointSelectList();
    $this->nameAccessPoints = array();
    $actorEvents = $this->informationObject->getActorEvents();
    foreach ($actorEvents as $event)
    {
      if ($event->getActorId())
      {
        $this->nameAccessPoints[] = $event;
      }
    }

    // Material Type
    $this->newMaterialType = new QubitObjectTermRelation;
    $this->materialTypes = $this->informationObject->getMaterialTypes();

    // Count related digital objects for warning message when deleting info object
    // Note: This should only be 0 or 1 digital objects.
    $this->digitalObjectCount = 0;
    if (null !== $digitalObject = $this->informationObject->getDigitalObject())
    {
      $this->digitalObjectCount = 1;
    }

    require_once sfConfig::get('sf_symfony_lib_dir').'/plugins/sfCompat10Plugin/lib/request/sfRequestCompat10.class.php';
    $this->dispatcher->connect('request.method_not_found', array('sfRequestCompat10', 'call'));

    // Check for file upload errors
    $uploadFiles = $this->getRequest()->getFileName('upload_file');
    $fileErrors  = $this->getRequest()->getFileError('upload_file');
    if (count($uploadFiles))
    {
      foreach ($uploadFiles as $usageId => $filename)
      {
        if (strlen($filename) && $fileErrors[$usageId])
        {
          $uploadWarnings[] = 'The file "'.$filename.'" exceeded the maximum upload size of '.ini_get('upload_max_filesize').'.';
        }
      }

      if (isset($uploadWarnings))
      {
        $this->warnings['upload_file'] = $uploadWarnings;
      }
    }

    if ($request->hasParameter('error'))
    {
      $this->error = $request->getParameter('error');
    }

    if ($request->isMethod('post'))
    {
      $this->hasWarning = false;
      $this->foreignKeyUpdate = false;

      $this->processForm();

      // Redirect to show template on successful update
      if (!$this->hasWarning)
      {
        $this->redirect(array('module' => 'informationobject', 'action' => 'show', 'id' => $this->informationObject->getId()));
      }
    }
  }

  protected function processForm()
  {
    // set the informationObject's attributes
    $this->informationObject->setId($this->getRequestParameter('id'));
    $this->updateInformationObjectAttributes();
    $this->updateOneToManyRelations();
    $this->updateCollectionType();
    $this->updateHierarchy();

    // save informationObject after setting all of its attributes...
    $this->informationObject->save();

    // ...now save objects related to this informationObject
    $this->updateNotes();
    $this->updateProperties();
    $this->updateObjectTermRelations();
    $this->updateActorEvents();
    $this->updateDigitalObjects();
    $this->updatePhysicalObjects();
    //$this->updateRecursiveRelations();

    // delete related objects marked for deletion
    $this->deleteNotes();
    $this->deleteActorEvents();
    $this->deleteProperties();
    $this->deleteObjectTermRelations();
    $this->deleteRelations();
  }

  public function updateInformationObjectAttributes()
  {
    if ($this->hasRequestParameter('title'))
    {
      $this->informationObject->setTitle($this->getRequestParameter('title'));
    }
    if ($this->hasRequestParameter('alternate_title'))
    {
      $this->informationObject->setAlternateTitle($this->getRequestParameter('alternate_title'));
    }
    if ($this->hasRequestParameter('identifier'))
    {
      $this->informationObject->setIdentifier($this->getRequestParameter('identifier'));
    }
    if ($this->hasRequestParameter('edition'))
    {
      $this->informationObject->setEdition($this->getRequestParameter('edition'));
    }
    if ($this->hasRequestParameter('extent_and_medium'))
    {
      $this->informationObject->setExtentAndMedium($this->getRequestParameter('extent_and_medium'));
    }
    if ($this->hasRequestParameter('archival_history'))
    {
      $this->informationObject->setArchivalHistory($this->getRequestParameter('archival_history'));
    }
    if ($this->hasRequestParameter('acquisition'))
    {
      $this->informationObject->setAcquisition($this->getRequestParameter('acquisition'));
    }
    if ($this->hasRequestParameter('scope_and_content'))
    {
      $this->informationObject->setScopeAndContent($this->getRequestParameter('scope_and_content'));
    }
    if ($this->hasRequestParameter('appraisal'))
    {
      $this->informationObject->setAppraisal($this->getRequestParameter('appraisal'));
    }
    if ($this->hasRequestParameter('accruals'))
    {
      $this->informationObject->setAccruals($this->getRequestParameter('accruals'));
    }
    if ($this->hasRequestParameter('arrangement'))
    {
      $this->informationObject->setArrangement($this->getRequestParameter('arrangement'));
    }
    if ($this->hasRequestParameter('access_conditions'))
    {
      $this->informationObject->setAccessConditions($this->getRequestParameter('access_conditions'));
    }
    if ($this->hasRequestParameter('reproduction_conditions'))
    {
      $this->informationObject->setReproductionConditions($this->getRequestParameter('reproduction_conditions'));
    }
    if ($this->hasRequestParameter('physical_characteristics'))
    {
      $this->informationObject->setPhysicalCharacteristics($this->getRequestParameter('physical_characteristics'));
    }
    if ($this->hasRequestParameter('finding_aids'))
    {
      $this->informationObject->setFindingAids($this->getRequestParameter('finding_aids'));
    }
    if ($this->hasRequestParameter('location_of_originals'))
    {
      $this->informationObject->setLocationOfOriginals($this->getRequestParameter('location_of_originals'));
    }
    if ($this->hasRequestParameter('location_of_copies'))
    {
      $this->informationObject->setLocationOfCopies($this->getRequestParameter('location_of_copies'));
    }
    if ($this->hasRequestParameter('related_units_of_description'))
    {
      $this->informationObject->setRelatedUnitsOfDescription($this->getRequestParameter('related_units_of_description'));
    }
    if ($this->hasRequestParameter('rules'))
    {
      $this->informationObject->setRules($this->getRequestParameter('rules'));
    }
    if ($this->hasRequestParameter('institution_responsible_identifier'))
    {
      $this->informationObject->setInstitutionResponsibleIdentifier($this->getRequestParameter('institution_responsible_identifier'));
    }
    if ($this->hasRequestParameter('description_identifier'))
    {
      $this->informationObject->setDescriptionIdentifier($this->getRequestParameter('description_identifier'));
    }
    if ($this->hasRequestParameter('revision_history'))
    {
      $this->informationObject->setRevisionHistory($this->getRequestParameter('revision_history'));
    }
    if ($this->hasRequestParameter('sources'))
    {
      $this->informationObject->setSources($this->getRequestParameter('sources'));
    }
  }

  public function updateHierarchy()
  {
    if ($this->hasRequestParameter('parent_id') || null === $this->informationObject->getParentId())
    {
      // Empty form values must be converted to null
      if (0 == $parentId = $this->getRequestParameter('parent_id'))
      {
        $this->informationObject->setRoot();
      }
      else
      {
        $this->informationObject->setParentId($parentId);
      }
    }
  }

  public function updateCollectionType()
  {
    if ($this->hasRequestParameter('collection_type_id'))
    {
      $this->informationObject->setCollectionTypeId($this->getRequestParameter('collection_type_id'));
    }
    else
    {
      // set default to 'archival material'
      $this->informationObject->setCollectionTypeId(QubitTerm::ARCHIVAL_MATERIAL_ID);
    }
  }

  public function updateOneToManyRelations()
  {
    if ($this->hasRequestParameter('level_of_description_id'))
    {
      // Empty form values must be converted to null
      if (0 == $levelOfDescriptionId = $this->getRequestParameter('level_of_description_id'))
      {
        $levelOfDescriptionId = null;
      }
      $this->informationObject->setLevelOfDescriptionId($levelOfDescriptionId);

      $this->foreignKeyUpdate = true;
    }

    if ($this->hasRequestParameter('repository_id'))
    {
      // Empty form values must be converted to null
      if (0 == $repositoryId = $this->getRequestParameter('repository_id'))
      {
        $repositoryId = null;
      }
      $this->informationObject->setRepositoryId($repositoryId);
    }

    if ($this->hasRequestParameter('description_status_id'))
    {
      // Empty form values must be converted to null
      if (0 == $descriptionStatusId = $this->getRequestParameter('description_status_id'))
      {
        $descriptionStatusId = null;
      }
      $this->informationObject->setDescriptionStatusId($descriptionStatusId);
    }

    if ($this->hasRequestParameter('description_detail_id'))
    {
      // Empty form values must be converted to null
      if (0 == $descriptionDetailId = $this->getRequestParameter('description_detail_id'))
      {
        $descriptionDetailId = null;
      }
      $this->informationObject->setDescriptionDetailId($descriptionDetailId);
    }
  }

  public function updateNotes()
  {
    foreach ((array) $this->getRequestParameter('new_title_note') as $newTitleNote)
    {
      if (0 < strlen($newTitleNote))
      {
        $this->informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $newTitleNote, 'noteTypeId' => QubitTerm::TITLE_NOTE_ID));
      }
    }

    if ($this->getRequestParameter('new_publication_note'))
    {
      $this->informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $this->getRequestParameter('new_publication_note'), 'noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
    }

    if ($this->getRequestParameter('note'))
    {
      $this->informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $this->getRequestParameter('note'), 'noteTypeId' => $this->getRequestParameter('note_type_id')));
    }
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

  public function updateProperties()
  {
    // Add multiple languages of access
    if ($language_codes = $this->getRequestParameter('language_code'))
    {
      // If string, turn into single element array
      $language_codes = (is_array($language_codes)) ? $language_codes : array($language_codes);

      foreach ($language_codes as $language_code)
      {
        if (strlen($language_code))
        {
          $this->informationObject->addProperty($name = 'information_object_language', $language_code, array('scope'=>'languages', 'sourceCulture'=>true));
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add multiple scripts of access
    if ($script_codes = $this->getRequestParameter('script_code'))
    {
      // If string, turn into single element array
      $script_codes = (is_array($script_codes)) ? $script_codes : array($script_codes);

      foreach ($script_codes as $script_code)
      {
        if (strlen($script_code))
        {
          $this->informationObject->addProperty($name = 'information_object_script', $script_code, array('scope'=>'scripts', 'sourceCulture'=>true));
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add multiple languages of description
    if ($language_codes = $this->getRequestParameter('description_language_code'))
    {
      // If string, turn into single element array
      $language_codes = (is_array($language_codes)) ? $language_codes : array($language_codes);

      foreach ($language_codes as $language_code)
      {
        if (strlen($language_code))
        {
          $this->informationObject->addProperty($name = 'language_of_information_object_description', $language_code, array('scope'=>'languages', 'sourceCulture'=>true));
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add multiple scripts of description
    if ($script_codes = $this->getRequestParameter('description_script_code'))
    {
      // If string, turn into single element array
      $script_codes = (is_array($script_codes)) ? $script_codes : array($script_codes);

      foreach ($script_codes as $script_code)
      {
        if (strlen($script_code))
        {
          $this->informationObject->addProperty($name = 'script_of_information_object_description', $script_code, array('scope'=>'scripts', 'sourceCulture'=>true));
          $this->foreignKeyUpdate = true;
        }
      }
    }
  }

  /**
   * Delete related properties marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteProperties()
  {
    if (is_array($deleteProperties = $this->request->getParameter('delete_properties')) && count($deleteProperties))
    {
      foreach ($deleteProperties as $thisId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($property = QubitProperty::getById($thisId)))
        {
          $property->delete();
        }
      }
    }
  }

  /**
   * Update ObjectTermRelations - Subject, name and place access points and
   * Material types.
   *
   * @param QubitInformationObject $informationObject current information object
   */
  public function updateObjectTermRelations()
  {
    // Add name access points
    if ($name_ids = $this->getRequestParameter('name_id'))
    {
      // Make sure that $name_ids is an array, even if it's only got one value
      $name_ids = (is_array($name_ids)) ? $name_ids : array($name_ids);

      foreach ($name_ids as $name_id)
      {
        if (intval($name_id))
        {
          $this->informationObject->addNameAccessPoint($name_id, QubitTerm::SUBJECT_ID);
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add subject access points
    if ($subject_ids = $this->getRequestParameter('subject_id'))
    {
      // Make sure that $subject_id is an array, even if it's only got one value
      $subject_ids = (is_array($subject_ids)) ? $subject_ids : array($subject_ids);

      foreach ($subject_ids as $subject_id)
      {
        if (intval($subject_id))
        {
          $this->informationObject->addTermRelation($subject_id, QubitTaxonomy::SUBJECT_ID);
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add place access points
    if ($place_ids = $this->getRequestParameter('place_id'))
    {
      // Make sure that $place_id is an array, even if it's only got one value
      $place_ids = (is_array($place_ids)) ? $place_ids : array($place_ids);

      foreach ($place_ids as $place_id)
      {
        if (intval($place_id))
        {
          $this->informationObject->addTermRelation($place_id, QubitTaxonomy::PLACE_ID);
          $this->foreignKeyUpdate = true;
        }
      }
    }

    // Add material types
    if ($material_type_ids = $this->getRequestParameter('material_type_id'))
    {
      // Make sure that $material_type_id is an array, even if it's only got one value
      $material_type_ids = (is_array($material_type_ids)) ? $material_type_ids : array($material_type_ids);

      foreach ($material_type_ids as $material_type_id)
      {
        if (intval($material_type_id))
        {
          $this->informationObject->addTermRelation($material_type_id, QubitTaxonomy::MATERIAL_TYPE_ID);
          $this->foreignKeyUpdate = true;
        }
      }
    }

  }

  /**
   * Delete object->term relations marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteObjectTermRelations()
  {
    if (is_array($deleteRelations = $this->request->getParameter('delete_object_term_relations')) && count($deleteRelations))
    {
      foreach ($deleteRelations as $thisId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($relation = QubitObjectTermRelation::getById($thisId)))
        {
          $relation->delete();
        }
      }
    }
  }

  /**
   * Add new actor events for this info object.
   *
   * @param QubitInformationObject $informationObject
   */
  protected function updateActorEvents()
  {
    // Get an array of new actor events (notice PLURAL for "editActorEvents")
    // from actorEventDialog.js
    if (!is_array($editActorEvents = $this->getRequestParameter('editActorEvents')))
    {
      // If there's only one event (SINGULAR), make editActorEvents a single
      // element array
      $editActorEvents = array($this->getRequestParameter('editActorEvent'));
    }

    // Loop through actor events
    foreach ($editActorEvents as $eventFormData)
    {
      $saveEvent = false; // Only save if we have an actor or a date

      // Create new event or update an existing one
      if (isset($eventFormData['id']))
      {
        if (null === $actorEvent = QubitEvent::getById($eventFormData['id']))
        {
          continue; // If we can't find the object, then skip this row
        }
      }
      else
      {
        $actorEvent = new QubitEvent;
      }

      // Use existing actor if one is selected (overrides new actor creation)
      if (isset($eventFormData['actorId']) && '' != $eventFormData['actorId'])
      {
        $actorEvent->setActorId($eventFormData['actorId']);
        $saveEvent = true;
      }

      // or, create a new actor and associate with Actor Event
      else if (isset($eventFormData['newActorName']) && '' != $eventFormData['newActorName'])
      {
        // Create actor
        $actor = new QubitActor;
        $actor->setAuthorizedFormOfName($eventFormData['newActorName']);
        $actor->save();

        // Assign actor to event
        $actorEvent->setActorId($actor->getId());
        $saveEvent = true;
      }

      // add event start and end date
      if (($eventFormData['year']) || ($eventFormData['endYear']))
      {
        $actorEvent->setStartDate($eventFormData['year'].'-01-01');
        $actorEvent->setEndDate($eventFormData['endYear'].'-01-01');

        // If no display format specified, then concatenate start & end year
        // with hyphen
        if (!$eventFormData['dateDisplay'])
        {
          $dateString = $eventFormData['year'];
          if ($eventFormData['endYear'])
          {
            $dateString .= ' - '.$eventFormData['endYear'];
          }
          $actorEvent->setDateDisplay($dateString);
        }

        $saveEvent = true;
      }

      // Save the formatted date display
      if ($eventFormData['dateDisplay'])
      {
        $actorEvent->setDateDisplay($eventFormData['dateDisplay']);

        $saveEvent = true;
      }

      // Save the actor event if it's valid (has actor OR date)
      if ($saveEvent)
      {
        $actorEvent->setTypeId($eventFormData['eventTypeId']);

        if (isset($eventFormData['description']))
        {
          $actorEvent->setDescription($eventFormData['description']);
        }
        $actorEvent->setInformationObjectId($this->informationObject->getId());

        $actorEvent->save();
        $this->foreignKeyUpdate = true;
      }

      // Set ObjectTermRelation for "Place"
      if ($saveEvent && isset($eventFormData['placeId']) && '' != $eventFormData['placeId'])
      {
        if (null === $place = QubitObjectTermRelation::getOneByObjectId($actorEvent->getId()))
        {
          $place = new QubitObjectTermRelation;
        }
        $place->setObjectId($actorEvent->getId());
        $place->setTermId($eventFormData['placeId']);
        $place->save();
      }
    }
  }

  /**
   * Delete related actor events marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteActorEvents()
  {
    if (is_array($deleteActorEvents = $this->request->getParameter('deleteEvents')) && count($deleteActorEvents))
    {
      foreach ($deleteActorEvents as $deleteId => $doDelete)
      {
        if ('delete' == $doDelete && !is_null($actorEvent = QubitEvent::getById($deleteId)))
        {
          $actorEvent->delete();
        }
      }
    }
  }

  /**
   * Add a new digital object to $informationObject, upload a digital asset,
   * and create a representation (thumbnail, icon) of asset.
   *
   * @param  sfRequest         The current sfRequest object
   * @param  informationObject The associated informationObject
   * @return mixed  array of file metadata on sucess, false on failure
   */
  public function updateDigitalObjects()
  {
    // Set property 'display_as_compound_object'
    if ($this->request->hasParameter('display_as_compound_object'))
    {
      $this->informationObject->setDisplayAsCompoundObject($this->request->getParameter('display_as_compound_object'));
    }

    // Update media type
    if ($this->request->hasParameter('media_type_id'))
    {
      $digitalObject = $this->informationObject->getDigitalObject();
      $digitalObject->setMediaTypeId($this->request->getParameter('media_type_id'));
      $digitalObject->save();
    }

    // Do digital object upload
    if (is_array($uploadedFiles = $this->request->getFile('upload_file')))
    {
      foreach ($uploadedFiles['name'] as $usageId => $filename)
      {
        if ($uploadedFiles['error'][$usageId])
        {
          continue;
        }

        if (!file_exists($tmpFile = $uploadedFiles['tmp_name'][$usageId]))
        {
          continue; // Skip to next $uploadFile if no valid filename
        }

        // Upload asset and create digital object
        $asset = new QubitAsset($filename, file_get_contents($tmpFile));
        $digitalObject = QubitDigitalObject::create($this->informationObject, $asset, array('usageId' => $usageId));

        // If this is a new information object with no title, set title to name
        // of digital object
        if ($this->request->getParameter('action') == 'update' && $this->informationObject->getTitle(array('cultureFallback'=>true)) == null && $usageId == QubitTerm::MASTER_ID)
        {
          $this->informationObject->setTitle($digitalObject->getName());
          $this->informationObject->save();
        }

        $this->foreignKeyUpdate = true;
      } // endforeach
    } // end if

    // Generate a derivative
    if ($this->request->hasParameter('createDerivative'))
    {
      $digitalObject = $this->informationObject->getDigitalObject();

      switch ($this->request->getParameter('createDerivative'))
      {
        case QubitTerm::REFERENCE_ID:
          $digitalObject->createReferenceImage();
          break;
        case QubitTerm::THUMBNAIL_ID:
          $digitalObject->createThumbnail();
          break;
      }
    }
  } // end function


  /**
   * Update physical object relations.
   *
   * @param  informationObject The current informationObject object
   */
  public function updatePhysicalObjects()
  {
    $oldPhysicalObjects = QubitRelation::getRelatedSubjectsByObjectId('QubitPhysicalObject', $this->informationObject->getId(),
    array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    // Preferentially use "new container" input data over the selector so that
    // new object data is not lost (but only if an object name is entered)
    if (strlen($physicalObjectName = $this->getRequestParameter('physicalObjectName')))
    {
      $physicalObject = new QubitPhysicalObject;

      $physicalObject->setName($physicalObjectName);

      if ($this->hasRequestParameter('physicalObjectLocation'))
      {
        $physicalObject->setLocation($this->getRequestParameter('physicalObjectLocation'));
      }

      if (intval($this->getRequestParameter('physicalObjectTypeId')))
      {
        $physicalObject->setTypeId($this->getRequestParameter('physicalObjectTypeId'));
      }
      $physicalObject->save();

      // Link info object to physical object
      $this->informationObject->addPhysicalObject($physicalObject);
    }

    // If form is not populated, Add any existing physical objects that are selected
    else if ($physicalObjectIds = $this->getRequestParameter('physicalObjectId'))
    {
      // Make sure that $subject_id is an array, even if it's only got one value
      $physicalObjectIds = (is_array($physicalObjectIds)) ? $physicalObjectIds : array($physicalObjectIds);

      foreach ($physicalObjectIds as $physicalObjectId)
      {
        // If a value is set for this select box, and the physical object exists,
        // add a relation to this info object
        if (intval($physicalObjectId) && (null !== $physicalObject = QubitPhysicalObject::getById($physicalObjectId)))
        {
          $this->informationObject->addPhysicalObject($physicalObject);
          $this->foreignKeyUpdate = true;
        }
      }
    }

  } // end method: updatePhysicalObjects

  /**
   * Delete related physical objects marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteRelations()
  {
    if (is_array($deleteRelations = $this->request->getParameter('delete_relations')) && count($deleteRelations))
    {
      foreach ($deleteRelations as $thisId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($relation = QubitRelation::getById($thisId)))
        {
          $relation->delete();
        }
      }
    }
  }
}
