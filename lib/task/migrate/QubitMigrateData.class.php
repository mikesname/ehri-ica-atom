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
 * Abstract class defining inteface for upgrading the Qubit data model
 *
 * @package    qubit
 * @subpackage migration
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class QubitMigrateData
{
  protected $data = null;
  protected $dataModified = false;

  public function __construct($data)
  {
    $this->setData($data);
  }

  public function setData($data)
  {
    $this->data = $data;

    return $this;
  }

  public function getData()
  {
    return $this->data;
  }

  public function isDataModified()
  {
    return $this->dataModified;
  }

  public function migrate103to104()
  {
    $migrator = new QubitMigrate103to104($this->data);
    $this->data = $migrator->execute();
    $this->dataModified = true;

    return $this;
  }

  public function migrate104to105()
  {
    $migrator = new QubitMigrate104to105($this->data);
    $this->data = $migrator->execute();
    $this->dataModified = true;

    return $this;
  }

  /**
   * Loop through row searching for $searchColumn value = $searchValue.
   * Return row key for first matched object.
   *
   * @param string $searchRow row array to search
   * @param string $searchColumn Name of column to check for $searchValue
   * @param mixed  $searchValue Value to find - can be string or array
   * @return array row key
   */
  public static function findRowKeyForColumnValue($searchRow, $searchColumn, $searchValue)
  {
    foreach ($searchRow as $key => $columns)
    {
      if (is_array($searchValue))
      {
        // Try and match key/value pair passed in searchValue (e.g. the english
        // value for an i18n column)
        $searchKey = key($searchValue);

        if (isset($columns[$searchColumn]) && $columns[$searchColumn][$searchKey] == $searchValue[$searchKey])
        {
          
          return $key;
        }
      }
      else if (isset($columns[$searchColumn]) && $columns[$searchColumn] == $searchValue)
      {

        return $key;
      }
    }

    return false;
  }

  /**
   * Splice two associative arrays.
   *
   * From http://ca3.php.net/manual/en/function.array-splice.php
   * @author weikard at gmx dot de (15-Sep-2005 08:53)
   *
   * @param array $array Primary array
   * @param integer $position insert index
   * @param array $insert_array spliced array
   */
  public static function array_insert(&$array, $position, $insert_array)
  {
    $first_array = array_splice ($array, 0, $position);
    $array = array_merge ($first_array, $insert_array, $array);
  }

  /**
   * Get the index for a given key of an associative array
   *
   * @param array  $arr array to search
   * @param string $findKey key to search for
   * @return mixed integer on success, false (bool) if key does not exist
   */
  public static function getArrayKeyIndex($arr, $findKey)
  {
    $index = 0;
    foreach ($arr as $key => $value)
    {
      if ($key == $findKey)
      {
        return $index;
      }
      $index++;
    }

    return false;
  }
}