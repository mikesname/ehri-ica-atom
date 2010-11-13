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
 * @subpackage digitalobject
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn: $Id$
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
    // Build funky join query to get a count of top level digital objects
    // for each media type (term)
    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MEDIA_TYPE_ID);
    $criteria->addJoin(QubitTerm::ID, QubitDigitalObject::MEDIA_TYPE_ID, Criteria::LEFT_JOIN);
    $criteria->addAsColumn('hits', 'COUNT('.QubitDigitalObject::ID.')');

    $criteria->addGroupByColumn(QubitTerm::ID);

    // Add I18n fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');
    $criteria->addAscendingOrderByColumn('name');

    // Filter drafts
    $criteria->addJoin(QubitDigitalObject::INFORMATION_OBJECT_ID, QubitInformationObject::ID);
    $criteria = QubitAcl::addFilterDraftsCriteria($criteria);

    $this->terms = QubitTerm::get($criteria);
  }
}
