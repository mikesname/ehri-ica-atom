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
 * Physical Object edit component.
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     david juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class InformationObjectEditPhysicalObjectsAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    $this->informationObject = QubitInformationObject::getById($request->id);

    // Check that object exists and that it is not the root
    if (!isset($this->informationObject) || !isset($this->informationObject->parent))
    {
      $this->forward404();
    }

    $request->setAttribute('informationObject', $this->informationObject);

    $this->relations = QubitRelation::getRelationsByObjectId($this->informationObject->getId(), array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    if ($request->isMethod('post'))
    {
      $this->updatePhysicalObjects();
      $this->deleteRelations();

      $this->informationObject->save();

      $this->redirect(array('module' => 'informationobject', 'action' => 'show', 'id' => $this->informationObject->id));
    }
  }

  /**
   * Update physical object relations.
   *
   * @param  informationObject The current informationObject object
   */
  public function updatePhysicalObjects()
  {
    $oldPhysicalObjects = QubitRelation::getRelatedSubjectsByObjectId('QubitPhysicalObject', $this->informationObject->getId(),
    array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    // Preferentially use "new container" input data over the selector so that
    // new object data is not lost (but only if an object name is entered)
    if (strlen($physicalObjectName = $this->getRequestParameter('physicalObjectName')))
    {
      $physicalObject = new QubitPhysicalObject;

      $physicalObject->setName($physicalObjectName);

      if ($this->hasRequestParameter('physicalObjectLocation'))
      {
        $physicalObject->setLocation($this->getRequestParameter('physicalObjectLocation'));
      }

      if (intval($this->getRequestParameter('physicalObjectTypeId')))
      {
        $physicalObject->setTypeId($this->getRequestParameter('physicalObjectTypeId'));
      }
      $physicalObject->save();

      // Link info object to physical object
      $this->informationObject->addPhysicalObject($physicalObject);
    }

    // If form is not populated, Add any existing physical objects that are selected
    else if ($physicalObjectIds = $this->getRequestParameter('physicalObjectId'))
    {
      // Make sure that $physicalObjectIds is an array, even if it's only got one value
      $physicalObjectIds = (is_array($physicalObjectIds)) ? $physicalObjectIds : array($physicalObjectIds);

      foreach ($physicalObjectIds as $physicalObjectId)
      {
        // If a value is set for this select box, and the physical object exists,
        // add a relation to this info object
        if (intval($physicalObjectId) && (null !== $physicalObject = QubitPhysicalObject::getById($physicalObjectId)))
        {
          $this->informationObject->addPhysicalObject($physicalObject);
        }
      }
    }

  } // end method: updatePhysicalObjects

  /**
   * Delete related physical objects marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteRelations()
  {
    if (is_array($deleteRelations = $this->request->getParameter('delete_relations')) && count($deleteRelations))
    {
      foreach ($deleteRelations as $thisId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($relation = QubitRelation::getById($thisId)))
        {
          $relation->delete();
        }
      }
    }
  }
}
