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
  public function signIn($user)
  {
    $this->setAuthenticated(true);

    foreach ($user->getRoles() as $role)
    {
      $this->addCredential((string) $role);
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

    $user = QubitUser::checkCredentials($username, $password, &$error);

    // user account exists?
    if ($user !== null)
    {
      $authenticated = true;
      $this->signIn($user);
    }

    return $authenticated;
  }
}
