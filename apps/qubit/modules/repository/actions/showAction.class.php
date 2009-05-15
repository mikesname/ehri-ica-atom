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

class RepositoryShowAction extends sfAction
{
  public function execute($request)
  {
    $this->repository = QubitRepository::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->repository);

    $this->languageCodes = $this->repository->getProperties($name = 'language_of_repository_description');
    $this->scriptCodes = $this->repository->getProperties($name = 'script_of_repository_description');

    $this->otherNames = $this->repository->getOtherNames();

    //Notes
    $this->notes = $this->repository->getRepositoryNotes();

    $this->contactInformation = $this->repository->getContactInformation();

    // Determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'repository'))
    {
      $this->editCredentials = true;
    }
  }
}
