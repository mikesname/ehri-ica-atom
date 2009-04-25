<?php

/**
 * sfPluginAdminPlugin configuration.
 *
 * @package     sfPluginAdminPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id$
 */
class sfPluginAdminPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $enabledModules = sfConfig::get('sf_enabled_modules');
    $enabledModules[] = 'sfPluginAdminPlugin';
    sfConfig::set('sf_enabled_modules', $enabledModules);

    // Go no further if a database connection does not exist, for example in
    // install
    if (!sfConfig::get('sf_use_database'))
    {
      return;
    }

    // Copied from sfBaseTask::createConfiguration(), add project classes like
    // QubitSetting to the autoloader
    if (!$this->configuration instanceof sfApplicationConfiguration)
    {
      $autoloader = sfSimpleAutoload::getInstance(sfConfig::get('sf_cache_dir').'/project_autoload.cache');
      $autoloader->addFiles(sfFinder::type('file')->prune('symfony')->follow_link()->name('*.php')->in(sfConfig::get('sf_lib_dir')));
      $autoloader->register();
    }

    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, 'plugins');
    if (1 == count($query = QubitSetting::get($criteria)))
    {
      $setting = $query[0];

      $pluginPaths = $this->configuration->getAllPluginPaths();
      foreach (unserialize($setting->__get('value', array('sourceCulture' => true))) as $name)
      {
        if (!isset($pluginPaths[$name]))
        {
          throw new InvalidArgumentException('The plugin "'.$name.'" does not exist.');
        }

        // Copied from sfProjectConfiguration::loadPlugins()
        $className = $name.'Configuration';
        if (!is_readable($path = $pluginPaths[$name].'/config/'.$className.'.class.php'))
        {
          $configuration = new sfPluginConfigurationGeneric($this->configuration, $pluginPaths[$name], $name);
        }
        else
        {
          require_once $path;
          $configuration = new $className($this->configuration, $pluginPaths[$name], $name);
        }

        $configuration->initialize();
      }
    }
  }
}
