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

class UserUpdateAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->getRequestParameter('id', 0))
    {
      $user = new QubitUser;
      $user->setPassword($this->getRequestParameter('sha1_password'));
    }
    else
    {
      $user = QubitUser::getById($this->getRequestParameter('id'));
      $this->forward404Unless($user);
    }
    $user->setId($this->getRequestParameter('id'));
    $user->username = $this->getRequestParameter('username');
    $user->setEmail($this->getRequestParameter('email'));

    $user->save();

   if ($this->getRequestParameter('role_id'))
    {
    $newRoleRelation = new QubitUserRoleRelation;
    $newRoleRelation->setUserId($user->getId());
    $newRoleRelation->setRoleId($this->getRequestParameter('role_id'));
    $newRoleRelation->save();
    }

    // if we are editing the current user, update the symfony user session ($this->getUser())
    if ($user->getId() == $this->getUser()->getAttribute('user_id'))
      {
        $this->getUser()->setAttribute('user_name', $user->username);
        //reset Credentials
        $this->getUser()->clearCredentials();
        foreach ($user->getRoles() as $role)
          {
            $this->getUser()->addCredential((string) $role);
          }
      }

  return $this->redirect('user/show?id='.$user->getId());
  }
}
