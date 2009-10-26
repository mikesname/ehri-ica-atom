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

class UserEditAction extends sfAction
{
  public static $NAMES = array(
    'username',
    'email',
    'password',
    'confirmPassword',
    'groups'
  );

  protected function addField($name)
  {
    switch ($name)
    {
      case 'username':
        $this->form->setDefault($name, $this->user[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);
        break;
      case 'email':
        $this->form->setDefault($name, $this->user[$name]);
        $this->form->setValidator($name, new sfValidatorEmail);
        $this->form->setWidget($name, new sfWidgetFormInput);
        break;
      case 'password':
      case 'confirmPassword':
        $this->form->setDefault($name, null);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInputPassword);
        break;
      case 'groups':
        $values = array();
        $criteria = new Criteria;
        $criteria->add(QubitAclUserGroup::USER_ID, $this->user->id, Criteria::EQUAL);
        foreach (QubitAclUserGroup::get($criteria) as $userGroup)
        {
          $values[] = $userGroup->groupId;
        }

        $choices = array();
        $criteria = new Criteria;
        $criteria->add(QubitAclGroup::ID, 99, Criteria::GREATER_THAN);
        foreach (QubitAclGroup::get($criteria) as $group)
        {
          $choices[$group->id] = $group->getName(array('cultureFallback' => true));
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;
    }
  }

  public function execute($request)
  {
    $this->form = new sfForm;

    $this->user = new QubitUser;

    if (isset($this->request->id))
    {
      $this->user = QubitUser::getById($this->request->id);

      if (!isset($this->user))
      {
        $this->forward404();
      }
    }

    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);
    $this->form->getValidatorSchema()->setPostValidator(new sfValidatorSchemaCompare(
      'password', '==', 'confirmPassword',
      array(),
      array('invalid' => 'Your password confirmation did not match you password.')
    ));

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    // HACK: because $this->user->getAclPermissions() is erroneously calling
    // QubitObject::getaclPermissionsById()
    $this->permissions = null;
    if (null != $this->user->id)
    {
      $this->permissions = QubitUser::getaclPermissionsById($this->user->id, array('self' => $this));
    }

    $this->isAdministrator = false;
    if ($this->getUser()->hasGroup(QubitAclGroup::ADMIN_ID))
    {
      $this->isAdministrator = true;
    }

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();
        $this->redirect(array('module' => 'user', 'action' => 'show', 'id' => $this->user->id));
      }
    }
  }

  protected function processForm()
  {
    $this->user->username = $this->form->getValue('username');
    $this->user->email = $this->form->getValue('email');

    if (0 < strlen(trim($this->form->getValue('password'))))
    {
      $this->user->setPassword($this->form->getValue('password'));
    }

    $this->user->save();

    $this->updateUserGroups();
    $this->updatePermissions();
    $this->deletePermissions();

    return $this;
  }

  protected function updateUserGroups()
  {
    $newGroupIds = $formGroupIds = array();

    if (null != ($groups = $this->form->getValue('groups')))
    {
      foreach ($groups as $groupId)
      {
        $newGroupIds[$groupId] = $formGroupIds[$groupId] = $groupId;
      }
    }
    else
    {
      $newGroupIds = $formGroupIds = array();
    }

    // Don't re-add existing groups + delete exiting groups that are no longer
    // in groups list
    foreach ($this->user->aclUserGroups as $existingUserGroup)
    {
      if (in_array($existingUserGroup->groupId, $formGroupIds))
      {
        unset($newGroupIds[$existingUserGroup->groupId]);
      }
      else
      {
        $existingUserGroup->delete();
      }
    }

    foreach ($newGroupIds as $groupId)
    {
      $userGroup = new QubitAclUserGroup;
      $userGroup->userId = $this->user->id;
      $userGroup->groupId = $groupId;
      $userGroup->save();
    }

    return $this;
  }

  protected function updatePermissions()
  {
    foreach ($this->request->getParameter('permission') as $key => $formData)
    {
      if ('new' == $key)
      {
        if (0 < intval($formData['actionId']))
        {
          $aclPermission = new QubitAclPermission;
          $aclPermission->userId = $this->user->id;
          $aclPermission->actionId = $formData['actionId'];
          $aclPermission->objectId = QubitInformationObject::ROOT_ID;
        }
        else
        {
          continue;
        }
      }
      else
      {
        $aclPermission = QubitAclPermission::getById($key);
        if (null === $aclPermission)
        {
          // If no valid aclPermission object, skip this row
          continue;
        }
      }

      $aclPermission->grantDeny = $formData['grantDeny'];

      // Set repository conditional for permission
      if ('null' != $formData['repository'])
      {
        $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $formData['repository']));
        $aclPermission->setRepository(QubitRepository::getById($params['id']));
      }
      else
      {
        $aclPermission->setRepository(null);
      }

      $aclPermission->save();
    }
  }

  protected function deletePermissions()
  {
    if (is_array($deletePermissions = $this->request->getParameter('deletePermission')))
    {
      foreach ($deletePermissions as $key => $value)
      {
        if (null !== $permission = QubitAclPermission::getById($key))
        {
          $permission->delete();
        }
      }
    }
  }
}
