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
 * Information Object - showDc
 *
 * @package    qubit
 * @subpackage informationObject - initialize a showDc template for displaying an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class sfDcPluginIndexAction extends InformationObjectIndexAction
{
  public function execute($request)
  {
    // run the core information object show action commands
    parent::execute($request);

    if (QubitAcl::check($this->object, 'update'))
    {
      $validatorSchema = new sfValidatorSchema;
      $validatorSchema->identifier = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Identifier%2% - This is a mandatory element.', array('%1%' => '<a href="http://dublincore.org/documents/dcmi-terms/#elements-identifier">', '%2%' => '</a>'))));
      $validatorSchema->title = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Title%2% - This is a mandatory element.', array('%1%' => '<a href="http://dublincore.org/documents/dcmi-terms/#elements-title">', '%2%' => '</a>'))));
      $validatorSchema->repository = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Relation%2% (%3%isLocatedAt%4%) - This is a mandatory element for this resource or one its higher descriptive levels (if part of a collection hierarchy).', array('%1%' => '<a href="http://dublincore.org/documents/dcmi-terms/#elements-relation">', '%2%' => '</a>', '%3%' => '<a href="http://dublincore.org/groups/collections/collection-application-profile/#colcldisLocatedAt">', '%4%' => '</a>'))));

      if (0 == count($this->repositoryId = $this->object->getRepositoryId()))
      {
        foreach ($this->object->getAncestors() as $ancestor)
        {
          if (0 < count($this->repositoryId = $ancestor->getRepositoryId()))
          {
            // We don't need the repository object, just to know that we have at least one
            break;
          }
        }
      }
      $this->repository = QubitRepository::getById($this->repositoryId);

      try
      {
        $validatorSchema->clean(array(
          'identifier' => $this->object->identifier,
          'title' => $this->object->getTitle(array('cultureFallback' => true)),
          'repository' => $this->repositoryId));
      }
      catch (sfValidatorErrorSchema $e)
      {
        $this->errorSchema = $e;
      }
    }
  }
}
