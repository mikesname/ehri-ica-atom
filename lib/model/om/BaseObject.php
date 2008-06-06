<?php

abstract class BaseObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_object';

  const CLASS_NAME = 'q_object.CLASS_NAME';
  const ID = 'q_object.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitObject::CLASS_NAME);
    $criteria->addSelectColumn(QubitObject::ID);

    return $criteria;
  }

  protected static $objects = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$objects[$id = $resultSet->getInt(2)]))
    {
      $className = $resultSet->getString(1);
      $object = new $className;

      try
      {
        $object->hydrate($resultSet);
      }
      catch (SQLException $e)
      {
        return call_user_func(array($className, 'getById'), $id);
      }

      self::$objects[$id] = $object;
    }

    return self::$objects[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitObject::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitObject', $options);
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
    $criteria->add(QubitObject::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $className = null;

  public function getClassName()
  {
    return $this->className;
  }

  public function setClassName($className)
  {
    $this->className = $className;

    return $this;
  }

  protected $id = null;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  protected $new = true;

  protected $deleted = false;

  protected $columnValues = null;

  protected function isColumnModified($name)
  {
    return $this->$name != $this->columnValues[$name];
  }

  protected function resetModified()
  {
    $this->columnValues['className'] = $this->className;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->className = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitObject::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitObject::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
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

    $this->new = false;
    $this->resetModified();

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('className'))
    {
      $criteria->add(QubitObject::CLASS_NAME, $this->className);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitObject::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
    }

    $id = BasePeer::doInsert($criteria, $connection);
    $this->id = $id;
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('className'))
    {
      $criteria->add(QubitObject::CLASS_NAME, $this->className);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitObject::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitObject::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitObject::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
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
    $criteria->add(QubitObject::ID, $this->id);

    $affectedRows += self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $affectedRows;
  }

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

  public static function addObjectTermRelationsRelatedByObjectIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitObjectTermRelation::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getObjectTermRelationsRelatedByObjectIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addObjectTermRelationsRelatedByObjectIdCriteriaById($criteria, $id);

    return QubitObjectTermRelation::get($criteria, $options);
  }

  public function addObjectTermRelationsRelatedByObjectIdCriteria(Criteria $criteria)
  {
    return self::addObjectTermRelationsRelatedByObjectIdCriteriaById($criteria, $this->id);
  }

  protected $objectTermRelationsRelatedByObjectId = null;

  public function getObjectTermRelationsRelatedByObjectId(array $options = array())
  {
    if (!isset($this->objectTermRelationsRelatedByObjectId))
    {
      if (!isset($this->id))
      {
        $this->objectTermRelationsRelatedByObjectId = QubitQuery::create();
      }
      else
      {
        $this->objectTermRelationsRelatedByObjectId = self::getObjectTermRelationsRelatedByObjectIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->objectTermRelationsRelatedByObjectId;
  }

  public static function addPropertysCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitProperty::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getPropertysById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPropertysCriteriaById($criteria, $id);

    return QubitProperty::get($criteria, $options);
  }

  public function addPropertysCriteria(Criteria $criteria)
  {
    return self::addPropertysCriteriaById($criteria, $this->id);
  }

  protected $propertys = null;

  public function getPropertys(array $options = array())
  {
    if (!isset($this->propertys))
    {
      if (!isset($this->id))
      {
        $this->propertys = QubitQuery::create();
      }
      else
      {
        $this->propertys = self::getPropertysById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->propertys;
  }

  public static function addRelationsRelatedBySubjectIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRelation::SUBJECT_ID, $id);

    return $criteria;
  }

  public static function getRelationsRelatedBySubjectIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRelationsRelatedBySubjectIdCriteriaById($criteria, $id);

    return QubitRelation::get($criteria, $options);
  }

  public function addRelationsRelatedBySubjectIdCriteria(Criteria $criteria)
  {
    return self::addRelationsRelatedBySubjectIdCriteriaById($criteria, $this->id);
  }

  protected $relationsRelatedBySubjectId = null;

  public function getRelationsRelatedBySubjectId(array $options = array())
  {
    if (!isset($this->relationsRelatedBySubjectId))
    {
      if (!isset($this->id))
      {
        $this->relationsRelatedBySubjectId = QubitQuery::create();
      }
      else
      {
        $this->relationsRelatedBySubjectId = self::getRelationsRelatedBySubjectIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->relationsRelatedBySubjectId;
  }

  public static function addRelationsRelatedByObjectIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRelation::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getRelationsRelatedByObjectIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRelationsRelatedByObjectIdCriteriaById($criteria, $id);

    return QubitRelation::get($criteria, $options);
  }

  public function addRelationsRelatedByObjectIdCriteria(Criteria $criteria)
  {
    return self::addRelationsRelatedByObjectIdCriteriaById($criteria, $this->id);
  }

  protected $relationsRelatedByObjectId = null;

  public function getRelationsRelatedByObjectId(array $options = array())
  {
    if (!isset($this->relationsRelatedByObjectId))
    {
      if (!isset($this->id))
      {
        $this->relationsRelatedByObjectId = QubitQuery::create();
      }
      else
      {
        $this->relationsRelatedByObjectId = self::getRelationsRelatedByObjectIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->relationsRelatedByObjectId;
  }

  public static function addNotesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getNotesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addNotesCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addNotesCriteria(Criteria $criteria)
  {
    return self::addNotesCriteriaById($criteria, $this->id);
  }

  protected $notes = null;

  public function getNotes(array $options = array())
  {
    if (!isset($this->notes))
    {
      if (!isset($this->id))
      {
        $this->notes = QubitQuery::create();
      }
      else
      {
        $this->notes = self::getNotesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notes;
  }

  public static function addRightssCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRights::OBJECT_ID, $id);

    return $criteria;
  }

  public static function getRightssById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightssCriteriaById($criteria, $id);

    return QubitRights::get($criteria, $options);
  }

  public function addRightssCriteria(Criteria $criteria)
  {
    return self::addRightssCriteriaById($criteria, $this->id);
  }

  protected $rightss = null;

  public function getRightss(array $options = array())
  {
    if (!isset($this->rightss))
    {
      if (!isset($this->id))
      {
        $this->rightss = QubitQuery::create();
      }
      else
      {
        $this->rightss = self::getRightssById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightss;
  }
}

BasePeer::getMapBuilder('lib.model.map.ObjectMapBuilder');
