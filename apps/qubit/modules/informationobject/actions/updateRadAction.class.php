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
 * Information Object - updateRad
 *
 * @package    qubit
 * @subpackage informationObject - update an information object, including any Rad specific properties
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class InformationObjectUpdateRadAction extends InformationObjectUpdateAction
{
  public function validate()
  {
    // If $_POST array is empty, then display an error
    if ($_POST === array())
    {
      $this->getRequest()->setError('form', 'no_form_data');

      return false;
    }

    return true;
  }

  public function handleError()
  {
    if ($id = $this->getRequestParameter('id'))
    {
      $this->editPage = array('module' => 'informationobject', 'action' => 'editRad', 'id' => $id);
    }
    else
    {
      $this->editPage = array('module' => 'informationobject', 'action' => 'createRad');
    }

    return sfView::ERROR;
  }

  public function execute($request)
  {
    // run the core informationObject update action commands
    parent::execute($request);

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
    $this->updateRadProperties($request);

    // return to RAD edit template
    if ($this->hasWarning)
    {
      // Set id parameter if this is a new information object
      if (!$request->getParameter('id'))
      {
        $request->setParameter('id', $this->informationObject->getId());
      }

      $this->forward('informationobject', 'editRad');
    }
    else
    {

      return $this->redirect(array('module' => 'informationobject', 'action' => 'edit', 'informationobject_template' => 'rad', 'id' => $this->informationObject->getId()));
    }
  }

  protected function updateRadProperties($request)
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
