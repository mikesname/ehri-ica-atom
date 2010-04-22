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
 * Information Object - showRad
 *
 * @package    qubit
 * @subpackage informationObject - initialize a showRad template for displaying an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class sfRadPluginIndexAction extends InformationObjectIndexAction
{
  public function execute($request)
  {
    parent::execute($request);

    // add RAD specific commands

    // RAD validation disabled until we get some feedback later this month from the CCA about how to apply the RAD validation
    if (QubitAcl::check($this->object, 'update'))
    {
      $validatorSchema = new sfValidatorSchema;
      $validatorSchema->setOption('allow_extra_fields', true);

      $validatorSchema->levelOfDescription = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Level of description - This is a mandatory element.')));

      $levelOfDescription = null != $this->object->levelOfDescription ? $this->object->levelOfDescription->getName(array('sourceCulture' => 'en')) : null;

      if (in_array($levelOfDescription, array('Fonds', 'Collection', 'Series', 'File', 'Item')))
      {
        $validatorSchema->title = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Title - This is a mandatory element.')));

        // Class of materials specific details
        foreach ($this->object->getMaterialTypes() as $materialType)
        {
          switch ($materialType->term->getName(array('source_culture' => 'en')))
          {
            case 'Architectural drawing':
              $validatorSchema->statementOfScaleArchitectural = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Statement of scale (architectural) - This is a mandatory element.')));
              break;
            case 'Cartographic material':
              $validatorSchema->statementOfScaleCartographic = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Statement of scale (cartographic) - This is a mandatory element.')));
              $validatorSchema->statementOfProjection = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Statement of projection (cartographic) - This is a mandatory element.')));
              $validatorSchema->statementOfCoordinates = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Statement of coordinates (cartographic) - This is a mandatory element.')));
              break;
            case 'Philatelic record':
              $validatorSchema->issuingJurisdictionAndDenomination = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Issuing jurisdiction and denomination (philatelic) - This is a mandatory element.')));
              break;
          }
        }

        $validatorSchema->dates = new QubitValidatorCountable(array('required' => true), array('required' => $this->context->i18n->__('This archival description requires at least one date.')));
        $validatorSchema->extentAndMedium = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Physical description - This is a mandatory element.')));
        $validatorSchema->scopeAndContent = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Scope and content - This is a mandatory element.')));

        // Only if top level of description
        if (in_array($levelOfDescription, array('Fonds', 'Collection', 'Series')) && !isset($this->object->parent->parent))
        {
          $validatorSchema->custodialHistory = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Custodial history - This is a mandatory element.')));
        }
        // Item, assuming that it is a publication
        // else if ('Item' == $levelOfDescription && $this->object->getPublicationStatus()->statusId == QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID)
        // {
        //  $validatorSchema->edition = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Edition statement - This is a mandatory element.')));
        //  $validatorSchema->standardNumber = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('Standard number - This is a mandatory element.')));
        // }
      }

      $value = array();
      $value['title'] = $this->object->getTitle(array('cultureFallback' => true));
      $value['levelOfDescription'] = $this->object->levelOfDescription;
      $value['statementOfScaleCartographic'] = $this->object->getPropertyByName('statementOfScaleCartographic', array('scope' => 'rad'))->getValue(array('cultureFallback' => true));
      $value['statementOfProjection'] = $this->object->getPropertyByName('statementOfProjection', array('scope' => 'rad'))->getValue(array('cultureFallback' => true));
      $value['statementOfCoordinates'] = $this->object->getPropertyByName('statementOfCoordinates', array('scope' => 'rad'))->getValue(array('cultureFallback' => true));
      $value['statementOfScaleArchitectural'] = $this->object->getPropertyByName('statementOfScaleArchitectural', array('scope' => 'rad'))->getValue(array('cultureFallback' => true));
      $value['issuingJurisdictionAndDenomination'] = $this->object->getPropertyByName('issuingJurisdictionAndDenomination', array('scope' => 'rad'))->getValue(array('cultureFallback' => true));
      $value['extentAndMedium'] = $this->object->getExtentAndMedium(array('cultureFallback' => true));
      $value['scopeAndContent'] = $this->object->getScopeAndContent(array('cultureFallback' => true));
      $value['custodialHistory'] = $this->object->getArchivalHistory(array('cultureFallback' => true));
      $value['edition'] = $this->object->getEdition(array('cultureFallback' => true));
      $value['standardNumber'] = $this->object->getPropertyByName('standardNumber', array('scope' => 'rad'))->getValue(array('cultureFallback' => true));

      if ('Item' == $levelOfDescription)
      {
        $value['dates'] = $this->object->getDates(array('type_id' => QubitTerm::PUBLICATION_ID));
      }
      else
      {
        $value['dates'] = $this->object->getDates(array('type_id' => QubitTerm::CREATION_ID));
      }

      try
      {
        $validatorSchema->clean($value);
      }
      catch (sfValidatorErrorSchema $e)
      {
        $this->errorSchema = $e;
      }
    }

    $this->notes = $this->object->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_NOTE_ID));
    $this->titleNotes = $this->object->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_TITLE_NOTE_ID));
  }
}
