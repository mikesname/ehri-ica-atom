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
    $this->form = new sfForm;

    $this->contactInformation = new QubitContactInformation;

    if (isset($request->id))
    {
      $this->contactInformation = QubitContactInformation::getById($request->id);

      if (!isset($this->contactInformation))
      {
        $this->forward404();
      }
    }

    $this->form->setDefault('next', $request->getReferer());
    $this->form->setValidator('next', new sfValidatorPass);
    $this->form->setWidget('next', new sfWidgetFormInputHidden);

    $this->form->setDefault('city', $this->contactInformation->city);
    $this->form->setValidator('city', new sfValidatorString);
    $this->form->setWidget('city', new sfWidgetFormInput);

    $this->form->setDefault('contactPerson', $this->contactInformation->contactPerson);
    $this->form->setValidator('contactPerson', new sfValidatorString);
    $this->form->setWidget('contactPerson', new sfWidgetFormInput);

    $this->form->setDefault('contactType', $this->contactInformation->contactType);
    $this->form->setValidator('contactType', new sfValidatorString);
    $this->form->setWidget('contactType', new sfWidgetFormInput);

    $this->form->setDefault('countryCode', $this->contactInformation->countryCode);
    $this->form->setValidator('countryCode', new sfValidatorI18nChoiceCountry);
    $this->form->setWidget('countryCode', new sfWidgetFormI18nSelectCountry(array('culture' => $this->context->user->getCulture())));

    $this->form->setDefault('email', $this->contactInformation->email);
    $this->form->setValidator('email', new sfValidatorString);
    $this->form->setWidget('email', new sfWidgetFormInput);

    $this->form->setDefault('fax', $this->contactInformation->fax);
    $this->form->setValidator('fax', new sfValidatorString);
    $this->form->setWidget('fax', new sfWidgetFormInput);

    $this->form->setDefault('latitude', $this->contactInformation->latitude);
    $this->form->setValidator('latitude', new sfValidatorNumber);
    $this->form->setWidget('latitude', new sfWidgetFormInput);

    $this->form->setDefault('longitude', $this->contactInformation->longitude);
    $this->form->setValidator('longitude', new sfValidatorNumber);
    $this->form->setWidget('longitude', new sfWidgetFormInput);

    $this->form->setDefault('note', $this->contactInformation->note);
    $this->form->setValidator('note', new sfValidatorString);
    $this->form->setWidget('note', new sfWidgetFormTextarea);

    $this->form->setDefault('postalCode', $this->contactInformation->postalCode);
    $this->form->setValidator('postalCode', new sfValidatorString);
    $this->form->setWidget('postalCode', new sfWidgetFormInput);

    $this->form->setDefault('primaryContact', $this->contactInformation->primaryContact);
    $this->form->setValidator('primaryContact', new sfValidatorBoolean);
    $this->form->setWidget('primaryContact', new sfWidgetFormInputCheckbox);

    $this->form->setDefault('region', $this->contactInformation->region);
    $this->form->setValidator('region', new sfValidatorString);
    $this->form->setWidget('region', new sfWidgetFormInput);

    $this->form->setDefault('streetAddress', $this->contactInformation->streetAddress);
    $this->form->setValidator('streetAddress', new sfValidatorString);
    $this->form->setWidget('streetAddress', new sfWidgetFormInput);

    $this->form->setDefault('telephone', $this->contactInformation->telephone);
    $this->form->setValidator('telephone', new sfValidatorString);
    $this->form->setWidget('telephone', new sfWidgetFormInput);

    $this->form->setDefault('website', $this->contactInformation->website);
    $this->form->setValidator('website', new sfValidatorString);
    $this->form->setWidget('website', new sfWidgetFormInput);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        if (isset($request['city']))
        {
          $this->contactInformation->city = $this->form->getValue('city');
        }

        if (isset($request['contactPerson']))
        {
          $this->contactInformation->contactPerson = $this->form->getValue('contactPerson');
        }

        if (isset($request['contactType']))
        {
          $this->contactInformation->contactType = $this->form->getValue('contactType');
        }

        if (isset($request['countryCode']))
        {
          $this->contactInformation->countryCode = $this->form->getValue('countryCode');
        }

        if (isset($request['email']))
        {
          $this->contactInformation->email = $this->form->getValue('email');
        }

        if (isset($request['fax']))
        {
          $this->contactInformation->fax = $this->form->getValue('fax');
        }

        if (isset($request['latitude']))
        {
          $this->contactInformation->latitude = $this->form->getValue('latitude');
        }

        if (isset($request['longitude']))
        {
          $this->contactInformation->longitude = $this->form->getValue('longitude');
        }

        if (isset($request['note']))
        {
          $this->contactInformation->note = $this->form->getValue('note');
        }

        if (isset($request['postalCode']))
        {
          $this->contactInformation->postalCode = $this->form->getValue('postalCode');
        }

        if (isset($request['primaryContact']))
        {
          $this->contactInformation->primaryContact = $this->form->getValue('primaryContact');
        }

        if (isset($request['region']))
        {
          $this->contactInformation->region = $this->form->getValue('region');
        }

        if (isset($request['streetAddress']))
        {
          $this->contactInformation->streetAddress = $this->form->getValue('streetAddress');
        }

        if (isset($request['telephone']))
        {
          $this->contactInformation->telephone = $this->form->getValue('telephone');
        }

        if (isset($request['website']))
        {
          $this->contactInformation->website = $this->form->getValue('website');
        }

        $this->contactInformation->save();

        if (null !== $next = $this->form->getValue('next'))
        {
          $this->redirect($next);
        }

        $this->redirect(array($this->contactInformation->actor, 'module' => 'actor', 'action' => 'edit'));
      }
    }
  }
}
