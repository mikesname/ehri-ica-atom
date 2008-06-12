<?php

abstract class BasePhysicalObjectI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_physical_object_i18n';

  const NAME = 'q_physical_object_i18n.NAME';
  const DESCRIPTION = 'q_physical_object_i18n.DESCRIPTION';
  const LOCATION = 'q_physical_object_i18n.LOCATION';
  const ID = 'q_physical_object_i18n.ID';
  const CULTURE = 'q_physical_object_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitPhysicalObjectI18n::NAME);
    $criteria->addSelectColumn(QubitPhysicalObjectI18n::DESCRIPTION);
    $criteria->addSelectColumn(QubitPhysicalObjectI18n::LOCATION);
    $criteria->addSelectColumn(QubitPhysicalObjectI18n::ID);
    $criteria->addSelectColumn(QubitPhysicalObjectI18n::CULTURE);

    return $criteria;
  }

  protected static $physicalObjectI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$physicalObjectI18ns[$key = serialize(array($resultSet->getInt(4), $resultSet->getString(5)))]))
    {
      $physicalObjectI18n = new QubitPhysicalObjectI18n;
      $physicalObjectI18n->hydrate($resultSet);

      self::$physicalObjectI18ns[$key] = $physicalObjectI18n;
    }

    return self::$physicalObjectI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPhysicalObjectI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPhysicalObjectI18n', $options);
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

  public static function getByIdAndCulture($id, $culture, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitPhysicalObjectI18n::ID, $id);
    $criteria->add(QubitPhysicalObjectI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPhysicalObjectI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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

  protected $description = null;

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  protected $location = null;

  public function getLocation()
  {
    return $this->location;
  }

  public function setLocation($location)
  {
    $this->location = $location;

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

  protected $culture = null;

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;

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
    $this->columnValues['name'] = $this->name;
    $this->columnValues['description'] = $this->description;
    $this->columnValues['location'] = $this->location;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->name = $results->getString($columnOffset++);
    $this->description = $results->getString($columnOffset++);
    $this->location = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);
    $this->culture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPhysicalObjectI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPhysicalObjectI18n::ID, $this->id);
    $criteria->add(QubitPhysicalObjectI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitPhysicalObjectI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitPhysicalObjectI18n::DESCRIPTION, $this->description);
    }

    if ($this->isColumnModified('location'))
    {
      $criteria->add(QubitPhysicalObjectI18n::LOCATION, $this->location);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPhysicalObjectI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitPhysicalObjectI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPhysicalObjectI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitPhysicalObjectI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitPhysicalObjectI18n::DESCRIPTION, $this->description);
    }

    if ($this->isColumnModified('location'))
    {
      $criteria->add(QubitPhysicalObjectI18n::LOCATION, $this->location);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPhysicalObjectI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitPhysicalObjectI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPhysicalObjectI18n::ID, $this->id);
      $selectCriteria->add(QubitPhysicalObjectI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPhysicalObjectI18n::DATABASE_NAME);
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
    $criteria->add(QubitPhysicalObjectI18n::ID, $this->id);
    $criteria->add(QubitPhysicalObjectI18n::CULTURE, $this->culture);

    $affectedRows += self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $affectedRows;
  }

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setCulture($keys[1]);

	}

  public static function addJoinPhysicalObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPhysicalObjectI18n::ID, QubitPhysicalObject::ID);

    return $criteria;
  }

  public function getPhysicalObject(array $options = array())
  {
    return $this->physicalObject = QubitPhysicalObject::getById($this->id, $options);
  }

  public function setPhysicalObject(QubitPhysicalObject $physicalObject)
  {
    $this->id = $physicalObject->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.PhysicalObjectI18nMapBuilder');
