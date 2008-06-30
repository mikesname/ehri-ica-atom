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

class RepositoryDeleteAction extends sfAction
{
  public function execute($request)
  {

   $repository = QubitRepository::getById($this->getRequestParameter('id'));

   $this->forward404Unless($repository);
    
    // keep track of informationObjects that require a foreign key reset and 
    // search index update due to the deletion of related repository 
    $informationObjects = array();
    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::REPOSITORY_ID, $repository->getId());
    $informationObjects = QubitInformationObject::get($criteria);

    foreach ($informationObjects as $informationObject)
    {
      $informationObject->setRepositoryId(null);
      $informationObject->save();
      SearchIndex::UpdateTranslatedLanguages($informationObject);
    }
    
    $repository->delete();

    return $this->redirect('repository/list');


  }
}
