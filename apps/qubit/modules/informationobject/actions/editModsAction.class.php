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
 * Information Object - editMods
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editMods template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectEditModsAction extends InformationObjectEditAction
{
  public function execute($request)
  {
    $this->context->getRouting()->setDefaultParameter('informationobject_template', 'mods');

    // run the core informationObject edit action commands
    parent::execute($request);

    // add MODS specific commands
    $this->modsTypes = QubitMods::getTypes($this->informationObject);
  }

  protected function processForm()
  {
    parent::processForm();

    // $this->updateModsProperties();
    $this->updateModsTypes();
  }


  public function updateMODSProperties()
  {
  }

  protected function updateModsTypes()
  {
    if ($mods_type_ids = $this->getRequestParameter('mods_type_id'))
    {
      // Make sure that $dc_type_id is an array, even if it's only got one value
      $mods_type_ids = (is_array($mods_type_ids)) ? $mods_type_ids : array($mods_type_ids);

      foreach ($mods_type_ids as $mods_type_id)
      {
        if (intval($mods_type_id))
        {
          $this->informationObject->addTermRelation($mods_type_id, QubitTaxonomy::MODS_RESOURCE_TYPE_ID);
          $this->foreignKeyUpdate = true;
        }
      }
    }
  }

}