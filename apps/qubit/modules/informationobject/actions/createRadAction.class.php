<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/**
 * Information Object - createRad
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editRad template for the creation of a new information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectCreateRadAction extends InformationObjectCreateAction
{
  public function execute($request)
  {
    // run the core informationObject create action commands
    parent::execute($request);

    // add RAD specific commands
    $this->radNotes = null;
    $this->radTitleNotes = null;
    $this->radTitleNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_TITLE_NOTE_ID);
    $this->radNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_NOTE_ID);

    // Rad 1.1 properties
    $this->radOtherTitleInformation = new QubitProperty;
    $this->radTitleStatementOfResponsibility = new QubitProperty;

    // RAD 1.2 properties
    $this->radEditionStatementOfResponsibility = new QubitProperty;

    // RAD 1.3 properties
    $this->radStatementOfScaleCartographic = new QubitProperty;
    $this->radStatementOfProjection = new QubitProperty;
    $this->radStatementOfCoordinates = new QubitProperty;
    $this->radStatementOfScaleArchitectural = new QubitProperty;
    $this->radIssuingJursidictionAndDenomination = new QubitProperty;

    // RAD 1.6 properties
    $this->radTitleProperOfPublishersSeries = new QubitProperty;
    $this->radParallelTitlesOfPublishersSeries = new QubitProperty;
    $this->radOtherTitleInformationOfPublishersSeries = new QubitProperty;
    $this->radStatementOfResponsibilityRelatingToPublishersSeries = new QubitProperty;
    $this->radNumberingWithinPublishersSeries = new QubitProperty;
    $this->radNoteOnPublishersSeries = new QubitProperty;

    // RAD 1.9 properties
    $this->radStandardNumber = new QubitProperty;

    // route to the edit template
    $this->setTemplate('editRad');
  }
}