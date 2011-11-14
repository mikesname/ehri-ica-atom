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
    $summary = 'New theme plugin made from scratch. JavaScript is necessary. Tested in Internet Explorer 9, Safari 5, Chrome 10 and Firefox 4.',
    $version = '1.0.0';

  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    // Development
    // $context->response->addJavaScript('/plugins/qtTrilliumPlugin/vendor/less/dist/less-1.1.4.js');
    // $context->response->addStylesheet('/plugins/qtTrilliumPlugin/css/main.less', 'last', array('rel' => 'stylesheet/less', 'type' => '', 'media' => ''));

    // Trillium CSS file generated with lessc
    $context->response->addJavaScript('/plugins/qtTrilliumPlugin/js/trillium');
    $context->response->addStylesheet('/plugins/qtTrilliumPlugin/css/less/main.css', 'last', array('media' => 'all'));
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
