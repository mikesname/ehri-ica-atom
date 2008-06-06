<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
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
    $this->setAttribute('user_name', $user->getUserName());
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
}
