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
 * Form for adding and editing related events
 *
 * @package    qubit
 * @subpackage information object
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com> 
 */
class InformationObjectEventFormComponent extends sfComponent
{
  public function execute($request)
  {
    $this->informationObject = $request->getAttribute('informationObject');
    if ($request->getParameter('module') == 'sfDcPlugin')
    {
      // restrict to the Dublin Core event types (creation, publication, contribution)
      $this->eventTypes = QubitTerm::getDcEventTypeList();
    }
    else
    {
      $this->eventTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::EVENT_TYPE_ID);
    }
    $this->defaultEventType = QubitTerm::CREATION_ID;
    $this->eventPlaces = QubitTerm::getOptionsForSelectList(QubitTaxonomy::PLACE_ID, $options = array('include_blank' => true));
  }
}

