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
  public static
    $NAMES = array(
      'username',
      'email',
      'password',
      'confirmPassword',
      'groups',
      'translate');

  protected function addField($name)
  {
    switch ($name)
    {
      case 'username':
        $this->form->setDefault($name, $this->user[$name]);
        $this->form->setValidator($name, new sfValidatorString(array('required' => true)));
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'email':
        $this->form->setDefault($name, $this->user[$name]);
        $this->form->setValidator($name, new sfValidatorEmail(array('required' => true)));
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'password':
      case 'confirmPassword':
        $this->form->setDefault($name, null);
        // Required field only if a new user is being created
        $this->form->setValidator($name, new sfValidatorString(array('required' => !isset($this->request->id))));
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

      case 'translate':
        $c = sfCultureInfo::getInstance($this->getContext()->getUser()->getCulture());
        $languages = $c->getLanguages();

        $choices = array();
        if (0 < count($langSettings = QubitSetting::getByScope('i18n_languages')))
        {
          foreach ($langSettings as $setting)
          {
            $choices[$setting->name] = $languages[$setting->name];
          }
        }

        // Find existing translate permissions
        $criteria = new Criteria;
        $criteria->add(QubitAclPermission::USER_ID, $this->user->id);
        $criteria->add(QubitAclPermission::ACTION, 'translate');

        $defaults = null;
        if (null !== $permission = QubitAclPermission::getOne($criteria))
        {
          $defaults = $permission->getConstants(array('name' => 'languages'));
        }

        $this->form->setDefault($name, $defaults);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices'  => $choices, 'multiple' => true)));

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
          $this->user->setPassword($this->form->getValue('password'));
        }

        break;

      case 'confirmPassword':
        // Don't do anything for confirmPassword
        break;

      case 'groups':
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
          $userGroup->groupId = $groupId;

          $this->user->aclUserGroups[] = $userGroup;
        }

        break;

      case 'translate':
        $languages = $this->form->getValue('translate');

        $criteria = new Criteria;
        $criteria->add(QubitAclPermission::USER_ID, $this->user->id);
        $criteria->addAnd(QubitAclPermission::USER_ID, null, Criteria::ISNOTNULL);
        $criteria->add(QubitAclPermission::ACTION, 'translate');

        if (null === $permission = QubitAclPermission::getOne($criteria))
        {
          $permission = new QubitAclPermission;
          $permission->userId = $this->user->id;
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
        $this->user[$name] = $this->form->getValue($name);
    }
  }

  protected function processForm()
  {
    foreach ($this->form as $field)
    {
      $this->processField($field);
    }

    // Save changes
    $this->user->save();

    return $this;
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
      array('invalid' => 'Your password confirmation did not match you password.')));

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
    if (isset($request->id))
    {
      $permissions = QubitUser::getaclPermissionsById($this->user->id, array('self' => $this))->orderBy('constants')->orderBy('object_id');

      foreach ($permissions as $item)
      {
        $repoId = $item->getConstants(array('name' => 'repositoryId'));
        $this->permissions[$repoId][$item->objectId][$item->action] = $item->grantDeny;
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

        $this->redirect(array($this->user, 'module' => 'user'));
      }
    }
  }
}
