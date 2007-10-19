<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class listAction extends sfAction
{
  public function execute()
  {
  $this->browseList = $this->getRequestParameter('browseList');
  $this->forward404Unless($this->browseList);

  switch($this->browseList)
    {
    case 'subject':
      {
      $this->getUser()->setAttribute('browse_list', 'subject');
      $this->redirect('term/browse?taxonomyId=14');
      break;
      }
    case 'actor':
      {
      $this->getUser()->setAttribute('browse_list', 'actor');
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