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
 * Settings module - generic form definition
 * 
 * @package    qubit
 * @subpackage settings
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class SettingsGenericForm extends sfForm
{
  public function configure()
  {
    // Build widgets and validators
    foreach($this->getSettings() as $setting) {
      $widgets[$setting->getName()] = new sfWidgetFormInput;
      $validators[$setting->getName()] = new sfValidatorString(array('required'=>$this->areFieldsRequired()));
    }
    
    // Set them
    $this->setWidgets($widgets);
    $this->setValidators($validators);
    
    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');
    
    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat($this->getOption('scope').'[%s]');
  }
  
  public function setScope($scope)
  {
    $this->setOption('scope', $scope);
    
    return $this;
  }
  
  public function getScope()
  {
    return $this->getOption('scope');
  }
  
  public function setSettings(array $settings)
  {
    $this->setOption('settings', $settings);
    
    return $this;
  }
  
  public function getSettings()
  {
    return $this->getOption('settings');
  }
  
  public function areFieldsRequired()
  {
    return !(isset($this->options['fieldsRequired']) && $this->options['fieldsRequired'] === false);
  }
  
}