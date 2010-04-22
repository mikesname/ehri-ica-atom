<?php

/*
 */

class sfPluginAdminPluginIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, 'plugins');
    if (1 == count($query = QubitSetting::get($criteria)))
    {
      $setting = $query[0];

      $this->form->setDefault('enabled', unserialize($setting->__get('value', array('sourceCulture' => true))));
    }

    $configuration = sfProjectConfiguration::getActive();
    $pluginPaths = $configuration->getAllPluginPaths();
    foreach (sfPluginAdminPluginConfiguration::$pluginNames as $name)
    {
      unset($pluginPaths[$name]);
    }

    $this->plugins = array();
    foreach ($pluginPaths as $name => $path)
    {
      $className = $name.'Configuration';
      if (sfConfig::get('sf_plugins_dir') == substr($path, 0, strlen(sfConfig::get('sf_plugins_dir'))) && is_readable($classPath = $path.'/config/'.$className.'.class.php'))
      {
        $this->installPluginAssets($name, $path);

        require_once $classPath;
        $this->plugins[$name] = new $className($configuration);
      }
    }

    if ($request->isMethod('post'))
    {
      $this->form->setValidators(array(
        'enabled' => new sfValidatorChoice(array('choices' => array_keys($this->plugins), 'empty_value' => array(), 'multiple' => true))));

      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        if (1 != count($query))
        {
          $setting = new QubitSetting;
          $setting->name = 'plugins';
        }

        $setting->__set('value', serialize($this->form->getValue('enabled')), array('sourceCulture' => true));
        $setting->save();

        $this->redirect(array('module' => 'sfPluginAdminPlugin'));
      }
    }
  }

  // Copied from sfPluginPublishAssetsTask
  protected function installPluginAssets($name, $path)
  {
    $webDir = $path.'/web';

    if (is_dir($webDir))
    {
      $filesystem = new sfFilesystem;
      $filesystem->relativeSymlink($webDir, sfConfig::get('sf_web_dir').'/'.$name, true);
    }
  }
}
