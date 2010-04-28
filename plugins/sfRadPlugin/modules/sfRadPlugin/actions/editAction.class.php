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
 * Information Object - editRad
 *
 * @package    qubit
 * @subpackage informationObject - initialize an editRad template for updating an information object
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class sfRadPluginEditAction extends InformationObjectEditAction
{
  // Arrays are not allowed in class constants
  public static
    $NAMES = array(
      'accessConditions',
      'accruals',
      'acquisition',
      'alternateTitle',
      'archivalHistory',
      'arrangement',
      'descriptionDetail',
      'descriptionIdentifier',
      'edition',
      'editionStatementOfResponsibility',
      'extentAndMedium',
      'findingAids',
      'identifier',
      'institutionResponsibleIdentifier',
      'issuingJurisdictionAndDenomination',
      'language',
      'languageOfDescription',
      'levelOfDescription',
      'locationOfCopies',
      'locationOfOriginals',
      'nameAccessPoints',
      'noteOnPublishersSeries',
      'numberingWithinPublishersSeries',
      'otherTitleInformation',
      'otherTitleInformationOfPublishersSeries',
      'parallelTitleOfPublishersSeries',
      'physicalCharacteristics',
      'placeAccessPoints',
      'relatedUnitsOfDescription',
      'repository',
      'reproductionConditions',
      'revisionHistory',
      'rules',
      'scopeAndContent',
      'script',
      'scriptOfDescription',
      'sources',
      'standardNumber',
      'statementOfCoordinates',
      'statementOfProjection',
      'statementOfResponsibilityRelatingToPublishersSeries',
      'statementOfScaleArchitectural',
      'statementOfScaleCartographic',
      'subjectAccessPoints',
      'descriptionStatus',
      'title',
      'titleStatementOfResponsibility',
      'titleProperOfPublishersSeries',
      'types',
      'publicationStatus');

  protected function addField($name)
  {
    parent::addField($name);

    switch ($name)
    {
      case 'alternateTitle':
      case 'edition':
        $this->form->setDefault($name, $this->object[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'editionStatementOfResponsibility':
      case 'issuingJurisdictionAndDenomination':
      case 'noteOnPublishersSeries':
      case 'numberingWithinPublishersSeries':
      case 'otherTitleInformation':
      case 'otherTitleInformationOfPublishersSeries':
      case 'parallelTitleOfPublishersSeries':
      case 'standardNumber':
      case 'statementOfCoordinates':
      case 'statementOfProjection':
      case 'statementOfResponsibilityRelatingToPublishersSeries':
      case 'statementOfScaleArchitectural':
      case 'statementOfScaleCartographic':
      case 'titleStatementOfResponsibility':
      case 'titleProperOfPublishersSeries':
        $criteria = new Criteria;
        $this->object->addPropertysCriteria($criteria);
        $criteria->add(QubitProperty::NAME, $name);
        $criteria->add(QubitProperty::SCOPE, 'rad');

        $this[$name] = null;
        if (1 == count($query = QubitProperty::get($criteria)))
        {
          $this[$name] = $query[0];
          $this->form->setDefault($name, $this[$name]->value);
        }

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'types':
        $criteria = new Criteria;
        $this->object->addObjectTermRelationsRelatedByObjectIdCriteria($criteria);
        QubitObjectTermRelation::addJoinTermCriteria($criteria);
        $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MATERIAL_TYPE_ID);

        $values = array();
        foreach ($this->relations = QubitObjectTermRelation::get($criteria) as $relation)
        {
          $values[] = $this->context->routing->generate(null, array($relation->term, 'module' => 'term'));
        }

        $this->form->setDefault('types', $values);
        $this->form->setValidator('types', new sfValidatorPass);

        $choices = array();
        foreach (QubitTaxonomy::getTermsById(QubitTaxonomy::MATERIAL_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setWidget('types', new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;
    }
  }

  public function execute($request)
  {
    parent::execute($request);

    // add RAD specific commands
    $this->radNotes = $this->object->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_NOTE_ID));
    $this->radTitleNotes = $this->object->getNotesByTaxonomy($options = array('taxonomyId' => QubitTaxonomy::RAD_TITLE_NOTE_ID));
    $this->radTitleNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_TITLE_NOTE_ID);
    $this->radNoteTypes = QubitTerm::getOptionsForSelectList(QubitTaxonomy::RAD_NOTE_ID);
  }

  protected function processField($field)
  {
    switch ($field->getName())
    {
      case 'editionStatementOfResponsibility':
      case 'issuingJurisdictionAndDenomination':
      case 'noteOnPublishersSeries':
      case 'numberingWithinPublishersSeries':
      case 'otherTitleInformation':
      case 'otherTitleInformationOfPublishersSeries':
      case 'parallelTitleOfPublishersSeries':
      case 'standardNumber':
      case 'statementOfCoordinates':
      case 'statementOfProjection':
      case 'statementOfResponsibilityRelatingToPublishersSeries':
      case 'statementOfScaleArchitectural':
      case 'statementOfScaleCartographic':
      case 'titleProperOfPublishersSeries':
      case 'titleStatementOfResponsibility':

        if (null === $this[$field->getName()])
        {
          $this[$field->getName()] = new QubitProperty;
          $this[$field->getName()]->name = $field->getName();
          $this[$field->getName()]->scope = 'rad';
          $this->object->propertys[] = $this[$field->getName()];
        }

        $this[$field->getName()]->value = $this->form->getValue($field->getName());

        break;

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

  protected function processForm()
  {
    $this->updateNotes();

    return parent::processForm();
  }

  protected function updateNotes()
  {
    if (isset($this->request->rad_title_note) && 0 < strlen($this->request->rad_title_note))
    {
      $note = new QubitNote;
      $note->content = $this->request->rad_title_note;
      $note->typeId = $this->request->rad_title_note_type;
      $note->userId = $this->context->user->getAttribute('user_id');

      $this->object->notes[] = $note;
    }

    if (isset($this->request->rad_note) && 0 < strlen($this->request->rad_note))
    {
      $note = new QubitNote;
      $note->content = $this->request->rad_note;
      $note->typeId = $this->request->rad_note_type;
      $note->userId = $this->context->user->getAttribute('user_id');

      $this->object->notes[] = $note;
    }
  }
}
