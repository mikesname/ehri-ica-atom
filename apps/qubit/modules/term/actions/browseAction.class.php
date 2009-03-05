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

class TermBrowseAction extends sfAction
{
  public function execute($request)
  {
    //determine if user has edit priviliges
    $this->editCredentials = SecurityPriviliges::editCredentials($this->getUser(), 'term');
    
    $this->culture = $this->getUser()->getCulture();

    if (null !== $this->getRequestParameter('termId'))
    {
      $options = array();
      
      $this->termId = $this->getRequestParameter('termId');
      $this->term = QubitTerm::getById($this->termId);
      $this->forward404Unless(isset($this->term));
      
      $options['culture'] = $this->culture;

      $this->sortColumn = $this->getRequestParameter('sortColumn', 'title');
      $options['sortColumn'] = $this->sortColumn;
      
      $this->sortDirection = $this->getRequestParameter('sortDirection', 'ascending');
      $options['sortDirection'] = $this->sortDirection;
      
      $this->page = $this->getRequestParameter('page', 1);
      $options['page'] = $this->page;

      $this->informationObjects = QubitObjectTermRelation::getTermBrowseList($this->termId, 'QubitInformationObject', $options);

      $this->setTemplate('browseTerm');
    }
    else
    {
      $options = array();
      
      // Do cultural fallback
      $options['cultureFallback'] = true;
      
      $this->sort = $this->getRequestParameter('sort', 'termNameUp');
      $options['sort'] = $this->sort;
      
      // Get taxonomy id (default to "Subjects" taxonomy)
      if ($this->getRequestParameter('taxonomyId'))
      {
        $this->taxonomyId = $this->getRequestParameter('taxonomyId');
      }
      else
      {
        $this->taxonomyId = QubitTaxonomy::SUBJECT_ID;
      }
      $options['taxonomyId'] = $this->taxonomyId;
    
      // Get taxonomy object and term list
      $this->taxonomy = QubitTaxonomy::getById($this->taxonomyId);
      $this->terms = QubitTerm::getBrowseList($this->culture, new Criteria, $options);

      $this->setTemplate('browseTaxonomy');
    }
  }
}
