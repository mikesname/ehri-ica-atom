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

class SearchAdvancedAction extends SearchIndexAction
{
  public static
    $NAMES = array(
      'searchFields',
      'repository',
      'mediatype',
      'hasDigitalObject'
    );

  public function execute($request)
  {
    if ('print' == $request->getGetParameter('media'))
    {
      $this->getResponse()->addStylesheet('print-preview', 'last');
    }

    $this->form = new sfForm;
    $this->form->getValidatorSchema()->setOption('allow_extra_fields', true);

    foreach ($this::$NAMES as $name)
    {
      $this->addField($name);
    }

    $this->form->bind($request->getRequestParameters() + $request->getGetParameters() + $request->getPostParameters());

    if ($this->form->isValid())
    {
      if (isset($request->searchFields)) {
        $this->queryTerms = array();

        // we are handling a search request
        parent::execute($request);
      }
    }

  }

  protected function addField($name)
  {
    switch ($name)
    {
      case 'searchFields':
        
        break;

      case 'repository':
        // Get list of repositories
        $criteria = new Criteria;

        // Do source culture fallback
        $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitActor');

        $criteria->addAscendingOrderByColumn('authorized_form_of_name');

        $choices = array('' => '');
        foreach (QubitRepository::get($criteria) as $repository) {
          $choices[$repository->id] = $repository;
        }

        $this->form->setValidator($name, new sfValidatorChoice(array('choices' => array_keys($choices))));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices), array('style' => 'min-width: 50%; width: auto')));

        break;

      case 'mediatype':
        // Get list of media types
        $criteria = new Criteria;
        $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::MATERIAL_TYPE_ID);

        // Do source culture fallback
        $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');

        $criteria->addAscendingOrderByColumn('name');

        $choices = array('' => '');
        foreach (QubitTerm::get($criteria) as $mediatype) {
          $choices[$mediatype->id] = $mediatype;
        }

        $this->form->setValidator($name, new sfValidatorChoice(array('choices' => array_keys($choices))));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices), array('style' => 'width: auto')));

        break;

      case 'hasDigitalObject':
        $choices = array(
          '' => '',
          'true' => 'Yes',
          'false' => 'No'
        );

        $this->form->setValidator($name, new sfValidatorChoice(array('choices' => array_keys($choices))));
        $this->form->setWidget($name, new sfWidgetFormSelect(array('choices' => $choices), array('style' => 'width: auto')));

        break;
    }
  }

  public function parseQuery()
  {

    QubitSearch::getInstance();
    $queryBuilt = new Zend_Search_Lucene_Search_Query_Boolean();

    foreach ($this->request->searchFields as $searchField)
    {
      // if no terms for this field, skip it
      if (empty($searchField['query']))
      {
        continue;
      }

      // enclose phrase searches in quotes (strip existing ones)
      if ('phrase' == $searchField['match'])
      {
        $term = '"'.str_replace(array('"', "'"), '', strtolower($searchField['query'])).'"';
      }
      else
      {
        $term = strtolower($searchField['query']);
      }

      $matchString = $term;

      // limit to specified field
      if (!empty($searchField['field']))
      {
        $term = $searchField['field'] . ':' . $term;
      }

      if (!empty($searchField['field']))
      {
        $field = ucfirst($searchField['field']);
      }
      else
      {
        $field = ('phrase' == $searchField['match']) ? $this->getContext()->i18n->__('Phrase') : $this->getContext()->i18n->__('Keyword(s)');
      }

      $this->queryTerms[] = array('term' => $field.': '.$matchString, 'operator' => $searchField['operator']);

      // select which boolean operator to use
      if (!isset($searchField['operator'])) $searchField['operator'] = null;
      switch ($searchField['operator'])
      {
        case 'not':
          $token = false;
          break;

        case 'or':
          $token = null;
          break;

        case 'and':
        default:
          $token = true;
          break;
      }

      $queryBuilt->addSubquery(QubitSearch::getInstance()->parse($term), $token);
    }

    $query = new Zend_Search_Lucene_Search_Query_Boolean();
    $query->addSubquery($queryBuilt, true);

    return $query;
  }

  public function filterQuery($query)
  {
    // limit to a repository if selected
    if (!empty($this->request->repository))
    {
      $query->addSubquery(QubitSearch::getInstance()->addTerm($this->request->repository, 'repositoryId'), true);
      $this->queryTerms[] = array('term' => $this->getContext()->i18n->__('Repository').': '.QubitRepository::getById($this->request->repository)->__toString(), 'operator' => 'and');
    }

    // digital object filters
    if ('true' == $this->request->hasDigitalObject)
    {
      $query->addSubquery(QubitSearch::getInstance()->addTerm('true', 'hasDigitalObject'), true);
      $this->queryTerms[] = array('term' => $this->getContext()->i18n->__('Digital object is available'), 'operator' => 'and');
    }
    else if ('false' == $this->request->hasDigitalObject)
    {
      $query->addSubquery(QubitSearch::getInstance()->addTerm('false', 'hasDigitalObject'), true);
      $this->queryTerms[] = array('term' => $this->getContext()->i18n->__('No digital object is available'), 'operator' => 'and');
    }

    if (!empty($this->request->mediatype))
    {
      $query->addSubquery(QubitSearch::getInstance()->addTerm($this->request->mediatype, 'do_mediaTypeId'), true);
      $this->queryTerms[] = array('term' => 'mediatype: '.QubitTerm::getById($this->request->mediatyp)->__toString(), 'operator' => 'and');
    }

    $query = parent::filterQuery($query);

    return $query;
  }
}
