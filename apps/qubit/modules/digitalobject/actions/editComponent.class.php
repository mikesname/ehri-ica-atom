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
 * Digital Object edit component
 *
 * @package    qubit
 * @subpackage digital object
 * @author     david juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class DigitalObjectEditComponent extends sfComponent
{
  public function execute($request)
  {
    // Get 'show as compound digital object' toggle value
    $compoundDigitalObject = QubitProperty::getOneByObjectIdAndName($this->informationObject->getId(), 'display_as_compound_object');
    if (!is_null($compoundDigitalObject))
    {
      $this->isCompoundDigitalObject = ($compoundDigitalObject->getValue(array('sourceCulture' => true))) ? true : false;
    }
    else
    {
      $this->isCompoundDigitalObject = false;
    }

    // Only display 'compound digital object' toggle if we have a child with a
    // digital object
    $this->showCompoundObjectToggle = false;
    foreach ($this->informationObject->getChildren() as $child)
    {
      if (null !== $child->getDigitalObject())
      {
        $this->showCompoundObjectToggle = true;
        break;
      }
    }

    // Get related digital object with all representations
    $this->digitalObject = $this->informationObject->getDigitalObject();
    if (count($this->digitalObject))
    {
      $representations[QubitTerm::MASTER_ID] = $this->digitalObject;
      $representations[QubitTerm::REFERENCE_ID] = $this->digitalObject->getChildByUsageId(QubitTerm::REFERENCE_ID);
      $representations[QubitTerm::THUMBNAIL_ID] = $this->digitalObject->getChildByUsageId(QubitTerm::THUMBNAIL_ID);
      $this->representations = $representations;
    }
  }
}