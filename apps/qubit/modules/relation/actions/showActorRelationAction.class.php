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

/**
 * Display relevant data for specified relation
 *
 * @package qubit
 * @subpackage relation
 * @version    svn:$Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class RelationShowActorRelationAction extends sfAction
{
  public function execute($request)
  {
    sfLoader::loadHelpers('Qubit');

    $relation = QubitRelation::getById($request->id);

    if (!isset($relation))
    {
      $this->forward404();
    }

    $columns = array();
    $columns['id'] = $relation->id;

    // Get reciprocal actor based on fromActor (may be subject or object)
    $columns['actorName'] = null;
    if ($request->fromActorId == $relation->objectId)
    {
      if (null !== ($toActor = $relation->getSubject()))
      {
        $columns['actorName'] = $toActor->authorizedFormOfName;
      }
    }
    else if ($request->fromActorId == $relation->subjectId)
    {
      if (null !== ($toActor = $relation->getObject()))
      {
        $columns['actorName'] = $toActor->authorizedFormOfName;
      }
    }

    $columns['objectId'] = $relation->objectId;
    $columns['subjectId'] = $relation->subjectId;
    $columns['typeId'] = $relation->typeId;
    $columns['startDate'] = collapse_date($relation->startDate);
    $columns['endDate'] = collapse_date($relation->endDate);

    $columns['dateDisplay'] = null;
    if (null !== ($displayNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID)))
    {
      $columns['dateDisplay'] = $displayNote->getContent();
    }

    $columns['description'] = null;
    if (null !== ($descriptionNote = $relation->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID)))
    {
      $columns['description'] = $descriptionNote->getContent();
    }

    return $this->renderText(json_encode($columns));
  }
}
