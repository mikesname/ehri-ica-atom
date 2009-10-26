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
 * Extend functionality of propel generated "BaseTerm" model class.
 *
 * @package    qubit
 * @subpackage model
 * @author     Peter Van Garderen <peter@artefactual.com>
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
 */
class QubitTerm extends BaseTerm
{
  //The following Term Ids are assigned constant values because they are used
  //in application code and can't rely on database id values, since these could be changed

  // ROOT term id
  const ROOT_ID = 110;

  //EventType taxonomy
  const CREATION_ID = 111;
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
  const ARCHIVIST_NOTE_ID = 124;
  const GENERAL_NOTE_ID = 125;
  const OTHER_DESCRIPTIVE_DATA_ID = 126;
  const MAINTENANCE_NOTE_ID = 127;
  //CollectionType taxonomy
  const ARCHIVAL_MATERIAL_ID = 128;
  const PUBLISHED_MATERIAL_ID = 129;
  const ARTEFACT_MATERIAL_ID = 130;
  //ActorEntityType taxonomy
  const CORPORATE_BODY_ID = 131;
  const PERSON_ID = 132;
  const FAMILY_ID = 133;
  //OtherNameType taxonomy
  const FAMILY_NAME_FIRST_NAME_ID = 134;
  //MediaType taxonomy
  const AUDIO_ID = 135;
  const IMAGE_ID = 136;
  const TEXT_ID = 137;
  const VIDEO_ID = 138;
  const OTHER_ID = 139;
  //Digital Object Usage taxonomy
  const MASTER_ID = 140;
  const REFERENCE_ID = 141;
  const THUMBNAIL_ID = 142;
  const COMPOUND_ID = 143;
  //Physical Object Type taxonomy
  const LOCATION_ID = 144;
  const CONTAINER_ID = 145;
  const ARTEFACT_ID = 146;
  //Relation Type taxonomy
  const HAS_PHYSICAL_OBJECT_ID = 147;
  //Actor name type taxonomy
  const PARALLEL_FORM_OF_NAME_ID = 148;
  const OTHER_FORM_OF_NAME_ID = 149;
  //Actor relation type taxonomy
  const HIERARCHICAL_RELATION_ID = 150;
  const TEMPORAL_RELATION_ID = 151;
  const FAMILY_RELATION_ID = 152;
  const ASSOCIATIVE_RELATION_ID = 153;
  // Actor relation note taxonomy
  const RELATION_NOTE_DESCRIPTION_ID = 154;
  const RELATION_NOTE_DATE_DISPLAY_ID = 155;
  // Term relation taxonomy
  const TERM_RELATION_EQUIVALENCE_ID = 156;
  const TERM_RELATION_ASSOCIATIVE_ID = 157;
  // Status types taxonomy
  const STATUS_TYPE_PUBLICATION_ID = 158;
  // Publication status taxonomy
  const PUBLICATION_STATUS_DRAFT_ID = 159;
  const PUBLICATION_STATUS_PUBLISHED_ID = 160;
  // Name access point
  const NAME_ACCESS_POINT_ID = 161;

