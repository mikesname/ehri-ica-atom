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
 * This class is used to provide methods that supplement the core Qubit information object with behaviour or
 * presentation features that are specific to the Metadata Object Description Schema (MODS) standard
 *
 * @package    Qubit
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */

class QubitMods
{
  public static function getLabel($informationObject, array $options = array())
  {
    sfLoader::loadHelpers('Text');

    $label = $informationObject->getLevelOfDescription();

    if ($informationObject->getIdentifier())
    {
      $label .= ' '.$informationObject->getIdentifier();
    }

    if ($label)
    {
      $label .= ' - ';
    }

    if (strlen($title = $informationObject->getTitle()) < 1)
    {
      $title = $informationObject->getTitle(array('sourceCulture' => true));
    }

    $label .= $title;

    if (isset($options['truncate']))
    {
      $label = truncate_text($label, $options['truncate']);
    }

    return $label;
  }

  public static function getIdentifier($informationObject, array $options = array())
  {
    return QubitIsad::getReferenceCode($informationObject);
  }

  public static function getTypes($informationObject, array $options = array())
  {
    return $informationObject->getTermRelations(QubitTaxonomy::MODS_RESOURCE_TYPE_ID);
  }

  public static function getNames($informationObject, array $options = array())
  {
    $nameEvents = array();
    $actorEvents = $informationObject->getActorEvents();
    foreach ($actorEvents as $event)
    {
      if ($event->getActorId())
      {
        $nameEvents[] = $event;
      }
    }

    return $nameEvents;
  }

  public static function getLanguageCodes($informationObject, array $options = array())
  {
    return $informationObject->getProperties($name = 'information_object_language');
  }

  public static function getDigitalObject($informationObject, array $options = array())
  {
    $digitalObject = $informationObject->getDigitalObject();
    if (isset($digitalObject))
    {

      return $digitalObject;
    }
    else
    {

      return null;
    }
  }

  public static function getLocationUrl($informationObject, array $options = array())
  {
    if ($digitalObject = $informationObject->getDigitalObject())
    {
      return 'http://'.$options['request']->getHost().$options['request']->getRelativeUrlRoot().$digitalObject->getFullPath();
    }
    else
    {
      return null;
    }
  }

}