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
class InformationObjectListAction extends sfAction
{
  /**
   * Display a paginated hitlist of information objects (top-level only)
   *
   * @param sfRequest $request
   */
  public function execute($request)
  {
    if ($request->isXmlHttpRequest())
    {
      return $this->ajaxResponse($request);
    }
    else
    {
      $this->htmlResponse($request);
    }
  }

  protected function ajaxResponse($request)
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitInformationObject::ID, QubitInformationObjectI18n::ID, Criteria::INNER_JOIN);
    $criteria->add(QubitInformationObjectI18n::TITLE, $request->query.'%', Criteria::LIKE);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $this->getUser()->getCulture(), Criteria::EQUAL);
    $criteria->addAscendingOrderByColumn(QubitInformationObjectI18n::TITLE);
    $criteria->setLimit(10);

    $informationObjects = QubitInformationObject::get($criteria);
    foreach ($informationObjects as $informationObject)
    {
      $results[] = array('id' => $informationObject->id, 'name' => $informationObject->title);
    }

    return $this->renderText(json_encode(array('Results' => $results)));
  }

  protected function htmlResponse($request)
  {
    $this->informationObject = QubitInformationObject::getById($request->id);

    if (!isset($this->informationObject))
    {
      $this->forward404();
    }

    $request->setAttribute('informationObject', $this->informationObject);

    $search = new QubitSearch;

    $query = new Zend_Search_Lucene_Search_Query_Boolean;
    $query->addSubquery(new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($request->id, 'parentId')), true);

    if (isset($request->query))
    {
      $query = $request->query;
    }

    $query = QubitAcl::searchFilterByRepository($query, QubitAclAction::READ_ID);
    $query = QubitAcl::searchFilterDrafts($query);

    $this->pager = new QubitSearchPager;
    $this->pager->hits = $search->getEngine()->getIndex()->find($query);
    $this->pager->setPage($request->page);

    $ids = array();
    foreach ($this->pager->getResults() as $hit)
    {
      $ids[] = $hit->getDocument()->id;
    }

    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::ID, $ids, Criteria::IN);
    $this->informationObjects = QubitInformationObject::get($criteria);
  }
}
