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

class sfPluginAdminPluginPluginsAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    if (!$this->context->user->hasCredential('administrator'))
    {
      QubitAcl::forwardUnauthorized();
    }

    $criteria = new Criteria;
    $criteria->add(QubitSetting::NAME, 'plugins');
    if (1 == count($query = QubitSetting::get($criteria)))
    {
      $setting = $query[0];

      $this->form->setDefault('enabled', unserialize($setting->__get('value', array('sourceCulture' => true))));
    }

    $configuration = ProjectConfiguration::getActive();
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

        $class = new $className($configuration);

        // Build a list of plugins
        if (isset($class::$summary) && 0 === preg_match('/theme/i', $class::$summary))
        {
          $this->plugins[$name] = $class;
        }
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

        $settings = unserialize($setting->__get('value', array('sourceCulture' => true)));

        foreach (array_keys($this->plugins) as $item)
        {
          if (in_array($item, (array)$this->form->getValue('enabled')))
          {
            $settings[] = $item;
          }
          else
          {
            if (false !== $key = array_search($item, $settings))
            {
              unset($settings[$key]);
            }
          }
        }

        $setting->__set('value', serialize(array_unique($settings)));
        $setting->save();

        $this->redirect(array('module' => 'sfPluginAdminPlugin', 'action' => 'plugins'));
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
