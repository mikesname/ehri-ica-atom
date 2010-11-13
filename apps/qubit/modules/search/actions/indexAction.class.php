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

class SearchIndexAction extends sfAction
{
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    if (isset($this->getRoute()->resource) && $this->getRoute()->resource instanceof QubitRepository)
    {
      $request->query .= " and repository:\"{$this->getRoute()->resource->authorizedFormOfName}\"";
    }

    $this->response->setTitle("{$this->context->i18n->__('Search for [%1%]', array('%1%' => $request->query))} - {$this->response->getTitle()}");

    xfLuceneZendManager::load();
    Zend_Search_Lucene_Analysis_Analyzer::setDefault(SearchIndex::getIndexAnalyzer());
    Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');

    $search = new QubitSearch;

    $query = new Zend_Search_Lucene_Search_Query_Boolean;

    try
    {
      // Parse query string
      $query->addSubquery(Zend_Search_Lucene_Search_QueryParser::parse($request->query, 'UTF-8'), true);
    }
    catch (Exception $e)
    {
      $this->error = $e->getMessage();

      return;
    }

    $culture = $this->context->user->getCulture();
    $query->addSubquery(new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($culture, 'culture')), true);

    $query = QubitAcl::searchFilterByRepository($query, 'read');
    $query = QubitAcl::searchFilterDrafts($query);

    $this->pager = new QubitArrayPager;

    try
    {
      $this->pager->hits = $search->getEngine()->getIndex()->find($query);
    }
    catch (Exception $e)
    {
      $this->error = $e->getMessage();

      return;
    }

    $this->pager->setMaxPerPage($request->limit);
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
