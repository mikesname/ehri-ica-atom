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
        $this->representation = QubitDigitalObject::getGenericRepresentation($this->digitalObject->getMimeType());
    }

    // If no representation found, then default to generic rep
    if (!$this->representation)
    {
      $this->representation = QubitDigitalObject::getGenericRepresentation($this->digitalObject->getMimeType());
    }

    // Build a fully qualified URL to this digital object asset
    $this->link = public_path($this->digitalObject->getFullPath(), true);
  }
}