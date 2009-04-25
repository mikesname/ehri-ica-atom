<?php

abstract class BaseContactInformation implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_contact_information',

    ACTOR_ID = 'q_contact_information.ACTOR_ID',
    PRIMARY_CONTACT = 'q_contact_information.PRIMARY_CONTACT',
    CONTACT_PERSON = 'q_contact_information.CONTACT_PERSON',
    STREET_ADDRESS = 'q_contact_information.STREET_ADDRESS',
    WEBSITE = 'q_contact_information.WEBSITE',
    EMAIL = 'q_contact_information.EMAIL',
    TELEPHONE = 'q_contact_information.TELEPHONE',
    FAX = 'q_contact_information.FAX',
    POSTAL_CODE = 'q_contact_information.POSTAL_CODE',
    COUNTRY_CODE = 'q_contact_information.COUNTRY_CODE',
    LONGTITUDE = 'q_contact_information.LONGTITUDE',
    LATITUDE = 'q_contact_information.LATITUDE',
    CREATED_AT = 'q_contact_information.CREATED_AT',
    UPDATED_AT = 'q_contact_information.UPDATED_AT',
    SOURCE_CULTURE = 'q_contact_information.SOURCE_CULTURE',
    ID = 'q_contact_information.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitContactInformation::ACTOR_ID);
    $criteria->addSelectColumn(QubitContactInformation::PRIMARY_CONTACT);
    $criteria->addSelectColumn(QubitContactInformation::CONTACT_PERSON);
    $criteria->addSelectColumn(QubitContactInformation::STREET_ADDRESS);
    $criteria->addSelectColumn(QubitContactInformation::WEBSITE);
    $criteria->addSelectColumn(QubitContactInformation::EMAIL);
    $criteria->addSelectColumn(QubitContactInformation::TELEPHONE);
    $criteria->addSelectColumn(QubitContactInformation::FAX);
    $criteria->addSelectColumn(QubitContactInformation::POSTAL_CODE);
    $criteria->addSelectColumn(QubitContactInformation::COUNTRY_CODE);
    $criteria->addSelectColumn(QubitContactInformation::LONGTITUDE);
    $criteria->addSelectColumn(QubitContactInformation::LATITUDE);
    $criteria->addSelectColumn(QubitContactInformation::CREATED_AT);
    $criteria->addSelectColumn(QubitContactInformation::UPDATED_AT);
    $criteria->addSelectColumn(QubitContactInformation::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitContactInformation::ID);

    return $criteria;
  }

  protected static
    $contactInformations = array();

  protected
    $row = array();

  public static function getFromRow(array $row)
  {
    if (!isset(self::$contactInformations[$id = (int) $row[15]]))
    {
      $contactInformation = new QubitContactInformation;
      $contactInformation->new = false;
      $contactInformation->row = $row;

      self::$contactInformations[$id] = $contactInformation;
    }

    return self::$contactInformations[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitContactInformation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitContactInformation', $options);
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
    $criteria->add(QubitContactInformation::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitContactInformation::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitContactInformation::DATABASE_NAME)->getTable(QubitContactInformation::TABLE_NAME);
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

    if ($this->getCurrentcontactInformationI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrentcontactInformationI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
    {
      return true;
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

    if (null !== $value = $this->getCurrentcontactInformationI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrentcontactInformationI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrentcontactInformationI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
    {
      return $value;
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

    $this->getCurrentcontactInformationI18n($options)->offsetSet($offset, $value, $options);

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

    $this->getCurrentcontactInformationI18n($options)->offsetUnset($offset, $options);

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
      $options['connection'] = Propel::getConnection(QubitContactInformation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitContactInformation::ID, $this->id);

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

    foreach ($this->contactInformationI18ns as $contactInformationI18n)
    {
      $contactInformationI18n->setid($this->id);

      $affectedRows += $contactInformationI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitContactInformation::DATABASE_NAME);
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
      $connection = QubitTransactionFilter::getConnection(QubitContactInformation::DATABASE_NAME);
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
    $criteria->add(QubitContactInformation::ID, $this->id);

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

  public static function addJoinactorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitContactInformation::ACTOR_ID, QubitActor::ID);

    return $criteria;
  }

  public static function addcontactInformationI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitContactInformationI18n::ID, $id);

    return $criteria;
  }

  public static function getcontactInformationI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addcontactInformationI18nsCriteriaById($criteria, $id);

    return QubitContactInformationI18n::get($criteria, $options);
  }

  public function addcontactInformationI18nsCriteria(Criteria $criteria)
  {
    return self::addcontactInformationI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $contactInformationI18ns = null;

  public function getcontactInformationI18ns(array $options = array())
  {
    if (!isset($this->contactInformationI18ns))
    {
      if (!isset($this->id))
      {
        $this->contactInformationI18ns = QubitQuery::create();
      }
      else
      {
        $this->contactInformationI18ns = self::getcontactInformationI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->contactInformationI18ns;
  }

  public function getCurrentcontactInformationI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->contactInformationI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $contactInformationI18n = QubitContactInformationI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $contactInformationI18n = new QubitContactInformationI18n;
        $contactInformationI18n->setculture($options['culture']);
      }
      $this->contactInformationI18ns[$options['culture']] = $contactInformationI18n;
    }

    return $this->contactInformationI18ns[$options['culture']];
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
