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
 * Physical Object deletion
 *
 * @package    qubit
 * @subpackage physicalobject
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class PhysicalObjectDeleteAction extends sfAction
{
  public function execute($request)
  {
    $this->form = new sfForm;

    $this->physicalObject = QubitPhysicalObject::getById($request->id);

    if (!isset($this->physicalObject))
    {
      $this->forward404();
    }

    $criteria = new Criteria;
    $criteria->add(QubitRelation::SUBJECT_ID, $this->physicalObject->id);
    $criteria->addJoin(QubitRelation::OBJECT_ID, QubitInformationObject::ID);
    $this->informationObjects = QubitInformationObject::get($criteria);

    $this->form->setValidator('next', new sfValidatorString);
    $this->form->setWidget('next', new sfWidgetFormInputHidden);

    $this->form->bind($request->getGetParameters());

    if ($request->isMethod('delete'))
    {
      $this->form->bind($request->getPostParameters());

      $this->physicalObject->delete();

      if (null !== $next = $this->form->getValue('next'))
      {
        $this->redirect($next);
      }

      $this->redirect('@homepage');
    }
  }
}
