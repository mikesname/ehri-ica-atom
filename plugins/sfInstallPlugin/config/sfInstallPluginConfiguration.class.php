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
  public function controllerChangeAction(sfEvent $event)
  {
    if ('sfInstallPlugin' != $event->module)
    {
      return;
    }

    $credential = $event->getSubject()->getActionStack()->getLastEntry()->getActionInstance()->getCredential();

    try
    {
      new sfDatabaseManager($this->configuration);
    }
    catch (sfConfigurationException $e)
    {
      sfContext::getInstance()->user->addCredential($credential);

      return;
    }

    if (sfContext::getInstance()->user->hasCredential($credential))
    {
      return;
    }

    $criteria = new Criteria;
    $criteria->add(QubitAclGroupI18n::NAME, $credential);
    $criteria->addJoin(QubitAclGroupI18n::ID, QubitAclGroup::ID);
    $criteria->addJoin(QubitAclGroup::ID, QubitAclUserGroup::GROUP_ID);
    $criteria->addJoin(QubitAclUserGroup::USER_ID, QubitUser::ID);
    if (1 > count(QubitUser::get($criteria)))
    {
      return;
    }

    $event->getSubject()->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));

    throw new sfStopException;
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
    // Setup for test if this is the install.php front controller
    foreach (array('SCRIPT_NAME', 'ORIG_SCRIPT_NAME') as $key)
    {
      if (isset($_SERVER[$key]))
      {
        $scriptName = $_SERVER[$key];

        break;
      }
    }

    $installScriptName = sfConfig::get('sf_relative_url_root', preg_replace('/\/[^\/]+\.php5?$/', null, $scriptName)).'/install.php';

    if ($installScriptName == $scriptName)
    {
      sfConfig::set('sf_no_script_name', false);
      sfConfig::set('sf_use_database', false);
    }
    else
    {
      // All other front controllers test that a database connection can be
      // made and redirect to the install.php front controller if not
      if (sfConfig::get('sf_use_database'))
      {
        try
        {
          new sfDatabaseManager($this->configuration);
        }
        catch (sfConfigurationException $e)
        {
          $installUrl = $installScriptName.'/;sfInstallPlugin';

          header('Location: '.$installUrl);

          echo '<html><head><meta http-equiv="refresh" content="0;url='.htmlspecialchars($installUrl, ENT_QUOTES, sfConfig::get('sf_charset')).'" /></head></html>';

          // Going any further may stop this redirect
          exit;
        }
      }
    }

    // Enable sfInstallPlugin module
    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules[] = 'sfInstallPlugin';
    sfConfig::set('sf_enabled_modules', $enabledModules);

    $this->dispatcher->connect('controller.change_action', array($this, 'controllerChangeAction'));

    // Connect event listener to add routes
    $this->dispatcher->connect('routing.load_configuration', array($this, 'routingLoadConfiguration'));
  }
}
