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
    $this->redirect('digitalobject/edit?id='.$digitalObject->getId());
  }
}
