<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
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
