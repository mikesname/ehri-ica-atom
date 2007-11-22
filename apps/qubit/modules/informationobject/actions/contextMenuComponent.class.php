<?php

/*
 * This file is part of the Qubit Toolkit.
 *
 * For the full copyright and license information, please view the COPYRIGHT
 * and LICENSE files that were distributed with this source code.
 *
 * Copyright (C) 2006-2007 Peter Van Garderen <peter@artefactual.com>
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this library; if not, write to the Free Software Foundation,
 * Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class contextMenuComponent extends sfComponent
{

  public function execute()
  {
    $this->informationObject = InformationObjectPeer::retrieveByPk($this->getRequestParameter('id'));
    if (!isset($this->informationObject))
    {
      return sfView::NONE;
    }

  $this->repositoryLink = $this->informationObject->getRepositoryLink();


  $this->creators = array();
  $this->creators = null;

  if ($this->informationObject->getCreators())
    {
    $this->creators = $this->informationObject->getCreators();
    }
  else
    {
    if ($this->informationObject->getTreeId())
      {
      foreach ($this->informationObject->getPath() as $ancestorNode)
        {
        if ($ancestorNode->getCreators())
          {
          $this->creators = $ancestorNode->getCreators();
          break;
          }
        }
       }
    }

  /*********************************************************/

  if ($this->informationObject->getTreeId())
    {
    //create collection tree

    $c = new Criteria();
    $c->add(InformationObjectPeer::TREE_ID, $this->informationObject->getTreeId());
    $c->addAscendingOrderByColumn(InformationObjectPeer::TREE_LEFT_ID);
    $tree = InformationObjectPeer::doSelect($c);

    $collection = array();
    $collection[null] = '';

    $rootURL = $this->getRequest()->getRelativeUrlRoot();
    $currentNodeId = $this->informationObject->getId();
    $currentNodeLevel = $this->informationObject->getLevel();
    $currentNodeParentId = $this->informationObject->getTreeParentId();
    $currentNodePath = $this->informationObject->getPath();

    foreach ($tree as $node)
      {
      $nodeId = $node->getId();
      if ($nodeId == $currentNodeId)
        {
        $nodeClass = 'currentNode';
        }
      else
        {
        $nodeClass = 'node';
        }
      //determine visibility of node
      if (($node->getLevel() >= $currentNodeLevel) and ($node->getTreeParentId() != $currentNodeParentId))
        {
        if ($node->getTreeParentId() == $currentNodeId)
          {
          $nodeDisplay = 'block';
          }
        else
          {
          $nodeDisplay = 'none';
          }
        }
      else
        {
        $nodeDisplay = 'block';
        }

      //determine node toggle (plus/minus)
      if ($node->hasChildren())
        {
        $nodeToggle = '<div class="plus">';
        }
      else
        {
        $nodeToggle = '<div class="minus">';
        }

      $nodeFormat = '<div style="display:'.$nodeDisplay.'; margin-left:'.$node->getHierarchyIndent().'px;" class="'.$nodeClass.'">';

      $nodeContent =  $node->getLabel();

      $collection[$nodeId] = $nodeFormat.$nodeToggle.'<a href="'.$rootURL.'/informationobject/show/id/'.$nodeId.'">'.$nodeContent.'</a></div></div>';
      }

   $this->collection = $collection;
   }

  }

}
