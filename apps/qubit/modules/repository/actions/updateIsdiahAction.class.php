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
 * Repository - updateIsdiah
 *
 * @package    qubit
 * @subpackage Repository - update a repository, including any ISDIAH specific properties
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class RepositoryUpdateIsdiahAction extends RepositoryUpdateAction
{
  public function execute($request)
  {
    // run the core repository update action commands
    parent::execute($request);

    // return to ISDIAH edit template
    return $this->redirect(array('module' => 'repository', 'action' => 'edit', 'repository_template' => 'isdiah', 'id' => $this->repository->getId()));
  }
}
