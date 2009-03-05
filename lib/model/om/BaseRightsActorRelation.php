<?php

abstract class BaseRightsActorRelation extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_rights_actor_relation',

    ID = 'q_rights_actor_relation.ID',
    RIGHTS_ID = 'q_rights_actor_relation.RIGHTS_ID',
    ACTOR_ID = 'q_rights_actor_relation.ACTOR_ID',
    TYPE_ID = 'q_rights_actor_relation.TYPE_ID',
    CREATED_AT = 'q_rights_actor_relation.CREATED_AT',
    UPDATED_AT = 'q_rights_actor_relation.UPDATED_AT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitRightsActorRelation::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitRightsActorRelation::ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::RIGHTS_ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::ACTOR_ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::TYPE_ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::CREATED_AT);
    $criteria->addSelectColumn(QubitRightsActorRelation::UPDATED_AT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRightsActorRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRightsActorRelation', $options);
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
    $criteria->add(QubitRightsActorRelation::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitRightsActorRelation::DATABASE_NAME)->getTable(QubitRightsActorRelation::TABLE_NAME);
  }

  public static function addJoinrightsCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsActorRelation::RIGHTS_ID, QubitRights::ID);

    return $criteria;
  }

  public static function addJoinactorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsActorRelation::ACTOR_ID, QubitActor::ID);

    return $criteria;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsActorRelation::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }
}
