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

class AclGroupEditActorAclAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;
    $this->group = new QubitAclGroup;

    if (isset($this->request->id))
    {
      $this->group = QubitAclGroup::getById($this->request->id);

      if (!isset($this->group))
      {
        $this->forward404();
      }
    }

    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    // Always include root actor permissions
    $this->permissions = array();
    $this->permissions[QubitActor::ROOT_ID] = null;

    // Get actor permissions for this group
    $criteria = new Criteria;
    $criteria->addJoin(QubitAclPermission::OBJECT_ID, QubitObject::ID, Criteria::LEFT_JOIN);
    $criteria->add(QubitAclPermission::GROUP_ID, $this->group->id);
    $c1 = $criteria->getNewCriterion(QubitAclPermission::OBJECT_ID, null, Criteria::ISNULL);
    $c2 = $criteria->getNewCriterion(QubitObject::CLASS_NAME, 'QubitActor');
    $c1->addOr($c2);
    $criteria->add($c1);

    if (null !== $permissions = QubitAclPermission::get($criteria))
    {
      foreach ($permissions as $p)
      {
        $this->permissions[$p->objectId][$p->action] = $p;
      }
    }

    // List of actions without translate
    $this->basicActions = QubitAcl::$ACTIONS;
    unset($this->basicActions['translate']);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();
        $this->redirect(array($this->group, 'module' => 'aclGroup', 'action' => 'indexActorAcl'));
      }
    }
  }

  protected function processForm()
  {
    foreach ($this->request->getParameter('updatePermission') as $key => $value)
    {
      // If key has an underscore, then we are creating a new permission
      if (false !== strpos($key, '_'))
      {
        list ($actorId, $action) = explode('_', $key);

        if (QubitAcl::INHERIT != $value && isset(QubitAcl::$ACTIONS[$action]))
        {
          $aclPermission = new QubitAclPermission;
          $aclPermission->action = $action;
          $aclPermission->grantDeny = (QubitAcl::GRANT == $value) ? 1 : 0;
          $aclPermission->objectId = $actorId;

          $this->group->aclPermissions[] = $aclPermission;
        }
      }

      // Otherwise, update an existing permission
      else if (null !== $aclPermission = QubitAclPermission::getById($key))
      {
        if ($value == QubitAcl::INHERIT)
        {
          $aclPermission->delete();
        }
        else
        {
          $aclPermission->grantDeny = (QubitAcl::GRANT == $value) ? 1 : 0;
          $this->group->aclPermissions[] = $aclPermission;
        }
      }
    }

    // Save updates
    $this->group->save();

    return $this;
  }
}
