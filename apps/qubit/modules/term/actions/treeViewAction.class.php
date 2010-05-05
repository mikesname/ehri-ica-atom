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
    $this->response->setHttpHeader('Content-Type', 'application/json; charset=utf-8');

    $term = QubitTerm::getById($request->id);

    $options = array();
    if (isset($request->limit))
    {
      $options['limit'] = $request->limit;
    }

    if (isset($request->offset))
    {
      $options['offset'] = $request->offset;
    }

    $treeViewObjects = $term->getChildYuiNodes($options);

    return $this->renderText(json_encode($treeViewObjects));
  }
}
