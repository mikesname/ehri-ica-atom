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
    sfContext::getInstance()->getConfiguration()->loadHelpers('Text');

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

    if (null !== ($publicationStatus = $informationObject->getPublicationStatus()) && QubitTerm::PUBLICATION_STATUS_DRAFT_ID == $publicationStatus->statusId)
    {
      $label .= ' ('.$publicationStatus->status.')';
    }

    return $label;
  }

  public static function getIdentifier($informationObject, array $options = array())
  {
    return QubitIsad::getReferenceCode($informationObject);
  }

  public static function getDates($informationObject, array $options = array())
  {
    $dcDate = array();
    // only return normalized (ISO format) dates if exporting
    if (isset($options['export']))
    {
      foreach (QubitDc::getDcEvents($informationObject) as $event)
      {
        if (null !== $exportDate = $event->getStartDate())
        {
          if (null !== $event->getEndDate())
          {
            $exportDate .= '/'.$event->getEndDate();
          }
          $dcDate[] = $exportDate;
        }
      }
    }
    else
    {
      foreach (QubitDc::getDcEvents($informationObject) as $event)
      {
        if (null !== $dateDisplay = $event->getStartDate())
        {
          if (null !== $event->getEndDate())
          {
            $dateDisplay .= ' - '.$event->getEndDate();
          }
          $dcDate[] = $dateDisplay;
        }
        else if ($dateDisplay = $event->getDateDisplay())
        {
          $dcDate[] = $dateDisplay;
        }
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

    // Add name access points
    $criteria = new Criteria;
    $criteria = $informationObject->addrelationsRelatedBysubjectIdCriteria($criteria);
    $criteria->add(QubitRelation::TYPE_ID, QubitTerm::NAME_ACCESS_POINT_ID);

    if (0 < count($nameAccessPointRelations = QubitRelation::get($criteria)))
    {
      foreach ($nameAccessPointRelations as $nameAccessPointRelation)
      {
        $dcSubject[] = $nameAccessPointRelation->object;
      }
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
        else if ($endDate = $event->getEndDate())
        {
          $dcCoverage[] = $event->getStartDate().' - '.$endDate;
        }
      }

      return $dcCoverage;
    }

    if (isset($options['spatial']))
    {
      $dcCoverage = array();
      foreach ($informationObject->getEvents() as $event)
      {
        if (null !== ($place = $event->getPlace()))
        {
          $dcCoverage[] = $place;
        }
      }
      foreach ($informationObject->getPlaceAccessPoints() as $placeAccessPoint)
      {
        $dcCoverage[] = $placeAccessPoint->getTerm();
      }

      return $dcCoverage;
    }
  }

  protected static function getDcEvents($informationObject, array $options = array())
  {
    // Because simple Dublin Core cannot qualify the dc:date or dc:coverage elements, we only return a limited
    // set of Events. Just those that are related to creation/origination.
    $dcEvents = array();
    foreach ($informationObject->getEvents() as $event)
    {
      switch ($event->getTypeId())
      {
        case QubitTerm::CREATION_ID:
          $dcEvents[] = $event;
          break;
        case QubitTerm::CONTRIBUTION_ID:
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

    if (count(QubitDc::getDcTypes($informationObject)) > 0)
    {
      foreach (QubitDc::getDcTypes($informationObject) as $type)
      {
        $dcType[] = $type->getTerm();
      }
    }

    // match Qubit MediaType to DCMI Type vocabulary
    if ($digitalObject = $informationObject->getDigitalObject())
    {
      switch ($digitalObject->getMediaType())
      {
        case 'Image':
          $dcType[] = 'image';
          break;
        case 'Video':
          $dcType[] = 'moving image';
          break;
        case 'Audio':
          $dcType[] = 'sound';
          break;
        case 'Text':
          $dcType[] = 'text';
          break;
      }
    }

    return $dcType;
  }

  public static function getDcTypes($informationObject, array $options = array())
  {
    return $informationObject->getTermRelations(QubitTaxonomy::DC_TYPE_ID);
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
    if ($extentAndMedium = $informationObject->getExtentAndMedium(array('cultureFallback' => true)))
    {
      $dcFormat[] = $extentAndMedium;
    }

    return $dcFormat;
  }

}
