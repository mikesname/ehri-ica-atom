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

class BrowseBoxComponent extends sfComponent
{
  public function execute($request)
  {
    $optionsForSelectArray = array(
      'subject' => __(sfConfig::get('app_ui_label_subject')),
      'mediatype' => __(sfConfig::get('app_ui_label_mediatype')),
      'name' => __(sfConfig::get('app_ui_label_name')),
      'materialtype' => __(sfConfig::get('app_ui_label_materialtype')),
      'informationobject' => __(sfConfig::get('app_ui_label_informationobject')),
      'place' => __(sfConfig::get('app_ui_label_place'))
    );

    // Show repository as option only if system set to multi-repository
    if (sfConfig::get('app_multi_repository') !== '0')
    {
      $optionsForSelectArray['repository'] = __(sfConfig::get('app_ui_label_repository'));
    }

    $selectedOption = ($this->getUser()->hasAttribute('browse_list')) ? $this->getUser()->getAttribute('browse_list') : 'subject';

    $this->optionsForSelect = options_for_select($optionsForSelectArray, $selectedOption);
  }
}
