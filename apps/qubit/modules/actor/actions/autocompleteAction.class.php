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

class ActorAutocompleteAction extends sfAction
{
  public function execute($request)
  {
    $criteria = new Criteria;
    $criteria->add(QubitActor::CLASS_NAME, 'QubitActor');
    $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $request->query.'%', Criteria::LIKE);
    $criteria->addJoin(QubitActor::ID, QubitActorI18n::ID);
    $criteria->addAscendingOrderByColumn('authorized_form_of_name');
    $criteria->setDistinct();
    $criteria->setLimit(sfConfig::get('app_hits_per_page', 10));

    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitActor');

    $this->actors = QubitActor::get($criteria);
  }
}
