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

class PhysicalObjectBoxListAction extends sfAction
{
  public function execute($request)
  {
    if (!isset($request->limit))
    {
      $request->limit = sfConfig::get('app_hits_per_page');
    }

    $this->physicalObject = QubitPhysicalObject::getById($request->id);

    if (!isset($this->physicalObject))
    {
      $this->forward404();
    }

    $criteria = new Criteria;
    $criteria->add(QubitRelation::SUBJECT_ID, $request->id);
    $criteria->add(QubitRelation::TYPE_ID, QubitTerm::HAS_PHYSICAL_OBJECT_ID);
    $criteria->addJoin(QubitRelation::OBJECT_ID, QubitInformationObject::ID);

    $this->pager = new QubitPager('QubitInformationObject');
    $this->pager->setCriteria($criteria);
    $this->pager->setMaxPerPage($request->limit);
    $this->pager->setPage($request->page);

    $this->informationObjects = $this->pager->getResults();
  }
}
