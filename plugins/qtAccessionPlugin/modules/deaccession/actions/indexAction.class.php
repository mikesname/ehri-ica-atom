<?php

/*
 * This file is part of Qubit Toolkit.
 *
 * Qubit Toolkit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class DeaccessionIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->resource = $this->getRoute()->resource;

    // Check user authorization
    if (!QubitAcl::check($this->resource, 'read'))
    {
      QubitAcl::forwardToSecureAction();
    }

    if (1 > strlen($title = $this->resource->__toString()))
    {
      $title = $this->context->i18n->__('Untitled');
    }

    $this->response->setTitle("$title - {$this->response->getTitle()}");

    if (QubitAcl::check($this->resource, 'update'))
    {
      $validatorSchema = new sfValidatorSchema;
      $values = array();

      $validatorSchema->identifier = new sfValidatorString(array(
        'required' => true), array(
        'required' => $this->context->i18n->__('Identifier - This is a mandatory element.')));
      $values['identifier'] = $this->resource->identifier;

      $validatorSchema->date = new sfValidatorString(array(
        'required' => true), array(
        'required' => $this->context->i18n->__('Date of acquisition - This is a mandatory element.')));
      $values['date'] = $this->resource->date;

      $validatorSchema->scope = new sfValidatorString(array(
        'required' => true), array(
        'required' => $this->context->i18n->__('Scope - This is a mandatory element.')));
      $values['scope'] = $this->resource->scope;

      $validatorSchema->description = new sfValidatorString(array(
        'required' => true), array(
        'required' => $this->context->i18n->__('Description - This is a mandatory element.')));
      $values['description'] = $this->resource->getDescription(array('culltureFallback' => true));

      try
      {
        $validatorSchema->clean($values);
      }
      catch (sfValidatorErrorSchema $e)
      {
        $this->errorSchema = $e;
      }
    }
  }
}
