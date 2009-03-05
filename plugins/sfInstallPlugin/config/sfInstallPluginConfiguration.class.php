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
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules[] = 'sfInstallPlugin';
    sfConfig::set('sf_enabled_modules', $enabledModules);

    $this->dispatcher->connect('application.throw_exception', array('sfInstall', 'applicationThrowException'));
    $this->dispatcher->connect('routing.load_configuration', array('sfInstall', 'routingLoadConfiguration'));
  }
}
