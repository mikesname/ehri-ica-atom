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

    $this->resource = $this->getRoute()->resource;

    // Check that this isn't the root
    if (!isset($this->resource->parent))
    {
      $this->forward404();
    }

    if ($request->isMethod('delete'))
    {
      foreach ($this->resource->events as $item)
      {
        if (isset($item->informationObject) && isset($item->type))
        {
          unset($item->actor);

          $item->save();
        }
        else
        {
          $item->delete();
        }
      }

      foreach (QubitRelation::getBySubjectOrObjectId($this->resource->id) as $relation)
      {
        $relation->delete();
      }

      $this->resource->delete();

      $this->redirect(array('module' => 'actor', 'action' => 'browse'));
    }
  }
}
