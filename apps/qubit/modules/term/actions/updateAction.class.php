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
    }

    $term->setTaxonomyId($this->getRequestParameter('taxonomy_id'));

    if ($this->getRequestParameter('taxonomy_id') == QubitTaxonomy::PHYSICAL_OBJECT_TYPE_ID)
    // Temporary workaround for saving physical objects until nested set is enabled on term edit
    // and the full Physical Object Type hierarchy is offered for editing to the end-user
    {
      $term->setParentId(QubitTerm::CONTAINER_ID);
    }
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

    if ($this->getRequestParameter('new_display_note'))
    {
      $term->setNote($this->getUser()->getAttribute('user_id'), $this->getRequestParameter('new_display_note'), QubitTerm::DISPLAY_NOTE_ID);
    }

    $taxonomyId = $term->getTaxonomyId();

    // If requesting a json response object
    if ($request->getParameter('responseFormat') == 'json')
    {
      $jsonObject = '({"id": "'.$term->getId().'", "name": "'.$term->getName().'"})';

      // Return json object
      return $this->renderText($jsonObject);
    }

    return $this->redirect('term/list?taxonomyId='.$this->getRequestParameter('taxonomy_id'));
  }
}
