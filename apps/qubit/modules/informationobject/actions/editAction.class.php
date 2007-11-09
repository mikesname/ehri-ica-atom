<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class editAction extends sfAction
{
  public function execute()
  {

   $this->informationObject = informationObjectPeer::retrieveByPk($this->getRequestParameter('id'));

   $this->forward404Unless($this->informationObject);

   //TermManyToManyRelationships
   $this->languages = $this->informationObject->getLanguages();
   $this->scripts = $this->informationObject->getScripts();
   $this->subjectAccessPoints = $this->informationObject->getSubjectAccessPoints();
   $this->placeAccessPoints = $this->informationObject->getPlaceAccessPoints();

   $this->newLanguage = new informationObjectTermRelationship();
   $this->newScript = new informationObjectTermRelationship();
   $this->newSubjectAccessPoint = new informationObjectTermRelationship();
   $this->newPlaceAccessPoint = new informationObjectTermRelationship();

   //Notes
   $this->notes = $this->informationObject->getInformationObjectNotes($noteTypeId = null, $exclude = 317);
   $this->newNote = new Note();
   $this->titleNotes = $this->informationObject->getInformationObjectNotes($noteTypeId = 317, $exclude = null);
   $this->newTitleNote = new Note();


   //Multilevel
   $this->informationObjectPicklist = $this->informationObject->getInformationObjectPicklist();
   if ($this->informationObject->getTreeParentId())
      {
      //$this->selectedParent = $this->informationObject->getTreeParentId();
      $this->selectedParent = 0;
      $this->parent = informationObjectPeer::retrieveByPk($this->informationObject->getTreeParentId());
      }
   else
      {
      $this->selectedParent = 0;
      $this->parent = null;
      }

   //Actor (Event) Relationships
   $this->creationEvents = $this->informationObject->getCreationEvents();
   $this->newCreationEvent = new Event();
   $this->creators = $this->informationObject->getCreators();

   /*
   $this->actorAccessPoints = $this->informationObject->getActorAccessPoints();
   $this->newActorAccessPoint = new Event();
   */


   //set template
   switch ($this->getRequestParameter('template'))
      {
      case 'anotherTemplate' :
        $this->setTemplate('editAnotherTemplate');
        break;
      case 'isad' :
        $this->setTemplate('editISAD');
        break;
      default :
        $this->setTemplate(sfConfig::get('app_default_template_informationobject_edit'));
        break;
      }


  }
}
