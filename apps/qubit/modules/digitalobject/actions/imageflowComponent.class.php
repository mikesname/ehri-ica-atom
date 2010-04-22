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
 * Digital Object coverflow component
 *
 * @package    qubit
 * @subpackage digitalobject
 * @version    SVN: $Id$
 * @author     david juhasz <david@artefactual.com>
 */
class DigitalObjectImageflowComponent extends sfComponent
{
  public function execute($request)
  {
    $this->thumbnails = array();

    // Set limit (null for no limit)
    if (!isset($request->showFullImageflow) || 'true' != $request->showFullImageflow)
    {
      $this->limit = sfConfig::get('app_hits_per_page', 10);
    }

    // Add thumbs
    foreach ($this->informationObject->descendants as $descendant)
    {
      if (null !== $digitalObject = $descendant->getDigitalObject())
      {
        $thumbnail = $digitalObject->getRepresentationByUsage(QubitTerm::THUMBNAIL_ID);

        if (!$thumbnail)
        {
          $thumbnail = QubitDigitalObject::getGenericRepresentation($digitalObject->getMimeType(), QubitTerm::THUMBNAIL_ID);
          $thumbnail->setParent($digitalObject);
        }

        $this->thumbnails[] = $thumbnail;

        if (isset($this->limit) && $this->limit <= count($this->thumbnails))
        {
          break;
        }
      }
    }

    // Get total number of descendant digital objects
    $this->total = 0;
    if (isset($this->informationObject->id))
    {
      $criteria = new Criteria;
      $criteria->addJoin(QubitInformationObject::ID, QubitDigitalObject::INFORMATION_OBJECT_ID, Criteria::INNER_JOIN);
      $criteria->add(QubitInformationObject::LFT, $this->informationObject->lft, Criteria::GREATER_THAN);
      $criteria->add(QubitInformationObject::RGT, $this->informationObject->rgt, Criteria::LESS_THAN);

      $this->total = BasePeer::doCount($criteria)->fetchColumn(0);
    }

    if (2 > count($this->thumbnails))
    {
      return sfView::NONE;
    }
  }
}
