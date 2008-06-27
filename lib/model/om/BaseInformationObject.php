<?php

abstract class BaseInformationObject extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_information_object';

  const ID = 'q_information_object.ID';
  const IDENTIFIER = 'q_information_object.IDENTIFIER';
  const LEVEL_OF_DESCRIPTION_ID = 'q_information_object.LEVEL_OF_DESCRIPTION_ID';
  const COLLECTION_TYPE_ID = 'q_information_object.COLLECTION_TYPE_ID';
  const REPOSITORY_ID = 'q_information_object.REPOSITORY_ID';
  const PARENT_ID = 'q_information_object.PARENT_ID';
  const DESCRIPTION_STATUS_ID = 'q_information_object.DESCRIPTION_STATUS_ID';
  const DESCRIPTION_DETAIL_ID = 'q_information_object.DESCRIPTION_DETAIL_ID';
  const DESCRIPTION_IDENTIFIER = 'q_information_object.DESCRIPTION_IDENTIFIER';
  const LFT = 'q_information_object.LFT';
  const RGT = 'q_information_object.RGT';
  const CREATED_AT = 'q_information_object.CREATED_AT';
  const UPDATED_AT = 'q_information_object.UPDATED_AT';
  const SOURCE_CULTURE = 'q_information_object.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitInformationObject::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitInformationObject::ID);
    $criteria->addSelectColumn(QubitInformationObject::IDENTIFIER);
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

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
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

  protected $identifier = null;

  public function getIdentifier()
  {
    return $this->identifier;
  }

  public function setIdentifier($identifier)
  {
    $this->identifier = $identifier;

    return $this;
  }

  protected $levelOfDescriptionId = null;

  public function getLevelOfDescriptionId()
  {
    return $this->levelOfDescriptionId;
  }

  public function setLevelOfDescriptionId($levelOfDescriptionId)
  {
    $this->levelOfDescriptionId = $levelOfDescriptionId;

    return $this;
  }

  protected $collectionTypeId = null;

  public function getCollectionTypeId()
  {
    return $this->collectionTypeId;
  }

  public function setCollectionTypeId($collectionTypeId)
  {
    $this->collectionTypeId = $collectionTypeId;

    return $this;
  }

  protected $repositoryId = null;

  public function getRepositoryId()
  {
    return $this->repositoryId;
  }

  public function setRepositoryId($repositoryId)
  {
    $this->repositoryId = $repositoryId;

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

  protected $descriptionStatusId = null;

  public function getDescriptionStatusId()
  {
    return $this->descriptionStatusId;
  }

  public function setDescriptionStatusId($descriptionStatusId)
  {
    $this->descriptionStatusId = $descriptionStatusId;

    return $this;
  }

  protected $descriptionDetailId = null;

  public function getDescriptionDetailId()
  {
    return $this->descriptionDetailId;
  }

  public function setDescriptionDetailId($descriptionDetailId)
  {
    $this->descriptionDetailId = $descriptionDetailId;

    return $this;
  }

  protected $descriptionIdentifier = null;

  public function getDescriptionIdentifier()
  {
    return $this->descriptionIdentifier;
  }

  public function setDescriptionIdentifier($descriptionIdentifier)
  {
    $this->descriptionIdentifier = $descriptionIdentifier;

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

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['identifier'] = $this->identifier;
    $this->columnValues['levelOfDescriptionId'] = $this->levelOfDescriptionId;
    $this->columnValues['collectionTypeId'] = $this->collectionTypeId;
    $this->columnValues['repositoryId'] = $this->repositoryId;
    $this->columnValues['parentId'] = $this->parentId;
    $this->columnValues['descriptionStatusId'] = $this->descriptionStatusId;
    $this->columnValues['descriptionDetailId'] = $this->descriptionDetailId;
    $this->columnValues['descriptionIdentifier'] = $this->descriptionIdentifier;
    $this->columnValues['lft'] = $this->lft;
    $this->columnValues['rgt'] = $this->rgt;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->identifier = $results->getString($columnOffset++);
    $this->levelOfDescriptionId = $results->getInt($columnOffset++);
    $this->collectionTypeId = $results->getInt($columnOffset++);
    $this->repositoryId = $results->getInt($columnOffset++);
    $this->parentId = $results->getInt($columnOffset++);
    $this->descriptionStatusId = $results->getInt($columnOffset++);
    $this->descriptionDetailId = $results->getInt($columnOffset++);
    $this->descriptionIdentifier = $results->getString($columnOffset++);
    $this->lft = $results->getInt($columnOffset++);
    $this->rgt = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
    $this->sourceCulture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitInformationObject::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitInformationObject::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->informationObjectI18ns as $informationObjectI18n)
    {
      $informationObjectI18n->setId($this->id);

      $affectedRows += $informationObjectI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $this->updateNestedSet($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitInformationObject::ID, $this->id);
    }

    if ($this->isColumnModified('identifier'))
    {
      $criteria->add(QubitInformationObject::IDENTIFIER, $this->identifier);
    }

    if ($this->isColumnModified('levelOfDescriptionId'))
    {
      $criteria->add(QubitInformationObject::LEVEL_OF_DESCRIPTION_ID, $this->levelOfDescriptionId);
    }

    if ($this->isColumnModified('collectionTypeId'))
    {
      $criteria->add(QubitInformationObject::COLLECTION_TYPE_ID, $this->collectionTypeId);
    }

    if ($this->isColumnModified('repositoryId'))
    {
      $criteria->add(QubitInformationObject::REPOSITORY_ID, $this->repositoryId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitInformationObject::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('descriptionStatusId'))
    {
      $criteria->add(QubitInformationObject::DESCRIPTION_STATUS_ID, $this->descriptionStatusId);
    }

    if ($this->isColumnModified('descriptionDetailId'))
    {
      $criteria->add(QubitInformationObject::DESCRIPTION_DETAIL_ID, $this->descriptionDetailId);
    }

    if ($this->isColumnModified('descriptionIdentifier'))
    {
      $criteria->add(QubitInformationObject::DESCRIPTION_IDENTIFIER, $this->descriptionIdentifier);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitInformationObject::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitInformationObject::RGT, $this->rgt);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitInformationObject::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitInformationObject::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitInformationObject::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitInformationObject::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::update($connection);

    if ($this->isColumnModified('parentId'))
    {
      $this->updateNestedSet($connection);
    }

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitInformationObject::ID, $this->id);
    }

    if ($this->isColumnModified('identifier'))
    {
      $criteria->add(QubitInformationObject::IDENTIFIER, $this->identifier);
    }

    if ($this->isColumnModified('levelOfDescriptionId'))
    {
      $criteria->add(QubitInformationObject::LEVEL_OF_DESCRIPTION_ID, $this->levelOfDescriptionId);
    }

    if ($this->isColumnModified('collectionTypeId'))
    {
      $criteria->add(QubitInformationObject::COLLECTION_TYPE_ID, $this->collectionTypeId);
    }

    if ($this->isColumnModified('repositoryId'))
    {
      $criteria->add(QubitInformationObject::REPOSITORY_ID, $this->repositoryId);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitInformationObject::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('descriptionStatusId'))
    {
      $criteria->add(QubitInformationObject::DESCRIPTION_STATUS_ID, $this->descriptionStatusId);
    }

    if ($this->isColumnModified('descriptionDetailId'))
    {
      $criteria->add(QubitInformationObject::DESCRIPTION_DETAIL_ID, $this->descriptionDetailId);
    }

    if ($this->isColumnModified('descriptionIdentifier'))
    {
      $criteria->add(QubitInformationObject::DESCRIPTION_IDENTIFIER, $this->descriptionIdentifier);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitInformationObject::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitInformationObject::RGT, $this->rgt);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitInformationObject::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitInformationObject::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitInformationObject::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitInformationObject::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitInformationObject::DATABASE_NAME);
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

    $this->refresh(array('connection' => $connection));
    $this->deleteFromNestedSet($connection);

    $affectedRows += parent::delete($connection);

    return $affectedRows;
  }

  public static function addJoinLevelOfDescriptionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::LEVEL_OF_DESCRIPTION_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getLevelOfDescription(array $options = array())
  {
    return $this->levelOfDescription = QubitTerm::getById($this->levelOfDescriptionId, $options);
  }

  public function setLevelOfDescription(QubitTerm $term)
  {
    $this->levelOfDescriptionId = $term->getId();

    return $this;
  }

  public static function addJoinCollectionTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::COLLECTION_TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getCollectionType(array $options = array())
  {
    return $this->collectionType = QubitTerm::getById($this->collectionTypeId, $options);
  }

  public function setCollectionType(QubitTerm $term)
  {
    $this->collectionTypeId = $term->getId();

    return $this;
  }

  public static function addJoinRepositoryCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::REPOSITORY_ID, QubitRepository::ID);

    return $criteria;
  }

  public function getRepository(array $options = array())
  {
    return $this->repository = QubitRepository::getById($this->repositoryId, $options);
  }

  public function setRepository(QubitRepository $repository)
  {
    $this->repositoryId = $repository->getId();

    return $this;
  }

  public static function addJoinParentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::PARENT_ID, QubitInformationObject::ID);

    return $criteria;
  }

  public function getParent(array $options = array())
  {
    return $this->parent = QubitInformationObject::getById($this->parentId, $options);
  }

  public function setParent(QubitInformationObject $informationObject)
  {
    $this->parentId = $informationObject->getId();

    return $this;
  }

  public static function addJoinDescriptionStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::DESCRIPTION_STATUS_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getDescriptionStatus(array $options = array())
  {
    return $this->descriptionStatus = QubitTerm::getById($this->descriptionStatusId, $options);
  }

  public function setDescriptionStatus(QubitTerm $term)
  {
    $this->descriptionStatusId = $term->getId();

    return $this;
  }

  public static function addJoinDescriptionDetailCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObject::DESCRIPTION_DETAIL_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getDescriptionDetail(array $options = array())
  {
    return $this->descriptionDetail = QubitTerm::getById($this->descriptionDetailId, $options);
  }

  public function setDescriptionDetail(QubitTerm $term)
  {
    $this->descriptionDetailId = $term->getId();

    return $this;
  }

  public static function addInformationObjectsRelatedByParentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::PARENT_ID, $id);

    return $criteria;
  }

  public static function getInformationObjectsRelatedByParentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addInformationObjectsRelatedByParentIdCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addInformationObjectsRelatedByParentIdCriteria(Criteria $criteria)
  {
    return self::addInformationObjectsRelatedByParentIdCriteriaById($criteria, $this->id);
  }

  protected $informationObjectsRelatedByParentId = null;

  public function getInformationObjectsRelatedByParentId(array $options = array())
  {
    if (!isset($this->informationObjectsRelatedByParentId))
    {
      if (!isset($this->id))
      {
        $this->informationObjectsRelatedByParentId = QubitQuery::create();
      }
      else
      {
        $this->informationObjectsRelatedByParentId = self::getInformationObjectsRelatedByParentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectsRelatedByParentId;
  }

  public static function addInformationObjectI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObjectI18n::ID, $id);

    return $criteria;
  }

  public static function getInformationObjectI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addInformationObjectI18nsCriteriaById($criteria, $id);

    return QubitInformationObjectI18n::get($criteria, $options);
  }

  public function addInformationObjectI18nsCriteria(Criteria $criteria)
  {
    return self::addInformationObjectI18nsCriteriaById($criteria, $this->id);
  }

  protected $informationObjectI18ns = null;

  public function getInformationObjectI18ns(array $options = array())
  {
    if (!isset($this->informationObjectI18ns))
    {
      if (!isset($this->id))
      {
        $this->informationObjectI18ns = QubitQuery::create();
      }
      else
      {
        $this->informationObjectI18ns = self::getInformationObjectI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjectI18ns;
  }

  public static function addDigitalObjectsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitDigitalObject::INFORMATION_OBJECT_ID, $id);

    return $criteria;
  }

  public static function getDigitalObjectsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addDigitalObjectsCriteriaById($criteria, $id);

    return QubitDigitalObject::get($criteria, $options);
  }

  public function addDigitalObjectsCriteria(Criteria $criteria)
  {
    return self::addDigitalObjectsCriteriaById($criteria, $this->id);
  }

  protected $digitalObjects = null;

  public function getDigitalObjects(array $options = array())
  {
    if (!isset($this->digitalObjects))
    {
      if (!isset($this->id))
      {
        $this->digitalObjects = QubitQuery::create();
      }
      else
      {
        $this->digitalObjects = self::getDigitalObjectsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->digitalObjects;
  }

  public static function addEventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEvent::INFORMATION_OBJECT_ID, $id);

    return $criteria;
  }

  public static function getEventsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addEventsCriteriaById($criteria, $id);

    return QubitEvent::get($criteria, $options);
  }

  public function addEventsCriteria(Criteria $criteria)
  {
    return self::addEventsCriteriaById($criteria, $this->id);
  }

  protected $events = null;

  public function getEvents(array $options = array())
  {
    if (!isset($this->events))
    {
      if (!isset($this->id))
      {
        $this->events = QubitQuery::create();
      }
      else
      {
        $this->events = self::getEventsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->events;
  }

  public function getTitle(array $options = array())
  {
    $title = $this->getCurrentInformationObjectI18n($options)->getTitle();
    if (!empty($options['cultureFallback']) && strlen($title) < 1)
    {
      $title = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getTitle();
    }

    return $title;
  }

  public function setTitle($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setTitle($value);

    return $this;
  }

  public function getAlternateTitle(array $options = array())
  {
    $alternateTitle = $this->getCurrentInformationObjectI18n($options)->getAlternateTitle();
    if (!empty($options['cultureFallback']) && strlen($alternateTitle) < 1)
    {
      $alternateTitle = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getAlternateTitle();
    }

    return $alternateTitle;
  }

  public function setAlternateTitle($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setAlternateTitle($value);

    return $this;
  }

  public function getVersion(array $options = array())
  {
    $version = $this->getCurrentInformationObjectI18n($options)->getVersion();
    if (!empty($options['cultureFallback']) && strlen($version) < 1)
    {
      $version = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getVersion();
    }

    return $version;
  }

  public function setVersion($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setVersion($value);

    return $this;
  }

  public function getExtentAndMedium(array $options = array())
  {
    $extentAndMedium = $this->getCurrentInformationObjectI18n($options)->getExtentAndMedium();
    if (!empty($options['cultureFallback']) && strlen($extentAndMedium) < 1)
    {
      $extentAndMedium = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getExtentAndMedium();
    }

    return $extentAndMedium;
  }

  public function setExtentAndMedium($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setExtentAndMedium($value);

    return $this;
  }

  public function getArchivalHistory(array $options = array())
  {
    $archivalHistory = $this->getCurrentInformationObjectI18n($options)->getArchivalHistory();
    if (!empty($options['cultureFallback']) && strlen($archivalHistory) < 1)
    {
      $archivalHistory = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getArchivalHistory();
    }

    return $archivalHistory;
  }

  public function setArchivalHistory($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setArchivalHistory($value);

    return $this;
  }

  public function getAcquisition(array $options = array())
  {
    $acquisition = $this->getCurrentInformationObjectI18n($options)->getAcquisition();
    if (!empty($options['cultureFallback']) && strlen($acquisition) < 1)
    {
      $acquisition = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getAcquisition();
    }

    return $acquisition;
  }

  public function setAcquisition($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setAcquisition($value);

    return $this;
  }

  public function getScopeAndContent(array $options = array())
  {
    $scopeAndContent = $this->getCurrentInformationObjectI18n($options)->getScopeAndContent();
    if (!empty($options['cultureFallback']) && strlen($scopeAndContent) < 1)
    {
      $scopeAndContent = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getScopeAndContent();
    }

    return $scopeAndContent;
  }

  public function setScopeAndContent($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setScopeAndContent($value);

    return $this;
  }

  public function getAppraisal(array $options = array())
  {
    $appraisal = $this->getCurrentInformationObjectI18n($options)->getAppraisal();
    if (!empty($options['cultureFallback']) && strlen($appraisal) < 1)
    {
      $appraisal = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getAppraisal();
    }

    return $appraisal;
  }

  public function setAppraisal($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setAppraisal($value);

    return $this;
  }

  public function getAccruals(array $options = array())
  {
    $accruals = $this->getCurrentInformationObjectI18n($options)->getAccruals();
    if (!empty($options['cultureFallback']) && strlen($accruals) < 1)
    {
      $accruals = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getAccruals();
    }

    return $accruals;
  }

  public function setAccruals($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setAccruals($value);

    return $this;
  }

  public function getArrangement(array $options = array())
  {
    $arrangement = $this->getCurrentInformationObjectI18n($options)->getArrangement();
    if (!empty($options['cultureFallback']) && strlen($arrangement) < 1)
    {
      $arrangement = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getArrangement();
    }

    return $arrangement;
  }

  public function setArrangement($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setArrangement($value);

    return $this;
  }

  public function getAccessConditions(array $options = array())
  {
    $accessConditions = $this->getCurrentInformationObjectI18n($options)->getAccessConditions();
    if (!empty($options['cultureFallback']) && strlen($accessConditions) < 1)
    {
      $accessConditions = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getAccessConditions();
    }

    return $accessConditions;
  }

  public function setAccessConditions($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setAccessConditions($value);

    return $this;
  }

  public function getReproductionConditions(array $options = array())
  {
    $reproductionConditions = $this->getCurrentInformationObjectI18n($options)->getReproductionConditions();
    if (!empty($options['cultureFallback']) && strlen($reproductionConditions) < 1)
    {
      $reproductionConditions = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getReproductionConditions();
    }

    return $reproductionConditions;
  }

  public function setReproductionConditions($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setReproductionConditions($value);

    return $this;
  }

  public function getPhysicalCharacteristics(array $options = array())
  {
    $physicalCharacteristics = $this->getCurrentInformationObjectI18n($options)->getPhysicalCharacteristics();
    if (!empty($options['cultureFallback']) && strlen($physicalCharacteristics) < 1)
    {
      $physicalCharacteristics = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getPhysicalCharacteristics();
    }

    return $physicalCharacteristics;
  }

  public function setPhysicalCharacteristics($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setPhysicalCharacteristics($value);

    return $this;
  }

  public function getFindingAids(array $options = array())
  {
    $findingAids = $this->getCurrentInformationObjectI18n($options)->getFindingAids();
    if (!empty($options['cultureFallback']) && strlen($findingAids) < 1)
    {
      $findingAids = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getFindingAids();
    }

    return $findingAids;
  }

  public function setFindingAids($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setFindingAids($value);

    return $this;
  }

  public function getLocationOfOriginals(array $options = array())
  {
    $locationOfOriginals = $this->getCurrentInformationObjectI18n($options)->getLocationOfOriginals();
    if (!empty($options['cultureFallback']) && strlen($locationOfOriginals) < 1)
    {
      $locationOfOriginals = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getLocationOfOriginals();
    }

    return $locationOfOriginals;
  }

  public function setLocationOfOriginals($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setLocationOfOriginals($value);

    return $this;
  }

  public function getLocationOfCopies(array $options = array())
  {
    $locationOfCopies = $this->getCurrentInformationObjectI18n($options)->getLocationOfCopies();
    if (!empty($options['cultureFallback']) && strlen($locationOfCopies) < 1)
    {
      $locationOfCopies = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getLocationOfCopies();
    }

    return $locationOfCopies;
  }

  public function setLocationOfCopies($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setLocationOfCopies($value);

    return $this;
  }

  public function getRelatedUnitsOfDescription(array $options = array())
  {
    $relatedUnitsOfDescription = $this->getCurrentInformationObjectI18n($options)->getRelatedUnitsOfDescription();
    if (!empty($options['cultureFallback']) && strlen($relatedUnitsOfDescription) < 1)
    {
      $relatedUnitsOfDescription = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getRelatedUnitsOfDescription();
    }

    return $relatedUnitsOfDescription;
  }

  public function setRelatedUnitsOfDescription($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setRelatedUnitsOfDescription($value);

    return $this;
  }

  public function getInstitutionResponsibleIdentifier(array $options = array())
  {
    $institutionResponsibleIdentifier = $this->getCurrentInformationObjectI18n($options)->getInstitutionResponsibleIdentifier();
    if (!empty($options['cultureFallback']) && strlen($institutionResponsibleIdentifier) < 1)
    {
      $institutionResponsibleIdentifier = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getInstitutionResponsibleIdentifier();
    }

    return $institutionResponsibleIdentifier;
  }

  public function setInstitutionResponsibleIdentifier($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setInstitutionResponsibleIdentifier($value);

    return $this;
  }

  public function getRules(array $options = array())
  {
    $rules = $this->getCurrentInformationObjectI18n($options)->getRules();
    if (!empty($options['cultureFallback']) && strlen($rules) < 1)
    {
      $rules = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getRules();
    }

    return $rules;
  }

  public function setRules($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setRules($value);

    return $this;
  }

  public function getSources(array $options = array())
  {
    $sources = $this->getCurrentInformationObjectI18n($options)->getSources();
    if (!empty($options['cultureFallback']) && strlen($sources) < 1)
    {
      $sources = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getSources();
    }

    return $sources;
  }

  public function setSources($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setSources($value);

    return $this;
  }

  public function getRevisionHistory(array $options = array())
  {
    $revisionHistory = $this->getCurrentInformationObjectI18n($options)->getRevisionHistory();
    if (!empty($options['cultureFallback']) && strlen($revisionHistory) < 1)
    {
      $revisionHistory = $this->getCurrentInformationObjectI18n(array('sourceCulture' => true) + $options)->getRevisionHistory();
    }

    return $revisionHistory;
  }

  public function setRevisionHistory($value, array $options = array())
  {
    $this->getCurrentInformationObjectI18n($options)->setRevisionHistory($value);

    return $this;
  }

  public function getCurrentInformationObjectI18n(array $options = array())
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
      if (null === $informationObjectI18n = QubitInformationObjectI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $informationObjectI18n = new QubitInformationObjectI18n;
        $informationObjectI18n->setCulture($options['culture']);
      }
      $this->informationObjectI18ns[$options['culture']] = $informationObjectI18n;
    }

    return $this->informationObjectI18ns[$options['culture']];
  }

  public function addAncestorsCriteria(Criteria $criteria)
  {
    return $criteria->add(QubitInformationObject::LFT, $this->lft, Criteria::LESS_THAN)->add(QubitInformationObject::RGT, $this->rgt, Criteria::GREATER_THAN);
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
    return $criteria->add(QubitInformationObject::LFT, $this->lft, Criteria::GREATER_THAN)->add(QubitInformationObject::RGT, $this->rgt, Criteria::LESS_THAN);
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
      $connection = QubitTransactionFilter::getConnection(QubitInformationObject::DATABASE_NAME);
    }

    if (null === $parent = $this->getParent(array('connection' => $connection)))
    {
      $stmt = $connection->prepareStatement('
        SELECT MAX('.QubitInformationObject::RGT.')
        FROM '.QubitInformationObject::TABLE_NAME);
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
        UPDATE '.QubitInformationObject::TABLE_NAME.'
        SET '.QubitInformationObject::LFT.' = '.QubitInformationObject::LFT.' + ?
        WHERE '.QubitInformationObject::LFT.' >= ?');
      $stmt->setInt(1, $delta);
      $stmt->setInt(2, $parent->rgt);
      $stmt->executeUpdate();

      $stmt = $connection->prepareStatement('
        UPDATE '.QubitInformationObject::TABLE_NAME.'
        SET '.QubitInformationObject::RGT.' = '.QubitInformationObject::RGT.' + ?
        WHERE '.QubitInformationObject::RGT.' >= ?');
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
      UPDATE '.QubitInformationObject::TABLE_NAME.'
      SET '.QubitInformationObject::LFT.' = '.QubitInformationObject::LFT.' + ?, '.QubitInformationObject::RGT.' = '.QubitInformationObject::RGT.' + ?
      WHERE '.QubitInformationObject::LFT.' >= ?
      AND '.QubitInformationObject::RGT.' <= ?');
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
      $connection = QubitTransactionFilter::getConnection(QubitInformationObject::DATABASE_NAME);
    }

    $delta = $this->rgt - $this->lft + 1;

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitInformationObject::TABLE_NAME.'
      SET '.QubitInformationObject::LFT.' = '.QubitInformationObject::LFT.' - ?
      WHERE '.QubitInformationObject::LFT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    $stmt = $connection->prepareStatement('
      UPDATE '.QubitInformationObject::TABLE_NAME.'
      SET '.QubitInformationObject::RGT.' = '.QubitInformationObject::RGT.' - ?
      WHERE '.QubitInformationObject::RGT.' >= ?');
    $stmt->setInt(1, $delta);
    $stmt->setInt(2, $this->rgt);
    $stmt->executeUpdate();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.InformationObjectMapBuilder');
