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
 * Physical Object edit component.
 *
 * @package    qubit
 * @subpackage digitalObject
 * @author     david juhasz <david@artefactual.com>
 * @version    SVN: $Id
 */
class InformationObjectEditPhysicalObjectsAction extends DefaultEditAction
{
  public static
    $NAMES = array(
      'containers',
      'location',
      'name',
      'type');

  protected function earlyExecute()
  {
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->resource = $this->getRoute()->resource;

    // Check that this isn't the root
    if (!isset($this->resource->parent))
    {
      $this->forward404();
    }
  }

  protected function addField($name)
  {
    switch ($name)
    {
      case 'containers':
        $this->form->setValidator('containers', new sfValidatorPass);
        $this->form->setWidget('containers', new sfWidgetFormSelect(array('choices' => array(), 'multiple' => true)));

        break;

      case 'location':
      case 'name':
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'type':
        $this->form->setValidator('type', new sfValidatorString);
        $this->form->setWidget('type', new sfWidgetFormSelect(array('choices' => QubitTerm::getIndentedChildTree(QubitTerm::CONTAINER_ID, '&nbsp;', array('returnObjectInstances' => true)))));

        break;

      default:

        return parent::addField($name);
    }
  }

  protected function processForm()
  {
    foreach ($this->form->getValue('containers') as $item)
    {
      $params = $this->context->routing->parse(Qubit::pathInfo($item));
      $this->resource->addPhysicalObject($params['_sf_route']->resource);
    }

    $value = $this->form->getValue('name');
    if (isset($value))
    {
      $physicalObject = new QubitPhysicalObject;
      $physicalObject->name = $value;
      $physicalObject->location = $this->form->getValue('location');

      $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue('type')));
      $physicalObject->type = $params['_sf_route']->resource;

      $physicalObject->save();

      $this->resource->addPhysicalObject($physicalObject);
    }

    if (isset($this->request->delete_relations))
    {
      foreach ($this->request->delete_relations as $item)
      {
        $params = $this->context->routing->parse(Qubit::pathInfo($item));
        $params['_sf_route']->resource->delete();
      }
    }
  }

  public function execute($request)
  {
    parent::execute($request);

    $this->relations = QubitRelation::getRelationsByObjectId($this->resource->id, array('typeId' => QubitTerm::HAS_PHYSICAL_OBJECT_ID));

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());
      if ($this->form->isValid())
      {
        $this->processForm();

        $this->resource->save();

        $this->redirect(array($this->resource, 'module' => 'informationobject'));
      }
    }
  }
}
