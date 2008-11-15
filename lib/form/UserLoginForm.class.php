<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

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
        'required' => 'you must provide an email address',
        'invalid' => 'your email address is not a valid format'
      )
    );
    
    // Password validator
    $this->validatorSchema['password'] = new sfValidatorString(
      array('required' => true),
      array('required' => 'you must provide a password')
    );
    
    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');
    
    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat('login[%s]');
  }
}