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

class TermDeleteAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    $this->term = QubitTerm::getById($request->id);

    if (!isset($this->term))
    {
      $this->forward404();
    }

    // Check user authorization
    if (!QubitAcl::check($this->term, 'delete'))
    {
      QubitAcl::forwardUnauthorized();
    }

    $request->setAttribute('term', $this->term);

    if ($request->isMethod('delete'))
    {
      // Don't delete protected terms
      if ($this->term->isProtected())
      {
        $this->forward('admin', 'termPermission');
      }

      foreach ($this->term->descendants->andSelf()->orderBy('rgt') as $descendant)
      {
        if (QubitAcl::check($descendant, 'delete'))
        {
          $descendant->delete();
        }
      }

      if (isset($this->term->taxonomy))
      {
        $this->redirect(array('module' => 'term', 'action' => 'listTaxonomy', 'id' => $this->term->taxonomyId));
      }

      $this->redirect(array('module' => 'term', 'action' => 'list'));
    }
  }
}
