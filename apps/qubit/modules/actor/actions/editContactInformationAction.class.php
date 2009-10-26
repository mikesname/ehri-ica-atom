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

class ActorEditContactInformationAction extends sfAction
{
  public function execute($request)
  {
    $this->getResponse()->addJavaScript('/vendor/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');

    $this->contactInformation = QubitContactInformation::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->contactInformation);

    if ($this->getRequestParameter('repositoryReroute'))
    {
      $this->repositoryReroute = $this->getRequestParameter('repositoryReroute');
    }
    else
    {
      $this->repositoryReroute = null;
    }

    if ($request->isMethod('post'))
    {
      $this->updateContactInformation();

      if ($this->getRequestParameter('repositoryReroute'))
      {
        //set redirect if contactInformation edit was called from the repository module
        $this->redirect(array('module' => 'repository', 'action' => 'edit', 'id' => $this->getRequestParameter('repositoryReroute')));
      }
      else
      {
        $this->redirect(array('module' => 'actor', 'action' => 'edit', 'id' => $contactInformation->getActorId()));
      }
    }
  } //close execute()

  public function updateContactInformation()
  {
    $this->contactInformation->setActorId($this->contactInformation->getActorId());
    $this->contactInformation->setContactType($this->getRequestParameter('contact_type'));
    $this->contactInformation->setPrimaryContact($this->getRequestParameter('primary_contact'));
    $this->contactInformation->setContactPerson($this->getRequestParameter('contact_person'));
    $this->contactInformation->setStreetAddress($this->getRequestParameter('street_address'));
    $this->contactInformation->setCity($this->getRequestParameter('city'));
    $this->contactInformation->setRegion($this->getRequestParameter('region'));
    $this->contactInformation->setCountryCode($this->getRequestParameter('country_code'));
    $this->contactInformation->setPostalCode($this->getRequestParameter('postal_code'));
    $this->contactInformation->setTelephone($this->getRequestParameter('telephone'));
    $this->contactInformation->setFax($this->getRequestParameter('fax'));
    $this->contactInformation->setLatitude($this->getRequestParameter('latitude'));
    $this->contactInformation->setLongtitude($this->getRequestParameter('longtitude'));
    $this->contactInformation->setEmail($this->getRequestParameter('email'));
    $this->contactInformation->setWebsite($this->getRequestParameter('website'));
    $this->contactInformation->setNote($this->getRequestParameter('note'));

    $this->contactInformation->save();

    if ($this->contactInformation->getPrimaryContact())
    {
      $this->contactInformation->makePrimaryContact();
    }
  }
}
