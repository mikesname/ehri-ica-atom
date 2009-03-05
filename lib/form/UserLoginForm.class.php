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

sfLoader::loadHelpers('I18N');

/**
 * Global form & validation definition for user login
 * 
 * @package    qubit
 * @subpackage settings
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class UserLoginForm extends sfForm
{
  public function configure()
  {
    // Build widgets
    $this->setWidgets(array(
      'email' => new sfWidgetFormInput,
      'password' => new sfWidgetFormInputPassword
    ));

    // Email validator
    $this->validatorSchema['email'] = new sfValidatorEmail(
      array('required' => true),
      array(
        'required' => __('you must provide an email address'),
        'invalid' => __('your email address is not a valid format')
      )
    );

    // Password validator
    $this->validatorSchema['password'] = new sfValidatorString(
      array('required' => true),
      array('required' => __('you must provide a password'))
    );

    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');

    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat('login[%s]');
  }
}