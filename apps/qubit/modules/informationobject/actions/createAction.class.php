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

class InformationObjectCreateAction extends sfAction
{
  public function execute($request)
  {
   //initialize a new information object
   $this->informationObject = new QubitInformationObject;

   $request->setAttribute('informationObject', $this->informationObject);

   //TermManyToManyRelations
   $this->subjectAccessPoints = null;
   $this->placeAccessPoints = null;
   $this->nameAccessPoints = null;

   //Properties
   $this->languageCodes = null;
   $this->scriptCodes = null;
   $this->descriptionLanguageCodes = null;
   $this->descriptionScriptCodes = null;

   //Access Points
   $this->newSubjectAccessPoint = new QubitObjectTermRelation;
   $this->newPlaceAccessPoint = new QubitObjectTermRelation;
   $this->nameSelectList = QubitActor::getAccessPointSelectList();

   //Notes
   $this->notes = null;
   $this->newNote = new QubitNote;
   $this->titleNotes = null;
   $this->newTitleNote = new QubitNote;
   $this->publicationNotes = null;
   $this->newPublicationNote = new QubitNote;

   //Actor (Event) Relations
   $this->creationEvents = null;
   $this->creators = null;
   $this->newCreationEvent = new QubitEvent;

   // Digital Objects
   $this->digitalObject = null;

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
