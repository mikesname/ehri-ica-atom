<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorChoice validates than the value is one of the expected values.
 *
 * @package    symfony
 * @subpackage validator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfValidatorChoice.class.php 11612 2008-09-17 15:28:38Z nicolas $
 */
class sfValidatorChoice extends sfValidatorBase
{
  /**
   * Configures the current validator.
   *
   * Available options:
   *
   *  * choices: An array of expected values (required)
   *
   * @param array $options    An array of options
   * @param array $messages   An array of error messages
   *
   * @see sfValidatorBase
   */
  protected function configure($options = array(), $messages = array())
  {
    $this->addRequiredOption('choices');
  }

  /**
   * @see sfValidatorBase
   */
  protected function doClean($value)
  {
    $choices = $this->getOption('choices');
    if ($choices instanceof sfCallable)
    {
      $choices = $choices->call();
    }

    if (!self::inChoices($value, $choices))
    {
      throw new sfValidatorError($this, 'invalid', array('value' => $value));
    }

    return $value;
  }

  /**
   * Checks if a value is part of given choices (see bug #4212)
   *
   * @param  mixed $value   The value to check
   * @param  array $choices The array of available choices
   *
   * @return Boolean
   */
  static protected function inChoices($value, array $choices = array())
  {
    foreach ($choices as $choice)
    {
      if ((string) $choice == (string) $value)
      {
        return true;
      }
    }

    return false;
  }
}
