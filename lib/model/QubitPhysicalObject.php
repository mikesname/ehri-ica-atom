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

class QubitPhysicalObject extends BasePhysicalObject
{
  /**
   * Call this function when casting object instance as type string
   *
   * @return string  Physical Object Name
   */
  public function __toString()
  {
    if (!$this->getName())
    {
      return (string) $this->getName(array('sourceCulture' => true));
    }

    return (string) $this->getName();
  }

  /**
   * Overwrite BasePhysicalObject::delete() method to add cascading delete
   * logic
   *
   * @param mixed $connection a database connection object
   */
  public function delete($connection = null)
  {
    $this->deleteInformationObjectRelations();

    parent::delete($connection);
  }

  /**
   * Delete relation records linking this physical object to information objects
   */
  public function deleteInformationObjectRelations()
  {
    $informationObjectRelations = QubitRelation::getRelationsBySubjectId($this->getId(),
    array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    foreach ($informationObjectRelations as $relation)
    {
      $relation->delete();
    }
  }

  /**
   * Get related information object via QubitRelation relationship
   *
   * @param array $options list of options to pass to QubitQuery
   * @return QubitQuery collection of Information Objects
   */
  public function getInformationObjects($options = array())
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitPhysicalObject::ID, QubitRelation::SUBJECT_ID);
    $criteria->addJoin(QubitRelation::OBJECT_ID, QubitInformationObject::ID);
    $criteria->add(QubitPhysicalObject::ID, $this->getId());

    return QubitQuery::createFromCriteria($criteria, 'QubitInformationObject', $options);
  }

}
