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
  $this->browseList = $this->getRequestParameter('browseList');
  $this->forward404Unless($this->browseList);

  switch($this->browseList)
    {
    case 'subject':
      {
      $this->getUser()->setAttribute('browse_list', 'subject');
      $this->redirect('term/browse?taxonomyId='.QubitTaxonomy::SUBJECT_ID);
      break;
      }
    case 'materialtype':
      {
      $this->getUser()->setAttribute('browse_list', 'materialtype');
      $this->redirect('term/browse?taxonomyId='.QubitTaxonomy::MATERIAL_TYPE_ID);
      break;
      }
    case 'place':
      {
      $this->getUser()->setAttribute('browse_list', 'place');
      $this->redirect('term/browse?taxonomyId='.QubitTaxonomy::PLACE_ID);
      break;
      }

    case 'actor':
      {
      $this->getUser()->setAttribute('browse_list', 'actor');
      $this->redirect('actor/list');
      break;
      }
    case 'name':
      {
      $this->getUser()->setAttribute('browse_list', 'name');
      $this->redirect('actor/list');
      break;
      }
    case 'repository':
      {
      $this->getUser()->setAttribute('browse_list', 'repository');
      $this->redirect('repository/list');
      break;
      }
    case 'language':
      {
      $this->getUser()->setAttribute('browse_list', 'language');
      $this->redirect('term/browse?taxonomyId=10');
      break;
      }
    case 'mediatype':
      {
      $this->getUser()->setAttribute('browse_list', 'mediatype');
      $this->redirect('digitalobject/list');
      break;
      }
    case 'informationobject':
      {
      $this->getUser()->setAttribute('browse_list', 'informationobject');
      $this->redirect('informationobject/list');
      break;
      }
    case 'recentUpdates':
      {
      $this->getUser()->setAttribute('browse_list', 'recentUpdates');
      $this->informationObjects = informationObjectPeer::getRecentChanges(10);
      $this->setTemplate('recentList');
      break;
      }
    default:
      {
      $this->forward404();
      }
    }
  }
}
