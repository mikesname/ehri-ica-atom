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

    return self::get($criteria, $options)->__get(0, array('defaultValue' => null));
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
          return null !== $this->rowOffsetGet($name, $offset);
        }

        if ($name.'Id' == $column->getPhpName())
        {
          return null !== $this->rowOffsetGet($name.'Id', $offset);
        }

        $offset++;
      }
    }

    if (call_user_func_array(array($this->getCurrentcontactInformationI18n($options), '__isset'), $args))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && call_user_func_array(array($this->getCurrentcontactInformationI18n(array('sourceCulture' => true) + $options), '__isset'), $args))
    {
      return true;
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

    if (null !== $value = call_user_func_array(array($this->getCurrentcontactInformationI18n($options), '__get'), $args))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = call_user_func_array(array($this->getCurrentcontactInformationI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = call_user_func_array(array($this->getCurrentcontactInformationI18n(array('sourceCulture' => true) + $options), '__get'), $args))
    {
      return $value;
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

    call_user_func_array(array($this->getCurrentcontactInformationI18n($options), '__set'), $args);

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

        if ($name.'Id' == $column->getPhpName())
        {
          $this->values[$name.'Id'] = null;
        }

        $offset++;
      }
    }

    call_user_func_array(array($this->getCurrentcontactInformationI18n($options), '__unset'), $args);

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
      $connection = QubitTransactionFilter::getConnection(QubitContactInformation::DATABASE_NAME);
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

      return call_user_func_array(array($this, '__'.substr($name, 0, 3)), $args);
    }

    throw new sfException('Call to undefined method '.get_class($this).'::'.$name);
  }
}
