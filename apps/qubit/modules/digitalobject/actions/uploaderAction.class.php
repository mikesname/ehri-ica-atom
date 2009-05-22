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

class DigitalObjectUploaderAction extends sfAction
{
  public function execute($request)
  {
    $this->getResponse()->addJavaScript('/vendor/yui/yahoo-dom-event/yahoo-dom-event.js');
    $this->getResponse()->addJavaScript('/vendor/yui/element/element-min.js');
    $this->getResponse()->addJavaScript('/vendor/yui/uploader/uploader-debug.js');
    $this->getResponse()->addJavaScript('/vendor/yui/datasource/datasource-min.js');
    $this->getResponse()->addJavaScript('/vendor/yui/datatable/datatable-min.js');

    $this->getResponse()->addStylesheet('/vendor/yui/datatable/assets/skins/sam/datatable');

    // Get max upload size limits
    $this->maxUploadSize = QubitDigitalObject::getMaxUploadSize();

    $this->uploadSwfPath = $this->getRequest()->getRelativeUrlRoot().'/vendor/yui/uploader/assets/uploader.swf';
    $this->uploadResponsePath = $this->getRequest()->getRelativeUrlRoot().'/digitalobject/upload';
  }
}