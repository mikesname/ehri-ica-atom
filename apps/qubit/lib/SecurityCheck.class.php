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

class SecurityCheck
{
  public static function hasPermission($sfUser, array $options = array())
  {
    $qubitUser = QubitUser::getById($sfUser->getUserId());
    if (!$qubitUser)
      {
        return false;
      }

    switch($options['module'])
      {
        case 'informationobject':
          if ($sfUser->hasCredential(array('administrator', 'editor', 'contributor'), false))
            {
              return true;
            }
          else
            {
              return false;
            }
        case 'actor':
          if ($sfUser->hasCredential(array('administrator', 'editor', 'contributor'), false))
            {
              return true;
            }
          else
            {
              return false;
            }
         case 'repository':
          if ($sfUser->hasCredential(array('administrator', 'editor', 'contributor'), false))
            {
              return true;
            }
          else
            {
              return false;
            }
         case 'term':
          if ($sfUser->hasCredential(array('administrator', 'editor'), false))
            {
              return true;
            }
          else
            {
              return false;
            }
         case 'staticpage':
          if ($sfUser->hasCredential(array('administrator', 'translator'), false))
            {
              return true;
            }
          else
            {
              return false;
            }
         case 'user':
          if ($sfUser->hasCredential(array('administrator'), false))
            {
              return true;
            }
          else if ($options['action'] == 'show')
            {
              return true;
            }
          else
            {
              return false;
            }
      }

  return false;
  }
}
