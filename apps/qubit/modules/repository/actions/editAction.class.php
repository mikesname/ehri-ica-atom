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
 * Controller for editing repository information.
 *
 * @package    qubit
 * @subpackage repository
 * @version    svn: $Id$
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     Jack Bates <jack@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 */
class RepositoryEditAction extends sfAction
{
  /**
   * Define form field names
   *
   * @var string
   */
  public static
    $NAMES = array(
      'identifier',
      'authorizedFormOfName',
      'parallelName',
      'otherName',
      'types',
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
      'maintenanceNotes');

  public function addField($name)
  {
    switch ($name)
    {
      case 'types':
        $this->repoTypes = array();
        $values = array();
        $choices = array();

        $criteria = new Criteria;
        $criteria = $this->repository->addobjectTermRelationsRelatedByobjectIdCriteria($criteria);
        $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID, Criteria::INNER_JOIN);
        $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::REPOSITORY_TYPE_ID);

        if (0 < count($otRelations = QubitObjectTermRelation::get($criteria)))
        {
          $this->repoTypes = $otRelations;

          foreach ($otRelations as $otRelation)
          {
            $values[] = $this->context->routing->generate(null, array('module' => 'term', 'id' => $otRelation->termId));
          }
        }

        foreach (QubitTaxonomy::getTaxonomyTerms(QubitTaxonomy::REPOSITORY_TYPE_ID) as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices, 'multiple' => true)));

        break;

      case 'parallelName':
      case 'otherName':
        $criteria = new Criteria;
        $criteria = $this->repository->addotherNamesCriteria($criteria);

        switch ($name)
        {
          case 'parallelName':
            $criteria->add(QubitOtherName::TYPE_ID, QubitTerm::PARALLEL_FORM_OF_NAME_ID);
            break;
          default:
            $criteria->add(QubitOtherName::TYPE_ID, QubitTerm::OTHER_FORM_OF_NAME_ID);
        }

        $values = $defaults = array();
        if (0 < count($otherNames = QubitOtherName::get($criteria)))
        {
          foreach ($otherNames as $otherName)
          {
            $values[] = $otherName->id;
            $defaults[$otherName->id] = $otherName;
          }
        }

        $this->form->setDefault($name, $values);
        $this->form->setValidator($name, new sfValidatorPass);
        $this->form->setWidget($name, new QubitWidgetFormInputMany(array('defaults' => $defaults)));

        break;

      case 'descStatus':
      case 'descDetail':
        if (null !== $this->repository[$name.'Id'])
        {
          $this->form->setDefault($name, $this->context->routing->generate(null, array('module' => 'term', 'id' => $this->repository[$name.'Id'])));
        }

        $choices = array();
        $choices[null] = null;

        if ('descStatus' == $name)
        {
          $terms = QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID);
        }
        else
        {
          $terms = QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID);
        }

        foreach ($terms as $term)
        {
          $choices[$this->context->routing->generate(null, array($term, 'module' => 'term'))] = $term;
        }

        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices)));

        break;

      case 'language':
        $this->form->setDefault($name, $this->repository[$name]);
        $this->form->setValidator($name, new sfValidatorI18nChoiceLanguage(array('multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormI18nSelectLanguage(array('culture' => $this->context->user->getCulture(), 'multiple' => true)));

        break;

      case 'script':
        $this->form->setDefault($name, $this->repository[$name]);
        $c = sfCultureInfo::getInstance($this->context->user->getCulture());
        $this->form->setValidator($name, new sfValidatorChoice(array('choices' => array_keys($c->getScripts()), 'multiple' => true)));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $c->getScripts(), 'multiple' => true)));

        break;

      case 'maintenanceNotes':
        $this->maintenanceNote = null;

        // Check for existing maintenance note related to this object
        $maintenanceNotes = $this->repository->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));

        if (0 < count($maintenanceNotes))
        {
          $this->maintenanceNote = $maintenanceNotes[0];
          $this->form->setDefault($name, $this->maintenanceNote->content);
        }
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;

      case 'identifier':
      case 'authorizedFormOfName':
      case 'descIdentifier':
      case 'descInstitutionIdentifier':
        $this->form->setDefault($name, $this->repository[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormInput);

        break;

      case 'history':
      case 'geoculturalContext':
      case 'mandates':
      case 'internalStructures':
      case 'collectingPolicies':
      case 'buildings':
      case 'holdings':
      case 'findingAids':
      case 'openingTimes':
      case 'accessConditions':
      case 'disabledAccess':
      case 'researchServices':
      case 'reproductionServices':
      case 'publicFacilities':
      case 'descRules':
      case 'descRevisionHistory':
      case 'descSources':
        $this->form->setDefault($name, $this->repository[$name]);
        $this->form->setValidator($name, new sfValidatorString);
        $this->form->setWidget($name, new sfWidgetFormTextarea);

        break;
    }
  }

  /**
   * Process form fields
   *
   * @param $field mixed symfony form widget
   * @return void
   */
  protected function processField($field)
  {
    switch ($name = $field->getName())
    {
      case 'types':
        $current = $new = array();
        foreach ($this->form->getValue('types') as $value)
        {
          $params = $this->context->routing->parse(Qubit::pathInfo($value));
          $current[$params['id']] = $new[$params['id']] = $params['id'];
        }

        foreach ($this->repoTypes as $otRelation)
        {
          if (isset($current[$otRelation->termId]))
          {
            // If it's current, then don't add/delete
            unset($new[$otRelation->termId]);
          }
          else
          {
            // If not in current list, then delete
            $otRelation->delete();
          }
        }

        // Create 'new' relations
        foreach ($new as $id)
        {
          $otRelation = new QubitObjectTermRelation;
          $otRelation->termId = $id;

          $this->repository->objectTermRelationsRelatedByobjectId[] = $otRelation;
        }

        break;

      case 'parallelName':
      case 'otherName':
        $defaults = $this->form->getWidget($name)->getOption('defaults');

        if (null !== $this->form->getValue($name))
        {
          foreach ($this->form->getValue($name) as $key => $thisName)
          {
            if ('new' == substr($key, 0, 3) && 0 < strlen(trim($thisName)))
            {
              $otherName = new QubitOtherName;

              if ('parallelName' == $name)
              {
                $otherName->typeId = QubitTerm::PARALLEL_FORM_OF_NAME_ID;
              }
              else
              {
                $otherName->typeId = QubitTerm::OTHER_FORM_OF_NAME_ID;
              }
            }
            else
            {
              $otherName = QubitOtherName::getById($key);
              if (null === $otherName)
              {
                continue;
              }

              // Don't delete this name
              unset($defaults[$key]);
            }

            $otherName->name = $thisName;
            $this->repository->otherNames[] = $otherName;
          }
        }

        // Delete any names that are missing from form data
        foreach ($defaults as $key => $val)
        {
          if (null !== ($otherName = QubitOtherName::getById($key)))
          {
            $otherName->delete();
          }
        }

        break;

      case 'descStatus':
      case 'descDetail':
        $params = $this->context->routing->parse(Qubit::pathInfo($this->form->getValue($name)));
        $fieldId = (isset($params['id'])) ? $params['id'] : null;
        $this->repository[$name.'Id'] = $fieldId;

        break;

      case 'maintenanceNotes':
        // Check for existing maintenance note related to this object
        $maintenanceNotes = $this->repository->getNotesByType(array('noteTypeId' => QubitTerm::MAINTENANCE_NOTE_ID));

        if (0 < count($maintenanceNotes))
        {
          $note = $maintenanceNotes[0];
        }
        else if (null !== $this->form->getValue($name))
        {
          // Create a maintenance note for this object if one doesn't exist
          $note = new QubitNote;
          $note->typeId = QubitTerm::MAINTENANCE_NOTE_ID;
        }
        else
        {

          break;
        }

        $note->content = $this->form->getValue($name);

        $this->repository->notes[] = $note;

        break;

      default:
        $this->repository[$field->getName()] = $this->form->getValue($field->getName());
    }
  }

  protected function processForm()
  {
    foreach ($this->form as $field)
    {
      $this->processField($field);
    }

    $this->repository->save();

    $this->updateContactInformation();
  }

  public function execute($request)
  {
    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    $this->repository = new QubitRepository;

    if (isset($request->id))
    {
      $this->repository = QubitRepository::getById($request->id);

      if (!isset($this->repository))
      {
        $this->forward404();
      }

      // Add optimistic lock
      $this->form->setDefault('serialNumber', $this->repository->serialNumber);
      $this->form->setValidator('serialNumber', new sfValidatorInteger);
      $this->form->setWidget('serialNumber', new sfWidgetFormInputHidden);
    }

    // HACK: Use static::$NAMES in PHP 5.3,
    // http://php.net/oop5.late-static-bindings
    $class = new ReflectionClass($this);
    foreach ($class->getStaticPropertyValue('NAMES') as $name)
    {
      $this->addField($name);
    }

    $this->contactInformation = $this->repository->getContactInformation();
    $this->newContactInformation = new QubitContactInformation;

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getPostParameters());

      if ($this->form->isValid())
      {
        $this->processForm();
        $this->redirect(array($this->repository, 'module' => 'repository'));
      }
    }
  }

  public function updateContactInformation()
  {
    if ($this->repository->getId())
    {
      if (($this->getRequestParameter('contact_type')) ||
      ($this->getRequestParameter('contact_person')) ||
      ($this->getRequestParameter('street_address')) ||
      ($this->getRequestParameter('city')) ||
      ($this->getRequestParameter('region')) ||
      ($this->getRequestParameter('country_code')) ||
      ($this->getRequestParameter('postal_code')) ||
      ($this->getRequestParameter('telephone')) ||
      ($this->getRequestParameter('fax')) ||
      ($this->getRequestParameter('email')) ||
      ($this->getRequestParameter('website')))
      {
        $contactInformation = new QubitContactInformation;
        $contactInformation->setActorId($this->repository->getId());
        $contactInformation->setContactType($this->getRequestParameter('contact_type'));
        $contactInformation->setPrimaryContact($this->getRequestParameter('primary_contact'));
        $contactInformation->setContactPerson($this->getRequestParameter('contact_person'));
        $contactInformation->setStreetAddress($this->getRequestParameter('street_address'));
        $contactInformation->setCity($this->getRequestParameter('city'));
        $contactInformation->setRegion($this->getRequestParameter('region'));
        $contactInformation->setCountryCode($this->getRequestParameter('country_code'));
        $contactInformation->setPostalCode($this->getRequestParameter('postal_code'));
        $contactInformation->setTelephone($this->getRequestParameter('telephone'));
        $contactInformation->setFax($this->getRequestParameter('fax'));
        $contactInformation->setEmail($this->getRequestParameter('email'));
        $contactInformation->setWebsite($this->getRequestParameter('website'));
        $contactInformation->setNote($this->getRequestParameter('contact_information_note'));

        $contactInformation->save();

        if ($contactInformation->getPrimaryContact())
        {
          $contactInformation->makePrimaryContact();
        }
      }
    }
  }
}
