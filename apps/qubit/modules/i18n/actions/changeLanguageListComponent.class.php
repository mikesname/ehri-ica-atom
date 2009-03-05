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

class I18nChangeLanguageListComponent extends sfComponent
{
  public function execute($request)
  {
    // loop through application settings and extract enabled i18n languages
    $enabledI18nLanguages = array();
    foreach (sfConfig::getAll() as $setting => $value)
    {
      if (0 === strpos($setting, 'app_i18n_languages'))
      {
        $enabledI18nLanguages[$value] = format_language($value, $value);
      }
    }

    /*
    // don't include the current locale language in list
    foreach ($enabledI18nLanguages as $key => $language)
    {
      if ($key == $this->getUser()->getCulture())
      {
        unset($enabledI18nLanguages[$key]);
        break;
      }
    }
    */

    // sort languages by alpha code to look pretty
    ksort($enabledI18nLanguages);

    $this->enabledI18nLanguages = $enabledI18nLanguages;
  }
}
