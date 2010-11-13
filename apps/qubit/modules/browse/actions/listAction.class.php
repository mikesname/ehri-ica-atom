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

class BrowseListAction extends sfAction
{
  public function execute($request)
  {
    $this->browseList = $this->request->browseList;
    $this->forward404Unless($this->browseList);

    switch($this->browseList)
    {
      case 'subject':
        $this->context->user->setAttribute('browse_list', 'subject');
        $this->redirect(array('module' => 'taxonomy', 'action' => 'browse', 'id' => QubitTaxonomy::SUBJECT_ID));
        break;

      case 'materialtype':
        $this->context->user->setAttribute('browse_list', 'materialtype');
        $this->redirect(array('module' => 'taxonomy', 'action' => 'browse', 'id' => QubitTaxonomy::MATERIAL_TYPE_ID));
        break;

      case 'place':
        $this->context->user->setAttribute('browse_list', 'place');
        $this->redirect(array('module' => 'taxonomy', 'action' => 'browse', 'id' => QubitTaxonomy::PLACE_ID));
        break;

      case 'actor':
        $this->context->user->setAttribute('browse_list', 'actor');
        $this->redirect(array('module' => 'actor', 'action' => 'browse'));
        break;

      case 'function':
        $this->context->user->setAttribute('browse_list', 'function');
        $this->redirect(array('module' => 'function', 'action' => 'list'));
        break;

      case 'name':
        $this->context->user->setAttribute('browse_list', 'name');
        $this->redirect(array('module' => 'actor', 'action' => 'browse'));
        break;

      case 'repository':
        $this->context->user->setAttribute('browse_list', 'repository');
        $this->redirect(array('module' => 'repository', 'action' => 'browse'));
        break;

      case 'mediatype':
        $this->context->user->setAttribute('browse_list', 'mediatype');
        $this->redirect(array('module' => 'digitalobject', 'action' => 'list'));
        break;

      case 'informationobject':
        $this->context->user->setAttribute('browse_list', 'informationobject');
        $this->redirect(array('module' => 'informationobject', 'action' => 'browse'));
        break;

      case 'recentUpdates':
        $this->context->user->setAttribute('browse_list', 'recentUpdates');
        $this->informationObjects = informationObjectPeer::getRecentChanges(10);
        $this->setTemplate('recentList');
        break;

      default:
        $this->forward404();
    }
  }
}
