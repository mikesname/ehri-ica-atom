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

/**
 * Controller for editing actor information.
 * 
 * @package    qubit
 * @subpackage actor
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class ActorEditAction extends sfAction
{
  public function execute($request)
  {
    $this->actor = QubitActor::getById($this->getRequestParameter('id'));
    $this->forward404Unless($this->actor);

    //Other Forms of Name
    $this->otherNames = $this->actor->getOtherNames();
    $this->newName = new QubitActorName;

    //Properties
    $this->languageCodes = $this->actor->getProperties($name = 'language_of_actor_description');
    $this->scriptCodes = $this->actor->getProperties($name = 'script_of_actor_description');

    //Notes
    $this->notes = $this->actor->getActorNotes();
    $this->newNote = new QubitNote;

    //Event
    if ($this->actor->getDatesOfExistence())
    {
      $this->date = $this->actor->getDatesOfExistence();
    }
    else
    {
      $this->date = new QubitEvent;
    }

    if ($this->getRequestParameter('repositoryReroute'))
    {
      $this->repositoryReroute = $this->getRequestParameter('repositoryReroute');
    }
    else
    {
      $this->repositoryReroute = null;
    }

    if ($this->getRequestParameter('informationObjectReroute'))
    {
      $this->informationObjectReroute = $this->getRequestParameter('informationObjectReroute');
    }
    else
    {
      $this->informationObjectReroute = null;
    }
    
    // Add javascript libraries to allow multiple instance select boxes
    $this->getResponse()->addJavaScript('jquery');
    $this->getResponse()->addJavaScript('/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('multiInstanceSelect');

    //set view template
    switch ($this->getRequestParameter('template'))
    {
      case 'isaar' :
        $this->setTemplate('editISAAR');
        break;
      default :
        $this->setTemplate(sfConfig::get('app_default_template_actor_edit'));
        break;
    }
  }
}
