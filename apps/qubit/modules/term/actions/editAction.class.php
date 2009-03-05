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
    $term = QubitTerm::getById($this->getRequestParameter('id'));
    $this->forward404Unless($term);

    //make sure a protected term value is not edited
    if ($term->isProtected())
    {
      $this->forward('admin', 'termPermission');
    }

    $this->scopeNotes = $term->getNotesByType($noteTypeId = QubitTerm::SCOPE_NOTE_ID, $exclude = null);
    $this->newScopeNote = new QubitNote;

    $this->sourceNotes = $term->getNotesByType($noteTypeId = QubitTerm::SOURCE_NOTE_ID, $exclude = null);
    $this->newSourceNote = new QubitNote;

    $this->displayNotes = $term->getNotesByType($noteTypeId = QubitTerm::DISPLAY_NOTE_ID, $exclude = null);
    $this->newDisplayNote = new QubitNote;

    $this->taxonomy = QubitTaxonomy::getById($term->getTaxonomyId());
    $this->term = $term;

    // Get related info object count for deletion warning messages
    $this->relatedObjectCount = $term->getRelatedObjectCount();

    // Get a separate count of related events because they will be cascade
    // deleted!
    $this->relatedEventCount = $term->getRelatedEventCount();

    if ($term->getTaxonomyId() != 0)
    {
      $this->taxonomyId = $term->getTaxonomyId();
      $this->setTemplate('editTaxonomy');
    }
    else
    {
      $this->setTemplate('edit');
    }
  }
}
