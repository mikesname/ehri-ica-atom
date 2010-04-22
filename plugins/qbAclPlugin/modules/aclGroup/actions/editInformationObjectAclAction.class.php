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

class AclGroupEditInformationObjectAclAction extends sfAction
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

    // Build separate list of permissions by repository and by object
    $this->repositories = array();
    $this->informationObjects = array();
    $this->root = array();

    if (null != $this->group->id)
    {
      // Get info object permissions for this group
      $criteria = new Criteria;
      $criteria->addJoin(QubitAclPermission::OBJECT_ID, QubitObject::ID, Criteria::LEFT_JOIN);
      $criteria->add(QubitAclPermission::GROUP_ID, $this->group->id);
      $c1 = $criteria->getNewCriterion(QubitAclPermission::OBJECT_ID, null, Criteria::ISNULL);
      $c2 = $criteria->getNewCriterion(QubitObject::CLASS_NAME, 'QubitInformationObject');
      $c1->addOr($c2);
      $criteria->add($c1);

      $criteria->addAscendingOrderByColumn(QubitAclPermission::CONSTANTS);
      $criteria->addAscendingOrderByColumn(QubitAclPermission::OBJECT_ID);

      if (0 < count($permissions = QubitAclPermission::get($criteria)))
      {
        foreach ($permissions as $p)
        {
          if (null != ($repoId = $p->getConstants(array('name' => 'repositoryId'))))
          {
            $this->repositories[$repoId][$p->action] = $p;
          }
          else if (null != $p->objectId && QubitInformationObject::ROOT_ID != $p->objectId)
          {
            $this->informationObjects[$p->objectId][$p->action] = $p;
          }
          else
          {
            $this->root[$p->action] = $p;
          }
        }
      }
    }

    // List of actions without translate
    $this->basicActions = QubitInformationObjectAcl::$ACTIONS;
    unset($this->basicActions['translate']);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();
        $this->redirect(array($this->group, 'module' => 'aclGroup', 'action' => 'indexInformationObjectAcl'));
      }
    }
  }

  protected function processForm()
  {
    if ($this->request->hasParameter('repositoryAcl'))
    {
      $this->processRepositoryAcl();
    }

    if ($this->request->hasParameter('informationObjectAcl'))
    {
      $this->processInformationObjectAcl();
    }

    // Save changes
    $this->group->save();

    return $this;
  }

  protected function processRepositoryAcl()
  {
    foreach ($this->request->getParameter('repositoryAcl') as $key => $value)
    {
      // If key has an underscore, then we are creating a new permission
      if (1 == preg_match('/([\w]+)_(.*)/', $key, $matches))
      {
        list ($action, $uri) = array_slice($matches, 1, 2);
        $params = $this->context->routing->parse(Qubit::pathInfo($uri));
        if (!isset($params['id']))
        {
          continue;
        }

        if (QubitAcl::INHERIT != $value && isset(QubitInformationObjectAcl::$ACTIONS[$action]))
        {
          $aclPermission = new QubitAclPermission;
          $aclPermission->action = $action;
          $aclPermission->grantDeny = (QubitAcl::GRANT == $value) ? 1 : 0;
          $aclPermission->objectId = QubitInformationObject::ROOT_ID;
          $aclPermission->setRepository(QubitRepository::getById($params['id']));

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

  protected function processInformationObjectAcl()
  {
    foreach ($this->request->getParameter('informationObjectAcl') as $key => $value)
    {
      // If key has an underscore, then we are creating a new permission
      if (1 == preg_match('/([\w]+)_(.*)/', $key, $matches))
      {
        list ($action, $uri) = array_slice($matches, 1, 2);
        $params = $this->context->routing->parse(Qubit::pathInfo($uri));

        if (!isset($params['id']))
        {
          continue;
        }

        if (QubitAcl::INHERIT != $value && isset(QubitInformationObjectAcl::$ACTIONS[$action]))
        {
          $aclPermission = new QubitAclPermission;
          $aclPermission->action = $action;
          $aclPermission->grantDeny = (QubitAcl::GRANT == $value) ? 1 : 0;
          $aclPermission->objectId = $params['id'];

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
