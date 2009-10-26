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

class AclGroupEditAction extends sfAction
{
  public static $NAMES = array(
    'name',
    'description'
  );

  protected function addField($name)
  {
    switch ($name)
    {
      case 'name':
        $this->form->setDefault($name, $this->group[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);
        break;
      case 'description':
        $this->form->setDefault($name, $this->group[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);
        break;
    }
  }

  public function execute($request)
  {
    $this->group = new QubitAclGroup;

    if (isset($this->request->id))
    {
      $this->group = QubitAclGroup::getById($this->request->id);

      if (!isset($this->group))
      {
        $this->forward404();
      }
    }

    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->permissions = $this->group->getAclPermissions()->orderBy('action_id');

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    $this->isAdministrator = false;
    if ($this->getUser()->hasCredential('administrator'))
    {
      $this->isAdministrator = true;
    }

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();
        $this->redirect(array('module' => 'aclGroup', 'action' => 'list'));
      }
    }
  }

  protected function processForm()
  {
    $this->group->name = $this->request->getParameter('name');
    $this->group->description = $this->request->getParameter('description');

    // Inherit permissions from authenticated group
    $this->group->parentId = QubitAclGroup::AUTHENTICATED_ID;
    $this->group->save();

    $this->updatePermissions();
    $this->deletePermissions();
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
          $aclPermission->groupId = $this->group->id;
          $aclPermission->objectId = QubitInformationObject::ROOT_ID;
          $aclPermission->actionId = $formData['actionId'];
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
