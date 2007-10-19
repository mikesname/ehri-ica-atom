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

class menuComponents extends sfComponents
{

  public function executeMainMenu()
  {

  //get the current page context
  $rootURL = $this->getRequest()->getRelativeUrlRoot();
  $this->current_module = strtolower($this->getContext()->getModuleName());
  $this->current_action = strtolower($this->getContext()->getActionName());
  $this->page_title     = $this->getRequestParameter('permalink');

  //clear the menu strings
  $mainmenu_css_class = array ('','','','','');
  $this->secondary_menu = '';
  $secondarymenu_css_class = array ('','','','','','');

  //set the add and admin menus to be hidden by default
  $this->add_visible = 'visible';
  $this->admin_visible = 'hidden';


  switch($this->current_module){


    case 'admin':
      break;

    case 'staticpage':
        if ($this->page_title == 'homepage')
        {
          $mainmenu_css_class[0]= "id='selected'";

        }
        else if ($this->current_action != 'static')
        {

          $mainmenu_css_class[4]= "id='selected'";
          $this->secondary_menu = "<div class='menu-secondary'>
              \n<a href='".$rootURL."/user/list'>usuarios</a>
              \n<a class='selected' href='".$rootURL."/staticpage/list'>p&#225;ginas est&#225;ticas</a>
            \n<a href='".$rootURL."/term/list'>t&#233;rminos</a>
               \n</div> <!-- close menu-secondary -->";
          }
      break;

    case 'search':
      $mainmenu_css_class[1]= "id='selected'";

        //Hide the Advanced Search option until it is implemented
        /*
        if ($this->current_action == 'keyword') {
        $this->secondarymenu_css_class[0] = "class='selected'";
        }else{
        $this->secondarymenu_css_class[1] = "class='selected'";
        }
        $this->secondary_menu = "<div class='menu-secondary'>
        \n<a ".$this->secondarymenu_css_class[0]." href='".$rootURL."/search/keyword'>keyword</a>
        \n<a ".$this->secondarymenu_css_class[1]." href='".$rootURL."/search/advanced'>advanced</a>
        \n</div> <!-- close menu-secondary -->";
        */

      break;

    case 'browse':
      $mainmenu_css_class[2]= "id='selected'";

        switch($this->getUser()->getAttribute('nav_context_action')) {
          case 'subject':
            $secondarymenu_css_class[0] = "class='selected'";
            break;
          case 'language':
            $secondarymenu_css_class[1] = "class='selected'";
            break;
          case 'country':
            $secondarymenu_css_class[2] = "class='selected'";
            break;
          case 'repository':
            $secondarymenu_css_class[3] = "class='selected'";
            break;
          case 'creator':
            $secondarymenu_css_class[4] = "class='selected'";
            break;
          case 'recent':
            $secondarymenu_css_class[5] = "class='selected'";
            break;
            }

      $this->secondarymenu_css_class = $secondarymenu_css_class;

      $this->secondary_menu = "<div class='menu-secondary'>
      \n<a ".$this->secondarymenu_css_class[0]." href='".$rootURL."/browse/subjectList'>materias</a>
      \n<a ".$this->secondarymenu_css_class[1]." href='".$rootURL."/browse/languageList'>idioma</a>
      \n<a ".$this->secondarymenu_css_class[2]." href='".$rootURL."/browse/countryList'>pa&#237;s</a>
      \n<a ".$this->secondarymenu_css_class[3]." href='".$rootURL."/browse/repositoryList'>repositorio o deposito</a>
      \n<a ".$this->secondarymenu_css_class[4]." href='".$rootURL."/browse/creatorList'>creador</a>
      \n<a ".$this->secondarymenu_css_class[5]." href='".$rootURL."/browse/recentList'>cambios recientes</a>
      \n</div> <!-- close menu-secondary -->";

      break;

    case 'user':

      if ($this->current_action != 'login')
      {
       if ($this->current_action != 'show')
       {
          $mainmenu_css_class[4]= "id='selected'";
          $this->secondary_menu = "<div class='menu-secondary'>
            \n<a class='selected' href='".$rootURL."/user/list'>usuarios</a>
            \n<a href='".$rootURL."/staticpage/list'>p&#225;ginas est&#225;ticas</a>
            \n<a href='".$rootURL."/term/list'>t&#233;rminos</a>
            \n</div> <!-- close menu-secondary -->";
        }
      }
      break;

    default:

       //all remaining options are for the core systems objects (information object, actor, repository, subject)

       //if the action is 'show', then the navigation context could be from search or browse so the main menu
       //should reflect that:
       if ($this->current_action == 'show')
       {
            if ($this->getUser()->getAttribute('nav_context_module') == 'search')
            {
                    $mainmenu_css_class[1]= "id='selected'";
            }
            else
            {
                    if ($this->getUser()->getAttribute('nav_context_module') == 'browse')
                    {
                    $mainmenu_css_class[2]= "id='selected'";

                    switch ($this->getUser()->getAttribute('nav_context_action'))
                    {
                      case 'subject':
                        $secondarymenu_css_class[0] = "class='selected'";
                        break;
                      case 'language':
                        $secondarymenu_css_class[1] = "class='selected'";
                        break;
                      case 'country':
                        $secondarymenu_css_class[2] = "class='selected'";
                        break;
                      case 'repository':
                        $secondarymenu_css_class[3] = "class='selected'";
                        break;
                      case 'creator':
                        $secondarymenu_css_class[4] = "class='selected'";
                        break;
                      case 'date':
                        $secondarymenu_css_class[5] = "class='selected'";
                        break;
                        }

                    $this->secondarymenu_css_class = $secondarymenu_css_class;

                    $this->secondary_menu = "<div class='menu-secondary'>
                    \n<a ".$this->secondarymenu_css_class[0]." href='".$rootURL."/browse/subjectList'>materias</a>
                    \n<a ".$this->secondarymenu_css_class[1]." href='".$rootURL."/browse/languageList'>idioma</a>
                    \n<a ".$this->secondarymenu_css_class[2]." href='".$rootURL."/browse/countryList'>pa&#237;s</a>
                    \n<a ".$this->secondarymenu_css_class[3]." href='".$rootURL."/browse/repositoryList'>repositorio o deposito</a>
                    \n<a ".$this->secondarymenu_css_class[4]." href='".$rootURL."/browse/creatorList'>creador</a>
                    \n<a ".$this->secondarymenu_css_class[5]." href='".$rootURL."/browse/recentList'>cambios recientes</a>
                    \n</div> <!-- close menu-secondary -->";
                    }
                }
       }

    else
      {
      if ($this->current_module == 'term')
        {
        if (($this->current_action == 'createsubject') or ($this->current_action == 'editsubject') or ($this->current_action == 'listsubject'))
          {
          $mainmenu_css_class[3] = "id = 'selected'";
          $secondarymenu_css_class = array('','','','');
          $secondarymenu_css_class[3]= "class='selected'";

          $this->secondarymenu_css_class = $secondarymenu_css_class;

        $this->secondary_menu = "<div class='menu-secondary'>
        \n<a ".$this->secondarymenu_css_class[0]." href='".$rootURL."/informationobject/list'>material archivado</a>
        \n<a ".$this->secondarymenu_css_class[1]." href='".$rootURL."/actor/list'>creador</a>
        \n<a ".$this->secondarymenu_css_class[2]." href='".$rootURL."/repository/list'>repositorio o deposito</a>
        \n<a ".$this->secondarymenu_css_class[3]." href='".$rootURL."/term/listSubject'>materia</a>
        \n</div> <!-- close menu-secondary -->";
          }
          else
            {
            $mainmenu_css_class[4] = "id = 'selected'";
            $this->secondary_menu = "<div class='menu-secondary'>
            \n<a href='".$rootURL."/user/list'>usuarios</a>
            \n<a href='".$rootURL."/staticpage/list'>p&#225;ginas est&#225;ticas</a>
            \n<a class='selected' href='".$rootURL."/term/list'>t&#233;rminos</a>
            \n</div> <!-- close menu-secondary -->";
            }

        }
      else
        {
        $mainmenu_css_class[3]= "id='selected'";
        $secondarymenu_css_class = array('','','','');

            switch($this->current_module)
              {
                case 'informationobject':
                    $secondarymenu_css_class[0]= "class='selected'";
                    break;
                case 'actor':
                   $secondarymenu_css_class[1]= "class='selected'";
                    break;
                case 'repository':
                    $secondarymenu_css_class[2]= "class='selected'";
                    break;
              }

       $this->secondarymenu_css_class = $secondarymenu_css_class;

       $this->secondary_menu = "<div class='menu-secondary'>
        \n<a ".$this->secondarymenu_css_class[0]." href='".$rootURL."/informationobject/list'>material archivado</a>
        \n<a ".$this->secondarymenu_css_class[1]." href='".$rootURL."/actor/list'>creador</a>
        \n<a ".$this->secondarymenu_css_class[2]." href='".$rootURL."/repository/list'>repositorio o deposito</a>
        \n<a ".$this->secondarymenu_css_class[3]." href='".$rootURL."/term/listSubject'>materia</a>
        \n</div> <!-- close menu-secondary -->";
        }
      }

    break;
   }


  //check user credentials and enable the appropriate menu options

  $this->mainmenu_css_class = $mainmenu_css_class;

  /*if ($this->getUser()->hasCredential('contributor'))
  {
    $this->add_visible = 'visible';
    }*/

  if ($this->getUser()->hasCredential('administrator'))
  {
     $this->admin_visible = 'visible';
     }

  $this->mainmenu = "<a ".$this->mainmenu_css_class[0]." href='/'>home</a>
    \n<a ".$this->mainmenu_css_class[1]." href='".$rootURL."/search'>b&#250;squeda</a>
    \n<a ".$this->mainmenu_css_class[2]." href='".$rootURL."/browse'>b&#250;squeda general</a>
    \n<a ".$this->mainmenu_css_class[3]." href='".$rootURL."/informationobject/list'
          style='visibility:".$this->add_visible.";'>agregar</a>
    \n<a ".$this->mainmenu_css_class[4]." href='".$rootURL."/user/list' style='visibility:".$this->admin_visible.";'>administraci&#243;n</a>";


  } // close executeMainMenu()




