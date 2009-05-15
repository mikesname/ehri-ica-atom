<?php

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
  }

  public function configure()
  {
    $this->dispatcher->connect('context.load_factories', array($this, 'contextLoadFactories'));
  }

  public function getDecoratorDirs()
  {
    $dirs = array();
    $dirs = array_merge($dirs, sfConfig::get('sf_decorator_dirs'));
    $dirs[] = sfConfig::get('sf_app_template_dir');

    return $dirs;
  }
}
