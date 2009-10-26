<?php

abstract class BasePermissionScope implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_permission_scope',

    NAME = 'q_permission_scope.NAME',
    PARAMETERS = 'q_permission_scope.PARAMETERS',
    PERMISSION_ID = 'q_permission_scope.PERMISSION_ID',
    ROLE_ID = 'q_permission_scope.ROLE_ID',
    USER_ID = 'q_permission_scope.USER_ID',
    ID = 'q_permission_scope.ID',
    SERIAL_NUMBER = 'q_permission_scope.SERIAL_NUMBER';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitPermissionScope::NAME);
    $criteria->addSelectColumn(QubitPermissionScope::PARAMETERS);
    $criteria->addSelectColumn(QubitPermissionScope::PERMISSION_ID);
    $criteria->addSelectColumn(QubitPermissionScope::ROLE_ID);
    $criteria->addSelectColumn(QubitPermissionScope::USER_ID);
    $criteria->addSelectColumn(QubitPermissionScope::ID);
    $criteria->addSelectColumn(QubitPermissionScope::SERIAL_NUMBER);

    return $criteria;
  }

  protected static
    $permissionScopes = array();

  protected
    $keys = array(),
    $row = array();

  public static function getFromRow(array $row)
  {
    $keys = array();
    $keys['id'] = $row[5];

    $key = serialize($keys);
    if (!isset(self::$permissionScopes[$key]))
    {
      $permissionScope = new QubitPermissionScope;

      $permissionScope->keys = $keys;
      $permissionScope->row = $row;

      $permissionScope->new = false;

      self::$permissionScopes[$key] = $permissionScope;
    }

    return self::$permissionScopes[$key];
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

    return self::get($criteria, $options)->__get(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitPermissionScope::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
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

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitPermissionScope::DATABASE_NAME)->getTable(QubitPermissionScope::TABLE_NAME);
  }

  protected
    $values = array(),
    $refFkValues = array();

  protected function rowOffsetGet($name, $offset, $options)
  {
    if (empty($options['clean']) && array_key_exists($name, $this->values))
    {
      return $this->values[$name];
    }

    if (array_key_exists($name, $this->keys))
    {
      return $this->keys[$name];
    }

    if (!array_key_exists($offset, $this->row))
    {
      if ($this->new)
      {
        return;
      }

      if (!isset($options['connection']))
      {
        $options['connection'] = Propel::getConnection(QubitPermissionScope::DATABASE_NAME);
      }

      $criteria = new Criteria;
      $criteria->add(QubitPermissionScope::ID, $this->id);

      call_user_func(array(get_class($this), 'addSelectColumns'), $criteria);

      $statement = BasePeer::doSelect($criteria, $options['connection']);
      $this->row = $statement->fetch();
    }

    return $this->row[$offset];
  }

  public function __isset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    $offset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($name == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet($name, $offset, $options);
        }

        if ($name.'Id' == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet($name.'Id', $offset, $options);
        }

        $offset++;
      }
    }

    throw new sfException('Unknown record property "'.$name.'" on "'.get_class($this).'"');
  }

  public function offsetExists($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__isset'), $args);
  }

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    $offset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($name == $column->getPhpName())
        {
          return $this->rowOffsetGet($name, $offset, $options);
        }

        if ($name.'Id' == $column->getPhpName())
        {
          $relatedTable = $column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName());

          return call_user_func(array($relatedTable->getClassName(), 'getBy'.ucfirst($relatedTable->getColumn($column->getRelatedColumnName())->getPhpName())), $this->rowOffsetGet($name.'Id', $offset, $options));
        }

        $offset++;
      }
    }

    throw new sfException('Unknown record property "'.$name.'" on "'.get_class($this).'"');
  }

  public function offsetGet($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__get'), $args);
  }

  public function __set($name, $value)
  {
    $args = func_get_args();

    $options = array();
    if (2 < count($args))
    {
      $options = $args[2];
    }

    $offset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($name == $column->getPhpName())
        {
          $this->values[$name] = $value;
        }

        if ($name.'Id' == $column->getPhpName())
        {
          $relatedTable = $column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName());

          $this->values[$name.'Id'] = $value->__get($relatedTable->getColumn($column->getRelatedColumnName())->getPhpName(), $options);
        }

        $offset++;
      }
    }

    return $this;
  }

  public function offsetSet($offset, $value)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__set'), $args);
  }

  public function __unset($name)
  {
    $offset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($name == $column->getPhpName())
        {
          $this->values[$name] = null;
        }

        if ($name.'Id' == $column->getPhpName())
        {
          $this->values[$name.'Id'] = null;
        }

        $offset++;
      }
    }

    return $this;
  }

  public function offsetUnset($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__unset'), $args);
  }

  public function clear()
  {
    $this->row = $this->values = array();

    return $this;
  }

  protected
    $new = true;

  protected
    $deleted = false;

  public function save($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('You cannot save an object that has been deleted.');
    }

    if ($this->new)
    {
      $this->insert($connection);
    }
    else
    {
      $this->update($connection);
    }

    $offset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if (array_key_exists($column->getPhpName(), $this->values))
        {
          $this->row[$offset] = $this->values[$column->getPhpName()];
        }

        $offset++;
      }
    }

    $this->new = false;
    $this->values = array();

    return $this;
  }

  protected function insert($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPermissionScope::DATABASE_NAME);
    }

    $offset = 0;
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

        $offset++;
      }

      if (null !== $id = BasePeer::doInsert($criteria, $connection))
      {
        // Guess that the first primary key of the first table is auto
        // incremented
        if ($this->tables[0] == $table)
        {
          $columns = $table->getPrimaryKeyColumns();
          $this->values[$columns[0]->getPhpName()] = $id;
        }
      }
    }

    return $this;
  }

  protected function update($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPermissionScope::DATABASE_NAME);
    }

    $offset = 0;
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
          if ('serialNumber' == $column->getPhpName())
          {
            $selectCriteria->add($column->getFullyQualifiedName(), $this->values[$column->getPhpName()]++);
          }

          $criteria->add($column->getFullyQualifiedName(), $this->values[$column->getPhpName()]);
        }

        if ($column->isPrimaryKey())
        {
          $selectCriteria->add($column->getFullyQualifiedName(), $this->row[$offset]);
        }

        $offset++;
      }

      if ($criteria->size() > 0)
      {
        BasePeer::doUpdate($selectCriteria, $criteria, $connection);
      }
    }

    return $this;
  }

  public function delete($connection = null)
  {
    if ($this->deleted)
    {
      throw new PropelException('This object has already been deleted.');
    }

    $criteria = new Criteria;
    $criteria->add(QubitPermissionScope::ID, $this->id);

    self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $this;
  }

	
	public function getPrimaryKey()
	{
		return $this->getid();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setid($key);
	}

  public static function addJoinpermissionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPermissionScope::PERMISSION_ID, QubitPermission::ID);

    return $criteria;
  }

  public static function addJoinroleCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPermissionScope::ROLE_ID, QubitRole::ID);

    return $criteria;
  }

  public static function addJoinuserCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPermissionScope::USER_ID, QubitUser::ID);

    return $criteria;
  }

  public function __call($name, $args)
  {
    if ('get' == substr($name, 0, 3) || 'set' == substr($name, 0, 3))
    {
      $args = array_merge(array(strtolower(substr($name, 3, 1)).substr($name, 4)), $args);

      return call_user_func_array(array($this, '__'.substr($name, 0, 3)), $args);
    }

    throw new sfException('Call to undefined method '.get_class($this).'::'.$name);
  }
}
