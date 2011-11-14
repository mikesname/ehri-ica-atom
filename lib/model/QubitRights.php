<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class QubitRights extends BaseRights
{
  public function __toString()
  {
    $string = array();

    if (isset($this->basis))
    {
      $string[] = $this->basis;
    }

    if (isset($this->act))
    {
      $string[] = $this->act;
    }

    $string = implode(' - ', $string);

    if (null !== $date = Qubit::renderDateStartEnd(null, $this->startDate, $this->endDate))
    {
      $string .= ' ('.$date.')';
    }

    return $string;
  }

  protected function insert($connection = null)
  {
    $this->slug = QubitSlug::slugify($this->slug);

    return parent::insert($connection);
  }

  public function delete($connection = null)
  {
    // Make sure that the associated QubitRelation object is removed before
    foreach (QubitRelation::getRelationsByObjectId($this->id, array('typeId' => QubitTerm::RIGHT_ID)) as $item)
    {
      $item->delete();
    }

    parent::delete($connection);
  }
}
