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

sfLoader::loadHelpers('I18N');

/**
 * Global form & validation definition for editing menus
 *
 * @package    qubit
 * @subpackage settings
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class MenuEditForm extends sfForm
{
  public function configure()
  {
    // Get menuTree array with menu depths
    $menuTree = QubitMenu::getTreeById(QubitMenu::ROOT_ID);

    // Build an array of choices for "parentId" select box (with blank line)
    $parentChoices[1] = '[ '.strtoupper(__('top')).' ]';
    foreach ($menuTree as $menu)
    {
      $parentChoices[$menu['id']] = str_repeat('-', $menu['depth']).' '.$menu['name'];
    }

    // Build widgets
    $this->setWidgets(array(
      'name'  => new sfWidgetFormInput,
      'label' => new sfWidgetFormInput,
      'path'   => new sfWidgetFormInput,
      'description' => new sfWidgetFormTextarea(array(), array('rows' => '3')),
      'parentId' => new sfWidgetFormSelect(array('choices' => $parentChoices))
    ));

    // Set labels
    $this->widgetSchema->setLabel('name', __('name'));
    $this->widgetSchema->setLabel('label', __('label'));
    $this->widgetSchema->setLabel('path', __('path'));
    $this->widgetSchema->setLabel('description', __('description'));
    $this->widgetSchema->setLabel('parentId', __('parent menu'));

    // Set validators
    $this->validatorSchema['name'] = new sfValidatorString(
      array('required' => true), array('required' => __('The menu must have a name'))
    );

    // Validators for non-required fields
    $this->validatorSchema['label'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['path'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['description'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['parentId'] = new sfValidatorInteger(array('required' => true));

    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterDetail($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');

    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat('menu[%s]');
  }
}