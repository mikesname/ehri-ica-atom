<?php

abstract class BaseEvent extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_event';

  const ID = 'q_event.ID';
  const START_DATE = 'q_event.START_DATE';
  const START_TIME = 'q_event.START_TIME';
  const END_DATE = 'q_event.END_DATE';
  const END_TIME = 'q_event.END_TIME';
  const TYPE_ID = 'q_event.TYPE_ID';
  const ACTOR_ROLE_ID = 'q_event.ACTOR_ROLE_ID';
  const INFORMATION_OBJECT_ID = 'q_event.INFORMATION_OBJECT_ID';
  const ACTOR_ID = 'q_event.ACTOR_ID';
  const CREATED_AT = 'q_event.CREATED_AT';
  const UPDATED_AT = 'q_event.UPDATED_AT';
  const SOURCE_CULTURE = 'q_event.SOURCE_CULTURE';

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
    $criteria->addSelectColumn(QubitEvent::ACTOR_ROLE_ID);
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

  protected $startDate = null;

  public function getStartDate()
  {
    return $this->startDate;
  }

  public function setStartDate($startDate)
  {
    $this->startDate = $startDate;

    return $this;
  }

  protected $startTime = null;

  public function getStartTime(array $options = array())
  {
    $options += array('format' => 'H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->startTime);
    }

    return $this->startTime;
  }

  public function setStartTime($startTime)
  {
    if (is_string($startTime) && false === $startTime = strtotime($startTime))
    {
      throw new PropelException('Unable to parse date / time value for [startTime] from input: '.var_export($startTime, true));
    }

    $this->startTime = $startTime;

    return $this;
  }

  protected $endDate = null;

  public function getEndDate()
  {
    return $this->endDate;
  }

  public function setEndDate($endDate)
  {
    $this->endDate = $endDate;

    return $this;
  }

  protected $endTime = null;

  public function getEndTime(array $options = array())
  {
    $options += array('format' => 'H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->endTime);
    }

    return $this->endTime;
  }

  public function setEndTime($endTime)
  {
    if (is_string($endTime) && false === $endTime = strtotime($endTime))
    {
      throw new PropelException('Unable to parse date / time value for [endTime] from input: '.var_export($endTime, true));
    }

    $this->endTime = $endTime;

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

  protected $actorRoleId = null;

  public function getActorRoleId()
  {
    return $this->actorRoleId;
  }

  public function setActorRoleId($actorRoleId)
  {
    $this->actorRoleId = $actorRoleId;

    return $this;
  }

  protected $informationObjectId = null;

  public function getInformationObjectId()
  {
    return $this->informationObjectId;
  }

  public function setInformationObjectId($informationObjectId)
  {
    $this->informationObjectId = $informationObjectId;

    return $this;
  }

  protected $actorId = null;

  public function getActorId()
  {
    return $this->actorId;
  }

  public function setActorId($actorId)
  {
    $this->actorId = $actorId;

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
    $this->columnValues['startDate'] = $this->startDate;
    $this->columnValues['startTime'] = $this->startTime;
    $this->columnValues['endDate'] = $this->endDate;
    $this->columnValues['endTime'] = $this->endTime;
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['actorRoleId'] = $this->actorRoleId;
    $this->columnValues['informationObjectId'] = $this->informationObjectId;
    $this->columnValues['actorId'] = $this->actorId;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->startDate = $results->getString($columnOffset++);
    $this->startTime = $results->getTime($columnOffset++);
    $this->endDate = $results->getString($columnOffset++);
    $this->endTime = $results->getTime($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->actorRoleId = $results->getInt($columnOffset++);
    $this->informationObjectId = $results->getInt($columnOffset++);
    $this->actorId = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitEvent::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitEvent::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->eventI18ns as $eventI18n)
    {
      $eventI18n->setId($this->id);

      $affectedRows += $eventI18n->save($connection);
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
      $criteria->add(QubitEvent::ID, $this->id);
    }

    if ($this->isColumnModified('startDate'))
    {
      $criteria->add(QubitEvent::START_DATE, $this->startDate);
    }

    if ($this->isColumnModified('startTime'))
    {
      $criteria->add(QubitEvent::START_TIME, $this->startTime);
    }

    if ($this->isColumnModified('endDate'))
    {
      $criteria->add(QubitEvent::END_DATE, $this->endDate);
    }

    if ($this->isColumnModified('endTime'))
    {
      $criteria->add(QubitEvent::END_TIME, $this->endTime);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitEvent::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('actorRoleId'))
    {
      $criteria->add(QubitEvent::ACTOR_ROLE_ID, $this->actorRoleId);
    }

    if ($this->isColumnModified('informationObjectId'))
    {
      $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->informationObjectId);
    }

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitEvent::ACTOR_ID, $this->actorId);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitEvent::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitEvent::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitEvent::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitEvent::DATABASE_NAME);
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
      $criteria->add(QubitEvent::ID, $this->id);
    }

    if ($this->isColumnModified('startDate'))
    {
      $criteria->add(QubitEvent::START_DATE, $this->startDate);
    }

    if ($this->isColumnModified('startTime'))
    {
      $criteria->add(QubitEvent::START_TIME, $this->startTime);
    }

    if ($this->isColumnModified('endDate'))
    {
      $criteria->add(QubitEvent::END_DATE, $this->endDate);
    }

    if ($this->isColumnModified('endTime'))
    {
      $criteria->add(QubitEvent::END_TIME, $this->endTime);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitEvent::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('actorRoleId'))
    {
      $criteria->add(QubitEvent::ACTOR_ROLE_ID, $this->actorRoleId);
    }

    if ($this->isColumnModified('informationObjectId'))
    {
      $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $this->informationObjectId);
    }

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitEvent::ACTOR_ID, $this->actorId);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitEvent::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitEvent::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitEvent::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitEvent::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitEvent::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEvent::TYPE_ID, QubitTerm::ID);

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

  public static function addJoinActorRoleCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEvent::ACTOR_ROLE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getActorRole(array $options = array())
  {
    return $this->actorRole = QubitTerm::getById($this->actorRoleId, $options);
  }

  public function setActorRole(QubitTerm $term)
  {
    $this->actorRoleId = $term->getId();

    return $this;
  }

  public static function addJoinInformationObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEvent::INFORMATION_OBJECT_ID, QubitInformationObject::ID);

    return $criteria;
  }

  public function getInformationObject(array $options = array())
  {
    return $this->informationObject = QubitInformationObject::getById($this->informationObjectId, $options);
  }

  public function setInformationObject(QubitInformationObject $informationObject)
  {
    $this->informationObjectId = $informationObject->getId();

    return $this;
  }

  public static function addJoinActorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEvent::ACTOR_ID, QubitActor::ID);

    return $criteria;
  }

  public function getActor(array $options = array())
  {
    return $this->actor = QubitActor::getById($this->actorId, $options);
  }

  public function setActor(QubitActor $actor)
  {
    $this->actorId = $actor->getId();

    return $this;
  }

  public static function addEventI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEventI18n::ID, $id);

    return $criteria;
  }

  public static function getEventI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addEventI18nsCriteriaById($criteria, $id);

    return QubitEventI18n::get($criteria, $options);
  }

  public function addEventI18nsCriteria(Criteria $criteria)
  {
    return self::addEventI18nsCriteriaById($criteria, $this->id);
  }

  protected $eventI18ns = null;

  public function getEventI18ns(array $options = array())
  {
    if (!isset($this->eventI18ns))
    {
      if (!isset($this->id))
      {
        $this->eventI18ns = QubitQuery::create();
      }
      else
      {
        $this->eventI18ns = self::getEventI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->eventI18ns;
  }

  public function getName(array $options = array())
  {
    $name = $this->getCurrentEventI18n($options)->getName();
    if (!empty($options['cultureFallback']) && strlen($name) < 1)
    {
      $name = $this->getCurrentEventI18n(array('sourceCulture' => true) + $options)->getName();
    }

    return $name;
  }

  public function setName($value, array $options = array())
  {
    $this->getCurrentEventI18n($options)->setName($value);

    return $this;
  }

  public function getDescription(array $options = array())
  {
    $description = $this->getCurrentEventI18n($options)->getDescription();
    if (!empty($options['cultureFallback']) && strlen($description) < 1)
    {
      $description = $this->getCurrentEventI18n(array('sourceCulture' => true) + $options)->getDescription();
    }

    return $description;
  }

  public function setDescription($value, array $options = array())
  {
    $this->getCurrentEventI18n($options)->setDescription($value);

    return $this;
  }

  public function getDateDisplay(array $options = array())
  {
    $dateDisplay = $this->getCurrentEventI18n($options)->getDateDisplay();
    if (!empty($options['cultureFallback']) && strlen($dateDisplay) < 1)
    {
      $dateDisplay = $this->getCurrentEventI18n(array('sourceCulture' => true) + $options)->getDateDisplay();
    }

    return $dateDisplay;
  }

  public function setDateDisplay($value, array $options = array())
  {
    $this->getCurrentEventI18n($options)->setDateDisplay($value);

    return $this;
  }

  public function getCurrentEventI18n(array $options = array())
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
      if (null === $eventI18n = QubitEventI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $eventI18n = new QubitEventI18n;
        $eventI18n->setCulture($options['culture']);
      }
      $this->eventI18ns[$options['culture']] = $eventI18n;
    }

    return $this->eventI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.EventMapBuilder');
