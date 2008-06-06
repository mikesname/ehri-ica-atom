<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

class SearchKeywordAction extends sfAction
{
  public function execute($request)
  {
  $culture = $this->getUser()->getCulture();
  setlocale(LC_CTYPE, $culture.'.utf-8');
  $this->query = $this->getRequestParameter('search_query');

  if ($this->query)
  {
  $this->getResponse()->setTitle('Search for \''.$this->query.'\'', true);
  }

  $search_index = SearchIndex::getIndexLocation('informationobject', $culture);
  Zend_Search_Lucene_Analysis_Analyzer::setDefault(SearchIndex::getIndexAnalyzer());

  $hits = array();

  if ($this->query)
  {
      $index = Zend_Search_Lucene::open($search_index);
      $hits = $index->find(strtolower($this->query));
  }
  $this->hits = $hits;
  }

  public function handleError()
    {
    return sfView::SUCCESS;
    }
}
