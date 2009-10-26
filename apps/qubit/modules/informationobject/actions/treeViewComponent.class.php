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

class InformationObjectTreeViewComponent extends sfComponent
{
  public function execute($request)
  {
    $this->informationObject = $request->getAttribute('informationObject');

    if (count($this->informationObjects) < 1)
    {
      return sfView::NONE;
    }

    $this->getResponse()->addJavaScript('/vendor/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('qubit');
    $this->getResponse()->addJavaScript('/vendor/yui/yahoo-dom-event/yahoo-dom-event');
    $this->getResponse()->addJavaScript('/vendor/yui/treeview/treeview-min');
    $this->getResponse()->addJavaScript('/vendor/yui/dragdrop/dragdrop-min');
    $this->getResponse()->addJavaScript('treeView');
    $this->getResponse()->addStylesheet('yui/treeview/assets/skins/qubit/treeview-skin', 'first');

    $this->treeViewObjects = array();
    foreach ($this->informationObjects as $informationObject)
    {
      $treeViewObject = array();
      $treeViewObject['label'] = (string) render_title($informationObject->getLabel(array('truncate' => 50)));
      $treeViewObject['href'] = $this->getController()->genUrl('informationobject/show?id='.$informationObject->getId());
      $treeViewObject['id'] = $informationObject->getId();
      $treeViewObject['parentId'] = $informationObject->getParentId();
      $treeViewObject['isLeaf'] = (string) !$informationObject->hasChildren();

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

    // Is treeView draggable?
    $this->treeViewDraggable = QubitAcl::check(QubitInformationObject::getRoot(), QubitAclAction::UPDATE_ID) ? 'true' : 'false';
  }
}
