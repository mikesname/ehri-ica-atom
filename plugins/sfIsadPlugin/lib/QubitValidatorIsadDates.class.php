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

class QubitValidatorIsadDates extends sfValidatorBase
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addOption('invalid');
  }

  protected function doClean($value)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'Qubit'));

    foreach ($value->events as $event)
    {
      $startDate = null;
      if (null != $event->startDate)
      {
        $startDate = new DateTime($event->startDate);
      }

      $endDate = null;
      if (null != $event->endDate)
      {
        $endDate = new DateTime($event->endDate);
      }

      // Check ancestors
      foreach ($value->ancestors as $ancestor)
      {
        if (0 < count($ancestorEvents = $ancestor->getDates(array('type_id' => $event->type->id))))
        {
          $validStartDate = $validEndDate = false;

          foreach ($ancestorEvents as $ancestorEvent)
          {
            $ancestorStartDate = null;
            if (null != $ancestorEvent->startDate)
            {
              $ancestorStartDate = new DateTime($ancestorEvent->startDate);
            }

            $ancestorEndDate = null;
            if (null != $ancestorEvent->endDate)
            {
              $ancestorEndDate = new DateTime($ancestorEvent->endDate);
            }

            // Compare startDate with ancestor dates
            if (null != $startDate)
            {
              if ((null == $ancestorStartDate || $startDate >= $ancestorStartDate) && (null == $ancestorEndDate || $startDate < $ancestorEndDate))
              {
                $validStartDate = true;
              }
            }
            else
            {
              $validStartDate = true;
            }

            // Compare endDate with ancestor dates
            if (null != $endDate)
            {
              if ((null == $ancestorStartDate || $endDate > $ancestorStartDate) && (null == $ancestorEndDate || $endDate <= $ancestorEndDate))
              {
                $validEndDate = true;
              }
            }
            else
            {
              $validEndDate = true;
            }

            if ($validStartDate && $validEndDate)
            {
              break;
            }
          }

          // If the current dates aren't within at least one of the ranges
          // for this ancestor, then throw validation error
          if (!($validStartDate && $validEndDate))
          {
            throw new sfValidatorError($this, 'invalid', array('ancestor' => url_for(array($ancestor, 'module' => 'informationobject'))));
          }
        }
      }
    }

    return $value;
  }
}
