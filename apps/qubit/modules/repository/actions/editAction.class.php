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
      $otherNameTypes[$type->getId()] = $type->getName(array('cultureFallback' => true));
    }
    $this->otherNameTypes = $otherNameTypes;

    //Properties
    $this->languageCodes = $this->repository->getProperties($name = 'language_of_repository_description');
    $this->scriptCodes = $this->repository->getProperties($name = 'script_of_repository_description');

    //Notes
    $this->notes = $this->repository->getRepositoryNotes();
    $this->noteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::NOTE_TYPE_ID);

    // Add javascript libraries to allow multiple instance select boxes
    $this->getResponse()->addJavaScript('/vendor/jquery/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');
  }
}
