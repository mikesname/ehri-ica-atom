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
 * Treeview component for physical objects.
 *
 * @package qubit
 * @subpackage physicalobject
 * @author david juhasz <david@artefactual.com>
 * @version svn:$id
 */
class PhysicalObjectTreeViewComponent extends sfComponent
{
  public function execute($request)
  {
    $this->curInfoObject = $request->getAttribute('informationObject');

    if (count($this->curInfoObject) < 1)
    {

      return sfView::NONE;
    }

    // Show only if user has edit privleges
    if (SecurityPriviliges::editCredentials($this->getUser(), 'informationObject'))
    {
      $this->editCredentials = true;
    }
    else
    {

      return sfView::NONE;
    }

    $this->getResponse()->addStylesheet('yui/treeview/assets/skins/qubit/treeview-skin');

    $this->getResponse()->addJavaScript('/vendor/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');
    $this->getResponse()->addJavaScript('qubit');
    $this->getResponse()->addJavaScript('yui/yahoo-dom-event/yahoo-dom-event');
    $this->getResponse()->addJavaScript('yui/treeview/treeview-min');
    $this->getResponse()->addJavaScript('treeView');

    $this->treeViewObjects = array();
    foreach ($this->informationObjects->orderBy('lft') as $informationObject)
    {
      if (count($physicalObjects = $informationObject->getPhysicalObjects()))
      {
        $physicalObject = $physicalObjects[0];
        $treeViewObject = array();
        $treeViewObject['label'] = (string) $physicalObject->getName();
        $treeViewObject['href'] = $this->getController()->genUrl('informationobject/show?id='.$informationObject->getId());
        $treeViewObject['id'] = $informationObject->getId();
        $treeViewObject['parentId'] = $informationObject->getParentId();

        // TODO: Should be able to check equality of objects
        if ($informationObject->getId() == $this->curInfoObject->getId())
        {
          $treeViewObject['style'] = 'ygtvlabel currentTextNode';
        }

        $this->treeViewObjects[] = $treeViewObject;
      }
    }

    // If no objects found for treeview, don't call _treeView template
    if (count($this->treeViewObjects) == 0)
    {

      return sfView::NONE;
    }

    $this->treeViewExpands = array();
    foreach ($this->curInfoObject->getAncestors() as $ancestor)
    {
      $this->treeViewExpands[$id = $ancestor->getId()] = $id;
    }
    $this->treeViewExpands[$id = $this->curInfoObject->getId()] = $id;
  }
}
