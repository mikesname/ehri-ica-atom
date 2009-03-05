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
    $this->informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->informationObject);

    $request->setAttribute('informationObject', $this->informationObject);

    $this->warnings = array();

    // Add javascript libraries to allow selecting multiple access points
    $this->getResponse()->addJavaScript('/vendor/jquery/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');
    $this->getResponse()->addJavaScript('multiDelete');

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
  }
}
