<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
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
