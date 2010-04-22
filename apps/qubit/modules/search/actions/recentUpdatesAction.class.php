<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Display a list of recently updates to the db
 *
 * @package qubit
 * @subpackage search
 * @version SVN: $Id$
 * @author David Juhasz <david@artefactual.com>
 */
class SearchRecentUpdatesAction extends sfAction
{
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    // Get search parameters
    $this->objectType   = $request->getParameter('type', 'informationobject');
    $this->numberOfDays = $request->getParameter('days', 30);
    $this->sort         = $request->getParameter('sort', 'updatedDown');

    $cutOffDate = date('Y-m-d H:i:s', strtotime('-'.$this->numberOfDays.'day'));

    // List of object types for selection
    $this->objectTypeList = array(
      'informationobject' => sfConfig::get('app_ui_label_informationobject'),
      'actor' => sfConfig::get('app_ui_label_actor'),
      'repository' => sfConfig::get('app_ui_label_repository'),
      'term' => sfConfig::get('app_ui_label_term')
    );

    // Start building search criteria
    $criteria = new Criteria;

    // Set search parameters based on object type we are displaying
    switch ($this->objectType)
    {
      case 'actor':
        $objectTable = 'QubitActor';
        $nameColumn = 'authorized_form_of_name';
        $this->nameColumnDisplay = 'name';
        $criteria = QubitActor::addGetOnlyActorsCriteria($criteria);
        $criteria = QubitActor::addRecentUpdatesCriteria($criteria, $cutOffDate);
        break;
      case 'repository':
        $objectTable = 'QubitRepository';
        $nameColumn = 'authorized_form_of_name';
        $this->nameColumnDisplay = 'name';
        $criteria = QubitRepository::addGetOnlyRepositoryCriteria($criteria);
        $criteria = QubitRepository::addRecentUpdatesCriteria($criteria, $cutOffDate);
        break;
      case 'term':
        $objectTable = 'QubitTerm';
        $nameColumn = 'name';
        $this->nameColumnDisplay = 'name';
        $criteria = QubitTerm::addRecentUpdatesCriteria($criteria, $cutOffDate);
        $criteria->addJoin(QubitObject::ID, QubitTerm::ID);
        break;
      case 'informationobject':
      default:
        $objectTable = 'QubitInformationObject';
        $nameColumn = 'title';
        $this->nameColumnDisplay = 'title';

        // Hide root
        $criteria->add(QubitInformationObject::PARENT_ID, null, Criteria::ISNOTNULL);
        $criteria->addJoin(QubitObject::ID, QubitInformationObject::ID);

        $criteria = QubitInformationObject::addRecentUpdatesCriteria($criteria, $cutOffDate);
    }

    // Add sort criteria
    switch($this->sort)
    {
      case 'nameDown':
        $criteria->addDescendingOrderByColumn($nameColumn);
        break;
      case 'nameUp':
        $criteria->addAscendingOrderByColumn($nameColumn);
        break;
      case 'updatedUp':
        $criteria->addAscendingOrderByColumn(constant($objectTable.'::UPDATED_AT'));
        break;
      case 'updatedDown':
      default:
        $criteria->addDescendingOrderByColumn(constant($objectTable.'::UPDATED_AT'));
    }

    // Add fallback criteria for name
    if ('nameDown' == $this->sort || 'nameUp' == $this->sort)
    {
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $objectTable);
    }

    // Page results
    $this->pager = new QubitPager($objectTable);
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);

    // Define a default set of parameters for this page
    $this->defaultParamList = array(
      'module' => 'search',
      'action' => 'recentUpdates',
      'page' => $this->page,
      'sort' => $this->sort,
      'type' => $this->objectType,
      'days' => $this->numberOfDays);
  }
}
