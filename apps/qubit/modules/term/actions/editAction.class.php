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
  public function execute($request)
  {
    $this->warnings = array();
    $this->term = new QubitTerm;

    if ($this->hasRequestParameter('id'))
    {
      $this->term = QubitTerm::getById($this->getRequestParameter('id'));
    }

    // Get the taxonomy for this term
    if (null === $this->term->taxonomyId && $this->hasRequestParameter('taxonomyId'))
    {
      if (null !== ($taxonomy = QubitTaxonomy::getById($this->getRequestParameter('taxonomyId'))))
      {
        $this->term->taxonomyId = $taxonomy->id;
      }
    }

    if (null === $this->term->taxonomyId)
    {
      $this->forward404('Invalid taxonomy');
    }

    $request->setAttribute('term', $this->term);

    // Default values for new term
    $this->parent = new QubitTerm;
    $this->scopeNotes = null;
    $this->sourceNotes = null;
    $this->displayNotes = null;
    $this->termRelations = null;
    $this->relatedObjectCount = 0;
    $this->relatedEventCount = 0;
    $this->relationTypeMatrix = array();

    $this->termRelationTypes = array(
      'use for' => $this->getContext()->getI18N()->__('use for'),
      'use' => $this->getContext()->getI18N()->__('use'),
      'related term' => $this->getContext()->getI18N()->__('related term'));

    // Post form
    if ($request->isMethod('post'))
    {
      $this->processForm();

      // Redirect to show template on successful update
      if (!$this->hasWarning)
      {
        $this->redirect(array('module' => 'term', 'action' => 'show', 'id' => $this->term->id));
      }
    }

    // Populate current values for term
    if (null !== $this->term->id)
    {
      if (QubitTerm::ROOT_ID != $this->term->parentId)
      {
        $this->parent = $this->term->getParent();
      }

      $this->scopeNotes = $this->term->getNotesByType($options = array('noteTypeId' => QubitTerm::SCOPE_NOTE_ID));
      $this->sourceNotes = $this->term->getNotesByType($options = array('noteTypeId' => QubitTerm::SOURCE_NOTE_ID));
      $this->displayNotes = $this->term->getNotesByType($options = array('noteTypeId' => QubitTerm::DISPLAY_NOTE_ID));

      $this->termRelations = QubitRelation::getRelationsBySubjectOrObjectId($this->term->getId());

      foreach ($this->termRelations as $relation)
      {
        $this->relationTypeMatrix[$relation->id] = $this->getRelatedTermType($relation);
      }
    }
  }

  public function processForm()
  {
    if (!$this->term->isProtected())
    {
      $this->term->setName($this->getRequestParameter('name'));
    }
    $this->term->setCode($this->getRequestParameter('code'));
    $this->updateParent();

    $this->updateRelations();
    $this->deleteRelations();
    $this->updateNotes();

    $this->term->save();

    // For equivalence relations make sure existing info objects use the
    // preferred term
    $this->updateInfoObjectPreferredTerms();
  }

  public function updateRelations()
  {
    $deletedRelations = $this->getRequestParameter('deleteRelation');
    $relatedTermNames = $this->getRequestParameter('new_related_term');

    foreach ($this->getRequestParameter('related_term_type') as $key => $relatedTermType)
    {
      if ('new' == substr($key, 0, 3))
      {
        $index = substr($key, 3, 1);

        // If this is a 'new' related term, but the 'name' is blank, skip row
        if (0 == strlen($relatedTermName = trim($relatedTermNames[$index])))
        {
          continue;
        }

        // search for term in current taxonomy
        $criteria = new Criteria;
        $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID, Criteria::INNER_JOIN);
        $criteria->add(QubitTermI18n::NAME, $relatedTermName, Criteria::EQUAL);
        $criteria->add(QubitTermI18n::CULTURE, $this->getUser()->getCulture(), Criteria::EQUAL);
        $criteria->add(QubitTerm::TAXONOMY_ID, $this->term->getTaxonomyId(), Criteria::EQUAL);

        // If this term doesn't already exist, create a new term
        if (null === ($relatedTerm = QubitTerm::getOne($criteria)))
        {
          $relatedTerm = new QubitTerm;
          $relatedTerm->setName($relatedTermName);
          $relatedTerm->setParentId(QubitTerm::ROOT_ID);
          $relatedTerm->setTaxonomyId($this->term->getTaxonomyId());
          $relatedTerm->save();
        }

        $relation = new QubitRelation;
      }
      else
      {
        // Don't update deleted relations
        if (isset($deletedRelations[$key]))
        {
          continue;
        }

        if (null == ($relation = QubitRelation::getById($key)))
        {
          continue;
        }

        $relatedTerm = $relation->getOpposedObject($this->term->id);
      }

      switch($relatedTermType)
      {
        case 'related term':
          $relation->setTypeId(QubitTerm::TERM_RELATION_ASSOCIATIVE_ID);
          $relation->setObjectId($relatedTerm->getId());
          $this->term->relationsRelatedBysubjectId[] = $relation;
          break;
        case 'use':
          $relation->setTypeId(QubitTerm::TERM_RELATION_EQUIVALENCE_ID);
          $relation->setSubjectId($relatedTerm->getId());
          $this->term->relationsRelatedByobjectId[] = $relation;
          break;
        case 'use for':
          $relation->setTypeId(QubitTerm::TERM_RELATION_EQUIVALENCE_ID);
          $relation->setObjectId($relatedTerm->getId());
          $this->term->relationsRelatedBysubjectId[] = $relation;
      }
    }

    return $this;
  }

  public function deleteRelations()
  {
    if ($this->hasRequestParameter('deleteRelation'))
    {
      foreach ($this->getRequestParameter('deleteRelation') as $key => $value)
      {
        if ('delete' === $value && null !== ($relation = QubitRelation::getById($key)))
        {
          $relation->delete();
        }
      }
    }
  }

  public function updateNotes()
  {
    $userId = $this->getUser()->getAttribute('user_id');

    if (0 < strlen($this->getRequestParameter('new_scope_note')))
    {
      $this->term->setNote($options = array('note' => $this->getRequestParameter('new_scope_note'), 'noteTypeId' => QubitTerm::SCOPE_NOTE_ID, 'userId' => $userId));
    }

    if (0 < strlen($this->getRequestParameter('new_source_note')))
    {
      $this->term->setNote($options = array('note' => $this->getRequestParameter('new_source_note'), 'noteTypeId' => QubitTerm::SOURCE_NOTE_ID, 'userId' => $userId));
    }

    if ($this->getRequestParameter('new_display_note'))
    {
      $this->term->setNote($options = array('note' => $this->getRequestParameter('new_display_note'), 'noteTypeId' => QubitTerm::DISPLAY_NOTE_ID, 'userId' => $userId));
    }
  }

  public function updateParent()
  {
    // If broad term field is empty
    if (null == $this->getRequestParameter('parentId') && 0 == strlen(trim($this->getRequestParameter('broadTerm'))))
    {
      // then make term a child of the root term
      $this->term->parentId = QubitTerm::ROOT_ID;
    }
    else if (null !== ($parentTerm = QubitTerm::getById($this->getRequestParameter('parentId'))))
    {
      $this->term->parentId = $parentTerm->id;
    }
    else if (0 < strlen($broadTerm = trim($this->getRequestParameter('broadTerm'))))
    {
      // If user types in a term name, but doesn't chose from the autocomplete
      // list, then try and match an existing term
      $c = new Criteria;
      $c->add(QubitTermI18n::NAME, $broadTerm);
      $c->add(QubitTermI18n::CULTURE, $this->getUser()->getCulture());

      if (null !== ($existingTerm = QubitTermI18n::getOne($c)))
      {
        $this->term->parentId = $existingTerm->id;
      }
      else
      {
        $this->term->parentId = QubitTerm::ROOT_ID;
      }
    }

    return $this;
  }

  public function getRelatedTermType($relation)
  {
    if (QubitTerm::TERM_RELATION_ASSOCIATIVE_ID == $relation->getTypeId())
    {
      return 'related term';
    }
    else
    {
      if ($this->term->id == $relation->getSubjectId())
      {
        return 'use for';
      }
      else
      {
        return 'use';
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
