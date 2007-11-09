<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class mainMenuComponent extends sfComponent
{

  public function execute()
  {

  //get the current page context
  $this->current_module = strtolower($this->getContext()->getModuleName());
  $this->current_action = strtolower($this->getContext()->getActionName());
  $this->page_title     = $this->getRequestParameter('permalink');
  $this->versionNumber  = sfConfig::get('app_version');
  $this->versionNumberVisibility = 'hidden';
  $this->secondaryMenuVisibility = 'hidden';


  //clear the menu strings
  $mainmenu_css_class = array ('','');
  $this->secondary_menu = '';
  $secondarymenu_css_class = array ('','','','','','');

  switch($this->current_module)
    {
    case 'admin':
      break;

    case 'staticpage':
        if ($this->current_action != 'static')
        {

          $mainmenu_css_class[1]= 'selected';
          $this->versionNumberVisibility = 'visible';

          $this->secondary_menu = link_to(__('users'), 'user/list').link_to(__('static pages'), 'staticpage/list', array('class' => 'selected')).link_to(__('terms'), 'term/list').link_to(__('languages'), 'i18n/list');
          $this->secondaryMenuVisibility = 'visible';

          }
      break;

    case 'user':

      if ($this->current_action != 'login')
      {
       if ($this->current_action != 'show')
       {
          $mainmenu_css_class[1]= 'selected';
          $this->versionNumberVisibility = 'visible';

          $this->secondary_menu = link_to(__('users'), 'user/list', array('class' => 'selected')).link_to(__('static pages'), 'staticpage/list').link_to(__('terms'), 'term/list').link_to(__('languages'), 'i18n/list');
          $this->secondaryMenuVisibility = 'visible';
        }
      }
      break;

     case 'i18n':
         {

          $mainmenu_css_class[1]= 'selected';
          $this->versionNumberVisibility = 'visible';

          $this->secondary_menu = link_to(__('users'), 'user/list').link_to(__('static pages'), 'staticpage/list').link_to(__('terms'), 'term/list').link_to(__('languages'), 'i18n/list', array('class' => 'selected'));
          $this->secondaryMenuVisibility = 'visible';
          }
      break;

    default:

       //all remaining options are for the core systems objects (information object, actor, repository, subject)
       //e.g, the add/edit menu

      $this->versionNumberVisibility = 'hidden';

      if ($this->current_module == 'term')
      {
        if ($this->getUser()->hasCredential('administrator'))
        {
          $mainmenu_css_class[1] = 'selected';
          $this->secondary_menu = link_to(__('users'), 'user/list').link_to(__('static pages'), 'staticpage/list').link_to(__('terms'), 'term/list', array('class' => 'selected')).link_to(__('languages'), 'i18n/list');
          $this->versionNumberVisibility = 'visible';
          $this->secondaryMenuVisibility = 'visible';
        }
        else
        {
          $mainmenu_css_class[0] = 'selected';
          $this->secondary_menu = link_to(__(sfConfig::get('app_ui_label_informationobject')), 'informationobject/list').link_to(__(sfConfig::get('app_ui_label_actor')), 'actor/list').link_to(__(sfConfig::get('app_ui_label_repository')), 'repository/list').link_to(__(sfConfig::get('app_ui_label_subject')), 'term/list?taxonomyId=14', array('class' => 'selected'));
          $this->secondaryMenuVisibility = 'visible';
        }

      }
      else
      {
        $mainmenu_css_class[0]= 'selected';
        switch($this->current_module)
        {
          case 'informationobject':
            {
            $secondarymenu_css_class[0] = 'selected';
            break;
            }
          case 'actor':
            {
            $secondarymenu_css_class[1] = 'selected';
            break;
            }
          case 'repository':
            {
            $secondarymenu_css_class[2] = 'selected';
            break;
            }

        }


        $this->secondary_menu = link_to(__(sfConfig::get('app_ui_label_informationobject')), 'informationobject/list', array('class' => $secondarymenu_css_class[0])).link_to(__(sfConfig::get('app_ui_label_actor')), 'actor/list', array('class' => $secondarymenu_css_class[1])).link_to(__(sfConfig::get('app_ui_label_repository')), 'repository/list', array('class' => $secondarymenu_css_class[2])).link_to(__(sfConfig::get('app_ui_label_subject')), 'term/list?taxonomyId=14');
        $this->secondaryMenuVisibility = 'visible';
      }

    break;
   }



  //set the admin menu to be hidden by default
  if ($this->getUser()->hasCredential('administrator'))
  {
    $this->admin_visible = 'visible';
  }
  else
  {
    $this->admin_visible = 'hidden';
  }



  $this->mainmenu = link_to(__('add / edit'), 'informationobject/list', array('class' => $mainmenu_css_class[0])).link_to(__('admin'), 'user/list', array('class' => $mainmenu_css_class[1], 'style' => 'visibility:'.$this->admin_visible));
  }

}