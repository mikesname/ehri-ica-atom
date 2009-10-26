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

class QubitSearch extends xfIndexSingle
{
  /**
   * @see xfIndex
   */
  protected function initialize()
  {
    $this->setEngine(new xfLuceneEngine(sfConfig::get('sf_data_dir').'/index'));
    $this->getEngine()->open();
  }

  /**
   * @see xfIndex
   */
  public function populate()
  {
    $start = microtime(true);
    $this->getLogger()->log('Populating index...', $this->getName());
    $this->getEngine()->erase();
    $this->getLogger()->log('Index erased.', $this->getName());

    $criteria = new Criteria;
    foreach (QubitActor::get($criteria) as $actor)
    {
      $actor->updateLuceneIndex();
      $this->getLogger()->log('"'.$actor.'" inserted.', $this->getName());
    }

    $criteria = new Criteria;
    foreach (QubitInformationObject::get($criteria) as $informationObject)
    {
      SearchIndex::updateTranslatedLanguages($informationObject);
      $this->getLogger()->log('"'.$informationObject.'" inserted.', $this->getName());
    }

    $this->getLogger()->log('Index populated in "'.round(microtime(true) - $start, 2).'" seconds.', $this->getName());
  }
}
