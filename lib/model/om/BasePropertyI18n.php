<?php

abstract class BasePropertyI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_property_i18n';

  const VALUE = 'q_property_i18n.VALUE';
  const ID = 'q_property_i18n.ID';
  const CULTURE = 'q_property_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitPropertyI18n::VALUE);
    $criteria->addSelectColumn(QubitPropertyI18n::ID);
    $criteria->addSelectColumn(QubitPropertyI18n::CULTURE);

    return $criteria;
  }

  protected static $propertyI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$propertyI18ns[$key = serialize(array($resultSet->getInt(2), $resultSet->getString(3)))]))
    {
      $propertyI18n = new QubitPropertyI18n;
      $propertyI18n->hydrate($resultSet);

      self::$propertyI18ns[$key] = $propertyI18n;
    }

    return self::$propertyI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPropertyI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPropertyI18n', $options);
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
    $criteria->add(QubitPropertyI18n::ID, $id);
    $criteria->add(QubitPropertyI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPropertyI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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
    $this->columnValues['value'] = $this->value;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->value = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitPropertyI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPropertyI18n::ID, $this->id);
    $criteria->add(QubitPropertyI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('value'))
    {
      $criteria->add(QubitPropertyI18n::VALUE, $this->value);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPropertyI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitPropertyI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPropertyI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('value'))
    {
      $criteria->add(QubitPropertyI18n::VALUE, $this->value);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPropertyI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitPropertyI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPropertyI18n::ID, $this->id);
      $selectCriteria->add(QubitPropertyI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPropertyI18n::DATABASE_NAME);
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
    $criteria->add(QubitPropertyI18n::ID, $this->id);
    $criteria->add(QubitPropertyI18n::CULTURE, $this->culture);

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

  public static function addJoinPropertyCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPropertyI18n::ID, QubitProperty::ID);

    return $criteria;
  }

  public function getProperty(array $options = array())
  {
    return $this->property = QubitProperty::getById($this->id, $options);
  }

  public function setProperty(QubitProperty $property)
  {
    $this->id = $property->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.PropertyI18nMapBuilder');
