<?php

class qubitConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    // Add Zend to our include_path for Lucene, until we use sfLucenePlugin
    set_include_path(get_include_path().PATH_SEPARATOR.sfConfig::get('sf_lib_dir').'/vendor');
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
