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

class QubitAclPermission extends BaseAclPermission
{
  public function check($userId, $objectId, $actionId, $parameters = array())
  {
    $user = QubitUser::getById($userId);

    if (
      ($userId == $this->userId || $user->hasGroup($this->groupId)) &&
      $objectId == $this->objectId &&
      $actionId == $this->actionId &&
      $this->evaluateConditional($parameters))
    {
      return $this->grantDeny;
    }
  }

  public function setRepository($repository)
  {
    if ($repository instanceof QubitRepository)
    {
      $this->conditional = '%p[repositoryId] == %k[repositoryId]';
      $this->constants = serialize(array('repositoryId' => $repository->id));
    }
    else if (null === $repository)
    {
      $this->conditional = null;
      $this->constants = null;
    }

    return $this;
  }

  public function getRepository()
  {
    $repositoryId = null;
    $constants = unserialize($this->constants);

    if (isset($constants['repositoryId']))
    {
      $repositoryId = $constants['repositoryId'];
    }

    return QubitRepository::getById($repositoryId);
  }

  public function evaluateConditional($parameters)
  {
    // If no conditional specified, than always return true
    if (0 == strlen($conditional = $this->conditional))
    {

      return true;
    }

    $constants = unserialize($this->constants);

    // Substitute constants
    if (preg_match_all('/%k\[(\w+)\]/', $conditional, $matches))
    {
      foreach ($matches[1] as $match)
      {
        if (isset($constants[$match]))
        {
          $conditional = str_replace('%k['.$match.']', '\''.$constants[$match].'\'', $conditional);
        }
      }
    }

    // Substitute parameters
    if (preg_match_all('/%p\[(\w+)\]/', $conditional, $matches))
    {
      foreach ($matches[1] as $key)
      {
        if (array_key_exists($key, $parameters))
        {
          // A 'null' parameter matches *any* constant
          if (null === $parameters[$key])
          {
            $conditional = str_replace('%p['.$key.']', 'true', $conditional);
            $conditional = str_replace('%k['.$key.']', 'true', $conditional);
          }
          else
          {
            $conditional = str_replace('%p['.$key.']', '\''.$parameters[$key].'\'', $conditional);
          }
        }
        else
        {
          $conditional = str_replace('%p['.$key.']', '\'0\'', $conditional);
        }
      }
    }

    // evaluate conditional
    return eval('return ('.$conditional.');');
  }

  public function debug($parameters)
  {
    $debug  = 'permission_'.$this->id.'( ';
    $debug .= 'userId: '.$this->userId.', ';
    $debug .= 'groupId: '.$this->groupId.', ';
    $debug .= 'objectId: '.$this->objectId.', ';
    $debug .= 'actionId: '.$this->actionId.', ';
    $debug .= 'grantDeny: '.$this->grantDeny.' )';
    $debug .= "<br />\n";
    echo $debug;

    //var_dump($parameters);
  }
}
