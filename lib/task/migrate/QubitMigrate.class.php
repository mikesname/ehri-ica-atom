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
 * Base class for migrating qubit data
 *
 * @package    qubit
 * @subpackage migration
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com
 */
class QubitMigrate
{
  protected $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  /**
   * Do migration of data
   *
   * @return array modified data
   */
  public function execute()
  {
    $this->alterData();
    $this->sortData();

    return $this->getData();
  }

  /**
   * Getter for migration data
   *
   * @return array arrayized yaml data
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   * Wrapper for findRowKeyForColumnValue() method.
   *
   * @param string $className
   * @param string $searchColumn
   * @param string $searchKey
   * @return string key for matched row
   */
  protected function getRowKey($className, $searchColumn, $searchKey)
  {
    return self::findRowKeyForColumnValue($this->data[$className], $searchColumn, $searchKey);
  }

  /**
   * Convienience method for grabbing a QubitTerm row key based on the value of
   * the 'id' column
   *
   * @param string $searchKey
   * @return string key for matched row
   */
  protected function getTermKey($searchKey)
  {
    return $this->getRowKey('QubitTerm', 'id', $searchKey);
  }

  /**
   *
   * @return unknown_type
   */
  protected function deleteStubObjects()
  {
    // Delete "stub" QubitEvent objects that have no valid "event type"
    if (isset($this->data['QubitEvent']) && is_array($this->data['QubitEvent']))
    {
      foreach ($this->data['QubitEvent'] as $key => $event)
      {
        if (!isset($event['type_id']))
        {
          unset($this->data['QubitEvent'][$key]);

          // Also delete related QubitObjectTermRelation object (if any)
          while ($objectTermRelationKey = $this->getRowKey('QubitObjectTermRelation', 'object_id', $key))
          {
            unset($this->data['QubitObjectTermRelation'][$objectTermRelationKey]);
          }
        }
      }
    }

    // If there are no QubitEvent objects left, remove the section
    if ($this->data['QubitEvent'] == array())
    {
      unset($this->data['QubitEvent']);
    }

    // Remove blank "stub" QubitObjectTermRelation objects
    if (isset($this->data['QubitObjectTermRelation']) && is_array($this->data['QubitObjectTermRelation']))
    {
      foreach ($this->data['QubitObjectTermRelation'] as $key => $row)
      {
        if (!isset($row['object_id']) || !isset($row['term_id']))
        {
          unset($this->data['QubitObjectTermRelation'][$key]);
        }
      }
    }

    // If there are no QubitObjectTermRelation objects left, remove the section
    if ($this->data['QubitObjectTermRelation'] == array())
    {
      unset($this->data['QubitObjectTermRelation']);
    }

    // Remove blank "stub" QubitRelation objects
    if (isset($this->data['QubitRelation']) && is_array($this->data['QubitRelation']))
    {
      foreach ($this->data['QubitRelation'] as $key => $row)
      {
        if (!isset($row['object_id']) || !isset($row['subject_id']))
        {
          unset($this->data['QubitRelation'][$key]);
        }
      }
    }

    // If there are no QubitRelation objects left, remove the section
    if ($this->data['QubitRelation'] == array())
    {
      unset($this->data['QubitRelation']);
    }

    return $this;
  }

  /*
   * ------------------
   * STATIC METHODS
   * ------------------
   */

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
    $first_array = array_splice($array, 0, $position);
    $array = array_merge($first_array, $insert_array, $array);
  }

  /**
   * Insert a non-hierarchical $newData into an existing dataset ($originalData),
   * which contains nested set columns (but is also non-hierarchical in
   * structure), before the row specified by $pivotKey.  Update lft and rgt
   * values appropriately.
   *
   * @param array $originalData The existing YAML dataset array
   * @param string $pivotKey key of row that should follow the inserted data
   * @param array $newData data to insert in $originalData
   */
  protected static function insertBeforeNestedSet(array &$originalData, $pivotKey, array $newData)
  {
    // If pivotKey doesn't exist, then just return a simple array merge
    if (!isset($originalData[$pivotKey]))
    {

      return array_merge($originalData, $newData);
    }

    $pivotIndex = null;
    $pivotLft = null;
    $width = count($newData) * 2;

    // Get index ($i) of pivot row and it's left value (if any)
    $i = 0;
    foreach ($originalData as $key => $row)
    {
      if ($pivotKey == $key)
      {
        $pivotIndex = $i;
        if (isset($originalData[$key]['lft']))
        {
          $pivotLft = $originalData[$key]['lft'];
        }
        break;
      }
      $i++;
    }

    // If a left value was found, then set merged values for lft & rgt columns
    if (null !== $pivotIndex)
    {
      // Loop through $newData and assign lft & rgt values
      $j = 0;
      foreach ($newData as &$row)
      {
        $row['lft'] = $pivotLft + ($j * 2);
        $row['rgt'] = $pivotLft + ($j * 2) + 1;
        $j++;
      }

      // Bump existing lft & rgt values
      foreach ($originalData as &$row)
      {
        if ($pivotLft <= $row['lft'])
        {
          $row['lft'] += $width;
        }

        if ($pivotLft < $row['rgt'])
        {
          $row['rgt'] += $width;
        }
      }
    }

    // Merge $newData into $originalData
    QubitMigrate::array_insert($originalData, $i, $newData);
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

  /**
   * Sort the given objectList by left value
   *
   * @param $objectList array of data objects
   */
  public static function sortByLft(&$objectList)
  {
    $newList = array();
    $highLft = 0;
    foreach ($objectList as $key => $row)
    {
      // If this left value is higher than any previous value, or there is no
      // left value, then add the current row to the end of $newList
      if (false === isset($row['lft']) || $row['lft'] > $highLft)
      {
        $newList[$key] = $row;
        $highLft = (isset($row['lft'])) ? $row['lft'] : $highLft;
      }

      // Else, find the right place in $newList to insert the current row
      // (sorted by lft values)
      else
      {
        $i = 0;
        foreach ($newList as $newKey => $newRow)
        {
          if ($newRow['lft'] > $row['lft'])
          {
            self::array_insert($newList, $i, array($key => $row));
            break;
          }
          $i++;
        }
      }
    }

    $objectList = $newList;
  }

  /**
   * Recursively delete a hierarchical data tree
   *
   * @param $objectList array full dataset
   * @param $deleteObjectKey string key of array object to delete
   * @return void
   */
  public static function cascadeDelete($objectList, $deleteObjectKey)
  {
    $deleteObjectId = null;
    if (isset($objectList[$deleteObjectKey]['id']))
    {
      $deleteObjectId = $objectList[$deleteObjectKey]['id'];
    }

    foreach ($objectList as $key => $row)
    {
      if ($deleteObjectKey == $row['parent_id'] || (null !== $deleteObjectId && $deleteObjectId == $row['parent_id']))
      {
        $objectList = self::cascadeDelete($objectList, $key);
      }
    }

    unset($objectList[$deleteObjectKey]);

    return $objectList;
  }
}
