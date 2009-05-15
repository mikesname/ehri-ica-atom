<?php

/*
 */

class sfInstallConfigureSiteForm extends sfForm
{
  public function configure()
  {
    $this->setValidators(array(
      'siteTitle' => new sfValidatorString(array('required' => true)),
      'siteDescription' => new sfValidatorString,
      'username' => new sfValidatorString(array('required' => true)),
      'email' => new sfValidatorEmail(array('required' => true)),
      'password' => new sfValidatorString(array('required' => true)),
      'confirmPassword' => new sfValidatorString(array('required' => true))));

    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('password', '==', 'confirmPassword'));

    $this->setWidgets(array(
      'siteTitle' => new sfWidgetFormInput,
      'siteDescription' => new sfWidgetFormInput,
      'username' => new sfWidgetFormInput,
      'email' => new sfWidgetFormInput,
      'password' => new sfWidgetFormInputPassword,
      'confirmPassword' => new sfWidgetFormInputPassword));

    $this->widgetSchema->setNameFormat('configure[%s]');
  }
}
