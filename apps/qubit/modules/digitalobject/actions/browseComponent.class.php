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
 * digitalObject actions.
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     Your name here
 * @version    SVN: $Id$
 */
class DigitalObjectBrowseComponent extends sfComponent
{
  public function execute($request)
  {
    if (isset($this->informationObject))
    {
      // Get information object childern
    }
    else
    {
      $criteria = new Criteria;

      if (isset($this->mediaType))
      {
        $criteria->add(QubitDigitalObject::MEDIA_TYPE_ID, $this->mediaType->getId());
      }
      $criteria->add(QubitDigitalObject::INFORMATION_OBJECT_ID, null, Criteria::ISNOTNULL);
      $criteria->addAscendingOrderByColumn(QubitDigitalObject::NAME);

      $this->digitalObjects = QubitDigitalObject::get($criteria);
    }

    if (count($this->digitalObjects) == 0)
    {
      echo __('<span class="">No %1% found</span>', array('%1%' => sfConfig::get('app_ui_label_digitalobject')));
    }
  }
}