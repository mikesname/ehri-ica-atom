<?php

abstract class BaseObjectTermRelation extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_object_term_relation';

  const ID = 'q_object_term_relation.ID';
  const OBJECT_ID = 'q_object_term_relation.OBJECT_ID';
  const TERM_ID = 'q_object_term_relation.TERM_ID';
  const START_DATE = 'q_object_term_relation.START_DATE';
  const END_DATE = 'q_object_term_relation.END_DATE';
  const CREATED_AT = 'q_object_term_relation.CREATED_AT';
  const UPDATED_AT = 'q_object_term_relation.UPDATED_AT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitObjectTermRelation::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitObjectTermRelation::ID);
    $criteria->addSelectColumn(QubitObjectTermRelation::OBJECT_ID);
    $criteria->addSelectColumn(QubitObjectTermRelation::TERM_ID);
    $criteria->addSelectColumn(QubitObjectTermRelation::START_DATE);
    $criteria->addSelectColumn(QubitObjectTermRelation::END_DATE);
    $criteria->addSelectColumn(QubitObjectTermRelation::CREATED_AT);
    $criteria->addSelectColumn(QubitObjectTermRelation::UPDATED_AT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitObjectTermRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitObjectTermRelation', $options);
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
    $criteria->add(QubitObjectTermRelation::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  protected $objectId = null;

  public function getObjectId()
  {
    return $this->objectId;
  }

  public function setObjectId($objectId)
  {
    $this->objectId = $objectId;

    return $this;
  }

  protected $termId = null;

  public function getTermId()
  {
    return $this->termId;
  }

  public function setTermId($termId)
  {
    $this->termId = $termId;

    return $this;
  }

  protected $startDate = null;

  public function getStartDate()
  {
    return $this->startDate;
  }

  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;

    return $this;
  }

  protected $endDate = null;

  public function getEndDate()
  {
    return $this->endDate;
  }

  public function setEndDate($endDate)
  {
    $this->endDate = $endDate;

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
    $this->columnValues['objectId'] = $this->objectId;
    $this->columnValues['termId'] = $this->termId;
    $this->columnValues['startDate'] = $this->startDate;
    $this->columnValues['endDate'] = $this->endDate;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->objectId = $results->getInt($columnOffset++);
    $this->termId = $results->getInt($columnOffset++);
    $this->startDate = $results->getString($columnOffset++);
    $this->endDate = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitObjectTermRelation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitObjectTermRelation::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitObjectTermRelation::ID, $this->id);
    }

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('termId'))
    {
      $criteria->add(QubitObjectTermRelation::TERM_ID, $this->termId);
    }

    if ($this->isColumnModified('startDate'))
    {
      $criteria->add(QubitObjectTermRelation::START_DATE, $this->startDate);
    }

    if ($this->isColumnModified('endDate'))
    {
      $criteria->add(QubitObjectTermRelation::END_DATE, $this->endDate);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitObjectTermRelation::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitObjectTermRelation::UPDATED_AT, $this->updatedAt);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitObjectTermRelation::DATABASE_NAME);
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
      $criteria->add(QubitObjectTermRelation::ID, $this->id);
    }

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitObjectTermRelation::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('termId'))
    {
      $criteria->add(QubitObjectTermRelation::TERM_ID, $this->termId);
    }

    if ($this->isColumnModified('startDate'))
    {
      $criteria->add(QubitObjectTermRelation::START_DATE, $this->startDate);
    }

    if ($this->isColumnModified('endDate'))
    {
      $criteria->add(QubitObjectTermRelation::END_DATE, $this->endDate);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitObjectTermRelation::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitObjectTermRelation::UPDATED_AT, $this->updatedAt);

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitObjectTermRelation::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitObjectTermRelation::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitObjectTermRelation::OBJECT_ID, QubitObject::ID);

    return $criteria;
  }

  public function getObject(array $options = array())
  {
    return $this->object = QubitObject::getById($this->objectId, $options);
  }

  public function setObject(QubitObject $object)
  {
    $this->objectId = $object->getId();

    return $this;
  }

  public static function addJoinTermCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitObjectTermRelation::TERM_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getTerm(array $options = array())
  {
    return $this->term = QubitTerm::getById($this->termId, $options);
  }

  public function setTerm(QubitTerm $term)
  {
    $this->termId = $term->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.ObjectTermRelationMapBuilder');
