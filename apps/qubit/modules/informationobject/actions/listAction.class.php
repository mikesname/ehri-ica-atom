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
class InformationObjectListAction extends sfAction
{
  
  /**
   * Display a paginated hitlist of information objects (top-level only)
   *
   * @param sfRequest $request
   */
  public function execute($request)
  {
    $options = array();
    $this->repositoryId = 0;
    
    // HACK: Get root information object for _contextMenu partial
    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::PARENT_ID);
    $root = QubitInformationObject::getOne($criteria);
    $request->setAttribute('informationObject', $root);
    
    // Set parent id to the root node id
    $options['parentId'] = $root->getId();
    
    // Set culture and cultural fallback flag
    $this->culture = $this->getUser()->getCulture();
    $options['cultureFallback'] = true; // Do cultural fallback
    
    // Set sort
    $this->sort = $this->getRequestParameter('sort', 'titleUp');
    $options['sort'] = $this->sort;
    
    // Set current page
    $this->page = $this->getRequestParameter('page', 1);
    $options['page'] = $this->page;
    
    // Filter by repository
    if ($this->getRequestParameter('repository'))
    {
      $this->repositoryId = $this->getRequestParameter('repository');
      $options['repositoryId'] = $this->repositoryId;
    }
    
    // Filter by collection type
    if ($this->getRequestParameter('collectionType'))
    {
      $this->collectionType = $this->getRequestParameter('collectionType');
      $options['collectionType'] = $this->collectionType;
    }
    
    // Get QubitQuery collection of information objects (with pagination, fallback and sorting)
    $this->informationObjects = QubitInformationObject::getList($this->culture, new Criteria, $options);
    
    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject'))
    {
      $this->editCredentials = true;
    }
  
    //set view template
    switch ($this->getRequestParameter('template'))
    {
      case 'isad' :
        $this->setTemplate('listISAD');
        break;
      default :
        $this->setTemplate(sfConfig::get('app_default_template_informationobject_list'));
    }
  }
}
