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

class TermAutocompleteAction extends sfAction
{
  public function execute($request)
  {
    $this->taxonomy = QubitTaxonomy::getById($request->taxonomyId);

    if (!isset($this->taxonomy))
    {
      $this->forward404();
    }

    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, $request->taxonomyId);
    $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID, Criteria::INNER_JOIN);
    $criteria->add(QubitTermI18n::CULTURE, $this->context->user->getCulture());

    // Exclude the calling object and it's descendants from the list (prevent
    // circular inheritance)
    $params = $this->context->routing->parse(Qubit::pathInfo($request->getHttpHeader('Referer')));
    if (isset($params['id']))
    {
      $thisTerm = QubitTerm::getById($params['id']);

      if (isset($thisTerm))
      {
        $c1 = $criteria->getNewCriterion(QubitTerm::LFT, $thisTerm->lft, Criteria::LESS_THAN);
        $c2 = $criteria->getNewCriterion(QubitTerm::RGT, $thisTerm->rgt, Criteria::GREATER_THAN);
        $c1->addOr($c2);
        $criteria->add($c1);
      }
    }

    // If calling from term page, exclude non-preferred terms from list
    if ('term' == $params['module'])
    {
      $criteria->addJoin(QubitTerm::ID, QubitRelation::OBJECT_ID, Criteria::LEFT_JOIN);
      $criterion1 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID, Criteria::NOT_EQUAL);
      $criterion2 = $criteria->getNewCriterion(QubitRelation::TYPE_ID, null, Criteria::ISNULL);
      $criterion1->addOr($criterion2);
      $criteria->add($criterion1);
    }

    // Narrow results by query
    if (isset($request->query))
    {
      $criteria->add(QubitTermI18n::NAME, $request->query.'%', Criteria::LIKE);
    }

    // Sort by name
    $criteria->addAscendingOrderByColumn(QubitTermI18n::NAME);

    // Show first 10 results
    $criteria->setLimit(10);

    $this->terms = QubitTerm::get($criteria);
  }
}
