<?php

abstract class BasePhysicalObject extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_physical_object';

  const ID = 'q_physical_object.ID';
  const INFORMATION_OBJECT_ID = 'q_physical_object.INFORMATION_OBJECT_ID';
  const LOCATION_ID = 'q_physical_object.LOCATION_ID';
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
    $criteria->addSelectColumn(QubitPhysicalObject::INFORMATION_OBJECT_ID);
    $criteria->addSelectColumn(QubitPhysicalObject::LOCATION_ID);
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

  protected $locationId = null;

  public function getLocationId()
  {
    return $this->locationId;
  }

  public function setLocationId($locationId)
  {
    $this->locationId = $locationId;

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

  public function setLft($lft)
  {
    $this->lft = $lft;

    return $this;
  }

  protected $rgt = null;

  public function getRgt()
  {
    return $this->rgt;
  }

  public function setRgt($rgt)
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
    $this->columnValues['informationObjectId'] = $this->informationObjectId;
    $this->columnValues['locationId'] = $this->locationId;
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
    $this->informationObjectId = $results->getInt($columnOffset++);
    $this->locationId = $results->getInt($columnOffset++);
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

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPhysicalObject::ID, $this->id);
    }

    if ($this->isColumnModified('informationObjectId'))
    {
      $criteria->add(QubitPhysicalObject::INFORMATION_OBJECT_ID, $this->informationObjectId);
    }

    if ($this->isColumnModified('locationId'))
    {
      $criteria->add(QubitPhysicalObject::LOCATION_ID, $this->locationId);
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

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPhysicalObject::ID, $this->id);
    }

    if ($this->isColumnModified('informationObjectId'))
    {
      $criteria->add(QubitPhysicalObject::INFORMATION_OBJECT_ID, $this->informationObjectId);
    }

    if ($this->isColumnModified('locationId'))
    {
      $criteria->add(QubitPhysicalObject::LOCATION_ID, $this->locationId);
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

  public static function addJoinInformationObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPhysicalObject::INFORMATION_OBJECT_ID, QubitInformationObject::ID);

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

  public static function addJoinLocationCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPhysicalObject::LOCATION_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getLocation(array $options = array())
  {
    return $this->location = QubitTerm::getById($this->locationId, $options);
  }

  public function setLocation(QubitTerm $term)
  {
    $this->locationId = $term->getId();

    return $this;
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
    return $this->getCurrentPhysicalObjectI18n($options)->getName();
  }

  public function setName($value, array $options = array())
  {
    $this->getCurrentPhysicalObjectI18n($options)->setName($value);

    return $this;
  }

  public function getDescription(array $options = array())
  {
    return $this->getCurrentPhysicalObjectI18n($options)->getDescription();
  }

  public function setDescription($value, array $options = array())
  {
    $this->getCurrentPhysicalObjectI18n($options)->setDescription($value);

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
}

BasePeer::getMapBuilder('lib.model.map.PhysicalObjectMapBuilder');
