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

class ActorIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->actor = QubitActor::getById($request->id);

    // Check that object exists and that it's not the root
    if (!isset($this->actor) || !isset($this->actor->parent))
    {
      $this->forward404();
    }

    // Check user authorization
    if (!QubitAcl::check($this->actor, 'read'))
    {
      QubitAcl::forwardUnauthorized();
    }

    $this->maintenanceNote = null;
    if (0 < count($maintenanceNotes = $this->actor->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID))))
    {
      $this->maintenanceNote = $maintenanceNotes[0];
    }

    $criteria = new Criteria;
    $criteria->add(QubitRelation::OBJECT_ID, $this->actor->id);
    $criteria->addJoin(QubitRelation::SUBJECT_ID, QubitFunction::ID);

    $this->functions = QubitFunction::get($criteria);
  }
}
