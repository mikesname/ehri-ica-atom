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
 * Information Object - updateDc
 *
 * @package    qubit
 * @subpackage informationObject - update an information object, including any Dc specific properties
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectUpdateDcAction extends InformationObjectUpdateAction
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
      $this->editPage = array('module' => 'informationobject', 'action' => 'editDc', 'id' => $id);
    }
    else
    {
      $this->editPage = array('module' => 'informationobject', 'action' => 'createDc');
    }

    return sfView::ERROR;
  }

  public function execute($request)
  {
    // Redirect parameters
    $redirectParams = array('module' => 'informationobject', 'action' => 'edit', 'informationobject_template' => 'dc');

    // If $_POST array is empty, then display an error
    if ($_POST === array())
    {
      if ($id = $request->getParameter('id'))
      {
        $redirectParams['id'] = $id;
      }
      $redirectParams['error'] = 'no_form_data';
    }

    // Else, do update
    else
    {
      // run the core informationObject update action commands
      parent::execute($request);

      // Update Dc Properties
      $this->updateDcProperties($request);

      // Set id
      if ($id = $this->informationObject->getId())
      {
        $redirectParams['id'] = $id;
      }
    }

    // If no valid info object id, then show create template
    if ($id === null)
    {
      $redirectParams['action'] = 'create';
    }

    // return to DC edit template
    return $this->redirect($redirectParams);
  }

  protected function updateDcProperties($request)
  {
    $this->informationObject->saveProperty('information_object_relation', $this->getRequestParameter('dc_relation'), array('scope'=>'dc'));
  }
}