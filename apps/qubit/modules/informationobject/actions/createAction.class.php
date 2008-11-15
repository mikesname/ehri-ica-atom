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

   // Add javascript libraries to allow adding multiple instances of a select box
   $this->getResponse()->addJavaScript('jquery');
   $this->getResponse()->addJavaScript('/vendor/drupal/misc/drupal');
   $this->getResponse()->addJavaScript('multiInstanceSelect');

   // TermManyToManyRelations
   $this->subjectAccessPoints = null;
   $this->placeAccessPoints = null;
   $this->nameAccessPoints = null;

   // Properties
   $this->languageCodes = null;
   $this->scriptCodes = null;
   $this->descriptionLanguageCodes = null;
   $this->descriptionScriptCodes = null;

   // Access Points
   $this->newSubjectAccessPoint = new QubitObjectTermRelation;
   $this->newPlaceAccessPoint = new QubitObjectTermRelation;
   $this->nameSelectList = QubitActor::getAccessPointSelectList();

   // Material Type
   $this->newMaterialType = new QubitObjectTermRelation;
   $this->materialTypes = null;

   // Notes
   $this->notes = null;
   $this->noteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::NOTE_TYPE_ID);
   $this->titleNotes = null;
   $this->publicationNotes = null;

   // Actor (Event) Relations
   $this->actorEvents = null;
   $this->creators = null;
   $this->actorEventTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::EVENT_TYPE_ID);
   $this->defaultActorEventType = QubitTerm::CREATION_ID;
   $this->actorEventPlaces = QubitTerm::getOptionsForSelectList(QubitTaxonomy::PLACE_ID, $options = array('include_blank' => true));
   $this->newActorEvent = new QubitEvent;

   // Digital Object
   $this->digitalObject = null;

   // Physical Object
   $this->physicalObject = null;
  }
}
