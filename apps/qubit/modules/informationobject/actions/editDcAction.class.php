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
 * Information Object - editDc
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editDc template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectEditDcAction extends InformationObjectEditAction
{
  public function execute($request)
  {
    $this->context->getRouting()->setDefaultParameter('informationobject_template', 'dc');

    // run the core informationObject edit action commands
    parent::execute($request);

    // add Dublin Core specific commands
    $this->dcEventTypes = QubitTerm::getDcEventTypeList();
    $this->dcRelation = $this->informationObject->getPropertyByName('information_object_relation', array('scope'=>'dc'));
    $this->dcTypes = QubitDc::getDcTypes($this->informationObject);
  }

  protected function processForm()
  {
    parent::processForm();

    // Update Dc Properties
    $this->updateDcProperties();
    $this->updateDcTypes();
  }

  protected function updateDcProperties()
  {
    $this->informationObject->saveProperty('information_object_relation', $this->getRequestParameter('dc_relation'), array('scope'=>'dc'));
  }

  protected function updateDcTypes()
  {
    if ($dc_type_ids = $this->getRequestParameter('dc_type_id'))
    {
      // Make sure that $dc_type_id is an array, even if it's only got one value
      $dc_type_ids = (is_array($dc_type_ids)) ? $dc_type_ids : array($dc_type_ids);

      foreach ($dc_type_ids as $dc_type_id)
      {
        if (intval($dc_type_id))
        {
          $this->informationObject->addTermRelation($dc_type_id, QubitTaxonomy::DC_TYPE_ID);
          $this->foreignKeyUpdate = true;
        }
      }
    }
  }

}
