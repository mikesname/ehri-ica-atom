<?php

abstract class BaseRole implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_role',

    NAME = 'q_role.NAME',
    ID = 'q_role.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitRole::NAME);
    $criteria->addSelectColumn(QubitRole::ID);

    return $criteria;
  }

  protected static
    $roles = array();

  protected
    $row = array();

  public static function getFromRow(array $row)
  {
    if (!isset(self::$roles[$id = (int) $row[1]]))
    {
      $role = new QubitRole;
      $role->new = false;
      $role->row = $row;

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

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitRole::DATABASE_NAME)->getTable(QubitRole::TABLE_NAME);
  }

  protected
    $values = array();

  protected function rowOffsetGet($offset, $rowOffset, array $options = array())
  {
    if (array_key_exists($offset, $this->values))
    {
      return $this->values[$offset];
    }

    if (!array_key_exists($rowOffset, $this->row))
    {
      if ($this->new)
      {
        return;
      }

      $this->refresh();
    }

    return $this->row[$rowOffset];
  }

  public function offsetExists($offset, array $options = array())
  {
    $rowOffset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($offset == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet($offset, $rowOffset, $options);
        }

        if ($offset.'Id' == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet($offset.'Id', $rowOffset, $options);
        }

        $rowOffset++;
      }
    }

    return false;
  }

  public function __isset($name)
  {
    return $this->offsetExists($name);
  }

  public function offsetGet($offset, array $options = array())
  {
    $rowOffset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($offset == $column->getPhpName())
        {
          return $this->rowOffsetGet($offset, $rowOffset, $options);
        }

        if ($offset.'Id' == $column->getPhpName())
        {
          $relatedTable = $column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName());

          return call_user_func(array($relatedTable->getClassName(), 'getBy'.ucfirst($relatedTable->getColumn($column->getRelatedColumnName())->getPhpName())), $this->rowOffsetGet($offset.'Id', $rowOffset));
        }

        $rowOffset++;
      }
    }
  }

  public function __get($name)
  {
    return $this->offsetGet($name);
  }

  public function offsetSet($offset, $value, array $options = array())
  {
    $rowOffset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($offset == $column->getPhpName())
        {
          $this->values[$offset] = $value;
        }

        if ($offset.'Id' == $column->getPhpName())
        {
          $relatedTable = $column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName());

          $this->values[$offset.'Id'] = $value->offsetGet($relatedTable->getColumn($column->getRelatedColumnName())->getPhpName(), $options);
        }

        $rowOffset++;
      }
    }

    return $this;
  }

  public function __set($name, $value)
  {
    return $this->offsetSet($name, $value);
  }

  public function offsetUnset($offset, array $options = array())
  {
    $rowOffset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($offset == $column->getPhpName())
        {
          $this->values[$offset] = null;
        }

        if ($offset.'Id' == $column->getPhpName())
        {
          $this->values[$offset.'Id'] = null;
        }

        $rowOffset++;
      }
    }

    return $this;
  }

  public function __unset($name)
  {
    return $this->offsetUnset($name);
  }

  protected
    $new = true;

  protected
    $deleted = false;

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRole::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRole::ID, $this->id);

    call_user_func(array(get_class($this), 'addSelectColumns'), $criteria);

    $statement = BasePeer::doSelect($criteria, $options['connection']);
    $this->row = $statement->fetch();

    return $this;
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

    $rowOffset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if (array_key_exists($column->getPhpName(), $this->values))
        {
          $this->row[$rowOffset] = $this->values[$column->getPhpName()];
        }

        $rowOffset++;
      }
    }

    $this->new = false;
    $this->values = array();

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRole::DATABASE_NAME);
    }

    $rowOffset = 0;
    foreach ($this->tables as $table)
    {
      $criteria = new Criteria;
      foreach ($table->getColumns() as $column)
      {
        if (!array_key_exists($column->getPhpName(), $this->values))
        {
          if ('createdAt' == $column->getPhpName() || 'updatedAt' == $column->getPhpName())
          {
            $this->values[$column->getPhpName()] = new DateTime;
          }

          if ('sourceCulture' == $column->getPhpName())
          {
            $this->values['sourceCulture'] = sfPropel::getDefaultCulture();
          }
        }

        if (array_key_exists($column->getPhpName(), $this->values))
        {
          $criteria->add($column->getFullyQualifiedName(), $this->values[$column->getPhpName()]);
        }

        $rowOffset++;
      }

      if (null !== $id = BasePeer::doInsert($criteria, $connection))
      {
                if ($this->tables[0] == $table)
        {
          $columns = $table->getPrimaryKeyColumns();
          $this->values[$columns[0]->getPhpName()] = $id;
        }
      }

      $affectedRows += 1;
    }

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRole::DATABASE_NAME);
    }

    $rowOffset = 0;
    foreach ($this->tables as $table)
    {
      $criteria = new Criteria;
      $selectCriteria = new Criteria;
      foreach ($table->getColumns() as $column)
      {
        if (!array_key_exists($column->getPhpName(), $this->values))
        {
          if ('updatedAt' == $column->getPhpName())
          {
            $this->values['updatedAt'] = new DateTime;
          }
        }

        if (array_key_exists($column->getPhpName(), $this->values))
        {
          $criteria->add($column->getFullyQualifiedName(), $this->values[$column->getPhpName()]);
        }

        if ($column->isPrimaryKey())
        {
          $selectCriteria->add($column->getFullyQualifiedName(), $this->row[$rowOffset]);
        }

        $rowOffset++;
      }

      if ($criteria->size() > 0)
      {
        $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
      }
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
		return $this->getid();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setid($key);
	}

  public static function addpermissionScopesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPermissionScope::ROLE_ID, $id);

    return $criteria;
  }

  public static function getpermissionScopesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addpermissionScopesCriteriaById($criteria, $id);

    return QubitPermissionScope::get($criteria, $options);
  }

  public function addpermissionScopesCriteria(Criteria $criteria)
  {
    return self::addpermissionScopesCriteriaById($criteria, $this->id);
  }

  protected
    $permissionScopes = null;

  public function getpermissionScopes(array $options = array())
  {
    if (!isset($this->permissionScopes))
    {
      if (!isset($this->id))
      {
        $this->permissionScopes = QubitQuery::create();
      }
      else
      {
        $this->permissionScopes = self::getpermissionScopesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->permissionScopes;
  }

  public static function addrolePermissionRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRolePermissionRelation::ROLE_ID, $id);

    return $criteria;
  }

  public static function getrolePermissionRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrolePermissionRelationsCriteriaById($criteria, $id);

    return QubitRolePermissionRelation::get($criteria, $options);
  }

  public function addrolePermissionRelationsCriteria(Criteria $criteria)
  {
    return self::addrolePermissionRelationsCriteriaById($criteria, $this->id);
  }

  protected
    $rolePermissionRelations = null;

  public function getrolePermissionRelations(array $options = array())
  {
    if (!isset($this->rolePermissionRelations))
    {
      if (!isset($this->id))
      {
        $this->rolePermissionRelations = QubitQuery::create();
      }
      else
      {
        $this->rolePermissionRelations = self::getrolePermissionRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rolePermissionRelations;
  }

  public static function adduserRoleRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitUserRoleRelation::ROLE_ID, $id);

    return $criteria;
  }

  public static function getuserRoleRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::adduserRoleRelationsCriteriaById($criteria, $id);

    return QubitUserRoleRelation::get($criteria, $options);
  }

  public function adduserRoleRelationsCriteria(Criteria $criteria)
  {
    return self::adduserRoleRelationsCriteriaById($criteria, $this->id);
  }

  protected
    $userRoleRelations = null;

  public function getuserRoleRelations(array $options = array())
  {
    if (!isset($this->userRoleRelations))
    {
      if (!isset($this->id))
      {
        $this->userRoleRelations = QubitQuery::create();
      }
      else
      {
        $this->userRoleRelations = self::getuserRoleRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->userRoleRelations;
  }

  public function __call($name, $args)
  {
    if ('get' == substr($name, 0, 3) || 'set' == substr($name, 0, 3))
    {
      $args = array_merge(array(strtolower(substr($name, 3, 1)).substr($name, 4)), $args);

      return call_user_func_array(array($this, 'offset'.ucfirst(substr($name, 0, 3))), $args);
    }

    throw new sfException('Call to undefined method '.get_class($this).'::'.$name);
  }
}
