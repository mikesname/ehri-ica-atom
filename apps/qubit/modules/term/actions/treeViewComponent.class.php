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

class TermTreeViewComponent extends sfComponent
{
  public function execute($request)
  {
    $this->term = $request->getAttribute('term');

    // Get term tree
    $this->terms = $this->term->getTree(array('limit' => true));

    // Check if treeview worth it
    if (1 > count($this->terms))
    {
      return sfView::NONE;
    }

    list($this->treeViewObjects, $this->treeViewExpands) = QubitTerm::getTreeViewObjects($this->terms, $this->term);

    // Is it draggable?
    $this->treeViewDraggable = json_encode(SecurityPriviliges::editCredentials($this->context->user, 'term'));
  }
}
