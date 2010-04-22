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
  /**
   * Define form field names
   *
   * @var string
   */
  public static $NAMES = array(
    'entityType',
    'authorizedFormOfName',
    'parallelName',
    'standardizedName',
    'otherName',
    'corporateBodyIdentifiers',
    'datesOfExistence',
    'history',
    'places',
    'legalStatus',
    'functions',
    'mandates',
    'internalStructures',
    'generalContext',
    'descriptionIdentifier',
    'institutionResponsibleIdentifier',
    'rules',
    'descriptionStatus',
    'descriptionDetail',
    'revisionHistory',
    'language',
    'script',
    'sources',
    'maintenanceNotes',
    'relatedActor[authorizedFormOfName]',
    'relatedActor[type]',
    'relatedActor[description]',
    'relatedActor[startDate]',
    'relatedActor[endDate]',
    'relatedActor[dateDisplay]',
    'relatedResource[informationObject]',
    'relatedResource[type]',
    'relatedResource[resourceType]',
    'relatedResource[startDate]',
    'relatedResource[endDate]',
    'relatedResource[dateDisplay]',
  );

  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->actor = new QubitActor;

    if (isset($request->id))
    {
      $this->actor = QubitActor::getById($request->id);

      if (!isset($this->actor))
      {
        $this->forward404();
      }

      // Check user authorization
      if (!QubitAcl::check($this->actor, 'update'))
      {
        QubitAcl::forwardUnauthorized();
      }

      // Add optimistic lock
      $this->form->setDefault('serialNumber', $this->actor->serialNumber);
      $this->form->setValidator('serialNumber', new sfValidatorInteger);
      $this->form->setWidget('serialNumber', new sfWidgetFormInputHidden);
    }
    else
    {
      // Check user authorization against Actor ROOT
      if (!QubitAcl::check(QubitActor::getById(QubitActor::ROOT_ID), 'create'))
      {
        QubitAcl::forwardUnauthorized();
      }
    }

    //Actor Relations
    $this->actorRelations = $this->actor->getActorRelations();

    //Related resources (events)
    $this->events = $this->actor->getEvents();
    $this->resourceTypeTerms = array(QubitTerm::getById(QubitTerm::ARCHIVAL_MATERIAL_ID));

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

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        //set redirect if actor edit was called from another module
        if ($this->getRequestParameter('repositoryReroute'))
        {
          $this->redirect('repository/edit?id='.$this->getRequestParameter('repositoryReroute'));
        }

        if ($this->getRequestParameter('informationObjectReroute'))
        {
          $this->redirect('informationobject/edit?id='.$this->getRequestParameter('informationObjectReroute'));
        }

        $this->redirect(array($this->actor, 'module' => 'actor'));
      }
    }
  }

  public function addField($name)
  {
    switch ($name)
    {
      case 'entityType':
        $choices = array();
        $choices[null] = null;

        foreach (QubitTaxonomy::getTaxonomyTerms(QubitTaxonomy::ACTOR_ENTITY_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        if (null !== $this->actor->entityTypeId)
        {
          $this->form->setDefault($name, $this->context->routing->generate(null, array('module' => 'term', 'id' => $this->actor->entityTypeId)));
        }
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'parallelName':
      case 'standardizedName':
      case 'otherName':
        $criteria = new Criteria;
        $criteria = $this->actor->addotherNamesCriteria($criteria);

        switch ($name)
        {
          case 'parallelName':
            $criteria->add(QubitOtherName::TYPE_ID, QubitTerm::PARALLEL_FORM_OF_NAME_ID);
            break;
          case 'standardizedName':
            $criteria->add(QubitOtherName::TYPE_ID, QubitTerm::STANDARDIZED_FORM_OF_NAME_ID);
            break;
          default:
            $criteria->add(QubitOtherName::TYPE_ID, QubitTerm::OTHER_FORM_OF_NAME_ID);
        }

        $values = $defaults = array();
        if (0 < count($otherNames = QubitOtherName::get($criteria)))
        {
          foreach ($otherNames as $otherName)
          {
            $values[] = $otherName->id;
            $defaults[$otherName->id] = $otherName;
          }
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new QubitWidgetFormInputMany(array('defaults' => $defaults)));

        break;

      case 'descriptionStatus':
      case 'descriptionDetail':
        if (null !== $this->actor[$name.'Id'])
        {
          $this->form->setDefault($name, $this->context->routing->generate(null, array('module' => 'term', 'id' => $this->actor[$name.'Id'])));
        }

        $choices = array();
        $choices[null] = null;

        if ('descriptionStatus' == $name)
        {
          $terms = QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID);
        }
        else
        {
          $terms = QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID);
        }

        foreach ($terms as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'language':
        $this->form->setDefault($name, $this->actor[$name]);
        $this->form->setValidator($name, new sfValidatorI18nChoiceLanguage(array('multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormI18nSelectLanguage(array('culture' => $this->context->user->getCulture(), 'multiple' => true)));

        break;

      case 'script':
        $this->form->setDefault($name, $this->actor[$name]);
        $c = sfCultureInfo::getInstance($this->context->user->getCulture());
        $this->form->setValidator($name, new sfValidatorChoice(array('choices' => array_keys($c->getScripts()), 'multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $c->getScripts(), 'multiple' => true)));

        break;

      case 'maintenanceNotes':
        $this->maintenanceNote = null;

        // Check for existing maintenance note related to this object
        $maintenanceNotes = $this->actor->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));

        if (0 < count($maintenanceNotes))
        {
          $this->maintenanceNote = $maintenanceNotes[0];
          $this->form->setDefault($name, $this->maintenanceNote->content);
        }
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;

      case 'authorizedFormOfName':
      case 'corporateBodyIdentifiers':
      case 'datesOfExistence':
      case 'descriptionIdentifier':
      case 'institutionResponsibleIdentifier':
        $this->form->setDefault($name, $this->actor[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'history':
      case 'places':
      case 'legalStatus':
      case 'functions':
      case 'mandates':
      case 'internalStructures':
      case 'generalContext':
      case 'rules':
      case 'revisionHistory':
      case 'sources':
        $this->form->setDefault($name, $this->actor[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;

      case 'relatedActor[authorizedFormOfName]':
      case 'relatedResource[informationObject]':
        $choices = array();

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'relatedActor[type]':
        $this->form->setValidator($name, new sfValidatorString);

        $choices = array();
        $choices[null] = null;

        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_RELATION_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'relatedResource[type]':
        $this->form->setValidator($name, new sfValidatorString);

        $choices = array();
        $choices[null] = null;

        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::EVENT_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'relatedResource[resourceType]':
        $term = QubitTerm::getById(QubitTerm::ARCHIVAL_MATERIAL_ID);

        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setDefault($name, $this->context->routing->generate(null, array($term, 'module' => 'term')));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' =>
          array($this->context->routing->generate(null, array($term, 'module' => 'term')) => $term))));

        break;

      case 'relatedActor[startDate]':
      case 'relatedActor[endDate]':
      case 'relatedActor[dateDisplay]':
      case 'relatedResource[startDate]':
      case 'relatedResource[endDate]':
      case 'relatedResource[dateDisplay]':
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'relatedActor[description]':
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;
    }
  }

  /**
   * Process form fields
   *
   * @param $field mixed symfony form widget
   * @return void
   */
  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'entityType':
        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue($name)));
        $fieldId = (isset($params['id'])) ? $params['id'] : null;
        $this->actor[$name.'Id'] = $fieldId;

        break;

      case 'parallelName':
      case 'standardizedName':
      case 'otherName':
        $defaults = $this->form->getWidget($name)->getOption('defaults');

        if (null !== $this->form->getValue($name))
        {
          foreach ($this->form->getValue($name) as $key => $thisName)
          {
            if ('new' == substr($key, 0, 3) && 0 < strlen(trim($thisName)))
            {
              $otherName = new QubitOtherName;

              switch ($name)
              {
                case 'parallelName':
                  $otherName->typeId = QubitTerm::PARALLEL_FORM_OF_NAME_ID;
                  break;
                case 'standardizedName':
                  $otherName->typeId = QubitTerm::STANDARDIZED_FORM_OF_NAME_ID;
                  break;
                default:
                  $otherName->typeId = QubitTerm::OTHER_FORM_OF_NAME_ID;
              }
            }
            else
            {
              $otherName = QubitOtherName::getById($key);
              if (null === $otherName)
              {
                continue;
              }

              // Don't delete this name
              unset($defaults[$key]);
            }

            $otherName->name = $thisName;
            $this->actor->otherNames[] = $otherName;
          }
        }

        // Delete any names that are missing from form data
        foreach ($defaults as $key => $val)
        {
          if (null !== ($otherName = QubitOtherName::getById($key)))
          {
            $otherName->delete();
          }
        }

        break;

      case 'descriptionStatus':
      case 'descriptionDetail':
        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue($name)));
        $fieldId = (isset($params['id'])) ? $params['id'] : null;
        $this->actor[$name.'Id'] = $fieldId;

        break;

      case 'maintenanceNotes':
        // Check for existing maintenance note related to this object
        $maintenanceNotes = $this->actor->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));

        if (0 < count($maintenanceNotes))
        {
          $note = $maintenanceNotes[0];
        }
        else if (null !== $this->form->getValue($name))
        {
          // Create a maintenance note for this object if one doesn't exist
          $note = new QubitNote;
          $note->typeId = QubitTerm::MAINTENANCE_NOTE_ID;
        }
        else
        {

          break;
        }

        $note->content = $this->form->getValue($name);

        $this->actor->notes[] = $note;

        break;

      default:
        $this->actor[$field->getName()] = $this->form->getValue($field->getName());
    }
  }

  protected function processForm()
  {
    foreach ($this->form as $field)
    {
      $this->processField($field);
    }

    $this->updateActorRelations();
    $this->deleteActorRelations();
    $this->updateEvents();
    $this->deleteEvents();

    $this->actor->save();
  }

  /**
   * Update actor relationships
   */
  protected function updateActorRelations()
  {
    if ($this->hasRequestParameter('relatedActors'))
    {
      // Javascript (multiple) update
      $relationsData = $this->getRequestParameter('relatedActors');
    }
    else if ($this->hasRequestParameter('relatedActor'))
    {
      // Non-javascript (single) update
      $relationsData = array($this->getRequestParameter('relatedActor'));
    }
    else
    {
      return;
    }

    // Loop through related actors
    foreach ($relationsData as $relationData)
    {
      // Get related actor
      $params = $this->context->routing->parse(Qubit::pathInfo($relationData['authorizedFormOfName']));
      $relatedObjectId = (isset($params['id'])) ? $params['id'] : null;
      if (null === $relatedObject = QubitActor::getById($relatedObjectId))
      {
        continue; // If no related object, skip update
      }

      // Get relation
      if (isset($relationData['id']))
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($relationData['id']));

        if (null === $relation = QubitRelation::getById($params['id']))
        {
          // If a relation id is passed, but relation object doesn't exist then
          // skip this row
          continue;
        }
      }
      else
      {
        $relation = new QubitRelation;
      }

      // Set category (typeId)
      $params = $this->context->routing->parse(Qubit::pathInfo($relationData['type']));
      $typeId = (isset($params['id'])) ? $params['id'] : null;
      $relation->typeId = $typeId;

      $relation->startDate = QubitDate::standardize($relationData['startDate']);
      $relation->endDate = QubitDate::standardize($relationData['endDate']);

      // Add notes
      $relation->updateNote($relationData['description'], QubitTerm::RELATION_NOTE_DESCRIPTION_ID);
      $relation->updateNote($relationData['dateDisplay'], QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID);

      // Default to current actor as the subject of the relationship
      if ($relation->subjectId == $this->actor->id || null == $relation->subjectId)
      {
        $relation->object = $relatedObject;
        $this->actor->relationsRelatedBysubjectId[] = $relation;
      }
      else
      {
        $relation->subject = $relatedObject;
        $this->actor->relationsRelatedByobjectId[] = $relation;
      }
    }

    return $this;
  }

  protected function deleteActorRelations()
  {
    if ($this->hasRequestParameter('deleteRelations'))
    {
      foreach ((array) $this->getRequestParameter('deleteRelations') as $relationId => $value)
      {
        $relation = QubitRelation::getById($relationId);
        $relation->delete();
      }
    }
  }

  /**
   * Add or update events related to this actor
   *
   * @return ActorEditAction this object
   */
  protected function updateEvents()
  {
    if ($this->hasRequestParameter('relatedResources'))
    {
      // The 'updateEvents' array is created by the actorEventDialog.js
      $updateEvents = $this->getRequestParameter('relatedResources');
    }
    else if ($this->hasRequestParameter('relatedResource'))
    {
      // The 'newEvent' array means a non-javascript form submission
      $updateEvents = array($this->getRequestParameter('relatedResource'));
    }
    else
    {
      return;
    }

    // Loop through actor events
    foreach ($updateEvents as $eventFormData)
    {
      // Create new event or update an existing one
      if (isset($eventFormData['id']))
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($eventFormData['id']));
        if (null === $event = QubitEvent::getById($params['id']))
        {
          continue; // If we can't find the object, then skip this row
        }
      }
      else
      {
        $event = new QubitEvent;
      }

      // Assign resource to event
      if (0 == strlen($eventFormData['informationObject']))
      {
        continue; // If no resource name, don't update event
      }
      else
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($eventFormData['informationObject']));

        // Assign resource to event
        $event->informationObjectId = $params['id'];
      }

      // Set type
      $params = $this->context->routing->parse(Qubit::pathInfo($eventFormData['type']));
      $typeId = (isset($params['id'])) ? $params['id'] : null;
      $event->typeId = $typeId;

      // Update other event properties
      $event->dateDisplay = $eventFormData['dateDisplay'];
      $event->startDate = QubitDate::standardize($eventFormData['startDate']);
      $event->endDate = QubitDate::standardize($eventFormData['endDate']);

      $this->actor->events[] = $event;
    }

    return $this;
  }

  /**
   * Delete related events that are marked for deletion.
   *
   * @return ActorEditAction $this object
   */
  public function deleteEvents()
  {
    if (is_array($deleteEvents = $this->getRequestParameter('deleteEvents')) && count($deleteEvents))
    {
      foreach ($deleteEvents as $deleteId => $doDelete)
      {
        if (null !== ($event = QubitEvent::getById($deleteId)))
        {
          $event->delete();
        }
      }
    }

    return $this;
  }
}
