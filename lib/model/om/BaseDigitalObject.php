<?php

abstract class BaseDigitalObject extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'digital_object',

    ID = 'digital_object.ID',
    INFORMATION_OBJECT_ID = 'digital_object.INFORMATION_OBJECT_ID',
    USAGE_ID = 'digital_object.USAGE_ID',
    MIME_TYPE = 'digital_object.MIME_TYPE',
    MEDIA_TYPE_ID = 'digital_object.MEDIA_TYPE_ID',
    NAME = 'digital_object.NAME',
    PATH = 'digital_object.PATH',
    SEQUENCE = 'digital_object.SEQUENCE',
    BYTE_SIZE = 'digital_object.BYTE_SIZE',
    CHECKSUM = 'digital_object.CHECKSUM',
    CHECKSUM_TYPE = 'digital_object.CHECKSUM_TYPE',
    PARENT_ID = 'digital_object.PARENT_ID',
    LFT = 'digital_object.LFT',
    RGT = 'digital_object.RGT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitDigitalObject::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitDigitalObject::ID);
    $criteria->addSelectColumn(QubitDigitalObject::INFORMATION_OBJECT_ID);
    $criteria->addSelectColumn(QubitDigitalObject::USAGE_ID);
    $criteria->addSelectColumn(QubitDigitalObject::MIME_TYPE);
    $criteria->addSelectColumn(QubitDigitalObject::MEDIA_TYPE_ID);
    $criteria->addSelectColumn(QubitDigitalObject::NAME);
    $criteria->addSelectColumn(QubitDigitalObject::PATH);
    $criteria->addSelectColumn(QubitDigitalObject::SEQUENCE);
    $criteria->addSelectColumn(QubitDigitalObject::BYTE_SIZE);
    $criteria->addSelectColumn(QubitDigitalObject::CHECKSUM);
    $criteria->addSelectColumn(QubitDigitalObject::CHECKSUM_TYPE);
    $criteria->addSelectColumn(QubitDigitalObject::PARENT_ID);
    $criteria->addSelectColumn(QubitDigitalObject::LFT);
    $criteria->addSelectColumn(QubitDigitalObject::RGT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitDigitalObject::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitDigitalObject', $options);
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
    $criteria->add(QubitDigitalObject::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitDigitalObject::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitDigitalObject::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitDigitalObject::PARENT_ID);

    return $criteria;
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitDigitalObject::DATABASE_NAME)->getTable(QubitDigitalObject::TABLE_NAME);
  }

  public function __isset($name)
  {
    $args = func_get_args();

    try
    {
      return call_user_func_array(array($this, 'QubitObject::__isset'), $args);
    }
    catch (sfException $e)
    {
    }

    if ('digitalObjectsRelatedByparentId' == $name)
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

    throw new sfException("Unknown record property \"$name\" on \"".get_class($this).'"');
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

    if ('digitalObjectsRelatedByparentId' == $name)
    {
      if (!isset($this->refFkValues['digitalObjectsRelatedByparentId']))
      {
        if (!isset($this->id))
        {
          $this->refFkValues['digitalObjectsRelatedByparentId'] = QubitQuery::create();
        }
        else
        {
          $this->refFkValues['digitalObjectsRelatedByparentId'] = self::getdigitalObjectsRelatedByparentIdById($this->id, array('self' => $this) + $options);
        }
      }

      return $this->refFkValues['digitalObjectsRelatedByparentId'];
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

    throw new sfException("Unknown record property \"$name\" on \"".get_class($this).'"');
  }

  protected function param($column)
  {
    $value = $this->values[$column->getPhpName()];

    // Convert to DateTime or SQL zero special case
    if (isset($value) && $column->isTemporal() && !$value instanceof DateTime)
    {
      // Year only: one or more digits.  Convert to SQL zero special case
      if (preg_match('/^\d+$/', $value))
      {
        $value .= '-0-0';
      }

      // Year and month only: one or more digits, plus separator, plus
      // one or more digits.  Convert to SQL zero special case
      else if (preg_match('/^\d+[-\/]\d+$/', $value))
      {
        $value .= '-0';
      }

      // Convert to DateTime if not SQL zero special case: year plus
      // separator plus zero to twelve (possibly zero padded) plus
      // separator plus one or more zeros
      if (!preg_match('/^\d+[-\/]0*(?:1[0-2]|\d)[-\/]0+$/', $value))
      {
        try
        {
          $value = new DateTime($value);
        }
        catch (Exception $e)
        {
          return null;
        }
      }
    }

    return $value;
  }

  protected function insert($connection = null)
  {
    $this->updateNestedSet($connection);

    parent::insert($connection);

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

  public static function addJoininformationObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::INFORMATION_OBJECT_ID, QubitInformationObject::ID);

    return $criteria;
  }

  public static function addJoinusageCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::USAGE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoinmediaTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::MEDIA_TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitDigitalObject::PARENT_ID, QubitDigitalObject::ID);

    return $criteria;
  }

  public static function adddigitalObjectsRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::PARENT_ID, $id);

    return $criteria;
  }

  public static function getdigitalObjectsRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::adddigitalObjectsRelatedByparentIdCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function adddigitalObjectsRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::adddigitalObjectsRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitDigitalObject::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitDigitalObject::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitDigitalObject::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitDigitalObject::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected function updateNestedSet($connection = null)
  {
// HACK Try to prevent modifying left and right values anywhere except in this
// method.  Perhaps it would be more logical to use protected visibility for
// these values?
unset($this->values['lft']);
unset($this->values['rgt']);
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitDigitalObject::DATABASE_NAME);
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
        SELECT MAX('.QubitDigitalObject::RGT.')
        FROM '.QubitDigitalObject::TABLE_NAME);
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
        UPDATE '.QubitDigitalObject::TABLE_NAME.'
        SET '.QubitDigitalObject::LFT.' = '.QubitDigitalObject::LFT.' + ?
        WHERE '.QubitDigitalObject::LFT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      $statement = $connection->prepare('
        UPDATE '.QubitDigitalObject::TABLE_NAME.'
        SET '.QubitDigitalObject::RGT.' = '.QubitDigitalObject::RGT.' + ?
        WHERE '.QubitDigitalObject::RGT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $this->lft = $parent->rgt;
        $this->rgt = $parent->rgt + 1;
        $parent->rgt += 2;

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
      UPDATE '.QubitDigitalObject::TABLE_NAME.'
      SET '.QubitDigitalObject::LFT.' = '.QubitDigitalObject::LFT.' + ?, '.QubitDigitalObject::RGT.' = '.QubitDigitalObject::RGT.' + ?
      WHERE '.QubitDigitalObject::LFT.' >= ?
      AND '.QubitDigitalObject::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitDigitalObject::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $statement = $connection->prepare('
      UPDATE '.QubitDigitalObject::TABLE_NAME.'
      SET '.QubitDigitalObject::LFT.' = '.QubitDigitalObject::LFT.' - ?
      WHERE '.QubitDigitalObject::LFT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    $statement = $connection->prepare('
      UPDATE '.QubitDigitalObject::TABLE_NAME.'
      SET '.QubitDigitalObject::RGT.' = '.QubitDigitalObject::RGT.' - ?
      WHERE '.QubitDigitalObject::RGT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    return $this;
  }
}
