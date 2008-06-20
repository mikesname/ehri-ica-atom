<?php

abstract class BaseRepositoryI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_repository_i18n';

  const GEOCULTURAL_CONTEXT = 'q_repository_i18n.GEOCULTURAL_CONTEXT';
  const COLLECTING_POLICIES = 'q_repository_i18n.COLLECTING_POLICIES';
  const BUILDINGS = 'q_repository_i18n.BUILDINGS';
  const HOLDINGS = 'q_repository_i18n.HOLDINGS';
  const FINDING_AIDS = 'q_repository_i18n.FINDING_AIDS';
  const OPENING_TIMES = 'q_repository_i18n.OPENING_TIMES';
  const ACCESS_CONDITIONS = 'q_repository_i18n.ACCESS_CONDITIONS';
  const DISABLED_ACCESS = 'q_repository_i18n.DISABLED_ACCESS';
  const RESEARCH_SERVICES = 'q_repository_i18n.RESEARCH_SERVICES';
  const REPRODUCTION_SERVICES = 'q_repository_i18n.REPRODUCTION_SERVICES';
  const PUBLIC_FACILITIES = 'q_repository_i18n.PUBLIC_FACILITIES';
  const DESC_INSTITUTION_IDENTIFIER = 'q_repository_i18n.DESC_INSTITUTION_IDENTIFIER';
  const DESC_RULES = 'q_repository_i18n.DESC_RULES';
  const DESC_SOURCES = 'q_repository_i18n.DESC_SOURCES';
  const DESC_REVISION_HISTORY = 'q_repository_i18n.DESC_REVISION_HISTORY';
  const ID = 'q_repository_i18n.ID';
  const CULTURE = 'q_repository_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitRepositoryI18n::GEOCULTURAL_CONTEXT);
    $criteria->addSelectColumn(QubitRepositoryI18n::COLLECTING_POLICIES);
    $criteria->addSelectColumn(QubitRepositoryI18n::BUILDINGS);
    $criteria->addSelectColumn(QubitRepositoryI18n::HOLDINGS);
    $criteria->addSelectColumn(QubitRepositoryI18n::FINDING_AIDS);
    $criteria->addSelectColumn(QubitRepositoryI18n::OPENING_TIMES);
    $criteria->addSelectColumn(QubitRepositoryI18n::ACCESS_CONDITIONS);
    $criteria->addSelectColumn(QubitRepositoryI18n::DISABLED_ACCESS);
    $criteria->addSelectColumn(QubitRepositoryI18n::RESEARCH_SERVICES);
    $criteria->addSelectColumn(QubitRepositoryI18n::REPRODUCTION_SERVICES);
    $criteria->addSelectColumn(QubitRepositoryI18n::PUBLIC_FACILITIES);
    $criteria->addSelectColumn(QubitRepositoryI18n::DESC_INSTITUTION_IDENTIFIER);
    $criteria->addSelectColumn(QubitRepositoryI18n::DESC_RULES);
    $criteria->addSelectColumn(QubitRepositoryI18n::DESC_SOURCES);
    $criteria->addSelectColumn(QubitRepositoryI18n::DESC_REVISION_HISTORY);
    $criteria->addSelectColumn(QubitRepositoryI18n::ID);
    $criteria->addSelectColumn(QubitRepositoryI18n::CULTURE);

    return $criteria;
  }

  protected static $repositoryI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$repositoryI18ns[$key = serialize(array($resultSet->getInt(16), $resultSet->getString(17)))]))
    {
      $repositoryI18n = new QubitRepositoryI18n;
      $repositoryI18n->hydrate($resultSet);

      self::$repositoryI18ns[$key] = $repositoryI18n;
    }

    return self::$repositoryI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRepositoryI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitRepositoryI18n', $options);
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

  public static function getByIdAndCulture($id, $culture, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRepositoryI18n::ID, $id);
    $criteria->add(QubitRepositoryI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRepositoryI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $geoculturalContext = null;

  public function getGeoculturalContext()
  {
    return $this->geoculturalContext;
  }

  public function setGeoculturalContext($geoculturalContext)
  {
    $this->geoculturalContext = $geoculturalContext;

    return $this;
  }

  protected $collectingPolicies = null;

  public function getCollectingPolicies()
  {
    return $this->collectingPolicies;
  }

  public function setCollectingPolicies($collectingPolicies)
  {
    $this->collectingPolicies = $collectingPolicies;

    return $this;
  }

  protected $buildings = null;

  public function getBuildings()
  {
    return $this->buildings;
  }

  public function setBuildings($buildings)
  {
    $this->buildings = $buildings;

    return $this;
  }

  protected $holdings = null;

  public function getHoldings()
  {
    return $this->holdings;
  }

  public function setHoldings($holdings)
  {
    $this->holdings = $holdings;

    return $this;
  }

  protected $findingAids = null;

  public function getFindingAids()
  {
    return $this->findingAids;
  }

  public function setFindingAids($findingAids)
  {
    $this->findingAids = $findingAids;

    return $this;
  }

  protected $openingTimes = null;

  public function getOpeningTimes()
  {
    return $this->openingTimes;
  }

  public function setOpeningTimes($openingTimes)
  {
    $this->openingTimes = $openingTimes;

    return $this;
  }

  protected $accessConditions = null;

  public function getAccessConditions()
  {
    return $this->accessConditions;
  }

  public function setAccessConditions($accessConditions)
  {
    $this->accessConditions = $accessConditions;

    return $this;
  }

  protected $disabledAccess = null;

  public function getDisabledAccess()
  {
    return $this->disabledAccess;
  }

  public function setDisabledAccess($disabledAccess)
  {
    $this->disabledAccess = $disabledAccess;

    return $this;
  }

  protected $researchServices = null;

  public function getResearchServices()
  {
    return $this->researchServices;
  }

  public function setResearchServices($researchServices)
  {
    $this->researchServices = $researchServices;

    return $this;
  }

  protected $reproductionServices = null;

  public function getReproductionServices()
  {
    return $this->reproductionServices;
  }

  public function setReproductionServices($reproductionServices)
  {
    $this->reproductionServices = $reproductionServices;

    return $this;
  }

  protected $publicFacilities = null;

  public function getPublicFacilities()
  {
    return $this->publicFacilities;
  }

  public function setPublicFacilities($publicFacilities)
  {
    $this->publicFacilities = $publicFacilities;

    return $this;
  }

  protected $descInstitutionIdentifier = null;

  public function getDescInstitutionIdentifier()
  {
    return $this->descInstitutionIdentifier;
  }

  public function setDescInstitutionIdentifier($descInstitutionIdentifier)
  {
    $this->descInstitutionIdentifier = $descInstitutionIdentifier;

    return $this;
  }

  protected $descRules = null;

  public function getDescRules()
  {
    return $this->descRules;
  }

  public function setDescRules($descRules)
  {
    $this->descRules = $descRules;

    return $this;
  }

  protected $descSources = null;

  public function getDescSources()
  {
    return $this->descSources;
  }

  public function setDescSources($descSources)
  {
    $this->descSources = $descSources;

    return $this;
  }

  protected $descRevisionHistory = null;

  public function getDescRevisionHistory()
  {
    return $this->descRevisionHistory;
  }

  public function setDescRevisionHistory($descRevisionHistory)
  {
    $this->descRevisionHistory = $descRevisionHistory;

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

  protected $culture = null;

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;

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
    $this->columnValues['geoculturalContext'] = $this->geoculturalContext;
    $this->columnValues['collectingPolicies'] = $this->collectingPolicies;
    $this->columnValues['buildings'] = $this->buildings;
    $this->columnValues['holdings'] = $this->holdings;
    $this->columnValues['findingAids'] = $this->findingAids;
    $this->columnValues['openingTimes'] = $this->openingTimes;
    $this->columnValues['accessConditions'] = $this->accessConditions;
    $this->columnValues['disabledAccess'] = $this->disabledAccess;
    $this->columnValues['researchServices'] = $this->researchServices;
    $this->columnValues['reproductionServices'] = $this->reproductionServices;
    $this->columnValues['publicFacilities'] = $this->publicFacilities;
    $this->columnValues['descInstitutionIdentifier'] = $this->descInstitutionIdentifier;
    $this->columnValues['descRules'] = $this->descRules;
    $this->columnValues['descSources'] = $this->descSources;
    $this->columnValues['descRevisionHistory'] = $this->descRevisionHistory;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->geoculturalContext = $results->getString($columnOffset++);
    $this->collectingPolicies = $results->getString($columnOffset++);
    $this->buildings = $results->getString($columnOffset++);
    $this->holdings = $results->getString($columnOffset++);
    $this->findingAids = $results->getString($columnOffset++);
    $this->openingTimes = $results->getString($columnOffset++);
    $this->accessConditions = $results->getString($columnOffset++);
    $this->disabledAccess = $results->getString($columnOffset++);
    $this->researchServices = $results->getString($columnOffset++);
    $this->reproductionServices = $results->getString($columnOffset++);
    $this->publicFacilities = $results->getString($columnOffset++);
    $this->descInstitutionIdentifier = $results->getString($columnOffset++);
    $this->descRules = $results->getString($columnOffset++);
    $this->descSources = $results->getString($columnOffset++);
    $this->descRevisionHistory = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);
    $this->culture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitRepositoryI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitRepositoryI18n::ID, $this->id);
    $criteria->add(QubitRepositoryI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('geoculturalContext'))
    {
      $criteria->add(QubitRepositoryI18n::GEOCULTURAL_CONTEXT, $this->geoculturalContext);
    }

    if ($this->isColumnModified('collectingPolicies'))
    {
      $criteria->add(QubitRepositoryI18n::COLLECTING_POLICIES, $this->collectingPolicies);
    }

    if ($this->isColumnModified('buildings'))
    {
      $criteria->add(QubitRepositoryI18n::BUILDINGS, $this->buildings);
    }

    if ($this->isColumnModified('holdings'))
    {
      $criteria->add(QubitRepositoryI18n::HOLDINGS, $this->holdings);
    }

    if ($this->isColumnModified('findingAids'))
    {
      $criteria->add(QubitRepositoryI18n::FINDING_AIDS, $this->findingAids);
    }

    if ($this->isColumnModified('openingTimes'))
    {
      $criteria->add(QubitRepositoryI18n::OPENING_TIMES, $this->openingTimes);
    }

    if ($this->isColumnModified('accessConditions'))
    {
      $criteria->add(QubitRepositoryI18n::ACCESS_CONDITIONS, $this->accessConditions);
    }

    if ($this->isColumnModified('disabledAccess'))
    {
      $criteria->add(QubitRepositoryI18n::DISABLED_ACCESS, $this->disabledAccess);
    }

    if ($this->isColumnModified('researchServices'))
    {
      $criteria->add(QubitRepositoryI18n::RESEARCH_SERVICES, $this->researchServices);
    }

    if ($this->isColumnModified('reproductionServices'))
    {
      $criteria->add(QubitRepositoryI18n::REPRODUCTION_SERVICES, $this->reproductionServices);
    }

    if ($this->isColumnModified('publicFacilities'))
    {
      $criteria->add(QubitRepositoryI18n::PUBLIC_FACILITIES, $this->publicFacilities);
    }

    if ($this->isColumnModified('descInstitutionIdentifier'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_INSTITUTION_IDENTIFIER, $this->descInstitutionIdentifier);
    }

    if ($this->isColumnModified('descRules'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_RULES, $this->descRules);
    }

    if ($this->isColumnModified('descSources'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_SOURCES, $this->descSources);
    }

    if ($this->isColumnModified('descRevisionHistory'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_REVISION_HISTORY, $this->descRevisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRepositoryI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitRepositoryI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitRepositoryI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('geoculturalContext'))
    {
      $criteria->add(QubitRepositoryI18n::GEOCULTURAL_CONTEXT, $this->geoculturalContext);
    }

    if ($this->isColumnModified('collectingPolicies'))
    {
      $criteria->add(QubitRepositoryI18n::COLLECTING_POLICIES, $this->collectingPolicies);
    }

    if ($this->isColumnModified('buildings'))
    {
      $criteria->add(QubitRepositoryI18n::BUILDINGS, $this->buildings);
    }

    if ($this->isColumnModified('holdings'))
    {
      $criteria->add(QubitRepositoryI18n::HOLDINGS, $this->holdings);
    }

    if ($this->isColumnModified('findingAids'))
    {
      $criteria->add(QubitRepositoryI18n::FINDING_AIDS, $this->findingAids);
    }

    if ($this->isColumnModified('openingTimes'))
    {
      $criteria->add(QubitRepositoryI18n::OPENING_TIMES, $this->openingTimes);
    }

    if ($this->isColumnModified('accessConditions'))
    {
      $criteria->add(QubitRepositoryI18n::ACCESS_CONDITIONS, $this->accessConditions);
    }

    if ($this->isColumnModified('disabledAccess'))
    {
      $criteria->add(QubitRepositoryI18n::DISABLED_ACCESS, $this->disabledAccess);
    }

    if ($this->isColumnModified('researchServices'))
    {
      $criteria->add(QubitRepositoryI18n::RESEARCH_SERVICES, $this->researchServices);
    }

    if ($this->isColumnModified('reproductionServices'))
    {
      $criteria->add(QubitRepositoryI18n::REPRODUCTION_SERVICES, $this->reproductionServices);
    }

    if ($this->isColumnModified('publicFacilities'))
    {
      $criteria->add(QubitRepositoryI18n::PUBLIC_FACILITIES, $this->publicFacilities);
    }

    if ($this->isColumnModified('descInstitutionIdentifier'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_INSTITUTION_IDENTIFIER, $this->descInstitutionIdentifier);
    }

    if ($this->isColumnModified('descRules'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_RULES, $this->descRules);
    }

    if ($this->isColumnModified('descSources'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_SOURCES, $this->descSources);
    }

    if ($this->isColumnModified('descRevisionHistory'))
    {
      $criteria->add(QubitRepositoryI18n::DESC_REVISION_HISTORY, $this->descRevisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitRepositoryI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitRepositoryI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitRepositoryI18n::ID, $this->id);
      $selectCriteria->add(QubitRepositoryI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitRepositoryI18n::DATABASE_NAME);
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
    $criteria->add(QubitRepositoryI18n::ID, $this->id);
    $criteria->add(QubitRepositoryI18n::CULTURE, $this->culture);

    $affectedRows += self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $affectedRows;
  }

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setCulture($keys[1]);

	}

  public static function addJoinRepositoryCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRepositoryI18n::ID, QubitRepository::ID);

    return $criteria;
  }

  public function getRepository(array $options = array())
  {
    return $this->repository = QubitRepository::getById($this->id, $options);
  }

  public function setRepository(QubitRepository $repository)
  {
    $this->id = $repository->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.RepositoryI18nMapBuilder');
