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
