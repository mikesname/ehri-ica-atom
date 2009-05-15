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

class SearchKeywordAction extends sfAction
{
  public function execute($request)
  {
    $culture = $this->getUser()->getCulture();
    setlocale(LC_CTYPE, $culture.'.utf-8', $culture.'@utf-8');
    $this->query = urldecode($this->getRequestParameter('query'));

    if ($this->query)
    {
      $this->getResponse()->setTitle('Search for \''.$this->query.'\'', true);
    }

    $search_index = SearchIndex::getIndexLocation('informationobject', $culture);
    Zend_Search_Lucene_Analysis_Analyzer::setDefault(SearchIndex::getIndexAnalyzer());
    Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');

    $hits = array();

    if ($this->query)
    {
      $index = Zend_Search_Lucene::open($search_index);
      $parser = new Zend_Search_Lucene_Search_QueryParser;
      $c = $parser->parse(strtolower($this->query), 'UTF-8');
      $hits = $index->find($c);
    }
    $this->hits = $hits;

    // send results through pagination
    if ($this->getRequestParameter('page'))
    {
      $page = $this->getRequestParameter('page');
    }
    else
    {
      //set default page
      $page = 1;
    }

    $this->results = new QubitSearchPager($hits, $page);
  }

  public function handleError()
  {
    return sfView::SUCCESS;
  }
}