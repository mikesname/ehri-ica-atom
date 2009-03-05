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

class UserDeleteRoleRelationAction extends sfAction
{
  public function execute($request)
  {
  $this->deleteRoleRelation = QubitUserRoleRelation::getById($this->getRequestParameter('role_relation_id'));

  $this->forward404Unless($this->deleteRoleRelation);

  $userId = $this->deleteRoleRelation->getUserId();

  $this->deleteRoleRelation->delete();

  // if we are editing the current user, update the symfony user session ($this->getUser())
  if ($userId == $this->getUser()->getAttribute('user_id'))
    {
     //reset Credentials
     $this->getUser()->clearCredentials();
     $user = QubitUser::getById($userId);
     foreach ($user->getRoles() as $role)
      {
      $this->getUser()->addCredential((string) $role);
      }
    }

  return $this->redirect('user/edit?id='.$userId);
  }
}
