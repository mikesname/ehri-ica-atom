<?php

abstract class BaseInformationObject extends QubitObject implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_information_object',

    ID = 'q_information_object.ID',
    IDENTIFIER = 'q_information_object.IDENTIFIER',
    OAI_LOCAL_IDENTIFIER = 'q_information_object.OAI_LOCAL_IDENTIFIER',
    LEVEL_OF_DESCRIPTION_ID = 'q_information_object.LEVEL_OF_DESCRIPTION_ID',
    COLLECTION_TYPE_ID = 'q_information_object.COLLECTION_TYPE_ID',
    REPOSITORY_ID = 'q_information_object.REPOSITORY_ID',
    PARENT_ID = 'q_information_object.PARENT_ID',
    DESCRIPTION_STATUS_ID = 'q_information_object.DESCRIPTION_STATUS_ID',
    DESCRIPTION_DETAIL_ID = 'q_information_object.DESCRIPTION_DETAIL_ID',
    DESCRIPTION_IDENTIFIER = 'q_information_object.DESCRIPTION_IDENTIFIER',
    LFT = 'q_information_object.LFT',
    RGT = 'q_information_object.RGT',
    CREATED_AT = 'q_information_object.CREATED_AT',
    UPDATED_AT = 'q_information_object.UPDATED_AT',
    SOURCE_CULTURE = 'q_information_object.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitInformationObject::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitInformationObject::ID);
    $criteria->addSelectColumn(QubitInformationObject::IDENTIFIER);
    $criteria->addSelectColumn(QubitInformationObject::OAI_LOCAL_IDENTIFIER);
    $criteria->addSelectColumn(QubitInformationObject::LEVEL_OF_DESCRIPTION_ID);
    $criteria->addSelectColumn(QubitInformationObject::COLLECTION_TYPE_ID);
    $criteria->addSelectColumn(QubitInformationObject::REPOSITORY_ID);
    $criteria->addSelectColumn(QubitInformationObject::PARENT_ID);
    $criteria->addSelectColumn(QubitInformationObject::DESCRIPTION_STATUS_ID);
    $criteria->addSelectColumn(QubitInformationObject::DESCRIPTION_DETAIL_ID);
    $criteria->addSelectColumn(QubitInformationObject::DESCRIPTION_IDENTIFIER);
    $criteria->addSelectColumn(QubitInformationObject::LFT);
    $criteria->addSelectColumn(QubitInformationObject::RGT);
    $criteria->addSelectColumn(QubitInformationObject::CREATED_AT);
    $criteria->addSelectColumn(QubitInformationObject::UPDATED_AT);
    $criteria->addSelectColumn(QubitInformationObject::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitInformationObject::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitInformationObject', $options);
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
    $criteria->add(QubitInformationObject::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public static function addOrderByPreorder(Criteria $criteria, $order = Criteria::ASC)
  {
    if ($order == Criteria::DESC)
    {
      return $criteria->addDescendingOrderByColumn(QubitInformationObject::LFT);
    }

    return $criteria->addAscendingOrderByColumn(QubitInformationObject::LFT);
  }

  public static function addRootsCriteria(Criteria $criteria)
  {
    $criteria->add(QubitInformationObject::PARENT_ID);

    return $criteria;
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitInformationObject::DATABASE_NAME)->getTable(QubitInformationObject::TABLE_NAME);
  }

  public function offsetExists($offset, array $options = array())
  {
    if (parent::offsetExists($offset, $options))
    {
      return true;
    }

    if ($this->getCurrentinformationObjectI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrentinformationObjectI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
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

    if (null !== $value = $this->getCurrentinformationObjectI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrentinformationObjectI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrentinformationObjectI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
    {
      return $value;
    }

    if ('ancestors' == $offset)
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

    if ('descendants' == $offset)
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

  public function offsetSet($offset, $value, array $options = array())
  {
    parent::offsetSet($offset, $value, $options);

    $this->getCurrentinformationObjectI18n($options)->offsetSet($offset, $value, $options);

    return $this;
  }

  public function offsetUnset($offset, array $options = array())
  {
    parent::offsetUnset($offset, $options);

    $this->getCurrentinformationObjectI18n($options)->offsetUnset($offset, $options);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->informationObjectI18ns as $informationObjectI18n)
    {
      $informationObjectI18n->setid($this->id);

      $affectedRows += $informationObjectI18n->save($connection);
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

  public static function addJoinlevelOfDescriptionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::LEVEL_OF_DESCRIPTION_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoincollectionTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::COLLECTION_TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoinrepositoryCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitRepository::ID);

    return $criteria;
  }

  public static function addJoinparentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::PARENT_ID, QubitInformationObject::ID);

    return $criteria;
  }

  public static function addJoindescriptionStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::DESCRIPTION_STATUS_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoindescriptionDetailCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::DESCRIPTION_DETAIL_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function adddigitalObjectsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::INFORMATION_OBJECT_ID, $id);

    return $criteria;
  }

  public static function getdigitalObjectsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::adddigitalObjectsCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function adddigitalObjectsCriteria(Criteria $criteria)
  {
    return self::adddigitalObjectsCriteriaById($criteria, $this->id);
  }

  protected
    $digitalObjects = null;

  public function getdigitalObjects(array $options = array())
  {
    if (!isset($this->digitalObjects))
    {
      if (!isset($this->id))
      {
        $this->digitalObjects = QubitQuery::create();
      }
      else
      {
        $this->digitalObjects = self::getdigitalObjectsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjects;
  }

  public static function addeventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $id);

    return $criteria;
  }

  public static function geteventsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addeventsCriteriaById($criteria, $id);

    return QubitEvent::get($criteria, $options);
  }

  public function addeventsCriteria(Criteria $criteria)
  {
    return self::addeventsCriteriaById($criteria, $this->id);
  }

  protected
    $events = null;

  public function getevents(array $options = array())
  {
    if (!isset($this->events))
    {
      if (!isset($this->id))
      {
        $this->events = QubitQuery::create();
      }
      else
      {
        $this->events = self::geteventsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->events;
  }

  public static function addinformationObjectsRelatedByparentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::PARENT_ID, $id);

    return $criteria;
  }

  public static function getinformationObjectsRelatedByparentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addinformationObjectsRelatedByparentIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addinformationObjectsRelatedByparentIdCriteria(Criteria $criteria)
  {
    return self::addinformationObjectsRelatedByparentIdCriteriaById($criteria, $this->id);
  }

  protected
    $informationObjectsRelatedByparentId = null;

  public function getinformationObjectsRelatedByparentId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedByparentId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedByparentId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedByparentId = self::getinformationObjectsRelatedByparentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedByparentId;
  }

  public static function addinformationObjectI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObjectI18n::ID, $id);

    return $criteria;
  }

  public static function getinformationObjectI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addinformationObjectI18nsCriteriaById($criteria, $id);

    return QubitInformationObjectI18n::get($criteria, $options);
  }

  public function addinformationObjectI18nsCriteria(Criteria $criteria)
  {
    return self::addinformationObjectI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $informationObjectI18ns = null;

  public function getinformationObjectI18ns(array $options = array())
  {
    if (!isset($this->informationObjectI18ns))
    {
      if (!isset($this->id))
      {
        $this->informationObjectI18ns = QubitQuery::create();
      }
      else
      {
        $this->informationObjectI18ns = self::getinformationObjectI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectI18ns;
  }

  public function getCurrentinformationObjectI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->informationObjectI18ns[$options['culture']]))
    {
      if (!isset($this->id) || null === $informationObjectI18n = QubitInformationObjectI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $informationObjectI18n = new QubitInformationObjectI18n;
        $informationObjectI18n->setculture($options['culture']);
      }
      $this->informationObjectI18ns[$options['culture']] = $informationObjectI18n;
    }

    return $this->informationObjectI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitInformationObject::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitInformationObject::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitInformationObject::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitInformationObject::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected function updateNestedSet($connection = null)
  {
unset($this->values['lft']);
unset($this->values['rgt']);
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitInformationObject::DATABASE_NAME);
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
        SELECT MAX('.QubitInformationObject::RGT.')
        FROM '.QubitInformationObject::TABLE_NAME);
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
        UPDATE '.QubitInformationObject::TABLE_NAME.'
        SET '.QubitInformationObject::LFT.' = '.QubitInformationObject::LFT.' + ?
        WHERE '.QubitInformationObject::LFT.' >= ?');
      $statement->execute(array($delta, $parent->rgt));

      $statement = $connection->prepare('
        UPDATE '.QubitInformationObject::TABLE_NAME.'
        SET '.QubitInformationObject::RGT.' = '.QubitInformationObject::RGT.' + ?
        WHERE '.QubitInformationObject::RGT.' >= ?');
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
      UPDATE '.QubitInformationObject::TABLE_NAME.'
      SET '.QubitInformationObject::LFT.' = '.QubitInformationObject::LFT.' + ?, '.QubitInformationObject::RGT.' = '.QubitInformationObject::RGT.' + ?
      WHERE '.QubitInformationObject::LFT.' >= ?
      AND '.QubitInformationObject::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitInformationObject::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $statement = $connection->prepare('
      UPDATE '.QubitInformationObject::TABLE_NAME.'
      SET '.QubitInformationObject::LFT.' = '.QubitInformationObject::LFT.' - ?
      WHERE '.QubitInformationObject::LFT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    $statement = $connection->prepare('
      UPDATE '.QubitInformationObject::TABLE_NAME.'
      SET '.QubitInformationObject::RGT.' = '.QubitInformationObject::RGT.' - ?
      WHERE '.QubitInformationObject::RGT.' >= ?');
    $statement->execute(array($delta, $this->rgt));

    return $this;
  }
}
