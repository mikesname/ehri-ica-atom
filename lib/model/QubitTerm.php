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
 * @author     David Juhasz <david@artefactual.com>
 * @version    SVN: $Id$
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
  const ARCHIVIST_NOTE_ID = 124;
  const GENERAL_NOTE_ID = 125;
  const OTHER_DESCRIPTIVE_DATA_ID = 126;
  //CollectionType taxonomy
  const ARCHIVAL_MATERIAL_ID = 127;
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
    $this->getId() == QubitTerm::ARCHIVIST_NOTE_ID ||
    $this->getId() == QubitTerm::OTHER_DESCRIPTIVE_DATA_ID ||
    $this->getId() == QubitTerm::GENERAL_NOTE_ID;
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

    // Add joins to get count of information objects related via object
    // term relation. The 'object2' alias is necessary because the query
    // silently adds a join on (QubitTerm::ID = QubitObject::ID).
    $criteria->addAlias('object2', QubitObject::TABLE_NAME);
    $criteria->addJoin(QubitTerm::ID, QubitObjectTermRelation::TERM_ID, Criteria::INNER_JOIN);
    $criteria->addJoin(QubitObjectTermRelation::OBJECT_ID, 'object2.id', Criteria::INNER_JOIN);
    $criteria->add('object2.class_name', 'QubitInformationObject', Criteria::EQUAL);
    $criteria->addAsColumn('hits', 'COUNT('.QubitTerm::ID.')');
    $criteria->addGroupByColumn(QubitTerm::ID);

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

  private static function executeCount($sql)
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

    // TODO: include unlocked event type terms that have been added to the taxonomy
    if (isset($options['include_custom']))
    {
      $context = sfContext::getInstance();
      $culture = $context->getUser()->getCulture();

      $criteria = new Criteria;
      $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::EVENT_TYPE_ID);
      $criteria->addAscendingOrderByColumn('name');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $culture, $options);
      $terms = QubitTerm::get($criteria);
      foreach ($terms as $term)
      {
        // if (term is not locked)
        // {
        //   $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));
        // }
      }
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

    // TODO: include unlocked event type terms that have been added to the taxonomy
    if (isset($options['include_custom']))
    {
      $context = sfContext::getInstance();
      $culture = $context->getUser()->getCulture();

      $criteria = new Criteria;
      $criteria->add(QubitTerm::TAXONOMY_ID, QubitTaxonomy::EVENT_TYPE_ID);
      $criteria->addAscendingOrderByColumn('name');
      $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm', $culture, $options);
      $terms = QubitTerm::get($criteria);
      foreach ($terms as $term)
      {
        // if (term is not locked)
        // {
        //   $selectList[$term->getId()] = $term->getName(array('cultureFallback'=>true));
        // }
      }
    }

    return $selectList;
  }

}