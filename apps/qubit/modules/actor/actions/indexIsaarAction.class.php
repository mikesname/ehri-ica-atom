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
 * Actor - showIsaar
 *
 * @package    qubit
 * @subpackage Actor - initialize an showISAAR template for displaying an actor
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    SVN: $Id$
 */

class ActorIndexIsaarAction extends ActorIndexAction
{
  public function execute($request)
  {
    // run the core actor show action commands
    parent::execute($request);

    // add ISAAR specific commands
    if (QubitAcl::check($this->actor, 'update'))
    {
      $validatorSchema = new sfValidatorSchema;
      $validatorSchema->authorizedFormOfName = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Authorized form of name%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#5.1.2">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#4.7">', '%4%' => '</a>'))));
      $validatorSchema->datesOfExistence = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Dates of existence%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#5.2.1">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#4.7">', '%4%' => '</a>'))));
      $validatorSchema->descriptionIdentifier = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Description identifier%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#5.4.1">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#4.7">', '%4%' => '</a>'))));
      $validatorSchema->entityType = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Type of entity%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#5.1.1">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-2#4.7">', '%4%' => '</a>'))));

      try
      {
        $validatorSchema->clean(array(
          'entityType' => $this->actor->entityType,
          'authorizedFormOfName' => $this->actor->getAuthorizedFormOfName(array('cultureFallback' => true)),
          'datesOfExistence' => $this->actor->getDatesOfExistence(array('cultureFallback' => true)),
          'descriptionIdentifier' => $this->actor->descriptionIdentifier));
      }
      catch (sfValidatorErrorSchema $e)
      {
        $this->errorSchema = $e;
      }
    }
  }
}
