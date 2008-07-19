<?php

class sfInstallPluginConfigureAction extends sfAction
{
  // TODO: Load values from existing database configuration
  public function execute($request)
  {
    $this->database = array();
    $this->form = new sfInstallConfigureForm;

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('configure'));

      if ($this->form->isValid())
      {
        $this->database = sfInstall::configureDatabase($this->form->getValue('database_name'), $this->form->getValue('database_username'), $this->form->getValue('database_password'));

        if (count($this->database) < 1)
        {
          $this->redirect(array('module' => 'sfInstallPlugin', 'action' => 'load'));
        }
      }
    }
    else
    {
      $configuration = sfPropelDatabase::getConfiguration();
      $this->form->setDefault('database_name', $configuration['propel']['datasources']['propel']['connection']['database']);
      $this->form->setDefault('database_username', $configuration['propel']['datasources']['propel']['connection']['username']);
      $this->form->setDefault('database_password', $configuration['propel']['datasources']['propel']['connection']['password']);
    }
  }
}
