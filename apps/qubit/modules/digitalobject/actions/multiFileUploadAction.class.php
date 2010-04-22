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
    $this->form = new sfForm;

    $this->informationObject = QubitInformationObject::getById($request->informationObject);

    // Check that object exists and that it is not the root
    if (!isset($this->informationObject) || !isset($this->informationObject->parent))
    {
      $this->forward404();
    }

    // Check user authorization
    if (!QubitAcl::check($this->informationObject, 'update'))
    {
      QubitAcl::forwardUnauthorized();
    }

    // Add javascript libraries
    $this->getResponse()->addJavaScript('/vendor/yui/uploader/uploader-min.js', 'last');
    $this->getResponse()->addJavaScript('multiFileUpload.js', 'last');

    // Get max upload size limits
    $this->maxUploadSize = QubitDigitalObject::getMaxUploadSize();

    // Paths for uploader javascript
    $this->uploadSwfPath = $this->getRequest()->getRelativeUrlRoot().'/vendor/yui/uploader/assets/uploader.swf';
    $this->uploadResponsePath = $this->context->routing->generate(null, array('module' => 'digitalobject', 'action' => 'upload'));
    $this->uploadTmpDir = $this->getRequest()->getRelativeUrlRoot().'/uploads/tmp';

    $this->form->setValidator('files', new QubitValidatorCountable(array('required' => true)));

    $this->form->setValidator('informationObject', new sfValidatorInteger);
    $this->form->setWidget('informationObject', new sfWidgetFormInputHidden);
    $this->form->setDefault('informationObject', $this->informationObject->id);

    $this->form->setValidator('title', new sfValidatorPass);
    $this->form->setWidget('title', new sfWidgetFormInput(array()));
    $this->form->setDefault('title', 'image %dd%');

    $this->form->setValidator('levelOfDescription', new sfValidatorString);

    $choices = array();
    $choices[null] = null;
    foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID) as $term)
    {
      $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
    }

    $this->form->setWidget('levelOfDescription', new sfWidgetFormSelect(array('choices' => $choices)));

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters(), $request->getFiles());

      if ($this->form->isValid())
      {
        $this->processForm();
      }
    }
  }

  public function processForm()
  {
    $tmpPath = sfConfig::get('sf_upload_dir').'/tmp';

    // Upload files
    $i = 0;

    foreach ($this->form->getValue('files') as $file)
    {
      if (0 == strlen($file['infoObjectTitle'] || 0 == strlen($file['tmpName'])))
      {
        continue;
      }

      $i++;

      // Create an information object for this digital object
      $informationObject = new QubitInformationObject;
      $informationObject->setParentId($this->informationObject->id);

      if (0 < strlen($title = $file['infoObjectTitle']))
      {
        $informationObject->setTitle($title);
      }

      if (0 != intval($levelOfDescriptionId = $this->form->getValue('level_of_description_id')))
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

    $this->redirect(array($this->informationObject, 'module' => 'informationobject'));
  }
}
