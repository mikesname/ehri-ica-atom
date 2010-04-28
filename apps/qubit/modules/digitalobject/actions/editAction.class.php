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
 * Digital Object edit component
 *
 * @package    qubit
 * @subpackage digital object
 * @author     david juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class DigitalObjectEditAction extends sfAction
{
  protected function addFormFields()
  {
    // Media type field
    $choices = $validChoices = array();
    $c = new Criteria;
    $c->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MEDIA_TYPE_ID, Criteria::EQUAL);
    if (null !== ($mediaTypeTerms = QubitTerm::get($c)))
    {
      foreach ($mediaTypeTerms as $mediaTypeTerm)
      {
        $choices[$mediaTypeTerm->id] = $mediaTypeTerm->getName(array('cultureFallback' => true));
      }

      asort($choices); // Sort media types by name
    }

    $this->form->setValidator('mediaType', new sfValidatorChoice(array('choices' => array_keys($choices))));
    $this->form->setWidget('mediaType', new sfWidgetFormSelect(array('choices' => $choices)));
    $this->form->setDefault('mediaType', $this->digitalObject->mediaTypeId);

    // Only display 'compound digital object' toggle if we have a child with a
    // digital object
    $this->showCompoundObjectToggle = false;
    foreach ($this->informationObject->getChildren() as $child)
    {
      if (null !== $child->getDigitalObject())
      {
        $this->showCompoundObjectToggle = true;
        break;
      }
    }

    if ($this->showCompoundObjectToggle)
    {
      $this->form->setValidator('displayAsCompound', new sfValidatorPass);
      $this->form->setWidget('displayAsCompound', new sfWidgetFormSelectRadio(
        array('choices' => array(
          '1' => $this->getContext()->getI18N()->__('Yes'),
          '0' => $this->getContext()->getI18N()->__('No')
        ))
      ));
      // Set 'displayAsCompound' value from QubitProperty
      $c = new Criteria;
      $c->add(QubitProperty::OBJECT_ID, $this->digitalObject->id, Criteria::EQUAL);
      $c->add(QubitProperty::NAME, 'displayAsCompound', Criteria::EQUAL);

      if (null != ($compoundProperty = QubitProperty::getOne($c)))
      {
        $this->form->setDefault('displayAsCompound', $compoundProperty->getValue(array('sourceCulture' => true)));
      }
    }

    // If reference represenation doesn't exist, include upload widget
    foreach ($this->representations as $usageId => $representation)
    {
      if (null === $representation)
      {
        $this->form->setValidator('repFile_'.$usageId, new sfValidatorFile);
        $this->form->setWidget('repFile_'.$usageId, new sfWidgetFormInputFile);

        // Add 'auto-generate' checkbox
        $this->form->setValidator('generateDerivative_'.$usageId, new sfValidatorPass);
        $this->form->setWidget('generateDerivative_'.$usageId, new sfWidgetFormInputCheckbox(array(), array('value' => 1)));
      }
    }
  }

  public function execute($request)
  {
    $this->form = new sfForm;

    $this->digitalObject = new QubitDigitalObject;
    $this->informationObject = new QubitInformationObject;

    // Get max upload size limits
    $this->maxUploadSize = QubitDigitalObject::getMaxUploadSize();

    // If digital object already exists (template: edit)
    if (isset($request->id))
    {
      $this->digitalObject = QubitDigitalObject::getById($request->id);

      if (!isset($this->digitalObject))
      {
        $this->forward404();
      }

      $this->informationObject = $this->digitalObject->informationObject;

      // Check user authorization
      if (!QubitAcl::check($this->informationObject, 'update'))
      {
        QubitAcl::forwardUnauthorized();
      }

      // Get representations
      $this->representations = array(
        QubitTerm::REFERENCE_ID => $this->digitalObject->getChildByUsageId(QubitTerm::REFERENCE_ID),
        QubitTerm::THUMBNAIL_ID => $this->digitalObject->getChildByUsageId(QubitTerm::THUMBNAIL_ID)
      );

      $this->addFormFields();
    }

    // Upload a new digital object (template: uploadForm)
    else
    {
      $this->informationObject = QubitInformationObject::getById($request->informationObject);

      // Check that object exists and that it is not the root
      if (!isset($this->informationObject) || !isset($this->informationObject->parent))
      {
        $this->forward404();
      }

      // Check if already exists a digital object
      if (null !== ($digitalObject = $this->informationObject->getDigitalObject()))
      {
        $this->redirect(array($digitalObject, 'module' => 'digitalobject', 'action' => 'edit'));
      }

      // Check user authorization
      if (!QubitAcl::check($this->informationObject, 'update'))
      {
        QubitAcl::forwardUnauthorized();
      }

      // Single upload
      if (0 < count($request->getFiles()))
      {
        $this->form->setValidator('file', new sfValidatorFile);
      }

      $this->form->setWidget('file', new sfWidgetFormInputFile);

      // URL
      if (isset($request->url) && 'http://' != $request->url)
      {
        $this->form->setValidator('url', new sfValidatorUrl);
      }

      $this->form->setDefault('url', 'http://');
      $this->form->setWidget('url', new sfWidgetFormInput);

      $this->form->setValidator('informationObject', new sfValidatorInteger);
      $this->form->setWidget('informationObject', new sfWidgetFormInputHidden);
      $this->form->setDefault('informationObject', $this->informationObject->id);

      $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

      $this->setTemplate('uploadForm');
    }

    // Process forms
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters(), $request->getFiles());

      if ($this->form->isValid())
      {
        if (null !== $this->form->getValue('file') || null !== $this->form->getValue('url'))
        {
          // Process single-upload form
          $this->processUploadForm();
        }
        else
        {
          // Process update form
          $this->processUpdateForm();
        }
      }
    }
  }

  /**
   * Upload the asset selected by user and create a digital object with appropriate
   * representations.
   *
   * @return DigitalObjectEditAction this action
   */
  public function processUploadForm()
  {
    if (null !== $this->form->getValue('file'))
    {
      $name = $this->form->getValue('file')->getOriginalName();
      $content = file_get_contents($this->form->getValue('file')->getTempName());

      $this->digitalObject->assets[] = new QubitAsset($name, $content);
      $this->digitalObject->usageId = QubitTerm::MASTER_ID;
    }
    else if (null !== $this->form->getValue('url'))
    {
      $this->digitalObject->importFromURI($this->form->getValue('url'));
    }

    $this->informationObject->digitalObjects[] = $this->digitalObject;
    $this->informationObject->save();

    $this->redirect(array($this->informationObject, 'module' => 'informationobject'));
  }

  /**
   * Update digital object properties, or upload new digital object derivatives.
   *
   * @return DigitalObjectEditAction this action
   */
  public function processUpdateForm()
  {
    // Set property 'displayAsCompound'
    $displayAsCompound = $this->form->getValue('displayAsCompound');
    $this->digitalObject->setDisplayAsCompoundObject($displayAsCompound);

    // Update media type
    $this->digitalObject->mediaTypeId = $this->form->getValue('mediaType');

    // Upload new representations
    $uploadedFiles = array();
    foreach ($this->representations as $usageId => $representation)
    {
      if (null !== ($uf = $this->form->getValue('repFile_'.$usageId)))
      {
        $uploadedFiles[$usageId] = $uf;
      }
    }

    foreach ($uploadedFiles as $usageId => $uploadFile)
    {
      $content = file_get_contents($uploadFile->getTempName());

      if (QubitDigitalObject::isImageFile($uploadFile->getOriginalName()))
      {
        $tmpFile = Qubit::saveTemporaryFile($uploadFile->getOriginalName(), $content);

        if (QubitTerm::REFERENCE_ID == $usageId)
        {
          $maxwidth = (sfConfig::get('app_reference_image_maxwidth')) ? sfConfig::get('app_reference_image_maxwidth') : 480;
          $maxheight = null;
        }
        else if (QubitTerm::THUMBNAIL_ID == $usageId)
        {
          $maxwidth = 100;
          $maxheight = 100;
        }

        $content = QubitDigitalObject::resizeImage($tmpFile, $maxwidth, $maxheight);

        @unlink($tmpFile);
      }

      $representation = new QubitDigitalObject;
      $representation->usageId = $usageId;
      $representation->assets[] = new QubitAsset($uploadFile->getOriginalName(), $content);
      $representation->parentId = $this->digitalObject->id;
      $representation->createDerivatives = false;
      $representation->save();
    }

    // Generate new reference
    if (null != $this->form->getValue('generateDerivative_'.QubitTerm::REFERENCE_ID))
    {
      $this->digitalObject->createReferenceImage();
    }

    // Generate new thumb
    if (null != $this->form->getValue('generateDerivative_'.QubitTerm::THUMBNAIL_ID))
    {
      $this->digitalObject->createThumbnail();
    }

    $this->digitalObject->save();

    $this->redirect(array($this->informationObject, 'module' => 'informationobject'));
  }
}
