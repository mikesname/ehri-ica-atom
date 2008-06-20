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

class QubitRelation extends BaseRelation
{
  
  /**
   * Check $options array for key 'typeId' and add a TYPE_ID constraint
   * to $criteria if it exists.  Also remove 'typeId' key from $options
   * so it isn't passed to QubitQuery.
   *
   * @param Criteria $criteria existing criteria instance
   * @param array $options array of options passed to calling method
   * @return Criteria
   */
  public static function addTypeIdCriteriaFromOptions($criteria, &$options) {
    sfLoader::loadHelpers('Qubit');
    
    if ($typeId = array_slice_key('typeId', $options))
    {
      $criteria->add(QubitRelation::TYPE_ID, $typeId);
    }
    
    return $criteria;
  }
  
  
  /**
   * Get records from relation table linked to object (semantic) 
   * QubitObject identified by primary key $id.
   * 
   * @param integer $id primary key of "object" QubitObject
   * @param integer $typeId filter by predicate
   * @return QubitQuery collection of QubitRelation objects
   */
  public static function getRelationsByObjectId($id, $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::OBJECT_ID, $id);
    $criteria = self::addTypeIdCriteriaFromOptions($criteria, $options);
   
    return QubitRelation::get($criteria, $options);
  }
  
  
  /**
   * Get records from relation table linked to subject 
   * QubitObject identified by primary key $id.
   * 
   * @param integer $id primary key of "subject" QubitObject
   * @param integer $typeId filter by predicate
   * @return QubitQuery collection of QubitRelation objects
   */
  public static function getRelationsBySubjectId($id, $typeId=null, $options=array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::SUBJECT_ID, $id);
    
    $criteria = self::addTypeIdCriteriaFromOptions($criteria, $options);
    
    return QubitRelation::get($criteria, $options);
  }
  
  
  /**
   * Get related subject objects via QubitRelation many-to-many relationship
   *
   * @param QubitObject $objectId primary key of "object" QubitObject
   * @param integer $typeId filter by predicate
   * @param array $options list of options to pass to QubitQuery
   * @return QubitQuery collection of QubitObjects
   */
  public static function getRelatedSubjectsByObjectId($objectId, $options=array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::OBJECT_ID, $objectId);
    $criteria->addJoin(QubitRelation::SUBJECT_ID, QubitObject::ID);
    
    $criteria = self::addTypeIdCriteriaFromOptions($criteria, $options);
    
    return QubitObject::get($criteria, $options);
  }
  
  
  /**
   * Get related "object" (semantic) QubitObjects
   *
   * @param QubitObject $subjectId primary key of "subject" QubitObject
   * @param array $options list of options to pass to QubitQuery
   * @return QubitQuery collection of QubitObjects
   */
  public static function getRelatedObjectsBySubjectId($subjectId, $options=array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRelation::SUBJECT_ID, $subjectId);
    $criteria->addJoin(QubitRelation::OBJECT_ID, QubitObject::ID);
    
    $criteria = self::addTypeIdCriteriaFromOptions($criteria, $options);
    
    return QubitObject::get($criteria, $options);
  }
}
