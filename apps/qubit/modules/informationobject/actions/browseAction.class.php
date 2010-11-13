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
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::PARENT_ID, QubitInformationObject::ROOT_ID);

    if (isset($request->repositoryId))
    {
      $criteria->add(QubitInformationObject::REPOSITORY_ID, $request->repositoryId);
    }

    if (isset($request->collectionType))
    {
      $criteria->add(QubitInformationObject::COLLECTION_TYPE_ID, $request->collectionType);
    }

    $fallbackTable = 'QubitInformationObject';

    // Sort results
    switch ($request->sort)
    {
      case 'repositoryDown':
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('authorized_form_of_name');

        break;

      case 'repositoryUp':
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('authorized_form_of_name');

        break;

      case 'titleDown':
        $criteria->addDescendingOrderByColumn('title');

        break;

      case 'titleUp':
        $criteria->addAscendingOrderByColumn('title');

        break;

      case 'updatedDown':
      default:
        $criteria->addDescendingOrderByColumn(QubitObject::UPDATED_AT);

        break;

      case 'updatedUp':
        $criteria->addAscendingOrderByColumn(QubitObject::UPDATED_AT);

        break;
    }

    // Do source culture fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $fallbackTable);

    // Filter drafts
    $criteria = QubitAcl::addFilterDraftsCriteria($criteria);

    // Page results
    $this->pager = new QubitPager('QubitInformationObject');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);
  }
}
