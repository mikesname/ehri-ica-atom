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

    // Check user authorization
    if (!QubitAcl::check($this->informationObject, QubitAclAction::READ_ID))
    {
      QubitAcl::forwardUnauthorized();
    }

    // HACK: populate information object from ORM
    $request->setAttribute('informationObject', $this->informationObject);

    // Access points
    $this->nameAccessPoints = array();
    foreach ($this->informationObject->getActorEvents() as $event)
    {
      if (isset($event->actorId))
      {
        $this->nameAccessPoints[] = $event;
      }
    }
    foreach ($this->informationObject->relationsRelatedBysubjectId as $relation)
    {
      if (QubitTerm::NAME_ACCESS_POINT_ID == $relation->typeId)
      {
        $this->nameAccessPoints[] = $relation;
      }
    }

    // Get *one* digital object (relationship must be 1-to-1)
    $this->digitalObject = null;
    if (null != ($digitalObjects = $this->informationObject->digitalObjects))
    {
      $this->digitalObject = $digitalObjects[0];
    }

    // Physical objects
    $this->physicalObjects = QubitRelation::getRelatedSubjectsByObjectId('QubitPhysicalObject', $this->informationObject->getId(),
      array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    // Only show link to view/download master copy of digital object if
    // the user has edit credentials OR it's a text object (to allow reading)
    $this->digitalObjectLink = null;
    if (0 < count($this->informationObject->digitalObjects)
      && (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject')
        || QubitTerm::TEXT_ID == $this->informationObject->digitalObjects[0]->getMediaTypeId()))
    {
      if ($this->informationObject->digitalObjects[0]->isImage())
      {
        $this->digitalObjectLink = 'digitalobject/showFullScreen?id='.$this->informationObject->digitalObjects[0]->getId();
      }
      else
      {
        // Build a fully qualified URL to this digital object asset
        $this->digitalObjectLink = $request->getUriPrefix().$request->getRelativeUrlRoot().$this->informationObject->digitalObjects[0]->getFullPath();
      }
    }
  }
}
