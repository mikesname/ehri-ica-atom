<?php

abstract class BaseRights implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'rights',

    OBJECT_ID = 'rights.OBJECT_ID',
    PERMISSION_ID = 'rights.PERMISSION_ID',
    CREATED_AT = 'rights.CREATED_AT',
    UPDATED_AT = 'rights.UPDATED_AT',
    SOURCE_CULTURE = 'rights.SOURCE_CULTURE',
    ID = 'rights.ID',
    SERIAL_NUMBER = 'rights.SERIAL_NUMBER';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitRights::OBJECT_ID);
    $criteria->addSelectColumn(QubitRights::PERMISSION_ID);
    $criteria->addSelectColumn(QubitRights::CREATED_AT);
    $criteria->addSelectColumn(QubitRights::UPDATED_AT);
    $criteria->addSelectColumn(QubitRights::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitRights::ID);
    $criteria->addSelectColumn(QubitRights::SERIAL_NUMBER);

    return $criteria;
  }

  protected static
    $rightss = array();

  protected
    $keys = array(),
    $row = array();

  public static function getFromRow(array $row)
  {
    $keys = array();
    $keys['id'] = $row[5];

    $key = serialize($keys);
    if (!isset(self::$rightss[$key]))
    {
      $rights = new QubitRights;

      $rights->keys = $keys;
      $rights->row = $row;

      $rights->new = false;

      self::$rightss[$key] = $rights;
    }

    return self::$rightss[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRights::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRights', $options);
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
    $criteria->add(QubitRights::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRights::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitRights::DATABASE_NAME)->getTable(QubitRights::TABLE_NAME);
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
        $options['connection'] = Propel::getConnection(QubitRights::DATABASE_NAME);
      }

      $criteria = new Criteria;
      $criteria->add(QubitRights::ID, $this->id);

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

        if ("{$name}Id" == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet("{$name}Id", $offset, $options);
        }

        $offset++;
      }
    }

    if ('rightsI18ns' == $name)
    {
      return true;
    }

    if ('rightsActorRelations' == $name)
    {
      return true;
    }

    if ('rightsTermRelations' == $name)
    {
      return true;
    }

    try
    {
      if (!$value = call_user_func_array(array($this->getCurrentrightsI18n($options), '__isset'), $args) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentrightsI18n(array('sourceCulture' => true) + $options), '__isset'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
    }

    throw new sfException("Unknown record property \"$name\" on \"".get_class($this).'"');
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

        if ("{$name}Id" == $column->getPhpName())
        {
          $relatedTable = $column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName());

          return call_user_func(array($relatedTable->getClassName(), 'getBy'.ucfirst($relatedTable->getColumn($column->getRelatedColumnName())->getPhpName())), $this->rowOffsetGet("{$name}Id", $offset, $options));
        }

        $offset++;
      }
    }

    if ('rightsI18ns' == $name)
    {
      if (!isset($this->refFkValues['rightsI18ns']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['rightsI18ns'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['rightsI18ns'] = self::getrightsI18nsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['rightsI18ns'];
    }

    if ('rightsActorRelations' == $name)
    {
      if (!isset($this->refFkValues['rightsActorRelations']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['rightsActorRelations'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['rightsActorRelations'] = self::getrightsActorRelationsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['rightsActorRelations'];
    }

    if ('rightsTermRelations' == $name)
    {
      if (!isset($this->refFkValues['rightsTermRelations']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['rightsTermRelations'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['rightsTermRelations'] = self::getrightsTermRelationsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['rightsTermRelations'];
    }

    try
    {
      if (1 > strlen($value = call_user_func_array(array($this->getCurrentrightsI18n($options), '__get'), $args)) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentrightsI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
    }

    throw new sfException("Unknown record property \"$name\" on \"".get_class($this).'"');
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

        if ("{$name}Id" == $column->getPhpName())
        {
          $relatedTable = $column->getTable()->getDatabaseMap()->getTable($column->getRelatedTableName());

          $this->values["{$name}Id"] = $value->__get($relatedTable->getColumn($column->getRelatedColumnName())->getPhpName(), $options);
        }

        $offset++;
      }
    }

    call_user_func_array(array($this->getCurrentrightsI18n($options), '__set'), $args);

    return $this;
  }

  public function offsetSet($offset, $value)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__set'), $args);
  }

  public function __unset($name)
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
          $this->values[$name] = null;
        }

        if ("{$name}Id" == $column->getPhpName())
        {
          $this->values["{$name}Id"] = null;
        }

        $offset++;
      }
    }

    call_user_func_array(array($this->getCurrentrightsI18n($options), '__unset'), $args);

    return $this;
  }

  public function offsetUnset($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__unset'), $args);
  }

  public function clear()
  {
    foreach ($this->rightsI18ns as $rightsI18n)
    {
      $rightsI18n->clear();
    }

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

    foreach ($this->rightsI18ns as $rightsI18n)
    {
      $rightsI18n->id = $this->id;

      $rightsI18n->save($connection);
    }

    return $this;
  }

  protected function param($column)
  {
    $value = $this->values[$column->getPhpName()];

    // Convert to DateTime or SQL zero special case
    if (isset($value) && $column->isTemporal() && !$value instanceof DateTime)
    {
      // Year only: one or more digits.  Convert to SQL zero special case
      if (preg_match('/^\d+$/', $value))
      {
        $value .= '-0-0';
      }

      // Year and month only: one or more digits, plus separator, plus
      // one or more digits.  Convert to SQL zero special case
      else if (preg_match('/^\d+[-\/]\d+$/', $value))
      {
        $value .= '-0';
      }

      // Convert to DateTime if not SQL zero special case: year plus
      // separator plus zero to twelve (possibly zero padded) plus
      // separator plus one or more zeros
      if (!preg_match('/^\d+[-\/]0*(?:1[0-2]|\d)[-\/]0+$/', $value))
      {
        $value = new DateTime($value);
      }
    }

    return $value;
  }

  protected function insert($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRights::DATABASE_NAME);
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
          $criteria->add($column->getFullyQualifiedName(), $this->param($column));
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
          $this->values[$columns[0]->getPhpName()] = $this->keys[$columns[0]->getPhpName()] = $id;
        }
      }
    }

    return $this;
  }

  protected function update($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRights::DATABASE_NAME);
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

          $criteria->add($column->getFullyQualifiedName(), $this->param($column));
        }

        if ($column->isPrimaryKey())
        {
          $selectCriteria->add($column->getFullyQualifiedName(), $this->keys[$column->getPhpName()]);
        }

        $offset++;
      }

      if (0 < $criteria->size())
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
    $criteria->add(QubitRights::ID, $this->id);

    self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $this;
  }

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getid();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setid($key);
	}

  public static function addJoinobjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRights::OBJECT_ID, QubitObject::ID);

    return $criteria;
  }

  public static function addJoinpermissionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRights::PERMISSION_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addrightsI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsI18n::ID, $id);

    return $criteria;
  }

  public static function getrightsI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightsI18nsCriteriaById($criteria, $id);

    return QubitRightsI18n::get($criteria, $options);
  }

  public function addrightsI18nsCriteria(Criteria $criteria)
  {
    return self::addrightsI18nsCriteriaById($criteria, $this->id);
  }

  public static function addrightsActorRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsActorRelation::RIGHTS_ID, $id);

    return $criteria;
  }

  public static function getrightsActorRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightsActorRelationsCriteriaById($criteria, $id);

    return QubitRightsActorRelation::get($criteria, $options);
  }

  public function addrightsActorRelationsCriteria(Criteria $criteria)
  {
    return self::addrightsActorRelationsCriteriaById($criteria, $this->id);
  }

  public static function addrightsTermRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsTermRelation::RIGHTS_ID, $id);

    return $criteria;
  }

  public static function getrightsTermRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightsTermRelationsCriteriaById($criteria, $id);

    return QubitRightsTermRelation::get($criteria, $options);
  }

  public function addrightsTermRelationsCriteria(Criteria $criteria)
  {
    return self::addrightsTermRelationsCriteriaById($criteria, $this->id);
  }

  public function getCurrentrightsI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    $rightsI18ns = $this->rightsI18ns->indexBy('culture');
    if (!isset($rightsI18ns[$options['culture']]))
    {
      $rightsI18ns[$options['culture']] = new QubitRightsI18n;
    }

    return $rightsI18ns[$options['culture']];
  }

  public function __call($name, $args)
  {
    if ('get' == substr($name, 0, 3) || 'set' == substr($name, 0, 3))
    {
      $args = array_merge(array(strtolower(substr($name, 3, 1)).substr($name, 4)), $args);

      return call_user_func_array(array($this, '__'.substr($name, 0, 3)), $args);
    }

    throw new sfException('Call to undefined method '.get_class($this)."::$name");
  }
}
