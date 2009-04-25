<?php

abstract class BaseFunction extends QubitTerm implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_function',

    ID = 'q_function.ID',
    TYPE_ID = 'q_function.TYPE_ID',
    DESCRIPTION_STATUS_ID = 'q_function.DESCRIPTION_STATUS_ID',
    DESCRIPTION_LEVEL_ID = 'q_function.DESCRIPTION_LEVEL_ID',
    DESCRIPTION_IDENTIFIER = 'q_function.DESCRIPTION_IDENTIFIER',
    SOURCE_CULTURE = 'q_function.SOURCE_CULTURE';

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

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitFunction::DATABASE_NAME)->getTable(QubitFunction::TABLE_NAME);
  }

  public function offsetExists($offset, array $options = array())
  {
    if (parent::offsetExists($offset, $options))
    {
      return true;
    }

    if ($this->getCurrentfunctionI18n($options)->offsetExists($offset, $options))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && $this->getCurrentfunctionI18n(array('sourceCulture' => true) + $options)->offsetExists($offset, $options))
    {
      return true;
    }

    return false;
  }

  public function offsetGet($offset, array $options = array())
  {
    if (null !== $value = parent::offsetGet($offset, $options))
    {
      return $value;
    }

    if (null !== $value = $this->getCurrentfunctionI18n($options)->offsetGet($offset, $options))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = $this->getCurrentfunctionI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = $this->getCurrentfunctionI18n(array('sourceCulture' => true) + $options)->offsetGet($offset, $options))
    {
      return $value;
    }
  }

  public function offsetSet($offset, $value, array $options = array())
  {
    parent::offsetSet($offset, $value, $options);

    $this->getCurrentfunctionI18n($options)->offsetSet($offset, $value, $options);

    return $this;
  }

  public function offsetUnset($offset, array $options = array())
  {
    parent::offsetUnset($offset, $options);

    $this->getCurrentfunctionI18n($options)->offsetUnset($offset, $options);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->functionI18ns as $functionI18n)
    {
      $functionI18n->setid($this->id);

      $affectedRows += $functionI18n->save($connection);
    }

    return $affectedRows;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitFunction::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoindescriptionStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitFunction::DESCRIPTION_STATUS_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoindescriptionLevelCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitFunction::DESCRIPTION_LEVEL_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addfunctionI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitFunctionI18n::ID, $id);

    return $criteria;
  }

  public static function getfunctionI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addfunctionI18nsCriteriaById($criteria, $id);

    return QubitFunctionI18n::get($criteria, $options);
  }

  public function addfunctionI18nsCriteria(Criteria $criteria)
  {
    return self::addfunctionI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $functionI18ns = null;

  public function getfunctionI18ns(array $options = array())
  {
    if (!isset($this->functionI18ns))
    {
      if (!isset($this->id))
      {
        $this->functionI18ns = QubitQuery::create();
      }
      else
      {
        $this->functionI18ns = self::getfunctionI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->functionI18ns;
  }

  public function getCurrentfunctionI18n(array $options = array())
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
      if (!isset($this->id) || null === $functionI18n = QubitFunctionI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $functionI18n = new QubitFunctionI18n;
        $functionI18n->setculture($options['culture']);
      }
      $this->functionI18ns[$options['culture']] = $functionI18n;
    }

    return $this->functionI18ns[$options['culture']];
  }
}
