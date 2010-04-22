<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony
 * @subpackage i18n
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfI18nApplicationExtract.class.php 14872 2009-01-19 08:32:06Z fabien $
 */
class sfI18nPluginExtract extends sfI18nExtract
{
  protected
    $extracts;

  /**
   * @see sfI18nExtract
   */
  public function configure()
  {
    if (!isset($this->parameters['path']))
    {
      throw new sfException('You must give a "path" parameter when extracting for a plugin.');
    }

    $this->i18n->setMessageSource(array($this->parameters['path'].'/i18n'), $this->culture);

    $this->extracts = array();

    // Modules
    foreach (sfFinder::type('dir')->maxdepth(0)->relative()->in($this->parameters['path'].'/modules') as $name)
    {
      $this->extracts[] = new sfI18nModuleExtract($this->i18n, $this->culture, array('module' => $name, 'path' => $this->parameters['path'].'/modules/'.$name));
    }
  }

  /**
   * @see sfI18nExtract
   */
  public function extract()
  {
    foreach ($this->extracts as $extract)
    {
      $extract->extract();
    }
  }

  protected function aggregateMessages($name)
  {
    $messages = array();
    foreach ($this->extracts as $extract)
    {
      $messages = array_merge($messages, $extract->$name());
    }

    return array_unique($messages);
  }

  /**
   * @see sfI18nExtract
   */
  public function getCurrentMessages()
  {
    return $this->aggregateMessages('getCurrentMessages');
  }

  /**
   * @see sfI18nExtract
   */
  public function getAllSeenMessages()
  {
    return $this->aggregateMessages('getAllSeenMessages');
  }
}
