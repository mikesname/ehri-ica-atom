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

class TermBrowseTermAction extends sfAction
{
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $this->term = QubitTerm::getById($request->id);

    if (!isset($this->term))
    {
      $this->forward404();
    }

    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::TERM_ID, $this->term->id);
    $criteria->addJoin(QubitObjectTermRelation::OBJECT_ID, QubitInformationObject::ID, Criteria::INNER_JOIN);
    $criteria->addJoin(QubitInformationObject::ID, QubitObject::ID, Criteria::INNER_JOIN);

    $criteria = QubitAcl::addFilterDraftsCriteria($criteria);

    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitInformationObject');

    $criteria->addAscendingOrderByColumn('title');

    $this->pager = new QubitPager('QubitInformationObject');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);

    $this->informationObjects = $this->pager->getResults();
  }
}
