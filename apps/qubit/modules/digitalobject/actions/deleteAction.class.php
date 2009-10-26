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
 * Digital Object deletion
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class DigitalObjectDeleteAction extends sfAction
{
  public function execute($request)
  {
    $digitalObject = QubitDigitalObject::getById($this->getRequestParameter('id'));
    $this->forward404Unless($digitalObject);

    // Get related information object by first grabbing top-level digital object
    $parent = $digitalObject->getParent();
    if (null == $parent)
    {
      $informationObject = $digitalObject->getInformationObject();
      $this->forward404Unless($informationObject);
    }

    //delete the digital object record from the database
    $digitalObject->delete();

    // Redirect to edit page for parent Info Object
    if (null !== $parent)
    {
      $this->redirect(array('module' => 'digitalobject', 'action' => 'edit', 'id' => $parent->id));
    }
    else
    {
      $this->redirect(array('module' => 'informationobject', 'action' => 'show', 'id' => $informationObject->id));
    }
  }
}
