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
  const

    // ROOT term id
    ROOT_ID = 110,

    // Event type taxonomy
    CREATION_ID = 111,
    CUSTODY_ID = 113,
    PUBLICATION_ID = 114,
    CONTRIBUTION_ID = 115,
    COLLECTION_ID = 117,
    ACCUMULATION_ID = 118,

    // Note type taxonomy
    TITLE_NOTE_ID = 119,
    PUBLICATION_NOTE_ID = 120,
    SOURCE_NOTE_ID = 121,
    SCOPE_NOTE_ID = 122,
    DISPLAY_NOTE_ID = 123,
    ARCHIVIST_NOTE_ID = 124,
    GENERAL_NOTE_ID = 125,
    OTHER_DESCRIPTIVE_DATA_ID = 126,
    MAINTENANCE_NOTE_ID = 127,

    // Collection type taxonomy
    ARCHIVAL_MATERIAL_ID = 128,
    PUBLISHED_MATERIAL_ID = 129,
    ARTEFACT_MATERIAL_ID = 130,

    // Actor type taxonomy
    CORPORATE_BODY_ID = 131,
    PERSON_ID = 132,
    FAMILY_ID = 133,

    // Other name type taxonomy
    FAMILY_NAME_FIRST_NAME_ID = 134,

    // Media type taxonomy
    AUDIO_ID = 135,
    IMAGE_ID = 136,
    TEXT_ID = 137,
    VIDEO_ID = 138,
    OTHER_ID = 139,

    // Digital object usage taxonomy
    MASTER_ID = 140,
    REFERENCE_ID = 141,
    THUMBNAIL_ID = 142,
    COMPOUND_ID = 143,

    // Physical object type taxonomy
    LOCATION_ID = 144,
    CONTAINER_ID = 145,
    ARTEFACT_ID = 146,

    // Relation type taxonomy
    HAS_PHYSICAL_OBJECT_ID = 147,

    // Actor name type taxonomy
    PARALLEL_FORM_OF_NAME_ID = 148,
    OTHER_FORM_OF_NAME_ID = 149,

    // Actor relation type taxonomy
    HIERARCHICAL_RELATION_ID = 150,
    TEMPORAL_RELATION_ID = 151,
    FAMILY_RELATION_ID = 152,
    ASSOCIATIVE_RELATION_ID = 153,

    // Actor relation note taxonomy
    RELATION_NOTE_DESCRIPTION_ID = 154,
    RELATION_NOTE_DATE_ID = 155,

    // Term relation taxonomy
    ALTERNATIVE_LABEL_ID = 156,
    TERM_RELATION_ASSOCIATIVE_ID = 157,

    // Status type taxonomy
    STATUS_TYPE_PUBLICATION_ID = 158,

    // Publication status taxonomy
    PUBLICATION_STATUS_DRAFT_ID = 159,
    PUBLICATION_STATUS_PUBLISHED_ID = 160,

    // Name access point
    NAME_ACCESS_POINT_ID = 161,

    // Function relation type taxonomy
    ISDF_HIERARCHICAL_RELATION_ID = 162,
    ISDF_TEMPORAL_RELATION_ID = 163,
    ISDF_ASSOCIATIVE_RELATION_ID = 164,

    // ISAAR standardized form name
    STANDARDIZED_FORM_OF_NAME_ID = 165,

    // External URI
    EXTERNAL_URI_ID = 166;

  public function isProtected()
  {
    // The following terms cannot be edited by users because their values are used in application logic
    return in_array($this->id, array(
      QubitTerm::ACCUMULATION_ID,
      QubitTerm::ALTERNATIVE_LABEL_ID,
      QubitTerm::ARCHIVAL_MATERIAL_ID,
      QubitTerm::ARCHIVIST_NOTE_ID,
      QubitTerm::ARTEFACT_ID,
      QubitTerm::ARTEFACT_MATERIAL_ID,
      QubitTerm::ASSOCIATIVE_RELATION_ID,
      QubitTerm::AUDIO_ID,
      QubitTerm::COLLECTION_ID,
      QubitTerm::COMPOUND_ID,
      QubitTerm::CONTAINER_ID,
      QubitTerm::CONTRIBUTION_ID,
      QubitTerm::CORPORATE_BODY_ID,
      QubitTerm::CREATION_ID,
      QubitTerm::CUSTODY_ID,
      QubitTerm::DISPLAY_NOTE_ID,
      QubitTerm::EXTERNAL_URI_ID,
      QubitTerm::FAMILY_ID,
      QubitTerm::FAMILY_NAME_FIRST_NAME_ID,
      QubitTerm::FAMILY_RELATION_ID,
      QubitTerm::GENERAL_NOTE_ID,
      QubitTerm::HAS_PHYSICAL_OBJECT_ID,
      QubitTerm::HIERARCHICAL_RELATION_ID,
      QubitTerm::IMAGE_ID,
      QubitTerm::LOCATION_ID,
      QubitTerm::MAINTENANCE_NOTE_ID,
      QubitTerm::MASTER_ID,
      QubitTerm::NAME_ACCESS_POINT_ID,
      QubitTerm::OTHER_DESCRIPTIVE_DATA_ID,
      QubitTerm::OTHER_FORM_OF_NAME_ID,
      QubitTerm::OTHER_ID,
      QubitTerm::PARALLEL_FORM_OF_NAME_ID,
      QubitTerm::PERSON_ID,
      QubitTerm::PUBLICATION_ID,
      QubitTerm::PUBLICATION_NOTE_ID,
      QubitTerm::PUBLICATION_STATUS_DRAFT_ID,
      QubitTerm::PUBLICATION_STATUS_PUBLISHED_ID,
      QubitTerm::PUBLISHED_MATERIAL_ID,
      QubitTerm::REFERENCE_ID,
      QubitTerm::RELATION_NOTE_DATE_ID,
      QubitTerm::RELATION_NOTE_DESCRIPTION_ID,
      QubitTerm::ROOT_ID,
      QubitTerm::SCOPE_NOTE_ID,
      QubitTerm::SOURCE_NOTE_ID,
      QubitTerm::STANDARDIZED_FORM_OF_NAME_ID,
      QubitTerm::STATUS_TYPE_PUBLICATION_ID,
      QubitTerm::TEMPORAL_RELATION_ID,
      QubitTerm::TERM_RELATION_ASSOCIATIVE_ID,
      QubitTerm::TEXT_ID,
      QubitTerm::THUMBNAIL_ID,
      QubitTerm::TITLE_NOTE_ID,
      QubitTerm::VIDEO_ID));
  }

  public function __toString()
  {
    $string = $this->name;
    if (!isset($string))
    {
      $string = $this->getName(array('sourceCulture' => true));
    }

    return (string) $string;
  }

  protected function insert($connection = null)
  {
    if (!isset($this->slug))
    {
      $this->slug = QubitSlug::slugify($this->name);
    }

    return parent::insert($connection);
  }

  public function save($connection = null)
  {
    parent::save($connection);

    // Save related terms
    foreach ($this->termsRelatedByparentId as $child)
    {
      $child->setIndexOnSave(false);
      $child->parentId = $this->id;

      try
      {
        $child->save();
      }
      catch (PropelException $e)
      {
      }
    }
  }

  public static function getRoot()
  {
    return parent::getById(self::ROOT_ID);
  }

  public function setRoot()
  {
    $this->parentId = QubitTerm::ROOT_ID;
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
    $cton1 = $criteria->getNewCriterion(QubitRelation::OBJECT_ID, $this->id);
    $cton2 = $criteria->getNewCriterion(QubitRelation::SUBJECT_ID, $this->id);
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
    $criteria->add(QubitObjectTermRelation::TERM_ID, $this->id);

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
    return QubitTaxonomy::getTaxonomyTerms(QubitTaxonomy::LEVEL_OF_DESCRIPTION_ID, $options);
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
  public static function getIndentedChildTree($parentTermId, $indentStr = '&nbsp;', $options = array())
  {
    if (!$parentTerm = QubitTerm::getById($parentTermId))
    {
      return false;
    }

    $tree = array();

    $parentDepth = count($parentTerm->getAncestors());

    foreach ($parentTerm->getDescendants()->orderBy('lft') as $i => $node)
    {
      $relativeDepth = intval(count($node->getAncestors()) - $parentDepth - 1);
      $indentedName = str_repeat($indentStr, $relativeDepth).$node->getName(array('cultureFallback' => 'true'));

      if (isset($options['returnObjectInstances']) && true == $options['returnObjectInstances'])
      {
        $node->name = $indentedName;
        $tree[sfContext::getInstance()->routing->generate(null, array($node, 'module' => 'term'))] = $node;
      }
      else
      {
        $tree[$node->id] = $indentedName;
      }
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
    $count += $this->getRelatedNameCount();
    $count += $this->getRelatedDigitalObjectCount();
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
    $sql .= ' AND ('.QubitActor::DESCRIPTION_DETAIL_ID.' = '.$this->id;
    $sql .= ' OR '.QubitActor::DESCRIPTION_DETAIL_ID.' = '.$this->id;
    $sql .= ' OR '.QubitActor::ENTITY_TYPE_ID.' = '.$this->id.')';

    return self::executeCount($sql);
  }

  /**
   * Count the number of actor names that use this term
   * (taxonomy.id = ACTOR_NAME_TYPE_ID)
   *
   * @return integer number of related actor_names
   */
  public function getRelatedNameCount()
  {
    $sql = 'SELECT COUNT(*) FROM '.QubitOtherName::TABLE_NAME;
    $sql .= ' WHERE '.QubitOtherName::TYPE_ID.' = '.$this->id;

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
    $sql .= ' WHERE '.QubitDigitalObject::USAGE_ID.' = '.$this->id;
    $sql .= ' OR '.QubitDigitalObject::MEDIA_TYPE_ID.' = '.$this->id;
    $sql .= ' OR '.QubitDigitalObject::CHECKSUM_TYPE_ID.' = '.$this->id;

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
    $sql .= ' WHERE '.QubitEvent::TYPE_ID.' = '.$this->id;

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
    $sql .= ' WHERE '.QubitInformationObject::DESCRIPTION_STATUS_ID.' = '.$this->id;
    $sql .= ' OR '.QubitInformationObject::DESCRIPTION_DETAIL_ID.' = '.$this->id;
    $sql .= ' OR '.QubitInformationObject::LEVEL_OF_DESCRIPTION_ID.' = '.$this->id;
    $sql .= ' OR '.QubitInformationObject::COLLECTION_TYPE_ID.' = '.$this->id;

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
      WHERE '.QubitNote::TYPE_ID.' = '.$this->id.';';

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
      WHERE '.QubitObjectTermRelation::TERM_ID.' = '.$this->id.';';

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
    $sql .= ' WHERE '.QubitPhysicalObject::TYPE_ID.' = '.$this->id;

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
    $sql .= ' LEFT JOIN '.QubitObjectTermRelation::TABLE_NAME;
    $sql .= ' ON '.QubitRepository::ID.' = '.QubitObjectTermRelation::OBJECT_ID;
    $sql .= ' WHERE '.QubitRepository::DESC_DETAIL_ID.' = '.$this->id;
    $sql .= ' OR '.QubitRepository::DESC_STATUS_ID.' = '.$this->id;
    $sql .= ' OR '.QubitObjectTermRelation::TERM_ID.' = '.$this->id;

    return self::executeCount($sql);
  }

  /**
   * Get a count of objects related via q_object_term_relation that have a
   * class_name = $objectClassName (i.e. only 'QubitInformationObject's)
   *
   * @param string $objectClassName related object class_name column value
   * @return integer count of related object.
   */
  public function countRelatedInformationObjects()
  {
    $criteria = new Criteria;
    $criteria->add(QubitTerm::ID, $this->id);

    $criteria->addJoin(QubitTerm::ID, QubitObject::ID);
    $criteria->addJoin(QubitTerm::ID, QubitObjectTermRelation::TERM_ID);
    $criteria->addJoin(QubitObjectTermRelation::OBJECT_ID, QubitInformationObject::ID);

    // Only get published info objects
    $criteria = QubitAcl::addFilterDraftsCriteria($criteria);

    return BasePeer::doCount($criteria)->fetchColumn(0);
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

      $selectList[$term->id] = $displayValue;
    }

    return $selectList;
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
    $criteria->add(QubitTerm::PARENT_ID, $this->id);

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

  /*****************************************************
   TreeView
  *****************************************************/

  public function getFullYuiTree($limit = 0)
  {
    $tree = self::getFullTree($this, $limit);

    return self::renderYuiNodes($tree, array('currentNode' => $this));
  }

  public function getChildYuiNodes($options = array())
  {
    $limit = isset($options['limit']) ? $options['limit'] : 0;
    $offset = isset($options['offset']) ? $options['offset'] : 0;

    $nodes = array();

    $criteria = new Criteria;
    $criteria->add(QubitTerm::PARENT_ID, $this->id);

    if (QubitTerm::ROOT_ID == $this->id)
    {
      $params = sfContext::getInstance()->routing->parse(Qubit::pathInfo(sfContext::getInstance()->request->getReferer()));

      $refererTerm = $params['_sf_route']->resource;

      if (isset($refererTerm))
      {
        $criteria->add(QubitTerm::TAXONOMY_ID, $refererTerm->taxonomyId);
      }
    }

    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');
    $criteria->addAscendingOrderByColumn('name');

    $countCriteria = clone $criteria;
    $totalChildren = intval(BasePeer::doCount($countCriteria)->fetchColumn(0));

    if (0 < $limit)
    {
      $criteria->setLimit($limit);
    }

    if (0 < $offset)
    {
      $criteria->setOffset($offset);
    }

    if (0 < count($children = QubitTerm::get($criteria)))
    {
      foreach ($children as $child)
      {
        $nodes[] = $child;
      }
    }

    $shownChildren = $offset + count($children);
    if ($totalChildren > $shownChildren)
    {
      $nodes[] = array('total' => $totalChildren, 'limit' => $limit, 'parentId' => $this->id);
    }

    return self::renderYuiNodes($nodes);
  }

  private static function getFullTree($currentNode, $limit)
  {
    $tree = array();

    // Get direct ancestors
    $ancestors = $currentNode->getAncestors()->orderBy('lft');
    foreach ($ancestors as $ancestor)
    {
      $tree[$ancestor->id] = $ancestor;
    }

    // Get siblings (with limit) - but don't show sibling collection roots
    $totalSiblings = 0;

    $criteria = new Criteria;
    $criteria->add(QubitTerm::PARENT_ID, $currentNode->parentId);

    if (QubitTerm::ROOT_ID == $currentNode->parentId)
    {
      $criteria->add(QubitTerm::TAXONOMY_ID, $currentNode->taxonomyId);
    }

    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');
    $criteria->addAscendingOrderByColumn('name');

    if (0 < $limit)
    {
      $criteria->setLimit($limit);
    }

    foreach (QubitTerm::get($criteria) as $item)
    {
      // Keep track of position of $currentNode in array
      if ($item === $currentNode)
      {
        $curIndex = count($tree);
      }

      $tree[] = $item;
    }

    $totalSiblings = intval(BasePeer::doCount($criteria->setLimit(0))->fetchColumn(0));

    // Add current object to $tree if it wasn't added as a sibling
    if (!isset($curIndex))
    {
      if ($totalSiblings >= $limit)
      {
        // replace last sibling with current object
        array_splice($tree, -1, 1, array($currentNode));
      }
      else
      {
        $tree[] = $currentNode;
      }

      $curIndex = count($tree) - 1;
    }

    if ($totalSiblings > $limit)
    {
      $tree[] = array('total' => $totalSiblings, 'limit' => $limit, 'parentId' => $currentNode->parentId);
    }

    // Get children (with limit)
    $totalChildren = 0;
    $criteria = new Criteria;
    $criteria->add(QubitTerm::PARENT_ID, $currentNode->id);
    $criteria = QubitCultureFallback::addFallbackCriteria($criteria, 'QubitTerm');
    $criteria->addAscendingOrderByColumn('name');

    if (0 < $limit)
    {
      $criteria->setLimit($limit);
    }

    if (0 < count($children = QubitTerm::get($criteria)))
    {
      foreach ($children as $item)
      {
        $childs[] = $item;
      }

      $totalChildren = intval(BasePeer::doCount($criteria->setLimit(0))->fetchColumn(0));

      if ($totalChildren > $limit)
      {
        $childs[] = array('total' => $totalChildren, 'limit' => $limit, 'parentId' => $currentNode->id);
      }

      // Insert children right AFTER current info object in array
      if ($curIndex == count($tree) - 1)
      {
        $tree = array_merge($tree, $childs);
      }
      else
      {
        array_splice($tree, $curIndex + 1, 0, $childs);
      }
    }

    return $tree;
  }

  public static function renderYuiNodes($tree, $options = array())
  {
    ProjectConfiguration::getActive()->loadHelpers(array('Qubit', 'Text', 'Escaping'));

    $yuiTree = array();
    foreach ($tree as $key => $item)
    {
      $node = array();

      if ($item instanceof QubitTerm)
      {
        if (QubitTerm::ROOT_ID != $item->id)
        {
          $label = render_title($item->getName(array('cultureFallback' => true)));

          $node['label'] = truncate_text($label, 50);

          if (50 < strlen($label))
          {
            $node['title'] = esc_specialchars($label);
          }

          $node['href'] = sfContext::getInstance()->routing->generate(null, array($item, 'module' => 'term'));
          $node['id'] = $item->id;
          $node['parentId'] = $item->parentId;
          $node['isLeaf'] = (string) !$item->hasChildren();
          $node['moveUrl'] = sfContext::getInstance()->routing->generate(null, array($item, 'module' => 'default', 'action' => 'move'));
          $node['expandUrl'] = sfContext::getInstance()->routing->generate(null, array($item, 'module' => 'term', 'action' => 'treeView'));
        }
        else
        {
          $label = render_title($options['currentNode']->taxonomy->getName(array('cultureFallback' => true)));

          $node['label'] = truncate_text($label, 50);

          if (50 < strlen($label))
          {
            $node['title'] = esc_specialchars($label);
          }

          $node['href'] = sfContext::getInstance()->routing->generate(null, array($options['currentNode']->taxonomy, 'module' => 'taxonomy'));
          $node['id'] = $item->id;
          $node['parentId'] = null;
          $node['isLeaf'] = (string) !$item->hasChildren();
          $node['moveUrl'] = sfContext::getInstance()->routing->generate(null, array($item, 'module' => 'default', 'action' => 'move'));
          $node['expandUrl'] = sfContext::getInstance()->routing->generate(null, array($item, 'module' => 'term', 'action' => 'treeView'));
        }

        if (isset($options['currentNode']) && $options['currentNode'] === $item)
        {
          $node['style'] = 'ygtvlabel currentTextNode';
        }
      }

      // "Show all" link
      else
      {
        $count = intval($item['total']) - intval($item['limit']);

        $node['label'] = sfContext::getInstance()->i18n->__('+%1% ...', array('%1%' => $count));
        $node['parentId'] = $item['parentId'];
        $node['href'] = '#';
        $node['isLeaf'] = 'true';
        $node['style'] = 'seeAllNode';
      }

      $yuiTree[] = $node;
    }

    return $yuiTree;
  }

  /**
   * Speed-optimized method for checking if information object has children
   * which doesn't require hitting database.
   *
   * @return boolean - true if has children
   */
  public function hasChildren()
  {
    return ($this->rgt - $this->lft) > 1;
  }
}
