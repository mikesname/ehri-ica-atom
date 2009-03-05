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

class QubitEvent extends BaseEvent
{
  public function save($connection = null)
  {
    // TODO: $cleanInformationObject = $this->getInformationObject()->clean();
    $cleanInformationObjectId = $this->columnValues['information_object_id'];

    parent::save($connection);

    if ($cleanInformationObjectId != $this->getInformationObjectId() && QubitInformationObject::getById($cleanInformationObjectId) !== null)
    {
      SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanInformationObjectId));
    }

    if ($this->getInformationObject() !== null)
    {
      SearchIndex::updateTranslatedLanguages($this->getInformationObject());
    }
  }

  public function delete($connection = null)
  {
    parent::delete($connection);

    if ($this->getInformationObject() !== null)
    {
      SearchIndex::updateTranslatedLanguages($this->getInformationObject());
    }
  }

  public function getPlace(array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->getId());
    $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID);
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::PLACE_ID);
    $relation = QubitObjectTermRelation::get($criteria);

    if (count($relation) > 0)
    {

      return $relation[0]->getTerm();
    }
    else
    {

      return null;
    }
  }
}