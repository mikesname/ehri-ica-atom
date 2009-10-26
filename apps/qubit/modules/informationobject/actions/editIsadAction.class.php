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
 * @author     Jesús García Crespo <correo@sevein.com>
 * @version    SVN: $Id$
 */
class InformationObjectEditIsadAction extends InformationObjectEditAction
{
  // Arrays are not allowed in class constants
  public static
    $NAMES = array(
      'accessConditions',
      'accruals',
      'acquisition',
      'appraisal',
      'archivalHistory',
      'arrangement',
      'creators',
      'descriptionDetail',
      'descriptionIdentifier',
      'extentAndMedium',
      'findingAids',
      'identifier',
      'institutionResponsibleIdentifier',
      'languageOfDescription',
      'language',
      'levelOfDescription',
      'locationOfCopies',
      'locationOfOriginals',
      'nameAccessPoints',
      'physicalCharacteristics',
      'placeAccessPoints',
      'relatedUnitsOfDescription',
      'repository',
      'reproductionConditions',
      'revisionHistory',
      'rules',
      'scopeAndContent',
      'scriptOfDescription',
      'script',
      'sources',
      'subjectAccessPoints',
      'descriptionStatus',
      'publicationStatus',
      'title');

  protected function addField($name)
  {
    parent::addField($name);

    switch ($name)
    {
      case 'creators':
        $criteria = new Criteria;
        $this->informationObject->addEventsCriteria($criteria);
        $criteria->add(QubitEvent::ACTOR_ID, null, Criteria::ISNOTNULL);
        $criteria->add(QubitEvent::TYPE_ID, QubitTerm::CREATION_ID);

        $values = array();
        $choices = array();
        foreach ($this->events = QubitEvent::get($criteria) as $event)
        {
          $values[] = $this->context->routing->generate(null, array('module' => 'actor', 'action' => 'show', 'id' => $event->actor->id));
          $choices[$this->context->routing->generate(null, array('module' => 'actor', 'action' => 'show', 'id' => $event->actor->id))] = $event->actor;
        }

        $this->form->setDefault('creators', $values);
        $this->form->setValidator('creators', new sfValidatorPass);
        $this->form->setWidget('creators', new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;

      case 'appraisal':
        $this->form->setDefault($name, $this->informationObject[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;
    }
  }

  public function execute($request)
  {
    parent::execute($request);

    // Get ISAD specific event types
    $this->isadEventTypes = QubitTerm::getIsadEventTypeList();

    // Get event dates and creator actorEvents
    $this->eventDates = $this->informationObject->getDates();

    // Split notes into "Notes" (general notes), Title notes and Publication notes
    $this->notes = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID));
    $this->archivistsNotes = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID));
    $this->publicationNote = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
  }

  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'creators':
        $filtered = $flipped = array();
        foreach ($this->form->getValue('creators') as $value)
        {
          $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $value));
          $filtered[$params['id']] = $flipped[$params['id']] = $params['id'];
        }

        foreach ($this->events as $event)
        {
          if (isset($flipped[$event->actor->id]))
          {
            unset($filtered[$event->actor->id]);
          }
          else
          {
            $event->delete();
          }
        }

        foreach ($filtered as $id)
        {
          $event = new QubitEvent;
          $event->actorId = $id;
          $event->typeId = QubitTerm::CREATION_ID;

          $this->informationObject->events[] = $event;
        }

        break;

      default:
        parent::processField($field);
    }
  }

  /**
   * Update ISAD notes
   *
   * @param QubitInformationObject $informationObject
   */
  protected function updateNotes()
  {
    $userId = $this->getUser()->getAttribute('user_id');

    // Update archivist's notes (multiple)
    foreach ((array) $this->getRequestParameter('new_archivist_note') as $newArchivistNote)
    {
      if (0 < strlen($newArchivistNote))
      {
        $this->informationObject->setNote(array('userId' => $userId, 'note' => $newArchivistNote, 'noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID));
      }
    }

    // Update publication notes (multiple)
    foreach ((array) $this->getRequestParameter('new_publication_note') as $newNote)
    {
      if (0 < strlen($newNote))
      {
        $this->informationObject->setNote(array('userId' => $userId, 'note' => $newNote, 'noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
      }
    }

    // Update general notes (multiple)
    foreach ((array) $this->getRequestParameter('new_note') as $newNote)
    {
      if (0 < strlen($newNote))
      {
        $this->informationObject->setNote(array('userId' => $userId, 'note' => $newNote, 'noteTypeId' => QubitTerm::GENERAL_NOTE_ID));
      }
    }
  }

  /**
   * ISAD form only allows entering data for creation dates and creator names,
   * as two separate events.
   *
   * @param QubitInformationObject $informationObject
   */
  public function updateEvents()
  {
    // Update dates
    foreach ($this->getRequestParameter('updateEvents') as $updateDate)
    {
      if (isset($updateDate['id']))
      {
        if (null === ($event = QubitEvent::getById($updateDate['id'])))
        {
          continue; // If event id isn't valid, skip this row
        }
      }
      else if (0 < strlen($updateDate['startDate']) || 0 < strlen($updateDate['dateDisplay']))
      {
        $event = new QubitEvent;
      }
      else
      {
        continue;
      }

      $event->setTypeId($updateDate['typeId']);
      $event->setStartDate(QubitDate::standardize($updateDate['startDate']));
      $event->setEndDate(QubitDate::standardize($updateDate['endDate']));
      $event->setDateDisplay($updateDate['dateDisplay']);

      $this->informationObject->events[] = $event;
    }
  }
}
