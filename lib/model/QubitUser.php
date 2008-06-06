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

class QubitUser extends BaseUser
{
  public function __toString()
  {
    return (string) $this->getUserName();
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
} // User
