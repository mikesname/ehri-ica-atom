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

class QubitPhysicalObject extends BasePhysicalObject
{
  
  /**
   * Call this function when casting object instance as type string
   *
   * @return string  Physical Object Name
   */
  public function __toString()
  {
    if (!$this->getName())
    {
      return (string) $this->getName(array('sourceCulture' => true));
    }
  
    return (string) $this->getName();
  }
  
  
  /**
   * Overwrite BasePhysicalObject::delete() method to add cascading delete
   * logic
   *
   * @param ? $connection
   */
  public function delete($connection = null)
  {
    $this->deleteInformationObjectRelations();
    
    parent::delete($connection);
  }
  
  
  /**
   * Delete relation records linking this physical object to information objects
   *
   */
  public function deleteInformationObjectRelations()
  {
    $this->informationObjectRelations = QubitRelation::getRelationsBySubjectId($this->getId(), 
      array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));
      
    foreach($this->informationObjectRelations as $relation)
    {
      $relation->delete();
    }
  }
  
  /**
   * Get related information object via QubitRelation relationship
   *
   * @param array $options list of options to pass to QubitQuery
   * @return QubitQuery collection of Information Objects
   */
  public function getInformationObjects($options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitPhysicalObject::ID, QubitRelation::SUBJECT_ID);
    $criteria->addJoin(QubitRelation::OBJECT_ID, QubitInformationObject::ID);
    $criteria->add(QubitPhysicalObject::ID, $this->getId());
    
    return QubitQuery::createFromCriteria($criteria, 'QubitInformationObject', $options);
  }
 
}