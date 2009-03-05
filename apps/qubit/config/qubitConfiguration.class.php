<?php

class qubitConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
  }

  public function getDecoratorDirs()
  {
    $dirs = array();
    $dirs = array_merge($dirs, $this->getPluginSubPaths('/templates')); // plugins
    $dirs[] = sfConfig::get('sf_app_template_dir');

    return $dirs;
  }
}
