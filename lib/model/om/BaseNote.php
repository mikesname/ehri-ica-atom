<?php

abstract class BaseNote
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_note';

  const OBJECT_ID = 'q_note.OBJECT_ID';
  const TYPE_ID = 'q_note.TYPE_ID';
  const SCOPE = 'q_note.SCOPE';
  const USER_ID = 'q_note.USER_ID';
  const PARENT_ID = 'q_note.PARENT_ID';
  const LFT = 'q_note.LFT';
  const RGT = 'q_note.RGT';
  const CREATED_AT = 'q_note.CREATED_AT';
  const UPDATED_AT = 'q_note.UPDATED_AT';
  const SOURCE_CULTURE = 'q_note.SOURCE_CULTURE';
  const ID = 'q_note.ID';

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

  protected static $notes = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$notes[$id = $resultSet->getInt(11)]))
    {
      $note = new QubitNote;
      $note->hydrate($resultSet);

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

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitNote::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
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

  protected $scope = null;

  public function getScope()
  {
    return $this->scope;
  }

  public function setScope($scope)
  {
    $this->scope = $scope;

    return $this;
  }

  protected $userId = null;

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;

    return $this;
  }

  protected $parentId = null;

  public function getParentId()
  {
    return $this->parentId;
  }

  public function setParentId($parentId)
  {
    $this->parentId = $parentId;

    return $this;
  }

  protected $lft = null;

  public function getLft()
  {
    return $this->lft;
  }

  protected function setLft($lft)
  {
    $this->lft = $lft;

    return $this;
  }

  protected $rgt = null;

  public function getRgt()
  {
    return $this->rgt;
  }

  protected function setRgt($rgt)
  {
    $this->rgt = $rgt;

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
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['scope'] = $this->scope;
    $this->columnValues['userId'] = $this->userId;
    $this->columnValues['parentId'] = $this->parentId;
    $this->columnValues['lft'] = $this->lft;
    $this->columnValues['rgt'] = $this->rgt;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->objectId = $results->getInt($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->scope = $results->getString($columnOffset++);
    $this->userId = $results->getInt($columnOffset++);
    $this->parentId = $results->getInt($columnOffset++);
    $this->lft = $results->getInt($columnOffset++);
    $this->rgt = $results->getInt($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitNote::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitNote::ID, $this->id);

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

    foreach ($this->noteI18ns as $noteI18n)
    {
      $noteI18n->setId($this->id);

      $affectedRows += $noteI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $this->updateNestedSet($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitNote::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitNote::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('scope'))
    {
      $criteria->add(QubitNote::SCOPE, $this->scope);
    }

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitNote::USER_ID, $this->userId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitNote::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitNote::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitNote::RGT, $this->rgt);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitNote::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitNote::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitNote::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitNote::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
    }

    $id = BasePeer::doInsert($criteria, $connection);
    $this->id = $id;
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    if ($this->isColumnModified('parentId'))
    {
      $this->updateNestedSet($connection);
    }

    $criteria = new Criteria;

    if ($this->isColumnModified('objectId'))
    {
      $criteria->add(QubitNote::OBJECT_ID, $this->objectId);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitNote::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('scope'))
    {
      $criteria->add(QubitNote::SCOPE, $this->scope);
    }

    if ($this->isColumnModified('userId'))
    {
      $criteria->add(QubitNote::USER_ID, $this->userId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitNote::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitNote::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitNote::RGT, $this->rgt);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitNote::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitNote::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitNote::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitNote::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitNote::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
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

    $this->deleteFromNestedSet($connection);

    $criteria = new Criteria;
    $criteria->add(QubitNote::ID, $this->id);

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
    $criteria->addJoin(QubitNote::OBJECT_ID, QubitObject::ID);

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

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitNote::TYPE_ID, QubitTerm::ID);

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

  public static function addJoinUserCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitNote::USER_ID, QubitUser::ID);

    return $criteria;
  }

  public function getUser(array $options = array())
  {
    return $this->user = QubitUser::getById($this->userId, $options);
  }

  public function setUser(QubitUser $user)
  {
    $this->userId = $user->getId();

    return $this;
  }

  public static function addJoinParentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitNote::PARENT_ID, QubitNote::ID);

    return $criteria;
  }

  public function getParent(array $options = array())
  {
    return $this->parent = QubitNote::getById($this->parentId, $options);
  }

  public function setParent(QubitNote $note)
  {
    $this->parentId = $note->getId();

    return $this;
  }

  public static function addNotesRelatedByParentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::PARENT_ID, $id);

    return $criteria;
  }

  public static function getNotesRelatedByParentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addNotesRelatedByParentIdCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addNotesRelatedByParentIdCriteria(Criteria $criteria)
  {
    return self::addNotesRelatedByParentIdCriteriaById($criteria, $this->id);
  }

  protected $notesRelatedByParentId = null;

  public function getNotesRelatedByParentId(array $options = array())
  {
    if (!isset($this->notesRelatedByParentId))
    {
      if (!isset($this->id))
      {
        $this->notesRelatedByParentId = QubitQuery::create();
      }
      else
      {
        $this->notesRelatedByParentId = self::getNotesRelatedByParentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notesRelatedByParentId;
  }

  public static function addNoteI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNoteI18n::ID, $id);

    return $criteria;
  }

  public static function getNoteI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addNoteI18nsCriteriaById($criteria, $id);

    return QubitNoteI18n::get($criteria, $options);
  }

  public function addNoteI18nsCriteria(Criteria $criteria)
  {
    return self::addNoteI18nsCriteriaById($criteria, $this->id);
  }

  protected $noteI18ns = null;

  public function getNoteI18ns(array $options = array())
  {
    if (!isset($this->noteI18ns))
    {
      if (!isset($this->id))
      {
        $this->noteI18ns = QubitQuery::create();
      }
      else
      {
        $this->noteI18ns = self::getNoteI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->noteI18ns;
  }

  public function getContent(array $options = array())
  {
    return $this->getCurrentNoteI18n($options)->getContent();
  }

  public function setContent($value, array $options = array())
  {
    $this->getCurrentNoteI18n($options)->setContent($value);

    return $this;
  }

  public function getCurrentNoteI18n(array $options = array())
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
      if (null === $noteI18n = QubitNoteI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $noteI18n = new QubitNoteI18n;
        $noteI18n->setCulture($options['culture']);
      }
      $this->noteI18ns[$options['culture']] = $noteI18n;
    }

    return $this->noteI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitNote::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitNote::RGT, $this->rgt, Criteria::GREATER_THAN);
  }

  protected $ancestors = null;

  public function getAncestors(array $options = array())
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

  public function addDescendantsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitNote::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitNote::RGT, $this->rgt, Criteria::LESS_THAN);
  }

  protected $descendants = null;

  public function getDescendants(array $options = array())
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

  protected function updateNestedSet($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
    }

    if (null === $parent = $this->getParent(array('connection' => $connection)))
    {
      $stmt = $connection->prepareStatement('
        SELECT MAX('.QubitNote::RGT.')
        FROM '.QubitNote::TABLE_NAME);
      $results = $stmt->executeQuery(ResultSet::FETCHMODE_NUM);
      $results->next();
      $max = $results->getInt(1);

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

      if (!isset($this->lft) || !isset($this->rgt))
      {
        $delta = 2;
      }
      else
      {
        if ($this->lft <= $parent->lft && $this->rgt >= $parent->rgt)
        {
          throw new PropelException('An object cannot be a descendant of itself.');
        }

        $delta = $this->rgt - $this->lft + 1;
      }

      $stmt = $connection->prepareStatement('
        UPDATE '.QubitNote::TABLE_NAME.'
        SET '.QubitNote::LFT.' = '.QubitNote::LFT.' + ?
        WHERE '.QubitNote::LFT.' >= ?');
      $stmt->setInt(1, $delta);
      $stmt->setInt(2, $parent->rgt);
      $stmt->executeUpdate();

      $stmt = $connection->prepareStatement('
        UPDATE '.QubitNote::TABLE_NAME.'
        SET '.QubitNote::RGT.' = '.QubitNote::RGT.' + ?
        WHERE '.QubitNote::RGT.' >= ?');
      $stmt->setInt(1, $delta);
      $stmt->setInt(2, $parent->rgt);
      $stmt->executeUpdate();

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

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitNote::TABLE_NAME.'
      SET '.QubitNote::LFT.' = '.QubitNote::LFT.' + ?, '.QubitNote::RGT.' = '.QubitNote::RGT.' + ?
      WHERE '.QubitNote::LFT.' >= ?
      AND '.QubitNote::RGT.' <= ?');
    $stmt->setInt(1, $shift);
    $stmt->setInt(2, $shift);
    $stmt->setInt(3, $this->lft);
    $stmt->setInt(4, $this->rgt);
    $stmt->executeUpdate();

    $this->deleteFromNestedSet($connection);

    $this->columnValues['lft'] = $this->lft += $shift;
    $this->columnValues['rgt'] = $this->rgt += $shift;

    return $this;
  }

  protected function deleteFromNestedSet($connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitNote::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitNote::TABLE_NAME.'
      SET '.QubitNote::LFT.' = '.QubitNote::LFT.' - ?
      WHERE '.QubitNote::LFT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitNote::TABLE_NAME.'
      SET '.QubitNote::RGT.' = '.QubitNote::RGT.' - ?
      WHERE '.QubitNote::RGT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.NoteMapBuilder');
