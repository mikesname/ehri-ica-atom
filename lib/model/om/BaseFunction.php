<?php

abstract class BaseFunction extends QubitTerm
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_function';

  const ID = 'q_function.ID';
  const TYPE_ID = 'q_function.TYPE_ID';
  const DESCRIPTION_STATUS_ID = 'q_function.DESCRIPTION_STATUS_ID';
  const DESCRIPTION_LEVEL_ID = 'q_function.DESCRIPTION_LEVEL_ID';
  const DESCRIPTION_IDENTIFIER = 'q_function.DESCRIPTION_IDENTIFIER';
  const SOURCE_CULTURE = 'q_function.SOURCE_CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitFunction::ID, QubitTerm::ID);

    $criteria->addSelectColumn(QubitFunction::ID);
    $criteria->addSelectColumn(QubitFunction::TYPE_ID);
    $criteria->addSelectColumn(QubitFunction::DESCRIPTION_STATUS_ID);
    $criteria->addSelectColumn(QubitFunction::DESCRIPTION_LEVEL_ID);
    $criteria->addSelectColumn(QubitFunction::DESCRIPTION_IDENTIFIER);
    $criteria->addSelectColumn(QubitFunction::SOURCE_CULTURE);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitFunction::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitFunction', $options);
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
    $criteria->add(QubitFunction::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
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

  protected $descriptionLevelId = null;

  public function getDescriptionLevelId()
  {
    return $this->descriptionLevelId;
  }

  public function setDescriptionLevelId($descriptionLevelId)
  {
    $this->descriptionLevelId = $descriptionLevelId;

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
    $this->columnValues['typeId'] = $this->typeId;
    $this->columnValues['descriptionStatusId'] = $this->descriptionStatusId;
    $this->columnValues['descriptionLevelId'] = $this->descriptionLevelId;
    $this->columnValues['descriptionIdentifier'] = $this->descriptionIdentifier;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->typeId = $results->getInt($columnOffset++);
    $this->descriptionStatusId = $results->getInt($columnOffset++);
    $this->descriptionLevelId = $results->getInt($columnOffset++);
    $this->descriptionIdentifier = $results->getString($columnOffset++);
    $this->sourceCulture = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitFunction::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitFunction::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->functionI18ns as $functionI18n)
    {
      $functionI18n->setId($this->id);

      $affectedRows += $functionI18n->save($connection);
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
      $criteria->add(QubitFunction::ID, $this->id);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitFunction::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('descriptionStatusId'))
    {
      $criteria->add(QubitFunction::DESCRIPTION_STATUS_ID, $this->descriptionStatusId);
    }

    if ($this->isColumnModified('descriptionLevelId'))
    {
      $criteria->add(QubitFunction::DESCRIPTION_LEVEL_ID, $this->descriptionLevelId);
    }

    if ($this->isColumnModified('descriptionIdentifier'))
    {
      $criteria->add(QubitFunction::DESCRIPTION_IDENTIFIER, $this->descriptionIdentifier);
    }

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitFunction::SOURCE_CULTURE, $this->sourceCulture);

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitFunction::DATABASE_NAME);
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
      $criteria->add(QubitFunction::ID, $this->id);
    }

    if ($this->isColumnModified('typeId'))
    {
      $criteria->add(QubitFunction::TYPE_ID, $this->typeId);
    }

    if ($this->isColumnModified('descriptionStatusId'))
    {
      $criteria->add(QubitFunction::DESCRIPTION_STATUS_ID, $this->descriptionStatusId);
    }

    if ($this->isColumnModified('descriptionLevelId'))
    {
      $criteria->add(QubitFunction::DESCRIPTION_LEVEL_ID, $this->descriptionLevelId);
    }

    if ($this->isColumnModified('descriptionIdentifier'))
    {
      $criteria->add(QubitFunction::DESCRIPTION_IDENTIFIER, $this->descriptionIdentifier);
    }

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitFunction::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitFunction::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitFunction::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addJoinTypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitFunction::TYPE_ID, QubitTerm::ID);

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

  public static function addJoinDescriptionStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitFunction::DESCRIPTION_STATUS_ID, QubitTerm::ID);

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

  public static function addJoinDescriptionLevelCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitFunction::DESCRIPTION_LEVEL_ID, QubitTerm::ID);

    return $criteria;
  }

  public function getDescriptionLevel(array $options = array())
  {
    return $this->descriptionLevel = QubitTerm::getById($this->descriptionLevelId, $options);
  }

  public function setDescriptionLevel(QubitTerm $term)
  {
    $this->descriptionLevelId = $term->getId();

    return $this;
  }

  public static function addFunctionI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunctionI18n::ID, $id);

    return $criteria;
  }

  public static function getFunctionI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addFunctionI18nsCriteriaById($criteria, $id);

    return QubitFunctionI18n::get($criteria, $options);
  }

  public function addFunctionI18nsCriteria(Criteria $criteria)
  {
    return self::addFunctionI18nsCriteriaById($criteria, $this->id);
  }

  protected $functionI18ns = null;

  public function getFunctionI18ns(array $options = array())
  {
    if (!isset($this->functionI18ns))
    {
      if (!isset($this->id))
      {
        $this->functionI18ns = QubitQuery::create();
      }
      else
      {
        $this->functionI18ns = self::getFunctionI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionI18ns;
  }

  public function getClassification(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getClassification();
  }

  public function setClassification($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setClassification($value);

    return $this;
  }

  public function getDomain(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getDomain();
  }

  public function setDomain($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setDomain($value);

    return $this;
  }

  public function getDates(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getDates();
  }

  public function setDates($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setDates($value);

    return $this;
  }

  public function getHistory(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getHistory();
  }

  public function setHistory($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setHistory($value);

    return $this;
  }

  public function getLegislation(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getLegislation();
  }

  public function setLegislation($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setLegislation($value);

    return $this;
  }

  public function getGeneralContext(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getGeneralContext();
  }

  public function setGeneralContext($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setGeneralContext($value);

    return $this;
  }

  public function getInstitutionResponsibleIdentifier(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getInstitutionResponsibleIdentifier();
  }

  public function setInstitutionResponsibleIdentifier($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setInstitutionResponsibleIdentifier($value);

    return $this;
  }

  public function getRules(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getRules();
  }

  public function setRules($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setRules($value);

    return $this;
  }

  public function getSources(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getSources();
  }

  public function setSources($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setSources($value);

    return $this;
  }

  public function getRevisionHistory(array $options = array())
  {
    return $this->getCurrentFunctionI18n($options)->getRevisionHistory();
  }

  public function setRevisionHistory($value, array $options = array())
  {
    $this->getCurrentFunctionI18n($options)->setRevisionHistory($value);

    return $this;
  }

  public function getCurrentFunctionI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->functionI18ns[$options['culture']]))
    {
      if (null === $functionI18n = QubitFunctionI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $functionI18n = new QubitFunctionI18n;
        $functionI18n->setCulture($options['culture']);
      }
      $this->functionI18ns[$options['culture']] = $functionI18n;
    }

    return $this->functionI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.FunctionMapBuilder');
