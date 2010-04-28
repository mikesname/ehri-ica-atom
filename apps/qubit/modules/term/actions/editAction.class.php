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

class TermEditAction extends sfAction
{
  /**
   * Define form field names
   *
   * @var string
   */
  public static
    $NAMES = array(
      'taxonomy',
      'alternateForms',
      'code',
      'displayNote',
      'name',
      'narrowTerms',
      'parent',
      'relatedTerms',
      'scopeNote',
      'sourceNote'
    );

  protected function addField($name)
  {
    switch ($name)
    {
      case 'alternateForms':
        $criteria = new Criteria;
        $criteria->add(QubitRelation::SUBJECT_ID, $this->term->id);
        $criteria->add(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID);

        $values = $defaults = array();
        if (0 < count($relations = QubitRelation::get($criteria)))
        {
          foreach ($relations as $relation)
          {
            $values[] = $relation->id;
            $defaults[$relation->id] = $relation->object;
          }
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new QubitWidgetFormInputMany(array('defaults' => $defaults)));

        break;

      case 'code':
      case 'name':
        $this->form->setDefault($name, $this->term[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'narrowTerms':
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new QubitWidgetFormInputMany(array('defaults' => array())));

        break;

      case 'parent':
        $choices = array();

        if (isset($this->term->parent))
        {
          $this->form->setDefault($name, $this->context->routing->generate(null, array($this->term->parent, 'module' => 'term')));
          $choices = array($this->context->routing->generate(null, array('module' => 'term', 'id' => $this->term->parentId)) => $this->term->parent);
        }

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'relatedTerms':
        $this->relations = QubitRelation::getBySubjectOrObjectId($this->term->getId(), array('typeId' => QubitTerm::TERM_RELATION_ASSOCIATIVE_ID));

        $choices = array();
        $values = array();
        if (0 < count($this->relations))
        {
          foreach ($this->relations as $relation)
          {
            $choices[$values[] = $this->context->routing->generate(null, array($relation->object, 'module' => 'term'))] = $relation->object;
          }
        }

        $this->form->setDefault('relatedTerms', $values);
        $this->form->setValidator('relatedTerms', new sfValidatorPass);
        $this->form->setWidget('relatedTerms', new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;

      case 'taxonomy':
        $choices = array();

        if (isset($this->term->taxonomyId))
        {
          $this->form->setDefault($name, $this->context->routing->generate(null, array($this->term->taxonomy, 'module' => 'taxonomy')));
          $choices = array($this->context->routing->generate(null, array($this->term->taxonomy, 'module' => 'taxonomy')) => $this->term->taxonomy);
        }

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'displayNote':
      case 'scopeNote':
      case 'sourceNote':
        $criteria = new Criteria;
        $criteria->add(QubitNote::OBJECT_ID, $this->term->id);

        switch ($name)
        {
          case 'scopeNote':
            $criteria->add(QubitNote::TYPE_ID, QubitTerm::SCOPE_NOTE_ID);

            break;

          case 'sourceNote':
            $criteria->add(QubitNote::TYPE_ID, QubitTerm::SOURCE_NOTE_ID);

            break;

          case 'displayNote':
            $criteria->add(QubitNote::TYPE_ID, QubitTerm::DISPLAY_NOTE_ID);

            break;
        }

        $values = $defaults = array();
        if (0 < count($notes = QubitNote::get($criteria)))
        {
          foreach ($notes as $note)
          {
            $values[] = $note->id;
            $defaults[$note->id] = $note;
          }
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new QubitWidgetFormInputMany(array('defaults' => $defaults, 'fieldname' => 'content')));

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
      case 'alternateForms':
        $defaults = $this->form->getWidget($name)->getOption('defaults');

        if (null !== $this->form->getValue($name))
        {
          foreach ($this->form->getValue($name) as $key => $thisName)
          {
            if ('new' == substr($key, 0, 3) && 0 < strlen(trim($thisName)))
            {
              $relation = new QubitRelation;
              $relation->typeId = QubitTerm::TERM_RELATION_EQUIVALENCE_ID;

              $newTerm = new QubitTerm;
              $newTerm->taxonomyId = $this->term->taxonomyId;
              $newTerm->parentId = QubitTerm::ROOT_ID;
              $newTerm->name = $thisName;
              $newTerm->save();

              $relation->object = $newTerm;
            }
            else
            {
              $relation = QubitRelation::getById($key);
              if (!isset($relation))
              {
                continue;
              }
              $relation->object->name = $thisName;
              $relation->object->save();

              // Don't delete this name
              unset($defaults[$key]);
            }

            $this->term->relationsRelatedBysubjectId[] = $relation;
          }
        }

        // Delete any names that are missing from form data
        foreach ($defaults as $key => $val)
        {
          $relation = QubitRelation::getById($key);
          if (isset($relation))
          {
            // Deleting related (object) term will cascade delete QubitRelation
            $relation->object->delete();
          }
        }

        break;

      case 'parent':
      case 'taxonomy':
        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue($name)));
        $fieldId = (isset($params['id']) && 0 < strlen($params['id'])) ? $params['id'] : null;
        $this->term[$name.'Id'] = $fieldId;

        break;

      case 'scopeNote':
      case 'sourceNote':
      case 'displayNote':
        $defaults = $this->form->getWidget($name)->getOption('defaults');

        if (null !== $this->form->getValue($name))
        {
          foreach ($this->form->getValue($name) as $key => $thisContent)
          {
            if ('new' == substr($key, 0, 3) && 0 < strlen(trim($thisContent)))
            {
              $note = new QubitNote;

              switch ($name)
              {
                case 'scopeNote':
                  $note->typeId = QubitTerm::SCOPE_NOTE_ID;

                  break;

                case 'sourceNote':
                  $note->typeId = QubitTerm::SOURCE_NOTE_ID;

                  break;

                case 'displayNote':
                  $note->typeId = QubitTerm::DISPLAY_NOTE_ID;

                  break;
              }
            }
            else
            {
              $note = QubitNote::getById($key);
              if (!isset($note))
              {
                continue;
              }

              // Don't delete this name
              unset($defaults[$key]);
            }

            $note->content = $thisContent;
            $this->term->notes[] = $note;
          }
        }

        // Delete any names that are missing from form data
        foreach ($defaults as $key => $val)
        {
          if (null !== ($note = QubitNote::getById($key)))
          {
            $note->delete();
          }
        }

        break;

      case 'narrowTerms':

        if (null !== $this->form->getValue($name))
        {
          foreach ($this->form->getValue($name) as $key => $thisName)
          {
            if (0 < strlen($thisName = trim($thisName)))
            {
              // Test to make sure term doesn't already exist
              $criteria = new Criteria;
              $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID, Criteria::INNER_JOIN);
              $criteria->add(QubitTerm::TAXONOMY_ID, $this->term->taxonomyId);
              $criteria->add(QubitTermI18n::NAME, $thisName);
              $criteria->add(QubitTermI18n::CULTURE, $this->getContext()->getUser()->getCulture());
              if (0 < count(QubitTermI18n::get($criteria)))
              {
                continue;
              }

              // Add term as child
              $nt = new QubitTerm;
              $nt->taxonomyId = $this->term->taxonomyId;
              $nt->name = $thisName;

              $this->term->termsRelatedByparentId[] = $nt;
            }
          }
        }

        break;

      case 'name':

        if (!$this->term->isProtected())
        {
          $this->term[$field->getName()] = $this->form->getValue($field->getName());
        }

        break;

      case 'relatedTerms':

        $current = $new = array();

        if ('' !== $this->form->getValue($name))
        {
          foreach ($this->form->getValue($name) as $value)
          {
            $params = $this->context->routing->parse(Qubit::pathInfo($value));
            $current[$params['id']] = $new[$params['id']] = $params['id'];
          }
        }

        if (0 < count($this->relations))
        {
          foreach ($this->relations as $relation)
          {
            if (isset($current[$relation->objectId]))
            {
              // If it's current, then don't add/delete
              unset($new[$relation->objectId]);
            }
            else
            {
              // If not in current list, then delete
              $relation->delete();
            }
          }
        }

        // Create 'new' relations
        foreach ($new as $id)
        {
          $relation = new QubitRelation;
          $relation->objectId = $id;
          $relation->typeId = QubitTerm::TERM_RELATION_ASSOCIATIVE_ID;

          $this->term->relationsRelatedBysubjectId[] = $relation;
        }

        break;

      default:
        $this->term[$field->getName()] = $this->form->getValue($field->getName());
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

    // Assign root node as parent, if another parent (broad-term) is not
    // selected
    if (!isset($this->term->parent))
    {
      $this->term->parentId = QubitTerm::ROOT_ID;
    }

    $this->term->save();

    // For equivalence relations make sure existing info objects use the
    // preferred term
    $this->updateInfoObjectPreferredTerms();
  }

  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->term = new QubitTerm;

