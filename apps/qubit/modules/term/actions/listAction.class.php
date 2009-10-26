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

class TermListAction extends sfAction
{
  public function execute($request)
  {
    if ($request->isXmlHttpRequest())
    {
      return $this->ajaxResponse($request);
    }
    else
    {
      return $this->htmlResponse($request);
    }
  }

  protected function ajaxResponse($request)
  {
    $hitlist = array();

    $criteria = new Criteria;

    if ($this->hasRequestParameter('id'))
    {
      $term = QubitTerm::getById($this->getRequestParameter('id'));
      $criteria->add(QubitTerm::TAXONOMY_ID, $term->taxonomyId, Criteria::EQUAL);
      $criteria->add(QubitTerm::ID, $term->id, Criteria::NOT_EQUAL);
    }
    else if ($this->hasRequestParameter('taxonomyId'))
    {
      $criteria->add(QubitTerm::TAXONOMY_ID, $this->getRequestParameter('taxonomyId'), Criteria::EQUAL);
    }
    else
    {

      return $this->renderText('');
    }

    $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID, Criteria::INNER_JOIN);
    $criteria->add(QubitTermI18n::NAME, $this->getRequestParameter('query').'%', Criteria::LIKE);
    $criteria->add(QubitTermI18n::CULTURE, $this->getUser()->getCulture(), Criteria::EQUAL);
    $criteria->addAscendingOrderByColumn('name');
    $criteria->setLimit(10);

    if (0 < count($results = QubitTermI18n::get($criteria)))
    {
      foreach ($results as $result)
      {
        $termName = $result->getName(array('cultureFallback' => true));

        // Check for preferred term to the current term
        $criteria2 = new Criteria;
        $criteria2->add(QubitRelation::OBJECT_ID, $result->id, Criteria::EQUAL);
        $criteria2->add(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID, Criteria::EQUAL);

        // Set preferred name and id
        $preferredName = null;
        $preferredId = $result->id;
        if (null !== ($preferred = QubitRelation::getOne($criteria2)))
        {
          $preferredName = $preferred->getSubject()->getName(array('cultureFallback' => true));
          $preferredId = (null === $preferred) ? $result->id : $preferred->getSubject()->id;
        }

        $hitlist[] = array('name' => $termName, 'id' => $result->id, 'preferredName' => $preferredName, 'preferredId' => $preferredId);
      }
    }

    return $this->renderText(json_encode(array('Results' => $hitlist)));
  }

  protected function htmlResponse($request)
  {
    if ($this->hasRequestParameter('page') && 0 < intval($this->getRequestParameter('page')))
    {
      $this->page = $this->getRequestParameter('page');
    }
    else
    {
      $this->page = 1;
    }

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'term'))
    {
      $this->editCredentials = true;
    }

    // Select taxonomy or term list
    if ($this->hasRequestParameter('taxonomyId') && 0 < intval($this->getRequestParameter('taxonomyId')))
    {
      $this->hitlist = $this->termHitList();
      $this->setTemplate('listTaxonomy');
    }
    else
    {
      $this->hitlist = $this->taxonomyHitList();
      $this->setTemplate('list');
    }
  }

  public function termHitList()
  {
    $this->taxonomy = QubitTaxonomy::getById($this->getRequestParameter('taxonomyId'));
    $this->forward404If(null === $this->taxonomy);

    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, $this->taxonomy->getId(), Criteria::EQUAL);
    $criteria->add(QubitTerm::PARENT_ID, QubitTerm::ROOT_ID, Criteria::EQUAL);

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
    $pager = new QubitPager('QubitTerm');
    $pager->setCriteria($criteria);
    $pager->setPage($this->page);
    $pager->init();

    return $pager;
  }

  public function taxonomyHitList()
  {
    $criteria = new Criteria;

    // Show only editable taxonomies
    $criteria = QubitTaxonomy::addEditableTaxonomyCriteria($criteria);
    $criteria->addAscendingOrderByColumn('name');

    // Do source culture fallback
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTaxonomy');

    // Page results
    $pager = new QubitPager('QubitTaxonomy');
    $pager->setCriteria($criteria);
    $pager->setPage($this->page);
    $pager->init();

    return $pager;
  }
}
