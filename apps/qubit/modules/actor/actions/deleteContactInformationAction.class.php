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

class ActorDeleteContactInformationAction extends sfAction
{
  public function execute($request)
  {
  $this->deleteContactInformation = QubitContactInformation::getById($this->getRequestParameter('contactInformationId'));

  $this->forward404Unless($this->deleteContactInformation);

  $this->actorId = $this->deleteContactInformation->getActorId();

  $this->deleteContactInformation->delete();

  //TODO: check to see if this delete call is made from within the Actor module and redirect accordingly
  //right now contact information is only created and deleted via the repository module
  if (strlen($template = $this->getRequestParameter('returnTemplate')) > 0)
    {
      return $this->redirect(array('module' => 'repository', 'action' => 'edit', 'repository_template' => $template, 'id' => $this->actorId));
    }
  else
    {
      return $this->redirect(array('module' => 'repository', 'action' => 'edit', 'id' => $this->actorId));
    }
  }
}
