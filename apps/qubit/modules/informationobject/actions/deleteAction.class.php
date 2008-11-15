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
      //delete existing entries for this information object from the search index
      SearchIndex::deleteIndexDocument($deleteInformationObject);

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
