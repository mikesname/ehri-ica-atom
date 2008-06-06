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
 * Digital Object - Update database from "edit" form
 *
 * @package    qubit
 * @subpackage digitalobject
 * @author     david juhasz <david@artefactual.com>
 * @version    SVN: $Id
 *
 */
class DigitalObjectUpdateAction extends sfAction
{
  public function execute($request)
  {
    $digitalObject = QubitDigitalObject::getById($this->getRequestParameter('id'));
    $this->forward404Unless($digitalObject);

    // set the digital object's attributes
    $digitalObject->setUsageId($request->getParameter('usage_id'));
    $digitalObject->setMediaTypeId($request->getParameter('media_type_id'));

    // Save the digital object
    $digitalObject->save();

    // Return to edit page
    return $this->redirect('digitalobject/edit?id='.$digitalObject->getId());
  }
}
