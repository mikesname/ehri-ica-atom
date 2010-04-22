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

class RepositoryIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->repository = QubitRepository::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->repository);

    $this->otherNames = $this->repository->getOtherNames();
    $this->maintenanceNote = null;
    if (0 < count($maintenanceNotes = $this->repository->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID))))
    {
      $this->maintenanceNote = $maintenanceNotes->offsetGet(0);
    }

    $this->types = $this->repository->getTermRelations(QubitTaxonomy::REPOSITORY_TYPE_ID);

    $this->contactInformation = $this->repository->getContactInformation();
  }
}
