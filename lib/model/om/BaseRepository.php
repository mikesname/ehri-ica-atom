<?php

abstract class BaseRepository extends QubitActor implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_repository',

    ID = 'q_repository.ID',
    IDENTIFIER = 'q_repository.IDENTIFIER',
    TYPE_ID = 'q_repository.TYPE_ID',
    DESC_STATUS_ID = 'q_repository.DESC_STATUS_ID',
    DESC_DETAIL_ID = 'q_repository.DESC_DETAIL_ID',
    DESC_IDENTIFIER = 'q_repository.DESC_IDENTIFIER',
    SOURCE_CULTURE = 'q_repository.SOURCE_CULTURE';

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

    return self::get($criteria, $options)->__get(0, array('defaultValue' => null));
  }

  public static function getById($id, array $options = array())
  {
    $criteria = new Criteria;
    $criteria->add(QubitRepository::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitRepository::DATABASE_NAME)->getTable(QubitRepository::TABLE_NAME);
  }

  public function __isset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    if (call_user_func_array(array($this, 'parent::__isset'), $args))
    {
      return true;
    }

    if (call_user_func_array(array($this->getCurrentrepositoryI18n($options), '__isset'), $args))
    {
      return true;
    }

    if (!empty($options['cultureFallback']) && call_user_func_array(array($this->getCurrentrepositoryI18n(array('sourceCulture' => true) + $options), '__isset'), $args))
    {
      return true;
    }

    return false;
  }

  public function __get($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    if (null !== $value = call_user_func_array(array($this, 'parent::__get'), $args))
    {
      return $value;
    }

    if (null !== $value = call_user_func_array(array($this->getCurrentrepositoryI18n($options), '__get'), $args))
    {
      if (!empty($options['cultureFallback']) && 1 > strlen($value))
      {
        $value = call_user_func_array(array($this->getCurrentrepositoryI18n(array('sourceCulture' => true) + $options), '__get'), $args);
      }

      return $value;
    }

    if (!empty($options['cultureFallback']) && null !== $value = call_user_func_array(array($this->getCurrentrepositoryI18n(array('sourceCulture' => true) + $options), '__get'), $args))
    {
      return $value;
    }
  }

  public function __set($name, $value)
  {
    $args = func_get_args();

    $options = array();
    if (2 < count($args))
    {
      $options = $args[2];
    }

    call_user_func_array(array($this, 'parent::__set'), $args);

    call_user_func_array(array($this->getCurrentrepositoryI18n($options), '__set'), $args);

    return $this;
  }

  public function __unset($name)
  {
    $args = func_get_args();

    $options = array();
    if (1 < count($args))
    {
      $options = $args[1];
    }

    call_user_func_array(array($this, 'parent::__unset'), $args);

    call_user_func_array(array($this->getCurrentrepositoryI18n($options), '__unset'), $args);

    return $this;
  }

  public function save($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::save($connection);

    foreach ($this->repositoryI18ns as $repositoryI18n)
    {
      $repositoryI18n->setid($this->id);

      $affectedRows += $repositoryI18n->save($connection);
    }

    return $affectedRows;
  }

  public static function addJointypeCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRepository::TYPE_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoindescStatusCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRepository::DESC_STATUS_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addJoindescDetailCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitRepository::DESC_DETAIL_ID, QubitTerm::ID);

    return $criteria;
  }

  public static function addinformationObjectsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitInformationObject::REPOSITORY_ID, $id);

    return $criteria;
  }

  public static function getinformationObjectsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addinformationObjectsCriteriaById($criteria, $id);

    return QubitInformationObject::get($criteria, $options);
  }

  public function addinformationObjectsCriteria(Criteria $criteria)
  {
    return self::addinformationObjectsCriteriaById($criteria, $this->id);
  }

  protected
    $informationObjects = null;

  public function getinformationObjects(array $options = array())
  {
    if (!isset($this->informationObjects))
    {
      if (!isset($this->id))
      {
        $this->informationObjects = QubitQuery::create();
      }
      else
      {
        $this->informationObjects = self::getinformationObjectsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->informationObjects;
  }

  public static function addrepositoryI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRepositoryI18n::ID, $id);

    return $criteria;
  }

  public static function getrepositoryI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addrepositoryI18nsCriteriaById($criteria, $id);

    return QubitRepositoryI18n::get($criteria, $options);
  }

  public function addrepositoryI18nsCriteria(Criteria $criteria)
  {
    return self::addrepositoryI18nsCriteriaById($criteria, $this->id);
  }

  protected
    $repositoryI18ns = null;

  public function getrepositoryI18ns(array $options = array())
  {
    if (!isset($this->repositoryI18ns))
    {
      if (!isset($this->id))
      {
        $this->repositoryI18ns = QubitQuery::create();
      }
      else
      {
        $this->repositoryI18ns = self::getrepositoryI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->repositoryI18ns;
  }

  public function getCurrentrepositoryI18n(array $options = array())
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
      if (!isset($this->id) || null === $repositoryI18n = QubitRepositoryI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $repositoryI18n = new QubitRepositoryI18n;
        $repositoryI18n->setculture($options['culture']);
      }
      $this->repositoryI18ns[$options['culture']] = $repositoryI18n;
    }

    return $this->repositoryI18ns[$options['culture']];
  }
}
