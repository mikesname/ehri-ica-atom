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
    $term->setScopeNote($this->getRequestParameter('scope_note'));
    $term->setCodeAlpha($this->getRequestParameter('code_alpha'));
    $term->setCodeAlpha2($this->getRequestParameter('code_alpha2'));
    if ($this->getRequestParameter('code_numeric'))
    { $term->setCodeNumeric($this->getRequestParameter('code_numeric')); }
    else
    { $term->setCodeNumeric(null); }
/*
//DEPRECATED:
        if ($this->getRequestParameter('sort_order'))
    { $term->setSortOrder($this->getRequestParameter('sort_order')); }
    else
    { $term->setSortOrder(null); }
*/
    $term->setSource($this->getRequestParameter('source'));

    $term->save();

    $taxonomyId = $term->getTaxonomyId();

    return $this->redirect('term/list?taxonomyId='.$this->getRequestParameter('taxonomy_id'));
  }
}
