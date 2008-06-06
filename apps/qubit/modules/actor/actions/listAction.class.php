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

class ActorListAction extends sfAction
{
  public function execute($request)
  {
  if ($this->getRequestParameter('role'))
      {
      $this->role = $this->getRequestParameter('role');
      }
    else
      {
      //set default actor role to creator
      $this->role = 'all';
      }

    if ($this->getRequestParameter('sort'))
      {
      $this->sort = $this->getRequestParameter('sort');
      }
    else
      {
      //default sort column for list view
      $this->sort = 'idDown';
      }

    $this->actors = QubitActor::getOnlyActors();

   //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'actor'))
      {
      $this->editCredentials = true;
      }

    //set view template
    switch ($this->getRequestParameter('template'))
    {
    case 'anotherTemplate' :
      $this->setTemplate('anotherTemplate');
      break;
    default :
      $this->setTemplate(sfConfig::get('app_default_template_actor_list'));
    }
  }
}
