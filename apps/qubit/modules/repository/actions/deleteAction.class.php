<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class RepositoryDeleteAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    $this->resource = $this->getRoute()->resource;

    if ($request->isMethod('delete'))
    {
      foreach ($this->resource->informationObjects as $item)
      {
        unset($item->repository);

        $item->save();
      }

      foreach (QubitRelation::getBySubjectOrObjectId($this->resource->id) as $item)
      {
        $item->delete();
      }

      $this->resource->delete();

      $this->redirect(array('module' => 'repository', 'action' => 'browse'));
    }
  }
}
