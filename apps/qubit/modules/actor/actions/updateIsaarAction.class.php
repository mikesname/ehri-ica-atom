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
 * Actor - updateIsaar
 *
 * @package    qubit
 * @subpackage actor - update an actor, including any ISAAR specific properties
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class ActorUpdateIsaarAction extends ActorUpdateAction
{
  public function execute($request)
  {
    // run the core actpr update action commands
    parent::execute($request);

    // add ISAAR specific commands

    // update the search index for those informationObjects that are linked to this Actor
    if (count($informationObjectRelations = $this->actor->getInformationObjectRelations()) > 0)
    {
      foreach ($informationObjectRelations as $event)
      {
        SearchIndex::updateTranslatedLanguages($event->getInformationObject());
      }
    }

    return $this->redirect(array('module' => 'actor', 'action' => 'edit', 'actor_template' => 'isaar', 'id' => $this->actor->getId()));
  }
}
