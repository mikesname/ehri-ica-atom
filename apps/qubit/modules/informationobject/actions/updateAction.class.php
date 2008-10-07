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
      $informationObject = new QubitInformationObject;

      $this->getUser()->setAttribute('nav_context_module', 'add');
    }
    else
    {
      $informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));
      $this->forward404Unless($informationObject);
    }

    $this->foreignKeyUpdate = false;

    // set the informationObject's attributes
    $informationObject->setId($this->getRequestParameter('id'));
    $this->updateInformationObjectAttributes($informationObject);
    $this->updateOneToManyRelations($informationObject);
    $this->updateCollectionType($informationObject);
    $this->updateHierarchy($informationObject);

    // save informationObject after setting all of its attributes...
    $informationObject->save();

    // ...now save objects related to this informationObject
    $this->updateNotes($informationObject);
    $this->updateProperties($informationObject);
    $this->updateObjectTermRelations($informationObject);
    $this->updateActorEvents($informationObject);
    $this->updateDigitalObjects($request,$informationObject);
    $this->updatePhysicalObjects($informationObject);
    //$this->updateRecursiveRelations($informationObject);

    // update informationObject in the search index
    if (!$this->foreignKeyUpdate)
    {
      SearchIndex::updateIndexDocument($informationObject, $this->getUser()->getCulture());
    }
    else
    {
      SearchIndex::updateTranslatedLanguages($informationObject);
    }

    // set view template
    switch ($this->getRequestParameter('template'))
      {
      case 'anotherTemplate' :
        return $this->redirect('informationobject/edit?id='.$informationObject->getId().'&template=editAnotherTemplate');
        break;
      case 'isad' :
        return $this->redirect('informationobject/edit?id='.$informationObject->getId().'&template=isad');
        break;
      default :
        return $this->redirect('informationobject/edit?id='.$informationObject->getId());
      }
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
      $informationObject->setVersion($this->getRequestParameter('edition'));
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
        $criteria = new Criteria;
        $criteria = QubitInformationObject::addRootsCriteria($criteria);
        $parentId = QubitInformationObject::getOne($criteria)->getId();
      }
      $informationObject->setParentId($parentId);
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
      $informationObject->setNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('new_title_note'), QubitTerm::TITLE_NOTE_ID);
    }

    if ($this->getRequestParameter('new_publication_note'))
    {
      $informationObject->setNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('new_publication_note'), QubitTerm::PUBLICATION_NOTE_ID);
    }

    if ($this->getRequestParameter('content'))
    {
      $informationObject->setNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('content'), $this->getRequestParameter('note_type_id'));
    }
  }

  public function updateProperties($informationObject)
  {
    
    // Add multiple languages of access
    if ($language_codes = $this->getRequestParameter('language_code'))
    {
      // If string, turn into single element array
      $language_codes = (is_array($language_codes)) ? $language_codes : array($language_codes);
      
      foreach ($language_codes as $language_code) {
        if (strlen($language_code)) {
          $informationObject->addProperty($name = 'information_object_language', $language_code, $scope = 'languages');
	        $this->foreignKeyUpdate = true;
        }
      }
    }
    
    // Add multiple scripts of access
    if ($script_codes = $this->getRequestParameter('script_code'))
    {
      // If string, turn into single element array
      $script_codes = (is_array($script_codes)) ? $script_codes : array($script_codes);
      
      foreach ($script_codes as $script_code) {
        if (strlen($script_code)) {
          $informationObject->addProperty($name = 'information_object_script', $script_code, $scope = 'scripts');
          $this->foreignKeyUpdate = true;
        }
      }
    }
    
    // Add multiple languages of description
    if ($language_codes = $this->getRequestParameter('description_language_code'))
    {
      // If string, turn into single element array
      $language_codes = (is_array($language_codes)) ? $language_codes : array($language_codes);
      
      foreach ($language_codes as $language_code) {
        if (strlen($language_code)) {
          $informationObject->addProperty($name = 'language_of_information_object_description', $language_code, $scope = 'languages');
          $this->foreignKeyUpdate = true;
        }
      }
    }
    
    // Add multiple scripts of description
    if ($script_codes = $this->getRequestParameter('description_script_code'))
    {
      // If string, turn into single element array
      $script_codes = (is_array($script_codes)) ? $script_codes : array($script_codes);
      
      foreach ($script_codes as $script_code) {
        if (strlen($script_code)) {
          $informationObject->addProperty($name = 'script_of_information_object_description', $script_code, $scope = 'scripts');
          $this->foreignKeyUpdate = true;
        }
      }
    }
  }
  
  /**
   * Update ObjectTermRelations (Subject and place access points)
   * 
   * @param QubitInformationObject $informationObject current information objects 
   */
  public function updateObjectTermRelations($informationObject)
  {
    if ($subject_ids = $this->getRequestParameter('subject_id'))
    {
      // Make sure that $subject_id is an array, even if it's only got one value
      $subject_ids = (is_array($subject_ids)) ? $subject_ids : array($subject_ids);
      
      foreach ($subject_ids as $subject_id) {
        if (intval($subject_id)) {
          $informationObject->addTermRelation($subject_id, QubitTaxonomy::SUBJECT_ID);
          $this->foreignKeyUpdate = true;
      
        }
      }
    }

    if ($place_ids = $this->getRequestParameter('place_id'))
    {
      // Make sure that $place_id is an array, even if it's only got one value
      $place_ids = (is_array($place_ids)) ? $place_ids : array($place_ids);
      
      foreach ($place_ids as $place_id) {
        if (intval($place_id)) {
	        $informationObject->addTermRelation($place_id, QubitTaxonomy::PLACE_ID);
		      $this->foreignKeyUpdate = true;
        }
      }
    }
  }

  public function updateActorEvents($informationObject)
  {
    $newCreationEvent = new QubitEvent;
    
    //add creator
    if ($this->getRequestParameter('actor_id'))
    {
      $newCreationEvent->setActorId($this->getRequestParameter('actor_id'));
      $newCreationEvent->setInformationObjectId($informationObject->getId());
      $newCreationEvent->setActorRoleId(QubitTerm::CREATOR_ID);
      $newCreationEvent->save();
      $this->foreignKeyUpdate = true;
    }
    else if ($this->getRequestParameter('newActorAuthorizedName'))
    {
      $actor = new QubitActor;
      $actor->setAuthorizedFormOfName($this->getRequestParameter('newActorAuthorizedName'));
      $actor->save();
      $newCreationEvent->setActorId($actor->getId());
      $newCreationEvent->setInformationObjectId($informationObject->getId());
      $newCreationEvent->setActorRoleId(QubitTerm::CREATOR_ID);
      $newCreationEvent->save();
      $this->foreignKeyUpdate = true;
    }

    //add creation event date/date range
    if (($this->getRequestParameter('creationYear')) or ($this->getRequestParameter('newCreationDateNote')))
    {
      $newCreationEvent->setTypeId(QubitTerm::CREATION_ID);
      $newCreationEvent->setInformationObjectId($informationObject->getId());
      $newCreationEvent->setStartDate($this->getRequestParameter('creationYear').'-01-01');
      $newCreationEvent->setEndDate($this->getRequestParameter('endYear').'-01-01');

      if ($this->getRequestParameter('newCreationDateNote'))
      {
        $newCreationEvent->setDescription($this->getRequestParameter('newCreationDateNote'));
      }
      else
      {
        $dateString = $this->getRequestParameter('creationYear');
        if ($this->getRequestParameter('endYear'))
        {
          $dateString .= ' - '.$this->getRequestParameter('endYear');
        }
        $newCreationEvent->setDescription($dateString);
      }

      $newCreationEvent->save();
      $this->foreignKeyUpdate = true;
    }

    if ($name_ids = $this->getRequestParameter('name_id'))
    {
      // Make sure that $name_ids is an array, even if it's only got one value
      $name_ids = (is_array($name_ids)) ? $name_ids : array($name_ids);
      
      foreach ($name_ids as $name_id) {
        if (intval($name_id)) {
	        $informationObject->addNameAccessPoint($name_id, QubitTerm::SUBJECT_ID);
	        $this->foreignKeyUpdate = true;
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
   *
   * @todo address filename clashes when multiple files with the same name are added to a digital object (e.g. a thumbnail and reference image)
   *
   * @return mixed  array of file metadata on sucess, false on failure
   */
  public function updateDigitalObjects($request, $informationObject)
  {
    $uploadFiles = $request->getFileName('upload_file');
    
    if (count($uploadFiles)) 
    {
      
      foreach ($uploadFiles as $usageId => $filename)
      {
        if (strlen(!$filename)) 
        {
          continue; // Skip to next $uploadFile if no valid filename
        }
        
        // Upload file and return meta-data about it
        if (!$uploadFile = DigitalObjectUploadComponent::uploadAsset($request, $informationObject, $usageId))
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

        // Scale images (and pdfs) and create derivatives
        if ($newDigitalObject->canThumbnail())
        {
          if ($usageId == QubitTerm::MASTER_ID)
          {
            $newDigitalObject->createReferenceImage();
            $newDigitalObject->createThumbnail();
          }
          else if ($usageId == QubitTerm::REFERENCE_ID)
          {
            $newDigitalObject->resizeByUsageId(QubitTerm::REFERENCE_ID);
            $newDigitalObject->createThumbnail();
          }
          else if ($usageId == QubitTerm::THUMBNAIL_ID)
          {
            $newDigitalObject->resizeByUsageId(QubitTerm::THUMBNAIL_ID);
          }
        }

        if ($newDigitalObject->getMediaType() == 'video')
        {
          if ($usageId == QubitTerm::MASTER_ID)
          {
            $newDigitalObject->createVideoDerivative(QubitTerm::REFERENCE_ID);
            $newDigitalObject->createVideoDerivative(QubitTerm::THUMBNAIL_ID);
          }
          
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
    $oldPhysicalObjects = QubitRelation::getRelatedSubjectsByObjectId($informationObject->getId(),
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
      
      foreach ($physicalObjectIds as $physicalObjectId) {
        
        // If a value is set for this select box, and the physical object exists,
        // add a relation to this info object
        if (intval($physicalObjectId) && (null !== $physicalObject = QubitPhysicalObject::getById($physicalObjectId))) {
          $informationObject->addPhysicalObject($physicalObject);
          $this->foreignKeyUpdate = true;
        }
      }
    }
    
  } // end method: updatePhysicalObjects
}
