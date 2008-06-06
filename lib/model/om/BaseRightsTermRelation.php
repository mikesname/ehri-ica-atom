<?php

abstract class BaseRightsTermRelation
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_rights_term_relation';

  const RIGHTS_ID = 'q_rights_term_relation.RIGHTS_ID';
  const TERM_ID = 'q_rights_term_relation.TERM_ID';
  const TYPE_ID = 'q_rights_term_relation.TYPE_ID';
  const DESCRIPTION = 'q_rights_term_relation.DESCRIPTION';
  const CREATED_AT = 'q_rights_term_relation.CREATED_AT';
  const UPDATED_AT = 'q_rights_term_relation.UPDATED_AT';
  const ID = 'q_rights_term_relation.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitRightsTermRelation::RIGHTS_ID);
    $criteria->addSelectColumn(QubitRightsTermRelation::TERM_ID);
    $criteria->addSelectColumn(QubitRightsTermRelation::TYPE_ID);
    $criteria->addSelectColumn(QubitRightsTermRelation::DESCRIPTION);
    $criteria->addSelectColumn(QubitRightsTermRelation::CREATED_AT);
    $criteria->addSelectColumn(QubitRightsTermRelation::UPDATED_AT);
    $criteria->addSelectColumn(QubitRightsTermRelation::ID);

    return $criteria;
  }

  protected static $rightsTermRelations = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$rightsTermRelations[$id = $resultSet->getInt(7)]))
    {
      $rightsTermRelation = new QubitRightsTermRelation;
      $rightsTermRelation->hydrate($resultSet);

      self::$rightsTermRelations[$id] = $rightsTermRelation;
    }

    return self::$rightsTermRelations[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRightsTermRelation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRightsTermRelation', $options);
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
    $criteria->add(QubitRightsTermRelation::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRightsTermRelation::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $rightsId = null;

  public function getRightsId()
  {
    return $this->rightsId;
  }

  public function setRightsId($rightsId)
  {
    $this->rightsId = $rightsId;

    return $this;
  }

  protected $termId = null;

  public function getTermId()
  {
    return $this->termId;
  }

  public function setTermId($termId)
  {
    $this->termId = $termId;

    return $this;
  }

  protected $typeId = null;

  public function getTypeId()
  {
    return $this->typeId;
  }

  public function setTypeId($typeId)
  {
    $this->typeId = $typeId;

    return $this;
  }

  protected $description = null;

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;

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
    $this->columnValues['rightsId'] = $this->rightsId;
    $this->columnValues['termId'] = $this->termId;
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['description'] = $this->description;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->rightsId = $results->getInt($columnOffset++);
    $this->termId = $results->getInt($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->description = $results->getString($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRightsTermRelation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRightsTermRelation::ID, $this->id);

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

    if ($this->isColumnModified('rightsId'))
    {
      $criteria->add(QubitRightsTermRelation::RIGHTS_ID, $this->rightsId);
    }

    if ($this->isColumnModified('termId'))
    {
      $criteria->add(QubitRightsTermRelation::TERM_ID, $this->termId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitRightsTermRelation::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitRightsTermRelation::DESCRIPTION, $this->description);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitRightsTermRelation::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitRightsTermRelation::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRightsTermRelation::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRightsTermRelation::DATABASE_NAME);
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

    if ($this->isColumnModified('rightsId'))
    {
      $criteria->add(QubitRightsTermRelation::RIGHTS_ID, $this->rightsId);
    }

    if ($this->isColumnModified('termId'))
    {
      $criteria->add(QubitRightsTermRelation::TERM_ID, $this->termId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitRightsTermRelation::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitRightsTermRelation::DESCRIPTION, $this->description);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitRightsTermRelation::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitRightsTermRelation::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRightsTermRelation::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitRightsTermRelation::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitRightsTermRelation::DATABASE_NAME);
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
    $criteria->add(QubitRightsTermRelation::ID, $this->id);

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

  public static function addJoinRightsCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsTermRelation::RIGHTS_ID, QubitRights::ID);

    return $criteria;
  }

  public function getRights(array $options = array())
  {
    return $this->rights = QubitRights::getById($this->rightsId, $options);
  }

  public function setRights(QubitRights $rights)
  {
    $this->rightsId = $rights->getId();

    return $this;
  }

  public static function addJoinTermCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsTermRelation::TERM_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getTerm(array $options = array())
  {
    return $this->term = QubitTerm::getById($this->termId, $options);
  }

  public function setTerm(QubitTerm $term)
  {
    $this->termId = $term->getId();

    return $this;
  }

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRightsTermRelation::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getType(array $options = array())
  {
    return $this->type = QubitTerm::getById($this->typeId, $options);
  }

  public function setType(QubitTerm $term)
  {
    $this->typeId = $term->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.RightsTermRelationMapBuilder');
