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
  public static
    $NAMES = array(
      'city',
      'contactPerson',
      'contactType',
      'countryCode',
      'email',
      'fax',
      'latitude',
      'longitude',
      'note',
      'postalCode',
      'primaryContact',
      'region',
      'streetAddress',
      'telephone',
      'website');

  protected function addField($name)
  {
    switch ($name)
    {
      case 'countryCode':
        $this->form->setDefault('countryCode', $this->resource->countryCode);
        $this->form->setValidator('countryCode', new sfValidatorI18nChoiceCountry);
        $this->form->setWidget('countryCode', new sfWidgetFormI18nChoiceCountry(array('add_empty' => true, 'culture' => $this->context->user->getCulture())));

        break;

      case 'latitude':
      case 'longitude':
        $this->form->setDefault($name, $this->resource[$name]);
        $this->form->setValidator($name, new sfValidatorNumber);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'note':
        $this->form->setDefault('note', $this->resource->note);
        $this->form->setValidator('note', new sfValidatorString);
        $this->form->setWidget('note', new sfWidgetFormTextarea);

        break;

      case 'primaryContact':
        $this->form->setDefault('primaryContact', (bool)$this->resource->primaryContact);
        $this->form->setValidator('primaryContact', new sfValidatorBoolean);
        $this->form->setWidget('primaryContact', new sfWidgetFormInputCheckbox);

        break;

      default:
        $this->form->setDefault($name, $this->resource[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);
    }
  }

  protected function processField($field)
  {
    switch ($field->getName())
    {
      case 'primaryContact':
        $this->resource->primaryContact = true;

        break;

      default:
        $this->resource[$field->getName()] = $this->form->getValue($field->getName());
    }
  }

  protected function processForm()
  {
    $this->resource->primaryContact = false;

    foreach ($this->form as $field)
    {
      if (isset($this->request[$field->getName()]))
      {
        $this->processField($field);
      }
    }

    $this->resource->save();

    if ($this->resource->primaryContact)
    {
      $this->resource->makePrimaryContact();
    }
  }

  public function execute($request)
  {
    $this->form = new sfForm;

    $this->resource = new QubitContactInformation;
    if (isset($request->id))
    {
      $this->resource = QubitContactInformation::getById($request->id);

      if (!isset($this->resource))
      {
        $this->forward404();
      }
    }

    // HACK Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    $this->form->setDefault('next', $request->getReferer());
    $this->form->setValidator('next', new sfValidatorString);
    $this->form->setWidget('next', new sfWidgetFormInputHidden);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();

        if (null !== $next = $this->form->getValue('next'))
        {
          $this->redirect($next);
        }

        $this->redirect(array($this->resource->actor, 'module' => 'repository', 'action' => 'edit'));
      }
    }
  }
}
