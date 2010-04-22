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

class ActorDeleteOtherNameAction extends sfAction
{
  public function execute($request)
  {
    $this->deleteOtherName = QubitOtherName::getById($this->getRequestParameter('otherNameId'));
    $this->forward404Unless($this->deleteOtherName);
    $this->actorId = $this->deleteOtherName->getObjectId();

    // Do delete
    $this->deleteOtherName->delete();

    if ($this->getRequestParameter('next'))
    {
      // Make the $next parameter into an absolute URL because redirect() expects
      // an absolute URL or an array containing module and action
      // (Pre-pend code copied from sfWebController->genUrl() method)
      $next = 'http'.($request->isSecure() ? 's' : '').'://'.$request->getHost().$this->getRequestParameter('next');

      $this->redirect($next);
    }
    else
    {
      if (strlen($template = $this->getRequestParameter('returnTemplate')) > 0)
      {
        $this->redirect(array('module' => 'actor', 'action' => 'edit', 'actor_template' => $template, 'id' => $this->actorId));
      }
      else
      {
        $this->redirect(array('module' => 'actor', 'action' => 'edit', 'id' => $this->actorId));
      }
    }
  }
}
