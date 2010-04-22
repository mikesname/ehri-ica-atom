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

class UserIndexTermAclAction extends sfAction
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
    $this->roles = array();
    if (0 < count($aclUserGroups = $this->user->aclUserGroups))
    {
      foreach ($aclUserGroups as $aclUserGroup)
      {
        $this->roles[] = $aclUserGroup->groupId;
      }
    }
    else
    {
      // User is *always* part of authenticated group
      $this->roles = array(QubitAclGroup::AUTHENTICATED_ID);
    }

    // Table width
    $this->tableCols = count($this->roles) + 3;

    // Get access control permissions
    $criteria = new Criteria;
    $criteria->addJoin(QubitAclPermission::OBJECT_ID, QubitObject::ID, Criteria::LEFT_JOIN);
    $c1 = $criteria->getNewCriterion(QubitAclPermission::USER_ID, $this->request->id);

    // Add group criteria
    $c2 = $criteria->getNewCriterion(QubitAclPermission::GROUP_ID, $this->roles, Criteria::IN);
    $c1->addOr($c2);

    // Add term criteria
    $c3 = $criteria->getNewCriterion(QubitObject::CLASS_NAME, 'QubitTerm');
    $c4 = $criteria->getNewCriterion(QubitAclPermission::OBJECT_ID, null, Criteria::ISNULL);
    $c5 = $criteria->getNewCriterion(QubitAclPermission::ACTION, 'createTerm');
    $c3->addOr($c4);
    $c3->addOr($c5);
    $c1->addAnd($c3);
    $criteria->add($c1);

    // Sort
    $criteria->addAscendingOrderByColumn(QubitAclPermission::CONSTANTS);
    $criteria->addAscendingOrderByColumn(QubitAclPermission::OBJECT_ID);
    $criteria->addAscendingOrderByColumn(QubitAclPermission::USER_ID);
    $criteria->addAscendingOrderByColumn(QubitAclPermission::GROUP_ID);

    // Add user as final role
    $this->roles[] = $this->user->username;

    // Build ACL
    $this->acl = array();
    if (0 < count($permissions = QubitAclPermission::get($criteria)))
    {
      foreach ($permissions as $permission)
      {
        // Use username as key for permissions specific to user
        $roleKey = (null !== $permission->groupId) ? $permission->groupId : $this->user->username;

        if ('createTerm' != $permission->action)
        {
          $taxonomyId = $permission->getConstants(array('name' => 'taxonomyId'));
          $action = $permission->action;
        }
        else
        {
          // In this context permissions for all objects (null) and root object
          // are equivalent
          $taxonomyId = (QubitTaxonomy::ROOT_ID != $permission->objectId) ? $permission->objectId : null;
          $action = 'create';
        }

        $this->acl[$taxonomyId][$action][$roleKey] = $permission;
      }
    }
  }
}
