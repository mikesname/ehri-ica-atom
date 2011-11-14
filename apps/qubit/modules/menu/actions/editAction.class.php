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
  public static
    $NAMES = array(
      'name',
      'label',
      'parentId',
      'path',
      'description');

  protected function addField($name)
  {
    switch ($name)
    {
      case 'name':
      case 'path':
        $this->form->setDefault($name, $this->menu[$name]);
        $this->form->setValidator($name, new sfValidatorString(array('required' => true)));
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'label':
        $this->form->setDefault($name, $this->menu[$name]);
        $this->form->setValidator($name, new sfValidatorString());
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'parentId':

        // Get menuTree array with menu depths
        $menuTree = QubitMenu::getTreeById(QubitMenu::ROOT_ID);

        // Build an array of choices for "parentId" select box (with blank line)
        $choices = array(1 => '[ '.$this->context->i18n->__('Top').' ]');
        foreach ($menuTree as $menu)
        {
          $choices[$menu['id']] = str_repeat('-', $menu['depth']).' '.$menu['name'];
        }

        if (null !== $this->menu->parentId)
        {
          $this->form->setDefault('parentId', $this->menu->parentId);
        }

        $this->form->setValidator('parentId', new sfValidatorString(array('required' => true)));
        $this->form->setWidget('parentId', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'description':
        $this->form->setDefault($name, $this->menu[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;
    }
  }

  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'parentId':

        if (null == $this->menu['parentId'] = $this->form->getValue('parentId'))
        {
          $this->menu['parentId'] = QubitMenu::ROOT_ID;
        }

        break;

      default:
        $this->menu[$field->getName()] = $this->form->getValue($field->getName());
    }
  }

  public function processForm()
  {
    foreach ($this->form as $field)
    {
      if (isset($this->request[$field->getName()]))
      {
        $this->processField($field);
      }
    }

    return $this;
  }

  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->menu = new QubitMenu;

    if (isset($request->id))
    {
      $this->menu = QubitMenu::getById($request->id);

      if (!isset($this->menu))
      {
        $this->forward404();
      }
    }

    foreach ($this::$NAMES as $name)
    {
      $this->addField($name);
    }

    // Handle POST data (form submit)
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        $this->menu->save();

        // Remove cache
        if ($this->context->getViewCacheManager() !== null)
        {
          $this->context->getViewCacheManager()->remove('@sf_cache_partial?module=menu&action=_browseMenu&sf_cache_key=settings');
          $this->context->getViewCacheManager()->remove('@sf_cache_partial?module=menu&action=_mainMenu&sf_cache_key=settings');
        }

        $this->redirect(array('module' => 'menu', 'action' => 'list'));
      }
    }

    QubitDescription::addAssets($this->response);
  }
}
