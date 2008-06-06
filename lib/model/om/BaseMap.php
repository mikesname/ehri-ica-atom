<?php

abstract class BaseMap
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_map';

  const CREATED_AT = 'q_map.CREATED_AT';
  const UPDATED_AT = 'q_map.UPDATED_AT';
  const SOURCE_CULTURE = 'q_map.SOURCE_CULTURE';
  const ID = 'q_map.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitMap::CREATED_AT);
    $criteria->addSelectColumn(QubitMap::UPDATED_AT);
    $criteria->addSelectColumn(QubitMap::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitMap::ID);

    return $criteria;
  }

  protected static $maps = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$maps[$id = $resultSet->getInt(4)]))
    {
      $map = new QubitMap;
      $map->hydrate($resultSet);

      self::$maps[$id] = $map;
    }

    return self::$maps[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitMap::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitMap', $options);
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
    $criteria->add(QubitMap::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMap::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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

  protected $id = null;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  protected $new = true;

  protected $deleted = false;

  protected $columnValues = null;

  protected function isColumnModified($name)
  {
    return $this->$name != $this->columnValues[$name];
  }

  protected function resetModified()
  {
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitMap::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitMap::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('You cannot save an object that has been deleted.');
    }

    $affectedRows = 0;

    if ($this->new)
    {
      $affectedRows += $this->insert($connection);
    }
    else
    {
      $affectedRows += $this->update($connection);
    }

    $this->new = false;
    $this->resetModified();

    foreach ($this->mapI18ns as $mapI18n)
    {
      $mapI18n->setId($this->id);

      $affectedRows += $mapI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitMap::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitMap::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitMap::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitMap::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMap::DATABASE_NAME);
    }

    $id = BasePeer::doInsert($criteria, $connection);
    $this->id = $id;
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitMap::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitMap::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitMap::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitMap::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitMap::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitMap::DATABASE_NAME);
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

    $criteria = new Criteria;
    $criteria->add(QubitMap::ID, $this->id);

    $affectedRows += self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $affectedRows;
  }

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

  public static function addMapI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitMapI18n::ID, $id);

    return $criteria;
  }

  public static function getMapI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addMapI18nsCriteriaById($criteria, $id);

    return QubitMapI18n::get($criteria, $options);
  }

  public function addMapI18nsCriteria(Criteria $criteria)
  {
    return self::addMapI18nsCriteriaById($criteria, $this->id);
  }

  protected $mapI18ns = null;

  public function getMapI18ns(array $options = array())
  {
    if (!isset($this->mapI18ns))
    {
      if (!isset($this->id))
      {
        $this->mapI18ns = QubitQuery::create();
      }
      else
      {
        $this->mapI18ns = self::getMapI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->mapI18ns;
  }

  public static function addPlaceMapRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceMapRelation::MAP_ID, $id);

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

  public function getTitle(array $options = array())
  {
    return $this->getCurrentMapI18n($options)->getTitle();
  }

  public function setTitle($value, array $options = array())
  {
    $this->getCurrentMapI18n($options)->setTitle($value);

    return $this;
  }

  public function getDescription(array $options = array())
  {
    return $this->getCurrentMapI18n($options)->getDescription();
  }

  public function setDescription($value, array $options = array())
  {
    $this->getCurrentMapI18n($options)->setDescription($value);

    return $this;
  }

  public function getCurrentMapI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->mapI18ns[$options['culture']]))
    {
      if (null === $mapI18n = QubitMapI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $mapI18n = new QubitMapI18n;
        $mapI18n->setCulture($options['culture']);
      }
      $this->mapI18ns[$options['culture']] = $mapI18n;
    }

    return $this->mapI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.MapMapBuilder');
