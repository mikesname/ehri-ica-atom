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
 * Digital Object - display digital asset
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class DigitalObjectShowAction extends sfAction
{
  public function execute($request)
  {
    $this->digitalObject = QubitDigitalObject::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->digitalObject);

    // Get information object
    $this->informationObject = $this->digitalObject->getInformationObject();
    $this->forward404Unless($this->informationObject);

    // Set attribute to display current IO in context menu
    $request->setAttribute('informationObject', $this->informationObject);

    // Get derivatives (if any)
    $this->derivatives = null;
    if (count($derivatives = $this->digitalObject->getDigitalObjectsRelatedByParentId()) > 0)
    {
      $this->derivatives = $derivatives;
    }

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject'))
    {
      $this->editCredentials = true;
    }

    // Only fullscreen images right now
    if ($this->digitalObject->getMediaTypeId() == QubitTerm::IMAGE_ID)
    {
      $this->link = 'digitalobject/showFullScreen?id='.$this->digitalObject->getId();
    }
    else
    {
      // Build a fully qualified URL to this digital object asset
      $this->link = $request->getUriPrefix().$request->getRelativeUrlRoot().$this->digitalObject->getFullPath();
    }
  }
}