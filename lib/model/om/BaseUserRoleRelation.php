<?php

abstract class BaseUserRoleRelation
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_user_role_relation';

  const USER_ID = 'q_user_role_relation.USER_ID';
  const ROLE_ID = 'q_user_role_relation.ROLE_ID';
  const ID = 'q_user_role_relation.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitUserRoleRelation::USER_ID);
    $criteria->addSelectColumn(QubitUserRoleRelation::ROLE_ID);
    $criteria->addSelectColumn(QubitUserRoleRelation::ID);

    return $criteria;
  }

  protected static $userRoleRelations = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$userRoleRelations[$id = $resultSet->getInt(3)]))
    {
      $userRoleRelation = new QubitUserRoleRelation;
      $userRoleRelation->hydrate($resultSet);

      self::$userRoleRelations[$id] = $userRoleRelation;
    }

    return self::$userRoleRelations[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitUserRoleRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitUserRoleRelation', $options);
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
    $criteria->add(QubitUserRoleRelation::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitUserRoleRelation::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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

  protected $roleId = null;

  public function getRoleId()
  {
    return $this->roleId;
  }

  public function setRoleId($roleId)
  {
    $this->roleId = $roleId;

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
    $this->columnValues['userId'] = $this->userId;
    $this->columnValues['roleId'] = $this->roleId;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->userId = $results->getInt($columnOffset++);
    $this->roleId = $results->getInt($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitUserRoleRelation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitUserRoleRelation::ID, $this->id);

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

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitUserRoleRelation::USER_ID, $this->userId);
    }

    if ($this->isColumnModified('roleId'))
    {
      $criteria->add(QubitUserRoleRelation::ROLE_ID, $this->roleId);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitUserRoleRelation::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitUserRoleRelation::DATABASE_NAME);
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

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitUserRoleRelation::USER_ID, $this->userId);
    }

    if ($this->isColumnModified('roleId'))
    {
      $criteria->add(QubitUserRoleRelation::ROLE_ID, $this->roleId);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitUserRoleRelation::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitUserRoleRelation::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitUserRoleRelation::DATABASE_NAME);
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
    $criteria->add(QubitUserRoleRelation::ID, $this->id);

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

  public static function addJoinUserCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitUserRoleRelation::USER_ID, QubitUser::ID);

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

  public static function addJoinRoleCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitUserRoleRelation::ROLE_ID, QubitRole::ID);

    return $criteria;
  }

  public function getRole(array $options = array())
  {
    return $this->role = QubitRole::getById($this->roleId, $options);
  }

  public function setRole(QubitRole $role)
  {
    $this->roleId = $role->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.UserRoleRelationMapBuilder');
