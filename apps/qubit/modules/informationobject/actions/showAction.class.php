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

class InformationObjectShowAction extends sfAction
{
  public function execute($request)
  {
    $this->informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->informationObject);

    // HACK: populate information object from ORM
    $request->setAttribute('informationObject', $this->informationObject);

    $this->creators = $this->informationObject->getCreators();

    //Properties
    $this->languageCodes = $this->informationObject->getProperties($name = 'information_object_language');
    $this->scriptCodes = $this->informationObject->getProperties($name = 'information_object_script');
    $this->descriptionLanguageCodes = $this->informationObject->getProperties($name = 'language_of_information_object_description');
    $this->descriptionScriptCodes = $this->informationObject->getProperties($name = 'script_of_information_object_description');

    $this->notes = $this->informationObject->getNotes();
    $this->datesOfDescription = $this->informationObject->getDatesOfDescription();

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
    $this->physicalObjects = QubitRelation::getRelatedSubjectsByObjectId($this->informationObject->getId(),
      array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject'))
    {
      $this->editCredentials = true;
    }

    //set template
    switch ($this->getRequestParameter('template'))
    {
      case 'dublincore' :
        $this->setTemplate('showDublinCore');
        break;
      case 'isad' :
        $this->setTemplate('showISAD');
        break;
      case 'mods' :
        $this->setTemplate('showMODS');
        break;
      default :
        $this->setTemplate(sfConfig::get('app_default_template_informationobject_show'));
    }
  }
}
