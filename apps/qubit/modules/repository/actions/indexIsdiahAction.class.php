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
 * Repository - showIsdiah
 *
 * @package    qubit
 * @subpackage Actor - initialize a showIDIAH template for displaying a repository
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class RepositoryIndexIsdiahAction extends RepositoryIndexAction
{
  public function execute($request)
  {
    // run the core repository show action commands
    parent::execute($request);

    // add ISDIAH specific commands
    if (QubitAcl::check($this->repository, 'update'))
    {
      $validatorSchema = new sfValidatorSchema;
      $validatorSchema->authorizedFormOfName = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Authorized form of name%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-3#5.1.2">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-3#4.7">', '%4%' => '</a>'))));
      $validatorSchema->identifier = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Identifier%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-3#5.1.1">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-3#4.7">', '%4%' => '</a>'))));

      $validatorSchema->primaryContact = new sfValidatorAnd(array(
        new QubitValidatorCountable,
        new sfValidatorOr(array(
          new sfValidatorSchema(array('city' => new sfValidatorString(array('required' => true))), array('allow_extra_fields' => true)),
          new sfValidatorSchema(array('countryCode' => new sfValidatorString(array('required' => true))), array('allow_extra_fields' => true)),
          new sfValidatorSchema(array('postalCode' => new sfValidatorString(array('required' => true))), array('allow_extra_fields' => true)),
          new sfValidatorSchema(array('region' => new sfValidatorString(array('required' => true))), array('allow_extra_fields' => true)),
          new sfValidatorSchema(array('streetAddress' => new sfValidatorString(array('required' => true))), array('allow_extra_fields' => true)),
        ), array('required' => true), array('invalid' => $this->context->i18n->__('%1%Contact information%2% - You %3%must%4% at least include one of the following location or address fields: city, country, postal code, region or street address.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-3#5.2.1">', '%2%' => '</a>', '%3%' => '<a href="<a href="http://ica-atom.org/docs/index.php?title=RS-3#4.7">', '%4%' => '</a>'))))
      ), array('required' => true), array('required' => $this->context->i18n->__('%1%Contact information%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-3#5.2.1">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-3#4.7">', '%4%' => '</a>'))));

      $value = array();
      $value['identifier'] = $this->repository->identifier;
      $value['authorizedFormOfName'] = $this->repository->getAuthorizedFormOfName(array('culltureFallback' => true));
      if (null !== $this->repository->getPrimaryContact())
      {
        $value['primaryContact']['city'] = $this->repository->getPrimaryContact()->getCity(array('culltureFallback' => true));
        $value['primaryContact']['countryCode'] = $this->repository->getPrimaryContact()->countryCode;
        $value['primaryContact']['postalCode'] = $this->repository->getPrimaryContact()->postalCode;
        $value['primaryContact']['region'] = $this->repository->getPrimaryContact()->getRegion(array('culltureFallback' => true));
        $value['primaryContact']['streetAddress'] = $this->repository->getPrimaryContact()->streetAddress;
      }

      try
      {
        $validatorSchema->clean($value);
      }
      catch (sfValidatorErrorSchema $e)
      {
        $this->errorSchema = $e;
      }
    }
  }
}
