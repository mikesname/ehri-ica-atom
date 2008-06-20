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
    
    // Currently no default template for post-delete, so require the "next" 
    // parameter for redirect
    $next = urldecode($this->getRequestParameter('next'));
    $this->forward404Unless($next);
    
    // Do delete
    $this->relation->delete();
     
    return $this->redirect($next);
  }
}
