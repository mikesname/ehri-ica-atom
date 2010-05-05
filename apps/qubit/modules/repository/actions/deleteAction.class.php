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

class RepositoryDeleteAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    $this->repository = QubitRepository::getById($request->id);

    if (!isset($this->repository))
    {
      $this->forward404();
    }

    if ($request->isMethod('delete'))
    {
      foreach ($this->repository->informationObjects as $informationObject)
      {
        unset($informationObject->repository);

        $informationObject->save();
      }

      foreach (QubitRelation::getBySubjectOrObjectId($this->repository->id) as $relation)
      {
        $relation->delete();
      }

      $this->repository->delete();

      $this->redirect(array('module' => 'repository', 'action' => 'list'));
    }
  }
}
