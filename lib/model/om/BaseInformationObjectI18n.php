<?php

abstract class BaseInformationObjectI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_information_object_i18n';

  const TITLE = 'q_information_object_i18n.TITLE';
  const ALTERNATE_TITLE = 'q_information_object_i18n.ALTERNATE_TITLE';
  const EDITION = 'q_information_object_i18n.EDITION';
  const EXTENT_AND_MEDIUM = 'q_information_object_i18n.EXTENT_AND_MEDIUM';
  const ARCHIVAL_HISTORY = 'q_information_object_i18n.ARCHIVAL_HISTORY';
  const ACQUISITION = 'q_information_object_i18n.ACQUISITION';
  const SCOPE_AND_CONTENT = 'q_information_object_i18n.SCOPE_AND_CONTENT';
  const APPRAISAL = 'q_information_object_i18n.APPRAISAL';
  const ACCRUALS = 'q_information_object_i18n.ACCRUALS';
  const ARRANGEMENT = 'q_information_object_i18n.ARRANGEMENT';
  const ACCESS_CONDITIONS = 'q_information_object_i18n.ACCESS_CONDITIONS';
  const REPRODUCTION_CONDITIONS = 'q_information_object_i18n.REPRODUCTION_CONDITIONS';
  const PHYSICAL_CHARACTERISTICS = 'q_information_object_i18n.PHYSICAL_CHARACTERISTICS';
  const FINDING_AIDS = 'q_information_object_i18n.FINDING_AIDS';
  const LOCATION_OF_ORIGINALS = 'q_information_object_i18n.LOCATION_OF_ORIGINALS';
  const LOCATION_OF_COPIES = 'q_information_object_i18n.LOCATION_OF_COPIES';
  const RELATED_UNITS_OF_DESCRIPTION = 'q_information_object_i18n.RELATED_UNITS_OF_DESCRIPTION';
  const INSTITUTION_RESPONSIBLE_IDENTIFIER = 'q_information_object_i18n.INSTITUTION_RESPONSIBLE_IDENTIFIER';
  const RULES = 'q_information_object_i18n.RULES';
  const SOURCES = 'q_information_object_i18n.SOURCES';
  const REVISION_HISTORY = 'q_information_object_i18n.REVISION_HISTORY';
  const ID = 'q_information_object_i18n.ID';
  const CULTURE = 'q_information_object_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitInformationObjectI18n::TITLE);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ALTERNATE_TITLE);
    $criteria->addSelectColumn(QubitInformationObjectI18n::EDITION);
    $criteria->addSelectColumn(QubitInformationObjectI18n::EXTENT_AND_MEDIUM);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ARCHIVAL_HISTORY);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ACQUISITION);
    $criteria->addSelectColumn(QubitInformationObjectI18n::SCOPE_AND_CONTENT);
    $criteria->addSelectColumn(QubitInformationObjectI18n::APPRAISAL);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ACCRUALS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ARRANGEMENT);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ACCESS_CONDITIONS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::REPRODUCTION_CONDITIONS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::PHYSICAL_CHARACTERISTICS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::FINDING_AIDS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::LOCATION_OF_ORIGINALS);
    $criteria->addSelectColumn(QubitInformationObjectI18n::LOCATION_OF_COPIES);
    $criteria->addSelectColumn(QubitInformationObjectI18n::RELATED_UNITS_OF_DESCRIPTION);
    $criteria->addSelectColumn(QubitInformationObjectI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER);
    $criteria->addSelectColumn(QubitInformationObjectI18n::RULES);
    $criteria->addSelectColumn(QubitInformationObjectI18n::SOURCES);
    $criteria->addSelectColumn(QubitInformationObjectI18n::REVISION_HISTORY);
    $criteria->addSelectColumn(QubitInformationObjectI18n::ID);
    $criteria->addSelectColumn(QubitInformationObjectI18n::CULTURE);

    return $criteria;
  }

  protected static $informationObjectI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$informationObjectI18ns[$key = serialize(array($resultSet->getInt(22), $resultSet->getString(23)))]))
    {
      $informationObjectI18n = new QubitInformationObjectI18n;
      $informationObjectI18n->hydrate($resultSet);

      self::$informationObjectI18ns[$key] = $informationObjectI18n;
    }

    return self::$informationObjectI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitInformationObjectI18n', $options);
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
    $criteria->add(QubitInformationObjectI18n::ID, $id);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $title = null;

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  protected $alternateTitle = null;

  public function getAlternateTitle()
  {
    return $this->alternateTitle;
  }

  public function setAlternateTitle($alternateTitle)
  {
    $this->alternateTitle = $alternateTitle;

    return $this;
  }

  protected $edition = null;

  public function getEdition()
  {
    return $this->edition;
  }

  public function setEdition($edition)
  {
    $this->edition = $edition;

    return $this;
  }

  protected $extentAndMedium = null;

  public function getExtentAndMedium()
  {
    return $this->extentAndMedium;
  }

  public function setExtentAndMedium($extentAndMedium)
  {
    $this->extentAndMedium = $extentAndMedium;

    return $this;
  }

  protected $archivalHistory = null;

  public function getArchivalHistory()
  {
    return $this->archivalHistory;
  }

  public function setArchivalHistory($archivalHistory)
  {
    $this->archivalHistory = $archivalHistory;

    return $this;
  }

  protected $acquisition = null;

  public function getAcquisition()
  {
    return $this->acquisition;
  }

  public function setAcquisition($acquisition)
  {
    $this->acquisition = $acquisition;

    return $this;
  }

  protected $scopeAndContent = null;

  public function getScopeAndContent()
  {
    return $this->scopeAndContent;
  }

  public function setScopeAndContent($scopeAndContent)
  {
    $this->scopeAndContent = $scopeAndContent;

    return $this;
  }

  protected $appraisal = null;

  public function getAppraisal()
  {
    return $this->appraisal;
  }

  public function setAppraisal($appraisal)
  {
    $this->appraisal = $appraisal;

    return $this;
  }

  protected $accruals = null;

  public function getAccruals()
  {
    return $this->accruals;
  }

  public function setAccruals($accruals)
  {
    $this->accruals = $accruals;

    return $this;
  }

  protected $arrangement = null;

  public function getArrangement()
  {
    return $this->arrangement;
  }

  public function setArrangement($arrangement)
  {
    $this->arrangement = $arrangement;

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

  protected $reproductionConditions = null;

  public function getReproductionConditions()
  {
    return $this->reproductionConditions;
  }

  public function setReproductionConditions($reproductionConditions)
  {
    $this->reproductionConditions = $reproductionConditions;

    return $this;
  }

  protected $physicalCharacteristics = null;

  public function getPhysicalCharacteristics()
  {
    return $this->physicalCharacteristics;
  }

  public function setPhysicalCharacteristics($physicalCharacteristics)
  {
    $this->physicalCharacteristics = $physicalCharacteristics;

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

  protected $locationOfOriginals = null;

  public function getLocationOfOriginals()
  {
    return $this->locationOfOriginals;
  }

  public function setLocationOfOriginals($locationOfOriginals)
  {
    $this->locationOfOriginals = $locationOfOriginals;

    return $this;
  }

  protected $locationOfCopies = null;

  public function getLocationOfCopies()
  {
    return $this->locationOfCopies;
  }

  public function setLocationOfCopies($locationOfCopies)
  {
    $this->locationOfCopies = $locationOfCopies;

    return $this;
  }

  protected $relatedUnitsOfDescription = null;

  public function getRelatedUnitsOfDescription()
  {
    return $this->relatedUnitsOfDescription;
  }

  public function setRelatedUnitsOfDescription($relatedUnitsOfDescription)
  {
    $this->relatedUnitsOfDescription = $relatedUnitsOfDescription;

    return $this;
  }

  protected $institutionResponsibleIdentifier = null;

  public function getInstitutionResponsibleIdentifier()
  {
    return $this->institutionResponsibleIdentifier;
  }

  public function setInstitutionResponsibleIdentifier($institutionResponsibleIdentifier)
  {
    $this->institutionResponsibleIdentifier = $institutionResponsibleIdentifier;

    return $this;
  }

  protected $rules = null;

  public function getRules()
  {
    return $this->rules;
  }

  public function setRules($rules)
  {
    $this->rules = $rules;

    return $this;
  }

  protected $sources = null;

  public function getSources()
  {
    return $this->sources;
  }

  public function setSources($sources)
  {
    $this->sources = $sources;

    return $this;
  }

  protected $revisionHistory = null;

  public function getRevisionHistory()
  {
    return $this->revisionHistory;
  }

  public function setRevisionHistory($revisionHistory)
  {
    $this->revisionHistory = $revisionHistory;

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
    $this->columnValues['title'] = $this->title;
    $this->columnValues['alternateTitle'] = $this->alternateTitle;
    $this->columnValues['edition'] = $this->edition;
    $this->columnValues['extentAndMedium'] = $this->extentAndMedium;
    $this->columnValues['archivalHistory'] = $this->archivalHistory;
    $this->columnValues['acquisition'] = $this->acquisition;
    $this->columnValues['scopeAndContent'] = $this->scopeAndContent;
    $this->columnValues['appraisal'] = $this->appraisal;
    $this->columnValues['accruals'] = $this->accruals;
    $this->columnValues['arrangement'] = $this->arrangement;
    $this->columnValues['accessConditions'] = $this->accessConditions;
    $this->columnValues['reproductionConditions'] = $this->reproductionConditions;
    $this->columnValues['physicalCharacteristics'] = $this->physicalCharacteristics;
    $this->columnValues['findingAids'] = $this->findingAids;
    $this->columnValues['locationOfOriginals'] = $this->locationOfOriginals;
    $this->columnValues['locationOfCopies'] = $this->locationOfCopies;
    $this->columnValues['relatedUnitsOfDescription'] = $this->relatedUnitsOfDescription;
    $this->columnValues['institutionResponsibleIdentifier'] = $this->institutionResponsibleIdentifier;
    $this->columnValues['rules'] = $this->rules;
    $this->columnValues['sources'] = $this->sources;
    $this->columnValues['revisionHistory'] = $this->revisionHistory;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->title = $results->getString($columnOffset++);
    $this->alternateTitle = $results->getString($columnOffset++);
    $this->edition = $results->getString($columnOffset++);
    $this->extentAndMedium = $results->getString($columnOffset++);
    $this->archivalHistory = $results->getString($columnOffset++);
    $this->acquisition = $results->getString($columnOffset++);
    $this->scopeAndContent = $results->getString($columnOffset++);
    $this->appraisal = $results->getString($columnOffset++);
    $this->accruals = $results->getString($columnOffset++);
    $this->arrangement = $results->getString($columnOffset++);
    $this->accessConditions = $results->getString($columnOffset++);
    $this->reproductionConditions = $results->getString($columnOffset++);
    $this->physicalCharacteristics = $results->getString($columnOffset++);
    $this->findingAids = $results->getString($columnOffset++);
    $this->locationOfOriginals = $results->getString($columnOffset++);
    $this->locationOfCopies = $results->getString($columnOffset++);
    $this->relatedUnitsOfDescription = $results->getString($columnOffset++);
    $this->institutionResponsibleIdentifier = $results->getString($columnOffset++);
    $this->rules = $results->getString($columnOffset++);
    $this->sources = $results->getString($columnOffset++);
    $this->revisionHistory = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitInformationObjectI18n::ID, $this->id);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('title'))
    {
      $criteria->add(QubitInformationObjectI18n::TITLE, $this->title);
    }

    if ($this->isColumnModified('alternateTitle'))
    {
      $criteria->add(QubitInformationObjectI18n::ALTERNATE_TITLE, $this->alternateTitle);
    }

    if ($this->isColumnModified('edition'))
    {
      $criteria->add(QubitInformationObjectI18n::EDITION, $this->edition);
    }

    if ($this->isColumnModified('extentAndMedium'))
    {
      $criteria->add(QubitInformationObjectI18n::EXTENT_AND_MEDIUM, $this->extentAndMedium);
    }

    if ($this->isColumnModified('archivalHistory'))
    {
      $criteria->add(QubitInformationObjectI18n::ARCHIVAL_HISTORY, $this->archivalHistory);
    }

    if ($this->isColumnModified('acquisition'))
    {
      $criteria->add(QubitInformationObjectI18n::ACQUISITION, $this->acquisition);
    }

    if ($this->isColumnModified('scopeAndContent'))
    {
      $criteria->add(QubitInformationObjectI18n::SCOPE_AND_CONTENT, $this->scopeAndContent);
    }

    if ($this->isColumnModified('appraisal'))
    {
      $criteria->add(QubitInformationObjectI18n::APPRAISAL, $this->appraisal);
    }

    if ($this->isColumnModified('accruals'))
    {
      $criteria->add(QubitInformationObjectI18n::ACCRUALS, $this->accruals);
    }

    if ($this->isColumnModified('arrangement'))
    {
      $criteria->add(QubitInformationObjectI18n::ARRANGEMENT, $this->arrangement);
    }

    if ($this->isColumnModified('accessConditions'))
    {
      $criteria->add(QubitInformationObjectI18n::ACCESS_CONDITIONS, $this->accessConditions);
    }

    if ($this->isColumnModified('reproductionConditions'))
    {
      $criteria->add(QubitInformationObjectI18n::REPRODUCTION_CONDITIONS, $this->reproductionConditions);
    }

    if ($this->isColumnModified('physicalCharacteristics'))
    {
      $criteria->add(QubitInformationObjectI18n::PHYSICAL_CHARACTERISTICS, $this->physicalCharacteristics);
    }

    if ($this->isColumnModified('findingAids'))
    {
      $criteria->add(QubitInformationObjectI18n::FINDING_AIDS, $this->findingAids);
    }

    if ($this->isColumnModified('locationOfOriginals'))
    {
      $criteria->add(QubitInformationObjectI18n::LOCATION_OF_ORIGINALS, $this->locationOfOriginals);
    }

    if ($this->isColumnModified('locationOfCopies'))
    {
      $criteria->add(QubitInformationObjectI18n::LOCATION_OF_COPIES, $this->locationOfCopies);
    }

    if ($this->isColumnModified('relatedUnitsOfDescription'))
    {
      $criteria->add(QubitInformationObjectI18n::RELATED_UNITS_OF_DESCRIPTION, $this->relatedUnitsOfDescription);
    }

    if ($this->isColumnModified('institutionResponsibleIdentifier'))
    {
      $criteria->add(QubitInformationObjectI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER, $this->institutionResponsibleIdentifier);
    }

    if ($this->isColumnModified('rules'))
    {
      $criteria->add(QubitInformationObjectI18n::RULES, $this->rules);
    }

    if ($this->isColumnModified('sources'))
    {
      $criteria->add(QubitInformationObjectI18n::SOURCES, $this->sources);
    }

    if ($this->isColumnModified('revisionHistory'))
    {
      $criteria->add(QubitInformationObjectI18n::REVISION_HISTORY, $this->revisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitInformationObjectI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('title'))
    {
      $criteria->add(QubitInformationObjectI18n::TITLE, $this->title);
    }

    if ($this->isColumnModified('alternateTitle'))
    {
      $criteria->add(QubitInformationObjectI18n::ALTERNATE_TITLE, $this->alternateTitle);
    }

    if ($this->isColumnModified('edition'))
    {
      $criteria->add(QubitInformationObjectI18n::EDITION, $this->edition);
    }

    if ($this->isColumnModified('extentAndMedium'))
    {
      $criteria->add(QubitInformationObjectI18n::EXTENT_AND_MEDIUM, $this->extentAndMedium);
    }

    if ($this->isColumnModified('archivalHistory'))
    {
      $criteria->add(QubitInformationObjectI18n::ARCHIVAL_HISTORY, $this->archivalHistory);
    }

    if ($this->isColumnModified('acquisition'))
    {
      $criteria->add(QubitInformationObjectI18n::ACQUISITION, $this->acquisition);
    }

    if ($this->isColumnModified('scopeAndContent'))
    {
      $criteria->add(QubitInformationObjectI18n::SCOPE_AND_CONTENT, $this->scopeAndContent);
    }

    if ($this->isColumnModified('appraisal'))
    {
      $criteria->add(QubitInformationObjectI18n::APPRAISAL, $this->appraisal);
    }

    if ($this->isColumnModified('accruals'))
    {
      $criteria->add(QubitInformationObjectI18n::ACCRUALS, $this->accruals);
    }

    if ($this->isColumnModified('arrangement'))
    {
      $criteria->add(QubitInformationObjectI18n::ARRANGEMENT, $this->arrangement);
    }

    if ($this->isColumnModified('accessConditions'))
    {
      $criteria->add(QubitInformationObjectI18n::ACCESS_CONDITIONS, $this->accessConditions);
    }

    if ($this->isColumnModified('reproductionConditions'))
    {
      $criteria->add(QubitInformationObjectI18n::REPRODUCTION_CONDITIONS, $this->reproductionConditions);
    }

    if ($this->isColumnModified('physicalCharacteristics'))
    {
      $criteria->add(QubitInformationObjectI18n::PHYSICAL_CHARACTERISTICS, $this->physicalCharacteristics);
    }

    if ($this->isColumnModified('findingAids'))
    {
      $criteria->add(QubitInformationObjectI18n::FINDING_AIDS, $this->findingAids);
    }

    if ($this->isColumnModified('locationOfOriginals'))
    {
      $criteria->add(QubitInformationObjectI18n::LOCATION_OF_ORIGINALS, $this->locationOfOriginals);
    }

    if ($this->isColumnModified('locationOfCopies'))
    {
      $criteria->add(QubitInformationObjectI18n::LOCATION_OF_COPIES, $this->locationOfCopies);
    }

    if ($this->isColumnModified('relatedUnitsOfDescription'))
    {
      $criteria->add(QubitInformationObjectI18n::RELATED_UNITS_OF_DESCRIPTION, $this->relatedUnitsOfDescription);
    }

    if ($this->isColumnModified('institutionResponsibleIdentifier'))
    {
      $criteria->add(QubitInformationObjectI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER, $this->institutionResponsibleIdentifier);
    }

    if ($this->isColumnModified('rules'))
    {
      $criteria->add(QubitInformationObjectI18n::RULES, $this->rules);
    }

    if ($this->isColumnModified('sources'))
    {
      $criteria->add(QubitInformationObjectI18n::SOURCES, $this->sources);
    }

    if ($this->isColumnModified('revisionHistory'))
    {
      $criteria->add(QubitInformationObjectI18n::REVISION_HISTORY, $this->revisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitInformationObjectI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitInformationObjectI18n::ID, $this->id);
      $selectCriteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitInformationObjectI18n::DATABASE_NAME);
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
    $criteria->add(QubitInformationObjectI18n::ID, $this->id);
    $criteria->add(QubitInformationObjectI18n::CULTURE, $this->culture);

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

  public static function addJoinInformationObjectCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitInformationObjectI18n::ID, QubitInformationObject::ID);

    return $criteria;
  }

  public function getInformationObject(array $options = array())
  {
    return $this->informationObject = QubitInformationObject::getById($this->id, $options);
  }

  public function setInformationObject(QubitInformationObject $informationObject)
  {
    $this->id = $informationObject->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.InformationObjectI18nMapBuilder');
