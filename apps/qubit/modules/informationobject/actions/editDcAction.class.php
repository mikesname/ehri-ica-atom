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
 * Information Object - editDc
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editDc template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class InformationObjectEditDcAction extends InformationObjectEditAction
{
  // Arrays are not allowed in class constants
  public static
    $NAMES = array(
      'accessConditions',
      'extentAndMedium',
      'identifier',
      'language',
      'locationOfOriginals',
      'placeAccessPoints',
      'relation',
      'scopeAndContent',
      'subjectAccessPoints',
      'title',
      'types',
      'repository',
      'publicationStatus');

  protected function addField($name)
  {
    parent::addField($name);

    switch ($name)
    {
      case 'relation':
        $criteria = new Criteria;
        $this->informationObject->addPropertysCriteria($criteria);
        $criteria->add(QubitProperty::NAME, 'relation');
        $criteria->add(QubitProperty::SCOPE, 'dc');

        if (1 == count($query = QubitProperty::get($criteria)))
        {
          $this->relation = $query[0];
          $this->form->setDefault('relation', $this->relation->value);
        }

        $this->form->setValidator('relation', new sfValidatorString);
        $this->form->setWidget('relation', new sfWidgetFormInput);

        break;

      case 'types':
        $criteria = new Criteria;
        $this->informationObject->addObjectTermRelationsRelatedByObjectIdCriteria($criteria);
        QubitObjectTermRelation::addJoinTermCriteria($criteria);
        $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::DC_TYPE_ID);

        $values = array();
        foreach ($this->relations = QubitObjectTermRelation::get($criteria) as $relation)
        {
          $values[] = $this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $relation->term->id));
        }

        $this->form->setDefault('types', $values);
        $this->form->setValidator('types', new sfValidatorPass);

        $choices = array();
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::DC_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array('module' => 'term', 'action' => 'show', 'id' => $term->id))] = $term;
        }

        $this->form->setWidget('types', new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;
    }
  }

  public function execute($request)
  {
    parent::execute($request);

    // add Dublin Core specific commands
    $this->dcEventTypes = QubitTerm::getDcEventTypeList();
  }

  protected function processField($field)
  {
    switch ($field->getName())
    {
      case 'relation':

        if (!isset($this->relation))
        {
          $this->relation = new QubitProperty;
          $this->relation->name = 'relation';
          $this->relation->scope = 'dc';
          $this->informationObject->propertys[] = $this->relation;
        }

        $this->relation->value = $this->form->getValue('relation');

        break;

      case 'types':
        $filtered = $flipped = array();
        foreach ($this->form->getValue('types') as $value)
        {
          $params = $this->context->routing->parse(preg_replace('/.*'.preg_quote($this->request->getPathInfoPrefix(), '/').'/', null, $value));
          $filtered[$params['id']] = $flipped[$params['id']] = $params['id'];
        }

        foreach ($this->relations as $relation)
        {
          if (isset($flipped[$relation->term->id]))
          {
            unset($filtered[$relation->term->id]);
          }
          else
          {
            $relation->delete();
          }
        }

        foreach ($filtered as $id)
        {
          $relation = new QubitObjectTermRelation;
          $relation->termId = $id;

          $this->informationObject->objectTermRelationsRelatedByobjectId[] = $relation;
        }

        break;

      default:
        parent::processField($field);
    }
  }
}
