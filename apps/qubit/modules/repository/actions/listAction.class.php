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
  if ($this->getRequestParameter('country'))
      {
      $this->country = $this->getRequestParameter('country');
      }
    else
      {
      //set default country to all
      $this->country = 0;
      }

    if ($this->getRequestParameter('sort'))
      {
      $this->sort = $this->getRequestParameter('sort');
      }
    else
      {
      //default sort column for list view
      $this->sort = 'nameUp';
      }

    $c = new Criteria();
    $this->repositories = RepositoryPeer::getRepositories($this->sort, $this->countryId);

   //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'repository') == TRUE)
      {
      $this->editCredentials = true;
      }

   //set view template
    switch ($this->getRequestParameter('template'))
      {
      case 'isiah' :
        $this->setTemplate('listISIAH');
        break;
      //default template is ISAAR
      default :
        $this->setTemplate('list');
    }



   }

}