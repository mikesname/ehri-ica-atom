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

class TermTreeViewAction extends sfAction
{
  public function execute($request)
  {
    // Get data
    $term = QubitTerm::getById($this->getRequestParameter('id'));

    // Objects
    $treeViewObject = array();
    $treeViewObjects = array();

    if (0 < count($children = $term->getChildren(array('sortBy' => 'name'))))
    {
      foreach ($children as $child)
      {
        $treeViewObject['label'] = (string) $child->getName(array('cultureFallback' => true, 'truncate' => 50));
        $treeViewObject['href'] = $this->getController()->genUrl('term/show?id='.$child->getId());
        $treeViewObject['id'] = $child->getId();
        $treeViewObject['parentId'] = $child->getParentId();
        $treeViewObject['isLeaf'] = (string) count($child->getDescendants()) == 0;

        $treeViewObjects[] = $treeViewObject;
      }
    }

    // Prepare and print output
    $treeViewObjects = json_encode($treeViewObjects);
    $this->getResponse()->setHttpHeader('Content-Type', 'application/json; charset=utf-8');
    return $this->renderText('('.$treeViewObjects.')');
  }
}
