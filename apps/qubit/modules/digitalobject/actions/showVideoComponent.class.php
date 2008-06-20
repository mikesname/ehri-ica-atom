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
 * Digital Object video display component
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class DigitalObjectShowVideoComponent extends sfComponent
{
  /**
   * Show a representation of a digital object image.
   *
   * @param sfWebRequest $request
   *
   */
  public function execute($request)
  {
    $this->getResponse()->addJavaScript('jquery.js');
    $this->getResponse()->addJavaScript('flowplayer/flashembed.min.js');
    $this->getResponse()->addJavaScript('flowplayer/flow.embed.js');
    $this->getResponse()->addStylesheet('flowPlayer.css');
    
    $this->pathToFlowPlayer = public_path('flowplayer/FlowPlayerDark.swf');
    
    // Get representation by usage type
    $this->representation = $this->digitalObject->getRepresentationByUsage($this->usageType);

    // If we can't find a representation for this object, try their parent
    if (!$this->representation && ($parent = $this->digitalObject->getParent()))
    {
      $this->representation = $parent->getRepresentationByUsage($this->usageType);
    }

    // If representation is not a valid digital object, return a generic icon
    if (!$this->representation)
    {
       $this->representation = QubitDigitalObject::getGenericRepresentation($this->digitalObject->getMimeType());
    }
    
    // If this is a reference movie, get the thumbnail representation for the 
    // place holder image
    if ($this->usageType == QubitTerm::REFERENCE_ID)
    {
      $this->thumbnail = $this->digitalObject->getRepresentationByUsage(QubitTerm::THUMBNAIL_ID);
    }
    
    list($this->width, $this->height) = QubitDigitalObject::getImageMaxDimensions($this->usageType);
    
  }
}