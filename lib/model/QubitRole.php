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
 * Extend BaseRole functionality.
 *
 * @package    qubit
 * @subpackage model
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 */

class QubitRole extends BaseRole
{
  const ADMINISTRATOR_ID = 100;
  const EDITOR_ID = 101;
  const CONTRIBUTOR_ID = 102;
  const TRANSLATOR_ID = 103;

  public function __toString()
  {
    return (string) $this->getName();
  }
}
