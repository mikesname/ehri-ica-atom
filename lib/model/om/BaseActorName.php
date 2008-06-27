<?php

abstract class BaseActorName
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_actor_name';

  const ACTOR_ID = 'q_actor_name.ACTOR_ID';
  const TYPE_ID = 'q_actor_name.TYPE_ID';
  const CREATED_AT = 'q_actor_name.CREATED_AT';
  const UPDATED_AT = 'q_actor_name.UPDATED_AT';
  const SOURCE_CULTURE = 'q_actor_name.SOURCE_CULTURE';
  const ID = 'q_actor_name.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitActorName::ACTOR_ID);
    $criteria->addSelectColumn(QubitActorName::TYPE_ID);
    $criteria->addSelectColumn(QubitActorName::CREATED_AT);
    $criteria->addSelectColumn(QubitActorName::UPDATED_AT);
    $criteria->addSelectColumn(QubitActorName::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitActorName::ID);

    return $criteria;
  }

  protected static $actorNames = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$actorNames[$id = $resultSet->getInt(6)]))
    {
      $actorName = new QubitActorName;
      $actorName->hydrate($resultSet);

      self::$actorNames[$id] = $actorName;
    }

    return self::$actorNames[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitActorName::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitActorName', $options);
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
    $criteria->add(QubitActorName::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitActorName::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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
    $this->columnValues['actorId'] = $this->actorId;
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->actorId = $results->getInt($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitActorName::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitActorName::ID, $this->id);

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

    foreach ($this->actorNameI18ns as $actorNameI18n)
    {
      $actorNameI18n->setId($this->id);

      $affectedRows += $actorNameI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitActorName::ACTOR_ID, $this->actorId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitActorName::TYPE_ID, $this->typeId);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitActorName::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitActorName::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitActorName::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActorName::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitActorName::DATABASE_NAME);
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

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitActorName::ACTOR_ID, $this->actorId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitActorName::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitActorName::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitActorName::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitActorName::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActorName::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitActorName::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitActorName::DATABASE_NAME);
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
    $criteria->add(QubitActorName::ID, $this->id);

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

  public static function addJoinActorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActorName::ACTOR_ID, QubitActor::ID);

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

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActorName::TYPE_ID, QubitTerm::ID);

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

  public static function addActorNameI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActorNameI18n::ID, $id);

    return $criteria;
  }

  public static function getActorNameI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorNameI18nsCriteriaById($criteria, $id);

    return QubitActorNameI18n::get($criteria, $options);
  }

  public function addActorNameI18nsCriteria(Criteria $criteria)
  {
    return self::addActorNameI18nsCriteriaById($criteria, $this->id);
  }

  protected $actorNameI18ns = null;

  public function getActorNameI18ns(array $options = array())
  {
    if (!isset($this->actorNameI18ns))
    {
      if (!isset($this->id))
      {
        $this->actorNameI18ns = QubitQuery::create();
      }
      else
      {
        $this->actorNameI18ns = self::getActorNameI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorNameI18ns;
  }

  public function getName(array $options = array())
  {
    $name = $this->getCurrentActorNameI18n($options)->getName();
    if (!empty($options['cultureFallback']) && strlen($name) < 1)
    {
      $name = $this->getCurrentActorNameI18n(array('sourceCulture' => true) + $options)->getName();
    }

    return $name;
  }

  public function setName($value, array $options = array())
  {
    $this->getCurrentActorNameI18n($options)->setName($value);

    return $this;
  }

  public function getNote(array $options = array())
  {
    $note = $this->getCurrentActorNameI18n($options)->getNote();
    if (!empty($options['cultureFallback']) && strlen($note) < 1)
    {
      $note = $this->getCurrentActorNameI18n(array('sourceCulture' => true) + $options)->getNote();
    }

    return $note;
  }

  public function setNote($value, array $options = array())
  {
    $this->getCurrentActorNameI18n($options)->setNote($value);

    return $this;
  }

  public function getCurrentActorNameI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->actorNameI18ns[$options['culture']]))
    {
      if (null === $actorNameI18n = QubitActorNameI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $actorNameI18n = new QubitActorNameI18n;
        $actorNameI18n->setCulture($options['culture']);
      }
      $this->actorNameI18ns[$options['culture']] = $actorNameI18n;
    }

    return $this->actorNameI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.ActorNameMapBuilder');
