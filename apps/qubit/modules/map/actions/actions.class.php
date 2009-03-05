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

class mapActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('map', 'list');
  }

  public function executeList()
  {
    $this->maps = Map::get();
  }

  public function executeCreate()
  {
    $this->map = new Map;
    $this->placeRelations = null;
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->map = MapPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->placeRelations = $this->map->getPlaceRelations();

    $this->forward404Unless($this->map);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $map = new Map;
    }
    else
    {
      $map = MapPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($map);
    }

    $map->setId($this->getRequestParameter('id'));
    $map->setTitle($this->getRequestParameter('title'));
    $map->setDescription($this->getRequestParameter('description'));

    $map->save();

    return $this->redirect('map/edit?id='.$map->getId());
  }

  public function executeDelete()
  {
    $map = MapPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($map);

    $map->delete();

    return $this->redirect('map/list');
  }
}
