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

  //ActorRole taxonomy
  const CREATOR_ID = 5;
  const CUSTODIAN_ID = 6;
  const PUBLISHER_ID = 7;
  const CONTRIBUTOR_ID = 8;
  const SUBJECT_ID = 9;
  const COLLECTOR_ID = 10;
  //EventType taxonomy
  const CREATION_ID = 11;
  const EXISTENCE_ID = 12;
  const CUSTODY_ID = 13;
  const PUBLICATION_ID = 14;
  const CONTRIBUTION_ID = 15;
  const SUBJECT_ACCESS_POINT_ID = 16;
  const COLLECTION_ID = 17;
  //NoteType taxonomy
  const TITLE_NOTE_ID = 25;
  const PUBLICATION_NOTE_ID = 26;
  const SOURCE_NOTE_ID = 27;
  const SCOPE_NOTE_ID = 28;
  //CollectionType taxonomy
  const ARCHIVAL_MATERIAL_ID = 29;
  const FINDING_AIDS_ID = 30;
  const PUBLISHED_MATERIAL_ID = 31;
  const ARTEFACT_MATERIAL_ID = 32;
  //ActorEntityType taxonomy
  const CORPORATE_BODY_ID = 33;
  const PERSON_ID = 34;
  const FAMILY_ID = 35;
  //OtherNameType taxonomy
  const FAMILY_NAME_FIRST_NAME_ID = 36;
  //MediaType taxonomy
  const AUDIO_ID = 37;
  const IMAGE_ID = 38;
  const TEXT_ID = 39;
  const VIDEO_ID = 40;
  const OTHER_ID = 41;
  //Digital Object Usage taxonomy
  const MASTER_ID = 42;
  const REFERENCE_ID = 43;
  const THUMBNAIL_ID = 44;
  //Physical Object Type taxonomy
  const LOCATION_ID = 45;
  const CONTAINER_ID = 46;
  const ARTEFACT_ID = 47;
  //Relation Type taxonomy
  const HAS_PHYSICAL_OBJECT_ID = 48;

  public function isProtected()
  {
    //The following terms cannot be edited by users because their values are used in application logic
    return $this->getId() == QubitTerm::CREATOR_ID ||
           $this->getId() == QubitTerm::CUSTODIAN_ID ||
           $this->getId() == QubitTerm::PUBLISHER_ID ||
           $this->getId() == QubitTerm::CONTRIBUTOR_ID ||
           $this->getId() == QubitTerm::CREATION_ID ||
           $this->getId() == QubitTerm::EXISTENCE_ID ||
           $this->getId() == QubitTerm::CUSTODY_ID ||
           $this->getId() == QubitTerm::PUBLICATION_ID ||
           $this->getId() == QubitTerm::CONTRIBUTION_ID ||
           $this->getId() == QubitTerm::TITLE_NOTE_ID ||
           $this->getId() == QubitTerm::PUBLICATION_NOTE_ID ||
           $this->getId() == QubitTerm::SOURCE_NOTE_ID ||
           $this->getId() == QubitTerm::SCOPE_NOTE_ID ||
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
  public static function getIndentedChildTree($parentTermId, $indentStr="&nbsp;")
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
   * Get a sorted, localized list of terms by taxonomy id for the "term/browse" action
   * with an option for culture fallback values in list.
   *
   * @param integer $taxonomyId
   * @param string $sort      sort criteria
   * @param string $language  preferred language for list values
   * @param array  $options   array of options
   * @return QubitQuery array of QubitTermI18n objects
   * 
   * @todo abstract fallback behaviour for general use in QubitQuery or lib/model
   * @todo investigate if Propel 1.3 supports sub-selects or complex joins so we can use standard Propel objects for fallback
   */
  public static function getBrowseList($taxonomyId = null, $options = array())
  {    
    $browseList = array();
    
    $language = (isset($options['language'])) ? $options['language'] : 'en';
    $sort = (isset($options['sort'])) ? $options['sort'] : 'termNameUp';
    $cultureFallback = (isset($options['cultureFallback'])) ? $options['cultureFallback'] : true;
    
    if ($cultureFallback === true)
    {
      
      $conn = Propel::getConnection(QubitTaxonomy::DATABASE_NAME);
      
      // Do fancy sub-select to get fallback values for terms that have not been translated to $language
      // NOTE: GROUP BY eliminates duplicate rows for final fallback value, and grabs random culture value 
      // but there may be a more elegant way to do this
      $fallbackSubSelect = "SELECT tbl.id,
        (CASE WHEN i1.name IS NOT NULL THEN i1.name WHEN i2.name IS NOT NULL THEN i2.name ELSE i3.name END) AS name,
        (CASE WHEN i1.name IS NOT NULL THEN i1.culture WHEN i2.name IS NOT NULL THEN i2.culture ELSE i3.culture END) AS culture
        FROM q_term tbl LEFT JOIN q_term_i18n i1 ON tbl.id = i1.id AND i1.culture = 'en'
        LEFT JOIN q_term_i18n i2 ON tbl.id = i2.id AND tbl.source_culture = i2.culture AND i2.culture <> 'en'
        LEFT JOIN q_term_i18n i3 ON tbl.id = i3.id AND tbl.source_culture <> i3.culture AND i3.culture <> 'en'
        GROUP BY tbl.id";
      
      // NOTE: selected columns must be in order of "name, id, culture" so
      // they are correctly matched with QubitTermI18n table columns in when
      // calling QubitQuery::createFromResultSet() below
      $sql = "SELECT fallback.name, ".QubitTerm::ID.", fallback.culture, COUNT(q_object_term_relation.term_id) as hits 
        FROM ".QubitTerm::TABLE_NAME."
        INNER JOIN  ($fallbackSubSelect) as fallback ON ".QubitTerm::ID." = fallback.id
        LEFT JOIN ".QubitObjectTermRelation::TABLE_NAME." ON ".QubitTerm::ID." = ".QubitObjectTermRelation::TERM_ID."
        WHERE ".QubitTerm::TAXONOMY_ID." = ".$taxonomyId."
        GROUP BY ".QubitObjectTermRelation::TERM_ID;
      
      // Sort results
      switch($sort)
      {
        case 'termNameDown' :
          $sql .= " ORDER BY name DESC";
          break;
        case 'hitsUp':
          $sql .= " ORDER BY hits ASC";
          break;
        case 'hitsDown':
          $sql .= " ORDER BY hits DESC";
          break;
        default:
          $sql .= " ORDER BY name ASC";
      }
      
      $stmt = $conn->prepareStatement($sql);
      $rs = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);
      $terms = QubitQuery::createFromResultSet($rs, 'QubitTermI18n');
    }
    else 
    {
      $criteria = new Criteria;
      $criteria->addAsColumn('hits', 'count('.QubitObjectTermRelation::TERM_ID.')');
      $criteria->addJoin(QubitTerm::ID, QubitTermI18n::ID);
      $criteria->add(QubitTermI18n::CULTURE, $language);
      $criteria->add(QubitTerm::TAXONOMY_ID, $taxonomyId);
      $criteria->addJoin(QubitTerm::ID, QubitObjectTermRelation::TERM_ID, Criteria::LEFT_JOIN);
      $criteria->addGroupByColumn(QubitObjectTermRelation::TERM_ID);
    
      switch($sort)
      {
        case 'termNameDown' :
          $criteria->addDescendingOrderByColumn(QubitTermI18n::NAME);
          break;
        case 'hitsUp' :
          $criteria->addAscendingOrderByColumn('hits');
          break;
        case 'hitsDown' :
          $criteria->addDescendingOrderByColumn('hits');
          break;
        default :
          $criteria->addAscendingOrderByColumn(QubitTermI18n::NAME);
      }
    
      $terms = QubitTerm::get($criteria);
    }


    // HACK: Loop through term list and count number of related IOs
    // TODO Hopefully this will be unnecessary with Propel 1.3
    foreach ($terms as $term)
    {
      $criteria = new Criteria;
      $criteria->add(QubitObjectTermRelation::TERM_ID, $term->getId());
      $hits = count(QubitObjectTermRelation::get($criteria));

      $browseList[] = array('termName' => $term->getName(), 'termId' => $term->getId(), 'hits' => $hits);
    }
  
    return $browseList;
  } 
  
}



