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
 * Repository - editIsdiah
 *
 * @package    qubit
 * @subpackage Actor - initialize an editIDIAH template for updating a repository
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class RepositoryEditIsdiahAction extends RepositoryEditAction
{
  public function execute($request)
  {
    // run the core repository edit action commands
    parent::execute($request);

    $this->parallelFormsOfName = $this->repository->getParallelFormsOfName();
    $this->otherFormsOfName = $this->repository->getOtherFormsOfName();
  }

  protected function processForm()
  {
    parent::processForm();

    // Do updates
    $this->updateActorNames();
    $this->deleteActorNames();
  }

  /**
   * Update ISDIAH actor names
   *
   * @param sfWebRequest $request
   */
  private function updateActorNames()
  {
    foreach ((array) $this->getRequestParameter('parallel_form_of_name') as $parallelFormOfName)
    {
      if (strlen($parallelFormOfName) > 0)
      {
        $this->repository->setOtherNames($parallelFormOfName, QubitTerm::PARALLEL_FORM_OF_NAME_ID, null);
      }
    }

    foreach ((array) $this->getRequestParameter('other_form_of_name') as $otherFormOfName)
    {
      if (strlen($otherFormOfName) > 0)
      {
        $this->repository->setOtherNames($otherFormOfName, QubitTerm::OTHER_FORM_OF_NAME_ID, null);
      }
    }
  }

  /**
   * Delete ISDIAH actor names
   *
   * @param sfWebRequest $request
   */
  private function deleteActorNames()
  {
    if ($this->request->hasParameter('delete_parallel_names'))
    {
      foreach ((array) $this->request->getParameter('delete_parallel_names') as $id => $val)
      {
        QubitActorName::deleteById($id);
      }
    }

    if ($this->request->hasParameter('delete_other_names'))
    {
      foreach ((array) $this->request->getParameter('delete_other_names') as $id => $val)
      {
        QubitActorName::deleteById($id);
      }
    }
  }

}
