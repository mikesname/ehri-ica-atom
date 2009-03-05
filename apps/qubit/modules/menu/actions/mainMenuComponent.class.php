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

/**
 * Build main user navigation menu as simple xhtml lists, relying on css styling to
 * format the display of the menus.
 *
 * @package    qubit
 * @subpackage menu
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class MenuMainMenuComponent extends sfComponent
{
  public function execute($request)
  {
    // get the current page context
    $this->versionNumber  = sfConfig::get('app_version');

    $currentModule = $this->getContext()->getModuleName();
    $currentAction = $this->getContext()->getActionName();
    $currentUrl = url_for($currentModule.'/'.$currentAction);

    // Get menu objects
    $this->mainMenu = QubitMenu::getById(QubitMenu::MAIN_MENU_ID);
    $this->adminMenu = QubitMenu::getById(QubitMenu::ADMIN_ID);

    // Set visibility
    $this->versionNumberVisibility = ($this->adminMenu->isDescendantSelected()) ? 'visible' : 'hidden';
    $this->showSecondaryMenu = ($currentUrl != url_for('')) ? true : false;

    // Hide menus that user cannot access
    $options = array();
    if (!$this->getUser()->hasCredential('administrator'))
    {
      $options['overrideVisibility']['admin'] = 'hidden';
    }

    if (!$this->getUser()->hasCredential('translator'))
    {
      $options['overrideVisibility']['translate'] = 'hidden';
    }

    $this->options = $options;
  }
}