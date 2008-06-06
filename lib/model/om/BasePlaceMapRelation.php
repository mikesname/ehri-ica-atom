<?php

abstract class BasePlaceMapRelation extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_place_map_relation';

  const ID = 'q_place_map_relation.ID';
  const PLACE_ID = 'q_place_map_relation.PLACE_ID';
  const MAP_ID = 'q_place_map_relation.MAP_ID';
  const MAP_ICON_IMAGE_ID = 'q_place_map_relation.MAP_ICON_IMAGE_ID';
  const MAP_ICON_DESCRIPTION = 'q_place_map_relation.MAP_ICON_DESCRIPTION';
  const TYPE_ID = 'q_place_map_relation.TYPE_ID';
  const CREATED_AT = 'q_place_map_relation.CREATED_AT';
  const UPDATED_AT = 'q_place_map_relation.UPDATED_AT';

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

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  protected $placeId = null;

  public function getPlaceId()
  {
    return $this->placeId;
  }

  public function setPlaceId($placeId)
  {
    $this->placeId = $placeId;

    return $this;
  }

  protected $mapId = null;

  public function getMapId()
  {
    return $this->mapId;
  }

  public function setMapId($mapId)
  {
    $this->mapId = $mapId;

    return $this;
  }

  protected $mapIconImageId = null;

  public function getMapIconImageId()
  {
    return $this->mapIconImageId;
  }

  public function setMapIconImageId($mapIconImageId)
  {
    $this->mapIconImageId = $mapIconImageId;

    return $this;
  }

  protected $mapIconDescription = null;

  public function getMapIconDescription()
  {
    return $this->mapIconDescription;
  }

  public function setMapIconDescription($mapIconDescription)
  {
    $this->mapIconDescription = $mapIconDescription;

    return $this;
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
    $this->columnValues['placeId'] = $this->placeId;
    $this->columnValues['mapId'] = $this->mapId;
    $this->columnValues['mapIconImageId'] = $this->mapIconImageId;
    $this->columnValues['mapIconDescription'] = $this->mapIconDescription;
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->placeId = $results->getInt($columnOffset++);
    $this->mapId = $results->getInt($columnOffset++);
    $this->mapIconImageId = $results->getInt($columnOffset++);
    $this->mapIconDescription = $results->getString($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitPlaceMapRelation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPlaceMapRelation::ID, $this->id);

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
      $criteria->add(QubitPlaceMapRelation::ID, $this->id);
    }

    if ($this->isColumnModified('placeId'))
    {
      $criteria->add(QubitPlaceMapRelation::PLACE_ID, $this->placeId);
    }

    if ($this->isColumnModified('mapId'))
    {
      $criteria->add(QubitPlaceMapRelation::MAP_ID, $this->mapId);
    }

    if ($this->isColumnModified('mapIconImageId'))
    {
      $criteria->add(QubitPlaceMapRelation::MAP_ICON_IMAGE_ID, $this->mapIconImageId);
    }

    if ($this->isColumnModified('mapIconDescription'))
    {
      $criteria->add(QubitPlaceMapRelation::MAP_ICON_DESCRIPTION, $this->mapIconDescription);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitPlaceMapRelation::TYPE_ID, $this->typeId);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitPlaceMapRelation::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitPlaceMapRelation::UPDATED_AT, $this->updatedAt);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPlaceMapRelation::DATABASE_NAME);
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
      $criteria->add(QubitPlaceMapRelation::ID, $this->id);
    }

    if ($this->isColumnModified('placeId'))
    {
      $criteria->add(QubitPlaceMapRelation::PLACE_ID, $this->placeId);
    }

    if ($this->isColumnModified('mapId'))
    {
      $criteria->add(QubitPlaceMapRelation::MAP_ID, $this->mapId);
    }

    if ($this->isColumnModified('mapIconImageId'))
    {
      $criteria->add(QubitPlaceMapRelation::MAP_ICON_IMAGE_ID, $this->mapIconImageId);
    }

    if ($this->isColumnModified('mapIconDescription'))
    {
      $criteria->add(QubitPlaceMapRelation::MAP_ICON_DESCRIPTION, $this->mapIconDescription);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitPlaceMapRelation::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitPlaceMapRelation::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitPlaceMapRelation::UPDATED_AT, $this->updatedAt);

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPlaceMapRelation::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPlaceMapRelation::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinPlaceCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::PLACE_ID, QubitPlace::ID);

    return $criteria;
  }

  public function getPlace(array $options = array())
  {
    return $this->place = QubitPlace::getById($this->placeId, $options);
  }

  public function setPlace(QubitPlace $place)
  {
    $this->placeId = $place->getId();

    return $this;
  }

  public static function addJoinMapCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::MAP_ID, QubitMap::ID);

    return $criteria;
  }

  public function getMap(array $options = array())
  {
    return $this->map = QubitMap::getById($this->mapId, $options);
  }

  public function setMap(QubitMap $map)
  {
    $this->mapId = $map->getId();

    return $this;
  }

  public static function addJoinMapIconImageCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::MAP_ICON_IMAGE_ID, QubitDigitalObject::ID);

    return $criteria;
  }

  public function getMapIconImage(array $options = array())
  {
    return $this->mapIconImage = QubitDigitalObject::getById($this->mapIconImageId, $options);
  }

  public function setMapIconImage(QubitDigitalObject $digitalObject)
  {
    $this->mapIconImageId = $digitalObject->getId();

    return $this;
  }

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceMapRelation::TYPE_ID, QubitTerm::ID);

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

BasePeer::getMapBuilder('lib.model.map.PlaceMapRelationMapBuilder');
