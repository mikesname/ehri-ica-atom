<?php

/**
 * is search index.
 *
 * @package     qubit
 * @subpackage  search
 * @author      Your name here
 * @version     SVN: $Id$
 */
class is extends xfIndexSingle
{
  /**
   * Configures initial state of search index by setting a name.
   *
   * @see xfIndex
   */
  protected function initialize()
  {
    $this->setName('is');
  }

  /**
   * Configures the search index by setting up a search engine and service
   * registry.
   *
   * @see xfIndex
   */
  protected function configure()
  {
    // Config for Icelandic
    $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir').'/index/is'));
  }
}
