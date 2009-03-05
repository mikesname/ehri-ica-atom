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

class SettingsDeleteAction extends sfAction
{
  public function execute($request)
  {
    $setting = QubitSetting::getById($this->getRequestParameter('id'));

    $this->forward404Unless($setting);

    // check that the setting is deleteable
    if ($setting->isDeleteable())
    {
      $setting->delete();
    }
    // TODO: else populate an error?

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
