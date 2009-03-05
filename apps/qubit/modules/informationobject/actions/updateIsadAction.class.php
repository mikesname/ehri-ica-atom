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
 * Information Object - updateIsad
 *
 * @package    qubit
 * @subpackage informationObject - update an information object, including any Isad specific properties
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectUpdateIsadAction extends InformationObjectUpdateAction
{
  public function validate()
  {
    // If $_POST array is empty, then show error
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
      $this->editPage = array('module' => 'informationobject', 'action' => 'editIsad', 'id' => $id);
    }
    else
    {
      $this->editPage = array('module' => 'informationobject', 'action' => 'createIsad');
    }

    return sfView::ERROR;
  }

  public function execute($request)
  {
    // run the core informationObject update action commands
    parent::execute($request);

    // return to ISAD edit template
    if ($this->hasWarning)
    {
      // Set id parameter if this is a new information object
      if (!$request->getParameter('id'))
      {
        $request->setParameter('id', $this->informationObject->getId());
      }

      $this->forward('informationobject', 'editIsad');
    }
    else
    {

      return $this->redirect(array('module' => 'informationobject', 'action' => 'edit', 'informationobject_template' => 'isad', 'id' => $this->informationObject->getId()));
    }
  }
}