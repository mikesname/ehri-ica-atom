<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class updatePlaceMapRelationshipAction extends sfAction
{
  public function execute()
  {
    if (!$this->getRequestParameter('id'))
    {
      $placeMapRelationship = new PlaceMapRelationship();
    }
    else
    {
      $placeMapRelationship = PlaceMapRelationshipPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($placeMapRelationship);
    }

    $placeMapRelationship->setId($this->getRequestParameter('id'));
    $placeMapRelationship->setPlaceId($this->getRequestParameter('place_id') ? $this->getRequestParameter('place_id') : null);
    $placeMapRelationship->setMapId($this->getRequestParameter('map_id') ? $this->getRequestParameter('map_id') : null);
    $placeMapRelationship->setMapIconImageId($this->getRequestParameter('map_icon_image_id') ? $this->getRequestParameter('map_icon_image_id') : null);
    $placeMapRelationship->setMapIconDescription($this->getRequestParameter('map_icon_description'));
    $placeMapRelationship->setRelationshipNote($this->getRequestParameter('relationship_note'));

    $placeMapRelationship->save();

    return $this->redirect('map/edit?id='.$placeMapRelationship->getMapId());

  }
}
