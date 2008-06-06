<?php

abstract class BasePermissionScope
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_permission_scope';

  const NAME = 'q_permission_scope.NAME';
  const PARAMETERS = 'q_permission_scope.PARAMETERS';
  const PERMISSION_ID = 'q_permission_scope.PERMISSION_ID';
  const ROLE_ID = 'q_permission_scope.ROLE_ID';
  const USER_ID = 'q_permission_scope.USER_ID';
  const ID = 'q_permission_scope.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitPermissionScope::NAME);
    $criteria->addSelectColumn(QubitPermissionScope::PARAMETERS);
    $criteria->addSelectColumn(QubitPermissionScope::PERMISSION_ID);
    $criteria->addSelectColumn(QubitPermissionScope::ROLE_ID);
    $criteria->addSelectColumn(QubitPermissionScope::USER_ID);
    $criteria->addSelectColumn(QubitPermissionScope::ID);

    return $criteria;
  }

  protected static $permissionScopes = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$permissionScopes[$id = $resultSet->getInt(6)]))
    {
      $permissionScope = new QubitPermissionScope;
      $permissionScope->hydrate($resultSet);

      self::$permissionScopes[$id] = $permissionScope;
    }

    return self::$permissionScopes[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPermissionScope::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPermissionScope', $options);
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
    $criteria->add(QubitPermissionScope::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPermissionScope::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $name = null;

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  protected $parameters = null;

  public function getParameters()
  {
    return $this->parameters;
  }

  public function setParameters($parameters)
  {
    $this->parameters = $parameters;

    return $this;
  }

  protected $permissionId = null;

  public function getPermissionId()
  {
    return $this->permissionId;
  }

  public function setPermissionId($permissionId)
  {
    $this->permissionId = $permissionId;

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
    $this->columnValues['name'] = $this->name;
    $this->columnValues['parameters'] = $this->parameters;
    $this->columnValues['permissionId'] = $this->permissionId;
    $this->columnValues['roleId'] = $this->roleId;
    $this->columnValues['userId'] = $this->userId;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->name = $results->getString($columnOffset++);
    $this->parameters = $results->getString($columnOffset++);
    $this->permissionId = $results->getInt($columnOffset++);
    $this->roleId = $results->getInt($columnOffset++);
    $this->userId = $results->getInt($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPermissionScope::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPermissionScope::ID, $this->id);

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

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitPermissionScope::NAME, $this->name);
    }

    if ($this->isColumnModified('parameters'))
    {
      $criteria->add(QubitPermissionScope::PARAMETERS, $this->parameters);
    }

    if ($this->isColumnModified('permissionId'))
    {
      $criteria->add(QubitPermissionScope::PERMISSION_ID, $this->permissionId);
    }

    if ($this->isColumnModified('roleId'))
    {
      $criteria->add(QubitPermissionScope::ROLE_ID, $this->roleId);
    }

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitPermissionScope::USER_ID, $this->userId);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPermissionScope::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPermissionScope::DATABASE_NAME);
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

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitPermissionScope::NAME, $this->name);
    }

    if ($this->isColumnModified('parameters'))
    {
      $criteria->add(QubitPermissionScope::PARAMETERS, $this->parameters);
    }

    if ($this->isColumnModified('permissionId'))
    {
      $criteria->add(QubitPermissionScope::PERMISSION_ID, $this->permissionId);
    }

    if ($this->isColumnModified('roleId'))
    {
      $criteria->add(QubitPermissionScope::ROLE_ID, $this->roleId);
    }

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitPermissionScope::USER_ID, $this->userId);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPermissionScope::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPermissionScope::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPermissionScope::DATABASE_NAME);
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
    $criteria->add(QubitPermissionScope::ID, $this->id);

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

  public static function addJoinPermissionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPermissionScope::PERMISSION_ID, QubitPermission::ID);

    return $criteria;
  }

  public function getPermission(array $options = array())
  {
    return $this->permission = QubitPermission::getById($this->permissionId, $options);
  }

  public function setPermission(QubitPermission $permission)
  {
    $this->permissionId = $permission->getId();

    return $this;
  }

  public static function addJoinRoleCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPermissionScope::ROLE_ID, QubitRole::ID);

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

  public static function addJoinUserCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPermissionScope::USER_ID, QubitUser::ID);

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

BasePeer::getMapBuilder('lib.model.map.PermissionScopeMapBuilder');
