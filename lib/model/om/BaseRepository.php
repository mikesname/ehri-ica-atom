<?php

abstract class BaseRepository extends QubitActor
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_repository';

  const ID = 'q_repository.ID';
  const IDENTIFIER = 'q_repository.IDENTIFIER';
  const TYPE_ID = 'q_repository.TYPE_ID';
  const DESC_STATUS_ID = 'q_repository.DESC_STATUS_ID';
  const DESC_DETAIL_ID = 'q_repository.DESC_DETAIL_ID';
  const DESC_IDENTIFIER = 'q_repository.DESC_IDENTIFIER';
  const SOURCE_CULTURE = 'q_repository.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitRepository::ID, QubitActor::ID);

    $criteria->addSelectColumn(QubitRepository::ID);
    $criteria->addSelectColumn(QubitRepository::IDENTIFIER);
    $criteria->addSelectColumn(QubitRepository::TYPE_ID);
    $criteria->addSelectColumn(QubitRepository::DESC_STATUS_ID);
    $criteria->addSelectColumn(QubitRepository::DESC_DETAIL_ID);
    $criteria->addSelectColumn(QubitRepository::DESC_IDENTIFIER);
    $criteria->addSelectColumn(QubitRepository::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRepository::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRepository', $options);
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
    $criteria->add(QubitRepository::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
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

  protected $descStatusId = null;

  public function getDescStatusId()
  {
    return $this->descStatusId;
  }

  public function setDescStatusId($descStatusId)
  {
    $this->descStatusId = $descStatusId;

    return $this;
  }

  protected $descDetailId = null;

  public function getDescDetailId()
  {
    return $this->descDetailId;
  }

  public function setDescDetailId($descDetailId)
  {
    $this->descDetailId = $descDetailId;

    return $this;
  }

  protected $descIdentifier = null;

  public function getDescIdentifier()
  {
    return $this->descIdentifier;
  }

  public function setDescIdentifier($descIdentifier)
  {
    $this->descIdentifier = $descIdentifier;

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
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['descStatusId'] = $this->descStatusId;
    $this->columnValues['descDetailId'] = $this->descDetailId;
    $this->columnValues['descIdentifier'] = $this->descIdentifier;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->identifier = $results->getString($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->descStatusId = $results->getInt($columnOffset++);
    $this->descDetailId = $results->getInt($columnOffset++);
    $this->descIdentifier = $results->getString($columnOffset++);
    $this->sourceCulture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRepository::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRepository::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->repositoryI18ns as $repositoryI18n)
    {
      $repositoryI18n->setId($this->id);

      $affectedRows += $repositoryI18n->save($connection);
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
      $criteria->add(QubitRepository::ID, $this->id);
    }

    if ($this->isColumnModified('identifier'))
    {
      $criteria->add(QubitRepository::IDENTIFIER, $this->identifier);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitRepository::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('descStatusId'))
    {
      $criteria->add(QubitRepository::DESC_STATUS_ID, $this->descStatusId);
    }

    if ($this->isColumnModified('descDetailId'))
    {
      $criteria->add(QubitRepository::DESC_DETAIL_ID, $this->descDetailId);
    }

    if ($this->isColumnModified('descIdentifier'))
    {
      $criteria->add(QubitRepository::DESC_IDENTIFIER, $this->descIdentifier);
    }

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitRepository::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRepository::DATABASE_NAME);
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
      $criteria->add(QubitRepository::ID, $this->id);
    }

    if ($this->isColumnModified('identifier'))
    {
      $criteria->add(QubitRepository::IDENTIFIER, $this->identifier);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitRepository::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('descStatusId'))
    {
      $criteria->add(QubitRepository::DESC_STATUS_ID, $this->descStatusId);
    }

    if ($this->isColumnModified('descDetailId'))
    {
      $criteria->add(QubitRepository::DESC_DETAIL_ID, $this->descDetailId);
    }

    if ($this->isColumnModified('descIdentifier'))
    {
      $criteria->add(QubitRepository::DESC_IDENTIFIER, $this->descIdentifier);
    }

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitRepository::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitRepository::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitRepository::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRepository::TYPE_ID, QubitTerm::ID);

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

  public static function addJoinDescStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRepository::DESC_STATUS_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getDescStatus(array $options = array())
  {
    return $this->descStatus = QubitTerm::getById($this->descStatusId, $options);
  }

  public function setDescStatus(QubitTerm $term)
  {
    $this->descStatusId = $term->getId();

    return $this;
  }

  public static function addJoinDescDetailCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRepository::DESC_DETAIL_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getDescDetail(array $options = array())
  {
    return $this->descDetail = QubitTerm::getById($this->descDetailId, $options);
  }

  public function setDescDetail(QubitTerm $term)
  {
    $this->descDetailId = $term->getId();

    return $this;
  }

  public static function addInformationObjectsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::REPOSITORY_ID, $id);

    return $criteria;
  }

  public static function getInformationObjectsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addInformationObjectsCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addInformationObjectsCriteria(Criteria $criteria)
  {
    return self::addInformationObjectsCriteriaById($criteria, $this->id);
  }

  protected $informationObjects = null;

  public function getInformationObjects(array $options = array())
  {
    if (!isset($this->informationObjects))
    {
      if (!isset($this->id))
      {
        $this->informationObjects = QubitQuery::create();
      }
      else
      {
        $this->informationObjects = self::getInformationObjectsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjects;
  }

  public static function addRepositoryI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepositoryI18n::ID, $id);

    return $criteria;
  }

  public static function getRepositoryI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRepositoryI18nsCriteriaById($criteria, $id);

    return QubitRepositoryI18n::get($criteria, $options);
  }

  public function addRepositoryI18nsCriteria(Criteria $criteria)
  {
    return self::addRepositoryI18nsCriteriaById($criteria, $this->id);
  }

  protected $repositoryI18ns = null;

  public function getRepositoryI18ns(array $options = array())
  {
    if (!isset($this->repositoryI18ns))
    {
      if (!isset($this->id))
      {
        $this->repositoryI18ns = QubitQuery::create();
      }
      else
      {
        $this->repositoryI18ns = self::getRepositoryI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositoryI18ns;
  }

  public function getGeoculturalContext(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getGeoculturalContext();
  }

  public function setGeoculturalContext($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setGeoculturalContext($value);

    return $this;
  }

  public function getCollectingPolicies(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getCollectingPolicies();
  }

  public function setCollectingPolicies($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setCollectingPolicies($value);

    return $this;
  }

  public function getBuildings(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getBuildings();
  }

  public function setBuildings($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setBuildings($value);

    return $this;
  }

  public function getHoldings(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getHoldings();
  }

  public function setHoldings($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setHoldings($value);

    return $this;
  }

  public function getFindingAids(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getFindingAids();
  }

  public function setFindingAids($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setFindingAids($value);

    return $this;
  }

  public function getOpeningTimes(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getOpeningTimes();
  }

  public function setOpeningTimes($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setOpeningTimes($value);

    return $this;
  }

  public function getAccessConditions(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getAccessConditions();
  }

  public function setAccessConditions($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setAccessConditions($value);

    return $this;
  }

  public function getDisabledAccess(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getDisabledAccess();
  }

  public function setDisabledAccess($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDisabledAccess($value);

    return $this;
  }

  public function getResearchServices(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getResearchServices();
  }

  public function setResearchServices($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setResearchServices($value);

    return $this;
  }

  public function getReproductionServices(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getReproductionServices();
  }

  public function setReproductionServices($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setReproductionServices($value);

    return $this;
  }

  public function getPublicFacilities(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getPublicFacilities();
  }

  public function setPublicFacilities($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setPublicFacilities($value);

    return $this;
  }

  public function getDescInstitutionIdentifier(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getDescInstitutionIdentifier();
  }

  public function setDescInstitutionIdentifier($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDescInstitutionIdentifier($value);

    return $this;
  }

  public function getDescRules(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getDescRules();
  }

  public function setDescRules($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDescRules($value);

    return $this;
  }

  public function getDescSources(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getDescSources();
  }

  public function setDescSources($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDescSources($value);

    return $this;
  }

  public function getDescRevisionHistory(array $options = array())
  {
    return $this->getCurrentRepositoryI18n($options)->getDescRevisionHistory();
  }

  public function setDescRevisionHistory($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDescRevisionHistory($value);

    return $this;
  }

  public function getCurrentRepositoryI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->repositoryI18ns[$options['culture']]))
    {
      if (null === $repositoryI18n = QubitRepositoryI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $repositoryI18n = new QubitRepositoryI18n;
        $repositoryI18n->setCulture($options['culture']);
      }
      $this->repositoryI18ns[$options['culture']] = $repositoryI18n;
    }

    return $this->repositoryI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.RepositoryMapBuilder');
