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
  public function contextLoadFactories(sfEvent $event)
  {
    $context = $event->getSubject();

    // Go no further if a database connection does not exist, for example in
    // install
    if (!sfConfig::get('sf_use_database'))
    {
      return;
    }

    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, 'siteTitle');
    if (1 == count($query = QubitSetting::get($criteria)))
    {
      $context->getResponse()->addMeta('title', $query[0]->__get('value', array('cultureFallback' => true)));
    }

    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, 'siteDescription');
    if (1 == count($query = QubitSetting::get($criteria)))
    {
      $context->getResponse()->addMeta('description', $query[0]->__get('value', array('cultureFallback' => true)));
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
        if (1 == count($query = QubitSetting::get($criteria)))
        {
          $context->routing->setDefaultParameter($name, $query[0]->__get('value', array('sourceCulture' => true)));
        }
      }
    }

    $context->routing->insertRouteBefore('default', 'informationObject/create', new sfRoute('/informationobject/create/:informationobject_template', array('module' => 'informationobject', 'action' => 'create', 'parent' => array('default' => $context->routing->generate(null, array('module' => 'informationobject', 'action' => 'show', 'id' => QubitInformationObject::ROOT_ID))))));
  }

  public function responseFilterContent(sfEvent $event, $content)
  {
    $this->loadHelpers('Javascript');

    return str_ireplace('</head>', javascript_tag('jQuery.extend(Qubit, '.json_encode(array('relativeUrlRoot' => sfContext::getInstance()->request->getRelativeUrlRoot())).');').'</head>', $content);
  }

  public function configure()
  {
    $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));
    $this->dispatcher->connect('response.filter_content', array($this, 'responseFilterContent'));
  }

  public function getDecoratorDirs()
  {
    $dirs = array();
    $dirs = array_merge($dirs, (array) sfConfig::get('sf_decorator_dirs'));
    $dirs[] = sfConfig::get('sf_app_template_dir');

    return $dirs;
  }
}
