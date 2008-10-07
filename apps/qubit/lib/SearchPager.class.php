<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * It is based on PHP Array Pagination
 * Copyright (C) 2007 Derek Harvey <www.lotsofcode.com>
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

/**
 * @package    Qubit
 * @subpackage search
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */  
class SearchPager
{
  /*
   * Class constructor
   *
   * @param array $hits array of objects returned as hits from Zend Lucene Search
   * @param integer $page current page of hits to display
   *
   */ 
  function __construct($hits, $page)
  {
    // Assign the items per page variable
    if (sfConfig::get('app_hits_per_page') > 0)
    {
      // get perPage limit from Admin settings
      $this->perPage = sfConfig::get('app_hits_per_page', 10);
    }
    else
    {
      // set default perPage
      $this->perPage = 10;
    } 
      
    // Assign the current page
    $this->page = $page;
      
    // Take the length of the array
    $this->length = count($hits);
      
    // Get the number of pages
    $this->pages = ceil($this->length / $this->perPage);
      
    // Calculate the starting point 
    $this->start  = ceil(($this->page - 1) * $this->perPage);
    
    // Set the full array of hits
    $this->allHits = $hits;
      
    // Set the hits in scope on current page
    $this->hits = array_slice($hits, $this->start, $this->perPage);
  }

  function getCurrentPage()
  {
    return $this->page;
  }

  function getPages()
  {
    $links = array();

    for ($j = 1; $j < ($this->pages + 1); $j++) 
    {
      $links[] = $j;
    }
      
    return $links;
    }
    
  function haveToPaginate()
  {
     return count($this->allHits) > $this->perPage;
  }

  function getHits()
  {
    return $this->hits;
  }
  
  function getFirstHit()
  {
    return (($this->page - 1) * $this->perPage) + 1;
  }
  
  function getLastHit()
  {
    if (count($this->getPages()) > $this->getCurrentPage())
    {
  
      return ($this->getFirstHit() + $this->perPage) - 1;
    }
    else
    {
  
      return (count($this->allHits));
    }
  }
    
}
