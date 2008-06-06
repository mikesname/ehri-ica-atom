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

class MapCreatePlaceMapRelationAction extends sfAction
{
  public function execute($request)
  {
  $this->placeMapRelation = new PlaceMapRelation;

  if ($this->getRequestParameter('mapId'))
    {
    $this->placeMapRelation->setMapId($this->getRequestParameter('mapId'));
    $this->placeMapRelation->save();
    }

  if ($this->getRequestParameter('placeId'))
    {
    $this->placeMapRelation->setPlaceId($this->getRequestParameter('placeId'));
    $this->placeMapRelation->save();
    }

  $this->setTemplate('editPlaceMapRelation');
  }
}
