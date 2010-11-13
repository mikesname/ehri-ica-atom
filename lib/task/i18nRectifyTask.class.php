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

/**
 * Restore i18n strings lost when XLIFF files were broken into plugin-specific
 * directories
 *
 * @package    symfony
 * @subpackage task
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class i18nRectifyTask extends sfBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('culture', sfCommandArgument::REQUIRED, 'The target culture'),
    ));

    $this->addOptions(array(

      // http://trac.symfony-project.org/ticket/8352
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', true),
    ));

    $this->namespace = 'i18n';
    $this->name = 'rectify';
    $this->briefDescription = 'Copy i18n target messages from application source to plugin source. This prevents losing translated string in the fragmentation of application message source into multiple plugin message sources.';

    $this->detailedDescription = <<<EOF
FIXME
EOF;
  }

  /**
   * @see sfTask
   */
  public function execute($arguments = array(), $options = array())
  {
    $this->logSection('i18n', sprintf('Rectifying existing i18n strings for the "%s" application', $options['application']));

    // get i18n configuration from factories.yml
    $config = sfFactoryConfigHandler::getConfiguration($this->configuration->getConfigPaths('config/factories.yml'));

    $class = $config['i18n']['class'];
    $params = $config['i18n']['param'];
    unset($params['cache']);

    // Get current (saved) messages from ALL sources (app and plugin)
    $this->i18n = new $class($this->configuration, new sfNoCache(), $params);
    $this->i18n->getMessageSource()->setCulture($arguments['culture']);
    $this->i18n->getMessageSource()->load();

    $currentMessages = array();
    foreach ($this->i18n->getMessageSource()->read() as $catalogue => $translations)
    {
      $currentMessages += $translations;
    }

    // Loop through plugins
    $pluginNames = sfFinder::type('dir')->maxdepth(0)->relative()->not_name('.')->in(sfConfig::get('sf_plugins_dir'));
    foreach ($pluginNames as $pluginName)
    {
      $this->logSection('i18n', sprintf('rectifying %s plugin strings', $pluginName));

      $messageSource = sfMessageSource::factory($config['i18n']['param']['source'], sfConfig::get('sf_plugins_dir').'/'.$pluginName.'/i18n');
      $messageSource->setCulture($arguments['culture']);
      $messageSource->load();

      // If the current plugin source *doesn't* have a translation, then try
      // and get translated value from $currentMessages
      foreach($messageSource->read() as $catalogue => $translations)
      {
        foreach ($translations as $key => &$value)
        {
          if (0 == strlen($value[0]) && 0 < strlen($currentMessages[$key][0]))
          {
            $messageSource->update($key, $currentMessages[$key][0], $value[2]);
          }
        }
      }

      $messageSource->save();
    }
  }
}
