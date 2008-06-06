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

class InformationObjectEditAction extends sfAction
{
  public function execute($request)
  {
    $this->informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));

    $this->forward404Unless($this->informationObject);

    $request->setAttribute('informationObject', $this->informationObject);

    //Actor (Event) Relations
    $this->creationEvents = $this->informationObject->getCreationEvents();
    $this->newCreationEvent = new QubitEvent;
    $this->creators = $this->informationObject->getCreators();

    //Properties
    $this->languageCodes = $this->informationObject->getProperties($name = 'information_object_language');
    $this->scriptCodes = $this->informationObject->getProperties($name = 'information_object_script');
    $this->descriptionLanguageCodes = $this->informationObject->getProperties($name = 'language_of_information_object_description');
    $this->descriptionScriptCodes = $this->informationObject->getProperties($name = 'script_of_information_object_description');

    //Notes
    $this->notes = $this->informationObject->getNotes();
    $this->newNote = new QubitNote;
    $this->titleNotes = $this->informationObject->getNotesByType($noteTypeId = QubitTerm::TITLE_NOTE_ID, $exclude = null);
    $this->newTitleNote = new QubitNote;
    $this->publicationNotes = $this->informationObject->getNotesByType($noteTypeId = QubitTerm::PUBLICATION_NOTE_ID, $exclude = null);
    $this->newPublicationNote = new QubitNote;

    //Access Points
    $this->newSubjectAccessPoint = new QubitObjectTermRelation;
    $this->newPlaceAccessPoint = new QubitObjectTermRelation;
    $this->subjectAccessPoints = $this->informationObject->getSubjectAccessPoints();
    $this->placeAccessPoints = $this->informationObject->getPlaceAccessPoints();
    $this->nameSelectList = QubitActor::getAccessPointSelectList();
    $this->nameAccessPoints = array();
    $actorEvents =  $this->informationObject->getActorEvents();
    foreach ($actorEvents as $event)
    {
      if ($event->getActorId())
      {
        $this->nameAccessPoints[] = $event;
      }
    }

    // Get related digital object with all representations
    $this->digitalObjectCount = 0;
    $this->digitalObject = $this->informationObject->getDigitalObject();
    if (count($this->digitalObject))
    {
      $representations[QubitTerm::MASTER_ID] = $this->digitalObject;
      $representations[QubitTerm::REFERENCE_ID] = $this->digitalObject->getChildByUsageId(QubitTerm::REFERENCE_ID);
      $representations[QubitTerm::THUMBNAIL_ID] = $this->digitalObject->getChildByUsageId(QubitTerm::THUMBNAIL_ID);
      $this->representations = $representations;

      $this->digitalObjectCount = count($this->digitalObject->getDescendants()->andSelf());
    }

    //set template
    switch ($this->getRequestParameter('template'))
      {
      case 'dublincore' :
        $this->setTemplate('editDublinCore');
        break;
      case 'isad' :
        $this->setTemplate('editISAD');
        break;
      case 'mods' :
        $this->setTemplate('editMODS');
        break;
      case 'edit' :
        $this->setTemplate('edit');
        break;
      default :
        $this->setTemplate(sfConfig::get('app_default_template_informationobject_edit'));
      }
  }
}
