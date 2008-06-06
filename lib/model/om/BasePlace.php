<?php

abstract class BasePlace extends QubitTerm
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_place';

  const ID = 'q_place.ID';
  const COUNTRY_ID = 'q_place.COUNTRY_ID';
  const TYPE_ID = 'q_place.TYPE_ID';
  const LONGTITUDE = 'q_place.LONGTITUDE';
  const LATITUDE = 'q_place.LATITUDE';
  const ALTITUDE = 'q_place.ALTITUDE';
  const SOURCE_CULTURE = 'q_place.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitPlace::ID, QubitTerm::ID);

    $criteria->addSelectColumn(QubitPlace::ID);
    $criteria->addSelectColumn(QubitPlace::COUNTRY_ID);
    $criteria->addSelectColumn(QubitPlace::TYPE_ID);
    $criteria->addSelectColumn(QubitPlace::LONGTITUDE);
    $criteria->addSelectColumn(QubitPlace::LATITUDE);
    $criteria->addSelectColumn(QubitPlace::ALTITUDE);
    $criteria->addSelectColumn(QubitPlace::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPlace::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPlace', $options);
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
    $criteria->add(QubitPlace::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  protected $countryId = null;

  public function getCountryId()
  {
    return $this->countryId;
  }

  public function setCountryId($countryId)
  {
    $this->countryId = $countryId;

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

  protected $longtitude = null;

  public function getLongtitude()
  {
    return $this->longtitude;
  }

  public function setLongtitude($longtitude)
  {
    $this->longtitude = $longtitude;

    return $this;
  }

  protected $latitude = null;

  public function getLatitude()
  {
    return $this->latitude;
  }

  public function setLatitude($latitude)
  {
    $this->latitude = $latitude;

    return $this;
  }

  protected $altitude = null;

  public function getAltitude()
  {
    return $this->altitude;
  }

  public function setAltitude($altitude)
  {
    $this->altitude = $altitude;

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

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['countryId'] = $this->countryId;
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['longtitude'] = $this->longtitude;
    $this->columnValues['latitude'] = $this->latitude;
    $this->columnValues['altitude'] = $this->altitude;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->countryId = $results->getInt($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->longtitude = $results->getFloat($columnOffset++);
    $this->latitude = $results->getFloat($columnOffset++);
    $this->altitude = $results->getFloat($columnOffset++);
    $this->sourceCulture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPlace::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPlace::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->placeI18ns as $placeI18n)
    {
      $placeI18n->setId($this->id);

      $affectedRows += $placeI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPlace::ID, $this->id);
    }

    if ($this->isColumnModified('countryId'))
    {
      $criteria->add(QubitPlace::COUNTRY_ID, $this->countryId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitPlace::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('longtitude'))
    {
      $criteria->add(QubitPlace::LONGTITUDE, $this->longtitude);
    }

    if ($this->isColumnModified('latitude'))
    {
      $criteria->add(QubitPlace::LATITUDE, $this->latitude);
    }

    if ($this->isColumnModified('altitude'))
    {
      $criteria->add(QubitPlace::ALTITUDE, $this->altitude);
    }

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitPlace::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPlace::DATABASE_NAME);
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
      $criteria->add(QubitPlace::ID, $this->id);
    }

    if ($this->isColumnModified('countryId'))
    {
      $criteria->add(QubitPlace::COUNTRY_ID, $this->countryId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitPlace::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('longtitude'))
    {
      $criteria->add(QubitPlace::LONGTITUDE, $this->longtitude);
    }

    if ($this->isColumnModified('latitude'))
    {
      $criteria->add(QubitPlace::LATITUDE, $this->latitude);
    }

    if ($this->isColumnModified('altitude'))
    {
      $criteria->add(QubitPlace::ALTITUDE, $this->altitude);
    }

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitPlace::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPlace::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPlace::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinCountryCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlace::COUNTRY_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getCountry(array $options = array())
  {
    return $this->country = QubitTerm::getById($this->countryId, $options);
  }

  public function setCountry(QubitTerm $term)
  {
    $this->countryId = $term->getId();

    return $this;
  }

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlace::TYPE_ID, QubitTerm::ID);

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

  public static function addPlaceI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceI18n::ID, $id);

    return $criteria;
  }

  public static function getPlaceI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPlaceI18nsCriteriaById($criteria, $id);

    return QubitPlaceI18n::get($criteria, $options);
  }

  public function addPlaceI18nsCriteria(Criteria $criteria)
  {
    return self::addPlaceI18nsCriteriaById($criteria, $this->id);
  }

  protected $placeI18ns = null;

  public function getPlaceI18ns(array $options = array())
  {
    if (!isset($this->placeI18ns))
    {
      if (!isset($this->id))
      {
        $this->placeI18ns = QubitQuery::create();
      }
      else
      {
        $this->placeI18ns = self::getPlaceI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placeI18ns;
  }

  public static function addPlaceMapRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceMapRelation::PLACE_ID, $id);

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

  public function getStreetAddress(array $options = array())
  {
    return $this->getCurrentPlaceI18n($options)->getStreetAddress();
  }

  public function setStreetAddress($value, array $options = array())
  {
    $this->getCurrentPlaceI18n($options)->setStreetAddress($value);

    return $this;
  }

  public function getCity(array $options = array())
  {
    return $this->getCurrentPlaceI18n($options)->getCity();
  }

  public function setCity($value, array $options = array())
  {
    $this->getCurrentPlaceI18n($options)->setCity($value);

    return $this;
  }

  public function getRegion(array $options = array())
  {
    return $this->getCurrentPlaceI18n($options)->getRegion();
  }

  public function setRegion($value, array $options = array())
  {
    $this->getCurrentPlaceI18n($options)->setRegion($value);

    return $this;
  }

  public function getPostalCode(array $options = array())
  {
    return $this->getCurrentPlaceI18n($options)->getPostalCode();
  }

  public function setPostalCode($value, array $options = array())
  {
    $this->getCurrentPlaceI18n($options)->setPostalCode($value);

    return $this;
  }

  public function getCurrentPlaceI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->placeI18ns[$options['culture']]))
    {
      if (null === $placeI18n = QubitPlaceI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $placeI18n = new QubitPlaceI18n;
        $placeI18n->setCulture($options['culture']);
      }
      $this->placeI18ns[$options['culture']] = $placeI18n;
    }

    return $this->placeI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.PlaceMapBuilder');
