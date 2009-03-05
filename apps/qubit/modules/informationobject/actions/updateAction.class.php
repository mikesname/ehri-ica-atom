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
 * Information Object - Update database from edit form
 *
 * @package    qubit
 * @subpackage informationObject
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class InformationObjectUpdateAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $this->informationObject = new QubitInformationObject;

      $this->getUser()->setAttribute('nav_context_module', 'add');
    }
    else
    {
      $this->informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));
      $this->forward404Unless($this->informationObject);
    }

    $this->hasWarning = false;
    $this->foreignKeyUpdate = false;

    // set the informationObject's attributes
    $this->informationObject->setId($this->getRequestParameter('id'));
    $this->updateInformationObjectAttributes($this->informationObject);
    $this->updateOneToManyRelations($this->informationObject);
    $this->updateCollectionType($this->informationObject);
    $this->updateHierarchy($this->informationObject);

    // save informationObject after setting all of its attributes...
    $this->informationObject->save();

    // ...now save objects related to this informationObject
    $this->updateNotes($this->informationObject);
    $this->updateProperties($this->informationObject);
    $this->updateObjectTermRelations($this->informationObject);
    $this->addActorEvents($this->informationObject);
    $this->updateDigitalObjects($request, $this->informationObject);
    $this->updatePhysicalObjects($this->informationObject);
    //$this->updateRecursiveRelations($informationObject);

    // delete related objects marked for deletion
    $this->deleteNotes($request);
    $this->deleteActorEvents($request);
    $this->deleteProperties($request);
    $this->deleteObjectTermRelations($request);
    $this->deleteRelations($request);
  }

  public function updateInformationObjectAttributes($informationObject)
  {
    if ($this->hasRequestParameter('title'))
    {
      $informationObject->setTitle($this->getRequestParameter('title'));
    }
    if ($this->hasRequestParameter('alternate_title'))
    {
      $informationObject->setAlternateTitle($this->getRequestParameter('alternate_title'));
    }
    if ($this->hasRequestParameter('identifier'))
    {
      $informationObject->setIdentifier($this->getRequestParameter('identifier'));
    }
    if ($this->hasRequestParameter('edition'))
    {
      $informationObject->setEdition($this->getRequestParameter('edition'));
    }
    if ($this->hasRequestParameter('extent_and_medium'))
    {
      $informationObject->setExtentAndMedium($this->getRequestParameter('extent_and_medium'));
    }
    if ($this->hasRequestParameter('archival_history'))
    {
      $informationObject->setArchivalHistory($this->getRequestParameter('archival_history'));
    }
    if ($this->hasRequestParameter('acquisition'))
    {
      $informationObject->setAcquisition($this->getRequestParameter('acquisition'));
    }
    if ($this->hasRequestParameter('scope_and_content'))
    {
      $informationObject->setScopeAndContent($this->getRequestParameter('scope_and_content'));
    }
    if ($this->hasRequestParameter('appraisal'))
    {
      $informationObject->setAppraisal($this->getRequestParameter('appraisal'));
    }
    if ($this->hasRequestParameter('accruals'))
    {
      $informationObject->setAccruals($this->getRequestParameter('accruals'));
    }
    if ($this->hasRequestParameter('arrangement'))
    {
      $informationObject->setArrangement($this->getRequestParameter('arrangement'));
    }
    if ($this->hasRequestParameter('access_conditions'))
    {
      $informationObject->setAccessConditions($this->getRequestParameter('access_conditions'));
    }
    if ($this->hasRequestParameter('reproduction_conditions'))
    {
      $informationObject->setReproductionConditions($this->getRequestParameter('reproduction_conditions'));
    }
    if ($this->hasRequestParameter('physical_characteristics'))
    {
      $informationObject->setPhysicalCharacteristics($this->getRequestParameter('physical_characteristics'));
    }
    if ($this->hasRequestParameter('finding_aids'))
    {
      $informationObject->setFindingAids($this->getRequestParameter('finding_aids'));
    }
    if ($this->hasRequestParameter('location_of_originals'))
    {
      $informationObject->setLocationOfOriginals($this->getRequestParameter('location_of_originals'));
    }
    if ($this->hasRequestParameter('location_of_copies'))
    {
      $informationObject->setLocationOfCopies($this->getRequestParameter('location_of_copies'));
    }
    if ($this->hasRequestParameter('related_units_of_description'))
    {
      $informationObject->setRelatedUnitsOfDescription($this->getRequestParameter('related_units_of_description'));
    }
    if ($this->hasRequestParameter('rules'))
    {
      $informationObject->setRules($this->getRequestParameter('rules'));
    }
    if ($this->hasRequestParameter('institution_responsible_identifier'))
    {
      $informationObject->setInstitutionResponsibleIdentifier($this->getRequestParameter('institution_responsible_identifier'));
    }
    if ($this->hasRequestParameter('description_identifier'))
    {
      $informationObject->setDescriptionIdentifier($this->getRequestParameter('description_identifier'));
    }
    if ($this->hasRequestParameter('revision_history'))
    {
      $informationObject->setRevisionHistory($this->getRequestParameter('revision_history'));
    }
    if ($this->hasRequestParameter('sources'))
    {
      $informationObject->setSources($this->getRequestParameter('sources'));
    }
  }

  public function updateHierarchy($informationObject)
  {
    if ($this->hasRequestParameter('parent_id') || null === $informationObject->getParentId())
    {
      // Empty form values must be converted to null
      if (0 == $parentId = $this->getRequestParameter('parent_id'))
      {
        $informationObject->setRoot();
      }
      else
      {
        $informationObject->setParentId($parentId);
      }
    }
  }

  public function updateCollectionType($informationObject)
  {
    if ($this->hasRequestParameter('collection_type_id'))
    {
      $informationObject->setCollectionTypeId($this->getRequestParameter('collection_type_id'));
    }
    else
    {
      // set default to 'archival material'
      $informationObject->setCollectionTypeId(QubitTerm::ARCHIVAL_MATERIAL_ID);
    }
  }

  public function updateOneToManyRelations($informationObject)
  {
    if ($this->hasRequestParameter('level_of_description_id'))
    {
      // Empty form values must be converted to null
      if (0 == $levelOfDescriptionId = $this->getRequestParameter('level_of_description_id'))
      {
        $levelOfDescriptionId = null;
      }
      $informationObject->setLevelOfDescriptionId($levelOfDescriptionId);

      $this->foreignKeyUpdate = true;
    }

    if ($this->hasRequestParameter('repository_id'))
    {
      // Empty form values must be converted to null
      if (0 == $repositoryId = $this->getRequestParameter('repository_id'))
      {
        $repositoryId = null;
      }
      $informationObject->setRepositoryId($repositoryId);
    }

    if ($this->hasRequestParameter('description_status_id'))
    {
      // Empty form values must be converted to null
      if (0 == $descriptionStatusId = $this->getRequestParameter('description_status_id'))
      {
        $descriptionStatusId = null;
      }
      $informationObject->setDescriptionStatusId($descriptionStatusId);
    }

    if ($this->hasRequestParameter('description_detail_id'))
    {
      // Empty form values must be converted to null
      if (0 == $descriptionDetailId = $this->getRequestParameter('description_detail_id'))
      {
        $descriptionDetailId = null;
      }
      $informationObject->setDescriptionDetailId($descriptionDetailId);
    }
  }

  public function updateNotes($informationObject)
  {
    if ($this->getRequestParameter('new_title_note'))
    {
      $informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $this->getRequestParameter('new_title_note'), 'noteTypeId' => QubitTerm::TITLE_NOTE_ID));
    }

    if ($this->getRequestParameter('new_publication_note'))
    {
      $informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $this->getRequestParameter('new_publication_note'), 'noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
    }

    if ($this->getRequestParameter('note'))
    {
      $informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $this->getRequestParameter('note'), 'noteTypeId' => $this->getRequestParameter('note_type_id')));
    }
  }

  /**
   * Delete related notes marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteNotes($request)
  {
    if (is_array($deleteNotes = $request->getParameter('delete_notes')) && count($deleteNotes))
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

  public function updateProperties($informationObject)
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
          $informationObject->addProperty($name = 'information_object_language', $language_code, array('scope'=>'languages', 'sourceCulture'=>true));
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
          $informationObject->addProperty($name = 'information_object_script', $script_code, array('scope'=>'scripts', 'sourceCulture'=>true));
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
          $informationObject->addProperty($name = 'language_of_information_object_description', $language_code, array('scope'=>'languages', 'sourceCulture'=>true));
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
          $informationObject->addProperty($name = 'script_of_information_object_description', $script_code, array('scope'=>'scripts', 'sourceCulture'=>true));
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
  public function deleteProperties($request)
  {
    if (is_array($deleteProperties = $request->getParameter('delete_properties')) && count($deleteProperties))
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
  public function updateObjectTermRelations($informationObject)
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
          $informationObject->addNameAccessPoint($name_id, QubitTerm::SUBJECT_ID);
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
          $informationObject->addTermRelation($subject_id, QubitTaxonomy::SUBJECT_ID);
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
          $informationObject->addTermRelation($place_id, QubitTaxonomy::PLACE_ID);
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
          $informationObject->addTermRelation($material_type_id, QubitTaxonomy::MATERIAL_TYPE_ID);
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
  public function deleteObjectTermRelations($request)
  {
    if (is_array($deleteRelations = $request->getParameter('delete_object_term_relations')) && count($deleteRelations))
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
  protected function addActorEvents($informationObject)
  {
    // Get an array of new actor events (even if there's only one)
    if (!is_array($newActorEvents = $this->getRequestParameter('newActorEvents')))
    {
      $newActorEvents = array($this->getRequestParameter('newActorEvent'));
    }

    // Loop through new actor events
    foreach ($newActorEvents as $thisEvent)
    {
      $newActorEvent = new QubitEvent;
      $saveEvent = false; // Only save if we have an actor or a date

      // Use existing actor if one is selected (overrides new actor creation)
      if ($thisEvent['actorId'])
      {
        $newActorEvent->setActorId($thisEvent['actorId']);
        $saveEvent = true;
      }

      // or, create a new actor and associate with Actor Event
      else if ($thisEvent['newActorAuthorizedName'])
      {
        // Create actor
        $actor = new QubitActor;
        $actor->setAuthorizedFormOfName($thisEvent['newActorAuthorizedName']);
        $actor->save();

        // Assign actor to event
        $newActorEvent->setActorId($actor->getId());
        $saveEvent = true;
      }

      // add event start and end date
      if (($thisEvent['year']) || ($thisEvent['endYear']))
      {
        $newActorEvent->setStartDate($thisEvent['year'].'-01-01');
        $newActorEvent->setEndDate($thisEvent['endYear'].'-01-01');

        // If no display format specified, then concatenate start & end year
        // with hyphen
        if (!$thisEvent['dateDisplay'])
        {
          $dateString = $thisEvent['year'];
          if ($thisEvent['endYear'])
          {
            $dateString .= ' - '.$thisEvent['endYear'];
          }
          $newActorEvent->setDateDisplay($dateString);
        }

        $saveEvent = true;
      }

      // Save the formatted date display
      if ($thisEvent['dateDisplay'])
      {
        $newActorEvent->setDateDisplay($thisEvent['dateDisplay']);

        $saveEvent = true;
      }

      // Save the actor event if it's valid (has actor OR date)
      if ($saveEvent)
      {
        $newActorEvent->setTypeId($thisEvent['eventTypeId']);
        $newActorEvent->setDescription($thisEvent['description']);
        $newActorEvent->setInformationObjectId($informationObject->getId());

        $newActorEvent->save();
        $this->foreignKeyUpdate = true;
      }

      // add place
      if ($saveEvent && strlen($thisEvent['placeId']))
      {
        $place = new QubitObjectTermRelation;
        $place->setObjectId($newActorEvent->getId());
        $place->setTermId($thisEvent['placeId']);
        $place->save();
      }
    }
  }

  /**
   * Delete related actor events marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteActorEvents($request)
  {
    if (is_array($deleteActorEvents = $request->getParameter('delete_actor_events')) && count($deleteActorEvents))
    {
      foreach ($deleteActorEvents as $thisId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($actorEvent = QubitEvent::getById($thisId)))
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
  public function updateDigitalObjects($request, $informationObject)
  {
    // Set property 'display_as_compound_object'
    if ($request->hasParameter('display_as_compound_object'))
    {
      $informationObject->setDisplayAsCompoundObject($request->getParameter('display_as_compound_object'));
    }

    // Update media type
    if ($request->hasParameter('media_type_id'))
    {
      $digitalObject = $informationObject->getDigitalObject();
      $digitalObject->setMediaTypeId($request->getParameter('media_type_id'));
      $digitalObject->save();
    }

    // Do digital object upload
    $uploadFiles = $request->getFileName('upload_file');
    $fileErrors  = $request->getFileError('upload_file');
    if (count($uploadFiles))
    {
      foreach ($uploadFiles as $usageId => $filename)
      {
        if ($fileErrors[$usageId] && strlen($filename))
        {
          $this->hasWarning = true;

          continue;
        }

        if (strlen(!$filename))
        {
          continue; // Skip to next $uploadFile if no valid filename
        }

        // Upload file and return meta-data about it
        if (!$uploadFile = QubitDigitalObject::uploadAsset($request, $informationObject, $usageId))
        {

          return sfView::ERROR;  // exit loop if upload fails
        }

        // Create digital object in database
        $newDigitalObject = new QubitDigitalObject;
        $newDigitalObject->setName($uploadFile['name']);
        $newDigitalObject->setPath($uploadFile['path']);
        $newDigitalObject->setByteSize($uploadFile['size']);
        $newDigitalObject->setUsageId($usageId);

        // Set parent
        if ($usageId == QubitTerm::MASTER_ID)
        {
          // If this is a master digital object upload, info object is parent
          $newDigitalObject->setInformationObjectId($informationObject->getId());
        }
        else
        {
          // If this is a reference or thumbnail representation for a digital object,
          // then digital object is parent
          $newDigitalObject->setParentId($informationObject->getDigitalObject()->getId());
        }

        // Set Mime Type & File Type
        $newDigitalObject->setMimeAndMediaType();
        $newDigitalObject->save();

        $newDigitalObject->setPageCount();
        if ($newDigitalObject->getPageCount() > 1)
        {
          // If DO is a compound object, then create child objects and set to
          // display as compound object (with pager)
          $newDigitalObject->createCompoundChildren();
          $informationObject->setDisplayAsCompoundObject(1);
          $newDigitalObject->createThumbnail();
        }
        else
        {
          // If DO is a single object, create various representations based on
          // intended usage
          $newDigitalObject->createRepresentations($usageId);
        }

        // If this is a new information object with no title, set title to name
        // of digital object
        if ($request->getParameter('action') == 'update' && $informationObject->getTitle(array('cultureFallback'=>true)) == null && $usageId == QubitTerm::MASTER_ID)
        {
          $informationObject->setTitle($newDigitalObject->getName());
          $informationObject->save();
        }

        $this->foreignKeyUpdate = true;
      } // endforeach
    } // end if

    // Generate a derivative
    if ($request->hasParameter('createDerivative'))
    {
      $digitalObject = $informationObject->getDigitalObject();

      switch ($request->getParameter('createDerivative'))
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
  public function updatePhysicalObjects($informationObject)
  {
    $oldPhysicalObjects = QubitRelation::getRelatedSubjectsByObjectId('QubitPhysicalObject', $informationObject->getId(),
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
      $informationObject->addPhysicalObject($physicalObject);
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
          $informationObject->addPhysicalObject($physicalObject);
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
  public function deleteRelations($request)
  {
    if (is_array($deleteRelations = $request->getParameter('delete_relations')) && count($deleteRelations))
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
