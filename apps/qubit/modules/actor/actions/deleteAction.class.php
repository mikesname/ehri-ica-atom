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

class ActorDeleteAction extends sfAction
{
  public function execute($request)
  {
    $actor = QubitActor::getById($this->getRequestParameter('id'));

    $this->forward404Unless($actor);

    foreach ($actor->getEvents() as $event)
    {
      if (is_null($event->getInformationObjectId()))
      {
        $event->delete();
      }
      else
      {
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

    return $this->redirect('actor/list');
  }
}
