<?php

class qubitConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
  }

  public function checkLock()
  {
    // TODO: Work around two problems: 1) the disable / enable tasks put the
    // lock file in the root directory instead of the cache directory and 2)
    // sfApplicationConfiguration::checkLock() removes the lock file after five
    // seconds.
    if (sfToolkit::hasLockFile(sfConfig::get('sf_root_dir').'/'.$this->getApplication().'_'.$this->getEnvironment().'.lck'))
    {
      include(sfConfig::get('sf_web_dir').'/errors/unavailable.php');

      die(1);
    }
  }
}
