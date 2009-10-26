<?php

abstract class BaseAclGroup implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_acl_group',

    ID = 'q_acl_group.ID',
    PARENT_ID = 'q_acl_group.PARENT_ID',
    LFT = 'q_acl_group.LFT',
    RGT = 'q_acl_group.RGT',
    CREATED_AT = 'q_acl_group.CREATED_AT',
    UPDATED_AT = 'q_acl_group.UPDATED_AT',
    SOURCE_CULTURE = 'q_acl_group.SOURCE_CULTURE',
    SERIAL_NUMBER = 'q_acl_group.SERIAL_NUMBER';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitAclGroup::ID);
    $criteria->addSelectColumn(QubitAclGroup::PARENT_ID);
    $criteria->addSelectColumn(QubitAclGroup::LFT);
    $criteria->addSelectColumn(QubitAclGroup::RGT);
    $criteria->addSelectColumn(QubitAclGroup::CREATED_AT);
    $criteria->addSelectColumn(QubitAclGroup::UPDATED_AT);
    $criteria->addSelectColumn(QubitAclGroup::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitAclGroup::SERIAL_NUMBER);

    return $criteria;
  }

  protected static
    $aclGroups = array();

  protected
    $keys = array(),
    $row = array();

  public static function getFromRow(array $row)
  {
    $keys = array();
    $keys['id'] = $row[0];

    $key = serialize($keys);
    if (!isset(self::$aclGroups[$key]))
    {
      $aclGroup = new QubitAclGroup;

      $aclGroup->keys = $keys;
      $aclGroup->row = $row;

      $aclGroup->new = false;

      self::$aclGroups[$key] = $aclGroup;
    }

    return self::$aclGroups[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitAclGroup::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitAclGroup', $options);
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
    $criteria->add(QubitAclGroup::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitAclGroup::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitAclGroup::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitAclGroup::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitAclGroup::PARENT_ID);

    return $criteria;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitAclGroup::DATABASE_NAME)->getTable(QubitAclGroup::TABLE_NAME);
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
        $options['connection'] = Propel::getConnection(QubitAclGroup::DATABASE_NAME);
      }

      $criteria = new Criteria;
      $criteria->add(QubitAclGroup::ID, $this->id);

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

    if ('aclGroupsRelatedByparentId' == $name)
    {
      return true;
    }

    if ('aclGroupI18ns' == $name)
    {
      return true;
    }

    if ('aclPermissions' == $name)
    {
      return true;
    }

    if ('aclUserGroups' == $name)
    {
      return true;
    }

    try
    {
      if (!$value = call_user_func_array(array($this->getCurrentaclGroupI18n($options), '__isset'), $args) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentaclGroupI18n(array('sourceCulture' => true) + $options), '__isset'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
    }

    if ('ancestors' == $name)
    {
      return true;
    }

    if ('descendants' == $name)
    {
      return true;
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

    if ('aclGroupsRelatedByparentId' == $name)
    {
      if (!isset($this->refFkValues['aclGroupsRelatedByparentId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['aclGroupsRelatedByparentId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['aclGroupsRelatedByparentId'] = self::getaclGroupsRelatedByparentIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['aclGroupsRelatedByparentId'];
    }

    if ('aclGroupI18ns' == $name)
    {
      if (!isset($this->refFkValues['aclGroupI18ns']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['aclGroupI18ns'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['aclGroupI18ns'] = self::getaclGroupI18nsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['aclGroupI18ns'];
    }

    if ('aclPermissions' == $name)
    {
      if (!isset($this->refFkValues['aclPermissions']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['aclPermissions'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['aclPermissions'] = self::getaclPermissionsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['aclPermissions'];
    }

    if ('aclUserGroups' == $name)
    {
      if (!isset($this->refFkValues['aclUserGroups']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['aclUserGroups'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['aclUserGroups'] = self::getaclUserGroupsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['aclUserGroups'];
    }

    try
    {
      if (1 > strlen($value = call_user_func_array(array($this->getCurrentaclGroupI18n($options), '__get'), $args)) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentaclGroupI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }
    catch (sfException $e)
    {
    }

    if ('ancestors' == $name)
    {
      if (!isset($this->values['ancestors']))
      {
        if ($this->new)
        {
          $this->values['ancestors'] = QubitQuery::create(array('self' => $this) + $options);
        }
        else
        {
          $criteria = new Criteria;
          $this->addAncestorsCriteria($criteria);
          $this->addOrderByPreorder($criteria);
          $this->values['ancestors'] = self::get($criteria, array('self' => $this) + $options);
        }
      }

      return $this->values['ancestors'];
    }

    if ('descendants' == $name)
    {
      if (!isset($this->values['descendants']))
      {
        if ($this->new)
        {
          $this->values['descendants'] = QubitQuery::create(array('self' => $this) + $options);
        }
        else
        {
          $criteria = new Criteria;
          $this->addDescendantsCriteria($criteria);
          $this->addOrderByPreorder($criteria);
          $this->values['descendants'] = self::get($criteria, array('self' => $this) + $options);
        }
      }

      return $this->values['descendants'];
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

    call_user_func_array(array($this->getCurrentaclGroupI18n($options), '__set'), $args);

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

    call_user_func_array(array($this->getCurrentaclGroupI18n($options), '__unset'), $args);

    return $this;
  }

  public function offsetUnset($offset)
  {
    $args = func_get_args();

    return call_user_func_array(array($this, '__unset'), $args);
  }

  public function clear()
  {
    foreach ($this->aclGroupI18ns as $aclGroupI18n)
    {
      $aclGroupI18n->clear();
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

    foreach ($this->aclGroupI18ns as $aclGroupI18n)
    {
      $aclGroupI18n->id = $this->id;

      $aclGroupI18n->save($connection);
    }

    return $this;
  }

  protected function insert($connection = null)
  {
    $this->updateNestedSet($connection);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitAclGroup::DATABASE_NAME);
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
    // Update nested set keys only if parent id has changed
    if (isset($this->values['parentId']))
    {
      // Get the "original" parentId before any updates
      $offset = 0; 
      $originalParentId = null;
      foreach ($this->tables as $table)
      {
        foreach ($table->getColumns() as $column)
        {
          if ('parentId' == $column->getPhpName())
          {
            $originalParentId = $this->row[$offset];
            break;
          }
          $offset++;
        }
      }
      
      // If updated value of parentId is different then original value,
      // update the nested set
      if ($originalParentId != $this->values['parentId'])
      {
        $this->updateNestedSet($connection);
      }
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitAclGroup::DATABASE_NAME);
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

    $this->clear();
    $this->deleteFromNestedSet($connection);

    $criteria = new Criteria;
    $criteria->add(QubitAclGroup::ID, $this->id);

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

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitAclGroup::PARENT_ID, QubitAclGroup::ID);

    return $criteria;
  }

  public static function addaclGroupsRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitAclGroup::PARENT_ID, $id);

    return $criteria;
  }

  public static function getaclGroupsRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addaclGroupsRelatedByparentIdCriteriaById($criteria, $id);

    return QubitAclGroup::get($criteria, $options);
  }

  public function addaclGroupsRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::addaclGroupsRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  public static function addaclGroupI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitAclGroupI18n::ID, $id);

    return $criteria;
  }

  public static function getaclGroupI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addaclGroupI18nsCriteriaById($criteria, $id);

    return QubitAclGroupI18n::get($criteria, $options);
  }

  public function addaclGroupI18nsCriteria(Criteria $criteria)
  {
    return self::addaclGroupI18nsCriteriaById($criteria, $this->id);
  }

  public static function addaclPermissionsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitAclPermission::GROUP_ID, $id);

    return $criteria;
  }

  public static function getaclPermissionsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addaclPermissionsCriteriaById($criteria, $id);

    return QubitAclPermission::get($criteria, $options);
  }

  public function addaclPermissionsCriteria(Criteria $criteria)
  {
    return self::addaclPermissionsCriteriaById($criteria, $this->id);
  }

  public static function addaclUserGroupsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitAclUserGroup::GROUP_ID, $id);

    return $criteria;
  }

  public static function getaclUserGroupsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addaclUserGroupsCriteriaById($criteria, $id);

    return QubitAclUserGroup::get($criteria, $options);
  }

  public function addaclUserGroupsCriteria(Criteria $criteria)
  {
    return self::addaclUserGroupsCriteriaById($criteria, $this->id);
  }

  public function getCurrentaclGroupI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    $aclGroupI18ns = $this->aclGroupI18ns->indexBy('culture');
    if (!isset($aclGroupI18ns[$options['culture']]))
    {
      $aclGroupI18ns[$options['culture']] = new QubitAclGroupI18n;
    }

    return $aclGroupI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitAclGroup::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitAclGroup::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitAclGroup::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitAclGroup::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected function updateNestedSet($connection = null)
  {
unset($this->values['lft']);
unset($this->values['rgt']);
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitAclGroup::DATABASE_NAME);
    }

    if (!isset($this->lft) || !isset($this->rgt))
    {
      $delta = 2;
    }
    else
    {
      $delta = $this->rgt - $this->lft + 1;
    }

    if (null === $parent = $this->__get('parent', array('connection' => $connection)))
    {
      $statement = $connection->prepare('
        SELECT MAX('.QubitAclGroup::RGT.')
        FROM '.QubitAclGroup::TABLE_NAME);
      $statement->execute();
      $row = $statement->fetch();
      $max = $row[0];

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $this->lft = $max + 1;
        $this->rgt = $max + 2;

        return $this;
      }

      $shift = $max + 1 - $this->lft;
    }
    else
    {
      $parent->clear();

      if (isset($this->lft) && isset($this->rgt) && $this->lft <= $parent->lft && $this->rgt >= $parent->rgt)
      {
        throw new PropelException('An object cannot be a descendant of itself.');
      }

      $statement = $connection->prepare('
        UPDATE '.QubitAclGroup::TABLE_NAME.'
        SET '.QubitAclGroup::LFT.' = '.QubitAclGroup::LFT.' + ?
        WHERE '.QubitAclGroup::LFT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      $statement = $connection->prepare('
        UPDATE '.QubitAclGroup::TABLE_NAME.'
        SET '.QubitAclGroup::RGT.' = '.QubitAclGroup::RGT.' + ?
        WHERE '.QubitAclGroup::RGT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $this->lft = $parent->rgt;
        $this->rgt = $parent->rgt + 1;

        return $this;
      }

      if ($this->lft > $parent->rgt)
      {
        $this->lft += $delta;
        $this->rgt += $delta;
      }

      $shift = $parent->rgt - $this->lft;
    }

    $statement = $connection->prepare('
      UPDATE '.QubitAclGroup::TABLE_NAME.'
      SET '.QubitAclGroup::LFT.' = '.QubitAclGroup::LFT.' + ?, '.QubitAclGroup::RGT.' = '.QubitAclGroup::RGT.' + ?
      WHERE '.QubitAclGroup::LFT.' >= ?
      AND '.QubitAclGroup::RGT.' <= ?');
    $statement->execute(array($shift, $shift, $this->lft, $this->rgt));

    $this->deleteFromNestedSet($connection);

    if ($shift > 0)
    {
      $this->lft -= $delta;
      $this->rgt -= $delta;
    }

    $this->lft += $shift;
    $this->rgt += $shift;

    return $this;
  }

  protected function deleteFromNestedSet($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitAclGroup::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $statement = $connection->prepare('
      UPDATE '.QubitAclGroup::TABLE_NAME.'
      SET '.QubitAclGroup::LFT.' = '.QubitAclGroup::LFT.' - ?
      WHERE '.QubitAclGroup::LFT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    $statement = $connection->prepare('
      UPDATE '.QubitAclGroup::TABLE_NAME.'
      SET '.QubitAclGroup::RGT.' = '.QubitAclGroup::RGT.' - ?
      WHERE '.QubitAclGroup::RGT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    return $this;
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
