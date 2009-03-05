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
 * Information Object - updateMods
 *
 * @package    qubit
 * @subpackage informationObject - update an information object, including any Mods specific properties
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectUpdateModsAction extends InformationObjectUpdateAction
{
  public function execute($request)
  {
    // run the core informationObject update action commands
    parent::execute($request);

   // return to MODS edit template
   return $this->redirect(array('module' => 'informationobject', 'action' => 'edit', 'informationobject_template' => 'mods', 'id' => $this->informationObject->getId()));
  }
}
