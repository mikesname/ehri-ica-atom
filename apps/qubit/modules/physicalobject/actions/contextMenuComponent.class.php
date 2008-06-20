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
 * Context Menu component for physical objects.
 * 
 * @package qubit
 * @subpackage physicalobject
 * @author david juhasz <david@artefactual.com>
 * @version svn:$id
 */
class PhysicalObjectContextMenuComponent extends sfComponent
{
  public function execute($request)
  {
    $this->currentInformationObject = $request->getAttribute('informationObject');
    
    $childInformationObjects = $this->currentInformationObject->getDescendants()->andSelf();
    
    $physicalObjects = array();
    foreach($childInformationObjects as $informationObject)
    {
      $relatedPhysicalObjects = QubitRelation::getRelatedSubjectsByObjectId($informationObject->getId(),
        array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));
      
      foreach ($relatedPhysicalObjects as $physicalObject)
      {
        
        // Check to make sure this object is not already in the array
        if (!in_array($physicalObject, $physicalObjects))
        {
         $physicalObjects[] = $physicalObject;
        }
      }
    }
    
    if (count($physicalObjects) < 1)
    {
      
      return sfView::NONE;
    }
    
    $this->physicalObjects = $physicalObjects;
  }
}