<?php

abstract class BaseObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_object',

    CLASS_NAME = 'q_object.CLASS_NAME',
    ID = 'q_object.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitObject::CLASS_NAME);
    $criteria->addSelectColumn(QubitObject::ID);

    return $criteria;
  }

  protected static
    $objects = array();

  protected
    $row = array();

  public static function getFromRow(array $row)
  {
    if (!isset(self::$objects[$id = (int) $row[1]]))
    {
      $object = new $row[0];
      $object->new = false;
      $object->row = $row;

      self::$objects[$id] = $object;
    }

    return self::$objects[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitObject::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitObject', $options);
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
    $criteria->add(QubitObject::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->values['className'] = get_class($this);

    $this->tables[] = Propel::getDatabaseMap(QubitObject::DATABASE_NAME)->getTable(QubitObject::TABLE_NAME);
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
      $options['connection'] = Propel::getConnection(QubitObject::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitObject::ID, $this->id);

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
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
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
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
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
    $criteria->add(QubitObject::ID, $this->id);

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

  public static function addnotesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getnotesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addnotesCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addnotesCriteria(Criteria $criteria)
  {
    return self::addnotesCriteriaById($criteria, $this->id);
  }

  protected
    $notes = null;

  public function getnotes(array $options = array())
  {
    if (!isset($this->notes))
    {
      if (!isset($this->id))
      {
        $this->notes = QubitQuery::create();
      }
      else
      {
        $this->notes = self::getnotesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notes;
  }

  public static function addobjectTermRelationsRelatedByobjectIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getobjectTermRelationsRelatedByobjectIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addobjectTermRelationsRelatedByobjectIdCriteriaById($criteria, $id);

    return QubitObjectTermRelation::get($criteria, $options);
  }

  public function addobjectTermRelationsRelatedByobjectIdCriteria(Criteria $criteria)
  {
    return self::addobjectTermRelationsRelatedByobjectIdCriteriaById($criteria, $this->id);
  }

  protected
    $objectTermRelationsRelatedByobjectId = null;

  public function getobjectTermRelationsRelatedByobjectId(array $options = array())
  {
    if (!isset($this->objectTermRelationsRelatedByobjectId))
    {
      if (!isset($this->id))
      {
        $this->objectTermRelationsRelatedByobjectId = QubitQuery::create();
      }
      else
      {
        $this->objectTermRelationsRelatedByobjectId = self::getobjectTermRelationsRelatedByobjectIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->objectTermRelationsRelatedByobjectId;
  }

  public static function addpropertysCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitProperty::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getpropertysById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addpropertysCriteriaById($criteria, $id);

    return QubitProperty::get($criteria, $options);
  }

  public function addpropertysCriteria(Criteria $criteria)
  {
    return self::addpropertysCriteriaById($criteria, $this->id);
  }

  protected
    $propertys = null;

  public function getpropertys(array $options = array())
  {
    if (!isset($this->propertys))
    {
      if (!isset($this->id))
      {
        $this->propertys = QubitQuery::create();
      }
      else
      {
        $this->propertys = self::getpropertysById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->propertys;
  }

  public static function addrightssCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRights::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getrightssById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrightssCriteriaById($criteria, $id);

    return QubitRights::get($criteria, $options);
  }

  public function addrightssCriteria(Criteria $criteria)
  {
    return self::addrightssCriteriaById($criteria, $this->id);
  }

  protected
    $rightss = null;

  public function getrightss(array $options = array())
  {
    if (!isset($this->rightss))
    {
      if (!isset($this->id))
      {
        $this->rightss = QubitQuery::create();
      }
      else
      {
        $this->rightss = self::getrightssById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightss;
  }

  public static function addrelationsRelatedBysubjectIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRelation::SUBJECT_ID, $id);

    return $criteria;
  }

  public static function getrelationsRelatedBysubjectIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrelationsRelatedBysubjectIdCriteriaById($criteria, $id);

    return QubitRelation::get($criteria, $options);
  }

  public function addrelationsRelatedBysubjectIdCriteria(Criteria $criteria)
  {
    return self::addrelationsRelatedBysubjectIdCriteriaById($criteria, $this->id);
  }

  protected
    $relationsRelatedBysubjectId = null;

  public function getrelationsRelatedBysubjectId(array $options = array())
  {
    if (!isset($this->relationsRelatedBysubjectId))
    {
      if (!isset($this->id))
      {
        $this->relationsRelatedBysubjectId = QubitQuery::create();
      }
      else
      {
        $this->relationsRelatedBysubjectId = self::getrelationsRelatedBysubjectIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->relationsRelatedBysubjectId;
  }

  public static function addrelationsRelatedByobjectIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRelation::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getrelationsRelatedByobjectIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrelationsRelatedByobjectIdCriteriaById($criteria, $id);

    return QubitRelation::get($criteria, $options);
  }

  public function addrelationsRelatedByobjectIdCriteria(Criteria $criteria)
  {
    return self::addrelationsRelatedByobjectIdCriteriaById($criteria, $this->id);
  }

  protected
    $relationsRelatedByobjectId = null;

  public function getrelationsRelatedByobjectId(array $options = array())
  {
    if (!isset($this->relationsRelatedByobjectId))
    {
      if (!isset($this->id))
      {
        $this->relationsRelatedByobjectId = QubitQuery::create();
      }
      else
      {
        $this->relationsRelatedByobjectId = self::getrelationsRelatedByobjectIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->relationsRelatedByobjectId;
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
