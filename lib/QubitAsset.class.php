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
    $this->generateChecksum('sha256');
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

  public function generateChecksum($algorithm)
  {
    if (!in_array($algorithm, hash_algos()))
    {
      throw new Exception('Invalid checksum algorithm');
    }

    $this->checksum = hash($algorithm, $this->contents);
    $this->checksumAlgorithm = $algorithm;

    return $this->checksum;
  }
}
