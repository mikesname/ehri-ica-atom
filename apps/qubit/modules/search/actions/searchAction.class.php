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

class SearchSearchAction extends sfAction
{
  public function execute($request)
  {
    $culture = $this->getUser()->getCulture();

    $this->getResponse()->setTitle('Search for "'.$request->query.'"', true);

    xfLuceneZendManager::load();
    Zend_Search_Lucene_Analysis_Analyzer::setDefault(SearchIndex::getIndexAnalyzer());
    Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');

    $search = new QubitSearch;

    $query = new Zend_Search_Lucene_Search_Query_Boolean;
    $query->addSubquery(new Zend_Search_Lucene_Search_Query_Term(new Zend_Search_Lucene_Index_Term($culture, 'culture')), true);

    $query = QubitAcl::searchFilterByRepository($query, QubitAclAction::READ_ID);
    $query = QubitAcl::searchFilterDrafts($query);

    $query->addSubquery(Zend_Search_Lucene_Search_QueryParser::parse($request->query, 'UTF-8'), true);

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
