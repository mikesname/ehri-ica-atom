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

class digitalobjectActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('digitalobject', 'list');
  }

  public function executeList()
  {
    $this->digital_objects = DigitalObjectPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->digital_object = DigitalObjectPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->digital_object);
  }

  public function executeCreate()
  {
    $this->digital_object = new DigitalObject();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->digital_object = DigitalObjectPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->digital_object);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $digital_object = new DigitalObject();
    }
    else
    {
      $digital_object = DigitalObjectPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($digital_object);
    }

    $digital_object->setId($this->getRequestParameter('id'));
    $digital_object->setFilename($this->getRequestParameter('filename'));
    $digital_object->setNetworkPath($this->getRequestParameter('network_path'));
    $digital_object->setUrl($this->getRequestParameter('url'));

    $digital_object->save();

    return $this->redirect('digitalobject/show?id='.$digital_object->getId());
  }

  public function executeDelete()
  {
    $digital_object = DigitalObjectPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($digital_object);

    $digital_object->delete();

    return $this->redirect('digitalobject/list');
  }
}
