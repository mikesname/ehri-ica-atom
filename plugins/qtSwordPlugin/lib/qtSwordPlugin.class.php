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

class qtSwordPlugin
{
  public static function saveRequestContent()
  {
    $filename = tempnam('/tmp', 'php_qubit_');

    $file = fopen($filename, 'w');
    $source = fopen("php://input", 'r');

    while ($kb = fread($source, 1024))
    {
      fwrite($file, $kb, 1024);
    }

    fclose($file);
    fclose($source);

    return $filename;
  }
}
