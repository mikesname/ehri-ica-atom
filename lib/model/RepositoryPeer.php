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


  // include base peer class
  require_once 'lib/model/om/BaseRepositoryPeer.php';

  // include object class
  include_once 'lib/model/Repository.php';

class RepositoryPeer extends BaseRepositoryPeer {

public static function getRepositories($sort=null, $countryId=null)
  {
  $c = new Criteria();

  //Establish sort order
  switch($sort)
      {
      case 'idDown' :
      $c->addDescendingOrderByColumn(self::ID);
      break;
      case 'idUp' :
      $c->addAscendingOrderByColumn(self::ID);
      break;
      case 'nameDown' :
      $c->addDescendingOrderByColumn(ActorPeer::AUTHORIZED_FORM_OF_NAME);
      break;
      default :
      case 'nameUp' :
      $c->addAscendingOrderByColumn(ActorPeer::AUTHORIZED_FORM_OF_NAME);
      break;
      }

  $repositoryList = self::doSelectJoinActor($c);


  //have to return an array in order to sort on country or repositoryType
  //can't pre-sort all fields in the query because
  //it is not possible to do multiple joins using Propel Criteria
  //(e.g. to get the country via repository->actor->contactInformation->country,
  //or repository->term (for repositoryType))

  $repositories = array();

  foreach ($repositoryList as $repository)
    {
    $repositories[] = array('id' => $repository->getId(), 'name' => $repository->getActor(), 'type' => $repository->getTermRelatedByRepositoryTypeId(), 'country' => $repository->getCountry());
    }

  //use ArraySort helper
  switch($sort)
    {
    case 'countryUp' :
      return ArraySort::countrySortUp($repositories);
    case 'countryDown' :
      return ArraySort::countrySortDown($repositories);
    case 'typeUp' :
      return ArraySort::repositoryTypeSortUp($repositories);
    case 'typeDown' :
      return ArraySort::repositoryTypeSortDown($repositories);
    default :
      return $repositories;
    }




  }





} // RepositoryPeer
