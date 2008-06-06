<?php

abstract class BaseProperty
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_property';

  const OBJECT_ID = 'q_property.OBJECT_ID';
  const SCOPE = 'q_property.SCOPE';
  const NAME = 'q_property.NAME';
  const VALUE = 'q_property.VALUE';
  const CREATED_AT = 'q_property.CREATED_AT';
  const UPDATED_AT = 'q_property.UPDATED_AT';
  const ID = 'q_property.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitProperty::OBJECT_ID);
    $criteria->addSelectColumn(QubitProperty::SCOPE);
    $criteria->addSelectColumn(QubitProperty::NAME);
    $criteria->addSelectColumn(QubitProperty::VALUE);
    $criteria->addSelectColumn(QubitProperty::CREATED_AT);
    $criteria->addSelectColumn(QubitProperty::UPDATED_AT);
    $criteria->addSelectColumn(QubitProperty::ID);

    return $criteria;
  }

  protected static $propertys = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$propertys[$id = $resultSet->getInt(7)]))
    {
      $property = new QubitProperty;
      $property->hydrate($resultSet);

      self::$propertys[$id] = $property;
    }

    return self::$propertys[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitProperty::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitProperty', $options);
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
    $criteria->add(QubitProperty::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitProperty::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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

  protected $scope = null;

  public function getScope()
  {
    return $this->scope;
  }

  public function setScope($scope)
  {
    $this->scope = $scope;

    return $this;
  }

  protected $name = null;

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  protected $value = null;

  public function getValue()
  {
    return $this->value;
  }

  public function setValue($value)
  {
    $this->value = $value;

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
    $this->columnValues['objectId'] = $this->objectId;
    $this->columnValues['scope'] = $this->scope;
    $this->columnValues['name'] = $this->name;
    $this->columnValues['value'] = $this->value;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->objectId = $results->getInt($columnOffset++);
    $this->scope = $results->getString($columnOffset++);
    $this->name = $results->getString($columnOffset++);
    $this->value = $results->getString($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitProperty::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitProperty::ID, $this->id);

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

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitProperty::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('scope'))
    {
      $criteria->add(QubitProperty::SCOPE, $this->scope);
    }

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitProperty::NAME, $this->name);
    }

    if ($this->isColumnModified('value'))
    {
      $criteria->add(QubitProperty::VALUE, $this->value);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitProperty::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitProperty::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitProperty::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitProperty::DATABASE_NAME);
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

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitProperty::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('scope'))
    {
      $criteria->add(QubitProperty::SCOPE, $this->scope);
    }

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitProperty::NAME, $this->name);
    }

    if ($this->isColumnModified('value'))
    {
      $criteria->add(QubitProperty::VALUE, $this->value);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitProperty::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitProperty::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitProperty::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitProperty::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitProperty::DATABASE_NAME);
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
    $criteria->add(QubitProperty::ID, $this->id);

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

  public static function addJoinObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitProperty::OBJECT_ID, QubitObject::ID);

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
}

BasePeer::getMapBuilder('lib.model.map.PropertyMapBuilder');
