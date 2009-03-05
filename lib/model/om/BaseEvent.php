<?php

abstract class BaseEvent extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_event',

    ID = 'q_event.ID',
    START_DATE = 'q_event.START_DATE',
    START_TIME = 'q_event.START_TIME',
    END_DATE = 'q_event.END_DATE',
    END_TIME = 'q_event.END_TIME',
    TYPE_ID = 'q_event.TYPE_ID',
    INFORMATION_OBJECT_ID = 'q_event.INFORMATION_OBJECT_ID',
    ACTOR_ID = 'q_event.ACTOR_ID',
    CREATED_AT = 'q_event.CREATED_AT',
    UPDATED_AT = 'q_event.UPDATED_AT',
    SOURCE_CULTURE = 'q_event.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitEvent::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitEvent::ID);
    $criteria->addSelectColumn(QubitEvent::START_DATE);
    $criteria->addSelectColumn(QubitEvent::START_TIME);
    $criteria->addSelectColumn(QubitEvent::END_DATE);
    $criteria->addSelectColumn(QubitEvent::END_TIME);
    $criteria->addSelectColumn(QubitEvent::TYPE_ID);
    $criteria->addSelectColumn(QubitEvent::INFORMATION_OBJECT_ID);
    $criteria->addSelectColumn(QubitEvent::ACTOR_ID);
    $criteria->addSelectColumn(QubitEvent::CREATED_AT);
    $criteria->addSelectColumn(QubitEvent::UPDATED_AT);
    $criteria->addSelectColumn(QubitEvent::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitEvent::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitEvent', $options);
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
    $criteria->add(QubitEvent::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitEvent::DATABASE_NAME)->getTable(QubitEvent::TABLE_NAME);
  }

  public function offsetExists($offset, array $options = array())
  {
    if (parent::offsetExists($offset, $options))
    {
      return true;
    }

    if ($this->getCurrenteventI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrenteventI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
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

    if (null !== $value = $this->getCurrenteventI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrenteventI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrenteventI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
    {
      return $value;
    }
  }

  public function offsetSet($offset, $value, array $options = array())
  {
    parent::offsetSet($offset, $value, $options);

    $this->getCurrenteventI18n($options)->offsetSet($offset, $value, $options);

    return $this;
  }

  public function offsetUnset($offset, array $options = array())
  {
    parent::offsetUnset($offset, $options);

    $this->getCurrenteventI18n($options)->offsetUnset($offset, $options);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->eventI18ns as $eventI18n)
    {
      $eventI18n->setid($this->id);

      $affectedRows += $eventI18n->save($connection);
    }

    return $affectedRows;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEvent::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoininformationObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEvent::INFORMATION_OBJECT_ID, QubitInformationObject::ID);

    return $criteria;
  }

  public static function addJoinactorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEvent::ACTOR_ID, QubitActor::ID);

    return $criteria;
  }

  public static function addeventI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEventI18n::ID, $id);

    return $criteria;
  }

  public static function geteventI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addeventI18nsCriteriaById($criteria, $id);

    return QubitEventI18n::get($criteria, $options);
  }

  public function addeventI18nsCriteria(Criteria $criteria)
  {
    return self::addeventI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $eventI18ns = null;

  public function geteventI18ns(array $options = array())
  {
    if (!isset($this->eventI18ns))
    {
      if (!isset($this->id))
      {
        $this->eventI18ns = QubitQuery::create();
      }
      else
      {
        $this->eventI18ns = self::geteventI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->eventI18ns;
  }

  public function getCurrenteventI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->eventI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $eventI18n = QubitEventI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $eventI18n = new QubitEventI18n;
        $eventI18n->setculture($options['culture']);
      }
      $this->eventI18ns[$options['culture']] = $eventI18n;
    }

    return $this->eventI18ns[$options['culture']];
  }
}
