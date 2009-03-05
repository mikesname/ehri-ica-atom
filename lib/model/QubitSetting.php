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
 * Extend BaseSetting functionality.
 *
 * @package    qubit
 * @subpackage model
 * @version    svn: $Id$
 * @author     MJ Suhonos
 * @author     Jack Bates <jack@artefactual.com>
 */
class QubitSetting extends BaseSetting
{
  // wrapper convenience methods
  public function isEditable()
  {
    return $this->editable;
  }

  public function isDeleteable()
  {
    return $this->deleteable;
  }

  /**
   * Get all values from QubitSetting table, in appropriate culture, in
   * sfConfig array format.
   *
   * @return array name/value pairs formatted for addition to sfConfig array.
   */
  public static function getSettingsArray()
  {
    // load all settings from the settings table
    $settings = array();
    foreach (QubitSetting::getAll() as $qubitSetting)
    {
      if ($qubitSetting->getScope())
      {
        $key = 'app_'.$qubitSetting->getScope().'_'.$qubitSetting->getName();
      }
      else
      {
        $key = 'app_'.$qubitSetting->getName();
      }

      // Determine appropriate culture for return value
      switch ($qubitSetting->getScope())
      {
        // Localized values
        case 'ui_label':
        case 'site_information':
          $settings[$key] = $qubitSetting->getValue(array('cultureFallback' => true));
          break;
        // non-localized values (default)
        default:
          $settings[$key] = $qubitSetting->getValue(array('sourceCulture' => true));
      }
    }

    return $settings;
  }

  public function getCulture(array $options = array())
  {
    // get culture based on i18n fallback criteria
    if ($settingI18n = QubitSettingI18n::getByIdAndCulture($this->getId(), sfContext::getInstance()->getUser()->getCulture()))
    {
      return $settingI18n->getCulture();
    }
  }

  /**
   * Return the source culture value for this setting, when current context is
   * not the source culture.  This is used on edit forms to show the source
   * culture value for a field as an aid for tranlslation.
   *
   * @param string $culture current culture context
   * @return string source culture value for field
   */
  public function getSourceCultureHelper($culture)
  {
    if (strlen($sourceCultureValue = $this->getValue(array('sourceCulture' => true))) > 0 && $culture != $this->getSourceCulture())
    {

      return $sourceCultureValue;
    }

    return null;
  }

  /**
   * Get all system settings that are "non-global" (scope <> NULL) and not
   * "site information" settings
   *
   * @return QubitQuery collection of QubitSetting objects.
   */
  static public function getLocalSettings()
  {
    $criteria = new Criteria;
    $criteria->add(QubitSetting::SCOPE, null, Criteria::ISNOTNULL);
    $criteria->add(QubitSetting::SCOPE, 'site_information', Criteria::NOT_EQUAL);

    return QubitSetting::get($criteria);
  }

  /**
   * Get all settings matching $scope parameter.
   *
   * @param string $scope
   */
  static public function getByScope($scope = null)
  {
    $criteria = new Criteria;
    if (null !== $scope)
    {
      $criteria->add(QubitSetting::SCOPE, $scope, Criteria::EQUAL);
    }
    else
    {
      $criteria->add(QubitSetting::SCOPE, null, Criteria::ISNULL);
    }

    return QubitSetting::get($criteria);
  }

  /**
   * Get a setting by it's name
   *
   * @return QubitSetting object.
   */
  static public function getSettingByName($name)
  {
    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, $name, Criteria::EQUAL);

    return QubitSetting::getOne($criteria);
  }

  /**
   * Get a setting by it's name & scope
   *
   * @return QubitSetting object.
   */
  static public function getByNameAndScope($name, $scope)
  {
    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, $name, Criteria::EQUAL);
    $criteria->add(QubitSetting::SCOPE, $scope, Criteria::EQUAL);

    return QubitSetting::getOne($criteria);
  }

  /**
   * Find a setting, and save a new value to it
   *
   * @return QubitSetting object.
   */
  static public function findAndSave($name, $value, $options)
  {
    // Search for existing setting by name (optionally, scope)
    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, $name);

    if (isset($options['scope']))
    {
      $criteria->add(QubitSetting::SCOPE, $options['scope']);
    }

    // If setting doesn't already exist, create a new one if
    // $options['createNew'] is true
    if (null === ($setting = QubitSetting::getOne($criteria)) && $options['createNew'] === true)
    {
      $setting = new QubitSetting;
      $setting->setName($name);

      if (isset($options['scope']))
      {
        $setting->setScope($options['scope']);
      }
    }

    // Set value and save setting
    if (null !== $setting)
    {
      $setting->setValue($value, $options);
      $setting->save();
    }

    return $setting;
  }

  /**
   * Create a new setting object with some default properties
   *
   * @param string $name object name
   * @param string $value object value
   * @param array  $options array of options
   */
  static public function createNewSetting($name, $value, $options = array())
  {
    $setting = new QubitSetting;
    $setting->setName($name);
    $setting->setValue($value);

    if (isset($options['scope']))
    {
      $setting->setScope($options['scope']);
    }

    // Default "editable" to true, unless forced to false
    $setting->setEditable(1);
    if (isset($options['editable']) && $options['editable'] == false)
    {
      $setting->setEditable(0);
    }

    // Default "deleteable" to true, unless forced to false
    $setting->setDeleteable(1);
    if (isset($options['deleteable']) && $options['deleteable'] == false)
    {
      $setting->setDeleteable(0);
    }

    // Set the source culture option
    if (isset($options['sourceCulture']))
    {
      $setting->setSourceCulture($options['sourceCulture']);
    }

    // Set the culture option
    if (isset($options['culture']))
    {
      $setting->setCulture($options['culture']);
    }

    return $setting;
  }
}