<?php

abstract class BaseHistoricalEvent extends QubitTerm implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'historical_event',

    ID = 'historical_event.ID',
    TYPE_ID = 'historical_event.TYPE_ID',
    START_DATE = 'historical_event.START_DATE',
    START_TIME = 'historical_event.START_TIME',
    END_DATE = 'historical_event.END_DATE',
    END_TIME = 'historical_event.END_TIME';

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

    return self::get($criteria, $options)->__get(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitHistoricalEvent::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitHistoricalEvent::DATABASE_NAME)->getTable(QubitHistoricalEvent::TABLE_NAME);
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitHistoricalEvent::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }
}
