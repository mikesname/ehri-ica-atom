<?php

abstract class BaseTermI18n implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_term_i18n',

    NAME = 'q_term_i18n.NAME',
    ID = 'q_term_i18n.ID',
    CULTURE = 'q_term_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitTermI18n::NAME);
    $criteria->addSelectColumn(QubitTermI18n::ID);
    $criteria->addSelectColumn(QubitTermI18n::CULTURE);

    return $criteria;
  }

  protected static
    $termI18ns = array();

  protected
    $row = array();

  public static function getFromRow(array $row)
  {
    if (!isset(self::$termI18ns[$key = serialize(array((int) $row[1], (string) $row[2]))]))
    {
      $termI18n = new QubitTermI18n;
      $termI18n->new = false;
      $termI18n->row = $row;

      self::$termI18ns[$key] = $termI18n;
    }

    return self::$termI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTermI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitTermI18n', $options);
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

  public static function getByIdAndCulture($id, $culture, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitTermI18n::ID, $id);
    $criteria->add(QubitTermI18n::CULTURE, $culture);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTermI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitTermI18n::DATABASE_NAME)->getTable(QubitTermI18n::TABLE_NAME);
  }

  protected
    $values = array();

  protected function rowOffsetGet($name, $offset)
  {
    if (array_key_exists($name, $this->values))
    {
      return $this->values[$name];
    }

    if (!array_key_exists($offset, $this->row))
    {
      if ($this->new)
      {
        return;
      }

      $this->refresh();
    }

    return $this->row[$offset];
  }

  public function __isset($name)
  {
    $offset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($name == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet($name, $offset);
        }

        if ($name.'Id' == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet($name.'Id', $offset);
        }

        $offset++;
      }
    }

    return false;
  }

  public function offsetExists($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__isset'), $args);
  }

  public function __get($name)
  {
    $offset = 0;
    foreach ($this->tables as $table)
    {
      foreach ($table->getColumns() as $column)
      {
        if ($name == $column->getPhpName())
        {
          return $this->rowOffsetGet($name, $offset);
        }

        if ($name.'Id' == $column->getPhpName())
        {
          $relatedTable = $column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName());

          return call_user_func(array($relatedTable->getClassName(), 'getBy'.ucfirst($relatedTable->getColumn($column->getRelatedColumnName())->getPhpName())), $this->rowOffsetGet($name.'Id', $offset));
        }

        $offset++;
      }
    }
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

  protected
    $new = true;

  protected
    $deleted = false;

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTermI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitTermI18n::ID, $this->id);
    $criteria->add(QubitTermI18n::CULTURE, $this->culture);

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

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTermI18n::DATABASE_NAME);
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
      $connection = QubitTransactionFilter::getConnection(QubitTermI18n::DATABASE_NAME);
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
    $criteria->add(QubitTermI18n::ID, $this->id);
    $criteria->add(QubitTermI18n::CULTURE, $this->culture);

    $affectedRows += self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $affectedRows;
  }

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getid();

		$pks[1] = $this->getculture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setid($keys[0]);

		$this->setculture($keys[1]);

	}

  public static function addJointermCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitTermI18n::ID, QubitTerm::ID);

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
