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
 * Physical Object update action
 *
 * @package qubit
 * @subpackage physicalobject
 * @author david juhasz <david@artefactual.com>
 * @version svn:$Id
 */
class PhysicalObjectUpdateAction extends sfAction
{
  
  /**
   * Main
   * 
   * @param sfRequest $request
   */
  public function execute($request)
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $physicalObject = new QubitRepository;
    }
    else
    {
      $physicalObject = QubitPhysicalObject::getById($this->getRequestParameter('id'));
      $this->forward404Unless($physicalObject);
    }
    
    // Update objects
    $this->updateContainerAttributes($physicalObject);
    
    // Redirect to information object edit page
    if ($this->hasRequestParameter('next'))
    {
      
      return $this->redirect($this->getRequestParameter('next'));
    }
    
    // Default redirect  
    return $this->redirect('physicalobject/edit?id='.$physicalObject->getId());
  } 
  
  
  /**
   * Update container attributes
   *
   * @param QubitPhysicalObject $physicalObject
   */
  public function updateContainerAttributes($physicalObject)
  {
    $physicalObject->setName($this->getRequestParameter('name'));
    $physicalObject->setLocation($this->getRequestParameter('location'));
    $physicalObject->setTypeId($this->getRequestParameter('typeId'));
    $physicalObject->save();
  }
}
