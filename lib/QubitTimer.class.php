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

class QubitTimer
{
  public
    $fh = null,
    $startTime = 0;

  public function __construct($logFile = null)
  {
    $this->restart();

    if (null != $logFile)
    {
      $this->fh = fopen($logFile, 'w');
    }
  }

  public function restart()
  {
    $this->startTime = microtime(true);
  }

  public function elapsed($rnd = 2)
  {
    return round((microtime(true) - $this->startTime), $rnd);
  }

  public function log($string)
  {
    if (!isset($this->fh))
    {
      return;
    }

    fwrite($this->fh, $string.' ('.$this->elapsed()."s)\n");
  }

  public function __destruct()
  {
    if (isset($this->fh))
    {
      fclose($this->fh);
    }
  }
}
