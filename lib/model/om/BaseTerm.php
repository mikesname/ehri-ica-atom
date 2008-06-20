<?php

abstract class BaseTerm extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_term';

  const ID = 'q_term.ID';
  const TAXONOMY_ID = 'q_term.TAXONOMY_ID';
  const CODE_NUMERIC = 'q_term.CODE_NUMERIC';
  const PARENT_ID = 'q_term.PARENT_ID';
  const LFT = 'q_term.LFT';
  const RGT = 'q_term.RGT';
  const CREATED_AT = 'q_term.CREATED_AT';
  const UPDATED_AT = 'q_term.UPDATED_AT';
  const SOURCE_CULTURE = 'q_term.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitTerm::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitTerm::ID);
    $criteria->addSelectColumn(QubitTerm::TAXONOMY_ID);
    $criteria->addSelectColumn(QubitTerm::CODE_NUMERIC);
    $criteria->addSelectColumn(QubitTerm::PARENT_ID);
    $criteria->addSelectColumn(QubitTerm::LFT);
    $criteria->addSelectColumn(QubitTerm::RGT);
    $criteria->addSelectColumn(QubitTerm::CREATED_AT);
    $criteria->addSelectColumn(QubitTerm::UPDATED_AT);
    $criteria->addSelectColumn(QubitTerm::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTerm::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitTerm', $options);
  }

  public static function getAll(array $options = array())
  {
    return self::get(new Criteria, $options);
  }

  public static function getOne(Criteria $criteria, array $options = array())
  {
    $criteria->setLimit(1);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitTerm::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitTerm::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitTerm::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitTerm::PARENT_ID);

    return $criteria;
  }

  protected $taxonomyId = null;

  public function getTaxonomyId()
  {
    return $this->taxonomyId;
  }

  public function setTaxonomyId($taxonomyId)
  {
    $this->taxonomyId = $taxonomyId;

    return $this;
  }

  protected $codeNumeric = null;

  public function getCodeNumeric()
  {
    return $this->codeNumeric;
  }

  public function setCodeNumeric($codeNumeric)
  {
    $this->codeNumeric = $codeNumeric;

    return $this;
  }

  protected $parentId = null;

  public function getParentId()
  {
    return $this->parentId;
  }

  public function setParentId($parentId)
  {
    $this->parentId = $parentId;

    return $this;
  }

  protected $lft = null;

  public function getLft()
  {
    return $this->lft;
  }

  protected function setLft($lft)
  {
    $this->lft = $lft;

    return $this;
  }

  protected $rgt = null;

  public function getRgt()
  {
    return $this->rgt;
  }

  protected function setRgt($rgt)
  {
    $this->rgt = $rgt;

    return $this;
  }

  protected $createdAt = null;

  public function getCreatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->createdAt);
    }

    return $this->createdAt;
  }

  public function setCreatedAt($createdAt)
  {
    if (is_string($createdAt) && false === $createdAt = strtotime($createdAt))
    {
      throw new PropelException('Unable to parse date / time value for [createdAt] from input: '.var_export($createdAt, true));
    }

    $this->createdAt = $createdAt;

    return $this;
  }

  protected $updatedAt = null;

  public function getUpdatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->updatedAt);
    }

    return $this->updatedAt;
  }

  public function setUpdatedAt($updatedAt)
  {
    if (is_string($updatedAt) && false === $updatedAt = strtotime($updatedAt))
    {
      throw new PropelException('Unable to parse date / time value for [updatedAt] from input: '.var_export($updatedAt, true));
    }

    $this->updatedAt = $updatedAt;

    return $this;
  }

  protected $sourceCulture = null;

  public function getSourceCulture()
  {
    return $this->sourceCulture;
  }

  public function setSourceCulture($sourceCulture)
  {
    $this->sourceCulture = $sourceCulture;

    return $this;
  }

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['taxonomyId'] = $this->taxonomyId;
    $this->columnValues['codeNumeric'] = $this->codeNumeric;
    $this->columnValues['parentId'] = $this->parentId;
    $this->columnValues['lft'] = $this->lft;
    $this->columnValues['rgt'] = $this->rgt;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->taxonomyId = $results->getInt($columnOffset++);
    $this->codeNumeric = $results->getInt($columnOffset++);
    $this->parentId = $results->getInt($columnOffset++);
    $this->lft = $results->getInt($columnOffset++);
    $this->rgt = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTerm::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitTerm::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->termI18ns as $termI18n)
    {
      $termI18n->setId($this->id);

      $affectedRows += $termI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $this->updateNestedSet($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitTerm::ID, $this->id);
    }

    if ($this->isColumnModified('taxonomyId'))
    {
      $criteria->add(QubitTerm::TAXONOMY_ID, $this->taxonomyId);
    }

    if ($this->isColumnModified('codeNumeric'))
    {
      $criteria->add(QubitTerm::CODE_NUMERIC, $this->codeNumeric);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitTerm::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitTerm::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitTerm::RGT, $this->rgt);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitTerm::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitTerm::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitTerm::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTerm::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::update($connection);

    if ($this->isColumnModified('parentId'))
    {
      $this->updateNestedSet($connection);
    }

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitTerm::ID, $this->id);
    }

    if ($this->isColumnModified('taxonomyId'))
    {
      $criteria->add(QubitTerm::TAXONOMY_ID, $this->taxonomyId);
    }

    if ($this->isColumnModified('codeNumeric'))
    {
      $criteria->add(QubitTerm::CODE_NUMERIC, $this->codeNumeric);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitTerm::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitTerm::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitTerm::RGT, $this->rgt);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitTerm::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitTerm::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitTerm::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitTerm::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitTerm::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public function delete($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('This object has already been deleted.');
    }

    $affectedRows = 0;

    $this->refresh(array('connection' => $connection));
    $this->deleteFromNestedSet($connection);

    $affectedRows += parent::delete($connection);

    return $affectedRows;
  }

  public static function addJoinTaxonomyCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitTerm::TAXONOMY_ID, QubitTaxonomy::ID);

    return $criteria;
  }

  public function getTaxonomy(array $options = array())
  {
    return $this->taxonomy = QubitTaxonomy::getById($this->taxonomyId, $options);
  }

  public function setTaxonomy(QubitTaxonomy $taxonomy)
  {
    $this->taxonomyId = $taxonomy->getId();

    return $this;
  }

  public static function addJoinParentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitTerm::PARENT_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getParent(array $options = array())
  {
    return $this->parent = QubitTerm::getById($this->parentId, $options);
  }

  public function setParent(QubitTerm $term)
  {
    $this->parentId = $term->getId();

    return $this;
  }

  public static function addInformationObjectsRelatedByLevelOfDescriptionIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::LEVEL_OF_DESCRIPTION_ID, $id);

    return $criteria;
  }

  public static function getInformationObjectsRelatedByLevelOfDescriptionIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addInformationObjectsRelatedByLevelOfDescriptionIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addInformationObjectsRelatedByLevelOfDescriptionIdCriteria(Criteria $criteria)
  {
    return self::addInformationObjectsRelatedByLevelOfDescriptionIdCriteriaById($criteria, $this->id);
  }

  protected $informationObjectsRelatedByLevelOfDescriptionId = null;

  public function getInformationObjectsRelatedByLevelOfDescriptionId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedByLevelOfDescriptionId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedByLevelOfDescriptionId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedByLevelOfDescriptionId = self::getInformationObjectsRelatedByLevelOfDescriptionIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedByLevelOfDescriptionId;
  }

  public static function addInformationObjectsRelatedByCollectionTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::COLLECTION_TYPE_ID, $id);

    return $criteria;
  }

  public static function getInformationObjectsRelatedByCollectionTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addInformationObjectsRelatedByCollectionTypeIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addInformationObjectsRelatedByCollectionTypeIdCriteria(Criteria $criteria)
  {
    return self::addInformationObjectsRelatedByCollectionTypeIdCriteriaById($criteria, $this->id);
  }

  protected $informationObjectsRelatedByCollectionTypeId = null;

  public function getInformationObjectsRelatedByCollectionTypeId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedByCollectionTypeId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedByCollectionTypeId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedByCollectionTypeId = self::getInformationObjectsRelatedByCollectionTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedByCollectionTypeId;
  }

  public static function addInformationObjectsRelatedByDescriptionStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::DESCRIPTION_STATUS_ID, $id);

    return $criteria;
  }

  public static function getInformationObjectsRelatedByDescriptionStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addInformationObjectsRelatedByDescriptionStatusIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addInformationObjectsRelatedByDescriptionStatusIdCriteria(Criteria $criteria)
  {
    return self::addInformationObjectsRelatedByDescriptionStatusIdCriteriaById($criteria, $this->id);
  }

  protected $informationObjectsRelatedByDescriptionStatusId = null;

  public function getInformationObjectsRelatedByDescriptionStatusId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedByDescriptionStatusId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedByDescriptionStatusId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedByDescriptionStatusId = self::getInformationObjectsRelatedByDescriptionStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedByDescriptionStatusId;
  }

  public static function addInformationObjectsRelatedByDescriptionDetailIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::DESCRIPTION_DETAIL_ID, $id);

    return $criteria;
  }

  public static function getInformationObjectsRelatedByDescriptionDetailIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addInformationObjectsRelatedByDescriptionDetailIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addInformationObjectsRelatedByDescriptionDetailIdCriteria(Criteria $criteria)
  {
    return self::addInformationObjectsRelatedByDescriptionDetailIdCriteriaById($criteria, $this->id);
  }

  protected $informationObjectsRelatedByDescriptionDetailId = null;

  public function getInformationObjectsRelatedByDescriptionDetailId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedByDescriptionDetailId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedByDescriptionDetailId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedByDescriptionDetailId = self::getInformationObjectsRelatedByDescriptionDetailIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedByDescriptionDetailId;
  }

  public static function addObjectTermRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitObjectTermRelation::TERM_ID, $id);

    return $criteria;
  }

  public static function getObjectTermRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addObjectTermRelationsCriteriaById($criteria, $id);

    return QubitObjectTermRelation::get($criteria, $options);
  }

  public function addObjectTermRelationsCriteria(Criteria $criteria)
  {
    return self::addObjectTermRelationsCriteriaById($criteria, $this->id);
  }

  protected $objectTermRelations = null;

  public function getObjectTermRelations(array $options = array())
  {
    if (!isset($this->objectTermRelations))
    {
      if (!isset($this->id))
      {
        $this->objectTermRelations = QubitQuery::create();
      }
      else
      {
        $this->objectTermRelations = self::getObjectTermRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->objectTermRelations;
  }

  public static function addRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRelation::TYPE_ID, $id);

    return $criteria;
  }

  public static function getRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRelationsCriteriaById($criteria, $id);

    return QubitRelation::get($criteria, $options);
  }

  public function addRelationsCriteria(Criteria $criteria)
  {
    return self::addRelationsCriteriaById($criteria, $this->id);
  }

  protected $relations = null;

  public function getRelations(array $options = array())
  {
    if (!isset($this->relations))
    {
      if (!isset($this->id))
      {
        $this->relations = QubitQuery::create();
      }
      else
      {
        $this->relations = self::getRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->relations;
  }

  public static function addNotesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::TYPE_ID, $id);

    return $criteria;
  }

  public static function getNotesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addNotesCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addNotesCriteria(Criteria $criteria)
  {
    return self::addNotesCriteriaById($criteria, $this->id);
  }

  protected $notes = null;

  public function getNotes(array $options = array())
  {
    if (!isset($this->notes))
    {
      if (!isset($this->id))
      {
        $this->notes = QubitQuery::create();
      }
      else
      {
        $this->notes = self::getNotesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notes;
  }

  public static function addDigitalObjectsRelatedByUsageIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::USAGE_ID, $id);

    return $criteria;
  }

  public static function getDigitalObjectsRelatedByUsageIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addDigitalObjectsRelatedByUsageIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function addDigitalObjectsRelatedByUsageIdCriteria(Criteria $criteria)
  {
    return self::addDigitalObjectsRelatedByUsageIdCriteriaById($criteria, $this->id);
  }

  protected $digitalObjectsRelatedByUsageId = null;

  public function getDigitalObjectsRelatedByUsageId(array $options = array())
  {
    if (!isset($this->digitalObjectsRelatedByUsageId))
    {
      if (!isset($this->id))
      {
        $this->digitalObjectsRelatedByUsageId = QubitQuery::create();
      }
      else
      {
        $this->digitalObjectsRelatedByUsageId = self::getDigitalObjectsRelatedByUsageIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjectsRelatedByUsageId;
  }

  public static function addDigitalObjectsRelatedByMediaTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::MEDIA_TYPE_ID, $id);

    return $criteria;
  }

  public static function getDigitalObjectsRelatedByMediaTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addDigitalObjectsRelatedByMediaTypeIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function addDigitalObjectsRelatedByMediaTypeIdCriteria(Criteria $criteria)
  {
    return self::addDigitalObjectsRelatedByMediaTypeIdCriteriaById($criteria, $this->id);
  }

  protected $digitalObjectsRelatedByMediaTypeId = null;

  public function getDigitalObjectsRelatedByMediaTypeId(array $options = array())
  {
    if (!isset($this->digitalObjectsRelatedByMediaTypeId))
    {
      if (!isset($this->id))
      {
        $this->digitalObjectsRelatedByMediaTypeId = QubitQuery::create();
      }
      else
      {
        $this->digitalObjectsRelatedByMediaTypeId = self::getDigitalObjectsRelatedByMediaTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjectsRelatedByMediaTypeId;
  }

  public static function addDigitalObjectsRelatedByChecksumTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::CHECKSUM_TYPE_ID, $id);

    return $criteria;
  }

  public static function getDigitalObjectsRelatedByChecksumTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addDigitalObjectsRelatedByChecksumTypeIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function addDigitalObjectsRelatedByChecksumTypeIdCriteria(Criteria $criteria)
  {
    return self::addDigitalObjectsRelatedByChecksumTypeIdCriteriaById($criteria, $this->id);
  }

  protected $digitalObjectsRelatedByChecksumTypeId = null;

  public function getDigitalObjectsRelatedByChecksumTypeId(array $options = array())
  {
    if (!isset($this->digitalObjectsRelatedByChecksumTypeId))
    {
      if (!isset($this->id))
      {
        $this->digitalObjectsRelatedByChecksumTypeId = QubitQuery::create();
      }
      else
      {
        $this->digitalObjectsRelatedByChecksumTypeId = self::getDigitalObjectsRelatedByChecksumTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjectsRelatedByChecksumTypeId;
  }

  public static function addPhysicalObjectsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPhysicalObject::TYPE_ID, $id);

    return $criteria;
  }

  public static function getPhysicalObjectsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPhysicalObjectsCriteriaById($criteria, $id);

    return QubitPhysicalObject::get($criteria, $options);
  }

  public function addPhysicalObjectsCriteria(Criteria $criteria)
  {
    return self::addPhysicalObjectsCriteriaById($criteria, $this->id);
  }

  protected $physicalObjects = null;

  public function getPhysicalObjects(array $options = array())
  {
    if (!isset($this->physicalObjects))
    {
      if (!isset($this->id))
      {
        $this->physicalObjects = QubitQuery::create();
      }
      else
      {
        $this->physicalObjects = self::getPhysicalObjectsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->physicalObjects;
  }

  public static function addActorsRelatedByEntityTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::ENTITY_TYPE_ID, $id);

    return $criteria;
  }

  public static function getActorsRelatedByEntityTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorsRelatedByEntityTypeIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addActorsRelatedByEntityTypeIdCriteria(Criteria $criteria)
  {
    return self::addActorsRelatedByEntityTypeIdCriteriaById($criteria, $this->id);
  }

  protected $actorsRelatedByEntityTypeId = null;

  public function getActorsRelatedByEntityTypeId(array $options = array())
  {
    if (!isset($this->actorsRelatedByEntityTypeId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedByEntityTypeId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedByEntityTypeId = self::getActorsRelatedByEntityTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedByEntityTypeId;
  }

  public static function addActorsRelatedByDescriptionStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::DESCRIPTION_STATUS_ID, $id);

    return $criteria;
  }

  public static function getActorsRelatedByDescriptionStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorsRelatedByDescriptionStatusIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addActorsRelatedByDescriptionStatusIdCriteria(Criteria $criteria)
  {
    return self::addActorsRelatedByDescriptionStatusIdCriteriaById($criteria, $this->id);
  }

  protected $actorsRelatedByDescriptionStatusId = null;

  public function getActorsRelatedByDescriptionStatusId(array $options = array())
  {
    if (!isset($this->actorsRelatedByDescriptionStatusId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedByDescriptionStatusId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedByDescriptionStatusId = self::getActorsRelatedByDescriptionStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedByDescriptionStatusId;
  }

  public static function addActorsRelatedByDescriptionDetailIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::DESCRIPTION_DETAIL_ID, $id);

    return $criteria;
  }

  public static function getActorsRelatedByDescriptionDetailIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorsRelatedByDescriptionDetailIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addActorsRelatedByDescriptionDetailIdCriteria(Criteria $criteria)
  {
    return self::addActorsRelatedByDescriptionDetailIdCriteriaById($criteria, $this->id);
  }

  protected $actorsRelatedByDescriptionDetailId = null;

  public function getActorsRelatedByDescriptionDetailId(array $options = array())
  {
    if (!isset($this->actorsRelatedByDescriptionDetailId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedByDescriptionDetailId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedByDescriptionDetailId = self::getActorsRelatedByDescriptionDetailIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedByDescriptionDetailId;
  }

  public static function addRepositorysRelatedByTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepository::TYPE_ID, $id);

    return $criteria;
  }

  public static function getRepositorysRelatedByTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRepositorysRelatedByTypeIdCriteriaById($criteria, $id);

    return QubitRepository::get($criteria, $options);
  }

  public function addRepositorysRelatedByTypeIdCriteria(Criteria $criteria)
  {
    return self::addRepositorysRelatedByTypeIdCriteriaById($criteria, $this->id);
  }

  protected $repositorysRelatedByTypeId = null;

  public function getRepositorysRelatedByTypeId(array $options = array())
  {
    if (!isset($this->repositorysRelatedByTypeId))
    {
      if (!isset($this->id))
      {
        $this->repositorysRelatedByTypeId = QubitQuery::create();
      }
      else
      {
        $this->repositorysRelatedByTypeId = self::getRepositorysRelatedByTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositorysRelatedByTypeId;
  }

  public static function addRepositorysRelatedByDescStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepository::DESC_STATUS_ID, $id);

    return $criteria;
  }

  public static function getRepositorysRelatedByDescStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRepositorysRelatedByDescStatusIdCriteriaById($criteria, $id);

    return QubitRepository::get($criteria, $options);
  }

  public function addRepositorysRelatedByDescStatusIdCriteria(Criteria $criteria)
  {
    return self::addRepositorysRelatedByDescStatusIdCriteriaById($criteria, $this->id);
  }

  protected $repositorysRelatedByDescStatusId = null;

  public function getRepositorysRelatedByDescStatusId(array $options = array())
  {
    if (!isset($this->repositorysRelatedByDescStatusId))
    {
      if (!isset($this->id))
      {
        $this->repositorysRelatedByDescStatusId = QubitQuery::create();
      }
      else
      {
        $this->repositorysRelatedByDescStatusId = self::getRepositorysRelatedByDescStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositorysRelatedByDescStatusId;
  }

  public static function addRepositorysRelatedByDescDetailIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepository::DESC_DETAIL_ID, $id);

    return $criteria;
  }

  public static function getRepositorysRelatedByDescDetailIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRepositorysRelatedByDescDetailIdCriteriaById($criteria, $id);

    return QubitRepository::get($criteria, $options);
  }

  public function addRepositorysRelatedByDescDetailIdCriteria(Criteria $criteria)
  {
    return self::addRepositorysRelatedByDescDetailIdCriteriaById($criteria, $this->id);
  }

  protected $repositorysRelatedByDescDetailId = null;

  public function getRepositorysRelatedByDescDetailId(array $options = array())
  {
    if (!isset($this->repositorysRelatedByDescDetailId))
    {
      if (!isset($this->id))
      {
        $this->repositorysRelatedByDescDetailId = QubitQuery::create();
      }
      else
      {
        $this->repositorysRelatedByDescDetailId = self::getRepositorysRelatedByDescDetailIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositorysRelatedByDescDetailId;
  }

  public static function addActorNamesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActorName::TYPE_ID, $id);

    return $criteria;
  }

  public static function getActorNamesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorNamesCriteriaById($criteria, $id);

    return QubitActorName::get($criteria, $options);
  }

  public function addActorNamesCriteria(Criteria $criteria)
  {
    return self::addActorNamesCriteriaById($criteria, $this->id);
  }

  protected $actorNames = null;

  public function getActorNames(array $options = array())
  {
    if (!isset($this->actorNames))
    {
      if (!isset($this->id))
      {
        $this->actorNames = QubitQuery::create();
      }
      else
      {
        $this->actorNames = self::getActorNamesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorNames;
  }

  public static function addPlacesRelatedByCountryIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlace::COUNTRY_ID, $id);

    return $criteria;
  }

  public static function getPlacesRelatedByCountryIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPlacesRelatedByCountryIdCriteriaById($criteria, $id);

    return QubitPlace::get($criteria, $options);
  }

  public function addPlacesRelatedByCountryIdCriteria(Criteria $criteria)
  {
    return self::addPlacesRelatedByCountryIdCriteriaById($criteria, $this->id);
  }

  protected $placesRelatedByCountryId = null;

  public function getPlacesRelatedByCountryId(array $options = array())
  {
    if (!isset($this->placesRelatedByCountryId))
    {
      if (!isset($this->id))
      {
        $this->placesRelatedByCountryId = QubitQuery::create();
      }
      else
      {
        $this->placesRelatedByCountryId = self::getPlacesRelatedByCountryIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placesRelatedByCountryId;
  }

  public static function addPlacesRelatedByTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlace::TYPE_ID, $id);

    return $criteria;
  }

  public static function getPlacesRelatedByTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPlacesRelatedByTypeIdCriteriaById($criteria, $id);

    return QubitPlace::get($criteria, $options);
  }

  public function addPlacesRelatedByTypeIdCriteria(Criteria $criteria)
  {
    return self::addPlacesRelatedByTypeIdCriteriaById($criteria, $this->id);
  }

  protected $placesRelatedByTypeId = null;

  public function getPlacesRelatedByTypeId(array $options = array())
  {
    if (!isset($this->placesRelatedByTypeId))
    {
      if (!isset($this->id))
      {
        $this->placesRelatedByTypeId = QubitQuery::create();
      }
      else
      {
        $this->placesRelatedByTypeId = self::getPlacesRelatedByTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placesRelatedByTypeId;
  }

  public static function addPlaceMapRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceMapRelation::TYPE_ID, $id);

    return $criteria;
  }

  public static function getPlaceMapRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPlaceMapRelationsCriteriaById($criteria, $id);

    return QubitPlaceMapRelation::get($criteria, $options);
  }

  public function addPlaceMapRelationsCriteria(Criteria $criteria)
  {
    return self::addPlaceMapRelationsCriteriaById($criteria, $this->id);
  }

  protected $placeMapRelations = null;

  public function getPlaceMapRelations(array $options = array())
  {
    if (!isset($this->placeMapRelations))
    {
      if (!isset($this->id))
      {
        $this->placeMapRelations = QubitQuery::create();
      }
      else
      {
        $this->placeMapRelations = self::getPlaceMapRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placeMapRelations;
  }

  public static function addTermsRelatedByParentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitTerm::PARENT_ID, $id);

    return $criteria;
  }

  public static function getTermsRelatedByParentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addTermsRelatedByParentIdCriteriaById($criteria, $id);

    return QubitTerm::get($criteria, $options);
  }

  public function addTermsRelatedByParentIdCriteria(Criteria $criteria)
  {
    return self::addTermsRelatedByParentIdCriteriaById($criteria, $this->id);
  }

  protected $termsRelatedByParentId = null;

  public function getTermsRelatedByParentId(array $options = array())
  {
    if (!isset($this->termsRelatedByParentId))
    {
      if (!isset($this->id))
      {
        $this->termsRelatedByParentId = QubitQuery::create();
      }
      else
      {
        $this->termsRelatedByParentId = self::getTermsRelatedByParentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->termsRelatedByParentId;
  }

  public static function addTermI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitTermI18n::ID, $id);

    return $criteria;
  }

  public static function getTermI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addTermI18nsCriteriaById($criteria, $id);

    return QubitTermI18n::get($criteria, $options);
  }

  public function addTermI18nsCriteria(Criteria $criteria)
  {
    return self::addTermI18nsCriteriaById($criteria, $this->id);
  }

  protected $termI18ns = null;

  public function getTermI18ns(array $options = array())
  {
    if (!isset($this->termI18ns))
    {
      if (!isset($this->id))
      {
        $this->termI18ns = QubitQuery::create();
      }
      else
      {
        $this->termI18ns = self::getTermI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->termI18ns;
  }

  public static function addEventsRelatedByTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEvent::TYPE_ID, $id);

    return $criteria;
  }

  public static function getEventsRelatedByTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addEventsRelatedByTypeIdCriteriaById($criteria, $id);

    return QubitEvent::get($criteria, $options);
  }

  public function addEventsRelatedByTypeIdCriteria(Criteria $criteria)
  {
    return self::addEventsRelatedByTypeIdCriteriaById($criteria, $this->id);
  }

  protected $eventsRelatedByTypeId = null;

  public function getEventsRelatedByTypeId(array $options = array())
  {
    if (!isset($this->eventsRelatedByTypeId))
    {
      if (!isset($this->id))
      {
        $this->eventsRelatedByTypeId = QubitQuery::create();
      }
      else
      {
        $this->eventsRelatedByTypeId = self::getEventsRelatedByTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->eventsRelatedByTypeId;
  }

  public static function addEventsRelatedByActorRoleIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEvent::ACTOR_ROLE_ID, $id);

    return $criteria;
  }

  public static function getEventsRelatedByActorRoleIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addEventsRelatedByActorRoleIdCriteriaById($criteria, $id);

    return QubitEvent::get($criteria, $options);
  }

  public function addEventsRelatedByActorRoleIdCriteria(Criteria $criteria)
  {
    return self::addEventsRelatedByActorRoleIdCriteriaById($criteria, $this->id);
  }

  protected $eventsRelatedByActorRoleId = null;

  public function getEventsRelatedByActorRoleId(array $options = array())
  {
    if (!isset($this->eventsRelatedByActorRoleId))
    {
      if (!isset($this->id))
      {
        $this->eventsRelatedByActorRoleId = QubitQuery::create();
      }
      else
      {
        $this->eventsRelatedByActorRoleId = self::getEventsRelatedByActorRoleIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->eventsRelatedByActorRoleId;
  }

  public static function addSystemEventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitSystemEvent::TYPE_ID, $id);

    return $criteria;
  }

  public static function getSystemEventsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addSystemEventsCriteriaById($criteria, $id);

    return QubitSystemEvent::get($criteria, $options);
  }

  public function addSystemEventsCriteria(Criteria $criteria)
  {
    return self::addSystemEventsCriteriaById($criteria, $this->id);
  }

  protected $systemEvents = null;

  public function getSystemEvents(array $options = array())
  {
    if (!isset($this->systemEvents))
    {
      if (!isset($this->id))
      {
        $this->systemEvents = QubitQuery::create();
      }
      else
      {
        $this->systemEvents = self::getSystemEventsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->systemEvents;
  }

  public static function addHistoricalEventsRelatedByTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitHistoricalEvent::TYPE_ID, $id);

    return $criteria;
  }

  public static function getHistoricalEventsRelatedByTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addHistoricalEventsRelatedByTypeIdCriteriaById($criteria, $id);

    return QubitHistoricalEvent::get($criteria, $options);
  }

  public function addHistoricalEventsRelatedByTypeIdCriteria(Criteria $criteria)
  {
    return self::addHistoricalEventsRelatedByTypeIdCriteriaById($criteria, $this->id);
  }

  protected $historicalEventsRelatedByTypeId = null;

  public function getHistoricalEventsRelatedByTypeId(array $options = array())
  {
    if (!isset($this->historicalEventsRelatedByTypeId))
    {
      if (!isset($this->id))
      {
        $this->historicalEventsRelatedByTypeId = QubitQuery::create();
      }
      else
      {
        $this->historicalEventsRelatedByTypeId = self::getHistoricalEventsRelatedByTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->historicalEventsRelatedByTypeId;
  }

  public static function addFunctionsRelatedByTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunction::TYPE_ID, $id);

    return $criteria;
  }

  public static function getFunctionsRelatedByTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addFunctionsRelatedByTypeIdCriteriaById($criteria, $id);

    return QubitFunction::get($criteria, $options);
  }

  public function addFunctionsRelatedByTypeIdCriteria(Criteria $criteria)
  {
    return self::addFunctionsRelatedByTypeIdCriteriaById($criteria, $this->id);
  }

  protected $functionsRelatedByTypeId = null;

  public function getFunctionsRelatedByTypeId(array $options = array())
  {
    if (!isset($this->functionsRelatedByTypeId))
    {
      if (!isset($this->id))
      {
        $this->functionsRelatedByTypeId = QubitQuery::create();
      }
      else
      {
        $this->functionsRelatedByTypeId = self::getFunctionsRelatedByTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionsRelatedByTypeId;
  }

  public static function addFunctionsRelatedByDescriptionStatusIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunction::DESCRIPTION_STATUS_ID, $id);

    return $criteria;
  }

  public static function getFunctionsRelatedByDescriptionStatusIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addFunctionsRelatedByDescriptionStatusIdCriteriaById($criteria, $id);

    return QubitFunction::get($criteria, $options);
  }

  public function addFunctionsRelatedByDescriptionStatusIdCriteria(Criteria $criteria)
  {
    return self::addFunctionsRelatedByDescriptionStatusIdCriteriaById($criteria, $this->id);
  }

  protected $functionsRelatedByDescriptionStatusId = null;

  public function getFunctionsRelatedByDescriptionStatusId(array $options = array())
  {
    if (!isset($this->functionsRelatedByDescriptionStatusId))
    {
      if (!isset($this->id))
      {
        $this->functionsRelatedByDescriptionStatusId = QubitQuery::create();
      }
      else
      {
        $this->functionsRelatedByDescriptionStatusId = self::getFunctionsRelatedByDescriptionStatusIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionsRelatedByDescriptionStatusId;
  }

  public static function addFunctionsRelatedByDescriptionLevelIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunction::DESCRIPTION_LEVEL_ID, $id);

    return $criteria;
  }

  public static function getFunctionsRelatedByDescriptionLevelIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addFunctionsRelatedByDescriptionLevelIdCriteriaById($criteria, $id);

    return QubitFunction::get($criteria, $options);
  }

  public function addFunctionsRelatedByDescriptionLevelIdCriteria(Criteria $criteria)
  {
    return self::addFunctionsRelatedByDescriptionLevelIdCriteriaById($criteria, $this->id);
  }

  protected $functionsRelatedByDescriptionLevelId = null;

  public function getFunctionsRelatedByDescriptionLevelId(array $options = array())
  {
    if (!isset($this->functionsRelatedByDescriptionLevelId))
    {
      if (!isset($this->id))
      {
        $this->functionsRelatedByDescriptionLevelId = QubitQuery::create();
      }
      else
      {
        $this->functionsRelatedByDescriptionLevelId = self::getFunctionsRelatedByDescriptionLevelIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionsRelatedByDescriptionLevelId;
  }

  public static function addRightssCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRights::PERMISSION_ID, $id);

    return $criteria;
  }

  public static function getRightssById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightssCriteriaById($criteria, $id);

    return QubitRights::get($criteria, $options);
  }

  public function addRightssCriteria(Criteria $criteria)
  {
    return self::addRightssCriteriaById($criteria, $this->id);
  }

  protected $rightss = null;

  public function getRightss(array $options = array())
  {
    if (!isset($this->rightss))
    {
      if (!isset($this->id))
      {
        $this->rightss = QubitQuery::create();
      }
      else
      {
        $this->rightss = self::getRightssById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightss;
  }

  public static function addRightsTermRelationsRelatedByTermIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsTermRelation::TERM_ID, $id);

    return $criteria;
  }

  public static function getRightsTermRelationsRelatedByTermIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightsTermRelationsRelatedByTermIdCriteriaById($criteria, $id);

    return QubitRightsTermRelation::get($criteria, $options);
  }

  public function addRightsTermRelationsRelatedByTermIdCriteria(Criteria $criteria)
  {
    return self::addRightsTermRelationsRelatedByTermIdCriteriaById($criteria, $this->id);
  }

  protected $rightsTermRelationsRelatedByTermId = null;

  public function getRightsTermRelationsRelatedByTermId(array $options = array())
  {
    if (!isset($this->rightsTermRelationsRelatedByTermId))
    {
      if (!isset($this->id))
      {
        $this->rightsTermRelationsRelatedByTermId = QubitQuery::create();
      }
      else
      {
        $this->rightsTermRelationsRelatedByTermId = self::getRightsTermRelationsRelatedByTermIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsTermRelationsRelatedByTermId;
  }

  public static function addRightsTermRelationsRelatedByTypeIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsTermRelation::TYPE_ID, $id);

    return $criteria;
  }

  public static function getRightsTermRelationsRelatedByTypeIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightsTermRelationsRelatedByTypeIdCriteriaById($criteria, $id);

    return QubitRightsTermRelation::get($criteria, $options);
  }

  public function addRightsTermRelationsRelatedByTypeIdCriteria(Criteria $criteria)
  {
    return self::addRightsTermRelationsRelatedByTypeIdCriteriaById($criteria, $this->id);
  }

  protected $rightsTermRelationsRelatedByTypeId = null;

  public function getRightsTermRelationsRelatedByTypeId(array $options = array())
  {
    if (!isset($this->rightsTermRelationsRelatedByTypeId))
    {
      if (!isset($this->id))
      {
        $this->rightsTermRelationsRelatedByTypeId = QubitQuery::create();
      }
      else
      {
        $this->rightsTermRelationsRelatedByTypeId = self::getRightsTermRelationsRelatedByTypeIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsTermRelationsRelatedByTypeId;
  }

  public static function addRightsActorRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsActorRelation::TYPE_ID, $id);

    return $criteria;
  }

  public static function getRightsActorRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightsActorRelationsCriteriaById($criteria, $id);

    return QubitRightsActorRelation::get($criteria, $options);
  }

  public function addRightsActorRelationsCriteria(Criteria $criteria)
  {
    return self::addRightsActorRelationsCriteriaById($criteria, $this->id);
  }

  protected $rightsActorRelations = null;

  public function getRightsActorRelations(array $options = array())
  {
    if (!isset($this->rightsActorRelations))
    {
      if (!isset($this->id))
      {
        $this->rightsActorRelations = QubitQuery::create();
      }
      else
      {
        $this->rightsActorRelations = self::getRightsActorRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsActorRelations;
  }

  public function getName(array $options = array())
  {
    return $this->getCurrentTermI18n($options)->getName();
  }

  public function setName($value, array $options = array())
  {
    $this->getCurrentTermI18n($options)->setName($value);

    return $this;
  }

  public function getScopeNote(array $options = array())
  {
    return $this->getCurrentTermI18n($options)->getScopeNote();
  }

  public function setScopeNote($value, array $options = array())
  {
    $this->getCurrentTermI18n($options)->setScopeNote($value);

    return $this;
  }

  public function getCodeAlpha(array $options = array())
  {
    return $this->getCurrentTermI18n($options)->getCodeAlpha();
  }

  public function setCodeAlpha($value, array $options = array())
  {
    $this->getCurrentTermI18n($options)->setCodeAlpha($value);

    return $this;
  }

  public function getCodeAlpha2(array $options = array())
  {
    return $this->getCurrentTermI18n($options)->getCodeAlpha2();
  }

  public function setCodeAlpha2($value, array $options = array())
  {
    $this->getCurrentTermI18n($options)->setCodeAlpha2($value);

    return $this;
  }

  public function getSource(array $options = array())
  {
    return $this->getCurrentTermI18n($options)->getSource();
  }

  public function setSource($value, array $options = array())
  {
    $this->getCurrentTermI18n($options)->setSource($value);

    return $this;
  }

  public function getCurrentTermI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->termI18ns[$options['culture']]))
    {
      if (null === $termI18n = QubitTermI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $termI18n = new QubitTermI18n;
        $termI18n->setCulture($options['culture']);
      }
      $this->termI18ns[$options['culture']] = $termI18n;
    }

    return $this->termI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitTerm::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitTerm::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  protected $ancestors = null;

  public function getAncestors(array $options = array())
  {
    if (!isset($this->ancestors))
    {
      if ($this->new)
      {
        $this->ancestors = QubitQuery::create(array('self' => $this) + $options);
      }
      else
      {
        $criteria = new Criteria;
        $this->addAncestorsCriteria($criteria);
        $this->addOrderByPreorder($criteria);
        $this->ancestors = self::get($criteria, array('self' => $this) + $options);
      }
    }

    return $this->ancestors;
  }

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitTerm::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitTerm::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected $descendants = null;

  public function getDescendants(array $options = array())
  {
    if (!isset($this->descendants))
    {
      if ($this->new)
      {
        $this->descendants = QubitQuery::create(array('self' => $this) + $options);
      }
      else
      {
        $criteria = new Criteria;
        $this->addDescendantsCriteria($criteria);
        $this->addOrderByPreorder($criteria);
        $this->descendants = self::get($criteria, array('self' => $this) + $options);
      }
    }

    return $this->descendants;
  }

  protected function updateNestedSet($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTerm::DATABASE_NAME);
    }

    if (null === $parent = $this->getParent(array('connection' => $connection)))
    {
      $stmt = $connection->prepareStatement('
        SELECT MAX('.QubitTerm::RGT.')
        FROM '.QubitTerm::TABLE_NAME);
      $results = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);
      $results->next();
      $max = $results->getInt(1);

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $this->lft = $max + 1;
        $this->rgt = $max + 2;

        return $this;
      }

      $shift = $max + 1 - $this->lft;
    }
    else
    {
      $parent->refresh(array('connection' => $connection));

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $delta = 2;
      }
      else
      {
        if ($this->lft <= $parent->lft && $this->rgt >= $parent->rgt)
        {
          throw new PropelException('An object cannot be a descendant of itself.');
        }

        $delta = $this->rgt - $this->lft + 1;
      }

      $stmt = $connection->prepareStatement('
        UPDATE '.QubitTerm::TABLE_NAME.'
        SET '.QubitTerm::LFT.' = '.QubitTerm::LFT.' + ?
        WHERE '.QubitTerm::LFT.' >= ?');
      $stmt->setInt(1, $delta);
      $stmt->setInt(2, $parent->rgt);
      $stmt->executeUpdate();

      $stmt = $connection->prepareStatement('
        UPDATE '.QubitTerm::TABLE_NAME.'
        SET '.QubitTerm::RGT.' = '.QubitTerm::RGT.' + ?
        WHERE '.QubitTerm::RGT.' >= ?');
      $stmt->setInt(1, $delta);
      $stmt->setInt(2, $parent->rgt);
      $stmt->executeUpdate();

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $this->lft = $parent->rgt;
        $this->rgt = $parent->rgt + 1;

        return $this;
      }

      if ($this->lft > $parent->rgt)
      {
        $this->lft += $delta;
        $this->rgt += $delta;
      }

      $shift = $parent->rgt - $this->lft;
    }

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitTerm::TABLE_NAME.'
      SET '.QubitTerm::LFT.' = '.QubitTerm::LFT.' + ?, '.QubitTerm::RGT.' = '.QubitTerm::RGT.' + ?
      WHERE '.QubitTerm::LFT.' >= ?
      AND '.QubitTerm::RGT.' <= ?');
    $stmt->setInt(1, $shift);
    $stmt->setInt(2, $shift);
    $stmt->setInt(3, $this->lft);
    $stmt->setInt(4, $this->rgt);
    $stmt->executeUpdate();

    $this->deleteFromNestedSet($connection);

    $this->columnValues['lft'] = $this->lft += $shift;
    $this->columnValues['rgt'] = $this->rgt += $shift;

    return $this;
  }

  protected function deleteFromNestedSet($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTerm::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitTerm::TABLE_NAME.'
      SET '.QubitTerm::LFT.' = '.QubitTerm::LFT.' - ?
      WHERE '.QubitTerm::LFT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitTerm::TABLE_NAME.'
      SET '.QubitTerm::RGT.' = '.QubitTerm::RGT.' - ?
      WHERE '.QubitTerm::RGT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.TermMapBuilder');
