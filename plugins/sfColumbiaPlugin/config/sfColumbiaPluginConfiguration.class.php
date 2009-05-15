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
  /**
   * @see sfPluginConfiguration
   */
  public function configure()
  {
    $this->summary = 'Fixed width theme in shades of blue, with header image from Columbia Street, New Westminster (1907).';
    $this->version = '1.0.0';
  }

  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    $context->getResponse()->addStylesheet('/sfColumbiaPlugin/css/style.css');
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
