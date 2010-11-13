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

class ArraySort
{
  //TO DO: Make one generic up & down sorter for all arrays to use rather than splitting them up by array and key type

  public static function countrySortUp($repositories)
    {
    function sortUp($a, $b)
      {
      if ( $a['country'] == $b['country'] )
        return 0;
      if ( $a['country'] < $b['country'] )
         return -1;
      return 1;
      }

    uasort($repositories, 'sortUp');

    return $repositories;
    }

    public static function countrySortDown($repositories)
    {
    function sortDown($a, $b)
      {
      if ( $a['country'] == $b['country'] )
        return 0;
      if ( $a['country'] > $b['country'] )
         return -1;
      return 1;
      }

    uasort($repositories, 'sortDown');

    return $repositories;
    }

    public static function repositoryTypeSortUp($repositories)
    {
    function sortUp($a, $b)
      {
      if ( $a['type'] == $b['type'] )
        return 0;
      if ( $a['type'] < $b['type'] )
         return -1;
      return 1;
      }

    uasort($repositories, 'sortUp');

    return $repositories;
    }

    public static function repositoryTypeSortDown($repositories)
    {
    function sortDown($a, $b)
      {
      if ( $a['type'] == $b['type'] )
        return 0;
      if ( $a['type'] > $b['type'] )
         return -1;
      return 1;
      }

    uasort($repositories, 'sortDown');

    return $repositories;
    }

        public static function repositorySortUp($informationObjects)
    {
    function sortUp($a, $b)
      {
      if ( $a['repository'] == $b['repository'] )
        return 0;
      if ( $a['repository'] < $b['repository'] )
         return -1;
      return 1;
      }

    uasort($informationObjects, 'sortUp');

    return $informationObjects;
    }

    public static function repositorySortDown($informationObjects)
    {
    function sortDown($a, $b)
      {
      if ( $a['repository'] == $b['repository'] )
        return 0;
      if ( $a['repository'] > $b['repository'] )
         return -1;
      return 1;
      }

    uasort($informationObjects, 'sortDown');

    return $informationObjects;
    }

    public static function termHitsSortUp($terms)
    {
    function sortUp($a, $b)
      {
      if ( $a['type'] == $b['type'] )
        return 0;
      if ( $a['type'] < $b['type'] )
         return -1;
      return 1;
      }

    uasort($terms, 'sortUp');

    return $terms;
    }

    public static function termHitsSortDown($terms)
    {
    function sortDown($a, $b)
      {
      if ( $a['type'] == $b['type'] )
        return 0;
      if ( $a['type'] > $b['type'] )
         return -1;
      return 1;
      }

    uasort($terms, 'sortDown');

    return $terms;
    }
}
