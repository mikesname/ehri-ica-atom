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

    // Override sfPager::$nbResults = 0
    $nbResults = null;

  /**
   * BasePeer::doCount() returns PDOStatement
   */
  public function doCount(Criteria $criteria)
  {
    call_user_func(array($this->class, 'addSelectColumns'), $criteria);

    return BasePeer::doCount($criteria)->fetchColumn(0);
  }

  public function doSelect(Criteria $criteria)
  {
    return call_user_func(array($this->class, 'get'), $criteria);
  }

  /**
   * @see sfPropelPager
   */
  public function getClassPeer()
  {
    return $this;
  }

  /**
   * Override ::getNbResults() to call ->init() first
   *
   * @see sfPager
   */
  public function getNbResults()
  {
    if (!isset($this->nbResults))
    {
      $this->init();
    }

    return parent::getNbResults();
  }

  /**
   * Override ::getResults() to call ->init() first
   *
   * @see sfPager
   */
  public function getResults()
  {
    $this->init();

    return parent::getResults();
  }
}
