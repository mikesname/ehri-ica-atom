<?php

abstract class BasePlace extends QubitTerm implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_place',

    ID = 'q_place.ID',
    COUNTRY_ID = 'q_place.COUNTRY_ID',
    TYPE_ID = 'q_place.TYPE_ID',
    LONGTITUDE = 'q_place.LONGTITUDE',
    LATITUDE = 'q_place.LATITUDE',
    ALTITUDE = 'q_place.ALTITUDE',
    SOURCE_CULTURE = 'q_place.SOURCE_CULTURE';

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

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitPlace::DATABASE_NAME)->getTable(QubitPlace::TABLE_NAME);
  }

  public function offsetExists($offset, array $options = array())
  {
    if (parent::offsetExists($offset, $options))
    {
      return true;
    }

    if ($this->getCurrentplaceI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrentplaceI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
    {
      return true;
    }

    return false;
  }

  public function offsetGet($offset, array $options = array())
  {
    if (null !== $value = parent::offsetGet($offset, $options))
    {
      return $value;
    }

    if (null !== $value = $this->getCurrentplaceI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrentplaceI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrentplaceI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
    {
      return $value;
    }
  }

  public function offsetSet($offset, $value, array $options = array())
  {
    parent::offsetSet($offset, $value, $options);

    $this->getCurrentplaceI18n($options)->offsetSet($offset, $value, $options);

    return $this;
  }

  public function offsetUnset($offset, array $options = array())
  {
    parent::offsetUnset($offset, $options);

    $this->getCurrentplaceI18n($options)->offsetUnset($offset, $options);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->placeI18ns as $placeI18n)
    {
      $placeI18n->setid($this->id);

      $affectedRows += $placeI18n->save($connection);
    }

    return $affectedRows;
  }

  public static function addJoincountryCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlace::COUNTRY_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPlace::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addplaceI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceI18n::ID, $id);

    return $criteria;
  }

  public static function getplaceI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addplaceI18nsCriteriaById($criteria, $id);

    return QubitPlaceI18n::get($criteria, $options);
  }

  public function addplaceI18nsCriteria(Criteria $criteria)
  {
    return self::addplaceI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $placeI18ns = null;

  public function getplaceI18ns(array $options = array())
  {
    if (!isset($this->placeI18ns))
    {
      if (!isset($this->id))
      {
        $this->placeI18ns = QubitQuery::create();
      }
      else
      {
        $this->placeI18ns = self::getplaceI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placeI18ns;
  }

  public static function addplaceMapRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPlaceMapRelation::PLACE_ID, $id);

    return $criteria;
  }

  public static function getplaceMapRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addplaceMapRelationsCriteriaById($criteria, $id);

    return QubitPlaceMapRelation::get($criteria, $options);
  }

  public function addplaceMapRelationsCriteria(Criteria $criteria)
  {
    return self::addplaceMapRelationsCriteriaById($criteria, $this->id);
  }

  protected
    $placeMapRelations = null;

  public function getplaceMapRelations(array $options = array())
  {
    if (!isset($this->placeMapRelations))
    {
      if (!isset($this->id))
      {
        $this->placeMapRelations = QubitQuery::create();
      }
      else
      {
        $this->placeMapRelations = self::getplaceMapRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->placeMapRelations;
  }

  public function getCurrentplaceI18n(array $options = array())
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
      if (!isset($this->id) || null === $placeI18n = QubitPlaceI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $placeI18n = new QubitPlaceI18n;
        $placeI18n->setculture($options['culture']);
      }
      $this->placeI18ns[$options['culture']] = $placeI18n;
    }

    return $this->placeI18ns[$options['culture']];
  }
}
