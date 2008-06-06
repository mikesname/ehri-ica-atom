<?php

abstract class BaseFunctionI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_function_i18n';

  const CLASSIFICATION = 'q_function_i18n.CLASSIFICATION';
  const DOMAIN = 'q_function_i18n.DOMAIN';
  const DATES = 'q_function_i18n.DATES';
  const HISTORY = 'q_function_i18n.HISTORY';
  const LEGISLATION = 'q_function_i18n.LEGISLATION';
  const GENERAL_CONTEXT = 'q_function_i18n.GENERAL_CONTEXT';
  const INSTITUTION_RESPONSIBLE_IDENTIFIER = 'q_function_i18n.INSTITUTION_RESPONSIBLE_IDENTIFIER';
  const RULES = 'q_function_i18n.RULES';
  const SOURCES = 'q_function_i18n.SOURCES';
  const REVISION_HISTORY = 'q_function_i18n.REVISION_HISTORY';
  const ID = 'q_function_i18n.ID';
  const CULTURE = 'q_function_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitFunctionI18n::CLASSIFICATION);
    $criteria->addSelectColumn(QubitFunctionI18n::DOMAIN);
    $criteria->addSelectColumn(QubitFunctionI18n::DATES);
    $criteria->addSelectColumn(QubitFunctionI18n::HISTORY);
    $criteria->addSelectColumn(QubitFunctionI18n::LEGISLATION);
    $criteria->addSelectColumn(QubitFunctionI18n::GENERAL_CONTEXT);
    $criteria->addSelectColumn(QubitFunctionI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER);
    $criteria->addSelectColumn(QubitFunctionI18n::RULES);
    $criteria->addSelectColumn(QubitFunctionI18n::SOURCES);
    $criteria->addSelectColumn(QubitFunctionI18n::REVISION_HISTORY);
    $criteria->addSelectColumn(QubitFunctionI18n::ID);
    $criteria->addSelectColumn(QubitFunctionI18n::CULTURE);

    return $criteria;
  }

  protected static $functionI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$functionI18ns[$key = serialize(array($resultSet->getInt(11), $resultSet->getString(12)))]))
    {
      $functionI18n = new QubitFunctionI18n;
      $functionI18n->hydrate($resultSet);

      self::$functionI18ns[$key] = $functionI18n;
    }

    return self::$functionI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitFunctionI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitFunctionI18n', $options);
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
    $criteria->add(QubitFunctionI18n::ID, $id);
    $criteria->add(QubitFunctionI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitFunctionI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $classification = null;

  public function getClassification()
  {
    return $this->classification;
  }

  public function setClassification($classification)
  {
    $this->classification = $classification;

    return $this;
  }

  protected $domain = null;

  public function getDomain()
  {
    return $this->domain;
  }

  public function setDomain($domain)
  {
    $this->domain = $domain;

    return $this;
  }

  protected $dates = null;

  public function getDates()
  {
    return $this->dates;
  }

  public function setDates($dates)
  {
    $this->dates = $dates;

    return $this;
  }

  protected $history = null;

  public function getHistory()
  {
    return $this->history;
  }

  public function setHistory($history)
  {
    $this->history = $history;

    return $this;
  }

  protected $legislation = null;

  public function getLegislation()
  {
    return $this->legislation;
  }

  public function setLegislation($legislation)
  {
    $this->legislation = $legislation;

    return $this;
  }

  protected $generalContext = null;

  public function getGeneralContext()
  {
    return $this->generalContext;
  }

  public function setGeneralContext($generalContext)
  {
    $this->generalContext = $generalContext;

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
    $this->columnValues['classification'] = $this->classification;
    $this->columnValues['domain'] = $this->domain;
    $this->columnValues['dates'] = $this->dates;
    $this->columnValues['history'] = $this->history;
    $this->columnValues['legislation'] = $this->legislation;
    $this->columnValues['generalContext'] = $this->generalContext;
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
    $this->classification = $results->getString($columnOffset++);
    $this->domain = $results->getString($columnOffset++);
    $this->dates = $results->getString($columnOffset++);
    $this->history = $results->getString($columnOffset++);
    $this->legislation = $results->getString($columnOffset++);
    $this->generalContext = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitFunctionI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitFunctionI18n::ID, $this->id);
    $criteria->add(QubitFunctionI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('classification'))
    {
      $criteria->add(QubitFunctionI18n::CLASSIFICATION, $this->classification);
    }

    if ($this->isColumnModified('domain'))
    {
      $criteria->add(QubitFunctionI18n::DOMAIN, $this->domain);
    }

    if ($this->isColumnModified('dates'))
    {
      $criteria->add(QubitFunctionI18n::DATES, $this->dates);
    }

    if ($this->isColumnModified('history'))
    {
      $criteria->add(QubitFunctionI18n::HISTORY, $this->history);
    }

    if ($this->isColumnModified('legislation'))
    {
      $criteria->add(QubitFunctionI18n::LEGISLATION, $this->legislation);
    }

    if ($this->isColumnModified('generalContext'))
    {
      $criteria->add(QubitFunctionI18n::GENERAL_CONTEXT, $this->generalContext);
    }

    if ($this->isColumnModified('institutionResponsibleIdentifier'))
    {
      $criteria->add(QubitFunctionI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER, $this->institutionResponsibleIdentifier);
    }

    if ($this->isColumnModified('rules'))
    {
      $criteria->add(QubitFunctionI18n::RULES, $this->rules);
    }

    if ($this->isColumnModified('sources'))
    {
      $criteria->add(QubitFunctionI18n::SOURCES, $this->sources);
    }

    if ($this->isColumnModified('revisionHistory'))
    {
      $criteria->add(QubitFunctionI18n::REVISION_HISTORY, $this->revisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitFunctionI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitFunctionI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitFunctionI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('classification'))
    {
      $criteria->add(QubitFunctionI18n::CLASSIFICATION, $this->classification);
    }

    if ($this->isColumnModified('domain'))
    {
      $criteria->add(QubitFunctionI18n::DOMAIN, $this->domain);
    }

    if ($this->isColumnModified('dates'))
    {
      $criteria->add(QubitFunctionI18n::DATES, $this->dates);
    }

    if ($this->isColumnModified('history'))
    {
      $criteria->add(QubitFunctionI18n::HISTORY, $this->history);
    }

    if ($this->isColumnModified('legislation'))
    {
      $criteria->add(QubitFunctionI18n::LEGISLATION, $this->legislation);
    }

    if ($this->isColumnModified('generalContext'))
    {
      $criteria->add(QubitFunctionI18n::GENERAL_CONTEXT, $this->generalContext);
    }

    if ($this->isColumnModified('institutionResponsibleIdentifier'))
    {
      $criteria->add(QubitFunctionI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER, $this->institutionResponsibleIdentifier);
    }

    if ($this->isColumnModified('rules'))
    {
      $criteria->add(QubitFunctionI18n::RULES, $this->rules);
    }

    if ($this->isColumnModified('sources'))
    {
      $criteria->add(QubitFunctionI18n::SOURCES, $this->sources);
    }

    if ($this->isColumnModified('revisionHistory'))
    {
      $criteria->add(QubitFunctionI18n::REVISION_HISTORY, $this->revisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitFunctionI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitFunctionI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitFunctionI18n::ID, $this->id);
      $selectCriteria->add(QubitFunctionI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitFunctionI18n::DATABASE_NAME);
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
    $criteria->add(QubitFunctionI18n::ID, $this->id);
    $criteria->add(QubitFunctionI18n::CULTURE, $this->culture);

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

  public static function addJoinFunctionCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitFunctionI18n::ID, QubitFunction::ID);

    return $criteria;
  }

  public function getFunction(array $options = array())
  {
    return $this->function = QubitFunction::getById($this->id, $options);
  }

  public function setFunction(QubitFunction $function)
  {
    $this->id = $function->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.FunctionI18nMapBuilder');
