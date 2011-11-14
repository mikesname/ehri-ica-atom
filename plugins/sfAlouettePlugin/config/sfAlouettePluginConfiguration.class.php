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

class sfAlouettePluginConfiguration extends sfPluginConfiguration
{
  public static
    $summary = 'Theme plugin.  A green version of the Columbia theme, without the header image.',
    $version = '1.0.0';

  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    $context->response->addStylesheet('/css/classic', 'last', array('media' => 'all'));
    $context->response->addStylesheet('/plugins/sfCaribouPlugin/css/style', 'last', array('media' => 'all'));
    $context->response->addStylesheet('/plugins/sfColumbiaPlugin/css/style', 'last', array('media' => 'all'));
    $context->response->addStylesheet('/plugins/sfAlouettePlugin/css/style', 'last', array('media' => 'all'));

    $context->response->addJavaScript('/plugins/sfCaribouPlugin/js/navigation', 'last');
  }

  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));

    $decoratorDirs = sfConfig::get('sf_decorator_dirs');
    $decoratorDirs[] = sfConfig::get('sf_plugins_dir').'/sfColumbiaPlugin/templates';
    $decoratorDirs[] = $this->rootDir.'/templates';
    sfConfig::set('sf_decorator_dirs', $decoratorDirs);

    $moduleDirs = sfConfig::get('sf_module_dirs');
    $moduleDirs[sfConfig::get('sf_plugins_dir').'/sfColumbiaPlugin/modules'] = false;
    $moduleDirs[$this->rootDir.'/modules'] = false;
    sfConfig::set('sf_module_dirs', $moduleDirs);
  }
}
