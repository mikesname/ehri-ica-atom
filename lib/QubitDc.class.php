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
 * presentation features that are specific to the Dublin Core standard
 *
 * @package    Qubit
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */

class QubitDc
{
  public static function getLabel($informationObject, array $options = array())
  {
    sfLoader::loadHelpers('Text');

    $label = '';

    if ($informationObject->getIdentifier())
    {
      $label = $informationObject->getIdentifier();
    }

    if (strlen($title = $informationObject->getTitle()) < 1)
    {
      $title = $informationObject->getTitle(array('sourceCulture' => true));
    }

    if ((strlen($title) > 0) & (strlen($label) > 0))
    {
      $label .= ' - '.$title;
    }
    else
    {
      $label .= $title;
    }

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

  public static function getDates($informationObject, array $options = array())
  {
    // as per DC best practice, only an ISO 8601 normalized (start) date is returned.
    // Date ranges (start date - end date) or natural language date strings are output as dc:coverage values
    $dcDate = array();
    foreach (QubitDc::getDcEvents($informationObject) as $event)
    {
      if ($date = $event->getStartDate())
      {
        $dcDate[] = $date;
      }
    }

    return $dcDate;
  }

  public static function getSubjects($informationObject, array $options = array())
  {
    $dcSubject = array();
    foreach ($informationObject->getSubjectAccessPoints() as $subjectAccessPoint)
    {
      $dcSubject[] = $subjectAccessPoint->getTerm();
    }
    foreach ($informationObject->getActors($options = array('eventTypeId' => QubitTerm::SUBJECT_ID)) as $nameAccessPoint)
    {
      $dcSubject[] = $nameAccessPoint;
    }

    return $dcSubject;
  }

  public static function getCoverage($informationObject, array $options = array())
  {
    if (isset($options['temporal']))
    {
      $dcCoverage = array();
      foreach (QubitDc::getDcEvents($informationObject) as $event)
      {
        if ($dateDisplay = $event->getDateDisplay())
        {
          $dcCoverage[] = $dateDisplay;
        }
      }

      return $dcCoverage;
    }

    if (isset($options['spatial']))
    {
      $dcCoverage = array();
      foreach ($informationObject->getPlaceAccessPoints() as $placeAccessPoint)
      {
        $dcCoverage[] = $placeAccessPoint->getTerm();
      }

      return $dcCoverage;
    }
  }

  private static function getDcEvents($informationObject, array $options = array())
  {
    // Because simple Dublin Core cannot qualify the dc:date or dc:coverage elements, we only return a limited
    // set of Events. Just those that are related to creation/origination.
    $dcEvents = array();
    foreach ($informationObject->getActorEvents() as $event)
    {
      switch ($event->getTypeId())
      {
        case QubitTerm::CREATION_ID:
          $dcEvents[] = $event;
          break;
        case QubitTerm::CUSTODY_ID:
          $dcEvents[] = $event;
          break;
        case QubitTerm::PUBLICATION_ID:
          $dcEvents[] = $event;
          break;
        case QubitTerm::COLLECTION_ID:
          $dcEvents[] = $event;
          break;
        case QubitTerm::ACCUMULATION_ID:
          $dcEvents[] = $event;
          break;
      }
    }

    return $dcEvents;
  }

  public static function getTypes($informationObject, array $options = array())
  {
    $dcType = array();
    if ($collectionType = $informationObject->getCollectionType())
    {
      $dcType[] = $collectionType;
    }
    if (count($materialTypes = $informationObject->getMaterialTypes()) > 0)
    {
      foreach ($materialTypes as $type)
      {
        $dcType[] = $type->getTerm();
      }
    }
    if ($digitalObject = $informationObject->getDigitalObject())
    {
      $dcType[] = $digitalObject->getMediaType();
    }

    return $dcType;
  }

  public static function getFormats($informationObject, array $options = array())
  {
    $dcFormat = array();
    if ($digitalObject = $informationObject->getDigitalObject())
    {
      if ($digitalObject->getMimeType())
      {
        $dcFormat[] = $digitalObject->getMimeType();
      }
    }
    if ($extentAndMedium = $informationObject->getExtentAndMedium())
    {
      $dcFormat[] = $extentAndMedium;
    }

    return $dcFormat;
  }

  public static function getRelation($informationObject, array $options = array())
  {
    sfLoader::loadHelpers(array('I18N'));
    $dcRelation = array();
    $dcRelation['text'] = '';
    $dcRelation['identifier'] = '';
    $dcRelation['property'] = '';
    if ($parent = QubitInformationObject::getById($informationObject->getParentId()))
    {
      $collection = $informationObject->getCollectionRoot();
      if ($collection->getId() !== $informationObject->getId())
      {
        $dcRelation['text'] .= __('is part of').' "'.$parent.'"';
        if ($collection->getId() !== $parent->getId())
        {
          $dcRelation['text'] .= __(' in').' "'.$collection.'"';
        }
        $dcRelation['identifier'] = $parent->getOaiIdentifier();
      }
    }
    if ($relation = $informationObject->getPropertyByName('information_object_relation'))
    {
      $dcRelation['property'] = $relation->getValue();
    }

    return $dcRelation;
  }

}