<?php

abstract class BaseRights
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_rights';

  const OBJECT_ID = 'q_rights.OBJECT_ID';
  const PERMISSION_ID = 'q_rights.PERMISSION_ID';
  const CREATED_AT = 'q_rights.CREATED_AT';
  const UPDATED_AT = 'q_rights.UPDATED_AT';
  const SOURCE_CULTURE = 'q_rights.SOURCE_CULTURE';
  const ID = 'q_rights.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitRights::OBJECT_ID);
    $criteria->addSelectColumn(QubitRights::PERMISSION_ID);
    $criteria->addSelectColumn(QubitRights::CREATED_AT);
    $criteria->addSelectColumn(QubitRights::UPDATED_AT);
    $criteria->addSelectColumn(QubitRights::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitRights::ID);

    return $criteria;
  }

  protected static $rightss = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$rightss[$id = $resultSet->getInt(6)]))
    {
      $rights = new QubitRights;
      $rights->hydrate($resultSet);

      self::$rightss[$id] = $rights;
    }

    return self::$rightss[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRights::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRights', $options);
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
    $criteria->add(QubitRights::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRights::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $objectId = null;

  public function getObjectId()
  {
    return $this->objectId;
  }

  public function setObjectId($objectId)
  {
    $this->objectId = $objectId;

    return $this;
  }

  protected $permissionId = null;

  public function getPermissionId()
  {
    return $this->permissionId;
  }

  public function setPermissionId($permissionId)
  {
    $this->permissionId = $permissionId;

    return $this;
  }

  protected $createdAt = null;

  public function getCreatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->createdAt);
    }

    return $this->createdAt;
  }

  public function setCreatedAt($createdAt)
  {
    if (is_string($createdAt) && false === $createdAt = strtotime($createdAt))
    {
      throw new PropelException('Unable to parse date / time value for [createdAt] from input: '.var_export($createdAt, true));
    }

    $this->createdAt = $createdAt;

    return $this;
  }

  protected $updatedAt = null;

  public function getUpdatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->updatedAt);
    }

    return $this->updatedAt;
  }

  public function setUpdatedAt($updatedAt)
  {
    if (is_string($updatedAt) && false === $updatedAt = strtotime($updatedAt))
    {
      throw new PropelException('Unable to parse date / time value for [updatedAt] from input: '.var_export($updatedAt, true));
    }

    $this->updatedAt = $updatedAt;

    return $this;
  }

  protected $sourceCulture = null;

  public function getSourceCulture()
  {
    return $this->sourceCulture;
  }

  public function setSourceCulture($sourceCulture)
  {
    $this->sourceCulture = $sourceCulture;

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
    $this->columnValues['objectId'] = $this->objectId;
    $this->columnValues['permissionId'] = $this->permissionId;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->objectId = $results->getInt($columnOffset++);
    $this->permissionId = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRights::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRights::ID, $this->id);

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

    foreach ($this->rightsI18ns as $rightsI18n)
    {
      $rightsI18n->setId($this->id);

      $affectedRows += $rightsI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitRights::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('permissionId'))
    {
      $criteria->add(QubitRights::PERMISSION_ID, $this->permissionId);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitRights::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitRights::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitRights::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRights::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRights::DATABASE_NAME);
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

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitRights::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('permissionId'))
    {
      $criteria->add(QubitRights::PERMISSION_ID, $this->permissionId);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitRights::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitRights::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitRights::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRights::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitRights::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitRights::DATABASE_NAME);
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
    $criteria->add(QubitRights::ID, $this->id);

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

  public static function addJoinObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRights::OBJECT_ID, QubitObject::ID);

    return $criteria;
  }

  public function getObject(array $options = array())
  {
    return $this->object = QubitObject::getById($this->objectId, $options);
  }

  public function setObject(QubitObject $object)
  {
    $this->objectId = $object->getId();

    return $this;
  }

  public static function addJoinPermissionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRights::PERMISSION_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getPermission(array $options = array())
  {
    return $this->permission = QubitTerm::getById($this->permissionId, $options);
  }

  public function setPermission(QubitTerm $term)
  {
    $this->permissionId = $term->getId();

    return $this;
  }

  public static function addRightsI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsI18n::ID, $id);

    return $criteria;
  }

  public static function getRightsI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightsI18nsCriteriaById($criteria, $id);

    return QubitRightsI18n::get($criteria, $options);
  }

  public function addRightsI18nsCriteria(Criteria $criteria)
  {
    return self::addRightsI18nsCriteriaById($criteria, $this->id);
  }

  protected $rightsI18ns = null;

  public function getRightsI18ns(array $options = array())
  {
    if (!isset($this->rightsI18ns))
    {
      if (!isset($this->id))
      {
        $this->rightsI18ns = QubitQuery::create();
      }
      else
      {
        $this->rightsI18ns = self::getRightsI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsI18ns;
  }

  public static function addRightsTermRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsTermRelation::RIGHTS_ID, $id);

    return $criteria;
  }

  public static function getRightsTermRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightsTermRelationsCriteriaById($criteria, $id);

    return QubitRightsTermRelation::get($criteria, $options);
  }

  public function addRightsTermRelationsCriteria(Criteria $criteria)
  {
    return self::addRightsTermRelationsCriteriaById($criteria, $this->id);
  }

  protected $rightsTermRelations = null;

  public function getRightsTermRelations(array $options = array())
  {
    if (!isset($this->rightsTermRelations))
    {
      if (!isset($this->id))
      {
        $this->rightsTermRelations = QubitQuery::create();
      }
      else
      {
        $this->rightsTermRelations = self::getRightsTermRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsTermRelations;
  }

  public static function addRightsActorRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsActorRelation::RIGHTS_ID, $id);

    return $criteria;
  }

  public static function getRightsActorRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRightsActorRelationsCriteriaById($criteria, $id);

    return QubitRightsActorRelation::get($criteria, $options);
  }

  public function addRightsActorRelationsCriteria(Criteria $criteria)
  {
    return self::addRightsActorRelationsCriteriaById($criteria, $this->id);
  }

  protected $rightsActorRelations = null;

  public function getRightsActorRelations(array $options = array())
  {
    if (!isset($this->rightsActorRelations))
    {
      if (!isset($this->id))
      {
        $this->rightsActorRelations = QubitQuery::create();
      }
      else
      {
        $this->rightsActorRelations = self::getRightsActorRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rightsActorRelations;
  }

  public function getDescription(array $options = array())
  {
    $description = $this->getCurrentRightsI18n($options)->getDescription();
    if (!empty($options['cultureFallback']) && $description === null)
    {
      $description = $this->getCurrentRightsI18n(array('sourceCulture' => true) + $options)->getDescription();
    }

    return $description;
  }

  public function setDescription($value, array $options = array())
  {
    $this->getCurrentRightsI18n($options)->setDescription($value);

    return $this;
  }

  public function getCurrentRightsI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->rightsI18ns[$options['culture']]))
    {
      if (null === $rightsI18n = QubitRightsI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $rightsI18n = new QubitRightsI18n;
        $rightsI18n->setCulture($options['culture']);
      }
      $this->rightsI18ns[$options['culture']] = $rightsI18n;
    }

    return $this->rightsI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.RightsMapBuilder');
