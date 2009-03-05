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
 * Information Object - editDc
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editDc template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectEditDcAction extends InformationObjectEditAction
{
  public function execute($request)
  {
    // run the core informationObject edit action commands
    parent::execute($request);

    // add Dublin Core specific commands
    $this->dcEventTypes = QubitTerm::getDcEventTypeList();
    $this->dcRelation = $this->informationObject->getPropertyByName('information_object_relation', array('scope'=>'dc'));

    // overwrite the default edit template
    $this->setTemplate('editDc');
  }
}