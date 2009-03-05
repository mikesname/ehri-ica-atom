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

class TermListAction extends sfAction
{
  public function execute($request)
  {
    if ($this->getRequestParameter('taxonomyId'))
    {
      $this->taxonomyId = $this->getRequestParameter('taxonomyId');
      $this->terms = QubitTaxonomy::getTermsById($this->taxonomyId);
      $this->terms = $this->terms->orderBy('lft');
    }
    else
    {
      // default taxonomy for list view
      $this->taxonomyId = 0;
      $this->taxonomies = QubitTaxonomy::getEditableTaxonomies();
    }

    if ($this->getRequestParameter('sort'))
    {
      $this->sort = $this->getRequestParameter('sort');
    }
    else
    {
      //default sort column for list view
      $this->sort = 'default';
    }

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'term'))
    {
      $this->editCredentials = true;
    }

    //set view template
    if ($this->taxonomyId != 0)
    {
      $taxonomy = QubitTaxonomy::getById($this->taxonomyId);
      $this->taxonomyName = $taxonomy->getName();
      $this->setTemplate('listTaxonomy');
    }
    else
    {
      $this->taxonomyName = '';
      $this->setTemplate('list');
    }
  }
}