  public function executeDetailMenu()
  {

  //get the current page context
  $rootURL = $this->getRequest()->getRelativeUrlRoot();
  $module = strtolower($this->getContext()->getModuleName());
  $action = strtolower($this->getContext()->getActionName());
  $template = strtolower($this->getRequestParameter('template'));
  $id = $this->getRequestParameter('id');

  $this->detailMenu = '';

  //create detail menu for information object
  if ($module == 'informationobject')
    {
    $detailmenu_css_class = array('','','','','','','','');

    switch($template)
      {
      case 'brief':
        $detailmenu_css_class[0] = 'id="menu-detail-selected"';
        break;
      case 'full':
        $detailmenu_css_class[1] = 'id="menu-detail-selected"';
        break;
      case 'identitystatement':
        $detailmenu_css_class[2] = 'id="menu-detail-selected"';
        break;
      case 'context':
        $detailmenu_css_class[3] = 'id="menu-detail-selected"';
        break;
      case 'contentandstructure':
        $detailmenu_css_class[4] = 'id="menu-detail-selected"';
        break;
      case 'accessanduse':
        $detailmenu_css_class[5] = 'id="menu-detail-selected"';
        break;
      case 'alliedmaterials':
        $detailmenu_css_class[6] = 'id="menu-detail-selected"';
        break;
      case 'notesandcontrol':
        $detailmenu_css_class[7] = 'id="menu-detail-selected"';
        break;
      default:
        //make sure this matches the default template as set in informationobject/actions/editAction.class
        $detailmenu_css_class[2] = 'id="menu-detail-selected"';
      }

    if ($action == 'edit')
      {
      if (($template == 'full') or ($template =='brief'))
        {
        $this->detailMenu .= '<a '.$detailmenu_css_class[0].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/brief">brief</a>';
        $this->detailMenu .= '<a '.$detailmenu_css_class[1].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/full">full</a>';
        }
      else
        {
        $this->detailMenu .='<a '.$detailmenu_css_class[2].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/identitystatement">Identity Statement</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[3].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/context">Context</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[4].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/contentandstructure">Content And Structure</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[5].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/accessanduse">Access and Use</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[6].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/alliedmaterials">Allied Materials</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[7].' href="'.$rootURL.'/informationobject/edit/id/'.$id.'/template/notesandcontrol">Notes and Description Control</a>';
        }
      }
    else if ($action == 'create')
      {
      if (($template == 'full') or ($template =='brief'))
        {
        $this->detailMenu .= '<a '.$detailmenu_css_class[0].' href="'.$rootURL.'/informationobject/create/template/brief">brief</a>';
        $this->detailMenu .= '<a '.$detailmenu_css_class[1].' href="'.$rootURL.'/informationobject/create/template/full">full</a>';
        }
      else
        {
        $this->detailMenu .='<a '.$detailmenu_css_class[2].' href="'.$rootURL.'/informationobject/create/template/identitystatement">Identity Statement</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[3].' href="'.$rootURL.'/informationobject/create/template/context">Context</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[4].' href="'.$rootURL.'/informationobject/create/template/contentandstructure">Content And Structure</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[5].' href="'.$rootURL.'/informationobject/create/template/accessanduse">Access and Use</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[6].' href="'.$rootURL.'/informationobject/create/template/alliedmaterials">Allied Materials</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[7].' href="'.$rootURL.'/informationobject/create/template/notesandcontrol">Notes and Description Control</a>';
        }
      }
    } //close detail menu for information object

  //create detail menu for repository
  if ($module == 'repository')
    {
    $detailmenu_css_class = array('','','','','','','');

    switch($template)
      {
      case 'brief':
        $detailmenu_css_class[0] = 'id="menu-detail-selected"';
        break;
      case 'full':
        $detailmenu_css_class[1] = 'id="menu-detail-selected"';
        break;
      case 'identity':
        $detailmenu_css_class[2] = 'id="menu-detail-selected"';
        break;
      case 'contact':
        $detailmenu_css_class[3] = 'id="menu-detail-selected"';
        break;
      case 'access':
        $detailmenu_css_class[4] = 'id="menu-detail-selected"';
        break;
      case 'description':
        $detailmenu_css_class[5] = 'id="menu-detail-selected"';
        break;
      case 'services':
        $detailmenu_css_class[6] = 'id="menu-detail-selected"';
        break;
      default:
        //make sure this matches the default template as set in repository/actions/editAction.class
        $detailmenu_css_class[2] = 'id="menu-detail-selected"';
      }

    if ($action == 'edit')
      {
      if (($template == 'full') or ($template =='brief'))
        {
        $this->detailMenu .= '<a '.$detailmenu_css_class[0].' href="'.$rootURL.'/repository/edit/id/'.$id.'/template/brief">brief</a>';
        $this->detailMenu .= '<a '.$detailmenu_css_class[1].' href="'.$rootURL.'/repository/edit/id/'.$id.'/template/full">full</a>';
        }
      else
        {
        $this->detailMenu .='<a '.$detailmenu_css_class[2].' href="'.$rootURL.'/repository/edit/id/'.$id.'/template/identity">Identity</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[3].' href="'.$rootURL.'/repository/edit/id/'.$id.'/template/contact">Contact</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[4].' href="'.$rootURL.'/repository/edit/id/'.$id.'/template/access">Access</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[5].' href="'.$rootURL.'/repository/edit/id/'.$id.'/template/description">Description</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[6].' href="'.$rootURL.'/repository/edit/id/'.$id.'/template/services">Services</a>';
        }
      }
    else if ($action == 'create')
      {
      if (($template == 'full') or ($template =='brief'))
        {
        $this->detailMenu .= '<a '.$detailmenu_css_class[0].' href="'.$rootURL.'/repository/create/template/brief">brief</a>';
        $this->detailMenu .= '<a '.$detailmenu_css_class[1].' href="'.$rootURL.'/repository/create/template/full">full</a>';
        }
      else
        {
        $this->detailMenu .='<a '.$detailmenu_css_class[2].' href="'.$rootURL.'/repository/create/template/identity">Identity</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[3].' href="'.$rootURL.'/repository/create/template/contact">Contact</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[4].' href="'.$rootURL.'/repository/create/template/access">Access</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[5].' href="'.$rootURL.'/repository/create/template/description">Description</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[6].' href="'.$rootURL.'/repository/create/template/services">Services </a>';
        }
      }
    } //close detail menu for repository


  //create detail menu for actor
  if ($module == 'actor')
    {
    $detailmenu_css_class = array('','','','','','');

    switch($template)
      {
      case 'brief':
        $detailmenu_css_class[0] = 'id="menu-detail-selected"';
        break;
      case 'full':
        $detailmenu_css_class[1] = 'id="menu-detail-selected"';
        break;
      case 'identity':
        $detailmenu_css_class[2] = 'id="menu-detail-selected"';
        break;
      case 'description':
        $detailmenu_css_class[3] = 'id="menu-detail-selected"';
        break;
      case 'relationships':
        $detailmenu_css_class[4] = 'id="menu-detail-selected"';
        break;
      case 'control':
        $detailmenu_css_class[5] = 'id="menu-detail-selected"';
        break;
      default:
        //make sure this matches the default template as set in informationobject/actions/editAction.class
        $detailmenu_css_class[2] = 'id="menu-detail-selected"';
      }

    if ($action == 'edit')
      {
      if (($template == 'full') or ($template =='brief'))
        {
        $this->detailMenu .= '<a '.$detailmenu_css_class[0].' href="'.$rootURL.'/actor/edit/id/'.$id.'/template/brief">brief</a>';
        $this->detailMenu .= '<a '.$detailmenu_css_class[1].' href="'.$rootURL.'/actor/edit/id/'.$id.'/template/full">full</a>';
        }
      else
        {
        $this->detailMenu .='<a '.$detailmenu_css_class[2].' href="'.$rootURL.'/actor/edit/id/'.$id.'/template/identity">Identity</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[3].' href="'.$rootURL.'/actor/edit/id/'.$id.'/template/description">Description</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[4].' href="'.$rootURL.'/actor/edit/id/'.$id.'/template/relationships">Relationships</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[5].' href="'.$rootURL.'/actor/edit/id/'.$id.'/template/control">Control</a>';
        }
      }
    else if ($action == 'create')
      {
      if (($template == 'full') or ($template =='brief'))
        {
        $this->detailMenu .= '<a '.$detailmenu_css_class[0].' href="'.$rootURL.'/actor/create/template/brief">brief</a>';
        $this->detailMenu .= '<a '.$detailmenu_css_class[1].' href="'.$rootURL.'/actor/create/template/full">full</a>';
        }
      else
        {
        $this->detailMenu .='<a '.$detailmenu_css_class[2].' href="'.$rootURL.'/actor/create/template/identity">Identity</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[3].' href="'.$rootURL.'/actor/create/template/description">Description</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[4].' href="'.$rootURL.'/actor/create/template/relationships">Relationships</a>';
        $this->detailMenu .='<a '.$detailmenu_css_class[5].' href="'.$rootURL.'/actor/create/template/control">Control</a>';
        }
      }
    } //close detail menu for actor

  } //close executeDetailMenu()




}
?>
