<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class updateContactInformationAction extends sfAction
{
  public function execute()
  {

  if (!$this->getRequestParameter('id', 0))
    {
    $contactInformation = new contactInformation();
    }
   else
    {
    $contactInformation = contactInformationPeer::retrieveByPk($this->getRequestParameter('id'));
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
  if ($this->getRequestParameter('country_id'))
    {
    $contactInformation->setCountryId($this->getRequestParameter('country_id'));
    }
  $contactInformation->setPostalCode($this->getRequestParameter('postal_code'));
  $contactInformation->setTelephone($this->getRequestParameter('telephone'));
  $contactInformation->setFax($this->getRequestParameter('fax'));
  $contactInformation->setEmail($this->getRequestParameter('email'));
  $contactInformation->setWebsite($this->getRequestParameter('website'));
  $contactInformation->setNote($this->getRequestParameter('contactInformationNote'));

  $contactInformation->save();

  if ($contactInformation->getPrimaryContact() == TRUE)
    {
    $contactInformation->makePrimaryContact();
    }
  }

}
