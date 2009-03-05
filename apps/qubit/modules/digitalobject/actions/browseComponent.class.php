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
      $this->digitalObjects = QubitDigitalObject::getIconList($this->mediaTypeId, $this->page);
    }

    if (count($this->digitalObjects) == 0)
    {
      echo __('<span class="">No %1% found</span>', array('%1%' => sfConfig::get('app_ui_label_digitalobject')));
    }
  }
}