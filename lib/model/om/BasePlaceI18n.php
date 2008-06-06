<?php

abstract class BasePlaceI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_place_i18n';

  const STREET_ADDRESS = 'q_place_i18n.STREET_ADDRESS';
  const CITY = 'q_place_i18n.CITY';
  const REGION = 'q_place_i18n.REGION';
  const POSTAL_CODE = 'q_place_i18n.POSTAL_CODE';
  const ID = 'q_place_i18n.ID';
  const CULTURE = 'q_place_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitPlaceI18n::STREET_ADDRESS);
    $criteria->addSelectColumn(QubitPlaceI18n::CITY);
    $criteria->addSelectColumn(QubitPlaceI18n::REGION);
    $criteria->addSelectColumn(QubitPlaceI18n::POSTAL_CODE);
    $criteria->addSelectColumn(QubitPlaceI18n::ID);
    $criteria->addSelectColumn(QubitPlaceI18n::CULTURE);

    return $criteria;
  }

  protected static $placeI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$placeI18ns[$key = serialize(array($resultSet->getInt(5), $resultSet->getString(6)))]))
    {
      $placeI18n = new QubitPlaceI18n;
      $placeI18n->hydrate($resultSet);

      self::$placeI18ns[$key] = $placeI18n;
    }

    return self::$placeI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPlaceI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPlaceI18n', $options);
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
    $criteria->add(QubitPlaceI18n::ID, $id);
    $criteria->add(QubitPlaceI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPlaceI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $streetAddress = null;

  public function getStreetAddress()
  {
    return $this->streetAddress;
  }

  public function setStreetAddress($streetAddress)
  {
    $this->streetAddress = $streetAddress;

    return $this;
  }

  protected $city = null;

  public function getCity()
  {
    return $this->city;
  }

  public function setCity($city)
  {
    $this->city = $city;

    return $this;
  }

  protected $region = null;

  public function getRegion()
  {
    return $this->region;
  }

  public function setRegion($region)
  {
    $this->region = $region;

    return $this;
  }

  protected $postalCode = null;

  public function getPostalCode()
  {
    return $this->postalCode;
  }

  public function setPostalCode($postalCode)
  {
    $this->postalCode = $postalCode;

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
    $this->columnValues['streetAddress'] = $this->streetAddress;
    $this->columnValues['city'] = $this->city;
    $this->columnValues['region'] = $this->region;
    $this->columnValues['postalCode'] = $this->postalCode;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->streetAddress = $results->getString($columnOffset++);
    $this->city = $results->getString($columnOffset++);
    $this->region = $results->getString($columnOffset++);
    $this->postalCode = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitPlaceI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPlaceI18n::ID, $this->id);
    $criteria->add(QubitPlaceI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('streetAddress'))
    {
      $criteria->add(QubitPlaceI18n::STREET_ADDRESS, $this->streetAddress);
    }

    if ($this->isColumnModified('city'))
    {
      $criteria->add(QubitPlaceI18n::CITY, $this->city);
    }

    if ($this->isColumnModified('region'))
    {
      $criteria->add(QubitPlaceI18n::REGION, $this->region);
    }

    if ($this->isColumnModified('postalCode'))
    {
      $criteria->add(QubitPlaceI18n::POSTAL_CODE, $this->postalCode);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPlaceI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitPlaceI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPlaceI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('streetAddress'))
    {
      $criteria->add(QubitPlaceI18n::STREET_ADDRESS, $this->streetAddress);
    }

    if ($this->isColumnModified('city'))
    {
      $criteria->add(QubitPlaceI18n::CITY, $this->city);
    }

    if ($this->isColumnModified('region'))
    {
      $criteria->add(QubitPlaceI18n::REGION, $this->region);
    }

    if ($this->isColumnModified('postalCode'))
    {
      $criteria->add(QubitPlaceI18n::POSTAL_CODE, $this->postalCode);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPlaceI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitPlaceI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPlaceI18n::ID, $this->id);
      $selectCriteria->add(QubitPlaceI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPlaceI18n::DATABASE_NAME);
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
    $criteria->add(QubitPlaceI18n::ID, $this->id);
    $criteria->add(QubitPlaceI18n::CULTURE, $this->culture);

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

  public static function addJoinPlaceCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlaceI18n::ID, QubitPlace::ID);

    return $criteria;
  }

  public function getPlace(array $options = array())
  {
    return $this->place = QubitPlace::getById($this->id, $options);
  }

  public function setPlace(QubitPlace $place)
  {
    $this->id = $place->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.PlaceI18nMapBuilder');
