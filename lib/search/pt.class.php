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

class pt extends xfIndexSingle
{
  /**
   * Configures initial state of search index by setting a name.
   *
   * @see xfIndex
   */
  protected function initialize()
  {
    $this->setName('pt');
  }

  /**
   * Configures the search index by setting up a search engine and service
   * registry.
   *
   * @see xfIndex
   */
  protected function configure()
  {
    // The ->configure() method setups the search index so it knows how to
    // behave.  You must setup a search engine and a search registry so the
    // index knows whats to index and how to index it.
    //
    // This method is analogous to ->configure() in sfForm.  In fact, it has the
    // same purpose and follows similar logic.
    //
    // Consider the following examples as you setup your index:
    //
    // Setup the backend engine:
    //
    //    $this->setEngine(new MyEngine('...'));
    //
    // Setup the services:
    //
    //    $s1 = new xfService(new MyIdentifier('...'));
    //    $s1->addBuilder(new MyBuilder(array(
    //                                        new xfField('foo', xfField::KEYWORD),
    //                                        new xfField('bar', xfField::TEXT)
    //                                  ));
    //    $s1->addRetort(new xfRetortField);
    //    $s1->addRetort(new xfRetortRoute('module/action?param=%foo%'));
    //
    //    $this->getServiceRegistry()->register($s1);
    //
    // Repeat for each service you require.
    //
    // After you have configured the index, you should populate it.  Do this by
    // running the symfony task:
    //
    //    $ ./symfony search:populate pt
    //
    // For more information, please see the documentation included in the
    // sfSearch package.
    $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir').'/index/pt'));
  }
}
