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
    $informationObject = QubitInformationObject::getById($request->id);

    $this->response->setHttpHeader('Content-Type', 'application/json; charset=utf-8');

    $treeViewObjects = array();
    foreach ($informationObject->getChildren()->orderBy('lft') as $item)
    {
      $treeViewObject = array();
      $treeViewObject['label'] = $item->getLabel(array('truncate' => 50)); // call render_title
      $treeViewObject['href'] = $this->context->routing->generate(null, array($item, 'module' => 'informationobject'));
      $treeViewObject['id'] = $item->id;
      $treeViewObject['parentId'] = $item->parentId;
      $treeViewObject['isLeaf'] = !$item->hasChildren();

      $treeViewObjects[] = $treeViewObject;
    }

    return $this->renderText(json_encode($treeViewObjects));
  }
}
