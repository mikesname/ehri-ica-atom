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
 * Show paginated list of actors.
 *
 * @package    qubit
 * @subpackage actor
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class ActorBrowseAction extends sfAction
{
  public function execute($request)
  {
    // Set sort
    $this->sort = $this->getRequestParameter('sort', 'nameUp');

    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $criteria = new Criteria;
    $criteria->add(QubitActor::PARENT_ID, QubitActor::ROOT_ID, Criteria::EQUAL);

    // Add criteria to exclude actors that are users or repository objects
    $criteria = QubitActor::addGetOnlyActorsCriteria($criteria);

    // Add sort criteria
    switch($this->sort)
    {
      case 'typeDown':
        $fallbackTable = 'QubitTerm';
        $criteria->addJoin(QubitActor::ENTITY_TYPE_ID, QubitTerm::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('name');
        break;
      case 'typeUp':
        $fallbackTable = 'QubitTerm';
        $criteria->addJoin(QubitActor::ENTITY_TYPE_ID, QubitTerm::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('name');
        break;
      case 'updatedUp':
        $criteria->addJoin(QubitActor::ID, QubitObject::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('updated_at');
      case 'updatedDown':
        $criteria->addJoin(QubitActor::ID, QubitObject::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('updated_at');
      case 'nameDown':
        $fallbackTable = 'QubitActor';
        $criteria->addDescendingOrderByColumn('authorized_form_of_name');
        break;
      case 'nameUp':
      default:
        $fallbackTable = 'QubitActor';
        $criteria->addAscendingOrderByColumn('authorized_form_of_name');
    }

    // Do source culture fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $fallbackTable, array('returnClass'=>'QubitActor'));

    // Page results
    $this->pager = new QubitPager('QubitActor');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);
  }
}
