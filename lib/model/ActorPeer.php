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

class ActorPeer extends BaseActorPeer
{

public static function getActors($sort='nameUp', $role='all')
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
      case 'typeDown' :
      $c->addDescendingOrderByColumn(self::TYPE_OF_ENTITY_ID);
      break;
      case 'typeUp' :
      $c->addAscendingOrderByColumn(self::TYPE_OF_ENTITY_ID);
      break;
      case 'nameDown' :
      $c->addDescendingOrderByColumn(self::AUTHORIZED_FORM_OF_NAME);
      break;
      default :
      case 'nameUp' :
      $c->addAscendingOrderByColumn(self::AUTHORIZED_FORM_OF_NAME);
      break;
      }

    $actors = self::doSelect($c);

    return $actors;
  }


/*public static function getCreators($sort = 'idDown')
  {
  $c = new Criteria();
  $c->addJoin(ActorPeer::ID, InformationObjectActorRelationshipPeer::ACTOR_ID);
  $c->add(InformationObjectActorRelationshipPeer::ACTOR_ROLE_ID, 379);

  //Establish sort order
  switch($sort)
      {
      case 'idDown' :
      $c->addDescendingOrderByColumn(self::ID);
      break;
      case 'idUp' :
      $c->addAscendingOrderByColumn(self::ID);
      break;
      case 'typeDown' :
      $c->addDescendingOrderByColumn(self::TYPE_OF_ENTITY_ID);
      break;
      case 'typeUp' :
      $c->addAscendingOrderByColumn(self::TYPE_OF_ENTITY_ID);
      break;
      case 'nameDown' :
      $c->addDescendingOrderByColumn(self::AUTHORIZED_FORM_OF_NAME);
      break;
      case 'nameUp' :
      $c->addAscendingOrderByColumn(self::AUTHORIZED_FORM_OF_NAME);
      break;
      }

  $c->setDistinct();
  $creators = self::doSelect($c);

  return $creators;
  }

public static function getActorList($sort = 'default', $role = 'all')
  {
  if ($role == 'creator'){
    return self::getCreators($sort);
    }
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
      case 'typeDown' :
      $c->addDescendingOrderByColumn(self::TYPE_OF_ENTITY_ID);
      break;
      case 'typeUp' :
      $c->addAscendingOrderByColumn(self::TYPE_OF_ENTITY_ID);
      break;
      case 'nameDown' :
      $c->addDescendingOrderByColumn(self::AUTHORIZED_FORM_OF_NAME);
      break;
      case 'default':
      case 'nameUp' :
      $c->addAscendingOrderByColumn(self::AUTHORIZED_FORM_OF_NAME);
      break;
      }

  $actorList = self::doSelect($c);

  return $actorList;
  } */

public static function getSubjects()
  {
  $c = new Criteria();
  $actors = self::doSelect($c);

  $c = new Criteria();
  $c->add(InformationObjectActorRelationshipPeer::ACTOR_ROLE_ID, 406);
  $actorSubjectRelationships = InformationObjectActorRelationshipPeer::doSelect($c);

  $actorSubjectList = array();

  foreach ($actors as $actor)
    {
    $hitCount = null;
    foreach ($actorSubjectRelationships as $actorSubjectRelationship)
      {
      if ($actor->getId() == $actorSubjectRelationship->getActorId())
          {
          $hitCount += 1;
          }
      }
      if ($hitCount != null)
      {
      $actor->setSubjectHitCount($hitCount);
      array_push($actorSubjectList, $actor);
      }
    }

   return $actorSubjectList;
   }



}
