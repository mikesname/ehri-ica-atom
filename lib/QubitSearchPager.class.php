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
 * @package    Qubit
 * @subpackage search
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */

/*
 * This class is based on PHP Array Pagination by Derek Harvey <www.lotsofcode.com>
 *
 */


class QubitSearchPager
{
  /*
   * Class constructor
   *
   * @param array $hits array of objects returned as hits from Zend Lucene Search
   * @param integer $page current page of hits to display
   *
   */
  public function __construct($hits, $page)
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

  public function getCurrentPage()
  {
    return $this->page;
  }

  public function getPages()
  {
    $links = array();

    for ($j = 1; $j < ($this->pages + 1); $j++)
    {
      $links[] = $j;
    }

    return $links;
  }

  public function haveToPaginate()
  {
     return count($this->allHits) > $this->perPage;
  }

  public function getHits()
  {
    return $this->hits;
  }

  public function getFirstHit()
  {
    return (($this->page - 1) * $this->perPage) + 1;
  }

  public function getLastHit()
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
