<?php

abstract class BaseActorI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_actor_i18n';

  const AUTHORIZED_FORM_OF_NAME = 'q_actor_i18n.AUTHORIZED_FORM_OF_NAME';
  const HISTORY = 'q_actor_i18n.HISTORY';
  const PLACES = 'q_actor_i18n.PLACES';
  const LEGAL_STATUS = 'q_actor_i18n.LEGAL_STATUS';
  const FUNCTIONS = 'q_actor_i18n.FUNCTIONS';
  const MANDATES = 'q_actor_i18n.MANDATES';
  const INTERNAL_STRUCTURES = 'q_actor_i18n.INTERNAL_STRUCTURES';
  const GENERAL_CONTEXT = 'q_actor_i18n.GENERAL_CONTEXT';
  const INSTITUTION_RESPONSIBLE_IDENTIFIER = 'q_actor_i18n.INSTITUTION_RESPONSIBLE_IDENTIFIER';
  const RULES = 'q_actor_i18n.RULES';
  const SOURCES = 'q_actor_i18n.SOURCES';
  const REVISION_HISTORY = 'q_actor_i18n.REVISION_HISTORY';
  const ID = 'q_actor_i18n.ID';
  const CULTURE = 'q_actor_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitActorI18n::AUTHORIZED_FORM_OF_NAME);
    $criteria->addSelectColumn(QubitActorI18n::HISTORY);
    $criteria->addSelectColumn(QubitActorI18n::PLACES);
    $criteria->addSelectColumn(QubitActorI18n::LEGAL_STATUS);
    $criteria->addSelectColumn(QubitActorI18n::FUNCTIONS);
    $criteria->addSelectColumn(QubitActorI18n::MANDATES);
    $criteria->addSelectColumn(QubitActorI18n::INTERNAL_STRUCTURES);
    $criteria->addSelectColumn(QubitActorI18n::GENERAL_CONTEXT);
    $criteria->addSelectColumn(QubitActorI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER);
    $criteria->addSelectColumn(QubitActorI18n::RULES);
    $criteria->addSelectColumn(QubitActorI18n::SOURCES);
    $criteria->addSelectColumn(QubitActorI18n::REVISION_HISTORY);
    $criteria->addSelectColumn(QubitActorI18n::ID);
    $criteria->addSelectColumn(QubitActorI18n::CULTURE);

    return $criteria;
  }

  protected static $actorI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$actorI18ns[$key = serialize(array($resultSet->getInt(13), $resultSet->getString(14)))]))
    {
      $actorI18n = new QubitActorI18n;
      $actorI18n->hydrate($resultSet);

      self::$actorI18ns[$key] = $actorI18n;
    }

    return self::$actorI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitActorI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitActorI18n', $options);
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
    $criteria->add(QubitActorI18n::ID, $id);
    $criteria->add(QubitActorI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitActorI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $authorizedFormOfName = null;

  public function getAuthorizedFormOfName()
  {
    return $this->authorizedFormOfName;
  }

  public function setAuthorizedFormOfName($authorizedFormOfName)
  {
    $this->authorizedFormOfName = $authorizedFormOfName;

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

  protected $places = null;

  public function getPlaces()
  {
    return $this->places;
  }

  public function setPlaces($places)
  {
    $this->places = $places;

    return $this;
  }

  protected $legalStatus = null;

  public function getLegalStatus()
  {
    return $this->legalStatus;
  }

  public function setLegalStatus($legalStatus)
  {
    $this->legalStatus = $legalStatus;

    return $this;
  }

  protected $functions = null;

  public function getFunctions()
  {
    return $this->functions;
  }

  public function setFunctions($functions)
  {
    $this->functions = $functions;

    return $this;
  }

  protected $mandates = null;

  public function getMandates()
  {
    return $this->mandates;
  }

  public function setMandates($mandates)
  {
    $this->mandates = $mandates;

    return $this;
  }

  protected $internalStructures = null;

  public function getInternalStructures()
  {
    return $this->internalStructures;
  }

  public function setInternalStructures($internalStructures)
  {
    $this->internalStructures = $internalStructures;

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
    $this->columnValues['authorizedFormOfName'] = $this->authorizedFormOfName;
    $this->columnValues['history'] = $this->history;
    $this->columnValues['places'] = $this->places;
    $this->columnValues['legalStatus'] = $this->legalStatus;
    $this->columnValues['functions'] = $this->functions;
    $this->columnValues['mandates'] = $this->mandates;
    $this->columnValues['internalStructures'] = $this->internalStructures;
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
    $this->authorizedFormOfName = $results->getString($columnOffset++);
    $this->history = $results->getString($columnOffset++);
    $this->places = $results->getString($columnOffset++);
    $this->legalStatus = $results->getString($columnOffset++);
    $this->functions = $results->getString($columnOffset++);
    $this->mandates = $results->getString($columnOffset++);
    $this->internalStructures = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitActorI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitActorI18n::ID, $this->id);
    $criteria->add(QubitActorI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('authorizedFormOfName'))
    {
      $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $this->authorizedFormOfName);
    }

    if ($this->isColumnModified('history'))
    {
      $criteria->add(QubitActorI18n::HISTORY, $this->history);
    }

    if ($this->isColumnModified('places'))
    {
      $criteria->add(QubitActorI18n::PLACES, $this->places);
    }

    if ($this->isColumnModified('legalStatus'))
    {
      $criteria->add(QubitActorI18n::LEGAL_STATUS, $this->legalStatus);
    }

    if ($this->isColumnModified('functions'))
    {
      $criteria->add(QubitActorI18n::FUNCTIONS, $this->functions);
    }

    if ($this->isColumnModified('mandates'))
    {
      $criteria->add(QubitActorI18n::MANDATES, $this->mandates);
    }

    if ($this->isColumnModified('internalStructures'))
    {
      $criteria->add(QubitActorI18n::INTERNAL_STRUCTURES, $this->internalStructures);
    }

    if ($this->isColumnModified('generalContext'))
    {
      $criteria->add(QubitActorI18n::GENERAL_CONTEXT, $this->generalContext);
    }

    if ($this->isColumnModified('institutionResponsibleIdentifier'))
    {
      $criteria->add(QubitActorI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER, $this->institutionResponsibleIdentifier);
    }

    if ($this->isColumnModified('rules'))
    {
      $criteria->add(QubitActorI18n::RULES, $this->rules);
    }

    if ($this->isColumnModified('sources'))
    {
      $criteria->add(QubitActorI18n::SOURCES, $this->sources);
    }

    if ($this->isColumnModified('revisionHistory'))
    {
      $criteria->add(QubitActorI18n::REVISION_HISTORY, $this->revisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActorI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitActorI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitActorI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('authorizedFormOfName'))
    {
      $criteria->add(QubitActorI18n::AUTHORIZED_FORM_OF_NAME, $this->authorizedFormOfName);
    }

    if ($this->isColumnModified('history'))
    {
      $criteria->add(QubitActorI18n::HISTORY, $this->history);
    }

    if ($this->isColumnModified('places'))
    {
      $criteria->add(QubitActorI18n::PLACES, $this->places);
    }

    if ($this->isColumnModified('legalStatus'))
    {
      $criteria->add(QubitActorI18n::LEGAL_STATUS, $this->legalStatus);
    }

    if ($this->isColumnModified('functions'))
    {
      $criteria->add(QubitActorI18n::FUNCTIONS, $this->functions);
    }

    if ($this->isColumnModified('mandates'))
    {
      $criteria->add(QubitActorI18n::MANDATES, $this->mandates);
    }

    if ($this->isColumnModified('internalStructures'))
    {
      $criteria->add(QubitActorI18n::INTERNAL_STRUCTURES, $this->internalStructures);
    }

    if ($this->isColumnModified('generalContext'))
    {
      $criteria->add(QubitActorI18n::GENERAL_CONTEXT, $this->generalContext);
    }

    if ($this->isColumnModified('institutionResponsibleIdentifier'))
    {
      $criteria->add(QubitActorI18n::INSTITUTION_RESPONSIBLE_IDENTIFIER, $this->institutionResponsibleIdentifier);
    }

    if ($this->isColumnModified('rules'))
    {
      $criteria->add(QubitActorI18n::RULES, $this->rules);
    }

    if ($this->isColumnModified('sources'))
    {
      $criteria->add(QubitActorI18n::SOURCES, $this->sources);
    }

    if ($this->isColumnModified('revisionHistory'))
    {
      $criteria->add(QubitActorI18n::REVISION_HISTORY, $this->revisionHistory);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActorI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitActorI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitActorI18n::ID, $this->id);
      $selectCriteria->add(QubitActorI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitActorI18n::DATABASE_NAME);
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
    $criteria->add(QubitActorI18n::ID, $this->id);
    $criteria->add(QubitActorI18n::CULTURE, $this->culture);

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

  public static function addJoinActorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActorI18n::ID, QubitActor::ID);

    return $criteria;
  }

  public function getActor(array $options = array())
  {
    return $this->actor = QubitActor::getById($this->id, $options);
  }

  public function setActor(QubitActor $actor)
  {
    $this->id = $actor->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.ActorI18nMapBuilder');
