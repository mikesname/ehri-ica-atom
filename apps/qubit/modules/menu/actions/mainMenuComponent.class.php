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

class MenuMainMenuComponent extends sfComponent
{
  public function execute($request)
  {
  //get the current page context
  $this->current_module = strtolower($this->getContext()->getModuleName());
  $this->current_action = strtolower($this->getContext()->getActionName());
  $this->page_title = $this->getRequestParameter('permalink');
  $this->versionNumber  = sfConfig::get('app_version');
  $this->versionNumberVisibility = 'hidden';
  $this->secondaryMenuVisibility = 'hidden';

  //clear the menu strings
  $mainmenu_css_class = array ('','','');
  $this->secondary_menu = '';
  $secondarymenu_css_class = array ('','','','','','');

  switch($this->current_module)
    {
    case 'admin':
      break;

    case 'staticpage':
        if ($this->current_action != 'static')
        {
          $mainmenu_css_class[2]= 'selected';
          $this->versionNumberVisibility = 'visible';

          $this->secondary_menu = link_to(__('users'), 'user/list').link_to(__('static pages'), 'staticpage/list', array('class' => 'selected')).link_to(__('settings'), 'settings/list').link_to(__('export'), 'object/importexport');
          $this->secondaryMenuVisibility = 'visible';
        }
      break;

    case 'user':

      if ($this->current_action != 'login')
      {
       if ($this->current_action != 'show')
       {
          $mainmenu_css_class[2]= 'selected';
          $this->versionNumberVisibility = 'visible';

          $this->secondary_menu = link_to(__('users'), 'user/list', array('class' => 'selected')).link_to(__('static pages'), 'staticpage/list').link_to(__('settings'), 'settings/list').link_to(__('export'), 'object/importexport');
          $this->secondaryMenuVisibility = 'visible';
        }
      }
      break;

     case 'settings':
         {
          $mainmenu_css_class[2]= 'selected';
          $this->versionNumberVisibility = 'visible';

          $this->secondary_menu = link_to(__('users'), 'user/list').link_to(__('static pages'), 'staticpage/list').link_to(__('settings'), 'settings/list', array('class' => 'selected')).link_to(__('export'), 'object/importexport');
          $this->secondaryMenuVisibility = 'visible';
          }
      break;

     case 'object':
         {
          $mainmenu_css_class[2]= 'selected';
          $this->versionNumberVisibility = 'visible';

          $this->secondary_menu = link_to(__('users'), 'user/list').link_to(__('static pages'), 'staticpage/list').link_to(__('settings'), 'settings/list').link_to(__('export'), 'object/importexport', array('class' => 'selected'));
          $this->secondaryMenuVisibility = 'visible';
          }
      break;

     case 'i18n':
         {
          $mainmenu_css_class[1]= 'selected';

          switch($this->current_action)
           {
            case 'listuserinterfacetranslation':
              {
                $secondarymenu_css_class[0] = 'selected';
                break;
              }
            case 'listdefaultcontenttranslation':
              {
                $secondarymenu_css_class[1] = 'selected';
                break;
              }
            case 'listnewcontenttranslation':
              {
                $secondarymenu_css_class[2] = 'selected';
                break;
              }
           }

          $this->secondary_menu = link_to(__('user interface'), 'i18n/listUserInterfaceTranslation', array('class' => $secondarymenu_css_class[0]));
          $this->secondary_menu .= link_to(__('default content'), 'i18n/listDefaultContentTranslation', array('class' => $secondarymenu_css_class[1]));
          $this->secondary_menu .= link_to(__('new content'), 'i18n/listNewContentTranslation', array('class' => $secondarymenu_css_class[2]));

          $this->secondaryMenuVisibility = 'visible';
          }
      break;

    default:

       //all remaining options are for the core systems objects (information object, actor, repository, subject)
       //e.g, the add/edit menu

      $this->versionNumberVisibility = 'hidden';

      $mainmenu_css_class[0]= 'selected';
      switch($this->current_module)
        {
          case 'informationobject':
            {
            $secondarymenu_css_class[0] = 'selected';
            break;
            }
          case 'digitalobject':
            {
            $secondarymenu_css_class[0] = 'selected';
            break;
            }
          case 'physicalobject':
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
          case 'term':
            {
            $secondarymenu_css_class[3] = 'selected';
            break;
            }
        }

        $this->secondary_menu = link_to(sfConfig::get('app_ui_label_informationobject'), 'informationobject/list', array('class' => $secondarymenu_css_class[0]));
        $this->secondary_menu .= link_to(sfConfig::get('app_ui_label_actor'), 'actor/list', array('class' => $secondarymenu_css_class[1]));
       $this->secondary_menu .= link_to(sfConfig::get('app_ui_label_repository'), 'repository/list', array('class' => $secondarymenu_css_class[2]));
       $this->secondary_menu .= link_to(sfConfig::get('app_ui_label_term'), 'term/list', array('class' => $secondarymenu_css_class[3]));

      $this->secondaryMenuVisibility = 'visible';

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

  //build main menu
  $this->mainmenu = link_to(__('add/edit'), 'informationobject/list', array('class' => $mainmenu_css_class[0]));
  if ($this->getUser()->hasCredential('translator'))
  {
    $this->mainmenu .= link_to(__('translate'), 'i18n/listUserInterfaceTranslation', array('class' => $mainmenu_css_class[1], 'style' => 'visibility:'.$this->translate_visible));
  }
  $this->mainmenu .= link_to(__('admin'), 'user/list', array('class' => $mainmenu_css_class[2], 'style' => 'visibility:'.$this->admin_visible));
  }
}
