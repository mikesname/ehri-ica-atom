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
    $term = QubitTerm::getById($this->getRequestParameter('id'));

    $this->forward404Unless($term);

  //make sure a locked term value is not updated
/*
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
    $term->delete();
    
    if ($this->getRequestParameter('taxonomyId'))
    {
      return $this->redirect('term/list?taxonomyId='.$this->getRequestParameter('taxonomyId'));
    }
    else
    {
      return $this->redirect('term/list');
    }
  
  }
}
