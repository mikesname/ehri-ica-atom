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
class sfIsadPluginEditAction extends InformationObjectEditAction
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
        $this->object->addEventsCriteria($criteria);
        $criteria->add(QubitEvent::ACTOR_ID, null, Criteria::ISNOTNULL);
        $criteria->add(QubitEvent::TYPE_ID, QubitTerm::CREATION_ID);

        $values = array();
        $choices = array();
        foreach ($this->events = QubitEvent::get($criteria) as $event)
        {
          $values[] = $this->context->routing->generate(null, array($event->actor, 'module' => 'actor'));
          $choices[$this->context->routing->generate(null, array($event->actor, 'module' => 'actor'))] = $event->actor;
        }

        $this->form->setDefault('creators', $values);
        $this->form->setValidator('creators', new sfValidatorPass);
        $this->form->setWidget('creators', new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;

      case 'appraisal':
        $this->form->setDefault($name, $this->object[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;
    }
  }

  public function execute($request)
  {
    parent::execute($request);

    $title = $this->context->i18n->__('Add archival description');
    if (isset($request->id))
    {
      if (1 > strlen($title = QubitIsad::getLabel($this->object)))
      {
        $title = $this->context->i18n->__('Untitled');
      }
      $title = 'Edit '.$title;
    }
    $this->response->setTitle($title.' - '.$this->response->getTitle());

    // Get ISAD specific event types
    $this->isadEventTypes = QubitTerm::getIsadEventTypeList();

    // Get event dates and creator actorEvents
    $this->eventDates = $this->object->getDates();

    // Split notes into "Notes" (general notes), Title notes and Publication notes
    $this->notes = $this->object->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID));
    $this->archivistsNotes = $this->object->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID));
    $this->publicationNotes = $this->object->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
  }

  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'creators':
        $filtered = $flipped = array();
        foreach ($this->form->getValue('creators') as $value)
        {
          $params = $this->context->routing->parse(Qubit::pathInfo($value));
          $filtered[$params['id']] = $flipped[$params['id']] = $params['id'];
        }

        foreach ($this->events as $event)
        {
          if (isset($flipped[$event->actor->id]))
          {
            unset($filtered[$event->actor->id]);
          }
          else if (false == isset($this->request->sourceId))
          {
            $event->delete();
          }
        }

        foreach ($filtered as $id)
        {
          $event = new QubitEvent;
          $event->actorId = $id;
          $event->typeId = QubitTerm::CREATION_ID;

          $this->object->events[] = $event;
        }

        break;

      default:

        return parent::processField($field);
    }
  }

  protected function processForm()
  {
    $this->updateNotes();

    return parent::processForm();
  }

  /**
   * Update ISAD notes
   *
   * @param QubitInformationObject $informationObject
   */
  protected function updateNotes()
  {
    // Update archivist's notes (multiple)
    foreach ((array) $this->request->new_archivist_note as $content)
    {
      if (0 < strlen($content))
      {
        $note = new QubitNote;
        $note->content = $content;
        $note->typeId = QubitTerm::ARCHIVIST_NOTE_ID;
        $note->userId = $this->context->user->getAttribute('user_id');

        $this->object->notes[] = $note;
      }
    }

    // Update publication notes (multiple)
    foreach ((array) $this->request->new_publication_note as $content)
    {
      if (0 < strlen($content))
      {
        $note = new QubitNote;
        $note->content = $content;
        $note->typeId = QubitTerm::PUBLICATION_NOTE_ID;
        $note->userId = $this->context->user->getAttribute('user_id');

        $this->object->notes[] = $note;
      }
    }

    // Update general notes (multiple)
    foreach ((array) $this->request->new_note as $content)
    {
      if (0 < strlen($content))
      {
        $note = new QubitNote;
        $note->content = $content;
        $note->typeId = QubitTerm::GENERAL_NOTE_ID;
        $note->userId = $this->context->user->getAttribute('user_id');

        $this->object->notes[] = $note;
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
    if (isset($this->request->updateEvents))
    {
      foreach ($this->request->updateEvents as $updateDate)
      {
        if (isset($updateDate['id']))
        {
          $event = QubitEvent::getById($updateDate['id']);
          if (!isset($event))
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

        $this->object->events[] = $event;
      }
    }
  }
}
