<?php

/**
 * sfTranslatePlugin configuration.
 * 
 * @package     sfTranslatePlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id$
 */
class sfTranslatePluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules[] = 'sfTranslatePlugin';
    sfConfig::set('sf_enabled_modules', $enabledModules);
  }
}
