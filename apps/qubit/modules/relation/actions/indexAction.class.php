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
    $this->resource = $this->getRoute()->resource;

    $value = array();

    $note = $this->resource->getNoteByTypeId(QubitTerm::RELATION_NOTE_DATE_ID);
    if (isset($note))
    {
      $value['date'] = $note->content;
    }

    $value['endDate'] = Qubit::renderDate($this->resource->endDate);
    $value['startDate'] = Qubit::renderDate($this->resource->startDate);

    $note = $this->resource->getNoteByTypeId(QubitTerm::RELATION_NOTE_DESCRIPTION_ID);
    if (isset($note))
    {
      $value['description'] = $note->content;
    }

    if (isset($this->resource->object))
    {
      $value['object'] = $this->context->routing->generate(null, array($this->resource->object));
    }

    if (isset($this->resource->subject))
    {
      $value['subject'] = $this->context->routing->generate(null, array($this->resource->subject));
    }

    if (isset($this->resource->type))
    {
      $value['type'] = $this->context->routing->generate(null, array($this->resource->type, 'module' => 'term'));
    }

    return $this->renderText(json_encode($value));
  }
}