  public function isProtected()
  {
    //The following terms cannot be edited by users because their values are used in application logic
    return $this->getId() == QubitTerm::ROOT_ID ||
    $this->getId() == QubitTerm::CREATION_ID ||
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
    $this->getId() == QubitTerm::ARCHIVIST_NOTE_ID ||
    $this->getId() == QubitTerm::GENERAL_NOTE_ID ||
    $this->getId() == QubitTerm::OTHER_DESCRIPTIVE_DATA_ID ||
    $this->getId() == QubitTerm::MAINTENANCE_NOTE_ID ||
    $this->getId() == QubitTerm::ARCHIVAL_MATERIAL_ID ||
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
    $this->getId() == QubitTerm::COMPOUND_ID ||
    $this->getId() == QubitTerm::LOCATION_ID ||
    $this->getId() == QubitTerm::CONTAINER_ID ||
    $this->getId() == QubitTerm::ARTEFACT_ID ||
    $this->getId() == QubitTerm::HAS_PHYSICAL_OBJECT_ID ||
    $this->getId() == QubitTerm::PARALLEL_FORM_OF_NAME_ID ||
    $this->getId() == QubitTerm::OTHER_FORM_OF_NAME_ID ||
    $this->getId() == QubitTerm::HIERARCHICAL_RELATION_ID ||
    $this->getId() == QubitTerm::TEMPORAL_RELATION_ID ||
    $this->getId() == QubitTerm::FAMILY_RELATION_ID ||
    $this->getId() == QubitTerm::ASSOCIATIVE_RELATION_ID ||
    $this->getId() == QubitTerm::RELATION_NOTE_DESCRIPTION_ID ||
    $this->getId() == QubitTerm::RELATION_NOTE_DATE_DISPLAY_ID ||
    $this->getId() == QubitTerm::TERM_RELATION_EQUIVALENCE_ID ||
    $this->getId() == QubitTerm::TERM_RELATION_ASSOCIATIVE_ID ||
    $this->getId() == QubitTerm::STATUS_TYPE_PUBLICATION_ID ||
    $this->getId() == QubitTerm::PUBLICATION_STATUS_DRAFT_ID ||
    $this->getId() == QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID ||
    $this->getId() == QubitTerm::NAME_ACCESS_POINT_ID;
  }

  public function __toString()
  {
    if (!$this->getName())
    {
      return (string) $this->getName(array('sourceCulture' => true));
    }

    return (string) $this->getName();
  }

  public function setRoot()
  {
    $this->setParentId(QubitTerm::ROOT_ID);
  }

  public function delete($connection = null)
  {
    // Cascade delete descendants
    if (0 < count($children = $this->getChildren()))
    {
      foreach ($children as $child)
      {
        $child->delete($connection);
      }
    }

    // Delete relations
    $criteria = new Criteria;
    $cton1 = $criteria->getNewCriterion(QubitRelation::OBJECT_ID, $this->id, Criteria::EQUAL);
    $cton2 = $criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $this->id, Criteria::EQUAL);
    $cton1->addOr($cton2);
    $criteria->add($cton1);

    if (0 < count($relations = QubitRelation::get($criteria)))
    {
      foreach ($relations as $relation)
      {
        $relation->delete($connection);
      }
    }

