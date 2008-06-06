<?php

abstract class BaseHistoricalEvent extends QubitTerm
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_historical_event';

  const ID = 'q_historical_event.ID';
  const TYPE_ID = 'q_historical_event.TYPE_ID';
  const START_DATE = 'q_historical_event.START_DATE';
  const START_TIME = 'q_historical_event.START_TIME';
  const END_DATE = 'q_historical_event.END_DATE';
  const END_TIME = 'q_historical_event.END_TIME';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitHistoricalEvent::ID, QubitTerm::ID);

    $criteria->addSelectColumn(QubitHistoricalEvent::ID);
    $criteria->addSelectColumn(QubitHistoricalEvent::TYPE_ID);
    $criteria->addSelectColumn(QubitHistoricalEvent::START_DATE);
    $criteria->addSelectColumn(QubitHistoricalEvent::START_TIME);
    $criteria->addSelectColumn(QubitHistoricalEvent::END_DATE);
    $criteria->addSelectColumn(QubitHistoricalEvent::END_TIME);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitHistoricalEvent::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitHistoricalEvent', $options);
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
    $criteria->add(QubitHistoricalEvent::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
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

  protected $startTime = null;

  public function getStartTime(array $options = array())
  {
    $options += array('format' => 'H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->startTime);
    }

    return $this->startTime;
  }

  public function setStartTime($startTime)
  {
    if (is_string($startTime) && false === $startTime = strtotime($startTime))
    {
      throw new PropelException('Unable to parse date / time value for [startTime] from input: '.var_export($startTime, true));
    }

    $this->startTime = $startTime;

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

  protected $endTime = null;

  public function getEndTime(array $options = array())
  {
    $options += array('format' => 'H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->endTime);
    }

    return $this->endTime;
  }

  public function setEndTime($endTime)
  {
    if (is_string($endTime) && false === $endTime = strtotime($endTime))
    {
      throw new PropelException('Unable to parse date / time value for [endTime] from input: '.var_export($endTime, true));
    }

    $this->endTime = $endTime;

    return $this;
  }

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['startDate'] = $this->startDate;
    $this->columnValues['startTime'] = $this->startTime;
    $this->columnValues['endDate'] = $this->endDate;
    $this->columnValues['endTime'] = $this->endTime;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->startDate = $results->getString($columnOffset++);
    $this->startTime = $results->getTime($columnOffset++);
    $this->endDate = $results->getString($columnOffset++);
    $this->endTime = $results->getTime($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitHistoricalEvent::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitHistoricalEvent::ID, $this->id);

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
      $criteria->add(QubitHistoricalEvent::ID, $this->id);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitHistoricalEvent::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('startDate'))
    {
      $criteria->add(QubitHistoricalEvent::START_DATE, $this->startDate);
    }

    if ($this->isColumnModified('startTime'))
    {
      $criteria->add(QubitHistoricalEvent::START_TIME, $this->startTime);
    }

    if ($this->isColumnModified('endDate'))
    {
      $criteria->add(QubitHistoricalEvent::END_DATE, $this->endDate);
    }

    if ($this->isColumnModified('endTime'))
    {
      $criteria->add(QubitHistoricalEvent::END_TIME, $this->endTime);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitHistoricalEvent::DATABASE_NAME);
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
      $criteria->add(QubitHistoricalEvent::ID, $this->id);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitHistoricalEvent::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('startDate'))
    {
      $criteria->add(QubitHistoricalEvent::START_DATE, $this->startDate);
    }

    if ($this->isColumnModified('startTime'))
    {
      $criteria->add(QubitHistoricalEvent::START_TIME, $this->startTime);
    }

    if ($this->isColumnModified('endDate'))
    {
      $criteria->add(QubitHistoricalEvent::END_DATE, $this->endDate);
    }

    if ($this->isColumnModified('endTime'))
    {
      $criteria->add(QubitHistoricalEvent::END_TIME, $this->endTime);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitHistoricalEvent::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitHistoricalEvent::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitHistoricalEvent::TYPE_ID, QubitTerm::ID);

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
}

BasePeer::getMapBuilder('lib.model.map.HistoricalEventMapBuilder');
