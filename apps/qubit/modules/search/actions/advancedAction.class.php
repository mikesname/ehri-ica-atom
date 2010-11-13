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

class SearchAdvancedAction extends sfAction
{
  public function execute($request)
  {
    setlocale(LC_CTYPE, 'en_US.utf-8');
    $this->query = $this->request->search_query;

    if ($this->query)
    {
    $this->response->setTitle('Search for \''.$this->query.'\'', true);
    }

    $search_index = SearchIndex::getIndexLocation();
    Zend_Search_Lucene_Analysis_Analyzer::setDefault(SearchIndex::getIndexAnalyzer());

    $hits = array();

    if ($this->query)
    {
        $index = Zend_Search_Lucene::open($search_index);

        $hits = $index->find(strtolower($this->query));
    }
    $this->hits = $hits;

    $this->setLayout('layout');
  }
}
