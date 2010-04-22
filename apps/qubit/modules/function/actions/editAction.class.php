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
 * Controller for editing func information.
 *
 * @package    qubit
 * @subpackage function
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class FunctionEditAction extends sfAction
{
  /**
   * Define form field names
   *
   * @var string
   */
  public static
    $NAMES = array(
      'type',
      'authorizedFormOfName',
      'parallelName',
      'otherName',
      'classification',
      'dates',
      'description',
      'history',
      'legislation',
      'descriptionIdentifier',
      'institutionIdentifier',
      'rules',
      'descriptionStatus',
      'descriptionDetail',
      'revisionHistory',
      'language',
      'script',
      'sources',
      'maintenanceNotes',
      'relation[authorizedFormOfName]',
      'relation[category]',
      'relation[description]',
      'relation[startDate]',
      'relation[endDate]',
      'relation[dateDisplay]',
      'relatedEntity[object]',
      'relatedEntity[description]',
      'relatedEntity[startDate]',
      'relatedEntity[endDate]',
      'relatedEntity[dateDisplay]',
      'relatedResource[object]',
      'relatedResource[description]',
      'relatedResource[startDate]',
      'relatedResource[endDate]',
      'relatedResource[dateDisplay]');

  /**
   * Add fields to form
   *
   * @param $name string
   * @return void
   */
  protected function addField($name)
  {
    switch ($name)
    {
      case 'type':
        if (null !== $this->func->type)
        {
          $this->form->setDefault('type', $this->context->routing->generate(null, array($this->func->type, 'module' => 'term')));
        }
        $this->form->setValidator('type', new sfValidatorString);

        $choices = array();
        $choices[null] = null;

        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::FUNCTION_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('type', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'parallelName':
      case 'otherName':
        $criteria = new Criteria;
        $criteria = $this->func->addotherNamesCriteria($criteria);

        switch ($name)
        {
          case 'parallelName':
            $criteria->add(QubitOtherName::TYPE_ID, QubitTerm::PARALLEL_FORM_OF_NAME_ID);
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
        if (null !== $this->func->descriptionStatus)
        {
          $this->form->setDefault('descriptionStatus', $this->context->routing->generate(null, array($this->func->descriptionStatus, 'module' => 'term')));
        }
        $this->form->setValidator('descriptionStatus', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('descriptionStatus', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'descriptionDetail':
        if (null !== $this->func->descriptionDetail)
        {
          $this->form->setDefault('descriptionDetail', $this->context->routing->generate(null, array($this->func->descriptionDetail, 'module' => 'term')));
        }
        $this->form->setValidator('descriptionDetail', new sfValidatorString);

        $choices = array();
        $choices[null] = null;
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('descriptionDetail', new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'language':
        $this->form->setDefault($name, $this->func[$name]);
        $this->form->setValidator($name, new sfValidatorI18nChoiceLanguage(array('multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormI18nSelectLanguage(array('culture' => $this->context->user->getCulture(), 'multiple' => true)));

        break;

      case 'script':
        $this->form->setDefault($name, $this->func[$name]);
        $c = sfCultureInfo::getInstance($this->context->user->getCulture());
        $this->form->setValidator($name, new sfValidatorChoice(array('choices' => array_keys($c->getScripts()), 'multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $c->getScripts(), 'multiple' => true)));

        break;

      case 'maintenanceNotes':
        $this->maintenanceNote = null;

        // Check for existing maintenance note related to this object
        $criteria = new Criteria;
        $criteria = $this->func->addnotesCriteria($criteria);
        $criteria->add(QubitNote::TYPE_ID, QubitTerm::MAINTENANCE_NOTE_ID);
        $note = QubitNote::getOne($criteria);

        if (null !== $note)
        {
          $this->form->setDefault($name, $note->content);
          $this->maintenanceNote = $note;
        }
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;

      case 'relation[authorizedFormOfName]':
      case 'relatedEntity[object]':
      case 'relatedResource[object]':
        $choices = array();

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'relation[category]':
        $this->form->setValidator($name, new sfValidatorString);

        $choices = array();
        $choices[null] = null;

        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::ISDF_RELATION_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'authorizedFormOfName':
      case 'classification':
      case 'dates':
      case 'descriptionIdentifier':
      case 'institutionIdentifier':
        $this->form->setDefault($name, $this->func[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'history':
      case 'description':
      case 'legislation':
      case 'rules':
      case 'revisionHistory':
      case 'sources':
        $this->form->setDefault($name, $this->func[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;

      case 'relation[startDate]':
      case 'relation[endDate]':
      case 'relation[dateDisplay]':
      case 'relatedEntity[startDate]':
      case 'relatedEntity[endDate]':
      case 'relatedEntity[dateDisplay]':
      case 'relatedResource[startDate]':
      case 'relatedResource[endDate]':
      case 'relatedResource[dateDisplay]':
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'relation[description]':
      case 'relatedEntity[description]':
      case 'relatedResource[description]':
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
      case 'type':
      case 'descriptionStatus':
      case 'descriptionDetail':
        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue($name)));
        $fieldId = (isset($params['id'])) ? $params['id'] : null;
        $this->func[$name.'Id'] = $fieldId;

        break;

      case 'maintenanceNotes':
        // Check for existing maintenance note related to this object
        $criteria = new Criteria;
        $criteria = $this->func->addnotesCriteria($criteria);
        $criteria->add(QubitNote::TYPE_ID, QubitTerm::MAINTENANCE_NOTE_ID);
        $note = QubitNote::getOne($criteria);

        if (0 < strlen($value = $this->form->getValue($name)))
        {
          if (null === $note)
          {
            // Create a maintenance note for this object if one doesn't exist
            $note = new QubitNote;
            $note->typeId = QubitTerm::MAINTENANCE_NOTE_ID;
          }

          $note->content = $value;

          $this->func->notes[] = $note;
        }

        break;

      case 'parallelName':
      case 'otherName':
        $defaults = $this->form->getWidget($name)->getOption('defaults');

        if (null !== $this->form->getValue($name))
        {
          foreach ($this->form->getValue($name) as $key => $thisName)
          {
            if ('new' == substr($key, 0, 3) && 0 < strlen(trim($thisName)))
            {
              $otherName = new QubitOtherName;

              if ('parallelName' == $name)
              {
                $otherName->typeId = QubitTerm::PARALLEL_FORM_OF_NAME_ID;
              }
              else
              {
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
            $this->func->otherNames[] = $otherName;
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

      default:
        $this->func[$field->getName()] = $this->form->getValue($field->getName());
    }
  }

  /**
   * Process form
   *
   * @return void
   */
  protected function processForm()
  {
    foreach ($this->form as $field)
    {
      $this->processField($field);
    }

    $this->updateRelations();
    $this->updateOtherRelations('relatedEntity');
    $this->updateOtherRelations('relatedResource');
    $this->deleteRelations();

    // Save function after updating it's attributes
    $this->func->save();
  }

  /**
   * Execute edit action
   *
   * @param $request sfWebRequest
   * @see lib/vendor/symfony/lib/action/sfAction
   */
  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->func = new QubitFunction;

    if (isset($request->id))
    {
      $this->func = QubitFunction::getById($request->id);

      if (!$this->func instanceof QubitFunction)
      {
        $this->forward404();
      }

      // Add optimistic lock
      $this->form->setDefault('serialNumber', $this->func->serialNumber);
      $this->form->setValidator('serialNumber', new sfValidatorInteger);
      $this->form->setWidget('serialNumber', new sfWidgetFormInputHidden);
    }

    // Find function to function relations with current function as subject or
    // object
    $criteria = new Criteria;
    $criteria->addAlias('ro', QubitObject::TABLE_NAME);
    $criteria->addAlias('rs', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitRelation::OBJECT_ID, 'ro.id');
    $criteria->addJoin(QubitRelation::SUBJECT_ID, 'rs.id');
    $criterion1 = $criteria->getNewCriterion(QubitRelation::OBJECT_ID, $this->func->id, Criteria::EQUAL);
    $criterion2 = $criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $this->func->id, Criteria::EQUAL);
    $criterion1->addOr($criterion2);
    $criterion3 = $criteria->getNewCriterion('ro.class_name', 'QubitFunction', Criteria::EQUAL);
    $criterion4 = $criteria->getNewCriterion('rs.class_name', 'QubitFunction', Criteria::EQUAL);
    $criterion3->addAnd($criterion4);
    $criterion1->addAnd($criterion3);
    $criteria->add($criterion1);
    $criteria->addAscendingOrderByColumn(QubitRelation::TYPE_ID);
    $this->relatedFunctions = QubitRelation::get($criteria);

    // Get actors (object) related to this function (subject)
    $criteria = new Criteria;
    $criteria->addAlias('ro', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitRelation::OBJECT_ID, 'ro.id', Criteria::INNER_JOIN);
    $criteria->add(QubitRelation::SUBJECT_ID, $this->func->id);
    $criteria->add('ro.class_name', 'QubitActor');
    $this->actorRelations = QubitRelation::get($criteria);

    // Get information objects (object) related to this function (subject)
    $criteria = new Criteria;
    $criteria->addAlias('ro', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitRelation::OBJECT_ID, 'ro.id', Criteria::INNER_JOIN);
    $criteria->add(QubitRelation::SUBJECT_ID, $this->func->id);
    $criteria->add('ro.class_name', 'QubitInformationObject');
    $this->infoObjectRelations = QubitRelation::get($criteria);

    // Determine if user has edit priviliges
    $this->editTaxonomyCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'term'))
    {
      $this->editTaxonomyCredentials = true;
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
        $this->redirect(array($this->func, 'module' => 'function'));
      }
    }

    $this->setTemplate('editIsdf');
  }

  /**
   * Update function relationships
   */
  protected function updateRelations()
  {
    if ($this->hasRequestParameter('relations'))
    {
      // Javascript (multiple) relationship update
      $relationsData = $this->getRequestParameter('relations');
    }
    else if ($this->hasRequestParameter('relation'))
    {
      // Non-javascript (single) relationship update
      $relationsData = array($this->getRequestParameter('relation'));
    }
    else
    {
      return;
    }

    // Loop through func events
    foreach ($relationsData as $relationData)
    {
      // Get related function
      $params = $this->context->routing->parse(Qubit::pathInfo($relationData['authorizedFormOfName']));
      $relatedFuncId = (isset($params['id'])) ? $params['id'] : null;
      if (null === $relatedFunction = QubitFunction::getById($relatedFuncId))
      {
        continue; // If no related function, skip update
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
      $params = $this->context->routing->parse(Qubit::pathInfo($relationData['category']));
      $typeId = (isset($params['id'])) ? $params['id'] : null;
      $relation->typeId = $typeId;

      $relation->startDate = QubitDate::standardize($relationData['startDate']);
      $relation->endDate = QubitDate::standardize($relationData['endDate']);

      // Add notes
      $relation->updateNote($relationData['description'], QubitTerm::RELATION_NOTE_DESCRIPTION_ID);
      $relation->updateNote($relationData['dateDisplay'], QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID);

      // Default to current function as subject of relationship
      if ($relation->subjectId == $this->func->id || null == $relation->subjectId)
      {
        $relation->object = $relatedFunction;
        $this->func->relationsRelatedBysubjectId[] = $relation;
      }
      else
      {
        $relation->subject = $relatedFunction;
        $this->func->relationsRelatedByobjectId[] = $relation;
      }
    }

    return $this;
  }

  /**
   * Update entity relationships
   */
  protected function updateOtherRelations($formName)
  {
    if ($this->hasRequestParameter($formName.'s'))
    {
      // Javascript (multiple) relationship update
      $relationsData = $this->getRequestParameter($formName.'s');
    }
    else if ($this->hasRequestParameter($formName))
    {
      // Non-javascript (single) relationship update
      $relationsData = array($this->getRequestParameter($formName));
    }
    else
    {
      return;
    }

    // Loop through relation rows
    foreach ($relationsData as $relationData)
    {
      // Get relation
      if (isset($relationData['id']))
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($relationData['id']));

        if (null === $relation = QubitRelation::getById($params['id']))
        {
          continue; // If we can't find an existing relation, skip this row
        }
      }
      else
      {
        $relation = new QubitRelation;
      }

      // Get related information object (object)
      $params = $this->context->routing->parse(Qubit::pathInfo($relationData['object']));
      $objectId = (isset($params['id'])) ? $params['id'] : null;

      switch ($formName)
      {
        case 'relatedEntity':
          $object = QubitActor::getById($objectId);
          break;
        case 'relatedResource':
          $object = QubitInformationObject::getById($objectId);
          break;
      }

      if (null === $object)
      {
        continue; // If no related object, skip update
      }
      else
      {
        $relation->object = $object;
      }

      $relation->startDate = QubitDate::standardize($relationData['startDate']);
      $relation->endDate = QubitDate::standardize($relationData['endDate']);

      // Add notes
      $relation->updateNote($relationData['description'], QubitTerm::RELATION_NOTE_DESCRIPTION_ID);
      $relation->updateNote($relationData['dateDisplay'], QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID);

      $this->func->relationsRelatedBysubjectId[] = $relation;
    }

    return $this;
  }

  /**
   * Delete all relationships marked for deletion
   */
  public function deleteRelations()
  {
    if (is_array($deleteRelations = $this->getRequestParameter('deleteRelations')) && count($deleteRelations))
    {
      foreach ($deleteRelations as $deleteId => $doDelete)
      {
        if (null !== ($relation = QubitRelation::getById($deleteId)))
        {
          $relation->delete();
        }
      }
    }

    return $this;
  }
}
