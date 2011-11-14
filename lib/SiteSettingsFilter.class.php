<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class siteSettingsFilter extends sfFilter
{
  /*
   * Execute this filter on every request in case some params have changed since the last page load
   */
  public function execute($filterChain)
  {
    // Create a function cache object for the QubitSettings method call
    $cache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_app_cache_dir').'/settings'));

    // Get settings (from cache if exists)
    if ($cache->has('settings'))
    {
      $settings = unserialize($cache->get('settings'));
    }
    else
    {
      $settings = QubitSetting::getSettingsArray();

      $cache->set('settings', serialize($settings));
    }

    // Overwrite/populate settings into sfConfig object
    sfConfig::add($settings);

    // Execute next filter
    $filterChain->execute();
  }
}
