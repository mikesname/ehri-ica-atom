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

class EventIndexAction extends sfAction
{
  public function execute($request)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Qubit');

    $event = QubitEvent::getById($request->id);

    if (!isset($event))
    {
      $this->forward404();
    }

    $properties['id'] = $event->id;
    $properties['informationObject'] = $this->context->routing->generate(null, array('module' => 'informationobject', 'id' => $event->informationObjectId));
    $properties['informationObjectDisplay'] = $event->informationObject->__toString();

    $properties['actor'] = null;
    if (null !== $event->actorId)
    {
      $properties['actor'] = $this->context->routing->generate(null, array('module' => 'actor', 'id' => $event->actorId));
      $properties['actorDisplay'] = $event->actor->__toString();
    }

    $properties['place'] = null;
    if (null !== $place = $event->getPlace())
    {
      $properties['place'] = $this->context->routing->generate(null, array($place, 'module' => 'term'));
      $properties['placeDisplay'] = $place->__toString();
    }

    $properties['type'] = $this->context->routing->generate(null, array('module' => 'term', 'id' => $event->typeId));
    $properties['typeDisplay'] = $event->type->__toString();

    $properties['startDate'] = collapse_date($event->startDate);
    $properties['endDate'] = collapse_date($event->endDate);
    $properties['dateDisplay'] = $event->dateDisplay;
    $properties['description'] = $event->description;

    return $this->renderText(json_encode($properties));
  }
}
