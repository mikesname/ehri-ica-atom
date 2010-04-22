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
 * Context menu for information objects
 *
 * @package qubit
 * @subpackage information object
 * @version svn: $Id$
 * @author Peter Van Garderen <peter@artefactual.com>
 * @author David Juhasz <david@artefactual.com>
 */
class InformationObjectContextMenuComponent extends sfComponent
{
  public function execute($request)
  {
    $this->informationObject = $request->getAttribute('informationObject');

    // Get repository for current object if system is multi-repository
    // (No point showing repository context if there is only one repository)
    $this->repository = null;
    $this->repositoryOptions = array();
    if (sfConfig::get('app_multi_repository'))
    {
      if (null === $repository = $this->informationObject->getRepository())
      {
        // Ascend up object hierarchy until a related repository is found
        foreach ($this->informationObject->getAncestors() as $ancestor)
        {
          if (null !== $repository = $ancestor->getRepository())
          {
            $repositoryOptions['title'] = __('Inherited from %ancestor%', array('%ancestor%' => $ancestor));
            $this->repositoryOptions = $repositoryOptions;
            break;
          }
        }
      }

      if (null !== $repository)
      {
        $this->repository = $repository;
      }
    }

    // Get Creators
    $this->creators = array();
    $this->creatorOptions = array();
    if (0 == count($creators = $this->informationObject->getCreators(array('cultureFallback' => true))))
    {
      foreach ($this->informationObject->getAncestors() as $ancestor)
      {
        if (0 < count($creators = $ancestor->getCreators(array('cultureFallback' => true))))
        {
          $creatorOptions['title'] = __('Inherited from %ancestor%', array('%ancestor%' => $ancestor));
          $this->creatorOptions = $creatorOptions;
          break;
        }
      }
    }
    if (count($creators))
    {
      $this->creators = $creators;
    }
  }
}
