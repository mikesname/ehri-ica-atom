<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
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
    $this->forward('admin','termPermission');
    }
    
  $this->scopeNotes = $term->getNotesByType($noteTypeId = QubitTerm::SCOPE_NOTE_ID, $exclude = null);
  $this->newScopeNote = new QubitNote;  
  
  $this->sourceNotes = $term->getNotesByType($noteTypeId = QubitTerm::SOURCE_NOTE_ID, $exclude = null);
  $this->newSourceNote = new QubitNote;  

  $this->term = $term;
  $this->taxonomy = QubitTaxonomy::getById($term->getTaxonomyId());

  if ($term->getTaxonomyId() != 0)
    {
    $this->setTemplate('editTaxonomy');
    }
  else
    {
    $this->setTemplate('edit');
    }
  }
}
