<?php

abstract class BasePlaceMapRelation extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_place_map_relation',

    ID = 'q_place_map_relation.ID',
    PLACE_ID = 'q_place_map_relation.PLACE_ID',
    MAP_ID = 'q_place_map_relation.MAP_ID',
    MAP_ICON_IMAGE_ID = 'q_place_map_relation.MAP_ICON_IMAGE_ID',
    MAP_ICON_DESCRIPTION = 'q_place_map_relation.MAP_ICON_DESCRIPTION',
    TYPE_ID = 'q_place_map_relation.TYPE_ID',
    CREATED_AT = 'q_place_map_relation.CREATED_AT',
    UPDATED_AT = 'q_place_map_relation.UPDATED_AT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitPlaceMapRelation::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitPlaceMapRelation::ID);
    $criteria->addSelectColumn(QubitPlaceMapRelation::PLACE_ID);
    $criteria->addSelectColumn(QubitPlaceMapRelation::MAP_ID);
    $criteria->addSelectColumn(QubitPlaceMapRelation::MAP_ICON_IMAGE_ID);
    $criteria->addSelectColumn(QubitPlaceMapRelation::MAP_ICON_DESCRIPTION);
    $criteria->addSelectColumn(QubitPlaceMapRelation::TYPE_ID);
    $criteria->addSelectColumn(QubitPlaceMapRelation::CREATED_AT);
    $criteria->addSelectColumn(QubitPlaceMapRelation::UPDATED_AT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPlaceMapRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPlaceMapRelation', $options);
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
    $criteria->add(QubitPlaceMapRelation::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitPlaceMapRelation::DATABASE_NAME)->getTable(QubitPlaceMapRelation::TABLE_NAME);
  }

  public static function addJoinplaceCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::PLACE_ID, QubitPlace::ID);

    return $criteria;
  }

  public static function addJoinmapCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::MAP_ID, QubitMap::ID);

    return $criteria;
  }

  public static function addJoinmapIconImageCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::MAP_ICON_IMAGE_ID, QubitDigitalObject::ID);

    return $criteria;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }
}
