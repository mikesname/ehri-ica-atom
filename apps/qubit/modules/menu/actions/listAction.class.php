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
 * List/edit current menu tree
 *
 * @package    qubit
 * @subpackage menu
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class MenuListAction extends sfAction
{
  public function execute($request)
  {
    // Re-order menus if 'move' parameter passed
    if ($request->hasParameter('move') && $moveMenu = QubitMenu::getById($request->getParameter('move')))
    {
      if ($request->hasParameter('before'))
      {
        $moveMenu->moveBeforeById($request->getParameter('before'));
      }
      else if ($request->hasParameter('after'))
      {
        $moveMenu->moveAfterById($request->getParameter('after'));
      }
    }

    // Set current page (from request parameter)
    $this->page = $this->getRequestParameter('page', 1);

    // Get an array with menu ids and depth (relative to top menu) to create
    // and indented list
    $menuTree = QubitMenu::getTreeById(QubitMenu::ROOT_ID);

    foreach ($menuTree as $i => $menu)
    {
      // Build an array of siblings for each parentId for figuring out prev/next
      // buttons
      $siblingList[$menu['parentId']][] = array('id' => $menu['id'], 'pos' => $i);

      // Change page if necessary to display current menu being moved
      if ($request->hasParameter('move') && $request->getParameter('move') == $menu['id'])
      {
        $this->page = floor($i / sfConfig::get('app_hits_per_page')) + 1;
      }
    }

    // Build prev/next values based on number of siblings
    foreach ($siblingList as $siblings)
    {
      foreach ($siblings as $i => $sibling)
      {
        $menuTree[$sibling['pos']]['prev'] = ($i > 0) ? $siblings[$i - 1]['id'] : null;
        $menuTree[$sibling['pos']]['next'] = ($i < (count($siblings) - 1)) ? $siblings[$i + 1]['id'] : null;
      }
    }

    $this->menuTree = $menuTree;
  }
}
