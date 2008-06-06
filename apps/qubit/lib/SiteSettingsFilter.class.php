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

class siteSettingsFilter extends sfFilter
{
  /*
   * execute this filter on every request in case some params have changed since the last page load
   */
  public function execute ($filterChain)
  {
    // create a function cache object for the QubitSettings method call
    $fileCache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_app_cache_dir').'/settings'));

    // invalidate cache when user switches culture
    // FIXME: there must be a smarter way to detect this accurately; user culture is set very early after routing
    if ($this->getContext()->getRequest()->getParameter('sf_culture'))
    {
      $fileCache->clean();
    }

    $functionCache = new sfFunctionCache($fileCache);

    // get settings (from cache if it exists)
    $settings = $functionCache->call(array(new QubitSetting, 'getSettingsArray'));

    // overwrite/populate settings into sfConfig object
    sfConfig::add($settings);

    // execute next filter
    $filterChain->execute();
  }
}

?>
