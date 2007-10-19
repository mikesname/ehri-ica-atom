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

class showAction extends sfAction
{
  public function execute()
  {
    $this->mapMetadata = MapPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->mapMetadata);

    $placeRelationships = $this->mapMetadata->getPlaceRelationships();

    //create map using GoogleMapAPI
    $this->map = new GoogleMapAPI('map');

    //set Google Map Key assigned to this website
    $this->map->setAPIKey('ABQIAAAAdK0ewFXxGGu_rho7KNhiWRS2Wh_PTvFuRUPwoFaayjCdp26BFxRbGF-EbSNwePqixB0Gu5k4DghJ7w');

    $rootURL = $this->getRequest()->getRelativeUrlRoot();

    //add locations to map
    foreach ($placeRelationships as $relationship)
    {
    $c = new Criteria();
    $place = PlacePeer::retrievebyPk($relationship->getPlaceId());

    $mapIcon = '<b><a href="'.$rootURL.'/place/show/id/'.$place->getId().'">'.$place->getName().'</a></b>';
    if ($relationship->getMapIconImageId())
      {
      $mapIcon .= '<p><a href="'.$rootURL.'/place/show/id/'.$place->getId().'"><img src="'.$rootURL.'/digitalobject/retrieve/id/'.$relationship->getMapIconImageId().' /></a></p>';
      }
    if ($relationship->getMapIconDescription())
      {
      $mapIcon .= '<p>'.$relationship->getMapIconDescription().'</p>';
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
