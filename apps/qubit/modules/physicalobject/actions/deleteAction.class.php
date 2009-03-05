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
    $physicalObject = QubitPhysicalObject::getById($this->getRequestParameter('id'));
    $this->forward404Unless($physicalObject);

    $this->forward404Unless($this->hasRequestParameter('next'));

    // Get related information objects (if any)
    $informationObjects = QubitRelation::getRelatedObjectsBySubjectId('QubitInformationObject', $physicalObject->getId(),
      array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    // Delete physical object record from the database
    $physicalObject->delete();

    // Make the $next parameter into an absolute URL because redirect() expects
    // an absolute URL or an array containing module and action
    // (Pre-pend code copied from sfWebController->genUrl() method)
    $next = 'http'.($request->isSecure() ? 's' : '').'://'.$request->getHost().$this->getRequestParameter('next');
    return $this->redirect($next);
  }
}
