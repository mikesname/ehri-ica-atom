<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * This class is used to provide methods that supplement the core Qubit information object with behaviour or 
 * presentation features that are specific to the ICA's International Standard Archival Description (ISAD)
 *
 * @package    Qubit
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */

class QubitIsad
{
  public static function getLabel($informationObject, array $options = array())
  {
    //returns ISAD compliant label
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

    if (is_null($title = $informationObject->getTitle()))
    {
      $title = $informationObject->getTitle(array('sourceCulture' => true));
    }

    $label .= $title;

    if (isset($options['truncate']))
    {
      $label = truncate_text($label, $options['truncate']);
    }

    //TODO: will return an array, only display first one?
    /*
    if ($informationObject->getDates($eventType = 'creation'))
    {
      $label .= ' ['.$informationObject->getDates($eventType = 'creation').']';
    }
    */

    return $label;
  }

  public static function getReferenceCode($informationObject, array $options = array())
  {
    $countryCode = null;
    $repositoryCode = null;
    $identifiers = array();
    // if current informationObject is related to a Repository record
    // get its country and repository code from that related record
    // otherwise go up the ancestor tree until hitting a node that has a related
    // Repository record with country and repository code info
    foreach ($informationObject->getAncestors()->andSelf()->orderBy('lft') as $ancestor)
    {
      if (null !== $repository = $ancestor->getRepository())
      {
        if (null !== $primaryContact = $repository->getPrimaryContact())
        {
          $countryCode = $repository->getPrimaryContact()->getCountryCode().' ';
        }
        $repositoryCode = $repository->getIdentifier().' ';
      }
      // while going up the ancestor tree, build an array of identifiers that can be output
      // as one compound identifier string for Reference Code display
      if ($ancestor->getIdentifier())
      {
        $identifiers[] = $ancestor->getIdentifier();
      }
    }

     // TODO: This should work in future, without requiring the foreach() loop above:
     // return $informationObject->getAncestors->andSelf->orderBy('rgt')->getRepository()->getPrimaryContact()->getCountryCode().' '.$informationObject->getAncestors->andSelf()->getRepository()->getIdentifier().' '.implode('-', $informationObject->getAncestors()->andSelf()->getIdentifier());
    return $countryCode.$repositoryCode.implode('-', $identifiers);
  }
}