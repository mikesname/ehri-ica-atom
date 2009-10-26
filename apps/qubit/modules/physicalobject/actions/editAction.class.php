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
    $this->physicalObject = QubitPhysicalObject::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->physicalObject);

    $relatedInfoObjects = QubitRelation::getRelatedObjectsBySubjectId('QubitInformationObject', $this->physicalObject->getId(),
      array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));
    $this->relatedInfoObjectCount = count($relatedInfoObjects);

    $this->relatedInfoObjects = $relatedInfoObjects;

    // If coming here from another page (e.g. informationobject/edit) redirect
    // back on update/cancel/delete
    $this->nextAction = null;
    if ($this->hasRequestParameter('next'))
    {
      $this->nextAction = $this->getRequestParameter('next');
    }
  }
}
