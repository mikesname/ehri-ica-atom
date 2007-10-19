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

class mapActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('map', 'list');
  }

  public function executeList()
  {
    $this->maps = MapPeer::doSelect(new Criteria());
  }


  public function executeCreate()
  {
    $this->map = new Map();
    $this->placeRelationships = null;
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->map = MapPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->placeRelationships = $this->map->getPlaceRelationships();

    $this->forward404Unless($this->map);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $map = new Map();
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
