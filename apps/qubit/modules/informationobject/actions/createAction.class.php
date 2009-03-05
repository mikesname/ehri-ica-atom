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

class InformationObjectCreateAction extends sfAction
{
  public function execute($request)
  {
    //initialize a new information object
    $this->informationObject = new QubitInformationObject;

    $request->setAttribute('informationObject', $this->informationObject);

    // Add javascript libraries to allow adding multiple instances of a select box
    $this->getResponse()->addJavaScript('/vendor/jquery/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
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
