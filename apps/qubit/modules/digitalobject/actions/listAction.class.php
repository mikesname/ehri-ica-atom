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
 * @subpackage digitalobject
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn: $id
 */
class DigitalObjectListAction extends sfAction
{
  /**
   * Execute digitalobject list action
   *
   * @param sfWebRequest $request
   */
  public function execute($request)
  {
    $this->culture = $this->getUser()->getCulture();
    
    if ($this->getRequestParameter('sort'))
    {
      $this->sort = $this->getRequestParameter('sort');
    }
    else
    {
      //default sort column for list view
      $this->sort = 'nameUp';
    }

    // TODO Figure out how to replace this with an ORM resultset
    // Build funky join query to get a count of top level digital objects
    // for each media type (term)
    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MEDIA_TYPE_ID);
    $criteria->addJoin(QubitTerm::ID, QubitDigitalObject::MEDIA_TYPE_ID, Criteria::LEFT_JOIN);
    $criteria->addAsColumn('hits', 'COUNT('.QubitDigitalObject::ID.')');
    $criteria->addGroupByColumn(QubitTerm::ID);
    
    /*
    $criteria = new Criteria;
    $criteria->addSelectColumn(QubitTerm::ID);
    $criteria->addSelectColumn('COUNT('.QubitDigitalObject::ID.')');
    $criteria->addJoin(QubitTerm::ID, QubitDigitalObject::MEDIA_TYPE_ID, Criteria::LEFT_JOIN);
    $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
    $criteria->add(QubitDigitalObject::PARENT_ID, null, Criteria::ISNULL);
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MEDIA_TYPE_ID);
    $criteria->addGroupByColumn(QubitTerm::ID);
    */

    // Sort the list
    switch ($this->sort)
    {
      case 'nameUp':
        $criteria->addAscendingOrderByColumn('name'); break;
      case 'nameDown':
        $criteria->addDescendingOrderByColumn('name'); break;
      case 'hitsUp':
        $criteria->addAscendingOrderByColumn('hits'); break;
      case 'hitsDown':
        $criteria->addDescendingOrderByColumn('hits'); break;
    }
    
    // Add I18n fallback
    $options = array();
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $this->culture, $options);
    
    $this->terms = QubitTerm::get($criteria);

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
        //$this->setTemplate(sfConfig::get('app_default_template_mediatype_list'));
        $this->setTemplate('list');
    }
  }
}