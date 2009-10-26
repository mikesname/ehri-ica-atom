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
 * Mimic the sfPager page inteface (mostly) for use with a simple array of
 * items rather than the database result set that is assumed by sfPager.
 *
 * @package    Qubit
 * @subpackage libraries
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class QubitArrayPager
{
  protected
  $page            = 1,
  $maxPerPage      = 0,
  $lastPage        = 1,
  $nbResults       = 0,
  $array           = '',
  $objects         = null,
  $cursor          = 1,
  $currentMaxLink  = 1,
  $maxRecordLimit = false;

  /*
   * Class constructor
   *
   * @param array   $array array of items to paginate
   * @param integer $page current page of hits to display
   * @param array   $options array of optional parameters
   */
  public function __construct($array, $page, $options = array())
  {
    $this->array = $array;
    $this->page = $page;

    // Assign the items per page variable
    if (isset($options['maxPerPage']))
    {
      $this->setMaxPerPage($options['maxPerPage']);
    }
    else if (sfConfig::get('app_hits_per_page') > 0)
    {
      // get perPage limit from Admin settings
      $this->setMaxPerPage(sfConfig::get('app_hits_per_page', 10));
    }
    else
    {
      // set default perPage
      $this->setMaxPerPage(10);
    }

    $this->init();
  }

  public function init()
  {
    // Set number of results
    $this->setNbResults(count($this->array));

    // Get the number of pages
    $this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));

    // Calculate the starting point
    $offset = ($this->getPage() - 1) * $this->getMaxPerPage();
    $this->setOffset($offset);
  }

  public function getResults()
  {
    $this->results = array_slice($this->array, $this->getOffset(), $this->getMaxPerPage());

    return $this->results;
  }

  protected function retrieveObject()
  {
    return $this->array[$this->cursor - 1];
  }

  public function getPage()
  {
    return $this->page;
  }

  public function getLinks($nb_links = 5)
  {
    $links = array();
    $tmp   = $this->page - floor($nb_links / 2);
    $check = $this->lastPage - $nb_links + 1;
    $limit = ($check > 0) ? $check : 1;
    $begin = ($tmp > 0) ? (($tmp > $limit) ? $limit : $tmp) : 1;

    $i = $begin;
    while (($i < $begin + $nb_links) && ($i <= $this->lastPage))
    {
      $links[] = $i++;
    }

    $this->currentMaxLink = $links[count($links) - 1];

    return $links;
  }

  public function haveToPaginate()
  {
    return $this->getNbResults() > $this->getMaxPerPage();
  }

  public function setOffset($offset)
  {
    $this->offset = $offset;
  }

  public function getOffset()
  {
    return $this->offset;
  }

  public function getCursor()
  {
    return $this->cursor;
  }

  public function setCursor($pos)
  {
    if ($pos < 1)
    {
      $this->cursor = 1;
    }
    else if ($pos > $this->nbResults)
    {
      $this->cursor = $this->nbResults;
    }
    else
    {
      $this->cursor = $pos;
    }
  }

  public function getObjectByCursor($pos)
  {
    $this->setCursor($pos);

    return $this->getCurrent();
  }

  public function getCurrent()
  {
    return $this->retrieveObject($this->cursor);
  }

  public function getNext()
  {
    if (($this->cursor + 1) > $this->nbResults)
    {
      return null;
    }
    else
    {
      return $this->retrieveObject($this->cursor + 1);
    }
  }

  public function getPrevious()
  {
    if (($this->cursor - 1) < 1)
    {
      return null;
    }
    else
    {
      return $this->retrieveObject($this->cursor - 1);
    }
  }

  public function getFirstIndice()
  {
    if ($this->page == 0)
    {
      return 1;
    }
    else
    {
      return ($this->page - 1) * $this->maxPerPage + 1;
    }
  }

  public function getLastIndice()
  {
    if ($this->page == 0)
    {
      return $this->nbResults;
    }
    else
    {
      if (($this->page * $this->maxPerPage) >= $this->nbResults)
      {
        return $this->nbResults;
      }
      else
      {
        return ($this->page * $this->maxPerPage);
      }
    }
  }

  public function getClass()
  {
    return $this->class;
  }

  public function setClass($class)
  {
    $this->class = $class;
  }

  public function getNbResults()
  {
    return $this->nbResults;
  }

  protected function setNbResults($nb)
  {
    $this->nbResults = $nb;
  }

  public function getFirstPage()
  {
    return 1;
  }

  public function getLastPage()
  {
    return $this->lastPage;
  }

  protected function setLastPage($page)
  {
    $this->lastPage = $page;
    if ($this->getPage() > $page)
    {
      $this->setPage($page);
    }
  }

  public function getNextPage()
  {
    return min($this->getPage() + 1, $this->getLastPage());
  }

  public function getPreviousPage()
  {
    return max($this->getPage() - 1, $this->getFirstPage());
  }

  public function setPage($page)
  {
    $this->page = intval($page);
    if ($this->page <= 0)
    {
      //set first page, which depends on a maximum set
      $this->page = $this->getMaxPerPage() ? 1 : 0;
    }
  }

  public function getMaxPerPage()
  {
    return $this->maxPerPage;
  }

  public function setMaxPerPage($max)
  {
    if ($max > 0)
    {
      $this->maxPerPage = $max;
      if ($this->page == 0)
      {
        $this->page = 1;
      }
    }
    else if ($max == 0)
    {
      $this->maxPerPage = 0;
      $this->page = 0;
    }
    else
    {
      $this->maxPerPage = 1;
      if ($this->page == 0)
      {
        $this->page = 1;
      }
    }
  }
}
