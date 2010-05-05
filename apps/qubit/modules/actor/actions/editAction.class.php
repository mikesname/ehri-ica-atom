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
  public static
    $NAMES = array(
      'authorizedFormOfName',
      'corporateBodyIdentifiers',
      'datesOfExistence',
      'descriptionDetail',
      'descriptionIdentifier',
      'descriptionStatus',
      'entityType',
      'functions',
      'generalContext',
      'history',
      'institutionResponsibleIdentifier',
      'internalStructures',
      'language',
      'legalStatus',
      'maintenanceNotes',
      'mandates',
      'otherName',
      'parallelName',
      'places',
      'relatedActor[authorizedFormOfName]',
      'relatedActor[dateDisplay]',
      'relatedActor[endDate]',
      'relatedActor[description]',
      'relatedActor[startDate]',
      'relatedActor[type]',
      'relatedResource[dateDisplay]',
      'relatedResource[endDate]',
      'relatedResource[informationObject]',
      'relatedResource[resourceType]',
      'relatedResource[startDate]',
      'relatedResource[type]',
      'revisionHistory',
      'rules',
      'script',
      'sources',
      'standardizedName');

  public function addField($name)
  {
    switch ($name)
    {
      case 'entityType':
        $this->form->setDefault('entityType', $this->context->routing->generate(null, array($this->actor->entityType, 'module' => 'term')));
        $this->form->setValidator('entityType', new sfValidatorPass);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTaxonomyTerms(QubitTaxonomy::ACTOR_ENTITY_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('entityType', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'otherName':
      case 'parallelName':
      case 'standardizedName':
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
        foreach (QubitOtherName::get($criteria) as $otherName)
        {
          $values[] = $otherName->id;
          $defaults[$otherName->id] = $otherName;
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new QubitWidgetFormInputMany(array('defaults' => $defaults)));

        break;

      case 'descriptionDetail':
      case 'descriptionStatus':
        $this->form->setDefault($name, $this->context->routing->generate(null, array($this->actor[$name], 'module' => 'term')));

        if ('descriptionStatus' == $name)
        {
          $terms = QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID);
        }
        else
        {
          $terms = QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID);
        }

        $choices = array();
        $choices[null] = null;
        foreach ($terms as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'language':
        $this->form->setDefault('language', $this->actor->language);
        $this->form->setValidator('language', new sfValidatorI18nChoiceLanguage(array('multiple' => true)));
        $this->form->setWidget('language', new sfWidgetFormI18nSelectLanguage(array('culture' => $this->context->user->getCulture(), 'multiple' => true)));

        break;

      case 'script':
        $this->form->setDefault('script', $this->actor->script);

        $c = sfCultureInfo::getInstance($this->context->user->getCulture());

        $this->form->setValidator('script', new sfValidatorChoice(array('choices' => array_keys($c->getScripts()), 'multiple' => true)));
        $this->form->setWidget('script', new sfWidgetFormSelect(array('choices' => $c->getScripts(), 'multiple' => true)));

        break;

      case 'maintenanceNotes':
        $this->maintenanceNote = null;

        // Check for existing maintenance note related to this object
        $maintenanceNotes = $this->actor->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));
        if (0 < count($maintenanceNotes))
        {
          $this->maintenanceNote = $maintenanceNotes[0];
          $this->form->setDefault('maintenanceNotes', $this->maintenanceNote->content);
        }

        $this->form->setValidator('maintenanceNotes', new sfValidatorString);
        $this->form->setWidget('maintenanceNotes', new sfWidgetFormTextarea);

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

      case 'functions':
      case 'generalContext':
      case 'history':
      case 'internalStructures':
      case 'legalStatus':
      case 'mandates':
      case 'places':
      case 'revisionHistory':
      case 'rules':
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
        $this->form->setValidator('relatedActor[type]', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_RELATION_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('relatedActor[type]', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'relatedResource[type]':
        $this->form->setValidator('relatedResource[type]', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::EVENT_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('relatedResource[type]', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'relatedResource[resourceType]':
        $term = QubitTerm::getById(QubitTerm::ARCHIVAL_MATERIAL_ID);

        $this->form->setValidator('relatedResource[resourceType]', new sfValidatorPass);
        $this->form->setDefault('relatedResource[resourceType]', $this->context->routing->generate(null, array($term, 'module' => 'term')));
        $this->form->setWidget('relatedResource[resourceType]', new sfWidgetFormSelect(array('choices' => array($this->context->routing->generate(null, array($term, 'module' => 'term')) => $term))));

        break;

      case 'relatedActor[dateDisplay]':
      case 'relatedActor[endDate]':
      case 'relatedActor[startDate]':
      case 'relatedResource[dateDisplay]':
      case 'relatedResource[endDate]':
      case 'relatedResource[startDate]':
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'relatedActor[description]':
        $this->form->setValidator('relatedActor[description]', new sfValidatorString);
        $this->form->setWidget('relatedActor[description]', new sfWidgetFormTextarea);

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
        unset($this->actor->entityType);

        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue('entityType')));
        if (isset($params['id']))
        {
          $this->actor->entityTypeId = $params['id'];
        }

        break;

      case 'otherName':
      case 'parallelName':
      case 'standardizedName':
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
              if (!isset($otherName))
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

      case 'descriptionDetail':
      case 'descriptionStatus':
        unset($this->actor[$field->getName()]);

        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue($name)));
        if (isset($params['id']))
        {
          $this->actor[$field->getName().'Id'] = $params['id'];
        }

        break;

      case 'maintenanceNotes':

        // Check for existing maintenance note related to this object
        $maintenanceNotes = $this->actor->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));

        if (0 < count($maintenanceNotes))
        {
          $note = $maintenanceNotes[0];
        }
        else if (null !== $this->form->getValue('maintenanceNotes'))
        {
          // Create a maintenance note for this object if one doesn't exist
          $note = new QubitNote;
          $note->typeId = QubitTerm::MAINTENANCE_NOTE_ID;
        }
        else
        {
          break;
        }

        $note->content = $this->form->getValue('maintenanceNotes');

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

  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->actor = new QubitActor;

     // Make root actor the parent of new actors
    $this->actor->parentId = QubitActor::ROOT_ID;

    if (isset($request->id))
    {
      $this->actor = QubitActor::getById($request->id);

      // Check that object exists and that it's not the root
      if (!isset($this->actor) || !isset($this->actor->parent))
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

  /**
   * Update actor relationships
   */
  protected function updateActorRelations()
  {
    if ($this->hasRequestParameter('relatedActors'))
    {
      // JavaScript (multiple) update
      $relationsData = $this->getRequestParameter('relatedActors');
    }
    else if ($this->hasRequestParameter('relatedActor'))
    {
      // Non-JavaScript (single) update
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
