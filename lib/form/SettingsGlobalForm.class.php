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

sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');

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
  protected static $hitsPerPageMax = 100;

  public function configure()
  {
    // Build widgets
    $this->setWidgets(array(
      'version' => new sfWidgetFormInput(array(), array('class'=>'disabled', 'disabled'=>true)),
      'upload_dir' => new sfWidgetFormInput(array(), array('class'=>'disabled', 'disabled'=>true)),
      'reference_image_maxwidth' => new sfWidgetFormInput,
      'hits_per_page' => new sfWidgetFormInput,
      'inherit_code_informationobject' => new sfWidgetFormSelectRadio(array('choices'=>array(1=>'yes', 0=>'no')), array('class'=>'radio')),
      'sort_treeview_informationobject' => new sfWidgetFormSelectRadio(array('choices'=>array('none'=>'none', 'title'=>'title', 'identifierTitle'=> 'identifier - title')), array('class'=>'radio')),
      'multi_repository' => new sfWidgetFormSelectRadio(array('choices'=>array(1=>'yes', 0=>'no')), array('class'=>'radio'))
    ));

    // Add labels
    $this->widgetSchema->setLabels(array(
      'version' => __('Application version'),
      'upload_dir' => __('Upload directory'),
      'reference_image_maxwidth' => __('Maximum image width (pixels)'),
      'hits_per_page' => __('Results per page'),
      'inherit_code_informationobject' => __('Inherit reference code (information object)'),
      'sort_treeview_informationobject' => __('Sort treeview (information object)'),
      'multi_repository' => __('Multiple repositories')
    ));

    // Add helper text
    $this->widgetSchema->setHelps(array(
      'version' => __('The current version of the application'),
      'upload_dir' => __('The destination directory for uploaded digital object files'),
      'reference_image_maxwidth' => __('The maximum width for derived reference images'),
      'hits_per_page' => __('The number of records shown per page on list pages'),
      'inherit_code_informationobject' => __('When set to &quot;yes&quot;, the reference code string will be built using the information object identifier plus the identifiers of all its ancestors'),
      'sort_treeview_informationobject' => __('Determines whether to sort siblings in the information object treeview control and, if so, what sort criteria to use'),
      'multi_repository' => __('When set to &quot;no&quot;, the repository name is excluded from certain displays because it will be too repetitive')
    ));

    // Reference image max. width validator
    $this->validatorSchema['reference_image_maxwidth'] = new sfValidatorInteger(
      array(
        'required' => true,
        'min' => self::$refImageMaxWidthMin,
        'max' => self::$refImageMaxWidthMax
      ),
      array(
        'required' => __('This field is required'),
        'min' => __('This value must be at least %min% pixels'),
        'max' => __('This value can not be greater than %max% pixels')
      )
    );

    // Hits per page validator
    $this->validatorSchema['hits_per_page'] = new sfValidatorInteger(
      array(
        'required' => true,
        'min' => self::$hitsPerPageMin,
        'max' => self::$hitsPerPageMax
      ),
      array(
        'required' => __('This field is required'),
        'min'=> __('You must show at least %min% hits per page'),
        'max'=> __('You cannot show more than %max% hits per page')
      )
    );

    $this->validatorSchema['version'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['upload_dir'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['inherit_code_informationobject'] = new sfValidatorInteger(array('required' => false));
    $this->validatorSchema['sort_treeview_informationobject'] = new sfValidatorString(array('required' => false));
    $this->validatorSchema['multi_repository'] = new sfValidatorInteger(array('required' => false));

    // Set decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');

    // Set wrapper text for global form settings
    $this->widgetSchema->setNameFormat('global_settings[%s]');
  }
}
