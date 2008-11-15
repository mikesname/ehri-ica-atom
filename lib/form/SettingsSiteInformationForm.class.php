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
class SettingsSiteInformationForm extends sfForm
{ 
  public function configure()
  {
    // Build widgets
    $this->setWidgets(array(
      'site_title' => new sfWidgetFormInput,
      'site_description' => new sfWidgetFormInput
    ));
    
    // Add labels
    $this->widgetSchema->setLabels(array(
      'site_title' => 'site title',
      'site_description' => 'site description'
    ));
    
    // Add helper text 
    // NOTE: This is implemented in the template because it was too much 
    // trouble to integrate the helper text without rendering the whole form
    // row due to the lack of a renderHelp() method in sfFormField.class.php
    //
    // $this->widgetSchema->setHelps();
    
    // Validators
    $this->validatorSchema['site_title'] = new sfValidatorString(array('required'=>false));
    $this->validatorSchema['site_description'] = new sfValidatorString(array('required'=>false));
    
    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');
    
    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat('site_information[%s]');
  }
}