<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class keywordAction extends sfAction
{
  public function execute()
  {
  setlocale(LC_CTYPE, 'en_US.utf-8');
  $this->query = $this->getRequestParameter('search_query');

  if ($this->query)
  {
  $this->getResponse()->setTitle('Search for \''.$this->query.'\'', true);
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

  }

  public function handleError()
    {

    return sfView::SUCCESS;
    }
}
