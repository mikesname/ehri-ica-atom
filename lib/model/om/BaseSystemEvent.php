<?php

abstract class BaseSystemEvent
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_system_event';

  const TYPE_ID = 'q_system_event.TYPE_ID';
  const OBJECT_CLASS = 'q_system_event.OBJECT_CLASS';
  const OBJECT_ID = 'q_system_event.OBJECT_ID';
  const PRE_EVENT_SNAPSHOT = 'q_system_event.PRE_EVENT_SNAPSHOT';
  const POST_EVENT_SNAPSHOT = 'q_system_event.POST_EVENT_SNAPSHOT';
  const DATE = 'q_system_event.DATE';
  const USER_ID = 'q_system_event.USER_ID';
  const CREATED_AT = 'q_system_event.CREATED_AT';
  const UPDATED_AT = 'q_system_event.UPDATED_AT';
  const ID = 'q_system_event.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitSystemEvent::TYPE_ID);
    $criteria->addSelectColumn(QubitSystemEvent::OBJECT_CLASS);
    $criteria->addSelectColumn(QubitSystemEvent::OBJECT_ID);
    $criteria->addSelectColumn(QubitSystemEvent::PRE_EVENT_SNAPSHOT);
    $criteria->addSelectColumn(QubitSystemEvent::POST_EVENT_SNAPSHOT);
    $criteria->addSelectColumn(QubitSystemEvent::DATE);
    $criteria->addSelectColumn(QubitSystemEvent::USER_ID);
    $criteria->addSelectColumn(QubitSystemEvent::CREATED_AT);
    $criteria->addSelectColumn(QubitSystemEvent::UPDATED_AT);
    $criteria->addSelectColumn(QubitSystemEvent::ID);

    return $criteria;
  }

  protected static $systemEvents = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$systemEvents[$id = $resultSet->getInt(10)]))
    {
      $systemEvent = new QubitSystemEvent;
      $systemEvent->hydrate($resultSet);

      self::$systemEvents[$id] = $systemEvent;
    }

    return self::$systemEvents[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitSystemEvent::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitSystemEvent', $options);
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
    $criteria->add(QubitSystemEvent::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitSystemEvent::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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

  protected $objectClass = null;

  public function getObjectClass()
  {
    return $this->objectClass;
  }

  public function setObjectClass($objectClass)
  {
    $this->objectClass = $objectClass;

    return $this;
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

  protected $preEventSnapshot = null;

  public function getPreEventSnapshot()
  {
    return $this->preEventSnapshot;
  }

  public function setPreEventSnapshot($preEventSnapshot)
  {
    $this->preEventSnapshot = $preEventSnapshot;

    return $this;
  }

  protected $postEventSnapshot = null;

  public function getPostEventSnapshot()
  {
    return $this->postEventSnapshot;
  }

  public function setPostEventSnapshot($postEventSnapshot)
  {
    $this->postEventSnapshot = $postEventSnapshot;

    return $this;
  }

  protected $date = null;

  public function getDate(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->date);
    }

    return $this->date;
  }

  public function setDate($date)
  {
    if (is_string($date) && false === $date = strtotime($date))
    {
      throw new PropelException('Unable to parse date / time value for [date] from input: '.var_export($date, true));
    }

    $this->date = $date;

    return $this;
  }

  protected $userId = null;

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;

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
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['objectClass'] = $this->objectClass;
    $this->columnValues['objectId'] = $this->objectId;
    $this->columnValues['preEventSnapshot'] = $this->preEventSnapshot;
    $this->columnValues['postEventSnapshot'] = $this->postEventSnapshot;
    $this->columnValues['date'] = $this->date;
    $this->columnValues['userId'] = $this->userId;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->typeId = $results->getInt($columnOffset++);
    $this->objectClass = $results->getString($columnOffset++);
    $this->objectId = $results->getInt($columnOffset++);
    $this->preEventSnapshot = $results->getString($columnOffset++);
    $this->postEventSnapshot = $results->getString($columnOffset++);
    $this->date = $results->getTimestamp($columnOffset++, null);
    $this->userId = $results->getInt($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitSystemEvent::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitSystemEvent::ID, $this->id);

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

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitSystemEvent::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('objectClass'))
    {
      $criteria->add(QubitSystemEvent::OBJECT_CLASS, $this->objectClass);
    }

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitSystemEvent::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('preEventSnapshot'))
    {
      $criteria->add(QubitSystemEvent::PRE_EVENT_SNAPSHOT, $this->preEventSnapshot);
    }

    if ($this->isColumnModified('postEventSnapshot'))
    {
      $criteria->add(QubitSystemEvent::POST_EVENT_SNAPSHOT, $this->postEventSnapshot);
    }

    if ($this->isColumnModified('date'))
    {
      $criteria->add(QubitSystemEvent::DATE, $this->date);
    }

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitSystemEvent::USER_ID, $this->userId);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitSystemEvent::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitSystemEvent::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitSystemEvent::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitSystemEvent::DATABASE_NAME);
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

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitSystemEvent::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('objectClass'))
    {
      $criteria->add(QubitSystemEvent::OBJECT_CLASS, $this->objectClass);
    }

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitSystemEvent::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('preEventSnapshot'))
    {
      $criteria->add(QubitSystemEvent::PRE_EVENT_SNAPSHOT, $this->preEventSnapshot);
    }

    if ($this->isColumnModified('postEventSnapshot'))
    {
      $criteria->add(QubitSystemEvent::POST_EVENT_SNAPSHOT, $this->postEventSnapshot);
    }

    if ($this->isColumnModified('date'))
    {
      $criteria->add(QubitSystemEvent::DATE, $this->date);
    }

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitSystemEvent::USER_ID, $this->userId);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitSystemEvent::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitSystemEvent::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitSystemEvent::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitSystemEvent::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitSystemEvent::DATABASE_NAME);
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
    $criteria->add(QubitSystemEvent::ID, $this->id);

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

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitSystemEvent::TYPE_ID, QubitTerm::ID);

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

  public static function addJoinUserCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitSystemEvent::USER_ID, QubitUser::ID);

    return $criteria;
  }

  public function getUser(array $options = array())
  {
    return $this->user = QubitUser::getById($this->userId, $options);
  }

  public function setUser(QubitUser $user)
  {
    $this->userId = $user->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.SystemEventMapBuilder');
