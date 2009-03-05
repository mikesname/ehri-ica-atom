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
    $newTermRelation->setObjectId($this->getId());
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
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->getId());

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
    $newNote->setObjectId($this->getId());
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
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
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
   * Get information objects in this repository.
   *
   * @return QubitQuery collection of QubitInformationObject objects
   */
  public function getRepositoryHoldings()
  {
    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::REPOSITORY_ID, $this->getId());
    $holdings = QubitInformationObject::get($criteria);

    return $holdings;
  }

  /**
   * Get a list of repositories.
   *
   * @param string $sort sort order (optional)
   * @param string $countryCode filter by two-letter country code (optional)
   * @return QubitQuery collection of QubitRepository objects
   *
   * @todo implement fallback
   */
  public static function addGetRepositoriesCriteria($criteria)
  {

  }

  public static function addCountryCodeCriteria($criteria, $countryCode)
  {
    if ($countryCode !== null)
    {
      $criteria->addJoin(QubitRepository::ID, QubitContactInformation::ACTOR_ID, Criteria::INNER_JOIN);
      $criteria->add(QubitContactInformation::PRIMARY_CONTACT, true);
      $criteria->add(QubitContactInformation::COUNTRY_CODE, $countryCode);
    }

    return $criteria;
  }


  public static function getList($culture, $options=array())
  {
    $criteria = new Criteria;

    $cultureFallback = (isset($options['cultureFallback'])) ? $options['cultureFallback'] : false;
    $sort = (isset($options['sort'])) ? $options['sort'] : 'nameUp';
    $page = (isset($options['page'])) ? $options['page'] : 1;

    if (isset($options['countryCode']))
    {
      $criteria = self::addCountryCodeCriteria($criteria, $options['countryCode']);
    }

    //Establish sort order
    switch($sort)
    {
      case 'typeDown' :
        $fallbackTable = 'QubitTerm';
        $criteria->addJoin(QubitRepository::TYPE_ID, QubitTerm::ID, Criteria::INNER_JOIN);
        $criteria->addDescendingOrderByColumn('name');
        break;
      case 'typeUp' :
        $fallbackTable = 'QubitTerm';
        $criteria->addJoin(QubitRepository::TYPE_ID, QubitTerm::ID, Criteria::INNER_JOIN);
        $criteria->addAscendingOrderByColumn('name');
        break;

      /*
       * Can't sort on country "name" currently because it's a lookup value
       * on country *code* (key) with the *name* being returned from
       * symfony's sfCultureInfo data files.
       *
      case 'countryDown' :
        $fallbackTable = 'QubitContactInformation';
        $criteria->addJoin(QubitRepository::ID, QubitContactInformation::ACTOR_ID.' AND '.QubitContactInformation::PRIMARY_CONTACT.'=1', Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('country_code');
        break;
      case 'countryUp' :
        $fallbackTable = 'QubitContactInformation';
        $criteria->addJoin(QubitRepository::ID, QubitContactInformation::ACTOR_ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('country_code');
        break;
      */
      case 'nameDown' :
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitRepository::ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addDescendingOrderByColumn('authorized_form_of_name');
        break;
      case 'nameUp' :
      default :
        $fallbackTable = 'QubitActor';
        $criteria->addJoin(QubitRepository::ID, QubitActor::ID, Criteria::LEFT_JOIN);
        $criteria->addAscendingOrderByColumn('authorized_form_of_name');
    }

    // Do source culture fallback
    if ($cultureFallback === true)
    {
      // Return a QubitQuery object of class-type QubitInformationObject
      $options = array('returnClass'=>'QubitRepository');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, $fallbackTable, $culture, $options);
    }
    else
    {
      // Do straight joins without fallback
    }

    // Page results
    $pager = new QubitPager('QubitRepository');
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();

    return $pager;
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
        $selectOptions[$repository->getId()] = $name;
      }
    }

    return options_for_select($selectOptions, $default, $options);
  }
}