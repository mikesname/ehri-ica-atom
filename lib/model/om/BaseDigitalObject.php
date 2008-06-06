<?php

abstract class BaseDigitalObject extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_digital_object';

  const ID = 'q_digital_object.ID';
  const INFORMATION_OBJECT_ID = 'q_digital_object.INFORMATION_OBJECT_ID';
  const USAGE_ID = 'q_digital_object.USAGE_ID';
  const MIME_TYPE = 'q_digital_object.MIME_TYPE';
  const MEDIA_TYPE_ID = 'q_digital_object.MEDIA_TYPE_ID';
  const NAME = 'q_digital_object.NAME';
  const PATH = 'q_digital_object.PATH';
  const SEQUENCE = 'q_digital_object.SEQUENCE';
  const BYTE_SIZE = 'q_digital_object.BYTE_SIZE';
  const CHECKSUM = 'q_digital_object.CHECKSUM';
  const CHECKSUM_TYPE_ID = 'q_digital_object.CHECKSUM_TYPE_ID';
  const PARENT_ID = 'q_digital_object.PARENT_ID';
  const LFT = 'q_digital_object.LFT';
  const RGT = 'q_digital_object.RGT';
  const CREATED_AT = 'q_digital_object.CREATED_AT';
  const UPDATED_AT = 'q_digital_object.UPDATED_AT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitDigitalObject::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitDigitalObject::ID);
    $criteria->addSelectColumn(QubitDigitalObject::INFORMATION_OBJECT_ID);
    $criteria->addSelectColumn(QubitDigitalObject::USAGE_ID);
    $criteria->addSelectColumn(QubitDigitalObject::MIME_TYPE);
    $criteria->addSelectColumn(QubitDigitalObject::MEDIA_TYPE_ID);
    $criteria->addSelectColumn(QubitDigitalObject::NAME);
    $criteria->addSelectColumn(QubitDigitalObject::PATH);
    $criteria->addSelectColumn(QubitDigitalObject::SEQUENCE);
    $criteria->addSelectColumn(QubitDigitalObject::BYTE_SIZE);
    $criteria->addSelectColumn(QubitDigitalObject::CHECKSUM);
    $criteria->addSelectColumn(QubitDigitalObject::CHECKSUM_TYPE_ID);
    $criteria->addSelectColumn(QubitDigitalObject::PARENT_ID);
    $criteria->addSelectColumn(QubitDigitalObject::LFT);
    $criteria->addSelectColumn(QubitDigitalObject::RGT);
    $criteria->addSelectColumn(QubitDigitalObject::CREATED_AT);
    $criteria->addSelectColumn(QubitDigitalObject::UPDATED_AT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitDigitalObject::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitDigitalObject', $options);
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
    $criteria->add(QubitDigitalObject::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitDigitalObject::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitDigitalObject::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitDigitalObject::PARENT_ID);

    return $criteria;
  }

  protected $informationObjectId = null;

  public function getInformationObjectId()
  {
    return $this->informationObjectId;
  }

  public function setInformationObjectId($informationObjectId)
  {
    $this->informationObjectId = $informationObjectId;

    return $this;
  }

  protected $usageId = null;

  public function getUsageId()
  {
    return $this->usageId;
  }

  public function setUsageId($usageId)
  {
    $this->usageId = $usageId;

    return $this;
  }

  protected $mimeType = null;

  public function getMimeType()
  {
    return $this->mimeType;
  }

  public function setMimeType($mimeType)
  {
    $this->mimeType = $mimeType;

    return $this;
  }

  protected $mediaTypeId = null;

  public function getMediaTypeId()
  {
    return $this->mediaTypeId;
  }

  public function setMediaTypeId($mediaTypeId)
  {
    $this->mediaTypeId = $mediaTypeId;

    return $this;
  }

  protected $name = null;

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  protected $path = null;

  public function getPath()
  {
    return $this->path;
  }

  public function setPath($path)
  {
    $this->path = $path;

    return $this;
  }

  protected $sequence = null;

  public function getSequence()
  {
    return $this->sequence;
  }

  public function setSequence($sequence)
  {
    $this->sequence = $sequence;

    return $this;
  }

  protected $byteSize = null;

  public function getByteSize()
  {
    return $this->byteSize;
  }

  public function setByteSize($byteSize)
  {
    $this->byteSize = $byteSize;

    return $this;
  }

  protected $checksum = null;

  public function getChecksum()
  {
    return $this->checksum;
  }

  public function setChecksum($checksum)
  {
    $this->checksum = $checksum;

    return $this;
  }

  protected $checksumTypeId = null;

  public function getChecksumTypeId()
  {
    return $this->checksumTypeId;
  }

  public function setChecksumTypeId($checksumTypeId)
  {
    $this->checksumTypeId = $checksumTypeId;

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

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['informationObjectId'] = $this->informationObjectId;
    $this->columnValues['usageId'] = $this->usageId;
    $this->columnValues['mimeType'] = $this->mimeType;
    $this->columnValues['mediaTypeId'] = $this->mediaTypeId;
    $this->columnValues['name'] = $this->name;
    $this->columnValues['path'] = $this->path;
    $this->columnValues['sequence'] = $this->sequence;
    $this->columnValues['byteSize'] = $this->byteSize;
    $this->columnValues['checksum'] = $this->checksum;
    $this->columnValues['checksumTypeId'] = $this->checksumTypeId;
    $this->columnValues['parentId'] = $this->parentId;
    $this->columnValues['lft'] = $this->lft;
    $this->columnValues['rgt'] = $this->rgt;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->informationObjectId = $results->getInt($columnOffset++);
    $this->usageId = $results->getInt($columnOffset++);
    $this->mimeType = $results->getString($columnOffset++);
    $this->mediaTypeId = $results->getInt($columnOffset++);
    $this->name = $results->getString($columnOffset++);
    $this->path = $results->getString($columnOffset++);
    $this->sequence = $results->getInt($columnOffset++);
    $this->byteSize = $results->getInt($columnOffset++);
    $this->checksum = $results->getString($columnOffset++);
    $this->checksumTypeId = $results->getInt($columnOffset++);
    $this->parentId = $results->getInt($columnOffset++);
    $this->lft = $results->getInt($columnOffset++);
    $this->rgt = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitDigitalObject::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitDigitalObject::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $this->updateNestedSet($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitDigitalObject::ID, $this->id);
    }

    if ($this->isColumnModified('informationObjectId'))
    {
      $criteria->add(QubitDigitalObject::INFORMATION_OBJECT_ID, $this->informationObjectId);
    }

    if ($this->isColumnModified('usageId'))
    {
      $criteria->add(QubitDigitalObject::USAGE_ID, $this->usageId);
    }

    if ($this->isColumnModified('mimeType'))
    {
      $criteria->add(QubitDigitalObject::MIME_TYPE, $this->mimeType);
    }

    if ($this->isColumnModified('mediaTypeId'))
    {
      $criteria->add(QubitDigitalObject::MEDIA_TYPE_ID, $this->mediaTypeId);
    }

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitDigitalObject::NAME, $this->name);
    }

    if ($this->isColumnModified('path'))
    {
      $criteria->add(QubitDigitalObject::PATH, $this->path);
    }

    if ($this->isColumnModified('sequence'))
    {
      $criteria->add(QubitDigitalObject::SEQUENCE, $this->sequence);
    }

    if ($this->isColumnModified('byteSize'))
    {
      $criteria->add(QubitDigitalObject::BYTE_SIZE, $this->byteSize);
    }

    if ($this->isColumnModified('checksum'))
    {
      $criteria->add(QubitDigitalObject::CHECKSUM, $this->checksum);
    }

    if ($this->isColumnModified('checksumTypeId'))
    {
      $criteria->add(QubitDigitalObject::CHECKSUM_TYPE_ID, $this->checksumTypeId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitDigitalObject::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitDigitalObject::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitDigitalObject::RGT, $this->rgt);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitDigitalObject::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitDigitalObject::UPDATED_AT, $this->updatedAt);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitDigitalObject::DATABASE_NAME);
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
      $criteria->add(QubitDigitalObject::ID, $this->id);
    }

    if ($this->isColumnModified('informationObjectId'))
    {
      $criteria->add(QubitDigitalObject::INFORMATION_OBJECT_ID, $this->informationObjectId);
    }

    if ($this->isColumnModified('usageId'))
    {
      $criteria->add(QubitDigitalObject::USAGE_ID, $this->usageId);
    }

    if ($this->isColumnModified('mimeType'))
    {
      $criteria->add(QubitDigitalObject::MIME_TYPE, $this->mimeType);
    }

    if ($this->isColumnModified('mediaTypeId'))
    {
      $criteria->add(QubitDigitalObject::MEDIA_TYPE_ID, $this->mediaTypeId);
    }

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitDigitalObject::NAME, $this->name);
    }

    if ($this->isColumnModified('path'))
    {
      $criteria->add(QubitDigitalObject::PATH, $this->path);
    }

    if ($this->isColumnModified('sequence'))
    {
      $criteria->add(QubitDigitalObject::SEQUENCE, $this->sequence);
    }

    if ($this->isColumnModified('byteSize'))
    {
      $criteria->add(QubitDigitalObject::BYTE_SIZE, $this->byteSize);
    }

    if ($this->isColumnModified('checksum'))
    {
      $criteria->add(QubitDigitalObject::CHECKSUM, $this->checksum);
    }

    if ($this->isColumnModified('checksumTypeId'))
    {
      $criteria->add(QubitDigitalObject::CHECKSUM_TYPE_ID, $this->checksumTypeId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitDigitalObject::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitDigitalObject::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitDigitalObject::RGT, $this->rgt);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitDigitalObject::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitDigitalObject::UPDATED_AT, $this->updatedAt);

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitDigitalObject::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitDigitalObject::DATABASE_NAME);
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

    $this->deleteFromNestedSet($connection);

    $affectedRows += parent::delete($connection);

    return $affectedRows;
  }

  public static function addJoinInformationObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::INFORMATION_OBJECT_ID, QubitInformationObject::ID);

    return $criteria;
  }

  public function getInformationObject(array $options = array())
  {
    return $this->informationObject = QubitInformationObject::getById($this->informationObjectId, $options);
  }

  public function setInformationObject(QubitInformationObject $informationObject)
  {
    $this->informationObjectId = $informationObject->getId();

    return $this;
  }

  public static function addJoinUsageCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::USAGE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getUsage(array $options = array())
  {
    return $this->usage = QubitTerm::getById($this->usageId, $options);
  }

  public function setUsage(QubitTerm $term)
  {
    $this->usageId = $term->getId();

    return $this;
  }

  public static function addJoinMediaTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::MEDIA_TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getMediaType(array $options = array())
  {
    return $this->mediaType = QubitTerm::getById($this->mediaTypeId, $options);
  }

  public function setMediaType(QubitTerm $term)
  {
    $this->mediaTypeId = $term->getId();

    return $this;
  }

  public static function addJoinChecksumTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::CHECKSUM_TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getChecksumType(array $options = array())
  {
    return $this->checksumType = QubitTerm::getById($this->checksumTypeId, $options);
  }

  public function setChecksumType(QubitTerm $term)
  {
    $this->checksumTypeId = $term->getId();

    return $this;
  }

  public static function addJoinParentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::PARENT_ID, QubitDigitalObject::ID);

    return $criteria;
  }

  public function getParent(array $options = array())
  {
    return $this->parent = QubitDigitalObject::getById($this->parentId, $options);
  }

  public function setParent(QubitDigitalObject $digitalObject)
  {
    $this->parentId = $digitalObject->getId();

    return $this;
  }

  public static function addDigitalObjectsRelatedByParentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::PARENT_ID, $id);

    return $criteria;
  }

  public static function getDigitalObjectsRelatedByParentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addDigitalObjectsRelatedByParentIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function addDigitalObjectsRelatedByParentIdCriteria(Criteria $criteria)
  {
    return self::addDigitalObjectsRelatedByParentIdCriteriaById($criteria, $this->id);
  }

  protected $digitalObjectsRelatedByParentId = null;

  public function getDigitalObjectsRelatedByParentId(array $options = array())
  {
    if (!isset($this->digitalObjectsRelatedByParentId))
    {
      if (!isset($this->id))
      {
        $this->digitalObjectsRelatedByParentId = QubitQuery::create();
      }
      else
      {
        $this->digitalObjectsRelatedByParentId = self::getDigitalObjectsRelatedByParentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjectsRelatedByParentId;
  }

  public static function addPlaceMapRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceMapRelation::MAP_ICON_IMAGE_ID, $id);

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

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitDigitalObject::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitDigitalObject::RGT, $this->rgt, Criteria::GREATER_THAN);
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
    return $criteria->add(QubitDigitalObject::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitDigitalObject::RGT, $this->rgt, Criteria::LESS_THAN);
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
      $connection = QubitTransactionFilter::getConnection(QubitDigitalObject::DATABASE_NAME);
    }

    if (null === $parent = $this->getParent(array('connection' => $connection)))
    {
      $stmt = $connection->prepareStatement('
        SELECT MAX('.QubitDigitalObject::RGT.')
        FROM '.QubitDigitalObject::TABLE_NAME);
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
        UPDATE '.QubitDigitalObject::TABLE_NAME.'
        SET '.QubitDigitalObject::LFT.' = '.QubitDigitalObject::LFT.' + ?
        WHERE '.QubitDigitalObject::LFT.' >= ?');
      $stmt->setInt(1, $delta);
      $stmt->setInt(2, $parent->rgt);
      $stmt->executeUpdate();

      $stmt = $connection->prepareStatement('
        UPDATE '.QubitDigitalObject::TABLE_NAME.'
        SET '.QubitDigitalObject::RGT.' = '.QubitDigitalObject::RGT.' + ?
        WHERE '.QubitDigitalObject::RGT.' >= ?');
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
      UPDATE '.QubitDigitalObject::TABLE_NAME.'
      SET '.QubitDigitalObject::LFT.' = '.QubitDigitalObject::LFT.' + ?, '.QubitDigitalObject::RGT.' = '.QubitDigitalObject::RGT.' + ?
      WHERE '.QubitDigitalObject::LFT.' >= ?
      AND '.QubitDigitalObject::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitDigitalObject::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitDigitalObject::TABLE_NAME.'
      SET '.QubitDigitalObject::LFT.' = '.QubitDigitalObject::LFT.' - ?
      WHERE '.QubitDigitalObject::LFT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitDigitalObject::TABLE_NAME.'
      SET '.QubitDigitalObject::RGT.' = '.QubitDigitalObject::RGT.' - ?
      WHERE '.QubitDigitalObject::RGT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.DigitalObjectMapBuilder');
