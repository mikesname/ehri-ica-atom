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
           $enabledI18nLanguages[substr($setting, 19)] = $value;
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
