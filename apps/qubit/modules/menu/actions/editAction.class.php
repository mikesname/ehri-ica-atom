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
 * Edit menu
 *
 * @package    qubit
 * @subpackage menu
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class MenuEditAction extends sfAction
{
  public function execute($request)
  {
    $this->forward404Unless($this->menu = QubitMenu::getById($request->getParameter('id')));

    // Pass page parameter to maintain position in menu/list page.
    $this->page = $request->getParameter('page', null);

    $this->menuForm = new MenuEditForm;

    // Handle POST data (form submit)
    if ($request->isMethod('post'))
    {
      $this->menuForm->bind($request->getParameter('menu'));
      if ($this->menuForm->isValid())
      {
        // Do update and redirect to avoid repeat submit wackiness
        $this->updateMenu();
        $this->redirect('menu/list?page='.$this->page);
      }
    }

    // Set defaults values
    $this->menuForm->setDefaults(array(
      'name' => $this->menu->getName(array('sourceCulture' => true)),
      'label' => $this->menu->getLabel(),
      'path' => $this->menu->getPath(array('sourceCulture' => true)),
      'description' => $this->menu->getDescription(),
      'parentId' => $this->menu->getParentId()
    ));

    $this->formAction = 'edit';

    $this->culture = $this->getUser()->getCulture();
  }

  public function updateMenu()
  {
    // Set name
    if (null !== $name = $this->menuForm->getValue('name'))
    {
      $this->menu->setName($name, array('sourceCulture'=>true));
    }

    // Set label
    if (null !== $label = $this->menuForm->getValue('label'))
    {
      $this->menu->setLabel($label);
    }

    // Set path
    if (null !== $path = $this->menuForm->getValue('path'))
    {
      $this->menu->setPath($path, array('sourceCulture'=>true));
    }

    // Set description
    if (null !== $description = $this->menuForm->getValue('description'))
    {
      $this->menu->setDescription($description);
    }

    if (null !== $parentId = $this->menuForm->getValue('parentId'))
    {
      $this->menu->setParentId($parentId);
    }

    $this->menu->save();

    return $this;
  }
}
