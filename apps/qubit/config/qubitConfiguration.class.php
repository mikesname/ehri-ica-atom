<?php

class qubitConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
  }

  public function getDecoratorDirs()
  {
    $dirs = array();
    $dirs = array_merge($dirs, sfConfig::get('sf_decorator_dirs'));
    $dirs[] = sfConfig::get('sf_app_template_dir');

    return $dirs;
  }
}
