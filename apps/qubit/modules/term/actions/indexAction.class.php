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

class TermIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->term = QubitTerm::getById($request->id);

    if (!$this->term instanceof QubitTerm)
    {
      $this->forward404();
    }

    QubitTreeView::addAssets($this->response);

    $request->setAttribute('term', $this->term);

    $this->scopeNotes = $this->term->getNotesByType($options = array('noteTypeId' => QubitTerm::SCOPE_NOTE_ID));
    $this->sourceNotes = $this->term->getNotesByType($options = array('noteTypeId' => QubitTerm::SOURCE_NOTE_ID));
    $this->displayNotes = $this->term->getNotesByType($options = array('noteTypeId' => QubitTerm::DISPLAY_NOTE_ID));

    $this->children = $this->term->getChildren(array('sortBy' => 'name'));

    $this->uses    = QubitRelation::getRelationsByObjectId($this->term->id, array('typeId' => QubitTerm::TERM_RELATION_EQUIVALENCE_ID));
    $this->useFors = QubitRelation::getRelationsBySubjectId($this->term->id, array('typeId' => QubitTerm::TERM_RELATION_EQUIVALENCE_ID));
    $this->associateRelations = QubitRelation::getBySubjectOrObjectId($this->term->id, array('typeId' => QubitTerm::TERM_RELATION_ASSOCIATIVE_ID));
  }
}
