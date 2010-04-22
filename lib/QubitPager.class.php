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
    $nbResults = null, /* Override sfPager::$nbResults = 0 */
    $peer_method_name = 'get';

  /**
   * BasePeer::doCount() returns PDOStatement
   */
  public static function doCount(Criteria $criteria)
  {
    return BasePeer::doCount($criteria)->fetchColumn(0);
  }

  /**
   * Override ::init() to call BasePeer::doCount()
   *
   * @see sfPropelPager
   */
  public function init()
  {
    $class = $this->class;
    $this->class = 'QubitPager';

    parent::init();

    $this->class = $class;
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
   * For Qubit we only have the BasePeer peer class
   *
   * @see sfPropelPager
   */
  public function getClassPeer()
  {
    return $this->class;
  }
}
