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
 * Information Object - showDc
 *
 * @package    qubit
 * @subpackage informationObject - initialize a showDc template for displaying an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectShowDcAction extends InformationObjectShowAction
{
  public function execute($request)
  {
    // run the core informationObject show action commands
    parent::execute($request);

    if ($relation = $this->informationObject->getPropertyByName('information_object_relation'))
    {
      if (strlen($relation->getValue()) > 0)
      {
        $this->dcRelation = $relation;
      }
      else
      {
        $this->dcRelation = null;
      }
    }
    else
    {
      $this->dcRelation = null;
    }
  }
}
