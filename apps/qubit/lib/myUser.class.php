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

class myUser extends sfBasicSecurityUser
{
  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    // initialize parent
    parent::initialize($dispatcher, $storage, $options);

    // On timeout, remove *all* user credentials
    if ($this->isTimedOut())
    {
      $this->signOut();
    }

    // If this user's account has been *deleted* or this user session is from a
    // different install of qubit on the same server (cross-site), then signout
    // user
    if (null !== ($userId = $this->getAttribute('user_id')) && null === QubitUser::getById($userId))
    {
      $this->signOut();
    }
  }

  public function signIn($user)
  {
    $this->setAuthenticated(true);

    foreach ($user->getAclGroups() as $group)
    {
      $this->addCredential($group->getName(array('culture' => 'en')));
    }

    $this->setAttribute('user_id', $user->getId());
    $this->setAttribute('user_name', $user->username);
  }

  public function signOut()
  {
    $user = QubitUser::getById($this->getAttribute('user_id'));

    $this->getAttributeHolder()->removeNamespace('credentialScope');

    $this->clearCredentials();
    $this->setAuthenticated(false);

    $this->getAttributeHolder()->remove('user_id');
    $this->getAttributeHolder()->remove('user_name');
    $this->getAttributeHolder()->remove('login_route');
    $this->getAttributeHolder()->remove('nav_context_module');
  }

  public function getUserID()
  {
    return $this->getAttribute('user_id');
  }

  public function getUserName()
  {
    return $this->getAttribute('user_name');
  }

  public function authenticate($username, $password, &$error)
  {
    $authenticated = false;
    $error = null;

    // anonymous is not a real user
    if ($username == 'anonymous')
    {
      $error = 'invalid username';
    }

    $user = QubitUser::checkCredentials($username, $password, $error);

    // user account exists?
    if ($user !== null)
    {
      $authenticated = true;
      $this->signIn($user);
    }

    return $authenticated;
  }

  public function getQubitUser()
  {
    return QubitUser::getById($this->getUserID());
  }

  public function hasGroup($checkGroups)
  {
    $hasGroup = false;

    if ($this->isAuthenticated())
    {
      $hasGroup = $this->getQubitUser()->hasGroup($checkGroups);
    }
    else
    {
      if (!is_array($checkGroups))
      {
        $checkGroups = array($checkGroups);
      }

      if (in_array(QubitAclGroup::ANONYMOUS_ID, $checkGroups))
      {
        $hasGroup = true;
      }
    }

    return $hasGroup;
  }

  public function listGroups()
  {
    if (null !== ($qubitUser = $this->getQubitUser()))
    {
      $groups = array(QubitAclGroup::getById(QubitAclGroup::AUTHENTICATED_ID));

      if (null !== $qubitUser->aclUserGroups)
      {
        foreach ($qubitUser->aclUserGroups as $aclUserGroup)
        {
          $groups[] = QubitAclGroup::getById($aclUserGroup->groupId);
        }
      }

      return $groups;
    }
    else
    {
      return QubitAclGroup::getById(QubitAclGroup::ANONYMOUS_ID);
    }
  }
}
