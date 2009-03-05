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
 * Settings update controller.
 * 
 * @package    qubit
 * @subpackage settings
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class SettingsUpdateAction extends sfAction
{
  public function execute($request)
  {
    // determine what we are updating based on the request vars
    if ($this->getRequestParameter('new_setting_name') && $this->getRequestParameter('new_setting_value'))
    {
      // we are adding a new setting
      $setting = new QubitSetting;
      $setting->setName($this->getRequestParameter('new_setting_name'));
      $setting->setScope($this->getRequestParameter('fieldset'));
      $setting->setEditable(true);
      $setting->setDeleteable(true);
      $setting->setValue($this->getRequestParameter('new_setting_value'));

      $setting->save();
    }
    else if ($this->getRequestParameter('language_code'))
    {
      // we are adding a new language
      sfLoader::loadHelpers(array('I18N'));

      $setting = new QubitSetting;
      $setting->setName($this->getRequestParameter('language_code'));
      $setting->setScope('i18n_languages');
      $setting->setEditable(true);
      $setting->setDeleteable(true);
      $setting->setValue($this->getRequestParameter('language_code'));
      $setting->getCurrentSettingI18n()->setCulture('en');
      $setting->setSourceCulture('en');

      $setting->save();

      // go directly back, do not update anything else
      $this->refreshSettings();
      return $this->redirect('settings/list');
    }

    // update any existing values
    $parameters = $this->getRequest()->getParameterHolder()->getAll();

    foreach ($parameters as $parameter => $value)
    {
      if (is_numeric($parameter))
      {
        $setting = QubitSetting::getById($parameter);
        $this->forward404Unless($setting);

        if ($setting->isEditable())
        {
          $setting->setValue($value);
          $setting->save();
        }
      }
    }

    $this->refreshSettings();
    return $this->redirect('settings/list');
  }

  private function refreshSettings()
  {
    // clear the file cache containing the settings
    $fileCache = new sfFileCache(array('cache_dir' => sfConfig::get('sf_app_cache_dir').'/settings'));
    $fileCache->clean();
  }
}