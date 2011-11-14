<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

  public function save($connection = null)
  {
    parent::save($connection);

    foreach ($this->aclUserGroups as $aclUserGroup)
    {
      $aclUserGroup->user = $this;

      try
      {
        $aclUserGroup->save();
      }
      catch (PropelException $e)
      {
      }
    }

    foreach ($this->aclPermissions as $aclPermission)
    {
      $aclPermission->user = $this;

      try
      {
        $aclPermission->save();
      }
      catch (PropelException $e)
      {
      }
    }

    return $this;
  }

  public function setPassword($password)
  {
    $salt = md5(rand(100000, 999999).$this->getEmail());
    $this->setSalt($salt);
    $this->setSha1Password(sha1($salt.$password));
  }

  public function getAclGroups()
  {
    // Add all users to 'authenticated' group
    $authenticatedGroup = QubitAclGroup::getById(QubitAclGroup::AUTHENTICATED_ID);

    $groups = array($authenticatedGroup);
    foreach ($this->getAclUserGroups() as $userGroup)
    {
      $groups[] = $userGroup->getGroup();
    }

    return $groups;
  }

  public function getUserCredentials()
  {
    return $this->getAclGroups();
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

  /**
   * Check if user belongs to *any* of the checkGroup(s) listed
   *
   * @param mixed $groups - integer value for group id, or array of group ids
   * @return boolean
   */
  public function hasGroup($checkGroups)
  {
    $hasGroup = false;

    // Cast $checkGroups as an array
    if (!is_array($checkGroups))
    {
      $checkGroups = array($checkGroups);
    }

    // A user is always part of the authenticated group
    if (in_array(QubitAclGroup::AUTHENTICATED_ID, $checkGroups))
    {
      return true;
    }

    $criteria = new Criteria;
    $criteria->add(QubitAclUserGroup::USER_ID, $this->id);

    if (0 < count($userGroups = QubitAclUserGroup::get($criteria)))
    {
      foreach ($userGroups as $userGroup)
      {
        if (in_array(intval($userGroup->groupId), $checkGroups))
        {
          $hasGroup = true;
          break;
        }
      }
    }

    return $hasGroup;
  }

  /**
   * Get system admin
   *
   * We are assuming the first admin user is the system admin
   *
   * @return QubitUser
   */
  public static function getSystemAdmin()
  {
    foreach (self::getAll() as $user)
    {
      if ($user->hasGroup(QubitAclGroup::ADMINISTRATOR_ID))
      {
        return $user;
      }
    }
  }
} // User
