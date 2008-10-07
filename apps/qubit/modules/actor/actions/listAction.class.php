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

/**
 * Show paginated list of actors.
 *
 * @package    qubit
 * @subpackage actor
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class ActorListAction extends sfAction
{
  public function execute($request)
  {
    $options = array();
    
    // Set culture and cultural fallback flag
    $this->culture = $this->getUser()->getCulture();
    $options['cultureFallback'] = true; // Do cultural fallback
    
    // Set sort
    $this->sort = $this->getRequestParameter('sort', 'nameUp');
    $options['sort'] = $this->sort;
    
    // Set current page
    $this->page = $this->getRequestParameter('page', 1);
    $options['page'] = $this->page;
    
    // Set role
    $this->role = $this->getRequestParameter('role', 'all');
    $options['role'] = $this->role;
    
    $criteria = new Criteria;
    
    // Get results
    $this->actors = QubitActor::getList($this->culture, new Criteria, $options);

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
