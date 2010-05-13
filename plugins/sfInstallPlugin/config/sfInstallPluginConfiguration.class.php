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

    if ('sfInstallPlugin' != $context->request->module)
    {
      $context->controller->redirect(array('module' => 'sfInstallPlugin'));
    }
  }

  public function controllerChangeAction(sfEvent $event)
  {
    $controller = $event->getSubject();

    if ('sfInstallPlugin' != $event->module)
    {
      return;
    }

    $credential = $controller->getActionStack()->getLastEntry()->getActionInstance()->getCredential();

    if (!file_exists(sfConfig::get('sf_config_dir').'/config.php'))
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

    $routing->insertRouteBefore('default', 'sfInstallPlugin/help', new sfRoute('http://qubit-toolkit.org/wiki/index.php?title=Installer_warnings', array('module' => 'sfInstallPlugin', 'action' => 'help')));
  }

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if (!file_exists(sfConfig::get('sf_config_dir').'/config.php'))
    {
      sfConfig::set('sf_use_database', false);

      $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));
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
