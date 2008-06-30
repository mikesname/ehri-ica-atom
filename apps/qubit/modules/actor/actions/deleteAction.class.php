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

class ActorDeleteAction extends sfAction
{
  public function execute($request)
  {
    $actor = QubitActor::getById($this->getRequestParameter('id'));

    $this->forward404Unless($actor);
    
    //keep track of informationObjects that require a search index update due to the deletion of related actors (e.g. name access points, creators, creator history)
    $informationObjects = array();

    foreach ($actor->getEvents() as $event)
    {
      if (is_null($event->getInformationObjectId()))
      {
        $event->delete();
      }
      else
      {
        $informationObjects[] = $event->getInformationObject();
        if (is_null($event->getTypeId()))
        {
          //Event is only relevant in relation to Actor object, therefore it can be deleted
          $event->delete();
        }
        else
        { 
          //Event is relevant even without Actor object (e.g. creation date range), therefore it cannot be deleted
          $event->setActorId(null);
          $event->save();
        }
      }
    }

    $actor->delete();

    foreach ($informationObjects as $informationObject)
    {
      SearchIndex::UpdateTranslatedLanguages($informationObject);
    }

    return $this->redirect('actor/list');
  }
}
