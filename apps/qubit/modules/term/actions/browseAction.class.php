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

class TermBrowseAction extends sfAction
{
  public function execute($request)
  {
    //determine if user has edit priviliges
    $this->editCredentials = SecurityPriviliges::editCredentials($this->getUser(), 'term');

    $this->culture = $this->getUser()->getCulture();

    if (null !== $this->getRequestParameter('termId'))
    {
      $options = array();

      $this->term = QubitTerm::getById($this->request->termId);
      $this->forward404Unless(isset($this->term));

      $this->page = $this->getRequestParameter('page', 1);

      $criteria = new Criteria;
      $criteria->add(QubitObject::CLASS_NAME, 'QubitInformationObject');
      $criteria->addJoin(QubitObject::ID, QubitInformationObject::ID);
      $criteria->addJoin(QubitObject::ID, QubitObjectTermRelation::OBJECT_ID);
      $criteria->add(QubitObjectTermRelation::TERM_ID, $this->term->id);

      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitInformationObject');
      $criteria->addAscendingOrderByColumn('title');

      // Page results
      $this->pager = new QubitPager('QubitInformationObject');
      $this->pager->setCriteria($criteria);
      $this->pager->setPage($this->page);
      $this->pager->init();

      // determine if system is set to "multi-repository"
      $this->multiRepository = (sfConfig::get('app_multi_repository') !== '0');

      $this->setTemplate('browseTerm');
    }
    else
    {
      $this->page = $this->getRequestParameter('page', 1);
      $this->sort = $this->getRequestParameter('sort', 'termNameUp');

      // Get taxonomy id (default to "Subjects" taxonomy)
      if ($this->getRequestParameter('taxonomyId'))
      {
        $this->taxonomyId = $this->getRequestParameter('taxonomyId');
      }
      else
      {
        $this->taxonomyId = QubitTaxonomy::SUBJECT_ID;
      }

      // Get taxonomy object and term list
      $this->taxonomy = QubitTaxonomy::getById($this->taxonomyId);
      $this->forward404If(null === $this->taxonomy);

      $criteria = new Criteria;
      $criteria->add(QubitTerm::TAXONOMY_ID, $this->taxonomyId);

      // Add joins to get count of information objects related via object
      // term relation. The 'object2' alias is necessary because the query
      // silently adds a join on (QubitTerm::ID = QubitObject::ID).
      $criteria->addAlias('object2', QubitObject::TABLE_NAME);
      $criteria->addJoin(QubitTerm::ID, QubitObjectTermRelation::TERM_ID, Criteria::INNER_JOIN);
      $criteria->addJoin(QubitObjectTermRelation::OBJECT_ID, 'object2.id', Criteria::INNER_JOIN);
      $criteria->add('object2.class_name', 'QubitInformationObject');
      $criteria->addAsColumn('hits', 'COUNT('.QubitTerm::ID.')');
      $criteria->addGroupByColumn(QubitTerm::ID);

      switch($this->sort)
      {
        case 'hitsUp' :
          $criteria->addAscendingOrderByColumn('hits');
          break;
        case 'hitsDown' :
          $criteria->addDescendingOrderByColumn('hits');
          break;
        case 'termNameDown' :
          $criteria->addDescendingOrderByColumn('name');
          break;
        case 'termNameUp' :
        default :
          $criteria->addAscendingOrderByColumn('name');
      }

      // Do culture fallback
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');

      $this->pager = new QubitPager('QubitTerm');
      $this->pager->setCriteria($criteria);
      $this->pager->setPage($this->page);
      $this->pager->init();

      $this->setTemplate('browseTaxonomy');
    }
  }
}
