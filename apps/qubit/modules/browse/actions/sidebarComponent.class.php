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

class BrowseSidebarComponent extends sfComponent
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
