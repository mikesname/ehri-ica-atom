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

class TermTreeViewComponent extends sfComponent
{
  public function execute($request)
  {
    $this->term = $request->getAttribute('term');

    if (1 > count($this->termTree))
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
    foreach ($this->termTree as $term)
    {
      $treeViewObject = array();

      if (QubitTerm::ROOT_ID != $term->id)
      {
        $treeViewObject['label'] = $term->getName(array('cultureFallback' => true, 'truncate' => 50));
        $treeViewObject['href'] = $this->getController()->genUrl('term/show?id='.$term->id);
        $treeViewObject['id'] = $term->id;
        $treeViewObject['parentId'] = $term->parentId;
        $treeViewObject['isLeaf'] = (string) count($term->getDescendants()) == 0;
      }
      else
      {
        $treeViewObject['label'] = $this->term->getTaxonomy()->getName(array('cultureFallback' => true, 'truncate' => 50));
        $treeViewObject['href'] = $this->getController()->genUrl(array('module' => 'term', 'action' => 'list', 'taxonomyId' => $this->term->taxonomyId));
        $treeViewObject['id'] = $term->id;
        $treeViewObject['parentId'] = null;
        $treeViewObject['isLeaf'] = (string) count($term->getDescendants()) == 0;
      }

      // TODO: Should be able to check equality of objects
      if ($term->id == $this->term->id)
      {
        $treeViewObject['style'] = 'ygtvlabel currentTextNode';
      }

      $this->treeViewObjects[] = $treeViewObject;
    }

    $this->treeViewExpands = array();
    foreach ($this->term->getAncestors() as $ancestor)
    {
      $this->treeViewExpands[$id = $ancestor->id] = $id;
    }
    $this->treeViewExpands[$id = $this->term->id] = $id;

    // Is treeView draggable?
    $this->treeViewDraggable = SecurityPriviliges::editCredentials($this->getUser(), 'term') ? 'true' : 'false';
  }
}
