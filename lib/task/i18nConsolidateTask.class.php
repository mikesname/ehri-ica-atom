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

/**
 * Restore i18n strings lost when XLIFF files were broken into plugin-specific
 * directories
 *
 * @package    symfony
 * @subpackage task
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class i18nConsolidateTask extends sfBaseTask
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
    $this->name = 'consolidate';
    $this->briefDescription = 'Combine all application messages into a single output (XLIFF) file for ease of use by translators';

    $this->detailedDescription = <<<EOF
Combine all application messages into a single output (XLIFF) file for ease of use by translators.
EOF;
  }

  /**
   * @see sfTask
   */
  public function execute($arguments = array(), $options = array())
  {
    $this->logSection('i18n', sprintf('Consolidating *%s* i18n messages', $arguments['culture']));

    // get i18n configuration from factories.yml
    $config = sfFactoryConfigHandler::getConfiguration($this->configuration->getConfigPaths('config/factories.yml'));

    $class = $config['i18n']['class'];
    $params = $config['i18n']['param'];
    unset($params['cache']);

    // Extract i18n messages from php files (including plugins)
    $i18n = new $class($this->configuration, new sfNoCache(), $params);
    $extract = new sfI18nConsolidatedExtract($i18n, $arguments['culture']);
    $extract->extract();

    // Save to app/qubit/i18n/consolidated
    $consolidated = new $class($this->configuration, new sfNoCache(), $params);
    $consolidated->setMessageSource(array(sfConfig::get('sf_web_dir').'/i18n/consolidated'), $arguments['culture']);
    $consolidated->getMessageSource()->setCulture($arguments['culture']);
    $extract->save($consolidated);
  }
}

class sfI18nConsolidatedExtract extends sfI18nApplicationExtract
{
  protected $messageSource = array();

  public function configure()
  {
    // Override sfI18nAcpplicationExtract::configure() so we extract from
    // plugin XLIFF files
  }

  public function save($consolidated)
  {
    $messages = array();
    $translates = array();

    foreach ($this->i18n->getMessageSource()->read() as $catalogue => $translations)
    {
      foreach ($translations as $key => $values)
      {
        $messages[] = $key;

        // build associative array containing translated values
        if (!isset($translates[$key]) || 0 == strlen($translates[$key][0]))
        {
          $translates[$key] = $values;
        }
      }
    }

    // Sort and remove duplicates
    $messages = array_unique($messages);
    sort($messages);

    // Add sources to XLIFF file
    foreach ($messages as $message)
    {
      $consolidated->getMessageSource()->append($message);
    }

    // Save all sources to consolidated i18n file
    $consolidated->getMessageSource()->save();

    // Now save translated strings
    foreach ($translates as $key => $item)
    {
      // Track source file for message in comments
      $comment = $item[2];
      if (isset($this->sourceFile[$key]))
      {
        $comment = $this->sourceFile[$key];
      }

      $consolidated->getMessageSource()->update($key, $item[0], $comment);
    }
  }

  public function extract()
  {
    // Add global templates
    $this->extractFromPhpFiles(sfConfig::get('sf_app_template_dir'));

    // Add global librairies
    $this->extractFromPhpFiles(sfConfig::get('sf_app_lib_dir'));

    // Add forms
    $this->extractFromPhpFiles(sfConfig::get('sf_lib_dir').'/form');

    // Extract from modules
    $modules = sfFinder::type('dir')->maxdepth(0)->in(sfConfig::get('sf_app_module_dir'));
    foreach ($modules as $module)
    {
      $this->extractFromPhpFiles(array(
        $module.'/actions',
        $module.'/lib',
        $module.'/templates',
      ));
    }

    // Extract plugin strings
    $plugins = sfFinder::type('dir')->maxdepth(0)->not_name('.')->in(sfConfig::get('sf_plugins_dir'));
    foreach ($plugins as $plugin)
    {
      foreach (sfFinder::type('dir')->maxdepth(0)->in($plugin.'/modules') as $piModule)
      {
        $this->extractFromPhpFiles(array(
          $piModule.'/actions',
          $piModule.'/lib',
          $piModule.'/templates',
        ));
      }
    }
  }

  /**
   * Extracts i18n strings from PHP files.
   *
   * @param string $dir The PHP full path name
   */
  protected function extractFromPhpFiles($dir)
  {
    $phpExtractor = new sfI18nPhpExtractor();

    $files = sfFinder::type('file')->name('*.php');
    $messages = array();
    foreach ($files->in($dir) as $file)
    {
      $extracted = $phpExtractor->extract(file_get_contents($file));
      $messages = array_merge($messages, $extracted);

      // Track source file for all messages
      foreach ($extracted as $message)
      {
        if (!isset($this->sourceFile[$message]))
        {
          // Link to file in googlecode repository
          $this->sourceFile[$message] = str_replace(sfConfig::get('sf_web_dir'), 'http://code.google.com/p/qubit-toolkit/source/browse/trunk', $file);
        }
      }
    }

    $this->updateMessages($messages);
  }
}
