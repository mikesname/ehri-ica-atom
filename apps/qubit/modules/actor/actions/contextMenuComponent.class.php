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
    $this->actor = QubitActor::getById($request->id);

    $criteria = new Criteria;
    $criteria->add(QubitEvent::ACTOR_ID, $this->actor->id);
    $criteria->addJoin(QubitEvent::INFORMATION_OBJECT_ID, QubitInformationObject::ID);
    $criteria->addAscendingOrderByColumn(QubitEvent::TYPE_ID);

    // Sort info objects alphabetically (w/ fallback)
    $criteria->addAscendingOrderByColumn('title');
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitInformationObject');

    // Filter draft descriptions
    $criteria = QubitAcl::addFilterDraftsCriteria($criteria);

    $this->relatedInfoObjects = array();
    if (0 < count($events = QubitEvent::get($criteria)))
    {
      foreach ($events as $event)
      {
        $this->relatedInfoObjects[$event->type->getRole()][] = $event->informationObject;
      }
    }
    else
    {
      return sfView::NONE;
    }
  }
}
