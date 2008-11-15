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

class InformationObjectTreeViewComponent extends sfComponent
{
  public function execute($request)
  {
    $this->informationObject = $request->getAttribute('informationObject');

    if (count($this->informationObjects) < 1)
    {
      return sfView::NONE;
    }

    $this->getResponse()->addJavaScript('jquery');
    $this->getResponse()->addJavaScript('/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('qubit');
    $this->getResponse()->addJavaScript('/vendor/yui/yahoo-dom-event/yahoo-dom-event');
    $this->getResponse()->addJavaScript('/vendor/yui/treeview/treeview-min');
    $this->getResponse()->addJavaScript('treeView');
    $this->getResponse()->addStylesheet('yui/treeview/assets/skins/qubit/treeview-skin');

    $this->treeViewObjects = array();
    foreach ($this->informationObjects->orderBy('lft') as $informationObject)
    {
      $treeViewObject = array();
      $treeViewObject['label'] = (string) $informationObject->getLabel(array('truncate' => 50));
      $treeViewObject['href'] = $this->getController()->genUrl('informationobject/show?id='.$informationObject->getId());
      $treeViewObject['id'] = $informationObject->getId();
      $treeViewObject['parentId'] = $informationObject->getParentId();

      // TODO: Should be able to check equality of objects
      if ($informationObject->getId() == $this->informationObject->getId())
      {
        $treeViewObject['style'] = 'ygtvlabel currentTextNode';
      }

      $this->treeViewObjects[] = $treeViewObject;
    }

    $this->treeViewExpands = array();
    foreach ($this->informationObject->getAncestors() as $ancestor)
    {
      $this->treeViewExpands[$id = $ancestor->getId()] = $id;
    }
    $this->treeViewExpands[$id = $this->informationObject->getId()] = $id;
  }
}
