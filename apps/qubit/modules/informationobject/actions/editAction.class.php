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
        if (null !== $this->informationObject->descriptionDetail)
        {
          $this->form->setDefault('descriptionDetail', $this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $this->informationObject->descriptionDetail->id)));
        }
        $this->form->setValidator('descriptionDetail', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $term->id))] = $term;
        }

        $this->form->setWidget('descriptionDetail', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'descriptionStatus':
        if (null !== $this->informationObject->descriptionStatus)
        {
          $this->form->setDefault('descriptionStatus', $this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $this->informationObject->descriptionStatus->id)));
        }
        $this->form->setValidator('descriptionStatus', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $term->id))] = $term;
        }

        $this->form->setWidget('descriptionStatus', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'language':
      case 'languageOfDescription':
        $this->form->setDefault($name, $this->informationObject[$name]);
        $this->form->setValidator($name, new sfValidatorI18nChoiceLanguage(array('multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormI18nSelectLanguage(array('culture' => $this->context->user->getCulture(), 'multiple' => true)));

        break;

      case 'levelOfDescription':
        if (null !== $this->informationObject->levelOfDescription)
        {
          $this->form->setDefault('levelOfDescription', $this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $this->informationObject->levelOfDescription->id)));
        }
        $this->form->setValidator('levelOfDescription', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $term->id))] = $term;
        }

        $this->form->setWidget('levelOfDescription', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'publicationStatus':
        if (null !== ($publicationStatus = $this->informationObject->getStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID))))
        {
          $this->form->setDefault('publicationStatus', $publicationStatus->statusId);
        }
        $this->form->setValidator('publicationStatus', new sfValidatorString);

        if (QubitAcl::check($this->informationObject, QubitAclAction::PUBLISH_ID))
        {
          $choices = array();
          $choices[null] = null;
          foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::PUBLICATION_STATUS_ID) as $term)
          {
            $choices[$term->id] = $term->getName(array('cultureFallback' => true));
          }

          $this->form->setWidget('publicationStatus', new sfWidgetFormSelect(array('choices' => $choices)));
        }
        else
        {
          $curStatusId = $this->informationObject->getStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID))->statusId;
          if (null != ($curStatus = QubitTerm::getById($curStatusId)))
          {
            $curStatus = $curStatus->name;
          }

          // disable widget if user does not have 'publish' permission
          $this->form->setWidget('publicationStatus', new sfWidgetFormSelect(array('choices' => array($curStatusId => $curStatus)), array('disabled' => true)));
        }

        break;

      case 'repository':
        $choices = array();
        if (null !== ($repository = $this->informationObject->repository))
        {
          $this->form->setDefault('repository', $this->context->routing->generate(null, array('module' => 'repository', 'action' => 'show', 'id' => $repository->id)));
          $choices = array($this->context->routing->generate(null, array('module' => 'repository', 'action' => 'show', 'id' => $repository->id)) => $repository);
        }
        $this->form->setValidator('repository', new sfValidatorString);
        $this->form->setWidget('repository', new sfWidgetFormSelect(array('choices' => $choices)));

        if (isset($this->request->id))
        {
          $this->repoAcParams = array('module' => 'repository', 'action' => 'autocomplete', 'aclAction' => QubitAclAction::UPDATE_ID);
        }
        else
        {
          $this->repoAcParams = array('module' => 'repository', 'action' => 'autocomplete', 'aclAction' => QubitAclAction::CREATE_ID);
        }

        break;

      case 'script':
      case 'scriptOfDescription':
        $this->form->setDefault($name, $this->informationObject[$name]);

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
        $this->form->setDefault($name, $this->informationObject[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;

      case 'descriptionIdentifier':
      case 'identifier':
      case 'institutionResponsibleIdentifier':
      case 'title':
        $this->form->setDefault($name, $this->informationObject[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'subjectAccessPoints':
      case 'placeAccessPoints':
        $criteria = new Criteria;
        $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID, Criteria::INNER_JOIN);
        $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->informationObject->id);

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
        foreach (QubitObjectTermRelation::get($criteria) as $otRelation)
        {
          $values[] = $this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $otRelation->term->id));
          $choices[$this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $otRelation->term->id))] = $otRelation->term;
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;
      case 'nameAccessPoints':
        $criteria = new Criteria;
        $criteria->add(QubitRelation::SUBJECT_ID, $this->informationObject->id);
        $criteria->add(QubitRelation::TYPE_ID, QubitTerm::NAME_ACCESS_POINT_ID);

        $values = array();
        $choices = array();
        foreach (QubitRelation::get($criteria) as $relation)
        {
          $values[] = $this->context->routing->generate(null, array('module' => 'actor', 'action' => 'show', 'id' => $relation->objectId));
          $choices[$this->context->routing->generate(null, array('module' => 'actor', 'action' => 'show', 'id' => $relation->objectId))] = $relation->getObject();
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
        $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $this->form->getValue($field->getName())));
        $this->informationObject[$field->getName().'Id'] = $params['id'];

        break;

      case 'subjectAccessPoints':
      case 'placeAccessPoints':
        $filtered = $selected = array();
        foreach ($this->form->getValue($name) as $value)
        {
          $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $value));
          $filtered[$params['id']] = $selected[$params['id']] = $params['id'];
        }

        $criteria = new Criteria;
        $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID);
        $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->informationObject->id);

        switch ($name)
        {
          case 'subjectAccessPoints':
            $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::SUBJECT_ID);
            break;
          case 'placeAccessPoints':
            $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::PLACE_ID);
            break;
        }

        foreach (QubitObjectTermRelation::get($criteria) as $objectTermRelation)
        {
          if (isset($selected[$objectTermRelation->term->id]))
          {
            unset($filtered[$objectTermRelation->term->id]);
          }
          else
          {
            $objectTermRelation->delete();
          }
        }

        foreach ($filtered as $id)
        {
          $objectTermRelation = new QubitObjectTermRelation;
          $objectTermRelation->termId = $id;

          $this->informationObject->objectTermRelationsRelatedByobjectId[] = $objectTermRelation;
        }

        break;

      case 'nameAccessPoints':
        $filtered = $selected = array();
        foreach ($this->form->getValue($name) as $value)
        {
          $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $value));
          $filtered[$params['id']] = $selected[$params['id']] = $params['id'];
        }

        $criteria = new Criteria;
        $criteria->add(QubitRelation::SUBJECT_ID, $this->informationObject->id);
        $criteria->add(QubitRelation::TYPE_ID, QubitTerm::NAME_ACCESS_POINT_ID);

        foreach (QubitRelation::get($criteria) as $relation)
        {
          if (isset($selected[$relation->objectId]))
          {
            unset($filtered[$relation->objectId]);
          }
          else
          {
            $relation->delete();
          }
        }

        foreach ($filtered as $id)
        {
          $relation = new QubitRelation;
          $relation->objectId = $id;
          $relation->typeId = QubitTerm::NAME_ACCESS_POINT_ID;

          $this->informationObject->relationsRelatedBysubjectId[] = $relation;
        }

        break;

      default:
        $this->informationObject[$field->getName()] = $this->form->getValue($field->getName());
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

    // set the informationObject's attributes
    $this->updateCollectionType();

    // Save related objects (save on $this->informationObject->save())
    $this->updateObjectTermRelations();
    $this->updateNotes();
    $this->updateEvents();
    $this->updateStatus();
    $this->updateChildLevels();

    // save informationObject after setting all of its attributes...
    $this->informationObject->save();

    // delete related objects marked for deletion
    $this->deleteNotes();
    $this->deleteEvents();
    $this->deleteObjectTermRelations();
    $this->deleteChildLevels();
  }

  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->informationObject = new QubitInformationObject;

    if (isset($request->id))
    {
      $this->informationObject = QubitInformationObject::getById($request->id);

      // Check that object exists and that it is not the root
      if (!isset($this->informationObject) || !isset($this->informationObject->parent))
      {
        $this->forward404();
      }

      // Check user authorization
      if (!QubitAcl::check($this->informationObject, QubitAclAction::UPDATE_ID))
      {
        QubitAcl::forwardUnauthorized();
      }

      // Add optimistic lock
      $this->form->setDefault('serialNumber', $this->informationObject->serialNumber);
      $this->form->setValidator('serialNumber', new sfValidatorInteger);
      $this->form->setWidget('serialNumber', new sfWidgetFormInputHidden);
    }
    else
    {
      // Check user authorization
      if (!QubitAcl::check(QubitInformationObject::getRoot(), QubitAclAction::CREATE_ID))
      {
        QubitAcl::forwardUnauthorized();
      }

      $this->form->setValidator('parent', new sfValidatorString);
      $this->form->setWidget('parent', new sfWidgetFormInputHidden);

      $this->form->bind($request->getGetParameters() + array('parent' => $this->context->routing->generate(null, array('module' => 'informationobject', 'action' => 'show', 'id' => QubitInformationObject::ROOT_ID))));
    }

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    sfLoader::loadHelpers(array('Qubit'));

    $request->setAttribute('informationObject', $this->informationObject);

    // Determine if user has edit priviliges
    $this->editTaxonomyCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'term'))
    {
      $this->editTaxonomyCredentials = true;
    }

    //Actor (Event) Relations
    $this->actorEvents = $this->informationObject->getEvents();
    $this->newEvent = new QubitEvent;
    $this->creators = $this->informationObject->getCreators();

    //Notes
    $this->notes = $this->informationObject->getNotes();
    $this->noteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::NOTE_TYPE_ID);
    $this->titleNotes = $this->informationObject->getNotesByType($options = array ('noteTypeId' => QubitTerm::TITLE_NOTE_ID));
    $this->publicationNotes = $this->informationObject->getNotesByType($options = array ('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        $this->redirect(array('module' => 'informationobject', 'action' => 'show', 'id' => $this->informationObject->getId()));
      }
    }
  }

  public function updateCollectionType()
  {
    if ($this->hasRequestParameter('collection_type_id'))
    {
      $this->informationObject->setCollectionTypeId($this->getRequestParameter('collection_type_id'));
    }
    else
    {
      // set default to 'archival material'
      $this->informationObject->setCollectionTypeId(QubitTerm::ARCHIVAL_MATERIAL_ID);
    }
  }

  protected function updateNotes()
  {
  }

  /**
   * Delete related notes marked for deletion.
   *
   * @param sfRequest request object
   */
  public function deleteNotes()
  {
    if (is_array($deleteNotes = $this->request->getParameter('delete_notes')) && count($deleteNotes))
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

          $this->informationObject->relationsRelatedBysubjectId[] = $relation;
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
          $this->informationObject->addTermRelation($material_type_id);
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
      $updatedEvents = array($this->getRequestParameter('newEvent'));
    }

    // Loop through actor events
    foreach ($updatedEvents as $eventFormData)
    {
      // Create new event or update an existing one
      if (isset($eventFormData['id']))
      {
        if (null === $event = QubitEvent::getById($eventFormData['id']))
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
        $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $eventFormData['actor']));
        $event->actorId = $params['id'];
      }

      $event->setStartDate(QubitDate::standardize($eventFormData['startDate']));
      $event->setEndDate(QubitDate::standardize($eventFormData['endDate']));
      $event->setDateDisplay($eventFormData['dateDisplay']);
      $event->setTypeId($eventFormData['typeId']);
      $event->setDescription($eventFormData['description']);

      // Save the event if it's valid (has an actor OR date)
      if (0 < $eventFormData['actorId'] ||
        0 < strlen($eventFormData['newActorName']) ||
        0 < strlen($eventFormData['startDate']) ||
        0 < strlen($eventFormData['endDate']) ||
        0 < strlen($eventFormData['dateDisplay'])
      )
      {
        // Update the "place" object term relation object
        if (0 < strlen($eventFormData['place']))
        {
          // If this event didn't exist or didn't have a 'place' associated
          if (null === $event->id || null === ($place = QubitObjectTermRelation::getOneByObjectId($event->id)))
          {
            $place = new QubitObjectTermRelation;
          }

          $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $eventFormData['place']));
          $place->termId = $params['id'];

          $event->objectTermRelationsRelatedByobjectId[] = $place;
        }

        // Or delete an existing "place" object term relation, if it's no
        // longer needed
        else if (0 < $event->getId() && null !== ($place = QubitObjectTermRelation::getOneByObjectId($event->getId())))
        {
          $place->delete();
        }

        $this->informationObject->events[] = $event;
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
    if (is_array($deleteEvents = $this->request->getParameter('deleteEvents')) && count($deleteEvents))
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

        if (0 < $childLevelFormData['levelOfDescription'] ||
          0 < strlen($childLevelFormData['identifier']) ||
          0 < strlen($childLevelFormData['title'])
        )
        {
          $this->informationObject->informationObjectsRelatedByparentId[] = $childLevel;
        }
      }
    }
  }

  public function deleteChildLevels()
  {
    if (is_array($deleteChildLevels = $this->request->getParameter('deleteChildLevels')) && count($deleteChildLevels))
    {
      foreach ($deleteChildLevels as $deleteId => $doDelete)
      {
        if ('delete' == $doDelete && !is_null($child = QubitInformationObject::getById($deleteId)))
        {
          foreach ($child->descendants->andSelf()->orderBy('rgt') as $descendant)
          {
            foreach ($descendant->digitalObjects as $digitalObject)
            {
              $digitalObject->delete();
            }

            $descendant->delete();
          }
        }
      }
    }
  }

  public function updateStatus()
  {
    if (!QubitAcl::check($this->informationObject, QubitAclAction::PUBLISH_ID))
    {
      // if the user does not have 'publish' permission, automatically set publication status to 'draft'
      $this->informationObject->setStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID, 'statusId' => QubitTerm::PUBLICATION_STATUS_DRAFT_ID));
    }
    else
    {
      $pubStatusId = $this->form->getValue('publicationStatus');

      // only update publicationStatus if its value has changed because it triggers a resource-intensive update of all its descendants
      if ($pubStatusId !== $this->informationObject->getStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID))->statusId)
      {
        $this->informationObject->setStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID, 'statusId' => $pubStatusId));

        // if publication status has changed, set the status of all its descendants to null
        // so that they inherit the newly changed status, and update their search index
        // document so that the changed status is reflected in search and list browse results
        foreach ($this->informationObject->descendants as $descendant)
        {
          $descendant->setStatus($options = array('typeId' => QubitTerm::STATUS_TYPE_PUBLICATION_ID, 'statusId' => $pubStatusId));
          $descendant->save();
        }
      }
    }
  }
}
