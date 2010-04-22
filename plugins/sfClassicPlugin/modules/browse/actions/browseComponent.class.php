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

class BrowseBrowseComponent extends sfComponent
{
  public function execute($request)
  {
    $this->options = array(
      'informationobject' => __(sfConfig::get('app_ui_label_informationobject')),
      'name' => __(sfConfig::get('app_ui_label_name')),
      'function' => __('functions'),
      'subject' => __(sfConfig::get('app_ui_label_subject')),
      'place' => __(sfConfig::get('app_ui_label_place')),
      'mediatype' => __(sfConfig::get('app_ui_label_digitalobject')));

    // Show repository as option only if system set to multi-repository
    if (sfConfig::get('app_multi_repository'))
    {
      $this->options['repository'] = __(sfConfig::get('app_ui_label_repository'));
    }

    $this->selected = 'subject';
    if ($this->context->user->hasAttribute('browse_list'))
    {
      $this->selected = $this->context->user->getAttribute('browse_list');
    }
  }
}
