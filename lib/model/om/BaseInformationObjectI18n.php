<?php

abstract class BaseInformationObjectI18n implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_information_object_i18n',

    TITLE = 'q_information_object_i18n.TITLE',
    ALTERNATE_TITLE = 'q_information_object_i18n.ALTERNATE_TITLE',
    EDITION = 'q_information_object_i18n.EDITION',
    EXTENT_AND_MEDIUM = 'q_information_object_i18n.EXTENT_AND_MEDIUM',
    ARCHIVAL_HISTORY = 'q_information_object_i18n.ARCHIVAL_HISTORY',
    ACQUISITION = 'q_information_object_i18n.ACQUISITION',
    SCOPE_AND_CONTENT = 'q_information_object_i18n.SCOPE_AND_CONTENT',
    APPRAISAL = 'q_information_object_i18n.APPRAISAL',
    ACCRUALS = 'q_information_object_i18n.ACCRUALS',
    ARRANGEMENT = 'q_information_object_i18n.ARRANGEMENT',
    ACCESS_CONDITIONS = 'q_information_object_i18n.ACCESS_CONDITIONS',
    REPRODUCTION_CONDITIONS = 'q_information_object_i18n.REPRODUCTION_CONDITIONS',
    PHYSICAL_CHARACTERISTICS = 'q_information_object_i18n.PHYSICAL_CHARACTERISTICS',
    FINDING_AIDS = 'q_information_object_i18n.FINDING_AIDS',
    LOCATION_OF_ORIGINALS = 'q_information_object_i18n.LOCATION_OF_ORIGINALS',
    LOCATION_OF_COPIES = 'q_information_object_i18n.LOCATION_OF_COPIES',
    RELATED_UNITS_OF_DESCRIPTION = 'q_information_object_i18n.RELATED_UNITS_OF_DESCRIPTION',
    INSTITUTION_RESPONSIBLE_IDENTIFIER = 'q_information_object_i18n.INSTITUTION_RESPONSIBLE_IDENTIFIER',
    RULES = 'q_information_object_i18n.RULES',
    SOURCES = 'q_information_object_i18n.SOURCES',
    REVISION_HISTORY = 'q_information_object_i18n.REVISION_HISTORY',
    ID = 'q_information_object_i18n.ID',
    CULTURE = 'q_information_object_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitInformationObjectI18n::TITLE);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ALTERNATE_TITLE);
    $criteria->addSelectColumn(QubitInformationObjectI18n::EDITION);
    $criteria->addSelectColumn(QubitInformationObjectI18n::EXTENT_AND_MEDIUM);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ARCHIVAL_HISTORY);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ACQUISITION);
    $criteria->addSelectColumn(QubitInformationObjectI18n::SCOPE_AND_CONTENT);
    $criteria->addSelectColumn(QubitInformationObjectI18n::APPRAISAL);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ACCRUALS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ARRANGEMENT);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ACCESS_CONDITIONS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::REPRODUCTION_CONDITIONS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::PHYSICAL_CHARACTERISTICS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::FINDING_AIDS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::LOCATION_OF_ORIGINALS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::LOCATION_OF_COPIES);
    $criteria->addSelectColumn(QubitInformationObjectI18n::RELATED_UNITS_OF_DESCRIPTION);
    $criteria->addSelectColumn(QubitInformationObjectI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER);
    $criteria->addSelectColumn(QubitInformationObjectI18n::RULES);
    $criteria->addSelectColumn(QubitInformationObjectI18n::SOURCES);
    $criteria->addSelectColumn(QubitInformationObjectI18n::REVISION_HISTORY);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ID);
    $criteria->addSelectColumn(QubitInformationObjectI18n::CULTURE);

    return $criteria;
  }

  protected static
    $informationObjectI18ns = array();

  protected
    $keys = array(),
    $row = array();

  public static function getFromRow(array $row)
  {
    $keys = array();
    $keys['id'] = $row[21];
    $keys['culture'] = $row[22];

    $key = serialize($keys);
    if (!isset(self::$informationObjectI18ns[$key]))
    {
      $informationObjectI18n = new QubitInformationObjectI18n;

      $informationObjectI18n->keys = $keys;
      $informationObjectI18n->row = $row;

      $informationObjectI18n->new = false;

      self::$informationObjectI18ns[$key] = $informationObjectI18n;
    }

    return self::$informationObjectI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitInformationObjectI18n', $options);
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
    $criteria->add(QubitInformationObjectI18n::ID, $id);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $culture);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitInformationObjectI18n::DATABASE_NAME)->getTable(QubitInformationObjectI18n::TABLE_NAME);
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
        $options['connection'] = Propel::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
      }

      $criteria = new Criteria;
      $criteria->add(QubitInformationObjectI18n::ID, $this->id);
      $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);

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
      $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
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
    }

    return $this;
  }

  protected function update($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
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
    $criteria->add(QubitInformationObjectI18n::ID, $this->id);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);

    self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $this;
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

  public static function addJoininformationObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObjectI18n::ID, QubitInformationObject::ID);

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
