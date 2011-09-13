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
 * Information Object - editIsad
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editIsad template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jesús García Crespo <correo@sevein.com>
 * @version    SVN: $Id$
 */
class sfEhriIsadPluginEditAction extends sfIsadPluginEditAction
{
  // Arrays not allowed in class constants
  public static
    $NAMES = array(
      'accessConditions',
      'accruals',
      'acquisition',
      'appraisal',
      'archivalHistory',
      'arrangement',
      'creators',
      'descriptionDetail',
      'descriptionIdentifier',
      'extentAndMedium',
      'findingAids',
      'identifier',
      'institutionResponsibleIdentifier',
      'languageOfDescription',
      'language',
      'levelOfDescription',
      'locationOfCopies',
      'locationOfOriginals',
      'nameAccessPoints',
      'physicalCharacteristics',
      'placeAccessPoints',
      'otherName',
      'relatedUnitsOfDescription',
      'repository',
      'reproductionConditions',
      'revisionHistory',
      'rules',
      'scopeAndContent',
      'scriptOfDescription',
      'script',
      'sources',
      'subjectAccessPoints',
      'descriptionStatus',
      'publicationStatus',
      'title',
      'ehriScope',
      'ehriPriority',
      'ehriCopyrightIssue');

  protected function earlyExecute()
  {
    parent::earlyExecute();

    $this->isad = new sfEhriIsadPlugin($this->resource);

    $title = $this->context->i18n->__('Add new EHRI archival description');
    if (isset($this->getRoute()->resource))
    {
      if (1 > strlen($title = $this->resource))
      {
        $title = $this->context->i18n->__('Untitled');
      }

      $title = $this->context->i18n->__('Edit %1%', array('%1%' => $title));
    }

    $this->response->setTitle("$title - {$this->response->getTitle()}");

    // FIXME: Hack way of setting default values
    if (!$this->resource->levelOfDescription)
    {
      $this->resource->setLevelOfDescriptionByName("Collection");
    }
    if (!$this->resource->descriptionIdentifier)
    {
      $this->resource->descriptionIdentifier = "EHRI";
    }
    if (!$this->resource->rules)
    {
      $this->resource->rules = "ISAD(G)";
    }


  }

  protected function addField($name)
  {
    switch ($name)
    {
      case 'ehriCopyrightIssue':
        $this->form->setDefault('ehriCopyrightIssue', $this->isad->ehriCopyrightIssue);
        $this->form->setValidator('ehriCopyrightIssue', new sfValidatorBoolean);
        $this->form->setWidget('ehriCopyrightIssue', new sfWidgetFormInputCheckbox());
        break;
      case 'ehriScope':
        $this->form->setDefault('ehriScope', $this->isad->ehriScope);
        $this->form->setValidator('ehriScope', new sfValidatorString);
        $this->form->setWidget('ehriScope', new sfWidgetFormSelect(
            array("choices" => array(
                "High" =>"High", "Medium" => "Medium", "Low" => "Low"))));
        break;
      case 'ehriPriority':
        $this->form->setDefault('ehriPriority', $this->isad->ehriPriority);
        $this->form->setValidator('ehriPriority', new sfValidatorString);
        $this->form->setWidget('ehriPriority', new sfWidgetFormSelect(
            array("choices" => array(
                "High" =>"High", "Medium" => "Medium",
                "Low" => "Low", "Reject" => "Reject"))));
        break;

      case 'otherName':
        $criteria = new Criteria;
        $criteria = $this->resource->addOtherNamesCriteria($criteria);
        $criteria->add(QubitOtherName::TYPE_ID, QubitTerm::OTHER_FORM_OF_NAME_ID);

        $value = $defaults = array();
        foreach ($this[$name] = QubitOtherName::get($criteria) as $item)
        {
          $defaults[$value[] = $item->id] = $item;
        }

        $this->form->setDefault($name, $value);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new QubitWidgetFormInputMany(array('defaults' => $defaults)));

        break;

      default:

        return parent::addField($name);
    }
  }

  protected function processField($field)
  {
    switch ($field->getName())
    {
      case 'ehriCopyrightIssue':
      case 'ehriScope':
      case 'ehriPriority':
        $name = $field->getName();
        $this->isad->$name = $this->form->getValue($name);
        break;

      case 'otherName':
        $value = $filtered = $this->form->getValue($field->getName());

        foreach ($this[$field->getName()] as $item)
        {
          if (isset($value[$item->id]))
          {
            $item->name = $value[$item->id];
            unset($filtered[$item->id]);
          }
          else
          {
            $item->delete();
          }
        }

        foreach ($filtered as $item)
        {
          $otherName = new QubitOtherName;
          $otherName->name = $item;
          $otherName->typeId = QubitTerm::OTHER_FORM_OF_NAME_ID;

          $this->resource->otherNames[] = $otherName;
        }

        break;
      default:

        return parent::processField($field);
    }
  }
}
