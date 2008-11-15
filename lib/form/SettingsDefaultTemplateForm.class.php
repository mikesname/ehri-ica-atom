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
  // Available templates
  protected static $informationObjectTemplates = array(
    'isad' => 'ISAD(G), International Council on Archives',
    'rad' => 'RAD, Canadian Council of Archives'
  );

  protected static $actorTemplates = array(
    'isaar' => 'ISAAR(CPF), International Council on Archives'
  );

  protected static $repositoryTemplates = array(
    'isdiah' => 'ISDIAH, International Council on Archives'
  );

  public function configure()
  {
    // Build widgets
    $this->setWidgets(array(
    'informationobject' => new sfWidgetFormSelect(array('choices'=>self::$informationObjectTemplates)),
    'actor' => new sfWidgetFormSelect(array('choices'=>self::$actorTemplates)),
    'repository' => new sfWidgetFormSelect(array('choices'=>self::$repositoryTemplates)),
    ));

    // Add labels
    $this->widgetSchema->setLabels(array(
    'informationobject' => 'information object',
    'actor' => 'actor',
    'repository' => 'repository'
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