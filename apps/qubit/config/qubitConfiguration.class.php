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

class qubitConfiguration extends sfApplicationConfiguration
{
  const VERSION = '1.0.9';

  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, 'siteTitle');

    try
    {
      if (1 == count($query = QubitSetting::get($criteria)))
      {
        $context->response->addMeta('title', $query[0]->__get('value', array('cultureFallback' => true)));
      }
    }
    catch (PropelException $e)
    {
      // Silently swallow PropelException in install
      if ('sfInstallPlugin' != $context->request->module)
      {
        throw $e;
      }
    }

    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, 'siteDescription');

    try
    {
      if (1 == count($query = QubitSetting::get($criteria)))
      {
        $context->response->addMeta('description', $query[0]->__get('value', array('cultureFallback' => true)));
      }
    }
    catch (PropelException $e)
    {
      // Silently swallow PropelException in install
      if ('sfInstallPlugin' != $context->request->module)
      {
        throw $e;
      }
    }

    foreach (array('actor_template', 'informationobject_template', 'repository_template') as $name)
    {
      if (isset($context->request[$name]))
      {
        $context->routing->setDefaultParameter($name, $context->request[$name]);
      }
      else
      {
        $criteria = new Criteria;
        $criteria->add(QubitSetting::NAME, substr($name, 0, -9));
        $criteria->add(QubitSetting::SCOPE, 'default_template');

        try
        {
          if (1 == count($query = QubitSetting::get($criteria)))
          {
            $context->routing->setDefaultParameter($name, $query[0]->__get('value', array('sourceCulture' => true)));
          }
        }
        catch (PropelException $e)
        {
          // Silently swallow PropelException in install
          if ('sfInstallPlugin' != $context->request->module)
          {
            throw $e;
          }
        }
      }
    }
  }

  public function responseFilterContent(sfEvent $event, $content)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Javascript');

    return str_ireplace('</head>', javascript_tag('jQuery.extend(Qubit, '.json_encode(array('relativeUrlRoot' => sfContext::getInstance()->request->getRelativeUrlRoot())).');').'</head>', $content);
  }

  public function configure()
  {
    $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));
    $this->dispatcher->connect('response.filter_content', array($this, 'responseFilterContent'));
  }

  /**
   * @see sfApplicationConfiguration
   */
  public function getControllerDirs($moduleName)
  {
    if (!isset($this->cache['getControllerDirs'][$moduleName]))
    {
      $this->cache['getControllerDirs'][$moduleName] = array();

      // HACK Currently plugins only override application templates, not the
      // other way around
      foreach ($this->getPluginSubPaths('/modules/'.$moduleName.'/actions') as $dir)
      {
        $this->cache['getControllerDirs'][$moduleName][$dir] = false; // plugins
      }

      $this->cache['getControllerDirs'][$moduleName][sfConfig::get('sf_app_module_dir').'/'.$moduleName.'/actions'] = false; // application
    }

    return $this->cache['getControllerDirs'][$moduleName];
  }

  /**
   * @see sfApplicationConfiguration
   */
  public function getDecoratorDirs()
  {
    $dirs = sfConfig::get('sf_decorator_dirs');
    $dirs[] = sfConfig::get('sf_app_template_dir');

    return $dirs;
  }

  /**
   * @see sfApplicationConfiguration
   */
  public function getTemplateDirs($moduleName)
  {
    // HACK Currently plugins only override application templates, not the
    // other way around
    $dirs = $this->getPluginSubPaths('/modules/'.$moduleName.'/templates');
    $dirs[] = sfConfig::get('sf_app_module_dir').'/'.$moduleName.'/templates';

    $dirs = array_merge($dirs, $this->getDecoratorDirs());

    return $dirs;
  }

  /**
   * @see sfProjectConfiguration
   */
  public function setRootDir($path)
  {
    parent::setRootDir($path);

    $this->setWebDir($path);
  }
}
