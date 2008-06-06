<?php

abstract class BaseRightsActorRelation extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_rights_actor_relation';

  const ID = 'q_rights_actor_relation.ID';
  const RIGHTS_ID = 'q_rights_actor_relation.RIGHTS_ID';
  const ACTOR_ID = 'q_rights_actor_relation.ACTOR_ID';
  const TYPE_ID = 'q_rights_actor_relation.TYPE_ID';
  const CREATED_AT = 'q_rights_actor_relation.CREATED_AT';
  const UPDATED_AT = 'q_rights_actor_relation.UPDATED_AT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitRightsActorRelation::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitRightsActorRelation::ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::RIGHTS_ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::ACTOR_ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::TYPE_ID);
    $criteria->addSelectColumn(QubitRightsActorRelation::CREATED_AT);
    $criteria->addSelectColumn(QubitRightsActorRelation::UPDATED_AT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRightsActorRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRightsActorRelation', $options);
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
    $criteria->add(QubitRightsActorRelation::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  protected $rightsId = null;

  public function getRightsId()
  {
    return $this->rightsId;
  }

  public function setRightsId($rightsId)
  {
    $this->rightsId = $rightsId;

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

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['rightsId'] = $this->rightsId;
    $this->columnValues['actorId'] = $this->actorId;
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->rightsId = $results->getInt($columnOffset++);
    $this->actorId = $results->getInt($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRightsActorRelation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRightsActorRelation::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRightsActorRelation::ID, $this->id);
    }

    if ($this->isColumnModified('rightsId'))
    {
      $criteria->add(QubitRightsActorRelation::RIGHTS_ID, $this->rightsId);
    }

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitRightsActorRelation::ACTOR_ID, $this->actorId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitRightsActorRelation::TYPE_ID, $this->typeId);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitRightsActorRelation::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitRightsActorRelation::UPDATED_AT, $this->updatedAt);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRightsActorRelation::DATABASE_NAME);
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
      $criteria->add(QubitRightsActorRelation::ID, $this->id);
    }

    if ($this->isColumnModified('rightsId'))
    {
      $criteria->add(QubitRightsActorRelation::RIGHTS_ID, $this->rightsId);
    }

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitRightsActorRelation::ACTOR_ID, $this->actorId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitRightsActorRelation::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitRightsActorRelation::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitRightsActorRelation::UPDATED_AT, $this->updatedAt);

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitRightsActorRelation::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitRightsActorRelation::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinRightsCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsActorRelation::RIGHTS_ID, QubitRights::ID);

    return $criteria;
  }

  public function getRights(array $options = array())
  {
    return $this->rights = QubitRights::getById($this->rightsId, $options);
  }

  public function setRights(QubitRights $rights)
  {
    $this->rightsId = $rights->getId();

    return $this;
  }

  public static function addJoinActorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsActorRelation::ACTOR_ID, QubitActor::ID);

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
    $criteria->addJoin(QubitRightsActorRelation::TYPE_ID, QubitTerm::ID);

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
}

BasePeer::getMapBuilder('lib.model.map.RightsActorRelationMapBuilder');
