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
 * Information Object - editIsad
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editIsad template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectEditIsadAction extends InformationObjectEditAction
{
  public function execute($request)
  {
    $this->context->getRouting()->setDefaultParameter('informationobject_template', 'isad');

    // run the core informationObject edit action commands
    parent::execute($request);

    // Get ISAD specific event types
    $this->isadEventTypes = QubitTerm::getIsadEventTypeList();

    // Get event dates and creator actorEvents
    $this->eventDates = $this->informationObject->getDates();
    $this->creatorEvents = $this->informationObject->getActorEvents(array('eventTypeId' => QubitTerm::CREATION_ID));

    // Split notes into "Notes" (general notes), Title notes and Publication notes
    $this->notes = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID));
    $this->archivistsNotes = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID));
    $this->publicationNote = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
  }

  /**
   * Update ISAD notes
   *
   * @param QubitInformationObject $informationObject
   */
  public function updateNotes()
  {
    $userId = $this->getUser()->getAttribute('user_id');

    // Update publication notes (multiple)
    foreach ((array) $this->getRequestParameter('new_publication_note') as $newPublicationNote)
    {
      if (0 < strlen($newPublicationNote))
      {
        $this->informationObject->setNote(array('userId' => $userId, 'note' => $newPublicationNote, 'noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
      }
    }

    // Update (general) notes (multiple)
    foreach ((array) $this->getRequestParameter('new_note') as $newNote)
    {
      if (0 < strlen($newNote))
      {
        $this->informationObject->setNote(array('userId' => $userId, 'note' => $newNote, 'noteTypeId' => QubitTerm::GENERAL_NOTE_ID));
      }
    }

    // Update (general) notes (multiple)
    foreach ((array) $this->getRequestParameter('new_archivist_note') as $newArchivistNote)
    {
      if (0 < strlen($newArchivistNote))
      {
        $this->informationObject->setNote(array('userId' => $userId, 'note' => $newArchivistNote, 'noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID));
      }
    }
  }

  /**
   * ISAD form only allows entering data for creation dates and creator names,
   * as two separate events.
   *
   * @param QubitInformationObject $informationObject
   */
  public function updateActorEvents()
  {
    parent::updateActorEvents();

    // Update creators
    foreach ((array) $this->getRequestParameter('addCreator') as $creatorFormData)
    {
      if (0 < strlen($creatorFormData['actorId']) || 0 < strlen($creatorFormData['newName']))
      {
        $event = new QubitEvent;
        $event->setTypeId(QubitTerm::CREATION_ID);
        $event->setInformationObjectId($this->informationObject->getId());

        // Link actor (create a new actor if necessary)
        if (0 < intval($actorId = $creatorFormData['actorId']) && (null != $actor = QubitActor::getById($actorId)))
        {
          $event->setActorId($actor->getId());
        }
        else if (0 < strlen($newActorName = $creatorFormData['newName']))
        {
          $actor = new QubitActor;
          $actor->setAuthorizedFormOfName($newActorName);
          $actor->save();

          $event->setActorId($actor->getId());
        }

        // Check to make sure this actor isn't already listed as a creator
        $c = new Criteria;
        $c->add(QubitEvent::INFORMATION_OBJECT_ID, $this->informationObject->getId(), Criteria::EQUAL);
        $c->addAnd(QubitEvent::ACTOR_ID, $actor->getId(), Criteria::EQUAL);
        $c->addAnd(QubitEvent::TYPE_ID, QubitTerm::CREATION_ID, Criteria::EQUAL);
        $existingActorEvent = QubitEvent::get($c);

        if (0 == count($existingActorEvent))
        {
          $event->save();
        }
      }
    }
  }
}
