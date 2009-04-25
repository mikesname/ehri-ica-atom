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
    $this->context->getRouting()->setDefaultParameter('informationobject_template', 'rad');

    // run the core informationObject edit action commands
    parent::execute($request);

    // add RAD specific commands
    $this->radNotes = $this->informationObject->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_NOTE_ID));
    $this->radTitleNotes = $this->informationObject->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_TITLE_NOTE_ID));
    $this->radTitleNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_TITLE_NOTE_ID);
    $this->radNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_NOTE_ID);

    // Rad 1.1 properties
    $this->radOtherTitleInformation = $this->informationObject->getPropertyByName('other_title_information', array('scope'=>'rad'));
    $this->radTitleStatementOfResponsibility = $this->informationObject->getPropertyByName('title_statement_of_responsibility', array('scope'=>'rad'));

    // RAD 1.2 properties
    $this->radEditionStatementOfResponsibility = $this->informationObject->getPropertyByName('edition_statement_of_responsibility', array('scope'=>'rad'));

    // RAD 1.3 properties
    $this->radStatementOfScaleCartographic = $this->informationObject->getPropertyByName('statement_of_scale_cartographic', array('scope'=>'rad'));
    $this->radStatementOfProjection = $this->informationObject->getPropertyByName('statement_of_projection', array('scope'=>'rad'));
    $this->radStatementOfCoordinates = $this->informationObject->getPropertyByName('statement_of_coordinates', array('scope'=>'rad'));
    $this->radStatementOfScaleArchitectural = $this->informationObject->getPropertyByName('statement_of_scale_architectural', array('scope'=>'rad'));
    $this->radIssuingJursidictionAndDenomination = $this->informationObject->getPropertyByName('issuing_jursidiction_and_denomination', array('scope'=>'rad'));

    // RAD 1.6 properties
    $this->radTitleProperOfPublishersSeries = $this->informationObject->getPropertyByName('title_proper_of_publishers_series', array('scope'=>'rad'));
    $this->radParallelTitlesOfPublishersSeries = $this->informationObject->getPropertyByName('parallel_titles_of_publishers_series', array('scope'=>'rad'));
    $this->radOtherTitleInformationOfPublishersSeries = $this->informationObject->getPropertyByName('other_title_information_of_publishers_series', array('scope'=>'rad'));
    $this->radStatementOfResponsibilityRelatingToPublishersSeries = $this->informationObject->getPropertyByName('statement_of_responsibility_relating_to_publishers_series', array('scope'=>'rad'));
    $this->radNumberingWithinPublishersSeries = $this->informationObject->getPropertyByName('numbering_within_publishers_series', array('scope'=>'rad'));
    $this->radNoteOnPublishersSeries = $this->informationObject->getPropertyByName('note_on_publishers_series', array('scope'=>'rad'));

    // RAD 1.9 properties
    $this->radStandardNumber = $this->informationObject->getPropertyByName('standard_number', array('scope'=>'rad'));
  }

  protected function processForm()
  {
    parent::processForm();

    // update RAD notes
    if ($this->getRequestParameter('rad_title_note'))
    {
      $this->informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $this->getRequestParameter('rad_title_note'), 'noteTypeId' => $this->getRequestParameter('rad_title_note_type')));
    }

    if ($this->getRequestParameter('rad_note'))
    {
      $this->informationObject->setNote($options = array('userId' => $this->getUser()->getAttribute('user_id'), 'note' => $this->getRequestParameter('rad_note'), 'noteTypeId' => $this->getRequestParameter('rad_note_type')));
    }

    // Update RAD Properties
    $this->updateRadProperties();
  }

  protected function updateRadProperties()
  {
    // Rad 1.1 properties (do some conditional logic to set empty strings as null values in db)
    $newValue = (strlen($newValue = $this->getRequestParameter('rad_other_title_information'))) ? $newValue : null;
    $this->informationObject->saveProperty('other_title_information', $newValue, array('scope'=>'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_title_statement_of_responsibility'))) ? $newValue : null;
    $this->informationObject->saveProperty('title_statement_of_responsibility', $newValue, array('scope' => 'rad'));

    // Rad 1.2 properties
    $newValue = (strlen($newValue = $this->getRequestParameter('rad_edition_statement_of_responsibility'))) ? $newValue : null;
    $this->informationObject->saveProperty('edition_statement_of_responsibility', $newValue, array('scope' => 'rad'));

    // Rad 1.3 properties
    $newValue = (strlen($newValue = $this->getRequestParameter('rad_statement_of_scale_cartographic'))) ? $newValue : null;
    $this->informationObject->saveProperty('statement_of_scale_cartographic', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_statement_of_projection'))) ? $newValue : null;
    $this->informationObject->saveProperty('statement_of_projection', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_statement_of_coordinates'))) ? $newValue : null;
    $this->informationObject->saveProperty('statement_of_coordinates', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_statement_of_scale_architectural'))) ? $newValue : null;
    $this->informationObject->saveProperty('statement_of_scale_architectural', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_issuing_jursidiction_and_denomination'))) ? $newValue : null;
    $this->informationObject->saveProperty('issuing_jursidiction_and_denomination', $newValue, array('scope' => 'rad'));

    // Rad 1.6 properties
    $newValue = (strlen($newValue = $this->getRequestParameter('rad_title_proper_of_publishers_series'))) ? $newValue : null;
    $this->informationObject->saveProperty('title_proper_of_publishers_series', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_parallel_titles_of_publishers_series'))) ? $newValue : null;
    $this->informationObject->saveProperty('parallel_titles_of_publishers_series', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_other_title_information_of_publishers_series'))) ? $newValue : null;
    $this->informationObject->saveProperty('other_title_information_of_publishers_series', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_statement_of_responsibility_relating_to_publishers_series'))) ? $newValue : null;
    $this->informationObject->saveProperty('statement_of_responsibility_relating_to_publishers_series', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_numbering_within_publishers_series'))) ? $newValue : null;
    $this->informationObject->saveProperty('numbering_within_publishers_series', $newValue, array('scope' => 'rad'));

    $newValue = (strlen($newValue = $this->getRequestParameter('rad_note_on_publishers_series'))) ? $newValue : null;
    $this->informationObject->saveProperty('note_on_publishers_series', $newValue, array('scope' => 'rad'));

    // Rad 1.9 properties
    $newValue = (strlen($newValue = $this->getRequestParameter('rad_standard_number'))) ? $newValue : null;
    $this->informationObject->saveProperty('standard_number', $newValue, array('scope' => 'rad'));
  }
}
