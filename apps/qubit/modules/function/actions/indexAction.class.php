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

class FunctionIndexAction extends sfAction
{
  public function execute($request)
  {
    $this->func = QubitFunction::getById($request->id);

    if (!isset($this->func))
    {
      $this->forward404();
    }

    $this->parallelNames = $this->func->getOtherNames(array('typeId' => QubitTerm::PARALLEL_FORM_OF_NAME_ID));
    $this->otherNames = $this->func->getOtherNames(array('typeId' => QubitTerm::OTHER_FORM_OF_NAME_ID));
    $this->maintenanceNotes = $this->func->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));

    // Find function to function relations with current function as subject or
    // object
    $criteria = new Criteria;
    $criteria->addAlias('ro', QubitObject::TABLE_NAME);
    $criteria->addAlias('rs', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitRelation::OBJECT_ID, 'ro.id');
    $criteria->addJoin(QubitRelation::SUBJECT_ID, 'rs.id');
    $criterion1 = $criteria->getNewCriterion(QubitRelation::OBJECT_ID, $this->func->id, Criteria::EQUAL);
    $criterion2 = $criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $this->func->id, Criteria::EQUAL);
    $criterion1->addOr($criterion2);
    $criterion3 = $criteria->getNewCriterion('ro.class_name', 'QubitFunction', Criteria::EQUAL);
    $criterion4 = $criteria->getNewCriterion('rs.class_name', 'QubitFunction', Criteria::EQUAL);
    $criterion3->addAnd($criterion4);
    $criterion1->addAnd($criterion3);
    $criteria->add($criterion1);
    $criteria->addAscendingOrderByColumn(QubitRelation::TYPE_ID);
    $this->functionRelations = QubitRelation::get($criteria);

    // Get information objects (object) related to this function (subject)
    $criteria = new Criteria;
    $criteria->addAlias('ro', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitRelation::OBJECT_ID, 'ro.id', Criteria::INNER_JOIN);
    $criteria->add(QubitRelation::SUBJECT_ID, $this->func->id);
    $criteria->add('ro.class_name', 'QubitInformationObject');
    $this->infoObjectRelations = QubitRelation::get($criteria);

    // Get actors (object) related to this function (subject)
    $criteria = new Criteria;
    $criteria->addAlias('ro', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitRelation::OBJECT_ID, 'ro.id', Criteria::INNER_JOIN);
    $criteria->add(QubitRelation::SUBJECT_ID, $this->func->id);
    $criteria->add('ro.class_name', 'QubitActor');
    $this->actorRelations = QubitRelation::get($criteria);

    // ISDF validation rules
    if (QubitAcl::check($this->func, 'update'))
    {
      $validatorSchema = new sfValidatorSchema;
      $validatorSchema->type = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Type%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-4#Type_of_description">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-4#Structure_and_use_4.7">', '%4%' => '</a>'))));
      $validatorSchema->authorizedFormOfName = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Authorized form of name%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-4#Authorised_name">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-4#Structure_and_use_4.7">', '%4%' => '</a>'))));
      $validatorSchema->descriptionIdentifier = new sfValidatorString(array('required' => true), array('required' => $this->context->i18n->__('%1%Description identifier%2% - This is a %3%mandatory%4% element.', array('%1%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-4#Function.2Factivity_description_identifier">', '%2%' => '</a>', '%3%' => '<a href="http://ica-atom.org/docs/index.php?title=RS-4#Structure_and_use_4.7">', '%4%' => '</a>'))));

      try
      {
        $validatorSchema->clean(array(
          'type' => $this->func->type,
          'authorizedFormOfName' => $this->func->getAuthorizedFormOfName(array('cultureFallback' => true)),
          'descriptionIdentifier' => $this->func->descriptionIdentifier
        ));
      }
      catch (sfValidatorErrorSchema $e)
      {
        $this->errorSchema = $e;
      }
    }

    $this->setTemplate('indexIsdf');
  }
}
