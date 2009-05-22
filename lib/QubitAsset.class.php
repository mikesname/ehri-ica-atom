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
 * Simple representation of an asset
 *
 * @package    Qubit
 * @subpackage libraries
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class QubitAsset
{
  private
    $name,
    $contents;

  public function __construct($pName, $pContents)
  {
    $this->name = $pName;
    $this->contents = $pContents;
  }

  public function setName($value)
  {
    $this->name = $value;

    return $this;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setContents($value)
  {
    $this->contents = $value;

    return $this;
  }

  public function getContents()
  {
    return $this->contents;
  }
}