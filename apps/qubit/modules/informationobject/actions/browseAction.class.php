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
 * @package    qubit
 * @subpackage repository
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */
class InformationObjectBrowseAction extends sfAction
{

  /**
   * Show hitlist of information objects
   *
   * @param sfRequest $request
   */
  public function execute($request)
  {
    $this->sort = $this->getRequestParameter('sort', 'titleUp');

    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::PARENT_ID, QubitInformationObject::ROOT_ID, Criteria::EQUAL);

    if (isset($request->repositoryId))
    {
      $criteria->add(QubitInformationObject::REPOSITORY_ID, $request->repositoryId);
    }

    if (isset($request->collectionType))
    {
      $criteria->add(QubitInformationObject::COLLECTION_TYPE_ID, $request->collectionType);
    }

    // Sort results
    switch($this->sort)
    {
      case 'titleDown':
        $fallbackTable = 'QubitInformationObject';
        $criteria->addDescendingOrderByColumn('title');
        break;
      case 'repositoryUp':
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('authorized_form_of_name');
        break;
      case 'repositoryDown':
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('authorized_form_of_name');
        break;
      case 'updatedUp':
        $criteria->addJoin(QubitInformationObject::ID, QubitObject::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('updated_at');
      case 'updatedDown':
        $criteria->addJoin(QubitInformationObject::ID, QubitObject::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('updated_at');
      case 'titleUp':
      default:
        $fallbackTable = 'QubitInformationObject';
        $criteria->addAscendingOrderByColumn('title');
    }

    // Do source culture fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $fallbackTable, array('returnClass'=>'QubitInformationObjec'));

    // Page results
    $this->pager = new QubitPager('QubitInformationObject');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);
  }
}
