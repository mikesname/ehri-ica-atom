<?php

/*
 * This file is part of the Qubit Toolkit.
 * Copyright (C) 2006-2008 Peter Van Garderen <peter@artefactual.com>
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 51
 * Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

class QubitTerm extends BaseTerm
{
  //The following Term Ids are assigned constant values because they are used
  //in application code and can't rely on database id values, since these could be changed

  //EventType taxonomy
  const CREATION_ID = 111;
  const SUBJECT_ID = 112;
  const CUSTODY_ID = 113;
  const PUBLICATION_ID = 114;
  const CONTRIBUTION_ID = 115;
  const COLLECTION_ID = 117;
  const ACCUMULATION_ID = 118;
  //NoteType taxonomy
  const TITLE_NOTE_ID = 119;
  const PUBLICATION_NOTE_ID = 120;
  const SOURCE_NOTE_ID = 121;
  const SCOPE_NOTE_ID = 122;
  const DISPLAY_NOTE_ID = 123;
  //CollectionType taxonomy
  const ARCHIVAL_MATERIAL_ID = 124;
  const FINDING_AIDS_ID = 125;
  const PUBLISHED_MATERIAL_ID = 126;
  const ARTEFACT_MATERIAL_ID = 127;
  //ActorEntityType taxonomy
  const CORPORATE_BODY_ID = 128;
  const PERSON_ID = 129;
  const FAMILY_ID = 130;
  //OtherNameType taxonomy
  const FAMILY_NAME_FIRST_NAME_ID = 131;
  //MediaType taxonomy
  const AUDIO_ID = 132;
  const IMAGE_ID = 133;
  const TEXT_ID = 134;
  const VIDEO_ID = 135;
  const OTHER_ID = 136;
  //Digital Object Usage taxonomy
  const MASTER_ID = 137;
  const REFERENCE_ID = 138;
  const THUMBNAIL_ID = 139;
  //Physical Object Type taxonomy
  const LOCATION_ID = 140;
  const CONTAINER_ID = 141;
  const ARTEFACT_ID = 142;
  //Relation Type taxonomy
  const HAS_PHYSICAL_OBJECT_ID = 143;


  public function isProtected()
  {
    //The following terms cannot be edited by users because their values are used in application logic
    return $this->getId() == QubitTerm::CREATION_ID ||
           $this->getId() == QubitTerm::SUBJECT_ID ||
           $this->getId() == QubitTerm::CUSTODY_ID ||
           $this->getId() == QubitTerm::PUBLICATION_ID ||
           $this->getId() == QubitTerm::CONTRIBUTION_ID ||
           $this->getId() == QubitTerm::COLLECTION_ID ||
           $this->getId() == QubitTerm::ACCUMULATION_ID ||
           $this->getId() == QubitTerm::TITLE_NOTE_ID ||
           $this->getId() == QubitTerm::PUBLICATION_NOTE_ID ||
           $this->getId() == QubitTerm::SOURCE_NOTE_ID ||
           $this->getId() == QubitTerm::SCOPE_NOTE_ID ||
           $this->getId() == QubitTerm::DISPLAY_NOTE_ID ||
           $this->getId() == QubitTerm::ARCHIVAL_MATERIAL_ID ||
           $this->getId() == QubitTerm::FINDING_AIDS_ID ||
           $this->getId() == QubitTerm::PUBLISHED_MATERIAL_ID ||
           $this->getId() == QubitTerm::ARTEFACT_MATERIAL_ID ||
           $this->getId() == QubitTerm::CORPORATE_BODY_ID ||
           $this->getId() == QubitTerm::PERSON_ID ||
           $this->getId() == QubitTerm::FAMILY_ID ||
           $this->getId() == QubitTerm::FAMILY_NAME_FIRST_NAME_ID ||
           $this->getId() == QubitTerm::AUDIO_ID ||
           $this->getId() == QubitTerm::IMAGE_ID ||
           $this->getId() == QubitTerm::TEXT_ID ||
           $this->getId() == QubitTerm::VIDEO_ID ||
           $this->getId() == QubitTerm::OTHER_ID ||
           $this->getId() == QubitTerm::MASTER_ID ||
           $this->getId() == QubitTerm::REFERENCE_ID ||
           $this->getId() == QubitTerm::THUMBNAIL_ID ||
           $this->getId() == QubitTerm::LOCATION_ID ||
           $this->getId() == QubitTerm::CONTAINER_ID ||
           $this->getId() == QubitTerm::ARTEFACT_ID ||
           $this->getId() == QubitTerm::HAS_PHYSICAL_OBJECT_ID;
  }


  public function __toString()
  {
    if (!$this->getName())
      {
      return (string) $this->getName(array('sourceCulture' => true));
      }

    return (string) $this->getName();
  }


  public function setNote($userId, $note, $noteTypeId)
  {
    $newNote = new QubitNote;
    $newNote->setObjectId($this->getId());
    $newNote->setScope('QubitTerm');
    $newNote->setUserId($userId);
    $newNote->setContent($note);
    $newNote->setTypeId($noteTypeId);
    $newNote->save();
  }

  public function getNotesByType($noteTypeId = null, $excludeNoteTypeId = null)
  {
    $criteria = new Criteria;
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);
    $criteria->add(QubitNote::OBJECT_ID, $this->getId());
    if ($noteTypeId)
      {
      $criteria->add(QubitNote::TYPE_ID, $noteTypeId);
      }
    if ($excludeNoteTypeId)
      {
      $criteria->add(QubitNote::TYPE_ID, $excludeNoteTypeId, Criteria::NOT_EQUAL);
      }

    return QubitNote::get($criteria);
  }

  public function getRole()
  {
    $notes = $this->getNotesByType($noteTypeId = QubitTerm::DISPLAY_NOTE_ID);

    if (count($notes) > 0)
    {

      return $notes[0]->getContent($options = array('cultureFallback' => true));
    }
    else
    {

      return $this->getName();
    }
  }

  public static function getLevelsOfDescription($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID, $options);
  }

  public static function getNoteTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::NOTE_TYPE_ID, $options);
  }

  public static function getSubjects($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::SUBJECT_ID, $options);
  }

  public static function getPlaces($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::PLACE_ID, $options);
  }

  public static function getActorEntityTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_ENTITY_TYPE_ID, $options);
  }

  public static function getActorNameTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_NAME_TYPE_ID, $options);
  }

  public static function getDescriptionStatuses($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_STATUS_ID, $options);
  }

  public static function getDescriptionDetailLevels($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::DESCRIPTION_DETAIL_LEVEL_ID, $options);
  }

  public static function getRepositoryTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::REPOSITORY_TYPE_ID, $options);
  }

  public static function getActorRoles($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::ACTOR_ROLE_ID, $options);
  }

  public static function getEventTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::EVENT_TYPE_ID, $options);
  }

  public static function getMediaTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::MEDIA_TYPE_ID, $options);
  }

  public static function getUsageTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::DIGITAL_OBJECT_USAGE_ID, $options);
  }

  public static function getMaterialTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::MATERIAL_TYPE_ID, $options);
  }

  public static function getRADNotes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::RAD_NOTE_ID, $options);
  }

  public static function getRADTitleNotes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::RAD_TITLE_NOTE_ID, $options);
  }

  /**
   * Return a list of all Physical Object terms
   *
   * @param array $options  option array to pass to Qubit Query object
   * @return QubitQuery array of Physical Object QubitTerm objects
   */
  public static function getPhysicalObjectTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::PHYSICAL_OBJECT_TYPE_ID, $options);
  }


  /**
   * Return a list of all Relation Type terms
   *
   * @param array $options  option array to pass to Qubit Query object
   * @return QubitQuery object
   */
  public static function getRelationTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::RELATION_TYPE_ID, $options);
  }


  /**
   * Return a list of all Physical object container types
   *
   * @return QubitQuery array of container QubitTerm objects
   */
  public static function getPhysicalObjectContainerTypes()
  {
    $containerTerm = QubitTerm::getById(QubitTerm::CONTAINER_ID);
    return $containerTerm->getDescendants();
  }


  /**
   * Get a list of child terms of $parentTermId. Prefix $indentStr * depth of child
   * relative to parent
   *
   * @param integer $parentTermId  Primary key of parent term
   * @param string  $indentStr     String to prefix to each sub-level for indenting
   *
   * @return mixed  false on failure, else array of children formatted for select box
   */
  public static function getIndentedChildTree($parentTermId, $indentStr='&nbsp;')
  {
    if (!$parentTerm = QubitTerm::getById($parentTermId))
    {

      return false;
    }

    $parentDepth = count($parentTerm->getAncestors());

    foreach ($parentTerm->getDescendants()->orderBy('lft') as $i => $node)
    {
      $relativeDepth = intval(count($node->getAncestors()) - $parentDepth - 1);
      $tree[$node->getId()] = str_repeat($indentStr, $relativeDepth).$node->getName(array('cultureFallback' => 'true'));
    }

    return $tree;
  }


  protected $CountryHitCount = null;
  protected $LanguageHitCount = null;
  protected $SubjectHitCount = null;

  public function setCountryHitCount($count)
  {
    $this->CountryHitCount = $count;
  }

  public function getCountryHitCount()
  {
    return $this->CountryHitCount;
  }

  public function setLanguageHitCount($count)
  {
    $this->LanguageHitCount = $count;
  }

  public function getLanguageHitCount()
  {
    return $this->LanguageHitCount;
  }

  public function setSubjectHitCount($count)
  {
    $this->SubjectHitCount = $count;
  }

  public function getSubjectHitCount()
  {
    return $this->SubjectHitCount;
  }

  /**
   * Get a sorted, localized list of terms for the"term/browse" action
   * with an option for culture fallback values in list.
   *
   * @param string   $culture localize list for $culture
   * @param Criteria $criteria Propel criteria object
   * @param array    $options array of additonal options
   * @return QubitQuery array of QubitTermI18n objects
   */
  public static function getBrowseList($culture, $criteria, $options = array())
  {
    $sort = (isset($options['sort'])) ? $options['sort'] : 'termNameUp';
    $cultureFallback = (isset($options['cultureFallback'])) ? $options['cultureFallback'] : false;

    if (isset($options['taxonomyId']))
    {
      $criteria->add(QubitTerm::TAXONOMY_ID, $options['taxonomyId']);
    }

    // Add join to get count of related objects
    $criteria->addJoin(QubitTerm::ID, QubitObjectTermRelation::TERM_ID, Criteria::LEFT_JOIN);
    $criteria->addAsColumn('hits', 'COUNT('.QubitObjectTermRelation::OBJECT_ID.')');
    $criteria->addGroupByColumn(QubitObjectTermRelation::TERM_ID);

    switch($sort)
    {
      case 'hitsUp' :
        $criteria->addAscendingOrderByColumn('hits');
        break;
      case 'hitsDown' :
        $criteria->addDescendingOrderByColumn('hits');
        break;
      case 'termNameDown' :
        $criteria->addDescendingOrderByColumn('name');
        break;
      case 'termNameUp' :
      default :
        $criteria->addAscendingOrderByColumn('name');
    }

    // Do source culture fallback
    if ($cultureFallback === true)
    {
      // Add Fallback criteria
      $options = array();
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $culture, $options);
    }
    else
    {
      // Do straight joins without fallback
      $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
      $criteria->add(QubitTermI18n::CULTURE, $culture);
    }

    return QubitTerm::get($criteria);
  }

  /**
   * Get a count of objects related to this term
   *
   * @return integer related object count
   */
  public function getRelatedObjectCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitObjectTermRelation::TABLE_NAME.'
      WHERE '.QubitObjectTermRelation::TERM_ID.' = '.$this->getId().';';

    $conn = Propel::getConnection();
    $stmt = $conn->prepareStatement($sql);
    $rs = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);
    $rs->next();

    return $rs->getInt(1);
  }

  /** Get a basic key['id']/value['name'] array for use as options in form select lists
   *
   */

  public static function getOptionsForSelectList($taxonomyId, $options = array())
  {
    $context = sfContext::getInstance();
    $culture = $context->getUser()->getCulture();

    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, $taxonomyId);
    $criteria->addAscendingOrderByColumn('name');
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $culture, $options);
    $terms = QubitTerm::get($criteria);

    $selectList = array();
    if (isset($options['include_blank']))
    {
      $selectList[null] = '';
    }
    foreach ($terms as $term)
    {
      $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));
    }

    return $selectList;
  }

}



