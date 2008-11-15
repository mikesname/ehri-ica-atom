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

class ActorDeletePropertyAction extends sfAction
{
  public function execute($request)
  {
    $this->deleteProperty = QubitProperty::getById($this->getRequestParameter('Id'));
    $this->forward404Unless($this->deleteProperty);
    $this->actorId = $this->deleteProperty->getObjectId();

    $this->deleteProperty->delete();

    if ($this->getRequestParameter('next'))
    {
      // Make the $next parameter into an absolute URL because redirect() expects
      // an absolute URL or an array containing module and action
      // (Pre-pend code copied from sfWebController->genUrl() method)
      $next = 'http'.($request->isSecure() ? 's' : '').'://'.$request->getHost().$this->getRequestParameter('next');
      return $this->redirect($next);
    }
    else
    {
      if (strlen($template = $this->getRequestParameter('returnTemplate')) > 0)
      {
        return $this->redirect(array('module' => 'actor', 'action' => 'edit', 'actor_template' => $template, 'id' => $this->actorId));
      }
      else
      {
        return $this->redirect(array('module' => 'actor', 'action' => 'edit', 'id' => $this->actorId));
      }
    }
  }
}
