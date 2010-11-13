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

class sfIsaarPluginEventComponent extends EventEditComponent
{
  // Arrays not allowed in class constants
  public static
    $NAMES = array(
      'informationObject',
      'type',
      'resourceType',
      'startDate',
      'endDate',
      'date');

  protected function addField($name)
  {
    switch ($name)
    {
      case 'informationObject':
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => array())));

        break;

      case 'resourceType':
        $term = QubitTerm::getById(QubitTerm::ARCHIVAL_MATERIAL_ID);

        $this->form->setDefault('resourceType', $this->context->routing->generate(null, array($term, 'module' => 'term')));
        $this->form->setValidator('resourceType', new sfValidatorString);
        $this->form->setWidget('resourceType', new sfWidgetFormSelect(array('choices' => array($this->context->routing->generate(null, array($term, 'module' => 'term')) => $term))));

        break;

      default:

        return parent::addField($name);
    }
  }

  protected function processField($field)
  {
    switch ($field->getName())
    {
      case 'informationObject':
        unset($this->event->informationObject);

        $value = $this->form->getValue('informationObject');
        if (isset($value))
        {
          $params = $this->context->routing->parse(Qubit::pathInfo($value));
          $this->event->informationObject = $params['_sf_route']->resource;
        }

        break;

      default:

        return parent::processField($field);
    }
  }
}
