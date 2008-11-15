<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
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

      $this->repository = QubitRepository::getById($request->getParameter('id'));

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
      $this->repository = null;
    }

    // Don't show anything if there are no related info objects or repository
    if (count($this->relatedInfoObjects) == 0 && count($this->repository) == 0)
    {
      return sfView::NONE;
    }
  }
}