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
 * Japanese (ja) search index.
 *
 * @package     qubit
 * @subpackage  search
 * @author      David Juhasz <david@artefactual.com>
 * @version     SVN: $Id$
 */
class ja extends xfIndexSingle
{
  /**
   * Configures initial state of search index by setting a name.
   *
   * @see xfIndex
   */
  protected function initialize()
  {
    $this->setName('ja');
  }

  /**
   * Configures the search index by setting up a search engine and service
   * registry.
   *
   * @see xfIndex
   */
  protected function configure()
  {
    // Config for Japanese
    $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir').'/index/ja'));
  }
}
