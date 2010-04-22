<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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

class sfColumbiaPluginConfiguration extends sfPluginConfiguration
{
  public static
    $summary = 'Theme plugin. Adaptation of fixed width Classic theme using shades of blue and drop-down menus. Includes a header image from Columbia Street, New Westminster (1907).',
    $version = '1.0.0';

  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    $context->response->addStylesheet('/sfClassicPlugin/css/main', 'last', array('media' => 'all'));
    $context->response->addStylesheet('/sfCaribouPlugin/css/style', 'last', array('media' => 'all'));
    $context->response->addStylesheet('/sfColumbiaPlugin/css/style', 'last', array('media' => 'all'));

    $context->response->addStylesheet('/sfCaribouPlugin/css/print', 'last', array('media' => 'print'));

    $context->response->addStylesheet('/sfCaribouPlugin/css/print-ie', 'last', array('condition' => 'IE', 'media' => 'print'));

    $context->response->addJavaScript('/sfCaribouPlugin/js/navigation', 'last');
  }

  /**
   * @see sfPluginConfiguration
   */
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
