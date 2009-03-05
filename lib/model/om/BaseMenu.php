<?php

abstract class BaseMenu implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_menu',

    PARENT_ID = 'q_menu.PARENT_ID',
    NAME = 'q_menu.NAME',
    PATH = 'q_menu.PATH',
    LFT = 'q_menu.LFT',
    RGT = 'q_menu.RGT',
    CREATED_AT = 'q_menu.CREATED_AT',
    UPDATED_AT = 'q_menu.UPDATED_AT',
    SOURCE_CULTURE = 'q_menu.SOURCE_CULTURE',
    ID = 'q_menu.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitMenu::PARENT_ID);
    $criteria->addSelectColumn(QubitMenu::NAME);
    $criteria->addSelectColumn(QubitMenu::PATH);
    $criteria->addSelectColumn(QubitMenu::LFT);
    $criteria->addSelectColumn(QubitMenu::RGT);
    $criteria->addSelectColumn(QubitMenu::CREATED_AT);
    $criteria->addSelectColumn(QubitMenu::UPDATED_AT);
    $criteria->addSelectColumn(QubitMenu::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitMenu::ID);

    return $criteria;
  }

  protected static
    $menus = array();

  protected
    $row = array();

  public static function getFromRow(array $row)
  {
    if (!isset(self::$menus[$id = (int) $row[8]]))
    {
      $menu = new QubitMenu;
      $menu->new = false;
      $menu->row = $row;

      self::$menus[$id] = $menu;
    }

    return self::$menus[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitMenu::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitMenu', $options);
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
    $criteria->add(QubitMenu::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitMenu::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitMenu::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitMenu::PARENT_ID);

    return $criteria;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitMenu::DATABASE_NAME)->getTable(QubitMenu::TABLE_NAME);
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

    if ($this->getCurrentmenuI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrentmenuI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
    {
      return true;
    }

    if ('ancestors' == $offset)
    {
      return true;
    }

    if ('descendants' == $offset)
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

    if (null !== $value = $this->getCurrentmenuI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrentmenuI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrentmenuI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
    {
      return $value;
    }

    if ('ancestors' == $offset)
    {
      if (!isset($this->ancestors))
      {
        if ($this->new)
        {
          $this->ancestors = QubitQuery::create(array('self' => $this) + $options);
        }
        else
        {
          $criteria = new Criteria;
          $this->addAncestorsCriteria($criteria);
          $this->addOrderByPreorder($criteria);
          $this->ancestors = self::get($criteria, array('self' => $this) + $options);
        }
      }

      return $this->ancestors;
    }

    if ('descendants' == $offset)
    {
      if (!isset($this->descendants))
      {
        if ($this->new)
        {
          $this->descendants = QubitQuery::create(array('self' => $this) + $options);
        }
        else
        {
          $criteria = new Criteria;
          $this->addDescendantsCriteria($criteria);
          $this->addOrderByPreorder($criteria);
          $this->descendants = self::get($criteria, array('self' => $this) + $options);
        }
      }

      return $this->descendants;
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

    $this->getCurrentmenuI18n($options)->offsetSet($offset, $value, $options);

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

    $this->getCurrentmenuI18n($options)->offsetUnset($offset, $options);

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
      $options['connection'] = Propel::getConnection(QubitMenu::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitMenu::ID, $this->id);

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

    foreach ($this->menuI18ns as $menuI18n)
    {
      $menuI18n->setid($this->id);

      $affectedRows += $menuI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $this->updateNestedSet($connection);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
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

    // Update nested set keys only if parent id has changed
    if (isset($this->values['parentId']))
    {
      // Get the "original" parentId before any updates
      $rowOffset = 0; 
      $originalParentId = null;
      foreach ($this->tables as $table)
      {
        foreach ($table->getColumns() as $column)
        {
          if ('parentId' == $column->getPhpName())
          {
            $originalParentId = $this->row[$rowOffset];
            break;
          }
          $rowOffset++;
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
      $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
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

    $this->refresh(array('connection' => $connection));
    $this->deleteFromNestedSet($connection);

    $criteria = new Criteria;
    $criteria->add(QubitMenu::ID, $this->id);

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

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitMenu::PARENT_ID, QubitMenu::ID);

    return $criteria;
  }

  public static function addmenusRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitMenu::PARENT_ID, $id);

    return $criteria;
  }

  public static function getmenusRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addmenusRelatedByparentIdCriteriaById($criteria, $id);

    return QubitMenu::get($criteria, $options);
  }

  public function addmenusRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::addmenusRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  protected
    $menusRelatedByparentId = null;

  public function getmenusRelatedByparentId(array $options = array())
  {
    if (!isset($this->menusRelatedByparentId))
    {
      if (!isset($this->id))
      {
        $this->menusRelatedByparentId = QubitQuery::create();
      }
      else
      {
        $this->menusRelatedByparentId = self::getmenusRelatedByparentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->menusRelatedByparentId;
  }

  public static function addmenuI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitMenuI18n::ID, $id);

    return $criteria;
  }

  public static function getmenuI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addmenuI18nsCriteriaById($criteria, $id);

    return QubitMenuI18n::get($criteria, $options);
  }

  public function addmenuI18nsCriteria(Criteria $criteria)
  {
    return self::addmenuI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $menuI18ns = null;

  public function getmenuI18ns(array $options = array())
  {
    if (!isset($this->menuI18ns))
    {
      if (!isset($this->id))
      {
        $this->menuI18ns = QubitQuery::create();
      }
      else
      {
        $this->menuI18ns = self::getmenuI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->menuI18ns;
  }

  public function getCurrentmenuI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->menuI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $menuI18n = QubitMenuI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $menuI18n = new QubitMenuI18n;
        $menuI18n->setculture($options['culture']);
      }
      $this->menuI18ns[$options['culture']] = $menuI18n;
    }

    return $this->menuI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitMenu::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitMenu::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  protected
    $ancestors = null;

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitMenu::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitMenu::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected
    $descendants = null;

  protected function updateNestedSet($connection = null)
  {
unset($this->values['lft']);
unset($this->values['rgt']);
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
    }

    if (!isset($this->lft) || !isset($this->rgt))
    {
      $delta = 2;
    }
    else
    {
      $delta = $this->rgt - $this->lft + 1;
    }

    if (null === $parent = $this->offsetGet('parent', array('connection' => $connection)))
    {
      $statement = $connection->prepare('
        SELECT MAX('.QubitMenu::RGT.')
        FROM '.QubitMenu::TABLE_NAME);
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
      $parent->refresh(array('connection' => $connection));

      if (isset($this->lft) && isset($this->rgt) && $this->lft <= $parent->lft && $this->rgt >= $parent->rgt)
      {
        throw new PropelException('An object cannot be a descendant of itself.');
      }

      $statement = $connection->prepare('
        UPDATE '.QubitMenu::TABLE_NAME.'
        SET '.QubitMenu::LFT.' = '.QubitMenu::LFT.' + ?
        WHERE '.QubitMenu::LFT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      $statement = $connection->prepare('
        UPDATE '.QubitMenu::TABLE_NAME.'
        SET '.QubitMenu::RGT.' = '.QubitMenu::RGT.' + ?
        WHERE '.QubitMenu::RGT.' >= ?');
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
      UPDATE '.QubitMenu::TABLE_NAME.'
      SET '.QubitMenu::LFT.' = '.QubitMenu::LFT.' + ?, '.QubitMenu::RGT.' = '.QubitMenu::RGT.' + ?
      WHERE '.QubitMenu::LFT.' >= ?
      AND '.QubitMenu::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $statement = $connection->prepare('
      UPDATE '.QubitMenu::TABLE_NAME.'
      SET '.QubitMenu::LFT.' = '.QubitMenu::LFT.' - ?
      WHERE '.QubitMenu::LFT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    $statement = $connection->prepare('
      UPDATE '.QubitMenu::TABLE_NAME.'
      SET '.QubitMenu::RGT.' = '.QubitMenu::RGT.' - ?
      WHERE '.QubitMenu::RGT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    return $this;
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
