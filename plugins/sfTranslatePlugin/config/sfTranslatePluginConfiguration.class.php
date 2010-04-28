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
  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    $context->response->addJavaScript('/vendor/jquery');
    $context->response->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/jquery.once.js');
    $context->response->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $context->response->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/textarea');
    $context->response->addJavaScript('/sfTranslatePlugin/js/l10n_client');

    $context->response->addStylesheet('/sfTranslatePlugin/css/l10n_client');
  }

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));

    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules[] = 'sfTranslatePlugin';
    sfConfig::set('sf_enabled_modules', $enabledModules);
  }
}
