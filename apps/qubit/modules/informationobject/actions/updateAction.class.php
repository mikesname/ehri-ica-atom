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
 * @author     ?
 * @version    SVN: $Id
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
    if ($this->hasRequestParameter('version'))
    {
      $informationObject->setVersion($this->getRequestParameter('version'));
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
    if ($this->getRequestParameter('language_code'))
    {
      $informationObject->setProperty($this->getRequestParameter('language_code'), $name = 'information_object_language', $scope = 'languages');
      $this->foreignKeyUpdate = true;
    }
    if ($this->getRequestParameter('script_code'))
    {
      $informationObject->setProperty($this->getRequestParameter('script_code'), $name = 'information_object_script', $scope = 'scripts');
      $this->foreignKeyUpdate = true;
    }
    if ($this->getRequestParameter('description_language_code'))
    {
      $informationObject->setProperty($this->getRequestParameter('description_language_code'), $name = 'language_of_information_object_description', $scope = 'languages');
      $this->foreignKeyUpdate = true;
    }
    if ($this->getRequestParameter('description_script_code'))
    {
      $informationObject->setProperty($this->getRequestParameter('description_script_code'), $name = 'script_of_information_object_description', $scope = 'scripts');
      $this->foreignKeyUpdate = true;
    }
  }

  public function updateObjectTermRelations($informationObject)
    {
    if ($this->getRequestParameter('subject_id'))
      {
      $informationObject->setTermRelation($this->getRequestParameter('subject_id'), QubitTaxonomy::SUBJECT_ID);
      $this->foreignKeyUpdate = true;
      }

    if ($this->getRequestParameter('place_id'))
      {
      $informationObject->setTermRelation($this->getRequestParameter('place_id'), $relationTypeId = 337);
      $this->foreignKeyUpdate = true;
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

    if ($this->getRequestParameter('name_id'))
      {
        $newNameAccessPoint = new QubitEvent;
        $newNameAccessPoint->setActorId($this->getRequestParameter('name_id'));
        $newNameAccessPoint->setActorRoleId(QubitTerm::SUBJECT_ID);
        $newNameAccessPoint->setInformationObjectId($informationObject->getId());

        $newNameAccessPoint->save();
        $this->foreignKeyUpdate = true;
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

    foreach ($uploadFiles as $usageId => $filename)
    {
        if (strlen($filename))
        {
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
            $newDigitalObject->createVideoDerivative(QubitTerm::REFERENCE_ID);
          }

          // If this is a new information object with no title, set title to name
          // of digital object
          if ($request->getParameter('action') == 'update' && $informationObject->getTitle() == null && $usageId == QubitTerm::MASTER_ID)
          {
            $informationObject->setTitle($newDigitalObject->getName());
            $informationObject->save();
          }

          $this->foreignKeyUpdate = true;
        } // endif
      } // endforeach

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
 }
