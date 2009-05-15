<?php

abstract class BaseRelation extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_relation',

    ID = 'q_relation.ID',
    SUBJECT_ID = 'q_relation.SUBJECT_ID',
    OBJECT_ID = 'q_relation.OBJECT_ID',
    TYPE_ID = 'q_relation.TYPE_ID',
    START_DATE = 'q_relation.START_DATE',
    END_DATE = 'q_relation.END_DATE',
    CREATED_AT = 'q_relation.CREATED_AT',
    UPDATED_AT = 'q_relation.UPDATED_AT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitRelation::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitRelation::ID);
    $criteria->addSelectColumn(QubitRelation::SUBJECT_ID);
    $criteria->addSelectColumn(QubitRelation::OBJECT_ID);
    $criteria->addSelectColumn(QubitRelation::TYPE_ID);
    $criteria->addSelectColumn(QubitRelation::START_DATE);
    $criteria->addSelectColumn(QubitRelation::END_DATE);
    $criteria->addSelectColumn(QubitRelation::CREATED_AT);
    $criteria->addSelectColumn(QubitRelation::UPDATED_AT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRelation', $options);
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
    $criteria->add(QubitRelation::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitRelation::DATABASE_NAME)->getTable(QubitRelation::TABLE_NAME);
  }

  public static function addJoinsubjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRelation::SUBJECT_ID, QubitObject::ID);

    return $criteria;
  }

  public static function addJoinobjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRelation::OBJECT_ID, QubitObject::ID);

    return $criteria;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRelation::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }
}
