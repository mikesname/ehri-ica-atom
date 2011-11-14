<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class QubitAccession extends BaseAccession
{
  public function __toString()
  {
    return (string) $this->identifier;
  }

  protected function insert($connection = null)
  {
    $this->identifier = self::generateAccessionIdentifier(true);

    if (!isset($this->slug))
    {
      $this->slug = QubitSlug::slugify($this->__get('identifier', array('sourceCulture' => true)));
    }

    parent::insert($connection);
  }

  public static function getAccessionNumber($incrementCounter)
  {
    $setting = QubitSetting::getSettingByName('accession_counter');

    if ($incrementCounter)
    {
      $setting->value = $setting->getValue(array('sourceCulture' => true)) + 1;
      $setting->save();

      return $setting->getValue(array('sourceCulture' => true));
    }

    return $setting->getValue(array('sourceCulture' => true)) + 1;
  }

  public static function generateAccessionIdentifier($incrementCounter = false)
  {
    return preg_replace_callback('/([#%])([A-z]+)/', function($match) use ($incrementCounter)
    {
      if ('%' == $match[1])
      {
        return strftime('%'.$match[2]);
      }
      else if ('#' == $match[1])
      {
        if (0 < preg_match('/^i+$/', $match[2], $matches))
        {
          $pad = strlen($matches[0]);
          $number = QubitAccession::getAccessionNumber($incrementCounter);

          return str_pad($number, $pad, 0, STR_PAD_LEFT);
          // return sprintf('%0' . $pad . 'd', $number);
        }
        else
        {
          return $match[2];
        }
      }
    }, sfConfig::get('app_accession_mask'));
  }
}
