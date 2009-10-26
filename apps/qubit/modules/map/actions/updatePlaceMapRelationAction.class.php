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

class MapUpdatePlaceMapRelationAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->getRequestParameter('id'))
    {
      $placeMapRelation = new PlaceMapRelation;
    }
    else
    {
      $placeMapRelation = PlaceMapRelation::getById($this->getRequestParameter('id'));
      $this->forward404Unless($placeMapRelation);
    }

    $placeMapRelation->setId($this->getRequestParameter('id'));
    $placeMapRelation->setPlaceId($this->getRequestParameter('place_id') ? $this->getRequestParameter('place_id') : null);
    $placeMapRelation->setMapId($this->getRequestParameter('map_id') ? $this->getRequestParameter('map_id') : null);
    $placeMapRelation->setMapIconImageId($this->getRequestParameter('map_icon_image_id') ? $this->getRequestParameter('map_icon_image_id') : null);
    $placeMapRelation->setMapIconDescription($this->getRequestParameter('map_icon_description'));
    $placeMapRelation->setRelationNote($this->getRequestParameter('relation_note'));

    $placeMapRelation->save();

    $this->redirect('map/edit?id='.$placeMapRelation->getMapId());
  }
}
