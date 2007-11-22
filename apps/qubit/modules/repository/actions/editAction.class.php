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

class editAction extends sfAction
{
  public function execute()
  {
  $this->repository = RepositoryPeer::retrieveByPk($this->getRequestParameter('id'));

  $this->forward404Unless($this->repository);


  //Inherited from Actor
  if ($this->repository->getActorId())
    {
    $actor = ActorPeer::retrieveByPk($this->repository->getActorId());
    $this->otherNames = $actor->getOtherNames();
    $this->history = $actor->getHistory();
    $this->structure = $actor->getInternalStructures();
    $this->contactInformation = $actor->getContactInformation();
    }
  else
    {
    $this->otherNames = null;
    $this->history = null;
    $this->structures = null;
    $this->contactInformation = null;
    }

  $this->newContactInformation = new ContactInformation();

  //TermManyToManyRelationships
  $this->languages = $this->repository->getLanguages();
  $this->scripts = $this->repository->getScripts();

  $this->newLanguage = new RepositoryTermRelationship();
  $this->newScript = new RepositoryTermRelationship();

  //Notes
  $this->notes = $this->repository->getRepositoryNotes();
  $this->newNote = new Note();

  //set view template
  switch ($this->getRequestParameter('template'))
    {
    case 'isiah' :
      $this->setTemplate('editISIAH');
      break;
    default :
      $this->setTemplate(sfConfig::get('app_default_template_repository_edit'));
    }
  }



}
