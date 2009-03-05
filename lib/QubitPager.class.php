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
 * Qubit specifc extension to the sfPropelPager
 *
 * @package Qubit
 * @author  David Juhasz <david@artefactual.com>
 * @version svn:$Id$
 */
class QubitPager extends sfPropelPager
{
  protected
  $criteria               = null,
  $base_peer_class        = 'BasePeer',
  $peer_method_name       = 'doSelect',
  $select_method_name     = 'get',
  $clear_group_by         = true,
  $peer_count_method_name = null,  // Qubit BasePeer has no "doCount()" method
  $offset                 = 0,
  $limit                  = 0,
  $firstPageLink          = null,
  $lastPageLink           = null,
  $totalRecordCount       = null;



  /**
   * Class constructor
   *
   * @param string $class Qubit class name for database mapping
   * @param integer $maxPerPage results to show per page
   */
  public function __construct($class, $maxPerPage=null)
  {
    $this->setClass($class);

    // If maxPerPage not set explicitly, then grab from app_hits_per_page Qubit setting
    $maxPerPage = ($maxPerPage !== null) ? $maxPerPage : sfConfig::get('app_hits_per_page', 10);

    $this->setMaxPerPage($maxPerPage);
    $this->parameterHolder = new sfParameterHolder();

    $this->setCriteria(new Criteria());
    $this->tableName = constant($class.'::TABLE_NAME');
  }

  /**
   * Initialize Pager
   */
  public function init()
  {
    $hasMaxRecordLimit = ($this->getMaxRecordLimit() !== false);
    $maxRecordLimit = $this->getMaxRecordLimit();

    if (!isset($this->totalRecordCount))
    {
      $this->totalRecordCount = $this->getTotalRecordCount($this->criteria);
    }

    $this->setNbResults($hasMaxRecordLimit ? min($this->totalRecordCount, $maxRecordLimit) : $this->totalRecordCount);

    if (($this->getPage() == 0 || $this->getMaxPerPage() == 0))
    {
      $this->setLastPage(0);
    }
    else
    {
      $this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));

      $offset = ($this->getPage() - 1) * $this->getMaxPerPage();
      $this->setOffset($offset);

      if ($hasMaxRecordLimit)
      {
        $maxRecordLimit = $maxRecordLimit - $offset;
        if ($maxRecordLimit > $this->getMaxPerPage())
        {
          $this->setLimit($this->getMaxPerPage());
        }
        else
        {
          $this->setLimit($maxRecordLimit);
        }
      }
      else
      {
        $this->setLimit($this->getMaxPerPage());
      }

      $this->criteria->setOffset($this->offset);
      $this->criteria->setLimit($this->limit);
    }
  }

  /**
   * Return current object
   *
   * @param integer $offset from start of foundset
   * @return object Propel representation of requested row
   */
  protected function retrieveObject($offset)
  {
    if (!isset($this->resultSet))
    {
      $this->getResults();
    }

    return $this->resultSet->offsetGet($offset - 1);
  }

  /**
   * Query database for current page of results
   *
   * @return QubitQuery collection of Propel objects
   */
  public function getResults()
  {
    $c = $this->getCriteria();
    $this->resultSet = call_user_func(array($this->getClass(), $this->getSelectMethod()), $c);
    return $this->resultSet;
  }

  /**
   * Overwrite sfPager::getLinks() so we can set the $firstPageLink
   * and $lastPageLink
   *
   * @param unknown_type $nb_links
   * @return unknown
   */
  public function getLinks($nb_links = 10)
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

    $this->firstPageLink = $begin;
    $this->lastPageLink  = $i;
    $this->currentMaxLink = $links[count($links) - 1];

    return $links;
  }

  /**
   * Get index of first page in link set
   *
   * @return integer first link page number
   */
  public function getFirstPageLink()
  {
    return $this->firstPageLink;
  }

  /**
   * Get index of last page in link set
   *
   * @return integer first link page number
   */
  public function getLastPageLink()
  {
    return $this->lastPageLink;
  }

  /**
   * For Qubit we only have the BasePeer peer class.
   *
   * @return string base peer class name.
   */
  public function getClassPeer()
  {
    return $this->base_peer_class;
  }

  public function getSelectMethod()
  {
    return $this->select_method_name;
  }

  /**
   * Get the offset for the first record in the paginated hitlist
   *
   * @return integer offset
   */
  public function getOffset()
  {
    return $this->offset;
  }

  /**
   * Set the offset for the first record in the paginated hitlist
   *
   * @return integer offset
   */
  public function setOffset($offset)
  {
    $this->offset = $offset;
  }

  /**
   * Get the max. number of rows to return for the current page
   *
   * @return integer limit
   */
  public function getLimit()
  {
    return $this->limit;
  }

  /**
   * Set the max. number of rows to return for the current page
   *
   * @return integer limit
   */
  public function setLimit($limit)
  {
    $this->limit = intval($limit);
  }

  /**
   * Set flag to clear "GROUP BY" column when getting a count of Total records found
   *
   * @param boolean $clearGroupBy
   * @return void
   */
  public function setClearGroupBy($clearGroupBy)
  {
    $this->clear_group_by = ($clearGroupBy == false) ? false : true;
  }

  /**
   * Get clearGroupBy flag
   *
   * @return boolean clear_group_by value
   */
  public function clearGroupBy()
  {
    return $this->clear_group_by;
  }

  /**
   * Set the total number of rows returned from the database
   * with no offset or limit criteria.
   *
   * @param integer $count
   */
  public function setTotalRecordCount($count)
  {
    $this->totalRecordCount = $count;
  }

  /**
   * Get the total records that are returned from the database
   * with no offset or limit criteria.
   *
   * @param criteria $criteria original search criteria
   * @return integer number of rows returned
   */
  public function getTotalRecordCount($criteria)
  {
    $countCriteria = clone $criteria;
    $stmt = BasePeer::doCount($countCriteria);
    $count = $stmt->fetchColumn(0);

    return $count;
  }
}
