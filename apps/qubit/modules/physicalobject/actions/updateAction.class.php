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
 * Physical Object update action
 *
 * @package qubit
 * @subpackage physicalobject
 * @author david juhasz <david@artefactual.com>
 * @version svn:$Id
 */
class PhysicalObjectUpdateAction extends sfAction
{

  /**
   * Main
   *
   * @param sfRequest $request
   */
  public function execute($request)
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $physicalObject = new QubitPhysicalObject;
    }
    else
    {
      $physicalObject = QubitPhysicalObject::getById($this->getRequestParameter('id'));
      $this->forward404Unless($physicalObject);
    }

    // Update objects
    $this->updateContainerAttributes($physicalObject);

    // Redirect to information object edit page
    if ($this->hasRequestParameter('next'))
    {
      $this->redirect($request->next);
    }

    // Default redirect
    $this->redirect('physicalobject/edit?id='.$physicalObject->getId());
  }


  /**
   * Update container attributes
   *
   * @param QubitPhysicalObject $physicalObject
   */
  public function updateContainerAttributes($physicalObject)
  {
    $physicalObject->setName($this->getRequestParameter('name'));
    $physicalObject->setLocation($this->getRequestParameter('location'));

    // Set typeId to null if option "0" (blank) selected
    if ($this->getRequestParameter('typeId') === '')
    {
      $physicalObject->setTypeId(null);
    }
    else
    {
      $physicalObject->setTypeId($this->getRequestParameter('typeId'));
    }
    $physicalObject->save();
  }
}
