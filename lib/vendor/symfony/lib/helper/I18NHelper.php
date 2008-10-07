<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * I18NHelper.
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: I18NHelper.php 11700 2008-09-21 10:53:44Z fabien $
 */

function __($text, $args = array(), $catalogue = 'messages')
{
  if (sfConfig::get('sf_i18n'))
  {
    return sfContext::getInstance()->getI18N()->__($text, $args, $catalogue);
  }
  else
  {
    if (empty($args))
    {
      $args = array();
    }

    // replace object with strings
    foreach ($args as $key => $value)
    {
      if (is_object($value) && method_exists($value, '__toString'))
      {
        $args[$key] = $value->__toString();
      }
    }

    return strtr($text, $args);
  }
}

function format_number_choice($text, $args = array(), $number, $catalogue = 'messages')
{
  $translated = __($text, $args, $catalogue);

  $choice = new sfChoiceFormat();

  $retval = $choice->format($translated, $number);

  if ($retval === false)
  {
    throw new sfException(sprintf('Unable to parse your choice "%s".', $translated));
  }

  return $retval;
}

function format_country($country_iso, $culture = null)
{
  $c = sfCultureInfo::getInstance($culture === null ? sfContext::getInstance()->getUser()->getCulture() : $culture);
  $countries = $c->getCountries();

  if (!isset($countries[$country_iso]))
  {
    $c = new sfCultureInfo(sfConfig::get('sf_default_culture'));
    $countries = $c->getCountries();
  }

  return isset($countries[$country_iso]) ? $countries[$country_iso] : '';
}

function format_language($language_iso, $culture = null)
{
  $c = sfCultureInfo::getInstance($culture === null ? sfContext::getInstance()->getUser()->getCulture() : $culture);
  $languages = $c->getLanguages();

  if (!isset($languages[$language_iso]))
  {
    $c = new sfCultureInfo(sfConfig::get('sf_default_culture'));
    $languages = $c->getLanguages();
  }

  return isset($languages[$language_iso]) ? $languages[$language_iso] : '';
}
