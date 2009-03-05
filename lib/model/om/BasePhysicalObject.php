<?php

abstract class BasePhysicalObject extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_physical_object',

    ID = 'q_physical_object.ID',
    TYPE_ID = 'q_physical_object.TYPE_ID',
    PARENT_ID = 'q_physical_object.PARENT_ID',
    LFT = 'q_physical_object.LFT',
    RGT = 'q_physical_object.RGT',
    CREATED_AT = 'q_physical_object.CREATED_AT',
    UPDATED_AT = 'q_physical_object.UPDATED_AT',
    SOURCE_CULTURE = 'q_physical_object.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitPhysicalObject::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitPhysicalObject::ID);
    $criteria->addSelectColumn(QubitPhysicalObject::TYPE_ID);
    $criteria->addSelectColumn(QubitPhysicalObject::PARENT_ID);
    $criteria->addSelectColumn(QubitPhysicalObject::LFT);
    $criteria->addSelectColumn(QubitPhysicalObject::RGT);
    $criteria->addSelectColumn(QubitPhysicalObject::CREATED_AT);
    $criteria->addSelectColumn(QubitPhysicalObject::UPDATED_AT);
    $criteria->addSelectColumn(QubitPhysicalObject::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPhysicalObject::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPhysicalObject', $options);
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
    $criteria->add(QubitPhysicalObject::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitPhysicalObject::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitPhysicalObject::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitPhysicalObject::PARENT_ID);

    return $criteria;
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitPhysicalObject::DATABASE_NAME)->getTable(QubitPhysicalObject::TABLE_NAME);
  }

  public function offsetExists($offset, array $options = array())
  {
    if (parent::offsetExists($offset, $options))
    {
      return true;
    }

    if ($this->getCurrentphysicalObjectI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrentphysicalObjectI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
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

  public function offsetGet($offset, array $options = array())
  {
    if (null !== $value = parent::offsetGet($offset, $options))
    {
      return $value;
    }

    if (null !== $value = $this->getCurrentphysicalObjectI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrentphysicalObjectI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrentphysicalObjectI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
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

  public function offsetSet($offset, $value, array $options = array())
  {
    parent::offsetSet($offset, $value, $options);

    $this->getCurrentphysicalObjectI18n($options)->offsetSet($offset, $value, $options);

    return $this;
  }

  public function offsetUnset($offset, array $options = array())
  {
    parent::offsetUnset($offset, $options);

    $this->getCurrentphysicalObjectI18n($options)->offsetUnset($offset, $options);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->physicalObjectI18ns as $physicalObjectI18n)
    {
      $physicalObjectI18n->setid($this->id);

      $affectedRows += $physicalObjectI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $this->updateNestedSet($connection);

    $affectedRows += parent::insert($connection);

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

    $affectedRows += parent::update($connection);

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

    $affectedRows += parent::delete($connection);

    return $affectedRows;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPhysicalObject::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitPhysicalObject::PARENT_ID, QubitPhysicalObject::ID);

    return $criteria;
  }

  public static function addphysicalObjectsRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPhysicalObject::PARENT_ID, $id);

    return $criteria;
  }

  public static function getphysicalObjectsRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addphysicalObjectsRelatedByparentIdCriteriaById($criteria, $id);

    return QubitPhysicalObject::get($criteria, $options);
  }

  public function addphysicalObjectsRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::addphysicalObjectsRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  protected
    $physicalObjectsRelatedByparentId = null;

  public function getphysicalObjectsRelatedByparentId(array $options = array())
  {
    if (!isset($this->physicalObjectsRelatedByparentId))
    {
      if (!isset($this->id))
      {
        $this->physicalObjectsRelatedByparentId = QubitQuery::create();
      }
      else
      {
        $this->physicalObjectsRelatedByparentId = self::getphysicalObjectsRelatedByparentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->physicalObjectsRelatedByparentId;
  }

  public static function addphysicalObjectI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPhysicalObjectI18n::ID, $id);

    return $criteria;
  }

  public static function getphysicalObjectI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addphysicalObjectI18nsCriteriaById($criteria, $id);

    return QubitPhysicalObjectI18n::get($criteria, $options);
  }

  public function addphysicalObjectI18nsCriteria(Criteria $criteria)
  {
    return self::addphysicalObjectI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $physicalObjectI18ns = null;

  public function getphysicalObjectI18ns(array $options = array())
  {
    if (!isset($this->physicalObjectI18ns))
    {
      if (!isset($this->id))
      {
        $this->physicalObjectI18ns = QubitQuery::create();
      }
      else
      {
        $this->physicalObjectI18ns = self::getphysicalObjectI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->physicalObjectI18ns;
  }

  public function getCurrentphysicalObjectI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->physicalObjectI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $physicalObjectI18n = QubitPhysicalObjectI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $physicalObjectI18n = new QubitPhysicalObjectI18n;
        $physicalObjectI18n->setculture($options['culture']);
      }
      $this->physicalObjectI18ns[$options['culture']] = $physicalObjectI18n;
    }

    return $this->physicalObjectI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitPhysicalObject::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitPhysicalObject::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  protected
    $ancestors = null;

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitPhysicalObject::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitPhysicalObject::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected
    $descendants = null;

  protected function updateNestedSet($connection = null)
  {
unset($this->values['lft']);
unset($this->values['rgt']);
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPhysicalObject::DATABASE_NAME);
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
        SELECT MAX('.QubitPhysicalObject::RGT.')
        FROM '.QubitPhysicalObject::TABLE_NAME);
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
        UPDATE '.QubitPhysicalObject::TABLE_NAME.'
        SET '.QubitPhysicalObject::LFT.' = '.QubitPhysicalObject::LFT.' + ?
        WHERE '.QubitPhysicalObject::LFT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      $statement = $connection->prepare('
        UPDATE '.QubitPhysicalObject::TABLE_NAME.'
        SET '.QubitPhysicalObject::RGT.' = '.QubitPhysicalObject::RGT.' + ?
        WHERE '.QubitPhysicalObject::RGT.' >= ?');
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
      UPDATE '.QubitPhysicalObject::TABLE_NAME.'
      SET '.QubitPhysicalObject::LFT.' = '.QubitPhysicalObject::LFT.' + ?, '.QubitPhysicalObject::RGT.' = '.QubitPhysicalObject::RGT.' + ?
      WHERE '.QubitPhysicalObject::LFT.' >= ?
      AND '.QubitPhysicalObject::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitPhysicalObject::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $statement = $connection->prepare('
      UPDATE '.QubitPhysicalObject::TABLE_NAME.'
      SET '.QubitPhysicalObject::LFT.' = '.QubitPhysicalObject::LFT.' - ?
      WHERE '.QubitPhysicalObject::LFT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    $statement = $connection->prepare('
      UPDATE '.QubitPhysicalObject::TABLE_NAME.'
      SET '.QubitPhysicalObject::RGT.' = '.QubitPhysicalObject::RGT.' - ?
      WHERE '.QubitPhysicalObject::RGT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    return $this;
  }
}
