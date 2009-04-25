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
 * QubitUser model
 */
class QubitUser extends BaseUser
{
  public function __toString()
  {
    return (string) $this->username;
  }

  public function setPassword($password)
  {
    $salt = md5(rand(100000, 999999).$this->getEmail());
    $this->setSalt($salt);
    $this->setSha1Password(sha1($salt.$password));
  }

  public function getRoles()
  {
    $roles = array();
    foreach ($this->getUserRoleRelations() as $relation)
    {
      $roles[] = $relation->getRole();
    }

    return $roles;
  }

  public function getUserCredentials()
  {
    return $this->getRoles();
  }

  public static function getList($options=array())
  {
    $criteria = new Criteria;

    $criteria->add(QubitUser::ID, null, Criteria::ISNOTNULL);
    $page = (isset($options['page'])) ? $options['page'] : 1;

    // Page results
    $pager = new QubitPager('QubitUser');
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();

    return $pager;
  }

  public static function checkCredentials($username, $password, &$error)
  {
    $validCreds = false;
    $error = null;

    // anonymous is not a real user
    if ($username == 'anonymous')
    {
      $error = 'invalid username';

      return null;
    }

    $criteria = new Criteria;
    $criteria->add(QubitUser::EMAIL, $username);
    $user = QubitUser::getOne($criteria);

    // user account exists?
    if ($user !== null)
    {
      // password is OK?
      if (sha1($user->getSalt().$password) == $user->getSha1Password())
      {
        $validCreds = true;
      }
      else
      {
        $error = 'invalid password';
      }
    }
    else
    {
      $error = 'invalid username';
    }

    return ($validCreds) ? $user : null;
  }
} // User
