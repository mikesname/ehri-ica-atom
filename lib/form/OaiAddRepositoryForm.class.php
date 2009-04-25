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
sfLoader::loadHelpers('I18N');
/**
 * OAI Add Repository Form
 *
 * @package    qubit
 * @subpackage oai
 * @version    svn: $Id$
 * @author     Mathieu Fortin Library and Archives Canada <mathieu.fortin@lac-bac.gc.ca>
 */
class OaiAddRepositoryForm extends sfForm
{
  public function configure()
  {
    // The fields
    $this->setWidgets( array( 'uri' => new sfWidgetFormInput() ) );

    // The labels
    $this->widgetSchema->setLabels(array('uri' => __('URI')));

    // The helpers
    $this->widgetSchema->setHelps(array(
        'uri' => __('URI to the OAI-PMH port of the Repository to be added')
      )
    );

    // The validation
    $this->validatorSchema['uri'] = new sfValidatorUrl(array( 'required' => true ));
    //$this->setValidators(array (
    //  'uri' => new sfValidatorUrl( array( 'required' => true ))
    //));
    // Set Decorator
    $decorator = new QubitWidgetFormSchemaFormatterList($this->widgetSchema);
    $this->widgetSchema->addFormFormatter('list', $decorator);
    $this->widgetSchema->setFormFormatterName('list');

    // Set wrapper text for OAI Harvesting form settings
    $this->widgetSchema->setNameFormat('oai_harvester[%s]');

  }

}
