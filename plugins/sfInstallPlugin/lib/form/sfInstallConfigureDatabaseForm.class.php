<?php

/*
 */

class sfInstallConfigureDatabaseForm extends sfForm
{
  public function configure()
  {
    // TODO: Can we avoid hardcoding the database name?
    $database = sfContext::getInstance()->getDatabaseManager()->getDatabase('propel');

    $this->setDefaults(array(
      'databaseUsername' => $database->getParameter('username'),
      'databasePassword' => $database->getParameter('password')));

    // TODO: This should be handled by sfPdoDatabase::parseDsn()
    $pattern = '/([^=]*)=([^;]*);?/';
    $subject = preg_replace('/[^:]*:/', null, $database->getParameter('dsn'));
    if (false === preg_match_all($pattern, $subject, $matches))
    {
      // TODO: Error handling
    }

    $parameters = array_combine($matches[1], $matches[2]);

    if (isset($parameters['dbname']))
    {
      $this->setDefault('databaseName', $parameters['dbname']);
    }

    if (isset($parameters['host']))
    {
      $this->setDefault('databaseHost', $parameters['host']);
    }

    if (isset($parameters['port']))
    {
      $this->setDefault('databasePort', $parameters['port']);
    }

    $this->setValidators(array(
      'databaseName' => new sfValidatorString,
      'databaseUsername' => new sfValidatorString(array('required' => false)),
      'databasePassword' => new sfValidatorString(array('required' => false)),
      'databaseHost' => new sfValidatorString,
      'databasePort' => new sfValidatorString(array('required' => false)),
      'tablePrefix' => new sfValidatorString(array('required' => false))));

    $this->setWidgets(array(
      'databaseName' => new sfWidgetFormInput,
      'databaseUsername' => new sfWidgetFormInput,
      'databasePassword' => new sfWidgetFormInputPassword(array('always_render_empty' => true)),
      'databaseHost' => new sfWidgetFormInput,
      'databasePort' => new sfWidgetFormInput,
      'tablePrefix' => new sfWidgetFormInput));

    $this->widgetSchema->setHelps(array(
      'databaseName' => 'The name of the <em>MySQL</em> database your data will be stored in.  It must exist on your server before '.sfContext::getInstance()->getResponse()->getTitle().' can be installed.',
      'databaseHost' => 'If your database is located on a different server, change this.',
      'databasePort' => 'If your database server is listening to a non-standard port, enter its number.',
      'tablePrefix' => 'If more than one application will be sharing this database, enter a table prefix such as <em>'.strtolower(sfContext::getInstance()->getResponse()->getTitle()).'_</em> for your site here.'));

    $this->widgetSchema->setNameFormat('configure[%s]');
  }
}
