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

/**
 * Controller for editing repository information.
 * 
 * @package    qubit
 * @subpackage repository
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class RepositoryEditAction extends sfAction
{
  public function execute($request)
  {
    $this->repository = QubitRepository::getById($this->getRequestParameter('id'));

    $this->forward404Unless($this->repository);

    $this->contactInformation = $this->repository->getContactInformation();
    $this->newContactInformation = new QubitContactInformation;

    //Other Forms of Name
    $this->otherNames = $this->repository->getOtherNames();
    $otherNameTypes = array();
    foreach (QubitTerm::getActorNameTypes() as $type)
    {
      $otherNameTypes[$type->getId()] = $type->getName();
    }
    $this->otherNameTypes = $otherNameTypes;

    //Properties
    $this->languageCodes = $this->repository->getProperties($name = 'language_of_repository_description');
    $this->scriptCodes = $this->repository->getProperties($name = 'script_of_repository_description');

    //Notes
    $this->notes = $this->repository->getRepositoryNotes();
    $this->newNote = new QubitNote;
    
    // Add javascript libraries to allow multiple instance select boxes
    $this->getResponse()->addJavaScript('jquery');
    $this->getResponse()->addJavaScript('/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');

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
