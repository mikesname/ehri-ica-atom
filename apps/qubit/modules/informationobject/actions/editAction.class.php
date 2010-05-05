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
 * Get current state data for information object edit form.
 *
 * @package    qubit
 * @subpackage informationobject
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class InformationObjectEditAction extends sfAction
{
  protected function addField($name)
  {
    switch ($name)
    {
      case 'descriptionDetail':
        $this->form->setDefault('descriptionDetail', $this->context->routing->generate(null, array($this->object->descriptionDetail, 'module' => 'term')));
        $this->form->setValidator('descriptionDetail', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('descriptionDetail', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'descriptionStatus':
        $this->form->setDefault('descriptionStatus', $this->context->routing->generate(null, array($this->object->descriptionStatus, 'module' => 'term')));
        $this->form->setValidator('descriptionStatus', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('descriptionStatus', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'language':
      case 'languageOfDescription':
        $this->form->setDefault($name, $this->object[$name]);
        $this->form->setValidator($name, new sfValidatorI18nChoiceLanguage(array('multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormI18nSelectLanguage(array('culture' => $this->context->user->getCulture(), 'multiple' => true)));

        break;

      case 'levelOfDescription':
        $this->form->setDefault('levelOfDescription', $this->context->routing->generate(null, array($this->object->levelOfDescription, 'module' => 'term')));
        $this->form->setValidator('levelOfDescription', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTaxonomyTerms(QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('levelOfDescription', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'publicationStatus':
        $choices = array();

        if (null !== $publicationStatus = $this->object->getStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID)))
        {
          $this->form->setDefault('publicationStatus', $publicationStatus->statusId);
        }
        $this->form->setValidator('publicationStatus', new sfValidatorString);

        if (QubitAcl::check($this->object, 'publish'))
        {
          foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::PUBLICATION_STATUS_ID) as $term)
          {
            $choices[$term->id] = $term->getName(array('cultureFallback' => true));
          }

          $this->form->setWidget('publicationStatus', new sfWidgetFormSelect(array('choices' => $choices)));
        }
        else
        {
          if (isset($publicationStatus))
          {
            $choices = array($publicationStatus->id => QubitTerm::getById($publicationStatus->statusId)->__toString());
          }

          // disable widget if user does not have 'publish' permission
          $this->form->setWidget('publicationStatus', new sfWidgetFormSelect(array('choices' => $choices), array('disabled' => true)));
        }

        break;

      case 'repository':
        $this->form->setDefault('repository', $this->context->routing->generate(null, array($this->object->repository, 'module' => 'repository')));
        $this->form->setValidator('repository', new sfValidatorString);
        $this->form->setWidget('repository', new sfWidgetFormSelect(array('choices' => array($this->context->routing->generate(null, array($this->object->repository, 'module' => 'repository')) => $this->object->repository))));

        if (isset($this->request->id))
        {
          $this->repoAcParams = array('module' => 'repository', 'action' => 'autocomplete', 'aclAction' => 'update');
        }
        else
        {
          $this->repoAcParams = array('module' => 'repository', 'action' => 'autocomplete', 'aclAction' => 'create');
        }

        break;

      case 'script':
      case 'scriptOfDescription':
        $this->form->setDefault($name, $this->object[$name]);

        $c = sfCultureInfo::getInstance($this->context->user->getCulture());

        $this->form->setValidator($name, new sfValidatorChoice(array('choices' => array_keys($c->getScripts()), 'multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $c->getScripts(), 'multiple' => true)));

        break;

      case 'accessConditions':
      case 'accruals':
      case 'acquisition':
      case 'archivalHistory':
      case 'arrangement':
      case 'extentAndMedium':
      case 'findingAids':
      case 'locationOfCopies':
      case 'locationOfOriginals':
      case 'physicalCharacteristics':
      case 'relatedUnitsOfDescription':
      case 'reproductionConditions':
      case 'revisionHistory':
      case 'rules':
      case 'scopeAndContent':
      case 'sources':
        $this->form->setDefault($name, $this->object[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;

      case 'descriptionIdentifier':
      case 'identifier':
      case 'institutionResponsibleIdentifier':
      case 'title':
        $this->form->setDefault($name, $this->object[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'subjectAccessPoints':
      case 'placeAccessPoints':
        $criteria = new Criteria;
        $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID, Criteria::INNER_JOIN);
        $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->object->id);

        switch($name)
        {
          case 'subjectAccessPoints':
            $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::SUBJECT_ID);

            break;

          case 'placeAccessPoints':
            $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::PLACE_ID);

            break;
        }

        $values = array();
        $choices = array();
        foreach (QubitObjectTermRelation::get($criteria) as $item)
        {
          $values[] = $this->context->routing->generate(null, array($item->term, 'module' => 'term'));
          $choices[$this->context->routing->generate(null, array($item->term, 'module' => 'term'))] = $item->term;
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;

      case 'nameAccessPoints':
        $criteria = new Criteria;
        $criteria->add(QubitRelation::SUBJECT_ID, $this->object->id);
        $criteria->add(QubitRelation::TYPE_ID, QubitTerm::NAME_ACCESS_POINT_ID);

        $values = array();
        $choices = array();
        foreach (QubitRelation::get($criteria) as $item)
        {
          $values[] = $this->context->routing->generate(null, array($item->object, 'module' => 'actor'));
          $choices[$this->context->routing->generate(null, array($item->object, 'module' => 'actor'))] = $item->object;
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;
    }
  }

  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'descriptionDetail':
      case 'descriptionStatus':
      case 'levelOfDescription':
      case 'parent':
      case 'repository':
        unset($this->object[$field->getName()]);

        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue($field->getName())));
        if (isset($params['id']))
        {
          $this->object[$field->getName().'Id'] = $params['id'];
        }

        break;

      case 'subjectAccessPoints':
      case 'placeAccessPoints':
        $filtered = $selected = array();
        $values = $this->form->getValue($name);
        if (is_array($values) && 0 < count($values))
        {
          foreach ($values as $value)
          {
            $params = $this->context->routing->parse(Qubit::pathInfo($value));
            $filtered[$params['id']] = $selected[$params['id']] = $params['id'];
          }
        }

        $criteria = new Criteria;
        $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID);
        $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->object->id);

        switch ($field->getName())
        {
          case 'subjectAccessPoints':
            $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::SUBJECT_ID);

            break;

          case 'placeAccessPoints':
            $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::PLACE_ID);

            break;
        }

        foreach (QubitObjectTermRelation::get($criteria) as $item)
        {
          if (isset($selected[$item->term->id]))
          {
            unset($filtered[$item->term->id]);
          }
          else
          {
            $item->delete();
          }
        }

        foreach ($filtered as $id)
        {
          $objectTermRelation = new QubitObjectTermRelation;
          $objectTermRelation->termId = $id;

          $this->object->objectTermRelationsRelatedByobjectId[] = $objectTermRelation;
        }

        break;

      case 'nameAccessPoints':
        $filtered = $selected = array();
        $values = $this->form->getValue($name);
        if (is_array($values) && 0 < count($values))
        {
          foreach ($values as $value)
          {
            $params = $this->context->routing->parse(Qubit::pathInfo($value));
            $filtered[$params['id']] = $selected[$params['id']] = $params['id'];
          }
        }

        $criteria = new Criteria;
        $criteria->add(QubitRelation::SUBJECT_ID, $this->object->id);
        $criteria->add(QubitRelation::TYPE_ID, QubitTerm::NAME_ACCESS_POINT_ID);

        foreach (QubitRelation::get($criteria) as $item)
        {
          if (isset($selected[$item->objectId]))
          {
            unset($filtered[$item->objectId]);
          }
          else
          {
            $item->delete();
          }
        }

        foreach ($filtered as $id)
        {
          $relation = new QubitRelation;

          $relation->objectId = $id;
          $relation->typeId = QubitTerm::NAME_ACCESS_POINT_ID;

          $this->object->relationsRelatedBysubjectId[] = $relation;
        }

        break;

      default:
        $this->object[$field->getName()] = $this->form->getValue($field->getName());
    }
  }

  protected function processForm()
  {
    foreach ($this->form as $field)
    {
      if (isset($this->request[$field->getName()]))
      {
        $this->processField($field);
      }
    }

    // If object is being duplicated
    if (isset($this->request->sourceId))
    {
      $sourceInformationObject = QubitInformationObject::getById($this->request->sourceId);

      // Duplicate physical object relations
      foreach ($sourceInformationObject->getPhysicalObjects() as $physicalObject)
      {
        $this->object->addPhysicalObject($physicalObject);
      }

      // Duplicate notes
      foreach ($sourceInformationObject->notes as $sourceNote)
      {
        if (false == isset($this->request->delete_notes[$sourceNote->id]))
        {
          $note = new QubitNote;
          $note->content = $sourceNote->content;
          $note->typeId = $sourceNote->type->id;
          $note->userId = $this->context->user->getAttribute('user_id');

          $this->object->notes[] = $note;
        }
      }

      if ('sfIsadPlugin' != $this->request->module)
      {
        foreach ($sourceInformationObject->events as $sourceEvent)
        {
          if (false == isset($this->request->deleteEvents[$sourceEvent->id]))
          {
            $event = new QubitEvent;

            $event->actorId = $sourceEvent->actorId;
            $event->typeId = $sourceEvent->typeId;
            $event->startDate = $sourceEvent->startDate;
            $event->endDate = $sourceEvent->endDate;
            $event->sourceCulture = $sourceEvent->sourceCulture;

            // I18n
            $event->name = $sourceEvent->name;
            $event->description = $sourceEvent->description;
            $event->dateDisplay = $sourceEvent->dateDisplay;

            foreach ($sourceEvent->eventI18ns as $sourceEventI18n)
            {
              if ($this->context->user->getCulture() == $sourceEventI18n->culture)
              {
                continue;
              }

              $eventI18n = new QubitEventI18n;

              $eventI18n->name = $sourceEventI18n->name;
              $eventI18n->description = $sourceEventI18n->description;
              $eventI18n->dateDisplay = $sourceEventI18n->dateDisplay;
              $eventI18n->culture = $sourceEventI18n->culture;

              $event->eventI18ns[] = $eventI18n;
            }

            // Place
            if (null !== ($place = QubitObjectTermRelation::getOneByObjectId($sourceEvent->id)))
            {
              $event->objectTermRelationsRelatedByobjectId[] = $place;
            }

            $this->object->events[] = $event;
          }
        }
      }
    }

    // Set the informationObject's attributes
    $this->updateCollectionType();

    // Save related objects (save on $this->object->save())
    $this->updateObjectTermRelations();
    $this->updateEvents();
    $this->updateStatus();
    $this->updateChildLevels();

    // Save informationObject after setting all of its attributes...
    $this->object->save();

    // Delete related objects marked for deletion
    $this->deleteNotes();
    $this->deleteEvents();
    $this->deleteObjectTermRelations();
  }

  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->object = new QubitInformationObject;

    QubitImageFlow::addAssets($this->response);

    QubitTreeView::addAssets($this->response);

    if (isset($request->id))
    {
      $this->object = QubitInformationObject::getById($request->id);

      // Check that object exists and that it's not the root
      if (!isset($this->object) || !isset($this->object->parent))
      {
        $this->forward404();
      }

      // Check user authorization
      if (!QubitAcl::check($this->object, 'update') && !QubitAcl::check($this->object, 'translate'))
      {
        QubitAcl::forwardUnauthorized();
      }

      // Add optimistic lock
      $this->form->setDefault('serialNumber', $this->object->serialNumber);
      $this->form->setValidator('serialNumber', new sfValidatorInteger);
      $this->form->setWidget('serialNumber', new sfWidgetFormInputHidden);
    }
    else if (isset($request->source))
    {
      $this->object = QubitInformationObject::getById($request->source);

      // Check that object exists and that it is not the root
      if (!isset($this->object) || !isset($this->object->parent))
      {
        $this->forward404();
      }

      // Check user authorization
      if (!QubitAcl::check($this->object, 'create'))
      {
        QubitAcl::forwardUnauthorized();
      }

      // Store source label
      $this->sourceInformationObjectLabel = $this->object->getLabel();

      // Remove identifier
      unset($this->object->identifier);

      // Inherit parent level
      $this->form->setDefault('parent', $this->context->routing->generate(null, array($this->object->parent, 'module' => 'informationobject')));
      $this->form->setValidator('parent', new sfValidatorString);
      $this->form->setWidget('parent', new sfWidgetFormInputHidden);

      // Add id of the information object source
      $this->form->setDefault('sourceId', $request->source);
      $this->form->setValidator('sourceId', new sfValidatorInteger);
      $this->form->setWidget('sourceId', new sfWidgetFormInputHidden);

      // Set publication status to 'draft'
      $this->object->setStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID, 'statusId' => QubitTerm::PUBLICATION_STATUS_DRAFT_ID));
    }
    else
    {
      $this->form->setValidator('parent', new sfValidatorString);
      $this->form->setWidget('parent', new sfWidgetFormInputHidden);

      // Root is default parent
      $this->form->bind($request->getGetParameters() + array('parent' => $this->context->routing->generate(null, array(QubitInformationObject::getById(QubitInformationObject::ROOT_ID), 'module' => 'informationobject'))));

      $params = $this->context->routing->parse(Qubit::pathInfo($this->form->parent->getValue()));

      // Check authorization
      if (!QubitAcl::check(QubitInformationObject::getById($params['id']), 'create'))
      {
        QubitAcl::forwardUnauthorized();
      }

      $this->object->parentId = $params['id'];
    }

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    $request->setAttribute('informationObject', $this->object);

    // Determine if user has edit priviliges
    $this->editTaxonomyCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'term'))
    {
      $this->editTaxonomyCredentials = true;
    }

    //Actor (Event) Relations
    $this->newEvent = new QubitEvent;

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        $this->redirect(array($this->object, 'module' => 'informationobject'));
      }
    }
  }

  public function updateCollectionType()
  {
    if ($this->hasRequestParameter('collection_type_id'))
    {
      $this->object->setCollectionTypeId($this->getRequestParameter('collection_type_id'));
    }
    else
    {
      // set default to 'archival material'
      $this->object->setCollectionTypeId(QubitTerm::ARCHIVAL_MATERIAL_ID);
    }
  }

  /**
   * Delete related notes marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteNotes()
  {
    if (false == isset($this->request->sourceId) && is_array($deleteNotes = $this->request->getParameter('delete_notes')) && count($deleteNotes))
    {
      foreach ($deleteNotes as $noteId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($deleteNote = QubitNote::getById($noteId)))
        {
          $deleteNote->delete();
        }
      }
    }
  }

  /**
   * Update ObjectTermRelations - Subject, name and place access points and
   * Material types.
   *
   * @param QubitInformationObject $informationObject current information object
   */
  public function updateObjectTermRelations()
  {
    // Add name access points
    if ($name_ids = $this->getRequestParameter('name_id'))
    {
      // Make sure that $name_ids is an array, even if it's only got one value
      $name_ids = (is_array($name_ids)) ? $name_ids : array($name_ids);

      foreach ($name_ids as $name_id)
      {
        if (intval($name_id))
        {
          $relation = new QubitRelation;
          $relation->typeId = QubitTerm::NAME_ACCESS_POINT_ID;
          $relation->objectId = $name_id;

          $this->object->relationsRelatedBysubjectId[] = $relation;
        }
      }
    }

    // Add material types
    if ($material_type_ids = $this->getRequestParameter('material_type_id'))
    {
      // Make sure that $material_type_id is an array, even if it's only got one value
      $material_type_ids = (is_array($material_type_ids)) ? $material_type_ids : array($material_type_ids);

      foreach ($material_type_ids as $material_type_id)
      {
        if (intval($material_type_id))
        {
          $this->object->addTermRelation($material_type_id);
        }
      }
    }
  }

  /**
   * Delete object->term relations marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteObjectTermRelations()
  {
    if (is_array($deleteRelations = $this->request->getParameter('delete_object_term_relations')) && count($deleteRelations))
    {
      foreach ($deleteRelations as $thisId => $doDelete)
      {
        if ($doDelete == 'delete' && !is_null($relation = QubitObjectTermRelation::getById($thisId)))
        {
          $relation->delete();
        }
      }
    }
  }

  /**
   * Add new actor events for this info object.
   *
   * @param QubitInformationObject $informationObject
   */
  protected function updateEvents()
  {
    // if the eventDialog javascript has done it's work, then use the array of
    // updated events
    if ($this->hasRequestParameter('updateEvents'))
    {
      $updatedEvents = $this->getRequestParameter('updateEvents');
    }

    // else, grab the new event values from the 'newEvent' form
    else
    {
      $updatedEvents = array($this->getRequestParameter('updateEvent'));
    }

    // Loop through actor events
    foreach ($updatedEvents as $eventFormData)
    {
      // Create new event or update an existing one
      if (isset($eventFormData['id']) && !isset($this->request->sourceId))
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($eventFormData['id']));
        if (!isset($params['id']) || null === $event = QubitEvent::getById($params['id']))
        {
          continue; // If we can't find the object, then skip this row
        }
      }
      else
      {
        $event = new QubitEvent;
      }

      // Use existing actor if one is selected (overrides new actor creation)
      if (0 < strlen($eventFormData['actor']))
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($eventFormData['actor']));
        $event->actorId = $params['id'];
      }

      $event->setStartDate(QubitDate::standardize($eventFormData['startDate']));
      $event->setEndDate(QubitDate::standardize($eventFormData['endDate']));
      $event->setDateDisplay($eventFormData['dateDisplay']);
      $event->setTypeId($eventFormData['typeId']);

      if (0 < strlen($eventFormData['description']))
      {
        $event->description = $eventFormData['description'];
      }
      else
      {
        unset($event->description);
      }

      // Save the event if it's valid (has an actor OR date)
      if (0 < strlen($eventFormData['actor'])
        || 0 < strlen($eventFormData['startDate'])
        || 0 < strlen($eventFormData['endDate'])
        || 0 < strlen($eventFormData['dateDisplay']))
      {
        // Update the "place" object term relation object
        if (0 < strlen($eventFormData['place']))
        {
          // If this event didn't exist or didn't have a 'place' associated
          if (null === $event->id || null === ($place = QubitObjectTermRelation::getOneByObjectId($event->id)))
          {
            $place = new QubitObjectTermRelation;
          }

          $params = $this->context->routing->parse(Qubit::pathInfo($eventFormData['place']));
          $place->termId = $params['id'];

          $event->objectTermRelationsRelatedByobjectId[] = $place;
        }

        // Or delete an existing "place" object term relation, if it's no
        // longer needed
        else if (0 < $event->getId() && null !== ($place = QubitObjectTermRelation::getOneByObjectId($event->getId())))
        {
          $place->delete();
        }

        $this->object->events[] = $event;
      }
    }
  }

  /**
   * Delete related actor events marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteEvents()
  {
    if (false == isset($this->request->sourceId) && is_array($deleteEvents = $this->request->getParameter('deleteEvents')) && count($deleteEvents))
    {
      foreach ($deleteEvents as $deleteId => $doDelete)
      {
        if ('delete' == $doDelete && !is_null($event = QubitEvent::getById($deleteId)))
        {
          $event->delete();
        }
      }
    }
  }

  public function updateChildLevels()
  {
    if (is_array($updateChildLevels = $this->request->getParameter('updateChildLevels')) && count($updateChildLevels))
    {
      foreach ($updateChildLevels as $childLevelFormData)
      {
        if (isset($childLevelFormData['id']))
        {
          if (null === $childLevel = QubitInformationObject::getById($childLevelFormData['id']))
          {
            continue;
          }
        }
        else
        {
          $childLevel = new QubitInformationObject;
        }

        $childLevel->setIdentifier($childLevelFormData['identifier']);
        $childLevel->setTitle($childLevelFormData['title']);

        if (0 < $childLevelFormData['levelOfDescription'] && (null !== QubitTerm::getById($childLevelFormData['levelOfDescription'])))
        {
          $childLevel->setLevelOfDescriptionId($childLevelFormData['levelOfDescription']);
        }

        if (0 < $childLevelFormData['levelOfDescription']
          || 0 < strlen($childLevelFormData['identifier'])
          || 0 < strlen($childLevelFormData['title']))
        {
          $this->object->informationObjectsRelatedByparentId[] = $childLevel;
        }
      }
    }
  }

  public function updateStatus()
  {
    if (!QubitAcl::check($this->object, 'publish'))
    {
      // if the user does not have 'publish' permission, automatically set publication status to 'draft'
      $pubStatusId = QubitTerm::PUBLICATION_STATUS_DRAFT_ID;
    }
    else
    {
      $pubStatusId = $this->form->getValue('publicationStatus');
    }

    // Only update publicationStatus if its value has changed because it
    // triggers a resource-intensive update of all its descendants
    $oldStatus = $this->object->getStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID));
    if (!isset($oldStatus) && isset($pubStatusId) || $pubStatusId !== $oldStatus->statusId)
    {
      $this->object->setStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID, 'statusId' => $pubStatusId));

      // Update pub status of descendants
      foreach ($this->object->descendants as $descendant)
      {
        if (null === $descendantPubStatus = $descendant->getStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID)))
        {
          $descendantPubStatus = new QubitStatus;
          $descendantPubStatus->typeId = QubitTerm::STATUS_TYPE_PUBLICATION_ID;
          $descendantPubStatus->objectId = $descendant->id;
        }

        if ($pubStatusId != $descendantPubStatus->statusId)
        {
          $descendantPubStatus->statusId = $pubStatusId;
          $descendantPubStatus->save();
        }
      }
    }
  }
}
