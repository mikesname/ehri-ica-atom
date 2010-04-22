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

sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');

/**
 * Settings module - "site information" form definition
 *
 * @package    qubit
 * @subpackage settings
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class SettingsDefaultTemplateForm extends sfForm
{
  public function configure()
  {
    // Available templates
    $informationObjectTemplates = array(
      'isad' => __('ISAD(G), 2nd ed. International Council on Archives'),
      'dc' => __('Dublin Core, Version 1.1. Dublin Core Metadata Initiative'),
      'mods' => __('MODS, Version 3.3. U.S. Library of Congress'),
      'rad' => __('RAD, July 2008 version. Canadian Council of Archives'),
    );

    $actorTemplates = array(
      'isaar' => __('ISAAR(CPF), 2nd ed. International Council on Archives')
    );

    $repositoryTemplates = array(
      'isdiah' => __('ISDIAH, 1st ed. International Council on Archives')
    );

    // Build widgets
    $this->setWidgets(array(
      'informationobject' => new sfWidgetFormSelect(array('choices'=>$informationObjectTemplates)),
      'actor' => new sfWidgetFormSelect(array('choices'=>$actorTemplates)),
      'repository' => new sfWidgetFormSelect(array('choices'=>$repositoryTemplates)),
    ));

    // Add labels
    $this->widgetSchema->setLabels(array(
      'informationobject' => sfConfig::get('app_ui_label_informationobject'),
      'actor' => sfConfig::get('app_ui_label_actor'),
      'repository' => sfConfig::get('app_ui_label_repository')
    ));

    // Add helper text
    // NOTE: This is implemented in the template because it was too much
    // trouble to integrate the helper text without rendering the whole form
    // row due to the lack of a renderHelp() method in sfFormField.class.php
    //
    // $this->widgetSchema->setHelps();

    // Validators
    $this->validatorSchema['informationobject'] = new sfValidatorString;
    $this->validatorSchema['actor'] = new sfValidatorString;
    $this->validatorSchema['repository'] = new sfValidatorString;

    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');

    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat('default_template[%s]');
  }
}
