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

class InformationObjectTreeViewAction extends sfAction
{
  public function execute($request)
  {
    // Get data
    $informationObject = QubitInformationObject::getById($this->getRequestParameter('id'));
    $informationObjects = $informationObject->getChildren()->orderBy('lft');

    // Objects
    $treeViewObject = array();
    $treeViewObjects = array();

    foreach ($informationObjects as $informationObject)
    {
      $treeViewObject['label'] = (string) $informationObject->getLabel(array('truncate' => 50)); // call render_title
      $treeViewObject['href'] = $this->getController()->genUrl('informationobject/show?id='.$informationObject->getId());
      $treeViewObject['id'] = $informationObject->getId();
      $treeViewObject['parentId'] = $informationObject->getParentId();
      $treeViewObject['isLeaf'] = (string) count($informationObject->getDescendants()) == 0;

      $treeViewObjects[] = $treeViewObject;
    }

    // Prepare and print output
    $treeViewObjects = json_encode($treeViewObjects);
    $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
    return $this->renderText('('.$treeViewObjects.')');
  }
}
