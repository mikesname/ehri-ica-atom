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

class informationObjectPeer extends BaseinformationObjectPeer
{

public static function getBrowseListPager($page)
{
  $pager = new sfPropelPager('informationObject', sfConfig::get('app_pager_browse_list_max'));
  $c = new Criteria();
  $c->addAscendingOrderByColumn(self::TITLE);
  $pager->setCriteria($c);
  $pager->setPage($page);
  $pager->init();

  return $pager;
}

public static function getRecentChanges($limit)
  {
  $c = new Criteria();
  $c->addDescendingOrderByColumn(informationObjectPeer::UPDATED_AT);
  $c->setLimit($limit);
  $recentInformationObjects = informationObjectPeer::doSelect($c);

  return $recentInformationObjects;
  }

public static function informationObjectList($sort = NULL, $repository = NULL, $collection = NULL)
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
      case 'titleDown' :
      $c->addDescendingOrderByColumn(self::TITLE);
      break;
      default :
      case 'titleUp' :
      $c->addAscendingOrderByColumn(self::TITLE);
      break;
      }

  $c->addJoin(InformationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID, Criteria::LEFT_JOIN);
  $informationObjectList = self::doSelect($c);

  //have to return an array in order to sort on repositoryName or collectionName
  //can't pre-sort all fields in the query because
  //it is not possible to do multiple joins using Propel Criteria
  //(e.g. to get the repositoryName via informationObject->repository->actor->getAuthorizedFormOfName()

  $informationObjects = array();

  foreach ($informationObjectList as $informationObject)
    {
    //only display roots and orphans
    if(($informationObject->getTreeId() == null) or ($informationObject->getTreeParentId() == null))
      {
      $informationObjects[] = array('id' => $informationObject->getId(), 'title' => $informationObject->getTitle(), 'label' => $informationObject->getLabel(), 'repository' => $informationObject->getRepository(), 'collection' => $informationObject->getCollection(), 'hasChildren' => $informationObject->hasChildren());
      }
    }

  //use ArraySort helper
  switch($sort)
    {
    case 'repositoryUp' :
      return ArraySort::repositoryTypeSortUp($informationObjects);
    case 'repositoryDown' :
      return ArraySort::repositoryTypeSortDown($informationObjects);
    case 'collectionUp' :
      return ArraySort::collectionSortUp($informationObjects);
    case 'collectionDown' :
      return ArraySort::collectionSortDown($informationObjects);
    default :
      return $informationObjects;
    }

  }

}
