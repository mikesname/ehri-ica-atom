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

class UserPasswordEditAction extends sfAction
{
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

    // Test password vs. confirm password
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);
    $this->form->getValidatorSchema()->setPostValidator(new sfValidatorSchemaCompare(
      'password', '==', 'confirmPassword',
      array('throw_global_error' => true),
      array('invalid' => 'Your password confirmation did not match you password.')
    ));

    // password
    $this->form->setDefault('password', null);
    $this->form->setValidator('password', new sfValidatorString);
    $this->form->setWidget('password', new sfWidgetFormInputPassword);

    // confirm password
    $this->form->setDefault('confirmPassword', null);
    $this->form->setValidator('confirmPassword', new sfValidatorString);
    $this->form->setWidget('confirmPassword', new sfWidgetFormInputPassword);

    $this->isAdministrator = false;
    if ($this->getUser()->hasCredential('administrator'))
    {
      $this->isAdministrator = true;
    }

    //except for administrators, only allow users to reset their own password
    if (!$this->isAdministrator)
    {
      if ($this->getRequestParameter('id') != $this->getUser()->getAttribute('user_id'))
      {
        QubitAcl::forwardToSecureAction();
      }
    }

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

  protected function processForm()
  {
    if (0 < strlen(trim($this->form->getValue('password'))))
    {
      $this->user->setPassword($this->form->getValue('password'));
    }

    $this->user->save();
  }
}
