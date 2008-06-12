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
 * Digital Object edit component.
 *
 * @package    qubit
 * @subpackage digitalobject
 * @author     david juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class DigitalObjectEditComponent extends sfComponent
{
  public function execute($request)
  {
  
    // Get related digital object with all representations
    $this->digitalObject = $this->informationObject->getDigitalObject();
    if (count($this->digitalObject))
    {
      $representations[QubitTerm::MASTER_ID] = $this->digitalObject;
      $representations[QubitTerm::REFERENCE_ID] = $this->digitalObject->getChildByUsageId(QubitTerm::REFERENCE_ID);
      $representations[QubitTerm::THUMBNAIL_ID] = $this->digitalObject->getChildByUsageId(QubitTerm::THUMBNAIL_ID);
      $this->representations = $representations;
    }
  }
}