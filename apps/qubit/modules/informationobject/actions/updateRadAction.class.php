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

    // update informationObject in the search index
    if (!$this->foreignKeyUpdate)
    {
      SearchIndex::updateIndexDocument($this->informationObject, $this->getUser()->getCulture());
    }
    else
    {
      SearchIndex::updateTranslatedLanguages($this->informationObject);
    }

    // return to RAD edit template
    return $this->redirect(array('module' => 'informationobject', 'action' => 'edit', 'informationobject_template' => 'rad', 'id' => $this->informationObject->getId()));
  }

  protected function updateRadProperties($request)
  {
    // Rad 1.1 properties
    if ($newValue = $this->getRequestParameter('rad_other_title_information'))
    {
      $this->informationObject->saveProperty('other_title_information', $newValue, array('scope'=>'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_title_statement_of_responsibility'))
    {
      $this->informationObject->saveProperty('title_statement_of_responsibility', $newValue, array('scope' => 'rad'));
    }

    // Rad 1.2 properties
    if ($newValue = $this->getRequestParameter('rad_edition_statement_of_responsibility'))
    {
      $this->informationObject->saveProperty('edition_statement_of_responsibility', $newValue, array('scope' => 'rad'));
    }

    // Rad 1.3 properties
    if ($newValue = $this->getRequestParameter('rad_statement_of_scale_cartographic'))
    {
      $this->informationObject->saveProperty('statement_of_scale_cartographic', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_statement_of_projection'))
    {
      $this->informationObject->saveProperty('statement_of_projection', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_statement_of_coordinates'))
    {
      $this->informationObject->saveProperty('statement_of_coordinates', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_statement_of_scale_architectural'))
    {
      $this->informationObject->saveProperty('statement_of_scale_architectural', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_issuing_jursidiction_and_denomination'))
    {
      $this->informationObject->saveProperty('issuing_jursidiction_and_denomination', $newValue, array('scope' => 'rad'));
    }

    // Rad 1.6 properties
    if ($newValue = $this->getRequestParameter('rad_title_proper_of_publishers_series'))
    {
      $this->informationObject->saveProperty('title_proper_of_publishers_series', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_parallel_titles_of_publishers_series'))
    {
      $this->informationObject->saveProperty('parallel_titles_of_publishers_series', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_other_title_information_of_publishers_series'))
    {
      $this->informationObject->saveProperty('other_title_information_of_publishers_series', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_statement_of_responsibility_relating_to_publishers_series'))
    {
      $this->informationObject->saveProperty('statement_of_responsibility_relating_to_publishers_series', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_numbering_within_publishers_series'))
    {
      $this->informationObject->saveProperty('numbering_within_publishers_series', $newValue, array('scope' => 'rad'));
    }

    if ($newValue = $this->getRequestParameter('rad_note_on_publishers_series'))
    {
      $this->informationObject->saveProperty('note_on_publishers_series', $newValue, array('scope' => 'rad'));
    }

    // Rad 1.9 properties
    if ($newValue = $this->getRequestParameter('rad_standard_number'))
    {
      $this->informationObject->saveProperty('standard_number', $newValue, array('scope' => 'rad'));
    }

  }
}