    // Delete relation to objects
    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::TERM_ID, $this->id, Criteria::EQUAL);

    if (0 < count($otRelations = QubitObjectTermRelation::get($criteria)))
    {
      foreach ($otRelations as $otRelation)
      {
        $otRelation->delete($connection);
      }
    }

    parent::delete($connection);
  }

  public function getRole()
  {
    $notes = $this->getNotesByType($options = array('noteTypeId' => QubitTerm::DISPLAY_NOTE_ID));

    if (count($notes) > 0)
    {

      return $notes[0]->getContent($options = array('cultureFallback' => true));
    }
    else
    {

      return $this->getName();
    }
  }

  public static function getCollectionTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::COLLECTION_TYPE_ID, $options);
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

  public static function getModsTitleTypes($options = array())
  {
    return QubitTaxonomy::getTermsById(QubitTaxonomy::MODS_TITLE_TYPE_ID, $options);
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
   * Get an aggregate count of all objects related to this term
   *
   * @return integer count of related objects
   */
  public function getRelatedObjectCount()
  {
    $count = 0;
    $count += $this->getRelatedActorCount();
    $count += $this->getRelatedActorNameCount();
    $count += $this->getRelatedDigitalObjectCount();
    $count += $this->getRelatedEventCount();
    $count += $this->getRelatedInfoObjectCount();
    $count += $this->getRelatedNoteCount();
    $count += $this->getRelatedObjectTermRelationCount();
    $count += $this->getRelatedPhysicalObjectCount();
    $count += $this->getRelatedRepositoryCount();

    return $count;
  }

  protected static function executeCount($sql)
  {
    $conn = Propel::getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if (count($row = $stmt->fetch()))
    {

      return intval($row[0]);
    }

    return 0;
  }

  /**
   * Count the number of actors that use this term
   *
   * @return integer number of related actors
   */
  public function getRelatedActorCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitActor::TABLE_NAME;
    $sql .= ' INNER JOIN '.QubitObject::TABLE_NAME.' ON '.QubitActor::ID.' = '.QubitObject::ID;
    $sql .= ' WHERE '.QubitObject::CLASS_NAME.' = \'QubitActor\'';
    $sql .= ' AND ('.QubitActor::DESCRIPTION_DETAIL_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitActor::DESCRIPTION_DETAIL_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitActor::ENTITY_TYPE_ID.' = '.$this->getId().')';

    return self::executeCount($sql);
  }

  /**
   * Count the number of actor names that use this term
   * (taxonomy.id = ACTOR_NAME_TYPE_ID)
   *
   * @return integer number of related actor_names
   */
  public function getRelatedActorNameCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitActorName::TABLE_NAME;
    $sql .= ' WHERE '.QubitActorName::TYPE_ID.' = '.$this->getId();

    return self::executeCount($sql);
  }

  /**
   * Count the number of digital objects that use this term
   *
   * @return integer number of related digital objects
   */
  public function getRelatedDigitalObjectCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitDigitalObject::TABLE_NAME;
    $sql .= ' WHERE '.QubitDigitalObject::USAGE_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitDigitalObject::MEDIA_TYPE_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitDigitalObject::CHECKSUM_TYPE_ID.' = '.$this->getId();

    return self::executeCount($sql);
  }

  /**
   * Count the number of events that use this term
   * (taxonomy.id = EVENT_TYPE_ID)
   *
   * @return integer number of related events
   */
  public function getRelatedEventCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitEvent::TABLE_NAME;
    $sql .= ' WHERE '.QubitEvent::TYPE_ID.' = '.$this->getId();

    return self::executeCount($sql);
  }

  /**
   * Count the number of information objects that use this term
   *
   * @return integer number of related information objects
   */
  public function getRelatedInfoObjectCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitInformationObject::TABLE_NAME;
    $sql .= ' WHERE '.QubitInformationObject::DESCRIPTION_STATUS_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitInformationObject::DESCRIPTION_DETAIL_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitInformationObject::LEVEL_OF_DESCRIPTION_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitInformationObject::COLLECTION_TYPE_ID.' = '.$this->getId();

    return self::executeCount($sql);
  }

  /**
   * Get a count of notes that use this term
   *
   * @return integer number of related notes
   */
  public function getRelatedNoteCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitNote::TABLE_NAME.'
      WHERE '.QubitNote::TYPE_ID.' = '.$this->getId().';';

    return self::executeCount($sql);
  }

  /**
   * Get a count of object_term_relation records that use this term
   *
   * @return integer related object count
   */
  public function getRelatedObjectTermRelationCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitObjectTermRelation::TABLE_NAME.'
      WHERE '.QubitObjectTermRelation::TERM_ID.' = '.$this->getId().';';

    return self::executeCount($sql);
  }

  /**
   * Count the number of physical objects that use this term
   * (taxonomy.id = PHYSICAL_OBJECT_TYPE_ID)
   *
   * @return integer number of related physical objects
   */
  public function getRelatedPhysicalObjectCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitPhysicalObject::TABLE_NAME;
    $sql .= ' WHERE '.QubitPhysicalObject::TYPE_ID.' = '.$this->getId();

    return self::executeCount($sql);
  }

  /**
   * Count the number of repositories that use this term
   *
   * @return integer number of related repositories
   */
  public function getRelatedRepositoryCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitRepository::TABLE_NAME;
    $sql .= ' WHERE '.QubitRepository::DESC_DETAIL_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitRepository::DESC_STATUS_ID.' = '.$this->getId();
    $sql .= ' OR '.QubitRepository::TYPE_ID.' = '.$this->getId();

    return self::executeCount($sql);
  }

  /**
   * Get a count of objects related via q_object_term_relation that have a
   * class_name = $objectClassName (i.e. only 'QubitInformationObject's)
   *
   * @param string $objectClassName related object class_name column value
   * @return integer count of related object.
   */
  public function getObjectTermRelationCountByObjectClass($objectClassName)
  {
    $sql  = 'SELECT COUNT(*) FROM '.QubitTerm::TABLE_NAME;
    $sql .= ' INNER JOIN '.QubitObjectTermRelation::TABLE_NAME.' ON ('.QubitTerm::ID.'='.QubitObjectTermRelation::TERM_ID.')';
    $sql .= ' INNER JOIN '.QubitObject::TABLE_NAME.' ON ('.QubitObjectTermRelation::OBJECT_ID.'='.QubitObject::ID.')';
    $sql .= ' WHERE '.QubitObject::CLASS_NAME.' = :p1 AND '.QubitTerm::ID.' = :p2';

    $conn = Propel::getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':p1', $objectClassName);
    $stmt->bindValue(':p2', $this->getId());
    $stmt->execute();

    $count = (count($row = $stmt->fetch())) ? $count = intval($row[0]) : 0;

    return $count;
  }

  /**
   * Get a basic key['id']/value['name'] array for use as options in form
   * select lists
   *
   * @param integer $taxonomyId parent taxonomy id
   * @param array $options optional paramters
   * @return array select box options
   */
  public static function getOptionsForSelectList($taxonomyId, $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitTerm::TAXONOMY_ID, $taxonomyId);

    // Exclude specified term
    if (isset($options['exclude']))
    {
      // Turn string into a single entity array
      $excludes = (is_array($options['exclude'])) ? $options['exclude'] : array($options['exclude']);

      foreach ($excludes as $exclude)
      {
        $criteria->addAnd(QubitTerm::ID, $exclude, Criteria::NOT_EQUAL);
      }
    }

    $criteria->addAscendingOrderByColumn('name');
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $options);
    $terms = QubitTerm::get($criteria);

    $selectList = array();
    if (isset($options['include_blank']))
    {
      $selectList[null] = '';
    }
    foreach ($terms as $term)
    {
      $displayValue = $term->getName(array('cultureFallback'=>true));

      // Display note content instead of term name - used mainly for displaying
      // event type actor vs. action (e.g. "creator" vs. "creation")
      if (isset($options['displayNote']) && $options['displayNote'] == true)
      {
        if (count($notes = $term->getNotesByType(QubitTerm::DISPLAY_NOTE_ID)))
        {
          $displayValue = $notes[0]->getContent(array('cultureFallback'=>true));
        }
      }

      $selectList[$term->getId()] = $displayValue;
    }

    return $selectList;
  }

    /**
   * Get a basic key['id']/value['name'] array for use as options in the Event Type
   * select list on the Dublin Core edit template
   *
   * @param integer $taxonomyId parent taxonomy id
   * @param array $options optional paramters
   * @return array select box options
   */
  public static function getDcEventTypeList($options = array())
  {
    $selectList = array();
    $term = QubitTerm::getById(QubitTerm::CREATION_ID);
    $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));
    $term = QubitTerm::getById(QubitTerm::PUBLICATION_ID);
    $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));
    $term = QubitTerm::getById(QubitTerm::CONTRIBUTION_ID);
    $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));

    if (isset($options['include_custom']))
    {
      $criteria = new Criteria;
      $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::EVENT_TYPE_ID);
      $criteria->addAscendingOrderByColumn('name');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $options);
      $terms = QubitTerm::get($criteria);

      // TODO: include unlocked event type terms that have been added to the taxonomy
    }

    return $selectList;
  }

   /**
   * Get a basic key['id']/value['name'] array for use as options in the Event Type
   * select list on the ISAD(G) edit template
   *
   * @param integer $taxonomyId parent taxonomy id
   * @param array $options optional paramters
   * @return array select box options
   */
  public static function getIsadEventTypeList($options = array())
  {
    $selectList = array();
    $term = QubitTerm::getById(QubitTerm::CREATION_ID);
    $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));
    $term = QubitTerm::getById(QubitTerm::ACCUMULATION_ID);
    $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));

    if (isset($options['include_custom']))
    {
      $criteria = new Criteria;
      $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::EVENT_TYPE_ID);
      $criteria->addAscendingOrderByColumn('name');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $options);
      $terms = QubitTerm::get($criteria);

      // TODO: include unlocked event type terms that have been added to the taxonomy
    }

    return $selectList;
  }

   /**
   * Return the Term Objects that represent
   * ISAD(G) events/dates
   *
   */
  public static function getIsadEventTypes($options = array())
  {
    $list = array();
    $term = self::getById(QubitTerm::CREATION_ID);
    $list[] = $term;
    $term = self::getById(QubitTerm::ACCUMULATION_ID);
    $list[] = $term;

    return $list;
  }

  /**
   * Add search criteria for find records updated in last $numberOfDays
   *
   * @param Criteria $criteria current search criteria
   * @param string $cutoff earliest date to show
   * @return Criteria modified criteria object
   */
  public static function addRecentUpdatesCriteria($criteria, $cutoff)
  {
    $criteria->add(QubitTerm::UPDATED_AT, $cutoff, Criteria::GREATER_EQUAL);

    return $criteria;
  }

  /**
   * Get all terms related to the current term by an 'equivalence' relation.
   * Allows specifying direction of relationship.
   *
   * @param array @options optional parameters
   * @return QubitQuery collection of QubitTerm objects
   */
  public function getEquivalentTerms($options = array())
  {
    $direction = (isset($options['direction'])) ? $options['direction'] : 'both';

    $criteria = new Criteria;
    $criteria->add(QubitRelation::TYPE_ID, QubitTerm::TERM_RELATION_EQUIVALENCE_ID, Criteria::EQUAL);

    switch ($direction)
    {
      case 'subjectToObject':
        $criteria->add(QubitRelation::SUBJECT_ID, $this->id, Criteria::EQUAL);
        break;
      case 'objectToSubject':
        $criteria->add(QubitRelation::OBJECT_ID, $this->id, Criteria::EQUAL);
        break;
      case 'both':
        $cton1 = $criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $this->id, Criteria::EQUAL);
        $cton2 = $criteria->getNewCriterion(QubitRelation::OBJECT_ID, $this->id, Criteria::EQUAL);
        $cton1->addOr($cton2);
        $criteria->add($cton1);
        break;
      default:
        return;
    }

    if (0 == count($relations = QubitRelation::get($criteria)))
    {

      return;
    }

    foreach ($relations as $relation)
    {
      if ($this->id == $relation->subjectId)
      {
        $relatedTermIds[] = $relation->objectId;
      }
      else
      {
        $relatedTermIds[] = $relation->subjectId;
      }
    }

    $criteria = new Criteria;
    $criteria->add(QubitTerm::ID, $relatedTermIds, Criteria::IN);

    return QubitTerm::get($criteria);
  }

  /**
   * Get the direct descendents of the current term
   *
   * @param array $options optional paramters
   * @return QubitQuery collection of QubitTerm objects
   */
  public function getChildren($options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitTerm::PARENT_ID, $this->id, Criteria::EQUAL);

    $sortBy = (isset($options['sortBy'])) ? $options['sortBy'] : 'lft';

    switch ($sortBy)
    {
      case 'name':
        $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');
        $criteria->addAscendingOrderByColumn('name');
        break;
      case 'lft':
      default:
        $criteria->addAscendingOrderByColumn('lft');
    }

    return QubitTerm::get($criteria, $options);
  }
}
