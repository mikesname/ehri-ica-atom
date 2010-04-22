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

class MapIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->mapMetadata = Map::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->mapMetadata);

    $placeRelations = $this->mapMetadata->getPlaceRelations();

    //create map using GoogleMapAPI
    $this->map = new GoogleMapAPI('map');

    //set Google Map Key assigned to this website
    $this->map->setAPIKey('ABQIAAAAdK0ewFXxGGu_rho7KNhiWRS2Wh_PTvFuRUPwoFaayjCdp26BFxRbGF-EbSNwePqixB0Gu5k4DghJ7w');

    $rootURL = $this->getRequest()->getRelativeUrlRoot();

    //add locations to map
    foreach ($placeRelations as $relation)
    {
    $c = new Criteria;
    $place = Place::getById($relation->getPlaceId());

    $mapIcon = '<b><a href="'.$rootURL.'/place/show/id/'.$place->getId().'">'.$place->getName().'</a></b>';
    if ($relation->getMapIconImageId())
      {
      $mapIcon .= '<p><a href="'.$rootURL.'/place/show/id/'.$place->getId().'"><img src="'.$rootURL.'/digitalobject/retrieve/id/'.$relation->getMapIconImageId().' /></a></p>';
      }
    if ($relation->getMapIconDescription())
      {
      $mapIcon .= '<p>'.$relation->getMapIconDescription().'</p>';
      }

    //use cached geoCodes if they exist
    if (($place->getLongtitude() !== null) & ($place->getLatitude() !== null))
      {
      $this->map->addMarkerByCoords($place->getLongtitude(), $place->getLatitude(), $place->getName(), $mapIcon);
      }
    //lookup and cache geoCodes if they don't already exist (
    else
      {
      $this->map->addMarkerByAddress($place->getId(), $mapIcon);
      }
    }

   //determine if user has edit priviliges
    $this->editCredentials = false;
    if ($this->getUser()->hasCredential(array('contributor', 'editor', 'administrator'), false))
    {
    $this->editCredentials = true;
    }

    //set back navigation
    $this->getUser()->setAttribute('nav_context_back', $this->getRequest()->getURI());

    //use layout that has necessary GoogleMapAPI hooks in doctype, head and body attributes/elements
    $this->setLayout('layout_map_two_column');
  }
}
