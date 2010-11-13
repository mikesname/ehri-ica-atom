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

class sfClassicPluginConfiguration extends sfPluginConfiguration
{
  public static
    $summary = 'Theme plugin.  The original ICA-AtoM 1.0 fixed width theme.',
    $version = '1.0.0';

  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    $context->response->addStylesheet('/plugins/sfClassicPlugin/css/main', 'last', array('media' => 'all'));
    $context->response->addStylesheet('/plugins/sfClassicPlugin/css/style', 'last', array('media' => 'all'));

    $context->response->addStylesheet('/plugins/sfCaribouPlugin/css/print', 'last', array('media' => 'print'));
    $context->response->addStylesheet('/plugins/sfClassicPlugin/css/print', 'last', array('media' => 'print'));

    $context->response->addStylesheet('/plugins/sfCaribouPlugin/css/print-ie', 'last', array('condition' => 'IE', 'media' => 'print'));
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
