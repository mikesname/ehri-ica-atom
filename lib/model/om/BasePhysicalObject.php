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

    return self::get($criteria, $options)->__get(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitPhysicalObject::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
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

  public function __isset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    try
    {
      return call_user_func_array(array($this, 'QubitObject::__isset'), $args);
    }
    catch (sfException $e)
    {
    }

    if ('physicalObjectsRelatedByparentId' == $name)
    {
      return true;
    }

    if ('physicalObjectI18ns' == $name)
    {
      return true;
    }

    try
    {
      if (!$value = call_user_func_array(array($this->getCurrentphysicalObjectI18n($options), '__isset'), $args) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentphysicalObjectI18n(array('sourceCulture' => true) + $options), '__isset'), $args);
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

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    try
    {
      return call_user_func_array(array($this, 'QubitObject::__get'), $args);
    }
    catch (sfException $e)
    {
    }

    if ('physicalObjectsRelatedByparentId' == $name)
    {
      if (!isset($this->refFkValues['physicalObjectsRelatedByparentId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['physicalObjectsRelatedByparentId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['physicalObjectsRelatedByparentId'] = self::getphysicalObjectsRelatedByparentIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['physicalObjectsRelatedByparentId'];
    }

    if ('physicalObjectI18ns' == $name)
    {
      if (!isset($this->refFkValues['physicalObjectI18ns']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['physicalObjectI18ns'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['physicalObjectI18ns'] = self::getphysicalObjectI18nsById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['physicalObjectI18ns'];
    }

    try
    {
      if (1 > strlen($value = call_user_func_array(array($this->getCurrentphysicalObjectI18n($options), '__get'), $args)) && !empty($options['cultureFallback']))
      {
        return call_user_func_array(array($this->getCurrentphysicalObjectI18n(array('sourceCulture' => true) + $options), '__get'), $args);
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

  public function __set($name, $value)
  {
    $args = func_get_args();

    $options = array();
    if (2 < count($args))
    {
      $options = $args[2];
    }

    call_user_func_array(array($this, 'QubitObject::__set'), $args);

    call_user_func_array(array($this->getCurrentphysicalObjectI18n($options), '__set'), $args);

    return $this;
  }

  public function __unset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    call_user_func_array(array($this, 'QubitObject::__unset'), $args);

    call_user_func_array(array($this->getCurrentphysicalObjectI18n($options), '__unset'), $args);

    return $this;
  }

  public function clear()
  {
    foreach ($this->physicalObjectI18ns as $physicalObjectI18n)
    {
      $physicalObjectI18n->clear();
    }

    return parent::clear();
  }

  public function save($connection = null)
  {
    parent::save($connection);

    foreach ($this->physicalObjectI18ns as $physicalObjectI18n)
    {
      $physicalObjectI18n->id = $this->id;

      $physicalObjectI18n->save($connection);
    }

    return $this;
  }

  protected function insert($connection = null)
  {
    $this->updateNestedSet($connection);

    parent::insert($connection);

    return $this;
  }

  protected function update($connection = null)
  {
        if (isset($this->values['parentId']))
    {
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
      
                  if ($originalParentId != $this->values['parentId'])
      {
        $this->updateNestedSet($connection);
      }
    }

    parent::update($connection);

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

    parent::delete($connection);

    return $this;
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

    $physicalObjectI18ns = $this->physicalObjectI18ns->indexBy('culture');
    if (!isset($physicalObjectI18ns[$options['culture']]))
    {
      $physicalObjectI18ns[$options['culture']] = new QubitPhysicalObjectI18n;
    }

    return $physicalObjectI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitPhysicalObject::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitPhysicalObject::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitPhysicalObject::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitPhysicalObject::RGT, $this->rgt, Criteria::LESS_THAN);
  }

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

    if (null === $parent = $this->__get('parent', array('connection' => $connection)))
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
      $parent->clear();

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
