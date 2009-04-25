<?php

/**
 * sfInstallPlugin configuration.
 * 
 * @package     sfInstallPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id$
 */
class sfInstallPluginConfiguration extends sfPluginConfiguration
{
  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    try
    {
      $context->databaseManager = new sfDatabaseManager($this->configuration);
    }
    catch (sfConfigurationException $e)
    {
    }
  }

  public function routingLoadConfiguration(sfEvent $event)
  {
    $routing = $event->getSubject();

    $routing->insertRouteBefore('default', 'sfInstallPlugin/help', new sfRoute('http://qubit-toolkit.org/wiki/index.php?title=Installer_Warnings', array('module' => 'sfInstallPlugin', 'action' => 'help')));
  }

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    foreach (array('SCRIPT_NAME', 'ORIG_SCRIPT_NAME') as $key)
    {
      if (isset($_SERVER[$key]))
      {
        $scriptName = $_SERVER[$key];

        break;
      }
    }

    $installScriptName = preg_replace('/\/[^\/]+\.php5?$/', '/install.php', $scriptName);
    if (0 < strlen($relativeUrlRoot = sfConfig::get('sf_relative_url_root')))
    {
      $installScriptName = $relativeUrlRoot.'/install.php';
    }

    if ($installScriptName == $scriptName)
    {
      if (sfConfig::get('sf_use_database'))
      {
        $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));
      }

      sfConfig::set('sf_no_script_name', false);
      sfConfig::set('sf_use_database', false);
    }
    else
    {
      if (sfConfig::get('sf_use_database'))
      {
        try
        {
          $databaseManager = new sfDatabaseManager($this->configuration);
        }
        catch (sfConfigurationException $e)
        {
          $installUrl = $installScriptName.'/sfInstallPlugin';

          header('Location: '.$installUrl);
          echo '<html><head><meta http-equiv="refresh" content="0;url='.htmlspecialchars($installUrl, ENT_QUOTES, sfConfig::get('sf_charset')).'" /></head></html>';
        }
      }
    }

    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules[] = 'sfInstallPlugin';
    sfConfig::set('sf_enabled_modules', $enabledModules);

    $this->dispatcher->connect('routing.load_configuration', array($this, 'routingLoadConfiguration'));
  }
}
