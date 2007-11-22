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

class InformationObjectTermRelationshipPeer extends BaseInformationObjectTermRelationshipPeer
{

  public static function getTermBrowseList($termId = null, $sort = null)
  {
  $c = new Criteria();
  $c->addJoin(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectPeer:: ID);
  $c->add(InformationObjectTermRelationshipPeer::TERM_ID, $termId);

  $relationships = self::doSelectJoinInformationObject($c);
  $termBrowseList = array();

  foreach($relationships as $relationship)
    {
    if($relationship->getInformationObject()->getTreeId())
      {
      $collectionId = $relationship->getInformationObject()->getTreeId();
      $collection = InformationObjectPeer::RetrieveByPk($relationship->getInformationObject()->getTreeId());
      $collectionName = $collection->getTitle();
      }
    else
      {
      $collectionId = null;
      $collectionName = null;
      }

    $repositoryLink = $relationship->getInformationObject()->getRepositoryLink();

    $termBrowseList[] = array('title' => $relationship->getInformationObject(), 'informationObjectId' => $relationship->getInformationObjectId(), 'hasChildren' => $relationship->getInformationObject()->hasChildren(), 'collectionId' => $collectionId, 'collectionName' => $collectionName, 'repositoryId' => $repositoryLink['repositoryId'], 'repositoryName' => $repositoryLink['repositoryName']);

    }

  return $termBrowseList;
  }



  //TO DO: delete getRelatedLanguages and getRelatedSubjects??
  public static function getRelatedLanguages($languageId)
  {
  $c = new Criteria();
  $c->add(InformationObjectTermRelationshipPeer::TERM_ID, $languageId);
  $relatedLanguages = InformationObjectTermRelationshipPeer::doSelect($c);

  return $relatedLanguages;
  }

public static function getRelatedSubjects($subjectId)
  {
  $c = new Criteria();
  $c->add(InformationObjectTermRelationshipPeer::TERM_ID, $subjectId);
  $relatedSubjects = InformationObjectTermRelationshipPeer::doSelect($c);

  return $relatedSubjects;
  }



}
