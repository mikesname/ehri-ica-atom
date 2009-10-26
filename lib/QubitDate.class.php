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
 * @package    qubit
 * @subpackage date
 * @author     David Juhasz <david@artefactual.com>
 * @version    $Id$
 */
class QubitDate
{
  /**
   * Make date compliant with ISO-8601 standard, using '00' replacing unknown
   * month/day
   *
   * @param string $date original, suspect date
   * @return string ISO-8601 compliant date (null if can't standardize)
   */
  public static function standardize($date)
  {
    $isoDate = null;

    if (preg_match('|(\d{4})[-/]?(\d{2})?[-/]?(\d{2})?|', $date, $matches))
    {
      if (2 == count($matches))
      {
        $isoDate = $matches[1].'-00-00';
      }
      // Make sure month is between 0 and 12
      else if (3 == count($matches) && 13 > $matches[2])
      {
        $isoDate = $matches[1].'-'.$matches[2].'-00';
      }
      // Validate date (No Feb. 30th)
      else if (4 == count($matches) && checkdate($matches[2], $matches[3], $matches[1]))
      {
        $isoDate = implode('-', array_splice($matches, 1));
      }

      return $isoDate;
    }
  }
}
