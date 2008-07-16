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

class TermUpdateAction extends sfAction
{
  public function execute($request)
  {
    if (!$this->getRequestParameter('id'))
    {
      $term = new QubitTerm;
    }
    else
    {
      $term = QubitTerm::getById($this->getRequestParameter('id'));
      $this->forward404Unless($term);

/*
      //make sure a locked term value is not updated
      $termRestriction = $term->getTaxonomy()->getTermUse();
      if ($termRestriction == 'admin')
        {
        $this->forward('admin','TermPermission');
        }
      else if ($term->getLocked())
        {
        $this->forward('admin','TermPermission');
        }
*/
    }

    $term->setId($this->getRequestParameter('id'));
    $term->setTaxonomyId($this->getRequestParameter('taxonomy_id') ? $this->getRequestParameter('taxonomy_id') : null);
    $term->setName($this->getRequestParameter('name'));
    $term->setCode($this->getRequestParameter('code'));
    $term->save();

    if ($this->getRequestParameter('new_scope_note'))
    {
      $term->setNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('new_scope_note'), QubitTerm::SCOPE_NOTE_ID);
    }

    if ($this->getRequestParameter('new_source_note'))
    {
      $term->setNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('new_source_note'), QubitTerm::SOURCE_NOTE_ID);
    }

    if ($this->getRequestParameter('content'))



    $taxonomyId = $term->getTaxonomyId();

    return $this->redirect('term/list?taxonomyId='.$this->getRequestParameter('taxonomy_id'));
  }
}
