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

/**
 * Arabic (ar) search index.
 *
 * @package     qubit
 * @subpackage  search
 * @author      David Juhasz <david@artefactual.com>
 * @version     SVN: $Id$
 */
class ar extends xfIndexSingle
{
  /**
   * Configures initial state of search index by setting a name.
   *
   * @see xfIndex
   */
  protected function initialize()
  {
    $this->setName('ar');
  }

  /**
   * Configures the search index by setting up a search engine and service
   * registry.
   *
   * @see xfIndex
   */
  protected function configure()
  {
    // Config for Arabic
    $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir').'/index/ar'));
  }
}
