<?php

abstract class BasePhysicalObject extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_physical_object';

  const ID = 'q_physical_object.ID';
  const TYPE_ID = 'q_physical_object.TYPE_ID';
  const PARENT_ID = 'q_physical_object.PARENT_ID';
  const LFT = 'q_physical_object.LFT';
  const RGT = 'q_physical_object.RGT';
  const CREATED_AT = 'q_physical_object.CREATED_AT';
  const UPDATED_AT = 'q_physical_object.UPDATED_AT';
  const SOURCE_CULTURE = 'q_physical_object.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitPhysicalObject::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitPhysicalObject::ID);
    $criteria->addSelectColumn(QubitPhysicalObject::TYPE_ID);
    $criteria->addSelectColumn(QubitPhysicalObject::PARENT_ID);
    $criteria->addSelectColumn(QubitPhysicalObject::LFT);
    $criteria->addSelectColumn(QubitPhysicalObject::RGT);
    $criteria->addSelectColumn(QubitPhysicalObject::CREATED_AT);
    $criteria->addSelectColumn(QubitPhysicalObject::UPDATED_AT);
    $criteria->addSelectColumn(QubitPhysicalObject::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPhysicalObject::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPhysicalObject', $options);
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
    $criteria->add(QubitPhysicalObject::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitPhysicalObject::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitPhysicalObject::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitPhysicalObject::PARENT_ID);

    return $criteria;
  }

  protected $typeId = null;

  public function getTypeId()
  {
    return $this->typeId;
  }

  public function setTypeId($typeId)
  {
    $this->typeId = $typeId;

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
    $this->columnValues['typeId'] = $this->typeId;
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
    $this->typeId = $results->getInt($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitPhysicalObject::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPhysicalObject::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->physicalObjectI18ns as $physicalObjectI18n)
    {
      $physicalObjectI18n->setId($this->id);

      $affectedRows += $physicalObjectI18n->save($connection);
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
      $criteria->add(QubitPhysicalObject::ID, $this->id);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitPhysicalObject::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitPhysicalObject::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitPhysicalObject::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitPhysicalObject::RGT, $this->rgt);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitPhysicalObject::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitPhysicalObject::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitPhysicalObject::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPhysicalObject::DATABASE_NAME);
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
      $criteria->add(QubitPhysicalObject::ID, $this->id);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitPhysicalObject::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitPhysicalObject::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitPhysicalObject::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitPhysicalObject::RGT, $this->rgt);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitPhysicalObject::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitPhysicalObject::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitPhysicalObject::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPhysicalObject::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPhysicalObject::DATABASE_NAME);
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

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPhysicalObject::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getType(array $options = array())
  {
    return $this->type = QubitTerm::getById($this->typeId, $options);
  }

  public function setType(QubitTerm $term)
  {
    $this->typeId = $term->getId();

    return $this;
  }

  public static function addJoinParentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPhysicalObject::PARENT_ID, QubitPhysicalObject::ID);

    return $criteria;
  }

  public function getParent(array $options = array())
  {
    return $this->parent = QubitPhysicalObject::getById($this->parentId, $options);
  }

  public function setParent(QubitPhysicalObject $physicalObject)
  {
    $this->parentId = $physicalObject->getId();

    return $this;
  }

  public static function addPhysicalObjectsRelatedByParentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPhysicalObject::PARENT_ID, $id);

    return $criteria;
  }

  public static function getPhysicalObjectsRelatedByParentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPhysicalObjectsRelatedByParentIdCriteriaById($criteria, $id);

    return QubitPhysicalObject::get($criteria, $options);
  }

  public function addPhysicalObjectsRelatedByParentIdCriteria(Criteria $criteria)
  {
    return self::addPhysicalObjectsRelatedByParentIdCriteriaById($criteria, $this->id);
  }

  protected $physicalObjectsRelatedByParentId = null;

  public function getPhysicalObjectsRelatedByParentId(array $options = array())
  {
    if (!isset($this->physicalObjectsRelatedByParentId))
    {
      if (!isset($this->id))
      {
        $this->physicalObjectsRelatedByParentId = QubitQuery::create();
      }
      else
      {
        $this->physicalObjectsRelatedByParentId = self::getPhysicalObjectsRelatedByParentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->physicalObjectsRelatedByParentId;
  }

  public static function addPhysicalObjectI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPhysicalObjectI18n::ID, $id);

    return $criteria;
  }

  public static function getPhysicalObjectI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPhysicalObjectI18nsCriteriaById($criteria, $id);

    return QubitPhysicalObjectI18n::get($criteria, $options);
  }

  public function addPhysicalObjectI18nsCriteria(Criteria $criteria)
  {
    return self::addPhysicalObjectI18nsCriteriaById($criteria, $this->id);
  }

  protected $physicalObjectI18ns = null;

  public function getPhysicalObjectI18ns(array $options = array())
  {
    if (!isset($this->physicalObjectI18ns))
    {
      if (!isset($this->id))
      {
        $this->physicalObjectI18ns = QubitQuery::create();
      }
      else
      {
        $this->physicalObjectI18ns = self::getPhysicalObjectI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->physicalObjectI18ns;
  }

  public function getName(array $options = array())
  {
    $name = $this->getCurrentPhysicalObjectI18n($options)->getName();
    if (!empty($options['cultureFallback']) && strlen($name) < 1)
    {
      $name = $this->getCurrentPhysicalObjectI18n(array('sourceCulture' => true) + $options)->getName();
    }

    return $name;
  }

  public function setName($value, array $options = array())
  {
    $this->getCurrentPhysicalObjectI18n($options)->setName($value);

    return $this;
  }

  public function getDescription(array $options = array())
  {
    $description = $this->getCurrentPhysicalObjectI18n($options)->getDescription();
    if (!empty($options['cultureFallback']) && strlen($description) < 1)
    {
      $description = $this->getCurrentPhysicalObjectI18n(array('sourceCulture' => true) + $options)->getDescription();
    }

    return $description;
  }

  public function setDescription($value, array $options = array())
  {
    $this->getCurrentPhysicalObjectI18n($options)->setDescription($value);

    return $this;
  }

  public function getLocation(array $options = array())
  {
    $location = $this->getCurrentPhysicalObjectI18n($options)->getLocation();
    if (!empty($options['cultureFallback']) && strlen($location) < 1)
    {
      $location = $this->getCurrentPhysicalObjectI18n(array('sourceCulture' => true) + $options)->getLocation();
    }

    return $location;
  }

  public function setLocation($value, array $options = array())
  {
    $this->getCurrentPhysicalObjectI18n($options)->setLocation($value);

    return $this;
  }

  public function getCurrentPhysicalObjectI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->physicalObjectI18ns[$options['culture']]))
    {
      if (null === $physicalObjectI18n = QubitPhysicalObjectI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $physicalObjectI18n = new QubitPhysicalObjectI18n;
        $physicalObjectI18n->setCulture($options['culture']);
      }
      $this->physicalObjectI18ns[$options['culture']] = $physicalObjectI18n;
    }

    return $this->physicalObjectI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitPhysicalObject::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitPhysicalObject::RGT, $this->rgt, Criteria::GREATER_THAN);
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
    return $criteria->add(QubitPhysicalObject::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitPhysicalObject::RGT, $this->rgt, Criteria::LESS_THAN);
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
      $connection = QubitTransactionFilter::getConnection(QubitPhysicalObject::DATABASE_NAME);
    }

    if (null === $parent = $this->getParent(array('connection' => $connection)))
    {
      $stmt = $connection->prepareStatement('
        SELECT MAX('.QubitPhysicalObject::RGT.')
        FROM '.QubitPhysicalObject::TABLE_NAME);
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
        UPDATE '.QubitPhysicalObject::TABLE_NAME.'
        SET '.QubitPhysicalObject::LFT.' = '.QubitPhysicalObject::LFT.' + ?
        WHERE '.QubitPhysicalObject::LFT.' >= ?');
      $stmt->setInt(1, $delta);
      $stmt->setInt(2, $parent->rgt);
      $stmt->executeUpdate();

      $stmt = $connection->prepareStatement('
        UPDATE '.QubitPhysicalObject::TABLE_NAME.'
        SET '.QubitPhysicalObject::RGT.' = '.QubitPhysicalObject::RGT.' + ?
        WHERE '.QubitPhysicalObject::RGT.' >= ?');
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
      UPDATE '.QubitPhysicalObject::TABLE_NAME.'
      SET '.QubitPhysicalObject::LFT.' = '.QubitPhysicalObject::LFT.' + ?, '.QubitPhysicalObject::RGT.' = '.QubitPhysicalObject::RGT.' + ?
      WHERE '.QubitPhysicalObject::LFT.' >= ?
      AND '.QubitPhysicalObject::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitPhysicalObject::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitPhysicalObject::TABLE_NAME.'
      SET '.QubitPhysicalObject::LFT.' = '.QubitPhysicalObject::LFT.' - ?
      WHERE '.QubitPhysicalObject::LFT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitPhysicalObject::TABLE_NAME.'
      SET '.QubitPhysicalObject::RGT.' = '.QubitPhysicalObject::RGT.' - ?
      WHERE '.QubitPhysicalObject::RGT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.PhysicalObjectMapBuilder');
