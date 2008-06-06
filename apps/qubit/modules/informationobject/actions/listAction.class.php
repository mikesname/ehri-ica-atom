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

class InformationObjectListAction extends sfAction
{
  public function execute($request)
  {
  // HACK: populate root information object from ORM
  $criteria = new Criteria;
  $criteria->add(QubitInformationObject::PARENT_ID);
  $request->setAttribute('informationObject', QubitInformationObject::getOne($criteria));

  //establish list filters
  if ($this->getRequestParameter('repository'))
      {
      $this->repositoryId = $this->getRequestParameter('repository');
      }
    else
      {
      //default repositoryId for list view
      $this->repositoryId = 0;
      }

  if ($this->getRequestParameter('collectionType'))
      {
      $this->collectionTypeId = $this->getRequestParameter('collectionType');
      }
    else
      {
      //default collectionTypeId for list view
      $this->collectionTypeId = 0;
      }

    if ($this->getRequestParameter('sort'))
      {
      $this->sort = $this->getRequestParameter('sort');
      }
    else
      {
      //default sort column for list view
      $this->sort = 'titleUp';
      }

    $this->informationObjects = QubitInformationObject::getList($this->sort, $this->repositoryId, $this->collectionTypeId);

    //determine if user has edit priviliges
    $this->editCredentials = false;
    if (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject'))
      {
      $this->editCredentials = true;
      }

   //set view template
    switch ($this->getRequestParameter('template'))
      {
      case 'isad' :
        $this->setTemplate('listISAD');
        break;
      default :
        $this->setTemplate(sfConfig::get('app_default_template_informationobject_list'));
    }
    }
}
