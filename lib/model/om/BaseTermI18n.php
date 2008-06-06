<?php

abstract class BaseTermI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_term_i18n';

  const NAME = 'q_term_i18n.NAME';
  const SCOPE_NOTE = 'q_term_i18n.SCOPE_NOTE';
  const CODE_ALPHA = 'q_term_i18n.CODE_ALPHA';
  const CODE_ALPHA2 = 'q_term_i18n.CODE_ALPHA2';
  const SOURCE = 'q_term_i18n.SOURCE';
  const ID = 'q_term_i18n.ID';
  const CULTURE = 'q_term_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitTermI18n::NAME);
    $criteria->addSelectColumn(QubitTermI18n::SCOPE_NOTE);
    $criteria->addSelectColumn(QubitTermI18n::CODE_ALPHA);
    $criteria->addSelectColumn(QubitTermI18n::CODE_ALPHA2);
    $criteria->addSelectColumn(QubitTermI18n::SOURCE);
    $criteria->addSelectColumn(QubitTermI18n::ID);
    $criteria->addSelectColumn(QubitTermI18n::CULTURE);

    return $criteria;
  }

  protected static $termI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$termI18ns[$key = serialize(array($resultSet->getInt(6), $resultSet->getString(7)))]))
    {
      $termI18n = new QubitTermI18n;
      $termI18n->hydrate($resultSet);

      self::$termI18ns[$key] = $termI18n;
    }

    return self::$termI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitTermI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitTermI18n', $options);
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
    $criteria->add(QubitTermI18n::ID, $id);
    $criteria->add(QubitTermI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTermI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $name = null;

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  protected $scopeNote = null;

  public function getScopeNote()
  {
    return $this->scopeNote;
  }

  public function setScopeNote($scopeNote)
  {
    $this->scopeNote = $scopeNote;

    return $this;
  }

  protected $codeAlpha = null;

  public function getCodeAlpha()
  {
    return $this->codeAlpha;
  }

  public function setCodeAlpha($codeAlpha)
  {
    $this->codeAlpha = $codeAlpha;

    return $this;
  }

  protected $codeAlpha2 = null;

  public function getCodeAlpha2()
  {
    return $this->codeAlpha2;
  }

  public function setCodeAlpha2($codeAlpha2)
  {
    $this->codeAlpha2 = $codeAlpha2;

    return $this;
  }

  protected $source = null;

  public function getSource()
  {
    return $this->source;
  }

  public function setSource($source)
  {
    $this->source = $source;

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
    $this->columnValues['name'] = $this->name;
    $this->columnValues['scopeNote'] = $this->scopeNote;
    $this->columnValues['codeAlpha'] = $this->codeAlpha;
    $this->columnValues['codeAlpha2'] = $this->codeAlpha2;
    $this->columnValues['source'] = $this->source;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->name = $results->getString($columnOffset++);
    $this->scopeNote = $results->getString($columnOffset++);
    $this->codeAlpha = $results->getString($columnOffset++);
    $this->codeAlpha2 = $results->getString($columnOffset++);
    $this->source = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitTermI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitTermI18n::ID, $this->id);
    $criteria->add(QubitTermI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitTermI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('scopeNote'))
    {
      $criteria->add(QubitTermI18n::SCOPE_NOTE, $this->scopeNote);
    }

    if ($this->isColumnModified('codeAlpha'))
    {
      $criteria->add(QubitTermI18n::CODE_ALPHA, $this->codeAlpha);
    }

    if ($this->isColumnModified('codeAlpha2'))
    {
      $criteria->add(QubitTermI18n::CODE_ALPHA2, $this->codeAlpha2);
    }

    if ($this->isColumnModified('source'))
    {
      $criteria->add(QubitTermI18n::SOURCE, $this->source);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitTermI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitTermI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitTermI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitTermI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('scopeNote'))
    {
      $criteria->add(QubitTermI18n::SCOPE_NOTE, $this->scopeNote);
    }

    if ($this->isColumnModified('codeAlpha'))
    {
      $criteria->add(QubitTermI18n::CODE_ALPHA, $this->codeAlpha);
    }

    if ($this->isColumnModified('codeAlpha2'))
    {
      $criteria->add(QubitTermI18n::CODE_ALPHA2, $this->codeAlpha2);
    }

    if ($this->isColumnModified('source'))
    {
      $criteria->add(QubitTermI18n::SOURCE, $this->source);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitTermI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitTermI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitTermI18n::ID, $this->id);
      $selectCriteria->add(QubitTermI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitTermI18n::DATABASE_NAME);
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
    $criteria->add(QubitTermI18n::ID, $this->id);
    $criteria->add(QubitTermI18n::CULTURE, $this->culture);

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

  public static function addJoinTermCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitTermI18n::ID, QubitTerm::ID);

    return $criteria;
  }

  public function getTerm(array $options = array())
  {
    return $this->term = QubitTerm::getById($this->id, $options);
  }

  public function setTerm(QubitTerm $term)
  {
    $this->id = $term->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.TermI18nMapBuilder');
