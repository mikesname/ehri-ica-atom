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
    $this->form = new sfForm;

    $this->actor = QubitActor::getById($request->id);

    if (!isset($this->actor))
    {
      $this->forward404();
    }

    if ($request->isMethod('delete'))
    {
      foreach ($this->actor->events as $event)
      {
        if (isset($event->informationObject) && isset($event->type))
        {
          unset($event->actor);

          $event->save();
        }
        else
        {
          $event->delete();
        }
      }

      foreach (QubitRelation::getRelationsBySubjectOrObjectId($this->actor->id) as $relation)
      {
        $relation->delete();
      }

      $this->actor->delete();

      $this->redirect(array('module' => 'actor', 'action' => 'list'));
    }
  }
}
