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

class EventShowAction extends sfAction
{
  public function execute($request)
  {
    sfLoader::loadHelpers(array('Qubit'));

    $event = QubitEvent::getById($request->id);

    if (!isset($event))
    {
      $this->forward404();
    }

    $properties = array();
    $properties['id'] = $event->id;

    $properties['resourceTitle'] = $event->getInformationObject()->getTitle();
    $properties['actorId'] = $event->actorId;

    $properties['placeId'] = null;
    if ($place = $event->getPlace())
    {
      $properties['placeId'] = $place->id;
    }
    $properties['typeId'] = $event->typeId;

    $this->context->getConfiguration()->loadHelpers('Date');
    $properties['startDate'] = collapse_date($event->startDate);
    $properties['endDate'] = collapse_date($event->endDate);

    $properties['dateDisplay'] = $event->dateDisplay;
    $properties['description'] = $event->description;

    return $this->renderText(json_encode($properties));
  }
}
