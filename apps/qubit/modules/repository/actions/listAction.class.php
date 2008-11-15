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
 * @package    qubit
 * @subpackage repository
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */
class RepositoryListAction extends sfAction
{

  /**
   * Show hitlist of repositories
   *
   * @param sfRequest $request
   */
  public function execute($request)
  {
    $options = array();
    $this->country = 0;

    // Set culture and cultural fallback flag
    $this->culture = $this->getUser()->getCulture();
    $options['cultureFallback'] = true; // Do cultural fallback

    // Set sort
    $this->sort = $this->getRequestParameter('sort', 'nameUp');
    $options['sort'] = $this->sort;

    // Set current page
    $this->page = $this->getRequestParameter('page', 1);
    $options['page'] = $this->page;

    // Filter by country
    if ($this->getRequestParameter('country'))
    {
      $this->country = strtoupper($this->getRequestParameter('country'));
      $options['countryCode'] = $this->country;
    }

    // Get repository hitlist
    $this->repositories = QubitRepository::getList($this->culture, $options);

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'repository'))
    {
      $this->editCredentials = true;
    }
  }
}
