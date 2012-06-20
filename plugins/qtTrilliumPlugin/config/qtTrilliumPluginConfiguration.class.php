<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Qubit Toolkit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qubit Toolkit.  If not, see <http://www.gnu.org/licenses/>.
 */

class qtTrilliumPluginConfiguration extends sfPluginConfiguration
{
  public static
    $summary = 'Theme plugin made from scratch with some JavaScript magic. Cross-browser compatibility tested. Based in Twitter Bootstrap 1.4, 940px two-column layout, slightly responsive.',
    $version = '1.0.0';

  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    // Set to true when you are writing new CSS code in Trillium
    // Remember to avoid localStorage caching when dev machine is not localhost
    $dev = false;

    // Runtime less interpreter will be loaded
    if ($dev)
    {
      $context->response->addJavaScript('/plugins/qtTrilliumPlugin/vendor/less/dist/less-1.2.2.js');
      $context->response->addStylesheet('/plugins/qtTrilliumPlugin/css/main.less', 'last', array('rel' => 'stylesheet/less', 'type' => '', 'media' => ''));
    }
    else
    {
      $context->response->addStylesheet('/plugins/qtTrilliumPlugin/css/less/main.css', 'last', array('media' => 'all'));
    }

    // Add Trillium specific JavaScript behaviours
    $context->response->addJavaScript('/plugins/qtTrilliumPlugin/js/trillium', 'last');

    // Try to avoid the compatibility view, use always the last engine version
    $context->response->addHttpMeta('X-UA-Compatible', 'IE=edge');
  }

  public function initialize()
  {
    $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));

    $decoratorDirs = sfConfig::get('sf_decorator_dirs');
    $decoratorDirs[] = $this->rootDir.'/templates';
    sfConfig::set('sf_decorator_dirs', $decoratorDirs);

    $moduleDirs = sfConfig::get('sf_module_dirs');
    $moduleDirs[$this->rootDir.'/modules'] = false;
    sfConfig::set('sf_module_dirs', $moduleDirs);
  }
}
