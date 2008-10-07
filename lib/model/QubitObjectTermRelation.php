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

class QubitObjectTermRelation extends BaseObjectTermRelation
{
  public function save($connection = null)
  {
    // TODO: $cleanObject = $this->getObject()->clean();
    $cleanObjectId = $this->columnValues['object_id'];

    parent::save($connection);

    if ($cleanObjectId != $this->getObjectId() && QubitInformationObject::getById($cleanObjectId) !== null)
    {
      SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanObjectId));
    }

    if ($this->getObject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getObject());
    }
  }

  public function delete($connection = null)
  {
    parent::delete($connection);

    if ($this->getObject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getObject());
    }
  }
  
  /**
   * Get a list of objects related to the given $termId
   *
   * @param integer $termId Primary key of specified term
   * @param string  $className type of class to return
   * @param array   $options array of optional parameters
   * @return sfPager paginated list of objects
   *
   * @todo Figure out sorting - it's a NASTY problem!
   */
  public static function getTermBrowseList($termId=null, $className='QubitInformationObject', $options=array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitObject::CLASS_NAME, $className);
    $criteria->addJoin(QubitObject::ID, QubitObjectTermRelation::OBJECT_ID);
    $criteria->add(QubitObjectTermRelation::TERM_ID, $termId);
    
    $page = isset($options['page']) ? $options['page'] : 1;
    
    switch($className)
    {
      case 'QubitInformationObject':
      {
        $criteria->addJoin(QubitObject::ID, QubitInformationObject::ID);
        if ($options['sortColumn'])
        {
          if ($options['sortDirection'] == 'ascending')
          {
            //TODO: figure out how to dynamically add SORT_COLUMNS (will also require a join to _i18n)
            /*
            $criteria->addAscendingOrderByColumn('name');
            */
          }
          else
          {
            //TODO: figure out how to dynamically add SORT_COLUMNS (will also require a join to _i18n)
            /*
            $criteria->addDescendingOrderByColumn('name');
            */
          }
        }   
        
        // Page results
        $pager = new QubitPager('QubitInformationObject');
      
        break;
      }
      case 'QubitActor':
      {
        $criteria->addJoin(QubitObject::ID, QubitActor::ID);
        $pager = new QubitPager('QubitActor');
        break;
      }
      case 'QubitRepository':
      {
        $criteria->addJoin(QubitObject::ID, QubitRepository::ID);
        $pager = new QubitPager('QubitRepository');
        break;
      }
      case 'QubitDigitalObject':
      {
        $criteria->addJoin(QubitObject::ID, QubitDigitalObject::ID);
        $pager = new QubitPager('QubitDigitalObject');
        break;
      }
      case 'QubitPhysicalObject':
      {
        $criteria->addJoin(QubitObject::ID, QubitPhysicalObject::ID);
        $pager = new QubitPager('QubitPhysicalObject');
        break;
      }
    }
    
    // Return paged results
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();
    
    return $pager;
  }
}
