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

class InformationObjectTreeViewComponent extends sfComponent
{
  public function execute($request)
  {
    $this->resource = $request->getAttribute('sf_route')->resource;

    // Get tree (limit 10 siblings and children)
    $this->treeViewObjects = $this->resource->getFullYuiTree(10);

    // Check if tree view worth it
    if (1 > count($this->treeViewObjects))
    {
      return sfView::NONE;
    }

    $this->treeViewExpands = array();
    foreach ($this->resource->ancestors->andSelf()->orderBy('lft') as $item)
    {
      $this->treeViewExpands[$item->id] = $item->id;
    }

    // Is it draggable?
    $this->treeViewDraggable = json_encode(QubitAcl::check(QubitInformationObject::getRoot(), 'update'));
  }
}
