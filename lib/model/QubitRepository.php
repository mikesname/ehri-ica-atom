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
 * @package    qubit
 * @subpackage repository
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @version    svn:$Id$
 */
class QubitRepository extends BaseRepository
{
  public function save($connection = null)
  {
    if (self::ROOT_ID != $this->id && !isset($this->parentId) && 'QubitRepository' == $this->className)
    {
      $this->parentId = self::ROOT_ID;
    }

    parent::save($connection);
  }

  /**
   * Save new link to a term.
   *
   * @param integer $termId QubitTerm primary key
   * @param string $relationNote DEPRECATED
   */
  public function setTermRelation($termId, $relationNote = null)
  {
    $newTermRelation = new QubitObjectTermRelation;
    $newTermRelation->setTermId($termId);

    //TODO: move to QubitNote
    //  $newTermRelation->setRelationNote($relationNote);
    $newTermRelation->setObjectId($this->id);
    $newTermRelation->save();
  }

  /**
   * Get many-to-many links to QubitTerm objects
   *
   * @param mixed $taxonomyId  Limit results by taxonomy type
   * @return QubitQuery collection of QubitObjectTermRelation objects
   */
  public function getTermRelations($taxonomyId = 'all')
  {
    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->id);

    if ($taxonomyId != 'all')
    {
      $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTERM::ID);
      $criteria->add(QubitTerm::TAXONOMY_ID, $taxonomyId);
    }

    return QubitObjectTermRelation::get($criteria);
  }

  /**
   * Create new related QubitNote
   *
   * @param integer $userId     QubitUser id
   * @param string  $note       Note text
   * @param integer $noteTypeId Type of note (QubitTerm pk)
   */
  public function setRepositoryNote($userId, $note, $noteTypeId)
  {
    $newNote = new QubitNote;
    $newNote->setObjectId($this->id);
    $newNote->setScope('QubitRepository');
    $newNote->setUserId($userId);
    $newNote->setContent($note);
    $newNote->setTypeId($noteTypeId);
    $newNote->save();
  }

  /**
   * Get related notes
   *
   * @return QubitQuery list of QubitNote objects
   */
  public function getRepositoryNotes()
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->id);
    $criteria->add(QubitNote::SCOPE, 'QubitRepository');
    QubitNote::addOrderByPreorder($criteria);

    return QubitNote::get($criteria);
  }

  /**
   * Get country of primary contact for repository (If one exists)
   *
   * @return string primary contact's country
   */
  public function getCountry()
  {
    if ($this->getCountryCode())
    {
      return format_country($this->getCountryCode());
    }
  }

  public function getCountryCode()
  {
    if ($this->getPrimaryContact())
    {
      if ($countryCode = $this->getPrimaryContact()->getCountryCode())
      {
        return $countryCode;
      }
    }
    if (count($contacts = $this->getContactInformation()) > 0)
    {
      foreach ($contacts as $contact)
        {
        if ($countryCode = $contact->getCountryCode())
        {
          return $countryCode;
        }
      }
    }
  }

  /**
   * Only find repository objects, not other actor types
   *
   * @param Criteria $criteria current search criteria
   * @return Criteria modified search critieria
   */
  public static function addGetOnlyRepositoryCriteria($criteria)
  {
    $criteria->addJoin(QubitRepository::ID, QubitObject::ID);
    $criteria->add(QubitObject::CLASS_NAME, 'QubitRepository');

    return $criteria;
  }

  public static function addCountryCodeCriteria($criteria, $countryCode)
  {
    if ($countryCode !== null)
    {
      $criteria->addJoin(QubitRepository::ID, QubitContactInformation::ACTOR_ID);
      $criteria->add(QubitContactInformation::PRIMARY_CONTACT, true);
      $criteria->add(QubitContactInformation::COUNTRY_CODE, $countryCode);
    }

    return $criteria;
  }

  /**
   * Return an options_for_select array
   *
   * @param mixed $default current selected value for select list
   * @param array $options optional parameters
   * @return array options_for_select compatible array
   */
  public static function getOptionsForSelectList($default, $options = array())
  {
    $repositories = self::getAll($options);

    foreach ($repositories as $repository)
    {
      // Don't display repositories with no name
      if ($name = $repository->getAuthorizedFormOfName($options))
      {
        $selectOptions[$repository->id] = $name;
      }
    }

    return options_for_select($selectOptions, $default, $options);
  }

  /**************
  Import methods
  ***************/

  public function setTypeByName($term)
  {
    // see if type term already exists
    $criteria = new Criteria;
    $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
    $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::REPOSITORY_TYPE_ID);
    $criteria->add(QubitTermI18n::NAME, $term);
    if ($existingTerm = QubitTerm::getOne($criteria))
    {
      $this->setTypeId($existingTerm->id);
    }
    else
    {
      $newTerm = new QubitTerm;
      $newTerm->setTaxonomyId(QubitTaxonomy::REPOSITORY_TYPE_ID);
      $newTerm->setName($term);
      $newTerm->save();
      $this->setTypeId($newTerm->id);
    }
  }
}
