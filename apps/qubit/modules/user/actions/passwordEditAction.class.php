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

class UserPasswordEditAction extends DefaultEditAction
{
  // Arrays not allowed in class constants
  public static
    $NAMES = array(
      'confirmPassword',
      'password');

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

    // Except for administrators, only allow users to reset their own password
    if (!$this->context->user->hasCredential('administrator'))
    {
      if ($this->resource->id != $this->context->user->getAttribute('user_id'))
      {
        QubitAcl::forwardToSecureAction();
      }
    }
  }

  protected function addField($name)
  {
    switch ($name)
    {
      case 'confirmPassword':
      case 'password':

        $this->form->setDefault($name, null);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInputPassword);

        break;
    }
  }

  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'confirmPassword':
        // Don't do anything for confirmPassword
        break;

      case 'password':

        if (0 < strlen(trim($this->form->getValue('password'))))
        {
          $this->resource->setPassword($this->form->getValue('password'));
        }

        break;
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
