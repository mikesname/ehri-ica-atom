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
 * Information Object - editMods
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editMods template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class sfModsPluginEditAction extends InformationObjectEditAction
{
  // Arrays are not allowed in class constants
  public static
    $NAMES = array(
      'accessConditions',
      'identifier',
      'language',
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
      case 'types':
        $criteria = new Criteria;
        $this->object->addObjectTermRelationsRelatedByObjectIdCriteria($criteria);
        QubitObjectTermRelation::addJoinTermCriteria($criteria);
        $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MODS_RESOURCE_TYPE_ID);

        $values = array();
        foreach ($this->relations = QubitObjectTermRelation::get($criteria) as $relation)
        {
          $values[] = $this->context->routing->generate(null, array($relation->term, 'module' => 'term'));
        }

        $this->form->setDefault('types', $values);
        $this->form->setValidator('types', new sfValidatorPass);

        $choices = array();
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::MODS_RESOURCE_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('types', new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;
    }
  }

  protected function processField($field)
  {
    switch ($field->getName())
    {
      case 'types':
        $filtered = $flipped = array();
        foreach ($this->form->getValue('types') as $value)
        {
          $params = $this->context->routing->parse(Qubit::pathInfo($value));
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

          $this->object->objectTermRelationsRelatedByobjectId[] = $relation;
        }

        break;

      default:

        return parent::processField($field);
    }
  }
}
