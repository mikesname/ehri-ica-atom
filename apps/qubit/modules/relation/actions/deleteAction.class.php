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

/**
 * Unlink information object from physical object 
 *
 * @package qubit
 * @subpackage informationobject
 * @author David Juhasz <david@artefactual.com>
 * @version svn:$Id
 */
class RelationDeleteAction extends sfAction
{
  public function execute($request)
  {
    $this->relation = QubitRelation::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->relation);
    
    // Make the $next parameter into an absolute URL because redirect() expects
    // an absolute URL or an array containing module and action
    // (Pre-pend code copied from sfWebController->genUrl() method)  
    $next = 'http'.($request->isSecure() ? 's' : '').'://'.$request->getHost().$this->getRequestParameter('next');
    $this->forward404Unless($next);
    
    // Do delete
    $this->relation->delete();
     
    $this->redirect($next);
  }
}
