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
 * Information Object - showRad
 *
 * @package    qubit
 * @subpackage informationObject - initialize a showRad template for displaying an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectShowRadAction extends InformationObjectShowAction
{
  public function execute($request)
  {
    $this->context->getRouting()->setDefaultParameter('informationobject_template', 'rad');

    // run the core informationObject show action commands
    parent::execute($request);

    // add RAD specific commands
    $this->radNotes = $this->informationObject->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_NOTE_ID));
    $this->radTitleNotes = $this->informationObject->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_TITLE_NOTE_ID));

    $infoObject = $this->informationObject;

    // Rad 1.1 properties
    $this->radOtherTitleInformation = $infoObject->getPropertyByName('other_title_information', array('scope'=>'rad', 'cultureFallback'));
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

  }
}
