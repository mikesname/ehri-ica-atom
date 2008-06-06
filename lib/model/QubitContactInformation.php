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

class QubitContactInformation extends BaseContactInformation
{
  public function __toString()
  {
    return (string) $this->getContactType();
  }

  public function makePrimaryContact()
  {
  $criteria = new Criteria;
  $criteria->add(QubitContactInformation::ACTOR_ID, $this->getActorId());
  $otherContacts = self::get($criteria);
  foreach ($otherContacts as $contact)
    {
    if ($contact->getId() == $this->getId())
      {
      $contact->setPrimaryContact(true);
      }
    else
      {
      $contact->setPrimaryContact(false);
      }
    $contact->save();
    }
  }

  public function getContactInformationString()
  {
  $string = ($this->getStreetAddress()) ? nl2br($this->getStreetAddress()).'<br />' : '' ;
  $string.= ($this->getCity()) ? $this->getCity() : '' ;
  $string.= ($this->getRegion()) ? ', '.$this->getRegion() : '' ;
  $string.= ($this->getCountryCode()) ? '<br />'.$this->getCountryCode().'' : '' ;
  $string.= ($this->getPostalCode()) ? '   '.$this->getPostalCode(): '' ;
  $string.= ($this->getTelephone()) ? '<p> telephone number: '.$this->getTelephone().'<br />' : '' ;
  $string.= ($this->getFax()) ? 'fax number: '.$this->getFax().'<br />' : '' ;
  $string.= ($this->getEmail()) ? 'email: '.$this->getEmail().'<br />' : '' ;
  $string.= ($this->getWebsite()) ? 'website: <a href="'.$this->getWebsite().'">'.$this->getWebsite().'</a>' : '' ;

  return $string;
  }
}
