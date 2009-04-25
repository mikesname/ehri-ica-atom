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
 * Information Object - editMods
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editMods template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectEditModsAction extends InformationObjectEditAction
{
  public function execute($request)
  {
    $this->context->getRouting()->setDefaultParameter('informationobject_template', 'mods');

    // run the core informationObject edit action commands
    parent::execute($request);

    // add MODS specific commands
    $this->modsSubTitles = $this->informationObject->getNotesByTaxonomy(array('taxonomyId' => QubitTaxonomy::MODS_TITLE_TYPE_ID));
    $this->modsSubTitleTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::MODS_TITLE_TYPE_ID);

    $this->actorEventTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::EVENT_TYPE_ID, array('displayNote' => true));
    $this->actorEvents = $this->informationObject->getActorEvents();
  }

  public function updateNotes()
  {
    // update MODS subtitles
    if (0 < strlen($modsSubTitle = $this->getRequestParameter('mods_subtitle')))
    {
      $this->informationObject->setNote(array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $modsSubTitle, 'noteTypeId' => $this->getRequestParameter('mods_subtitle_type')));
    }
  }

  public function updateActorEvents()
  {
    if (is_array($this->getRequestParameter('addActor')))
    {
      $actorFormData = $this->getRequestParameter('addActor');
      $actorEvent = new QubitEvent;
      $saveEvent = false;

      // Use existing actor if one is selected (overrides new actor creation)
      if (0 < strlen($actorFormData['actorId']))
      {
        $actorEvent->setActorId($actorFormData['actorId']);
        $saveEvent = true;
      }

      // or, create a new actor and associate with Actor Event
      else if (0 < strlen($actorFormData['newActorName']))
      {
        // Create actor
        $actor = new QubitActor;
        $actor->setAuthorizedFormOfName($actorFormData['newActorName']);
        $actor->save();

        // Assign actor to event
        $actorEvent->setActorId($actor->getId());
        $saveEvent = true;
      }

      if ($saveEvent)
      {
        $actorEvent->setInformationObjectId($this->informationObject->getId());
        $actorEvent->setTypeId($actorFormData['eventTypeId']);
        $actorEvent->save();
      }
    }
  }
}
