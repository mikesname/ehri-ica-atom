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
class InformationObjectIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->object = QubitInformationObject::getById($request->id);

    // Check that object exists and that it is not the root
    if (!isset($this->object) || !isset($this->object->parent))
    {
      $this->forward404();
    }

    // Check user authorization
    if (!QubitAcl::check($this->object, 'read'))
    {
      QubitAcl::forwardUnauthorized();
    }

    QubitImageFlow::addAssets($this->response);

    QubitTreeView::addAssets($this->response);

    // HACK: populate information object from ORM
    $request->setAttribute('informationObject', $this->object);

    // Only show link to view/download master copy of digital object if the
    // user has readMaster permissions OR it's a text object (to allow reading)
    $this->digitalObjectLink = null;
    if (0 < count($this->object->digitalObjects)
      && (QubitAcl::check($this->object, 'readMaster')
        || in_array($this->object->digitalObjects[0]->mediaTypeId, array(QubitTerm::TEXT_ID, QubitTerm::AUDIO_ID))))
    {
      if (QubitTerm::EXTERNAL_URI_ID == $this->object->digitalObjects[0]->usageId)
      {
        $this->digitalObjectLink = $this->object->digitalObjects[0]->path;
      }
      else
      {
        $this->digitalObjectLink = $request->getUriPrefix().$request->getRelativeUrlRoot().$this->object->digitalObjects[0]->getFullPath();
      }
    }
  }
}
