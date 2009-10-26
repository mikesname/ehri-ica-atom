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
 * Information Object - showIsad
 *
 * @package    qubit
 * @subpackage informationObject - initialize a showIsad template for displaying an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectShowIsadAction extends InformationObjectShowAction
{
  public function execute($request)
  {
    parent::execute($request);

    // Split notes into "Notes" (general notes), Title notes and Publication notes
    $this->notes = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::GENERAL_NOTE_ID));
    $this->archivistsNotes = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::ARCHIVIST_NOTE_ID));
    $this->publicationNotes = $this->informationObject->getNotesByType(array('noteTypeId' => QubitTerm::PUBLICATION_NOTE_ID));
  }
}
