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

class ActorUpdateContactInformationAction extends sfAction
{
  public function execute($request)
  {
  if (!$this->getRequestParameter('id', 0))
    {
    $contactInformation = new ContactInformation;
    }
   else
    {
    $contactInformation = QubitContactInformation::getById($this->getRequestParameter('id'));
    $this->forward404Unless($contactInformation);
    }

    $contactInformation->setId($this->getRequestParameter('id'));

    //save fields by template
    switch ($this->getRequestParameter('template'))
        {
        case 'anotherTemplate' :
          //save stuff
          break;
        //default template is 'ISIAH'
        case 'isiah' :
        default :
          $this->updateContactInformation($contactInformation);
          break;
        }

  //set redirect if contactInformation edit was called from another module
    if ($this->getRequestParameter('repositoryReroute'))
      {
      return $this->redirect('repository/edit?id='.$this->getRequestParameter('repositoryReroute'));
      }

    //set view template
    switch ($this->getRequestParameter('template'))
      {
      case 'anotherTemplate' :
        return $this->redirect('actor/edit?id='.$contactInformation->getActorId().'&template=editAnotherTemplate');
      default :
        return $this->redirect('actor/edit?id='.$contactInformation->getActorId());
      }
  } //close execute()

  public function updateContactInformation($contactInformation)
  {
  $contactInformation->setActorId($contactInformation->getActorId());
  $contactInformation->setContactType($this->getRequestParameter('contact_type'));
  $contactInformation->setPrimaryContact($this->getRequestParameter('primary_contact'));
  $contactInformation->setStreetAddress($this->getRequestParameter('street_address'));
  $contactInformation->setCity($this->getRequestParameter('city'));
  $contactInformation->setRegion($this->getRequestParameter('region'));
  $contactInformation->setCountryCode($this->getRequestParameter('country_code'));
  $contactInformation->setPostalCode($this->getRequestParameter('postal_code'));
  $contactInformation->setTelephone($this->getRequestParameter('telephone'));
  $contactInformation->setFax($this->getRequestParameter('fax'));
  $contactInformation->setEmail($this->getRequestParameter('email'));
  $contactInformation->setWebsite($this->getRequestParameter('website'));
  $contactInformation->setNote($this->getRequestParameter('note'));

  $contactInformation->save();

  if ($contactInformation->getPrimaryContact())
    {
    $contactInformation->makePrimaryContact();
    }
  }
}
