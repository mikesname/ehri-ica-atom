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

class ActorDeleteOtherNameAction extends sfAction
{
  public function execute($request)
  {
	  $this->deleteOtherName = QubitActorName::getById($this->getRequestParameter('otherNameId'));	
	  $this->forward404Unless($this->deleteOtherName);	
	  $actorId = $this->deleteOtherName->getActorId();
	   
	  // Do delete
	  $this->deleteOtherName->delete();
	  
	  if ($this->getRequestParameter('next'))
	  {
		  // Make the $next parameter into an absolute URL because redirect() expects
		  // an absolute URL or an array containing module and action
		  // (Pre-pend code copied from sfWebController->genUrl() method)  
		  $next = 'http'.($request->isSecure() ? 's' : '').'://'.$request->getHost().$this->getRequestParameter('next');
	    
		  return $this->redirect($next);
	  } 
	  else 
	  {
	    // Default redirect to actor/edit page
	    $returnTemplate = $this->getRequestParameter('ReturnTemplate');
	    return $this->redirect('actor/edit/?id='.$actorId.'&template='.$returnTemplate);
	  }
  }
}