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
    $showContextMenu = false;
    $this->informationObject = $request->getAttribute('informationObject');
    $this->multiRepository = (sfConfig::get('app_multi_repository') == 0) ? false : true;

    // Get info object tree
    $this->informationObjects = null;

    if (isset($this->informationObject->id))
    {
      $ancestors = $this->informationObject->getAncestors()->andSelf()->orderBy('lft');
      foreach ($ancestors as $ancestor)
      {
        $path[] = $ancestor->getId();
      }
      $informationObjects = $this->buildInformationObjectTree($path);
      if (0 < count($informationObjects))
      {
        $this->informationObjects = $informationObjects;
        $showContextMenu = true;
      }
    }

    // Get repository for current object if system is multi-repository
    // (No point showing repository context if there is only one repository)
    $this->repository = null;

    $this->repositoryOptions = null;
    if ($this->multiRepository)
    {
      if (null === $repository = $this->informationObject->getRepository())
      {
        // Ascend up object hierarchy until a related repository is found
        foreach ($this->informationObject->getAncestors() as $ancestor)
        {
          if (null !== $repository = $ancestor->getRepository())
          {
            $repositoryOptions['title'] = __('Inherited from %ancestor%', array('%ancestor%' => $ancestor));
            $repositoryOptions['id'] = 'repositoryLink';
            $this->repositoryOptions = $repositoryOptions;
            break;
          }
        }
      }

      if (null !== $repository)
      {
        $this->repository = $repository;
        $showContextMenu = true;
      }
    }

    // Get Creators
    $this->creators = null;
    $this->creatorOptions = null;
    if (0 == count($creators = $this->informationObject->getCreators(array('cultureFallback' => true))))
    {
      foreach ($this->informationObject->getAncestors() as $ancestor)
      {
        if (0 < count($creators = $ancestor->getCreators(array('cultureFallback' => true))))
        {
          $creatorOptions['title'] = __('Inherited from %ancestor%', array('%ancestor%' => $ancestor));
          $creatorOptions['id'] = 'creatorsLink';
          $this->creatorOptions = $creatorOptions;
          break;
        }
      }
    }
    if (count($creators))
    {
      $this->creators = $creators;
      $showContextMenu = true;
    }

    // Get digital object thumbnails
    $this->thumbnails = null;
    $thumbnails = $this->informationObject->getDescendantThumbnails();
    if (count($thumbnails))
    {
      $this->thumbnails = $thumbnails;
      $showContextMenu = true;
    }

    // Get physical storage locations (only if user has edit privileges)
    $this->physicalObjects = null;
    if (QubitAcl::check($this->informationObject, QubitAclAction::UPDATE_ID))
    {
      $physicalObjects = array();
      $childInformationObjects = $this->informationObject->getDescendants()->andSelf();
      foreach ($childInformationObjects as $informationObject)
      {
        $relatedPhysicalObjects = QubitRelation::getRelatedSubjectsByObjectId('QubitPhysicalObject', $informationObject->getId(),
        array('typeId'=>QubitTerm::HAS_PHYSICAL_OBJECT_ID));

        foreach ($relatedPhysicalObjects as $physicalObject)
        {
          // Check to make sure this object is not already in the array
          if (!in_array($physicalObject, $physicalObjects))
          {
            $physicalObjects[] = $physicalObject;
          }
        }
      }

      if (count($physicalObjects))
      {
        $this->physicalObjects = $physicalObjects;
        $showContextMenu = true;
      }
    }

    // If no context items found, don't show context menu
    if (!$showContextMenu)
    {
      return sfView::NONE;
    }
  }

  protected function buildInformationObjectTree($path)
  {
    $tmp = array();
    $parent = QubitInformationObject::getById(array_shift($path));

    // skip the root node
    if (QubitInformationObject::ROOT_ID == $parent->id)
    {
      $tmp = array_merge($tmp, $this->buildInformationObjectTree($path));
    }
    else
    {
      $tmp[] = $parent;
      foreach ($parent->getChildren(array('sortBy' => sfConfig::get('app_sort_treeview_informationobject'))) as $child)
      {
        // If it in path, we go on building the tree in that way
        if (in_array($child->getId(), $path))
        {
          $tmp = array_merge($tmp, $this->buildInformationObjectTree($path));
        }
        else
        {
          // Add the child
          $tmp[] = $child;
        }
      }
    }

    return $tmp;
  }
}
