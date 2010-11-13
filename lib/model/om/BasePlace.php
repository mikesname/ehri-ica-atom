<?php

abstract class BasePlace extends QubitTerm implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'place',

    ID = 'place.ID',
    COUNTRY_ID = 'place.COUNTRY_ID',
    TYPE_ID = 'place.TYPE_ID',
    LONGTITUDE = 'place.LONGTITUDE',
    LATITUDE = 'place.LATITUDE',
    ALTITUDE = 'place.ALTITUDE',
    SOURCE_CULTURE = 'place.SOURCE_CULTURE';

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

    return self::get($criteria, $options)->__get(0, array('defaultValue' => null));
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

  public function __isset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    try
    {
      return call_user_func_array(array($this, 'QubitTerm::__isset'), $args);
    }
    catch (sfException $e)
    {
    }

    if ('placeI18ns' == $name)
    {
      return true;
    }

    if ('placeMapRelations' == $name)
    {
      return true;
    }

    try
    {
      if (!$value = call_user_func_array(array($this->getCurrentplaceI18n($options), '__isset'), $args) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentplaceI18n(array('sourceCulture' => true) + $options), '__isset'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
    }

    throw new sfException("Unknown record property \"$name\" on \"".get_class($this).'"');
  }

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    try
    {
      return call_user_func_array(array($this, 'QubitTerm::__get'), $args);
    }
    catch (sfException $e)
    {
    }

    if ('placeI18ns' == $name)
    {
      if (!isset($this->refFkValues['placeI18ns']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['placeI18ns'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['placeI18ns'] = self::getplaceI18nsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['placeI18ns'];
    }

    if ('placeMapRelations' == $name)
    {
      if (!isset($this->refFkValues['placeMapRelations']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['placeMapRelations'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['placeMapRelations'] = self::getplaceMapRelationsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['placeMapRelations'];
    }

    try
    {
      if (1 > strlen($value = call_user_func_array(array($this->getCurrentplaceI18n($options), '__get'), $args)) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentplaceI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
    }

    throw new sfException("Unknown record property \"$name\" on \"".get_class($this).'"');
  }

  public function __set($name, $value)
  {
    $args = func_get_args();

    $options = array();
    if (2 < count($args))
    {
      $options = $args[2];
    }

    call_user_func_array(array($this, 'QubitTerm::__set'), $args);

    call_user_func_array(array($this->getCurrentplaceI18n($options), '__set'), $args);

    return $this;
  }

  public function __unset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    call_user_func_array(array($this, 'QubitTerm::__unset'), $args);

    call_user_func_array(array($this->getCurrentplaceI18n($options), '__unset'), $args);

    return $this;
  }

  public function clear()
  {
    foreach ($this->placeI18ns as $placeI18n)
    {
      $placeI18n->clear();
    }

    return parent::clear();
  }

  public function save($connection = null)
  {
    parent::save($connection);

    foreach ($this->placeI18ns as $placeI18n)
    {
      $placeI18n->id = $this->id;

      $placeI18n->save($connection);
    }

    return $this;
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

    $placeI18ns = $this->placeI18ns->indexBy('culture');
    if (!isset($placeI18ns[$options['culture']]))
    {
      $placeI18ns[$options['culture']] = new QubitPlaceI18n;
    }

    return $placeI18ns[$options['culture']];
  }
}
