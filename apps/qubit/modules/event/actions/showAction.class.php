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

class EventShowAction extends sfAction
{
  public function execute($request)
  {
    if (true || $request->isXmlHttpRequest())
    {
      $criteria = new Criteria;
      $criteria->add(QubitEvent::ID, $request->getParameter('id'), Criteria::EQUAL);

      $actorEvent = QubitEvent::getOne($criteria);

      if (null !== $actorEvent)
      {
        $properties['id'] = $actorEvent->getId();
        $properties['actorId'] = $actorEvent->getActorId();
        $properties['eventTypeId'] = $actorEvent->getTypeId();
        //$properties['placeId'] = $actorEvent->getPlaceId();

        if ($actorEvent->getStartDate() != '0000-00-00')
        {
          $properties['year'] = date('Y', strtotime($actorEvent->getStartDate()));
        }
        else
        {
          $properties['year'] = '';
        }

        if ($actorEvent->getEndDate() != '0000-00-00')
        {
          $properties['endYear'] = date('Y', strtotime($actorEvent->getEndDate()));
        }
        else
        {
          $properties['endYear'] = '';
        }

        $properties['dateDisplay'] = $actorEvent->getDateDisplay();
        $properties['description'] = $actorEvent->getDescription();

        // Build JSON string
        $jsonStr = '( {';
        foreach ($properties as $key => $val)
        {
          $jsonStr .= ' "'.$key.'": "'.$val.'", ';
        }
        $jsonStr = substr($jsonStr, 0, -2); // Chop trailing ", "
        $jsonStr .= ' } )';

        return $this->renderText($jsonStr);
      }
      else
      {
        return $this->renderText('{}');
      }
    }

    return $this->renderText('');
  }
}