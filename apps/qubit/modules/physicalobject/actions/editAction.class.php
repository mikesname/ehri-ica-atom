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

/**
 * Physical Object edit
 *
 * @package    qubit
 * @subpackage physicalobject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class PhysicalObjectEditAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    $this->physicalObject = new QubitPhysicalObject;

    if (isset($request->id))
    {
      $this->physicalObject = QubitPhysicalObject::getById($request->id);

      if (!isset($this->physicalObject))
      {
        $this->forward404();
      }
    }

    $this->form->setDefault('next', $request->getReferer());
    $this->form->setValidator('next', new sfValidatorString);
    $this->form->setWidget('next', new sfWidgetFormInputHidden);

    $this->form->setDefault('location', $this->physicalObject->location);
    $this->form->setValidator('location', new sfValidatorString);
    $this->form->setWidget('location', new sfWidgetFormInput);

    $this->form->setDefault('name', $this->physicalObject->name);
    $this->form->setValidator('name', new sfValidatorString);
    $this->form->setWidget('name', new sfWidgetFormInput);

    $this->form->setDefault('type', $this->context->routing->generate(null, array($this->physicalObject->type, 'module' => 'term')));
    $this->form->setValidator('type', new sfValidatorString);

    $choices = array();
    $choices[null] = null;

    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::PHYSICAL_OBJECT_TYPE_ID);
    foreach (QubitTerm::get($criteria) as $item)
    {
      $choices[$this->context->routing->generate(null, array($item, 'module' => 'term'))] = $item;
    }

    $this->form->setWidget('type', new sfWidgetFormSelect(array('choices' => $choices)));

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->physicalObject->name = $this->form->getValue('name');
        $this->physicalObject->location = $this->form->getValue('location');

        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue('type')));
        $this->physicalObject->typeId = $params['id'];

        $this->physicalObject->save();

        if (null !== $next = $this->form->getValue('next'))
        {
          $this->redirect($next);
        }

        $this->redirect(array($this->physicalObject, 'module' => 'physicalobject'));
      }
    }
  }
}
