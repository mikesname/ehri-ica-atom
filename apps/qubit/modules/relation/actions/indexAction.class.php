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
 * Get JSON representation of relation
 *
 * @package qubit
 * @subpackage relation
 * @version    svn:$Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class RelationIndexAction extends sfAction
{
  public function execute($request)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Qubit');

    $relation = QubitRelation::getById($request->id);

    if (!isset($relation))
    {
      $this->forward404();
    }

    $columns = array();
    $columns['id'] = $relation->id;
    $columns['object'] = $this->getUri($relation->object);
    $columns['subject'] = $this->getUri($relation->subject);
    $columns['type'] = $this->getUri($relation->type);
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

  protected function getUri($object)
  {
    if (null != $object)
    {
      $moduleName = strtolower(str_replace('Qubit', '', get_class($object)));

      return $this->context->routing->generate(null, array($object, 'module' => $moduleName));
    }
  }
}