    if (isset($request->id))
    {
      $this->term = QubitTerm::getById($request->id);

      if (!$this->term instanceof QubitTerm)
      {
        $this->forward404();
      }

      // Don't allow editing non-preferred terms
      if (0 < count($use = $this->term->getEquivalentTerms(array('direction' => 'use'))))
      {
        $this->request->use = $use->offsetGet(0);
        $this->forward('admin', 'termPermission');
      }

      // Check authorization
      if (!(QubitAcl::check($this->term, 'update') || QubitAcl::check($this->term, 'translate')))
      {
        QubitAcl::forwardUnauthorized();
      }

      // Add optimistic lock
      $this->form->setDefault('serialNumber', $this->term->serialNumber);
      $this->form->setValidator('serialNumber', new sfValidatorInteger);
      $this->form->setWidget('serialNumber', new sfWidgetFormInputHidden);
    }
    else
    {
      $this->term->parentId = QubitTerm::ROOT_ID;
      $this->term->taxonomyId = $request->taxonomyId;

      // Check authorization to create term
      if (!QubitAcl::check($this->term, 'create', array('taxonomyId' => $request->taxonomyId)))
      {
        QubitAcl::forwardUnauthorized();
      }
    }

    QubitTreeView::addAssets($this->response);

    $request->setAttribute('term', $this->term);

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    // Post form
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        $this->redirect(array($this->term, 'module' => 'term'));
      }
    }
  }

  public function updateInfoObjectPreferredTerms()
  {
    // Get non-preferred terms
    $nonPrefIds = array();
    if (0 < count($objectTerms = $this->term->getEquivalentTerms(array('direction' => 'subjectToObject'))))
    {
      foreach ($objectTerms as $objectTerm)
      {
        $nonPrefIds[] = $objectTerm->id;
      }
    }

    // Get preferred term
    if (null !== ($preferredTerms = $this->term->getEquivalentTerms(array('direction' => 'objectToSubject'))))
    {
      $preferredTerm = $preferredTerms->offsetGet(0);
      $nonPrefIds[] = $this->term->id;
    }
    else if (0 < count($nonPrefIds))
    {
      $preferredTerm = $this->term;
    }
    else
    {
      // Don't do anything if there are no equivalent terms
      return $this;
    }

    // Replace non-preferred terms with preferred term for related info objects
    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::TERM_ID, $nonPrefIds, Criteria::IN);
    if (0 < count($objectTermRelations = QubitObjectTermRelation::get($criteria)))
    {
      foreach ($objectTermRelations as $objectTermRelation)
      {
        if ($objectTermRelation->getObject() instanceof QubitInformationObject)
        {
          $objectTermRelation->termId = $preferredTerm->id;
          $objectTermRelation->save();
        }
      }
    }

    return $this;
  }
}
