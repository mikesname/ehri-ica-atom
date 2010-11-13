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

class placeActions extends sfActions
{
  public function executeList()
  {
    $this->places = QubitPlace::get();
  }

  public function executeShow()
  {
    $this->place = PlacePeer::retrieveByPk($this->request->id);
    $this->forward404Unless($this->place);

   $this->mapRelations = $this->place->getMapRelations();

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if ($this->context->user->hasCredential(array('contributor', 'editor', 'administrator'), false))
    {
    $this->editCredentials = true;
    }

  $this->nav_context_back  = $this->context->user->getAttribute('nav_context_back');
  }

  public function executeCreate()
  {
    $this->place = new Place;

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->place = PlacePeer::retrieveByPk($this->request->id);
    $this->forward404Unless($this->place);

    $this->mapRelations = $this->place->getMapRelations();
  }

  public function executeUpdate()
  {
    if (!$this->request->id)
    {
      $place = new Place;
    }
    else
    {
      $place = PlacePeer::retrieveByPk($this->request->id);
      $this->forward404Unless($place);
    }

    $place->setId($this->request->id);
    $place->setName($this->request->name);
    $place->setDescription($this->request->description);
    $place->setAddress($this->request->address);
    $place->setCountryId($this->request->country_id ? $this->request->country_id : null);
    if (($this->request->longtitude === null) or ($this->request->longtitude == 0))
      {
      $place->setLongtitude(null);
      }
    else
      {
      $place->setLongtitude($this->request->longtitude);
      }
    if (($this->request->latitude === null) or ($this->request->latitude == 0))
      {
      $place->setLatitude(null);
      }
    else
      {
      $place->setLatitude($this->request->latitude);
      }

    $place->save();

    $this->redirect('place/edit?id='.$place->id);
  }

  public function executeDelete()
  {
    $place = PlacePeer::retrieveByPk($this->request->id);

    $this->forward404Unless($place);

    $place->delete();

    $this->redirect('place/list');
  }
}
