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
 * Custom ACL for QubitInformationObject resources
 *
 * @package    qbAclPlugin
 * @subpackage acl
 * @author     David Juhasz <david@artefactual.com>
 * @version    svn:$Id$
 */
class QubitInformationObjectAcl extends QubitAcl
{
  // Add viewDraft and publish actions to list
  public static $ACTIONS = array(
    'read' => 'Read',
    'create' => 'Create',
    'update' => 'Update',
    'delete' => 'Delete',
    'translate' => 'Translate',
    'viewDraft' => 'View draft',
    'publish' => 'Publish',
    'readMaster' => 'Access master',
    'readReference' => 'Access reference',
  );

  public static function getParentForIsAllowed($resource, $action)
  {
    // If trying to publish a new info object, check permissions against parent
    if ('publish' == $action)
    {
      return $resource->parent;
    }
  }
}
