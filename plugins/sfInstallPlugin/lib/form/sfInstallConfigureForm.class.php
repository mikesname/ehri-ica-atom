<?php

/*
 */

class sfInstallConfigureForm extends sfForm
{
  public function configure()
  {
    $this->setValidators(array(
      'database_name' => new sfValidatorString,
      'database_username' => new sfValidatorString,
      'database_password' => new sfValidatorString(array('required' => false))));

    $this->setWidgets(array(
      'database_name' => new sfWidgetFormInput,
      'database_username' => new sfWidgetFormInput,
      'database_password' => new sfWidgetFormInputPassword(array('always_render_empty' => true))));

    // FIXME: This should be done in ProjectConfiguration::setup()
    $this->widgetSchema->addFormFormatter('qubit', new QubitWidgetFormSchemaFormatter($this->widgetSchema));
    $this->widgetSchema->setFormFormatterName('qubit');

    $this->widgetSchema->setHelps(array(
      'database_name' => 'The name of the <em>mysqli</em> database your data will be stored in.  It must exist on your server before '.sfConfig::get('app_name', 'Qubit').' can be installed.'));


    $this->widgetSchema->setNameFormat('configure[%s]');
  }
}
