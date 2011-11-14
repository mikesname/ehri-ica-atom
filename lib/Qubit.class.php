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

class Qubit
{
  public static function pathInfo($url)
  {
    // Other options to get path info from URL include parse_url() or building
    // an exact regex from the BNF in RFC 1738.  Note however that our only
    // goal is to get path info from valid URL, which the following simple
    // regex should accomplish.  Slash characters don't occur in the scheme,
    // user, password, host, or port component of valid URL
    return preg_replace('/^(?:[^:]+:\/\/[^\/]+)?'.preg_quote(sfContext::getInstance()->request->getPathInfoPrefix(), '/').'/', null, $url);
  }

  // Alternative to format_date() symfony helper
  //
  // format_date() is consistent with e.g. format_country() and supports many
  // different date formats, e.g. W3C for EAC, but doesn't support zero day or
  // zero month
  //
  // Qubit::renderDate() currently supports only one date format, but does
  // support zero day or zero month
  public static function renderDate($value)
  {
    // Natural number, trim leading zeros
    $natural = '0*([1-9]\d*)';

    // Zero and separator, trim leading zeros
    $zero = '0*(0[-\/])';

    // Trim trailing separator and zero
    $trim = '[-\/]0+';

    // Trim leading zeros from year, month, and day, and trailing zero day and
    // month
    $pattern = "/0*(\d+)(?:([-\/])$natural(?:([-\/])$natural
          |$trim)
        |([-\/])$zero$natural
        |$trim$trim)/x";

    $replacement = '$1$2$3$4$5$6$7$8';

    return preg_replace($pattern, $replacement, $value);
  }

  public static function renderDateStartEnd($date, $start, $end)
  {
    if (isset($date))
    {
      return $date;
    }

    if (isset($start) || isset($end))
    {
      $start = Qubit::renderDate($start);
      $end = Qubit::renderDate($end);

      if ($end == $start)
      {
        return $start;
      }

      return "$start - $end";
    }
  }

  public static function saveTemporaryFile($name, $contents)
  {
    // Set temporary directory path
    $tmpDir = sfConfig::get('sf_upload_dir').'/tmp';

    // Create temporary directory unless exists
    if (!is_writable($tmpDir))
    {
      mkdir($tmpDir);
      chmod($tmpDir, 0775);
    }

    $pathInfo = pathinfo($name);
    $extension = $pathInfo['extension'];

    // Get a unique file name (to avoid clashing file names)
    $tmpFileName = null;
    while (file_exists($tmpFileName) || null == $tmpFileName)
    {
      $uniqueString = substr(md5(time()), 0, 8);
      $tmpFileName = $tmpDir.'/TMP'.$uniqueString.'.'.$extension;
    }

    return false != file_put_contents($tmpFileName, $contents) ? $tmpFileName : false;
  }
}
