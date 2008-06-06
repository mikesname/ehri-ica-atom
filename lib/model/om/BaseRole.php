<?php

abstract class BaseRole
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_role';

  const NAME = 'q_role.NAME';
  const ID = 'q_role.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitRole::NAME);
    $criteria->addSelectColumn(QubitRole::ID);

    return $criteria;
  }

  protected static $roles = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$roles[$id = $resultSet->getInt(2)]))
    {
      $role = new QubitRole;
      $role->hydrate($resultSet);

      self::$roles[$id] = $role;
    }

    return self::$roles[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRole::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRole', $options);
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
    $criteria->add(QubitRole::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRole::DATABASE_NAME);
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
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->name = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRole::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRole::ID, $this->id);

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
      $criteria->add(QubitRole::NAME, $this->name);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRole::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRole::DATABASE_NAME);
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
      $criteria->add(QubitRole::NAME, $this->name);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRole::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitRole::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitRole::DATABASE_NAME);
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
    $criteria->add(QubitRole::ID, $this->id);

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

  public static function addUserRoleRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitUserRoleRelation::ROLE_ID, $id);

    return $criteria;
  }

  public static function getUserRoleRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addUserRoleRelationsCriteriaById($criteria, $id);

    return QubitUserRoleRelation::get($criteria, $options);
  }

  public function addUserRoleRelationsCriteria(Criteria $criteria)
  {
    return self::addUserRoleRelationsCriteriaById($criteria, $this->id);
  }

  protected $userRoleRelations = null;

  public function getUserRoleRelations(array $options = array())
  {
    if (!isset($this->userRoleRelations))
    {
      if (!isset($this->id))
      {
        $this->userRoleRelations = QubitQuery::create();
      }
      else
      {
        $this->userRoleRelations = self::getUserRoleRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->userRoleRelations;
  }

  public static function addRolePermissionRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRolePermissionRelation::ROLE_ID, $id);

    return $criteria;
  }

  public static function getRolePermissionRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRolePermissionRelationsCriteriaById($criteria, $id);

    return QubitRolePermissionRelation::get($criteria, $options);
  }

  public function addRolePermissionRelationsCriteria(Criteria $criteria)
  {
    return self::addRolePermissionRelationsCriteriaById($criteria, $this->id);
  }

  protected $rolePermissionRelations = null;

  public function getRolePermissionRelations(array $options = array())
  {
    if (!isset($this->rolePermissionRelations))
    {
      if (!isset($this->id))
      {
        $this->rolePermissionRelations = QubitQuery::create();
      }
      else
      {
        $this->rolePermissionRelations = self::getRolePermissionRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rolePermissionRelations;
  }

  public static function addPermissionScopesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPermissionScope::ROLE_ID, $id);

    return $criteria;
  }

  public static function getPermissionScopesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPermissionScopesCriteriaById($criteria, $id);

    return QubitPermissionScope::get($criteria, $options);
  }

  public function addPermissionScopesCriteria(Criteria $criteria)
  {
    return self::addPermissionScopesCriteriaById($criteria, $this->id);
  }

  protected $permissionScopes = null;

  public function getPermissionScopes(array $options = array())
  {
    if (!isset($this->permissionScopes))
    {
      if (!isset($this->id))
      {
        $this->permissionScopes = QubitQuery::create();
      }
      else
      {
        $this->permissionScopes = self::getPermissionScopesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->permissionScopes;
  }
}

BasePeer::getMapBuilder('lib.model.map.RoleMapBuilder');
