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

class InformationObjectDeleteAction extends sfAction
{
  public function execute($request)
  {
    $informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));

    $this->forward404Unless($informationObject);

    //retrieve all descendants to be deleted along with this informationObject
    $informationObjects = $informationObject->getDescendants()->andSelf()->orderBy('rgt');

    foreach ($informationObjects as $deleteInformationObject)
    {
      // Delete related digitalObjects
      $this->deleteDigitalObjects($deleteInformationObject);

      //delete the information object record from the database
      $deleteInformationObject->delete();
    }

    return $this->redirect(array('module' => 'informationobject', 'action' => 'list'));
  }

  private function deleteDigitalObjects($informationObject)
  {
    if ($digitalObjects = $informationObject->getDigitalObjects())
    {
      foreach ($digitalObjects as $digitalObject)
      {
        $digitalObject->delete();
      }
    }
  }
}
