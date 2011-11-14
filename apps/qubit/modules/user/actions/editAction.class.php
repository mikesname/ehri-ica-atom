<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class UserEditAction extends DefaultEditAction
{
  // Arrays not allowed in class constants
  public static
    $NAMES = array(
      'confirmPassword',
      'email',
      'groups',
      'password',
      'translate',
      'username');

  protected function earlyExecute()
  {
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);
    $this->form->getValidatorSchema()->setPostValidator(new sfValidatorSchemaCompare(
      'password', '==', 'confirmPassword',
      array(),
      array('invalid' => $this->context->i18n->__('Your password confirmation did not match you password.'))));

    $this->resource = new QubitUser;
    if (isset($this->getRoute()->resource))
    {
      $this->resource = $this->getRoute()->resource;
    }

    // HACK: because $this->user->getAclPermissions() is erroneously calling
    // QubitObject::getaclPermissionsById()
    $this->permissions = null;
    if (isset($this->resource->id))
    {
      $permissions = QubitUser::getaclPermissionsById($this->resource->id, array('self' => $this))->orderBy('constants')->orderBy('object_id');

      foreach ($permissions as $item)
      {
        $repoId = $item->getConstants(array('name' => 'repositoryId'));
        $this->permissions[$repoId][$item->objectId][$item->action] = $item->grantDeny;
      }
    }

    // List of actions without translate
    $this->basicActions = QubitInformationObjectAcl::$ACTIONS;
    unset($this->basicActions['translate']);
  }

  protected function addField($name)
  {
    switch ($name)
    {
      case 'username':
        $this->form->setDefault('username', $this->resource->username);
        $this->form->setValidator('username', new sfValidatorString(array('required' => true)));
        $this->form->setWidget('username', new sfWidgetFormInput);

        break;

      case 'email':
        $this->form->setDefault('email', $this->resource->email);
        $this->form->setValidator('email', new sfValidatorEmail(array('required' => true)));
        $this->form->setWidget('email', new sfWidgetFormInput);

        break;

      case 'password':
      case 'confirmPassword':
        $this->form->setDefault($name, null);
        // Required field only if a new user is being created
        $this->form->setValidator($name, new sfValidatorString(array('required' => !isset($this->getRoute()->resource))));
        $this->form->setWidget($name, new sfWidgetFormInputPassword);

        break;

      case 'groups':
        $values = array();
        $criteria = new Criteria;
        $criteria->add(QubitAclUserGroup::USER_ID, $this->resource->id);
        foreach (QubitAclUserGroup::get($criteria) as $item)
        {
          $values[] = $item->groupId;
        }

        $choices = array();
        $criteria = new Criteria;
        $criteria->add(QubitAclGroup::ID, 99, Criteria::GREATER_THAN);
        foreach (QubitAclGroup::get($criteria) as $item)
        {
          $choices[$item->id] = $item->getName(array('cultureFallback' => true));
        }

        $this->form->setDefault('groups', $values);
        $this->form->setValidator('groups', new sfValidatorPass);
        $this->form->setWidget('groups', new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;

      case 'translate':
        $c = sfCultureInfo::getInstance($this->context->user->getCulture());
        $languages = $c->getLanguages();

        $choices = array();
        if (0 < count($langSettings = QubitSetting::getByScope('i18n_languages')))
        {
          foreach ($langSettings as $item)
          {
            $choices[$item->name] = $languages[$item->name];
          }
        }

        // Find existing translate permissions
        $criteria = new Criteria;
        $criteria->add(QubitAclPermission::USER_ID, $this->resource->id);
        $criteria->add(QubitAclPermission::ACTION, 'translate');

        $defaults = null;
        if (null !== $permission = QubitAclPermission::getOne($criteria))
        {
          $defaults = $permission->getConstants(array('name' => 'languages'));
        }

        $this->form->setDefault('translate', $defaults);
        $this->form->setValidator('translate', new sfValidatorPass);
        $this->form->setWidget('translate', new sfWidgetFormSelect(array('choices'  => $choices, 'multiple' => true)));

        break;
    }
  }

  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'password':

        if (0 < strlen(trim($this->form->getValue('password'))))
        {
          $this->resource->setPassword($this->form->getValue('password'));
        }

        break;

      case 'confirmPassword':
        // Don't do anything for confirmPassword
        break;

      case 'groups':
        $newGroupIds = $formGroupIds = array();

        if (null != ($groups = $this->form->getValue('groups')))
        {
          foreach ($groups as $item)
          {
            $newGroupIds[$item] = $formGroupIds[$item] = $item;
          }
        }
        else
        {
          $newGroupIds = $formGroupIds = array();
        }

        // Don't re-add existing groups + delete exiting groups that are no longer
        // in groups list
        foreach ($this->resource->aclUserGroups as $item)
        {
          if (in_array($item->groupId, $formGroupIds))
          {
            unset($newGroupIds[$item->groupId]);
          }
          else
          {
            $item->delete();
          }
        }

        foreach ($newGroupIds as $item)
        {
          $userGroup = new QubitAclUserGroup;
          $userGroup->groupId = $item;

          $this->resource->aclUserGroups[] = $userGroup;
        }

        break;

      case 'translate':
        $languages = $this->form->getValue('translate');

        $criteria = new Criteria;
        $criteria->add(QubitAclPermission::USER_ID, $this->resource->id);
        $criteria->addAnd(QubitAclPermission::USER_ID, null, Criteria::ISNOTNULL);
        $criteria->add(QubitAclPermission::ACTION, 'translate');

        if (null === $permission = QubitAclPermission::getOne($criteria))
        {
          $permission = new QubitAclPermission;
          $permission->userId = $this->resource->id;
          $permission->action = 'translate';
          $permission->grantDeny = 1;
          $permission->conditional = 'in_array(%p[language], %k[languages])';
        }
        else if (!is_array($languages))
        {
          // If $languages is not an array, then remove the translate permission
          $permission->delete();
        }

        if (is_array($languages))
        {
          $permission->setConstants(array('languages' => $languages));
          $permission->save();
        }

        break;

      default:
        $this->resource[$name] = $this->form->getValue($name);
    }
  }

  public function execute($request)
  {
    parent::execute($request);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        $this->resource->save();

        $this->redirect(array($this->resource, 'module' => 'user'));
      }
    }
  }
}
