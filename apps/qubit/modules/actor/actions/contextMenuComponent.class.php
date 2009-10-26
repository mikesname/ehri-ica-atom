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
 * Actor contextMenu component
 * 
 * @package qubit
 * @subpackage actor
 * @version svn: $Id$
 * @author Peter Van Garderen <peter@artefactual.com>
 * @author David Juhasz <david@artefactual.com>
 */
class ActorContextMenuComponent extends sfComponent
{
  public function execute($request)
  {
    if ($request->getParameter('id'))
    {
      $this->actor = QubitActor::getById($request->getParameter('id'));

      if (null !== $this->actor)
      {
        $this->informationObjectRelations = $this->actor->getInformationObjectRelations();

        $relatedInfoObjects = array();
        foreach ($this->actor->getInformationObjectRelations() as $relation)
        {
          $relatedInfoObjects[$relation->getType()->getRole()][] = $relation;
        }
        $this->relatedInfoObjects = $relatedInfoObjects;
      }
    }
    else
    {
      $this->relatedInfoObjects = null;
    }

    // Don't show anything if there are no related info objects or repository
    if (count($this->relatedInfoObjects) == 0 && count($this->repository) == 0)
    {
      return sfView::NONE;
    }
  }
}
