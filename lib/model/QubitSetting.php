<?php

/**
 * Subclass for representing a row from the 'setting' table.
 *
 *
 *
 * @package lib.model
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

  // retrieves values for all settings in the database, with full i18n fallback
  public static function getSettingsArray()
  {
    // load all settings from the settings table
    $settings = array();
    foreach (QubitSetting::getAll() as $QubitSetting)
    {
      if ($QubitSetting->getScope())
      {
        $key =  'app_'.$QubitSetting->getScope().'_'.$QubitSetting->getName();
      }
      else
      {
        $key = 'app_'.$QubitSetting->getName();
      }

      $settings[$key] = $QubitSetting->getValue();
    }

    return $settings;
  }

  public function getValue(array $options = array())
  {
    // get value based on i18n fallback criteria
    if ($value = $this->getCurrentSettingI18n($options)->getValue())
    {
      return $value;
    }
    else if ($value = $this->getCurrentSettingI18n(array('culture' => sfConfig::get('sf_default_culture')))->getValue())
    {
      return $value;
    }
    else if ($value = $this->getCurrentSettingI18n(array('sourceCulture' => true))->getValue())
    {
      return $value;
    }
    else
    {
      // get whatever value exists for this setting, regardless of locale
      $criteria = new Criteria;
      $criteria->add(QubitSettingI18n::ID, $this->getId());

      if ($setting = QubitSettingI18n::getOne($criteria))
      {
        return $setting->getValue();
      }
    }
  }

  public function getCulture(array $options = array())
  {
    // get culture based on i18n fallback criteria
    if ($settingI18n = QubitSettingI18n::getByIdAndCulture($this->getId(), sfContext::getInstance()->getUser()->getCulture()))
    {
      return $settingI18n->getCulture();
    }
  }
}
