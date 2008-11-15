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

/**
 * Global form definition for settings module - with validation.
 * 
 * @package    qubit
 * @subpackage settings
 * @version    svn: $Id$
 * @author     David Juhasz <david@artefactual.com>
 */
class SettingsGlobalForm extends sfForm
{ 
  protected static $refImageMaxWidthMin = 100;
  protected static $refImageMaxWidthMax = 2000;
  
  protected static $hitsPerPageMin = 5;
  protected static $hitsPerPageMax = 50;
  
  public function configure()
  {
    // Build widgets
    $this->setWidgets(array(
      'version' => new sfWidgetFormInput(array(), array('class'=>'disabled', 'disabled'=>true)),
      'upload_dir' => new sfWidgetFormInput(array(), array('class'=>'disabled', 'disabled'=>true)),
      'reference_image_maxwidth' => new sfWidgetFormInput,
      'hits_per_page' => new sfWidgetFormInput,
      'multi_repository' => new sfWidgetFormSelectRadio(array('choices'=>array(1=>'yes', 0=>'no')), array('class'=>'radio'))
    ));
    
    // Add labels
    $this->widgetSchema->setLabels(array(
      'version' => 'application version',
      'upload_dir' => 'upload directory',
      'reference_image_maxwidth' => 'maximum image width (pixels)',
      'hits_per_page' => 'results per page',
      'multi_repository' => 'multiple repositories'
    ));
    
    // Add helper text
    $this->widgetSchema->setHelps(array(
      'version' => 'The current version of the application',
      'upload_dir' => 'The destination directory for uploaded digital object files',
      'reference_image_maxwidth' => 'The maximum width for derived reference images',
      'hits_per_page' => 'The number of records shown per page on list pages',
      'multi_repository' => 'When set to &quot;yes&quot;, the related repository name will be shown in some labels (e.g. archival descriptions) and the context menu'
    ));
    
    // Reference image max. width validator
    $this->validatorSchema['reference_image_maxwidth'] = new sfValidatorNumber(
      array(
        'required' => true,
        'min' => self::$refImageMaxWidthMin, 
        'max' => self::$refImageMaxWidthMax
      ),
      array(
        'required' => 'This field is required',
        'min' => 'This value must be at least %min% pixels',
        'max' => 'The value can not be more than %max% pixels'
      )
    );
    
    // Hits per page validator
    $this->validatorSchema['hits_per_page'] = new sfValidatorNumber(
      array(
        'required' => true,
        'min' => self::$hitsPerPageMin, 
        'max' => self::$hitsPerPageMax
      ),
      array(
        'required' => 'This field is required',
        'min'=> 'You must show at least %min% hits per page',
        'max'=> 'You cannot show more than %max% hits per page'
      )
    );
    
    $this->validatorSchema['version'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['upload_dir'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['multi_repository'] = new sfValidatorNumber(array('required' => false));
    
    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');
    
    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat('global_settings[%s]');
  }
}