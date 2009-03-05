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
 * Display a digital asset
 *
 * @package    qubit
 * @subpackage digital object
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
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
    $this->link = null;

    // Only allow fullscreen view or download if user has edit credentials
    if ($this->editCredentials)
    {
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
}