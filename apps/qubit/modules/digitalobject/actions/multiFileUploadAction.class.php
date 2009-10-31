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

class DigitalObjectMultiFileUploadAction extends sfAction
{
  public function execute($request)
  {
    $this->hasWarning = false;

    // Add javascript libraries to allow selecting multiple access points
    $this->getResponse()->addJavaScript('/vendor/jquery');
    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/drupal');

    $this->getResponse()->addJavaScript('/vendor/yui/yahoo-dom-event/yahoo-dom-event.js');
    $this->getResponse()->addJavaScript('/vendor/yui/element/element-min.js');
    $this->getResponse()->addJavaScript('/vendor/yui/uploader/uploader-debug.js');
    $this->getResponse()->addJavaScript('/vendor/yui/datasource/datasource-min.js');
    $this->getResponse()->addJavaScript('/vendor/yui/datatable/datatable-min.js');
    $this->getResponse()->addJavaScript('multiFileUpload.js');

    $this->getResponse()->addJavaScript('/sfDrupalPlugin/vendor/drupal/misc/collapse');

    $this->getResponse()->addStylesheet('/vendor/yui/datatable/assets/skins/sam/datatable');

    // Get max upload size limits
    $this->maxUploadSize = QubitDigitalObject::getMaxUploadSize();

    // Paths for uploader javascript
    $this->uploadSwfPath = $this->getRequest()->getRelativeUrlRoot().'/vendor/yui/uploader/assets/uploader.swf';
    $this->uploadResponsePath = $this->context->routing->generate(null, array('module' => 'digitalobject', 'action' => 'upload'));
    $this->uploadTmpDir = $this->getRequest()->getRelativeUrlRoot().'/uploads/tmp';

    // Handle form submit
    if ($request->isMethod('post'))
    {
      $this->processForm($request);

      // Redirect to show template on successful update
      if (!$this->hasWarning)
      {
        $this->redirect(array('module' => 'informationobject', 'action' => 'show', 'id' => $this->parentInfoObject->getId()));
      }
      else
      {
        // New object template defaults
        $this->infoObjectTemplate = new QubitInformationObject;
        $this->infoObjectTemplate->setTitle($request->getParameter('title'));
        $this->infoObjectTemplate->setLevelOfDescriptionId($request->getParameter('level_of_description_id'));
      }
    }
    else
    {
      // New object template defaults
      $this->infoObjectTemplate = new QubitInformationObject;
      $this->infoObjectTemplate->setTitle('image %dd%');
      $this->infoObjectTemplate->setLevelOfDescriptionByName('item');
    }
  }

  public function processForm($request)
  {
    $parentInfoObjectId = null;
    $tmpPath = sfConfig::get('sf_upload_dir').'/tmp';

    if (null != $request->getParameter('id'))
    {
      $this->parentInfoObject = QubitInformationObject::getById($request->getParameter('id'));
    }

    // Make sure we have a valid parent node
    if (null == $this->parentInfoObject)
    {
      $this->hasWarning = true;
      $this->warning = 'You must specify a valid parent object';
      return;
    }

    // Check if there is at least one file
    if (0 == count($request->getParameter('files')))
    {
      $this->hasWarning = true;
      $this->warning = 'You must import at least one digital object';
      return;
    }

    // Upload files
    $i = 0;
    foreach ($request->getParameter('files') as $file)
    {
      if (0 == strlen($file['infoObjectTitle'] || 0 == strlen($file['tmpName'])))
      {
        continue;
      }

      $i++;

      // Create an information object for this digital object
      $informationObject = new QubitInformationObject;
      $informationObject->setParentId($this->parentInfoObject->getId());
      if (0 < strlen($title = $file['infoObjectTitle']))
      {
        $informationObject->setTitle($title);
      }
      if (0 != intval($levelOfDescriptionId = $request->getParameter('level_of_description_id')))
      {
        $informationObject->setLevelOfDescriptionId($levelOfDescriptionId);
      }
      $informationObject->save();

      if (file_exists($tmpPath.'/'.$file['tmpName']))
      {
        // Upload asset and create digital object
        $digitalObject = new QubitDigitalObject;
        $digitalObject->setInformationObject($informationObject);
        $digitalObject->setUsageId(QubitTerm::MASTER_ID);
        $digitalObject->assets[] = new QubitAsset($file['name'], file_get_contents($tmpPath.'/'.$file['tmpName']));
        $digitalObject->save();
      }

      $thumbnailIsGeneric = (bool) strstr($file['thumb'], 'generic-icons');

      // Clean up temp files
      if (file_exists($tmpPath.'/'.$file['tmpName']))
      {
        unlink($tmpPath.'/'.$file['tmpName']);
      }
      if (!$thumbnailIsGeneric && file_exists($tmpPath.'/'.$file['thumb']))
      {
        unlink($tmpPath.'/'.$file['thumb']);
      }
    }
  }
}
