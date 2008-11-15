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
 * Information Object - editRad
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editRad template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class InformationObjectEditRadAction extends InformationObjectEditAction
{
  public function execute($request)
  {
    // run the core informationObject edit action commands
    parent::execute($request);

    $infoObject = $this->informationObject;

    // add RAD specific commands
    $this->radNotes = $this->informationObject->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_NOTE_ID));
    $this->radTitleNotes = $this->informationObject->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_TITLE_NOTE_ID));
    $this->radTitleNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_TITLE_NOTE_ID);
    $this->radNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_NOTE_ID);

    // Rad 1.1 properties
    $this->radOtherTitleInformation = $infoObject->getPropertyByName('other_title_information', array('scope'=>'rad'));
    $this->radTitleStatementOfResponsibility = $infoObject->getPropertyByName('title_statement_of_responsibility', array('scope'=>'rad'));

    // RAD 1.2 properties
    $this->radEditionStatementOfResponsibility = $infoObject->getPropertyByName('edition_statement_of_responsibility', array('scope'=>'rad'));

    // RAD 1.3 properties
    $this->radStatementOfScaleCartographic = $infoObject->getPropertyByName('statement_of_scale_cartographic', array('scope'=>'rad'));
    $this->radStatementOfProjection = $infoObject->getPropertyByName('statement_of_projection', array('scope'=>'rad'));
    $this->radStatementOfCoordinates = $infoObject->getPropertyByName('statement_of_coordinates', array('scope'=>'rad'));
    $this->radStatementOfScaleArchitectural = $infoObject->getPropertyByName('statement_of_scale_architectural', array('scope'=>'rad'));
    $this->radIssuingJursidictionAndDenomination = $infoObject->getPropertyByName('issuing_jursidiction_and_denomination', array('scope'=>'rad'));

    // RAD 1.6 properties
    $this->radTitleProperOfPublishersSeries = $infoObject->getPropertyByName('title_proper_of_publishers_series', array('scope'=>'rad'));
    $this->radParallelTitlesOfPublishersSeries = $infoObject->getPropertyByName('parallel_titles_of_publishers_series', array('scope'=>'rad'));
    $this->radOtherTitleInformationOfPublishersSeries = $infoObject->getPropertyByName('other_title_information_of_publishers_series', array('scope'=>'rad'));
    $this->radStatementOfResponsibilityRelatingToPublishersSeries = $infoObject->getPropertyByName('statement_of_responsibility_relating_to_publishers_series', array('scope'=>'rad'));
    $this->radNumberingWithinPublishersSeries = $infoObject->getPropertyByName('numbering_within_publishers_series', array('scope'=>'rad'));
    $this->radNoteOnPublishersSeries = $infoObject->getPropertyByName('note_on_publishers_series', array('scope'=>'rad'));

    // RAD 1.9 properties
    $this->radStandardNumber = $infoObject->getPropertyByName('standard_number', array('scope'=>'rad'));

    // overwrite the default edit template
    $this->setTemplate('editRad');
  }
}
