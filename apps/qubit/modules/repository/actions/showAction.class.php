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

class RepositoryShowAction extends sfAction
{
  public function execute($request)
  {
  $this->repository = QubitRepository::getById($this->getRequestParameter('id'));
  $this->forward404Unless($this->repository);

  $this->languageCodes = $this->repository->getProperties($name = 'language_of_repository_description');
  $this->scriptCodes = $this->repository->getProperties($name= 'script_of_repository_description');

  $this->otherNames = $this->repository->getOtherNames();

  //Notes
  $this->notes = $this->repository->getRepositoryNotes();

  $this->contactInformation = $this->repository->getContactInformation();

  //determine if user has edit priviliges
  $this->editCredentials = false;
  if ($this->getUser()->hasCredential('administrator'))
    {
    $this->editCredentials = true;
    }

  //set view template
  switch ($this->getRequestParameter('template'))
    {
    case 'isiah' :
      $this->setTemplate('showISIAH');
      break;
    default :
      $this->setTemplate(sfConfig::get('app_default_template_repository_show'));
    }
  }
}
