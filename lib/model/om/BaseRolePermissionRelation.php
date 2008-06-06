<?php

abstract class BaseRolePermissionRelation
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_role_permission_relation';

  const ROLE_ID = 'q_role_permission_relation.ROLE_ID';
  const PERMISSION_ID = 'q_role_permission_relation.PERMISSION_ID';
  const ID = 'q_role_permission_relation.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitRolePermissionRelation::ROLE_ID);
    $criteria->addSelectColumn(QubitRolePermissionRelation::PERMISSION_ID);
    $criteria->addSelectColumn(QubitRolePermissionRelation::ID);

    return $criteria;
  }

  protected static $rolePermissionRelations = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$rolePermissionRelations[$id = $resultSet->getInt(3)]))
    {
      $rolePermissionRelation = new QubitRolePermissionRelation;
      $rolePermissionRelation->hydrate($resultSet);

      self::$rolePermissionRelations[$id] = $rolePermissionRelation;
    }

    return self::$rolePermissionRelations[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRolePermissionRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRolePermissionRelation', $options);
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
    $criteria->add(QubitRolePermissionRelation::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRolePermissionRelation::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
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
    $this->columnValues['roleId'] = $this->roleId;
    $this->columnValues['permissionId'] = $this->permissionId;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->roleId = $results->getInt($columnOffset++);
    $this->permissionId = $results->getInt($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRolePermissionRelation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRolePermissionRelation::ID, $this->id);

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

    if ($this->isColumnModified('roleId'))
    {
      $criteria->add(QubitRolePermissionRelation::ROLE_ID, $this->roleId);
    }

    if ($this->isColumnModified('permissionId'))
    {
      $criteria->add(QubitRolePermissionRelation::PERMISSION_ID, $this->permissionId);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRolePermissionRelation::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRolePermissionRelation::DATABASE_NAME);
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

    if ($this->isColumnModified('roleId'))
    {
      $criteria->add(QubitRolePermissionRelation::ROLE_ID, $this->roleId);
    }

    if ($this->isColumnModified('permissionId'))
    {
      $criteria->add(QubitRolePermissionRelation::PERMISSION_ID, $this->permissionId);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRolePermissionRelation::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitRolePermissionRelation::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitRolePermissionRelation::DATABASE_NAME);
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
    $criteria->add(QubitRolePermissionRelation::ID, $this->id);

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

  public static function addJoinRoleCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRolePermissionRelation::ROLE_ID, QubitRole::ID);

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

  public static function addJoinPermissionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRolePermissionRelation::PERMISSION_ID, QubitPermission::ID);

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
}

BasePeer::getMapBuilder('lib.model.map.RolePermissionRelationMapBuilder');
