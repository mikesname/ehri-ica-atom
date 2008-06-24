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
    $geoculturalContext = $this->getCurrentRepositoryI18n($options)->getGeoculturalContext();
    if (!empty($options['cultureFallback']) && $geoculturalContext === null)
    {
      $geoculturalContext = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getGeoculturalContext();
    }

    return $geoculturalContext;
  }

  public function setGeoculturalContext($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setGeoculturalContext($value);

    return $this;
  }

  public function getCollectingPolicies(array $options = array())
  {
    $collectingPolicies = $this->getCurrentRepositoryI18n($options)->getCollectingPolicies();
    if (!empty($options['cultureFallback']) && $collectingPolicies === null)
    {
      $collectingPolicies = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getCollectingPolicies();
    }

    return $collectingPolicies;
  }

  public function setCollectingPolicies($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setCollectingPolicies($value);

    return $this;
  }

  public function getBuildings(array $options = array())
  {
    $buildings = $this->getCurrentRepositoryI18n($options)->getBuildings();
    if (!empty($options['cultureFallback']) && $buildings === null)
    {
      $buildings = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getBuildings();
    }

    return $buildings;
  }

  public function setBuildings($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setBuildings($value);

    return $this;
  }

  public function getHoldings(array $options = array())
  {
    $holdings = $this->getCurrentRepositoryI18n($options)->getHoldings();
    if (!empty($options['cultureFallback']) && $holdings === null)
    {
      $holdings = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getHoldings();
    }

    return $holdings;
  }

  public function setHoldings($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setHoldings($value);

    return $this;
  }

  public function getFindingAids(array $options = array())
  {
    $findingAids = $this->getCurrentRepositoryI18n($options)->getFindingAids();
    if (!empty($options['cultureFallback']) && $findingAids === null)
    {
      $findingAids = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getFindingAids();
    }

    return $findingAids;
  }

  public function setFindingAids($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setFindingAids($value);

    return $this;
  }

  public function getOpeningTimes(array $options = array())
  {
    $openingTimes = $this->getCurrentRepositoryI18n($options)->getOpeningTimes();
    if (!empty($options['cultureFallback']) && $openingTimes === null)
    {
      $openingTimes = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getOpeningTimes();
    }

    return $openingTimes;
  }

  public function setOpeningTimes($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setOpeningTimes($value);

    return $this;
  }

  public function getAccessConditions(array $options = array())
  {
    $accessConditions = $this->getCurrentRepositoryI18n($options)->getAccessConditions();
    if (!empty($options['cultureFallback']) && $accessConditions === null)
    {
      $accessConditions = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getAccessConditions();
    }

    return $accessConditions;
  }

  public function setAccessConditions($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setAccessConditions($value);

    return $this;
  }

  public function getDisabledAccess(array $options = array())
  {
    $disabledAccess = $this->getCurrentRepositoryI18n($options)->getDisabledAccess();
    if (!empty($options['cultureFallback']) && $disabledAccess === null)
    {
      $disabledAccess = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getDisabledAccess();
    }

    return $disabledAccess;
  }

  public function setDisabledAccess($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDisabledAccess($value);

    return $this;
  }

  public function getResearchServices(array $options = array())
  {
    $researchServices = $this->getCurrentRepositoryI18n($options)->getResearchServices();
    if (!empty($options['cultureFallback']) && $researchServices === null)
    {
      $researchServices = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getResearchServices();
    }

    return $researchServices;
  }

  public function setResearchServices($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setResearchServices($value);

    return $this;
  }

  public function getReproductionServices(array $options = array())
  {
    $reproductionServices = $this->getCurrentRepositoryI18n($options)->getReproductionServices();
    if (!empty($options['cultureFallback']) && $reproductionServices === null)
    {
      $reproductionServices = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getReproductionServices();
    }

    return $reproductionServices;
  }

  public function setReproductionServices($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setReproductionServices($value);

    return $this;
  }

  public function getPublicFacilities(array $options = array())
  {
    $publicFacilities = $this->getCurrentRepositoryI18n($options)->getPublicFacilities();
    if (!empty($options['cultureFallback']) && $publicFacilities === null)
    {
      $publicFacilities = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getPublicFacilities();
    }

    return $publicFacilities;
  }

  public function setPublicFacilities($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setPublicFacilities($value);

    return $this;
  }

  public function getDescInstitutionIdentifier(array $options = array())
  {
    $descInstitutionIdentifier = $this->getCurrentRepositoryI18n($options)->getDescInstitutionIdentifier();
    if (!empty($options['cultureFallback']) && $descInstitutionIdentifier === null)
    {
      $descInstitutionIdentifier = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getDescInstitutionIdentifier();
    }

    return $descInstitutionIdentifier;
  }

  public function setDescInstitutionIdentifier($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDescInstitutionIdentifier($value);

    return $this;
  }

  public function getDescRules(array $options = array())
  {
    $descRules = $this->getCurrentRepositoryI18n($options)->getDescRules();
    if (!empty($options['cultureFallback']) && $descRules === null)
    {
      $descRules = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getDescRules();
    }

    return $descRules;
  }

  public function setDescRules($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDescRules($value);

    return $this;
  }

  public function getDescSources(array $options = array())
  {
    $descSources = $this->getCurrentRepositoryI18n($options)->getDescSources();
    if (!empty($options['cultureFallback']) && $descSources === null)
    {
      $descSources = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getDescSources();
    }

    return $descSources;
  }

  public function setDescSources($value, array $options = array())
  {
    $this->getCurrentRepositoryI18n($options)->setDescSources($value);

    return $this;
  }

  public function getDescRevisionHistory(array $options = array())
  {
    $descRevisionHistory = $this->getCurrentRepositoryI18n($options)->getDescRevisionHistory();
    if (!empty($options['cultureFallback']) && $descRevisionHistory === null)
    {
      $descRevisionHistory = $this->getCurrentRepositoryI18n(array('sourceCulture' => true) + $options)->getDescRevisionHistory();
    }

    return $descRevisionHistory;
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
