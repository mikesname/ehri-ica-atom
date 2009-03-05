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
 * Controller for editing actor information.
 *
 * @package    qubit
 * @subpackage actor
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class ActorEditAction extends sfAction
{
  public function execute($request)
  {
    $this->actor = QubitActor::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->actor);

    //Other Forms of Name
    $this->otherNames = $this->actor->getOtherNames();
    $this->newName = new QubitActorName;

    //Properties
    $this->languageCodes = $this->actor->getProperties($name = 'language_of_actor_description');
    $this->scriptCodes = $this->actor->getProperties($name = 'script_of_actor_description');

    //Notes
    $this->notes = $this->actor->getActorNotes();
    $this->noteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::NOTE_TYPE_ID);

    if ($this->getRequestParameter('repositoryReroute'))
    {
      $this->repositoryReroute = $this->getRequestParameter('repositoryReroute');
    }
    else
    {
      $this->repositoryReroute = null;
    }

    if ($this->getRequestParameter('informationObjectReroute'))
    {
      $this->informationObjectReroute = $this->getRequestParameter('informationObjectReroute');
    }
    else
    {
      $this->informationObjectReroute = null;
    }

    // Add javascript libraries to allow multiple instance select boxes
    $this->getResponse()->addJavaScript('/vendor/jquery/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');
  }
}
