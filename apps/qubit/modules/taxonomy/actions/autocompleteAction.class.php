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

class TaxonomyAutocompleteAction extends sfAction
{
  public function execute($request)
  {
    $criteria = new Criteria;
    $criteria = QubitTaxonomy::addEditableTaxonomyCriteria($criteria);
    $criteria->addJoin(QubitTaxonomy::ID, QubitTaxonomyI18n::ID);
    $criteria->add(QubitTaxonomyI18n::CULTURE, $this->context->user->getCulture());

    // Narrow results by query
    if (isset($request->query))
    {
      $criteria->add(QubitTaxonomyI18n::NAME, $request->query.'%', Criteria::LIKE);
    }

    // Limit results by ACL
    $criteria = QubitAcl::filterCriteria($criteria, QubitTaxonomy::getById(QubitTaxonomy::ROOT_ID), 'createTerm');

    // Sort by name
    $criteria->addAscendingOrderByColumn(QubitTaxonomyI18n::NAME);

    // Show first 10 results
    $criteria->setLimit(10);

    $this->taxonomies = QubitTaxonomy::get($criteria);
  }
}
