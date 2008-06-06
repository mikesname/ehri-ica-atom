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

class TermBrowseAction extends sfAction
{
  public function execute($request)
  {
    //determine if user has edit priviliges
    $this->editCredentials = SecurityPriviliges::editCredentials($this->getUser(), 'term');

    if (null !== $termId = $this->getRequestParameter('termId'))
    {
      $this->term = QubitTerm::getById($termId);

      $this->forward404Unless(isset($this->term));

      $this->sortColumn = $this->getRequestParameter('sortColumn');
      $this->sortDirection = $this->getRequestParameter('sortDirection');

      $this->informationObjects = QubitObjectTermRelation::getTermBrowseList($termId, $className = 'QubitInformationObject', $this->sortColumn, $this->sortDirection);

      $this->setTemplate('browseTerm');
    }
    else
    {
      $this->sort = $this->getRequestParameter('sort', 'termNameUp');
      if ($this->getRequestParameter('taxonomyId'))
        {
          $taxonomyId = $this->getRequestParameter('taxonomyId');
        }
      else
        {
          $taxonomyId = QubitTaxonomy::SUBJECT_ID;
        }

      $this->taxonomy = QubitTaxonomy::getById($taxonomyId);
      $language = $this->getUser()->getCulture();
      $this->terms = TermPeer::getTaxonomyBrowseList($taxonomyId, $this->sort, $language);

      $this->setTemplate('browseTaxonomy');
    }
  }
}
