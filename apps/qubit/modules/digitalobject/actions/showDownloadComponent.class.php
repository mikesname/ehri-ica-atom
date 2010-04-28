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
 * Digital Object display component
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class DigitalObjectShowDownloadComponent extends sfComponent
{
  /**
   * Show a representation of a digital object image.
   *
   * @param sfWebRequest $request
   *
   */
  public function execute($request)
  {
    switch($this->usageType)
    {
      case QubitTerm::REFERENCE_ID:
        $this->representation = $this->digitalObject->getRepresentationByUsage(QubitTerm::REFERENCE_ID);
        break;
      case QubitTerm::THUMBNAIL_ID:
        $this->representation = $this->digitalObject->getRepresentationByUsage(QubitTerm::THUMBNAIL_ID);
        break;
      case QubitTerm::MASTER_ID:
      default:
        $this->representation = QubitDigitalObject::getGenericRepresentation($this->digitalObject->getMimeType(), $this->usageType);
    }

    // If no representation found, then default to generic rep
    if (!$this->representation)
    {
      $this->representation = QubitDigitalObject::getGenericRepresentation($this->digitalObject->getMimeType(), $this->usageType);
    }

    // Build a fully qualified URL to this digital object asset
    if (($this->digitalObject->getMediaTypeId() != QubitTerm::IMAGE_ID || $this->usageType == QubitTerm::REFERENCE_ID)
      && QubitAcl::check($this->digitalObject->informationObject, 'readMaster'))
    {
      $this->link = public_path($this->digitalObject->getFullPath(), true);
    }
  }
}
