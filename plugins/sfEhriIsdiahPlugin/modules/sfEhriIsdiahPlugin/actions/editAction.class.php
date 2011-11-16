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
 * Repository - editIsdiah
 *
 * @package    qubit
 * @subpackage Actor - initialize an editIDIAH template for updating a repository
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class sfEhriIsdiahPluginEditAction extends sfIsdiahPluginEditAction
{
  // Arrays not allowed in class constants
  public static
    $NAMES = array(
      'identifier',
      'authorizedFormOfName',
      'parallelName',
      'otherName',
      'type',
      'history',
      'geoculturalContext',
      'mandates',
      'internalStructures',
      'collectingPolicies',
      'buildings',
      'holdings',
      'findingAids',
      'openingTimes',
      'accessConditions',
      'disabledAccess',
      'researchServices',
      'reproductionServices',
      'publicFacilities',
      'descIdentifier',
      'descInstitutionIdentifier',
      'descRules',
      'descStatus',
      'descDetail',
      'descRevisionHistory',
      'language',
      'script',
      'descSources',
      'maintenanceNotes',
      'ehriPriority',
      'ehriCopyrightIssue');

  protected function earlyExecute()
  {
    parent::earlyExecute();

    $this->isdiah = new sfEhriIsdiahPlugin($this->resource);

    $title = $this->context->i18n->__('Add new EHRI archival institution');
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
    if (!$this->resource->descIdentifier)
    {
      $this->resource->descIdentifier = "EHRI";
    }
    if (!$this->resource->descInstitutionIdentifier)
    {
      $this->resource->descInstitutionIdentifier = "EHRI";
    }
    if (!$this->resource->descRules)
    {
      $this->resource->descRules = "ISDIAH";
    }
    if (!$this->resource->script)
    {
      $this->resource->script = "Latn";
    }
  }

  protected function addField($name)
  {
    switch ($name)
    {
      case 'ehriCopyrightIssue':
        $this->form->setDefault('ehriCopyrightIssue', $this->isdiah->ehriCopyrightIssue);
        $this->form->setValidator('ehriCopyrightIssue', new sfValidatorBoolean);
        $this->form->setWidget('ehriCopyrightIssue', new sfWidgetFormInputCheckbox());
        break;
      case 'ehriPriority':
        $this->form->setDefault('ehriPriority', $this->isdiah->ehriPriority);
        $this->form->setValidator('ehriPriority', new sfValidatorString);
        $this->form->setWidget('ehriPriority', new sfWidgetFormSelect(
            array("choices" => array(
                null => "", 5 =>"5", 4 => "4", 3 => "3", 2 => "2",
                1 => "1", 0 => "Reject"))));
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
        $this->isdiah->ehriCopyrightIssue = $this->form->getValue($field->getName());
        break;
      case 'ehriPriority':
        $this->isdiah->ehriPriority = $this->form->getValue($field->getName());
        break;

      default:

        return parent::processField($field);
    }
  }
}
