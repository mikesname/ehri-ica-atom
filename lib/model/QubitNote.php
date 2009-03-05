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

class QubitNote extends BaseNote
{
  public function __toString()
  {
    if (null === $content = $this->getContent())
    {
      $content = $this->getContent(array('sourceCulture' => true));
    }

    return (string) $content;
  }

  public function save($connection = null)
  {
    // TODO: $cleanObject = $this->getObject()->clean();
    $cleanObjectId = $this->columnValues['object_id'];

    parent::save($connection);

    if ($cleanObjectId != $this->getObjectId() && QubitInformationObject::getById($cleanObjectId) !== null)
    {
      SearchIndex::updateTranslatedLanguages(QubitInformationObject::getById($cleanObjectId));
    }

    if ($this->getObject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getObject());
    }
  }

  public function delete($connection = null)
  {
    parent::delete($connection);

    if ($this->getObject() instanceof QubitInformationObject)
    {
      SearchIndex::updateTranslatedLanguages($this->getObject());
    }
  }
}
