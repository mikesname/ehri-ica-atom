<?php

abstract class BaseActor extends QubitObject
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_actor';

  const ID = 'q_actor.ID';
  const CORPORATE_BODY_IDENTIFIERS = 'q_actor.CORPORATE_BODY_IDENTIFIERS';
  const ENTITY_TYPE_ID = 'q_actor.ENTITY_TYPE_ID';
  const DESCRIPTION_STATUS_ID = 'q_actor.DESCRIPTION_STATUS_ID';
  const DESCRIPTION_DETAIL_ID = 'q_actor.DESCRIPTION_DETAIL_ID';
  const DESCRIPTION_IDENTIFIER = 'q_actor.DESCRIPTION_IDENTIFIER';
  const PARENT_ID = 'q_actor.PARENT_ID';
  const LFT = 'q_actor.LFT';
  const RGT = 'q_actor.RGT';
  const CREATED_AT = 'q_actor.CREATED_AT';
  const UPDATED_AT = 'q_actor.UPDATED_AT';
  const SOURCE_CULTURE = 'q_actor.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitActor::ID, QubitObject::ID);

    $criteria->addSelectColumn(QubitActor::ID);
    $criteria->addSelectColumn(QubitActor::CORPORATE_BODY_IDENTIFIERS);
    $criteria->addSelectColumn(QubitActor::ENTITY_TYPE_ID);
    $criteria->addSelectColumn(QubitActor::DESCRIPTION_STATUS_ID);
    $criteria->addSelectColumn(QubitActor::DESCRIPTION_DETAIL_ID);
    $criteria->addSelectColumn(QubitActor::DESCRIPTION_IDENTIFIER);
    $criteria->addSelectColumn(QubitActor::PARENT_ID);
    $criteria->addSelectColumn(QubitActor::LFT);
    $criteria->addSelectColumn(QubitActor::RGT);
    $criteria->addSelectColumn(QubitActor::CREATED_AT);
    $criteria->addSelectColumn(QubitActor::UPDATED_AT);
    $criteria->addSelectColumn(QubitActor::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitActor::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitActor', $options);
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
    $criteria->add(QubitActor::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  protected $corporateBodyIdentifiers = null;

  public function getCorporateBodyIdentifiers()
  {
    return $this->corporateBodyIdentifiers;
  }

  public function setCorporateBodyIdentifiers($corporateBodyIdentifiers)
  {
    $this->corporateBodyIdentifiers = $corporateBodyIdentifiers;

    return $this;
  }

  protected $entityTypeId = null;

  public function getEntityTypeId()
  {
    return $this->entityTypeId;
  }

  public function setEntityTypeId($entityTypeId)
  {
    $this->entityTypeId = $entityTypeId;

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

  public function setLft($lft)
  {
    $this->lft = $lft;

    return $this;
  }

  protected $rgt = null;

  public function getRgt()
  {
    return $this->rgt;
  }

  public function setRgt($rgt)
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
    $this->columnValues['corporateBodyIdentifiers'] = $this->corporateBodyIdentifiers;
    $this->columnValues['entityTypeId'] = $this->entityTypeId;
    $this->columnValues['descriptionStatusId'] = $this->descriptionStatusId;
    $this->columnValues['descriptionDetailId'] = $this->descriptionDetailId;
    $this->columnValues['descriptionIdentifier'] = $this->descriptionIdentifier;
    $this->columnValues['parentId'] = $this->parentId;
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
    $this->corporateBodyIdentifiers = $results->getString($columnOffset++);
    $this->entityTypeId = $results->getInt($columnOffset++);
    $this->descriptionStatusId = $results->getInt($columnOffset++);
    $this->descriptionDetailId = $results->getInt($columnOffset++);
    $this->descriptionIdentifier = $results->getString($columnOffset++);
    $this->parentId = $results->getInt($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitActor::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitActor::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->actorI18ns as $actorI18n)
    {
      $actorI18n->setId($this->id);

      $affectedRows += $actorI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActor::ID, $this->id);
    }

    if ($this->isColumnModified('corporateBodyIdentifiers'))
    {
      $criteria->add(QubitActor::CORPORATE_BODY_IDENTIFIERS, $this->corporateBodyIdentifiers);
    }

    if ($this->isColumnModified('entityTypeId'))
    {
      $criteria->add(QubitActor::ENTITY_TYPE_ID, $this->entityTypeId);
    }

    if ($this->isColumnModified('descriptionStatusId'))
    {
      $criteria->add(QubitActor::DESCRIPTION_STATUS_ID, $this->descriptionStatusId);
    }

    if ($this->isColumnModified('descriptionDetailId'))
    {
      $criteria->add(QubitActor::DESCRIPTION_DETAIL_ID, $this->descriptionDetailId);
    }

    if ($this->isColumnModified('descriptionIdentifier'))
    {
      $criteria->add(QubitActor::DESCRIPTION_IDENTIFIER, $this->descriptionIdentifier);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitActor::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitActor::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitActor::RGT, $this->rgt);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitActor::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitActor::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitActor::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitActor::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::update($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActor::ID, $this->id);
    }

    if ($this->isColumnModified('corporateBodyIdentifiers'))
    {
      $criteria->add(QubitActor::CORPORATE_BODY_IDENTIFIERS, $this->corporateBodyIdentifiers);
    }

    if ($this->isColumnModified('entityTypeId'))
    {
      $criteria->add(QubitActor::ENTITY_TYPE_ID, $this->entityTypeId);
    }

    if ($this->isColumnModified('descriptionStatusId'))
    {
      $criteria->add(QubitActor::DESCRIPTION_STATUS_ID, $this->descriptionStatusId);
    }

    if ($this->isColumnModified('descriptionDetailId'))
    {
      $criteria->add(QubitActor::DESCRIPTION_DETAIL_ID, $this->descriptionDetailId);
    }

    if ($this->isColumnModified('descriptionIdentifier'))
    {
      $criteria->add(QubitActor::DESCRIPTION_IDENTIFIER, $this->descriptionIdentifier);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitActor::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitActor::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitActor::RGT, $this->rgt);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitActor::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitActor::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitActor::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitActor::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitActor::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinEntityTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActor::ENTITY_TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getEntityType(array $options = array())
  {
    return $this->entityType = QubitTerm::getById($this->entityTypeId, $options);
  }

  public function setEntityType(QubitTerm $term)
  {
    $this->entityTypeId = $term->getId();

    return $this;
  }

  public static function addJoinDescriptionStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActor::DESCRIPTION_STATUS_ID, QubitTerm::ID);

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
    $criteria->addJoin(QubitActor::DESCRIPTION_DETAIL_ID, QubitTerm::ID);

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

  public static function addJoinParentCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActor::PARENT_ID, QubitActor::ID);

    return $criteria;
  }

  public function getParent(array $options = array())
  {
    return $this->parent = QubitActor::getById($this->parentId, $options);
  }

  public function setParent(QubitActor $actor)
  {
    $this->parentId = $actor->getId();

    return $this;
  }

  public static function addActorsRelatedByParentIdCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActor::PARENT_ID, $id);

    return $criteria;
  }

  public static function getActorsRelatedByParentIdById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorsRelatedByParentIdCriteriaById($criteria, $id);

    return QubitActor::get($criteria, $options);
  }

  public function addActorsRelatedByParentIdCriteria(Criteria $criteria)
  {
    return self::addActorsRelatedByParentIdCriteriaById($criteria, $this->id);
  }

  protected $actorsRelatedByParentId = null;

  public function getActorsRelatedByParentId(array $options = array())
  {
    if (!isset($this->actorsRelatedByParentId))
    {
      if (!isset($this->id))
      {
        $this->actorsRelatedByParentId = QubitQuery::create();
      }
      else
      {
        $this->actorsRelatedByParentId = self::getActorsRelatedByParentIdById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorsRelatedByParentId;
  }

  public static function addActorI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActorI18n::ID, $id);

    return $criteria;
  }

  public static function getActorI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorI18nsCriteriaById($criteria, $id);

    return QubitActorI18n::get($criteria, $options);
  }

  public function addActorI18nsCriteria(Criteria $criteria)
  {
    return self::addActorI18nsCriteriaById($criteria, $this->id);
  }

  protected $actorI18ns = null;

  public function getActorI18ns(array $options = array())
  {
    if (!isset($this->actorI18ns))
    {
      if (!isset($this->id))
      {
        $this->actorI18ns = QubitQuery::create();
      }
      else
      {
        $this->actorI18ns = self::getActorI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorI18ns;
  }

  public static function addActorNamesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitActorName::ACTOR_ID, $id);

    return $criteria;
  }

  public static function getActorNamesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addActorNamesCriteriaById($criteria, $id);

    return QubitActorName::get($criteria, $options);
  }

  public function addActorNamesCriteria(Criteria $criteria)
  {
    return self::addActorNamesCriteriaById($criteria, $this->id);
  }

  protected $actorNames = null;

  public function getActorNames(array $options = array())
  {
    if (!isset($this->actorNames))
    {
      if (!isset($this->id))
      {
        $this->actorNames = QubitQuery::create();
      }
      else
      {
        $this->actorNames = self::getActorNamesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->actorNames;
  }

  public static function addContactInformationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitContactInformation::ACTOR_ID, $id);

    return $criteria;
  }

  public static function getContactInformationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addContactInformationsCriteriaById($criteria, $id);

    return QubitContactInformation::get($criteria, $options);
  }

  public function addContactInformationsCriteria(Criteria $criteria)
  {
    return self::addContactInformationsCriteriaById($criteria, $this->id);
  }

  protected $contactInformations = null;

  public function getContactInformations(array $options = array())
  {
    if (!isset($this->contactInformations))
    {
      if (!isset($this->id))
      {
        $this->contactInformations = QubitQuery::create();
      }
      else
      {
        $this->contactInformations = self::getContactInformationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->contactInformations;
  }

  public static function addEventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitEvent::ACTOR_ID, $id);

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

  public static function addRightsActorRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRightsActorRelation::ACTOR_ID, $id);

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

  public function getAuthorizedFormOfName(array $options = array())
  {
    $authorizedFormOfName = $this->getCurrentActorI18n($options)->getAuthorizedFormOfName();
    if (!empty($options['cultureFallback']) && $authorizedFormOfName === null)
    {
      $authorizedFormOfName = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getAuthorizedFormOfName();
    }

    return $authorizedFormOfName;
  }

  public function setAuthorizedFormOfName($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setAuthorizedFormOfName($value);

    return $this;
  }

  public function getHistory(array $options = array())
  {
    $history = $this->getCurrentActorI18n($options)->getHistory();
    if (!empty($options['cultureFallback']) && $history === null)
    {
      $history = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getHistory();
    }

    return $history;
  }

  public function setHistory($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setHistory($value);

    return $this;
  }

  public function getPlaces(array $options = array())
  {
    $places = $this->getCurrentActorI18n($options)->getPlaces();
    if (!empty($options['cultureFallback']) && $places === null)
    {
      $places = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getPlaces();
    }

    return $places;
  }

  public function setPlaces($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setPlaces($value);

    return $this;
  }

  public function getLegalStatus(array $options = array())
  {
    $legalStatus = $this->getCurrentActorI18n($options)->getLegalStatus();
    if (!empty($options['cultureFallback']) && $legalStatus === null)
    {
      $legalStatus = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getLegalStatus();
    }

    return $legalStatus;
  }

  public function setLegalStatus($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setLegalStatus($value);

    return $this;
  }

  public function getFunctions(array $options = array())
  {
    $functions = $this->getCurrentActorI18n($options)->getFunctions();
    if (!empty($options['cultureFallback']) && $functions === null)
    {
      $functions = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getFunctions();
    }

    return $functions;
  }

  public function setFunctions($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setFunctions($value);

    return $this;
  }

  public function getMandates(array $options = array())
  {
    $mandates = $this->getCurrentActorI18n($options)->getMandates();
    if (!empty($options['cultureFallback']) && $mandates === null)
    {
      $mandates = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getMandates();
    }

    return $mandates;
  }

  public function setMandates($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setMandates($value);

    return $this;
  }

  public function getInternalStructures(array $options = array())
  {
    $internalStructures = $this->getCurrentActorI18n($options)->getInternalStructures();
    if (!empty($options['cultureFallback']) && $internalStructures === null)
    {
      $internalStructures = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getInternalStructures();
    }

    return $internalStructures;
  }

  public function setInternalStructures($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setInternalStructures($value);

    return $this;
  }

  public function getGeneralContext(array $options = array())
  {
    $generalContext = $this->getCurrentActorI18n($options)->getGeneralContext();
    if (!empty($options['cultureFallback']) && $generalContext === null)
    {
      $generalContext = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getGeneralContext();
    }

    return $generalContext;
  }

  public function setGeneralContext($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setGeneralContext($value);

    return $this;
  }

  public function getInstitutionResponsibleIdentifier(array $options = array())
  {
    $institutionResponsibleIdentifier = $this->getCurrentActorI18n($options)->getInstitutionResponsibleIdentifier();
    if (!empty($options['cultureFallback']) && $institutionResponsibleIdentifier === null)
    {
      $institutionResponsibleIdentifier = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getInstitutionResponsibleIdentifier();
    }

    return $institutionResponsibleIdentifier;
  }

  public function setInstitutionResponsibleIdentifier($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setInstitutionResponsibleIdentifier($value);

    return $this;
  }

  public function getRules(array $options = array())
  {
    $rules = $this->getCurrentActorI18n($options)->getRules();
    if (!empty($options['cultureFallback']) && $rules === null)
    {
      $rules = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getRules();
    }

    return $rules;
  }

  public function setRules($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setRules($value);

    return $this;
  }

  public function getSources(array $options = array())
  {
    $sources = $this->getCurrentActorI18n($options)->getSources();
    if (!empty($options['cultureFallback']) && $sources === null)
    {
      $sources = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getSources();
    }

    return $sources;
  }

  public function setSources($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setSources($value);

    return $this;
  }

  public function getRevisionHistory(array $options = array())
  {
    $revisionHistory = $this->getCurrentActorI18n($options)->getRevisionHistory();
    if (!empty($options['cultureFallback']) && $revisionHistory === null)
    {
      $revisionHistory = $this->getCurrentActorI18n(array('sourceCulture' => true) + $options)->getRevisionHistory();
    }

    return $revisionHistory;
  }

  public function setRevisionHistory($value, array $options = array())
  {
    $this->getCurrentActorI18n($options)->setRevisionHistory($value);

    return $this;
  }

  public function getCurrentActorI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->actorI18ns[$options['culture']]))
    {
      if (null === $actorI18n = QubitActorI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $actorI18n = new QubitActorI18n;
        $actorI18n->setCulture($options['culture']);
      }
      $this->actorI18ns[$options['culture']] = $actorI18n;
    }

    return $this->actorI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.ActorMapBuilder');
