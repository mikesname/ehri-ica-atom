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

class ContactInformation extends BaseContactInformation
{

  public function __toString()
  {

    return (string) $this->getContactType();
  }

  public function makePrimaryContact()
  {
  $c = new Criteria();
  $c->add(ContactInformationPeer::ACTOR_ID, $this->getActorId());
  $otherContacts = ContactInformationPeer::doSelect($c);
  foreach ($otherContacts as $contact)
    {
    $contact->setPrimaryContact(NULL);
    $contact->save();
    }
  $this->setPrimaryContact(TRUE);
  $this->save();
  }

  public function getCountry()
  {

  return TermPeer::retrieveByPk($this->getCountryId());
  }

  public function getContactInformationString()
  {
  $string = ($this->getStreetAddress()) ? nl2br($this->getStreetAddress()).'<br />' : '' ;
  $string.= ($this->getCity()) ? $this->getCity() : '' ;
  $string.= ($this->getRegion()) ? ', '.$this->getRegion() : '' ;
  $string.= ($this->getCountryId()) ? '<br />'.$this->getCountry().'' : '' ;
  $string.= ($this->getPostalCode()) ? '   '.$this->getPostalCode(): '' ;
  $string.= ($this->getTelephone()) ? '<p> telephone number: '.$this->getTelephone().'<br />' : '' ;
  $string.= ($this->getFax()) ? 'fax number: '.$this->getFax().'<br />' : '' ;
  $string.= ($this->getEmail()) ? 'email: '.$this->getEmail().'<br />' : '' ;
  $string.= ($this->getWebsite()) ? 'website: <a href="'.$this->getWebsite().'">'.$this->getWebsite().'</a>' : '' ;


  return $string;
  }

}
