<?php

/*
 */

class sfInstallPluginConfigureDatabaseAction extends sfAction
{
  // TODO Load values from existing database configuration
  public function execute($request)
  {
    $this->database = array();

    $this->form = new sfForm;

    $this->form->setValidator('databaseHost', new sfValidatorString);
    $this->form->setWidget('databaseHost', new sfWidgetFormInput);

    $this->form->setDefault('databaseName', 'qubit');
    $this->form->setValidator('databaseName', new sfValidatorString(array('required' => true)));
    $this->form->setWidget('databaseName', new sfWidgetFormInput);

    $this->form->setValidator('databasePassword', new sfValidatorString);
    $this->form->setWidget('databasePassword', new sfWidgetFormInputPassword);

    $this->form->setValidator('databasePort', new sfValidatorString);
    $this->form->setWidget('databasePort', new sfWidgetFormInput);

    $this->form->setDefault('databaseUsername', 'root');
    $this->form->setValidator('databaseUsername', new sfValidatorString);
    $this->form->setWidget('databaseUsername', new sfWidgetFormInput);

    $this->form->setValidator('tablePrefix', new sfValidatorString);
    $this->form->setWidget('tablePrefix', new sfWidgetFormInput);

    if (!isset($this->context->databaseManager))
    {
      $this->context->databaseManager = new sfDatabaseManager(sfProjectConfiguration::getActive());
    }

    try
    {
      // TODO Can we avoid hardcoding the database name?
      $database = $this->context->databaseManager->getDatabase('propel');

      // TODO This should be handled by sfPdoDatabase::parseDsn()
      $pattern = '/([^=]*)=([^;]*);?/';
      $subject = preg_replace('/[^:]*:/', null, $database->getParameter('dsn'));
      if (false === preg_match_all($pattern, $subject, $matches))
      {
        // TODO Error handling
      }

      $parameters = array_combine($matches[1], $matches[2]);

      if (isset($parameters['host']))
      {
        $this->form->setDefault('databaseHost', $parameters['host']);
      }

      if (isset($parameters['dbname']))
      {
        $this->form->setDefault('databaseName', $parameters['dbname']);
      }

      $this->form->setDefault('databasePassword', $database->getParameter('password'));

      if (isset($parameters['port']))
      {
        $this->form->setDefault('databasePort', $parameters['port']);
      }

      $this->form->setDefault('databaseUsername', $database->getParameter('username'));
    }
    catch (sfDatabaseException $e)
    {
    }

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->database = sfInstall::configureDatabase($this->form->getValues());
        if (count($this->database) < 1)
        {
          $this->redirect(array('module' => 'sfInstallPlugin', 'action' => 'loadData'));
        }
      }
    }
  }
}
