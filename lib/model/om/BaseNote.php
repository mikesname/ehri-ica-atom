<?php

abstract class BaseNote implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_note',

    OBJECT_ID = 'q_note.OBJECT_ID',
    TYPE_ID = 'q_note.TYPE_ID',
    SCOPE = 'q_note.SCOPE',
    USER_ID = 'q_note.USER_ID',
    PARENT_ID = 'q_note.PARENT_ID',
    LFT = 'q_note.LFT',
    RGT = 'q_note.RGT',
    CREATED_AT = 'q_note.CREATED_AT',
    UPDATED_AT = 'q_note.UPDATED_AT',
    SOURCE_CULTURE = 'q_note.SOURCE_CULTURE',
    ID = 'q_note.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitNote::OBJECT_ID);
    $criteria->addSelectColumn(QubitNote::TYPE_ID);
    $criteria->addSelectColumn(QubitNote::SCOPE);
    $criteria->addSelectColumn(QubitNote::USER_ID);
    $criteria->addSelectColumn(QubitNote::PARENT_ID);
    $criteria->addSelectColumn(QubitNote::LFT);
    $criteria->addSelectColumn(QubitNote::RGT);
    $criteria->addSelectColumn(QubitNote::CREATED_AT);
    $criteria->addSelectColumn(QubitNote::UPDATED_AT);
    $criteria->addSelectColumn(QubitNote::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitNote::ID);

    return $criteria;
  }

  protected static
    $notes = array();

  protected
    $row = array();

  public static function getFromRow(array $row)
  {
    if (!isset(self::$notes[$id = (int) $row[10]]))
    {
      $note = new QubitNote;
      $note->new = false;
      $note->row = $row;

      self::$notes[$id] = $note;
    }

    return self::$notes[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitNote::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitNote', $options);
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
    $criteria->add(QubitNote::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitNote::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitNote::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitNote::PARENT_ID);

    return $criteria;
  }

  protected
    $tables = array();

  public function __construct()
  {
    $this->tables[] = Propel::getDatabaseMap(QubitNote::DATABASE_NAME)->getTable(QubitNote::TABLE_NAME);
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

    if (call_user_func_array(array($this->getCurrentnoteI18n($options), '__isset'), $args))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && call_user_func_array(array($this->getCurrentnoteI18n(array('sourceCulture' => true) + $options), '__isset'), $args))
    {
      return true;
    }

    if ('ancestors' == $name)
    {
      return true;
    }

    if ('descendants' == $name)
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

    if (null !== $value = call_user_func_array(array($this->getCurrentnoteI18n($options), '__get'), $args))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = call_user_func_array(array($this->getCurrentnoteI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = call_user_func_array(array($this->getCurrentnoteI18n(array('sourceCulture' => true) + $options), '__get'), $args))
    {
      return $value;
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

    call_user_func_array(array($this->getCurrentnoteI18n($options), '__set'), $args);

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

    call_user_func_array(array($this->getCurrentnoteI18n($options), '__unset'), $args);

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
      $options['connection'] = Propel::getConnection(QubitNote::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitNote::ID, $this->id);

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

    foreach ($this->noteI18ns as $noteI18n)
    {
      $noteI18n->setid($this->id);

      $affectedRows += $noteI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $this->updateNestedSet($connection);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
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
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
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

    $this->refresh(array('connection' => $connection));
    $this->deleteFromNestedSet($connection);

    $criteria = new Criteria;
    $criteria->add(QubitNote::ID, $this->id);

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

  public static function addJoinobjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitNote::OBJECT_ID, QubitObject::ID);

    return $criteria;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoinuserCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitNote::USER_ID, QubitUser::ID);

    return $criteria;
  }

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitNote::PARENT_ID, QubitNote::ID);

    return $criteria;
  }

  public static function addnotesRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::PARENT_ID, $id);

    return $criteria;
  }

  public static function getnotesRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addnotesRelatedByparentIdCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addnotesRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::addnotesRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  protected
    $notesRelatedByparentId = null;

  public function getnotesRelatedByparentId(array $options = array())
  {
    if (!isset($this->notesRelatedByparentId))
    {
      if (!isset($this->id))
      {
        $this->notesRelatedByparentId = QubitQuery::create();
      }
      else
      {
        $this->notesRelatedByparentId = self::getnotesRelatedByparentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notesRelatedByparentId;
  }

  public static function addnoteI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNoteI18n::ID, $id);

    return $criteria;
  }

  public static function getnoteI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addnoteI18nsCriteriaById($criteria, $id);

    return QubitNoteI18n::get($criteria, $options);
  }

  public function addnoteI18nsCriteria(Criteria $criteria)
  {
    return self::addnoteI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $noteI18ns = null;

  public function getnoteI18ns(array $options = array())
  {
    if (!isset($this->noteI18ns))
    {
      if (!isset($this->id))
      {
        $this->noteI18ns = QubitQuery::create();
      }
      else
      {
        $this->noteI18ns = self::getnoteI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->noteI18ns;
  }

  public function getCurrentnoteI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->noteI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $noteI18n = QubitNoteI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $noteI18n = new QubitNoteI18n;
        $noteI18n->setculture($options['culture']);
      }
      $this->noteI18ns[$options['culture']] = $noteI18n;
    }

    return $this->noteI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitNote::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitNote::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitNote::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitNote::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected function updateNestedSet($connection = null)
  {
unset($this->values['lft']);
unset($this->values['rgt']);
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
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
        SELECT MAX('.QubitNote::RGT.')
        FROM '.QubitNote::TABLE_NAME);
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
        UPDATE '.QubitNote::TABLE_NAME.'
        SET '.QubitNote::LFT.' = '.QubitNote::LFT.' + ?
        WHERE '.QubitNote::LFT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      $statement = $connection->prepare('
        UPDATE '.QubitNote::TABLE_NAME.'
        SET '.QubitNote::RGT.' = '.QubitNote::RGT.' + ?
        WHERE '.QubitNote::RGT.' >= ?');
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
      UPDATE '.QubitNote::TABLE_NAME.'
      SET '.QubitNote::LFT.' = '.QubitNote::LFT.' + ?, '.QubitNote::RGT.' = '.QubitNote::RGT.' + ?
      WHERE '.QubitNote::LFT.' >= ?
      AND '.QubitNote::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $statement = $connection->prepare('
      UPDATE '.QubitNote::TABLE_NAME.'
      SET '.QubitNote::LFT.' = '.QubitNote::LFT.' - ?
      WHERE '.QubitNote::LFT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    $statement = $connection->prepare('
      UPDATE '.QubitNote::TABLE_NAME.'
      SET '.QubitNote::RGT.' = '.QubitNote::RGT.' - ?
      WHERE '.QubitNote::RGT.' >= ?');
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
