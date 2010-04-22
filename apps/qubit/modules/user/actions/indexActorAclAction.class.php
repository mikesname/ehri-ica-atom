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

class UserIndexActorAclAction extends sfAction
{
  public function execute($request)
  {
    $this->user = QubitUser::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->user);

    //except for administrators, only allow users to see their own profile
    if (!$this->getUser()->hasCredential('administrator'))
    {
      if ($this->getRequestParameter('id') != $this->getUser()->getAttribute('user_id'))
      {
        $this->redirect('admin/secure');
      }
    }

    // Get user's groups
    $this->userGroups = array();
    if (0 < count($aclUserGroups = $this->user->aclUserGroups))
    {
      foreach ($aclUserGroups as $aclUserGroup)
      {
        $this->userGroups[] = $aclUserGroup->groupId;
      }
    }
    else
    {
      // User is *always* part of authenticated group
      $this->userGroups = array(QubitAclGroup::AUTHENTICATED_ID);
    }

    // Table width
    $this->tableCols = count($this->userGroups) + 3;

    // Get access control permissions for actors
    $criteria = new Criteria;
    $criteria->addJoin(QubitAclPermission::OBJECT_ID, QubitObject::ID, Criteria::LEFT_JOIN);
    $c1 = $criteria->getNewCriterion(QubitAclPermission::USER_ID, $this->request->id);
    if (1 == count($this->userGroups))
    {
      $c2 = $criteria->getNewCriterion(QubitAclPermission::GROUP_ID, $this->userGroups[0]);
    }
    else
    {
      $c2 = $criteria->getNewCriterion(QubitAclPermission::GROUP_ID, $this->userGroups, Criteria::IN);
    }
    $c1->addOr($c2);
    $c3 = $criteria->getNewCriterion(QubitObject::CLASS_NAME, 'QubitActor');
    $c4 = $criteria->getNewCriterion(QubitAclPermission::OBJECT_ID, null, Criteria::ISNULL);
    $c3->addOr($c4);
    $c1->addAnd($c3);

    $criteria->add($c1);
    $criteria->addAscendingOrderByColumn(QubitAclPermission::OBJECT_ID);
    $criteria->addAscendingOrderByColumn(QubitAclPermission::USER_ID);
    $criteria->addAscendingOrderByColumn(QubitAclPermission::GROUP_ID);

    // Add user as final "group"
    $this->userGroups[] = $this->user->username;

    // Build ACL
    $this->acl = array();
    if (0 < count($permissions = QubitAclPermission::get($criteria)))
    {
      foreach ($permissions as $permission)
      {
        // In this context permissions for all objects (null) and root actor
        // object are equivalent
        $objectId = (QubitActor::ROOT_ID != $permission->objectId) ? $permission->objectId : null;

        // Use username as "group" for permissions specific to user
        $groupKey = (null !== $permission->groupId) ? $permission->groupId : $this->user->username;

        $this->acl[$objectId][$permission->action][$groupKey] = $permission;
      }
    }
  }
}
