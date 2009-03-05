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
 * Actor - createIsaar
 *
 * @package    qubit
 * @subpackage Actor - initialize an editISAAR template for adding a new actor
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class ActorCreateIsaarAction extends ActorCreateAction
{
  public function execute($request)
  {
    // run the core actor create action commands
    parent::execute($request);

    // add ISAAR specific commands

    // route to the edit template
    $this->setTemplate('editIsaar');
  }
}
