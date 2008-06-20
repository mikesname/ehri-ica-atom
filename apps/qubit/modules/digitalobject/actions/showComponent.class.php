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
class DigitalObjectShowComponent extends sfComponent
{
  /**
   * Show digital object representation
   *
   * @param sfWebRequest $request
   *
   * @todo add components for non-image digital objects
   */
  public function execute($request)
  {
    // If type of display not specified, show a thumbnail
    if (!isset($this->usageType))
    {
      $this->usageType = QubitTerm::THUMBNAIL_ID;
    }

    // Figure out which show component to call, base on USER selected media
    // type
    switch ($this->digitalObject->getMediaTypeId())
    {
      case QubitTerm::IMAGE_ID:
        $this->showComponent = 'showImage';
        break;
      //case QubitTerm::AUDIO_ID:
        //$this->showComponent = 'showAudio';
        //break;
      case QubitTerm::VIDEO_ID:
        $this->showComponent = 'showVideo';
        break;
      case (QubitTerm::TEXT_ID):
        $this->showComponent = 'showText';
        break;
      default:
        $this->showComponent = 'showDownload';
        break;
    }

    if (!isset($this->link))
    {
      $this->link = null;
    }

    if (!isset($this->iconOnly))
    {
      $this->iconOnly = false;
    }
  }
}