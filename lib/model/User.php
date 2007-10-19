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

require_once 'lib/model/om/BaseUser.php';

class User extends BaseUser {

public function __toString()
  {

  return $this->getUserName();
  }

public function setPassword($password)
{
  $salt = md5(rand(100000, 999999).$this->getEmail());
  $this->setSalt($salt);
  $this->setSha1Password(sha1($salt.$password));
}

public function getUserCredentials()
  {

  $c = new Criteria();
  $c->add(userTermRelationshipPeer::USER_ID, $this->getId());
  $c->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, 6);

  $relationships = userTermRelationshipPeer::doSelect($c);

  if ($relationships)
    {
    $credentials = array();

    foreach ($relationships as $relationship)
    {
    $term = TermPeer::retrieveByPK($relationship->getTermId());
    $credential = $term->getTermName();

    if ($relationship->getRepositoryId())
      {
      $repositoryId = $relationship->getRepositoryId();
      $repository = $relationship->getRepository();
      }
    else
      {
      $repositoryId = 0;
      $repository = 'all';
      }

    $credentials[] = array('credential' => $credential, 'repositoryId' => $repositoryId, 'repository' => $repository, 'relationshipId' => $relationship->getId());
    }

    return $credentials;
    }

  }

public function setCredentials($termId, $repositoryId)
  {
  $newUserTermRelationship = new userTermRelationship();
  $newUserTermRelationship->setUserId($this->getId());
  $newUserTermRelationship->setTermId($termId);
  //set relationshipType to 'credential'
  $newUserTermRelationship->setRelationshipTypeId(6);
  if ($repositoryId != 0)
    {
    $newUserTermRelationship->setRepositoryId($repositoryId);
    }
  $newUserTermRelationship->save();
  }

} // User
