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

class TermListTaxonomyAction extends sfAction
{
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $this->taxonomy = QubitTaxonomy::getById($request->id);

    if (!isset($this->taxonomy))
    {
      $this->forward404();
    }

    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, $request->id);
    $criteria->add(QubitTerm::PARENT_ID, QubitTerm::ROOT_ID);

    // Exclude non-preferred terms
    $criteria->addJoin(QubitTerm::ID, QubitRelation::OBJECT_ID, Criteria::LEFT_JOIN);
    $criterion1 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID, Criteria::NOT_EQUAL);
    $criterion2 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, null, Criteria::ISNULL);
    $criterion1->addOr($criterion2);
    $criteria->add($criterion1);

    $criteria->addAscendingOrderByColumn('name');

    // Do source culture fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');

    // Page results
    $this->pager = new QubitPager('QubitTerm');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);

    $this->terms = $this->pager->getResults();
  }
}
