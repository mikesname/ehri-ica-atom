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
 * Display an information object
 *
 * @package    qubit
 * @subpackage information object
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com> 
 */
class InformationObjectShowAction extends sfAction
{
  public function execute($request)
  {
    $this->informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));

    // Check that object exists and that it is not the root
    if (!isset($this->informationObject) || !isset($this->informationObject->parent))
    {
      $this->forward404();
    }

    // HACK: populate information object from ORM
    $request->setAttribute('informationObject', $this->informationObject);

    // Determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject'))
    {
      $this->editCredentials = true;
    }

    // Events
    $this->actorEvents = $this->informationObject->getActorEvents();
    $this->creators = $this->informationObject->getCreators();

    // Properties
    $this->languageCodes = $this->informationObject->getProperties($name = 'information_object_language');
    $this->scriptCodes = $this->informationObject->getProperties($name = 'information_object_script');
    $this->descriptionLanguageCodes = $this->informationObject->getProperties($name = 'language_of_information_object_description');
    $this->descriptionScriptCodes = $this->informationObject->getProperties($name = 'script_of_information_object_description');

    // Notes
    $this->notes = $this->informationObject->getNotes();

    // Access points
    $this->subjectAccessPoints = $this->informationObject->getSubjectAccessPoints();
    $this->placeAccessPoints = $this->informationObject->getPlaceAccessPoints();
    $this->nameAccessPoints = array();
    $actorEvents = $this->informationObject->getActorEvents();
    foreach ($actorEvents as $event)
    {
      if ($event->getActorId())
      {
        $this->nameAccessPoints[] = $event;
      }
    }

    // Material types
    $this->materialTypes = $this->informationObject->getMaterialTypes();

    // Physical objects
    $this->physicalObjects = QubitRelation::getRelatedSubjectsByObjectId('QubitPhysicalObject', $this->informationObject->getId(),
      array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    // Digital object
    $this->digitalObject = $this->informationObject->getDigitalObject();

    // Display reference as compound digital object?
    $this->showCompoundDigitalObject = $this->informationObject->showAsCompoundDigitalObject(QubitTerm::REFERENCE_ID);

    // Only show link to view/download master copy of digital object if
    // the user has edit credentials OR it's a text object (to allow reading)
    $this->digitalObjectLink = null;
    if (null !== $this->digitalObject && ($this->editCredentials || $this->digitalObject->getMediaTypeId() == QubitTerm::TEXT_ID))
    {
      if ($this->digitalObject->isImage())
      {
        $this->digitalObjectLink = 'digitalobject/showFullScreen?id='.$this->digitalObject->getId();
      }
      else
      {
        // Build a fully qualified URL to this digital object asset
        $this->digitalObjectLink = $request->getUriPrefix().$request->getRelativeUrlRoot().$this->digitalObject->getFullPath();
      }
    }
  }
}
