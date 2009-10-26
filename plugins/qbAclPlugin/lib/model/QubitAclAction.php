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
 * Extend BaseAclAction functionality.
 *
 * @package    qubit
 * @subpackage acl
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class QubitAclAction extends BaseAclAction
{
  const CREATE_ID = 10;
  const READ_ID   = 11;
  const UPDATE_ID = 12;
  const DELETE_ID = 13;
  const VIEW_DRAFT_ID = 14;
  const PUBLISH_ID = 15;

  public function __toString()
  {
    return (string) $this->getName();
  }
}
