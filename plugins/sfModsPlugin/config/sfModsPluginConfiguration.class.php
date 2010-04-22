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

class sfModsPluginConfiguration extends sfPluginConfiguration
{
  public static
    $summary = 'Metadata standard plugin. Enables data-entry, display and XML export using Metadata Object Description Schema (MODS).',
    $version = '1.0.0';

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules[] = 'sfModsPlugin';
    sfConfig::set('sf_enabled_modules', $enabledModules);
  }
}
