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
    $row = array();

  public static function getFromRow(array $row)
  {
    if (!isset(self::$informationObjectI18ns[$key = serialize(array((int) $row[21], (string) $row[22]))]))
    {
      $informationObjectI18n = new QubitInformationObjectI18n;
      $informationObjectI18n->new = false;
      $informationObjectI18n->row = $row;

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

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
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
      $options['connection'] = Propel::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitInformationObjectI18n::ID, $this->id);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);

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
      $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
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
      $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
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
    $criteria->add(QubitInformationObjectI18n::ID, $this->id);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);

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

      return call_user_func_array(array($this, 'offset'.ucfirst(substr($name, 0, 3))), $args);
    }

    throw new sfException('Call to undefined method '.get_class($this).'::'.$name);
  }
}
