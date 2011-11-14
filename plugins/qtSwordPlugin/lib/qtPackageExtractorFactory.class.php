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

class qtPackageExtractorFactory
{
  public static function build($type, array $options = array())
  {
    preg_match_all('/^.*\/(.*)\/*$/', $type, $matches);

    if (isset($matches[1]))
    {
      $className = 'qtPackageExtractor'.$matches[1][0];

      if (!class_exists($className))
      {
        throw new Exception('Missing format class.');
      }
    }
    else
    {
      throw new Exception('Format not recognized.');
    }

    return new $className($options);
  }
}
