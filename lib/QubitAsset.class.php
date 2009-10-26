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
  protected
    $name,
    $contents,
    $checksum,
    $checksumAlgorithm;

  public function __construct($assetName, $assetContents, $options = array())
  {
    $this->name = $assetName;
    $this->contents = $assetContents;

    if (isset($options['checksumAlgorithm']))
    {
      $this->setChecksumAlgorithm($options['checksumAlgorithm']);
    }

    // Only allow user to set checksum if an algorithm is specified
    if (isset($options['checksum']) && isset($this->checksumAlgorithm))
    {
      $this->checksum = $options['checksum'];
    }
    else
    {
      $this->generateChecksum();
    }
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

  public function setChecksum($value, $options)
  {
    if (isset($options['algorithm']))
    {
      $this->setChecksumAlgorithm($options['algorithm']);
    }

    if (0 < strlen($value) && !isset($this->checksumAlgorithm))
    {
      throw new Exception('You cannot set a checksum without specifiying an algorithm.');
    }

    $this->checksum = $value;

    return $this;
  }

  public function setChecksumAlgorithm($value)
  {
    $this->checksumAlgorithm = $value;

    return $this;
  }

  public function getChecksum()
  {
    return $this->checksum;
  }

  public function getChecksumAlgorithm()
  {
    return $this->checksumAlgorithm;
  }

  public function generateChecksum()
  {
    switch($this->checksumAlgorithm)
    {
      case 'sha1':
        $this->checksum = sha1($this->contents);
        break;
      case 'md5':
      default:
        $this->checksum = md5($this->contents);
        $this->checksumAlgorithm = 'md5';
    }
  }
}
