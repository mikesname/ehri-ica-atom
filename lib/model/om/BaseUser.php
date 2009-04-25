<?php

abstract class BaseUser extends QubitActor implements ArrayAccess
{
  const
    DATABASE_NAME = 'propel',

    TABLE_NAME = 'q_user',

    ID = 'q_user.ID',
    USERNAME = 'q_user.USERNAME',
    EMAIL = 'q_user.EMAIL',
    SHA1_PASSWORD = 'q_user.SHA1_PASSWORD',
    SALT = 'q_user.SALT';

  public static function addSelectColumns(Criteria $criteria)
  {
    parent::addSelectColumns($criteria);

    $criteria->addJoin(QubitUser::ID, QubitActor::ID);

    $criteria->addSelectColumn(QubitUser::ID);
    $criteria->addSelectColumn(QubitUser::USERNAME);
    $criteria->addSelectColumn(QubitUser::EMAIL);
    $criteria->addSelectColumn(QubitUser::SHA1_PASSWORD);
    $criteria->addSelectColumn(QubitUser::SALT);

    return $criteria;
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitUser::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitUser', $options);
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
    $criteria->add(QubitUser::ID, $id);

    if (1 == count($query = self::get($criteria, $options)))
    {
      return $query[0];
    }
  }

  public function __construct()
  {
    parent::__construct();

    $this->tables[] = Propel::getDatabaseMap(QubitUser::DATABASE_NAME)->getTable(QubitUser::TABLE_NAME);
  }

  public static function addnotesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::USER_ID, $id);

    return $criteria;
  }

  public static function getnotesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addnotesCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addnotesCriteria(Criteria $criteria)
  {
    return self::addnotesCriteriaById($criteria, $this->id);
  }

  protected
    $notes = null;

  public function getnotes(array $options = array())
  {
    if (!isset($this->notes))
    {
      if (!isset($this->id))
      {
        $this->notes = QubitQuery::create();
      }
      else
      {
        $this->notes = self::getnotesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notes;
  }

  public static function addpermissionScopesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPermissionScope::USER_ID, $id);

    return $criteria;
  }

  public static function getpermissionScopesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addpermissionScopesCriteriaById($criteria, $id);

    return QubitPermissionScope::get($criteria, $options);
  }

  public function addpermissionScopesCriteria(Criteria $criteria)
  {
    return self::addpermissionScopesCriteriaById($criteria, $this->id);
  }

  protected
    $permissionScopes = null;

  public function getpermissionScopes(array $options = array())
  {
    if (!isset($this->permissionScopes))
    {
      if (!isset($this->id))
      {
        $this->permissionScopes = QubitQuery::create();
      }
      else
      {
        $this->permissionScopes = self::getpermissionScopesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->permissionScopes;
  }

  public static function addsystemEventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitSystemEvent::USER_ID, $id);

    return $criteria;
  }

  public static function getsystemEventsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addsystemEventsCriteriaById($criteria, $id);

    return QubitSystemEvent::get($criteria, $options);
  }

  public function addsystemEventsCriteria(Criteria $criteria)
  {
    return self::addsystemEventsCriteriaById($criteria, $this->id);
  }

  protected
    $systemEvents = null;

  public function getsystemEvents(array $options = array())
  {
    if (!isset($this->systemEvents))
    {
      if (!isset($this->id))
      {
        $this->systemEvents = QubitQuery::create();
      }
      else
      {
        $this->systemEvents = self::getsystemEventsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->systemEvents;
  }

  public static function adduserRoleRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitUserRoleRelation::USER_ID, $id);

    return $criteria;
  }

  public static function getuserRoleRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::adduserRoleRelationsCriteriaById($criteria, $id);

    return QubitUserRoleRelation::get($criteria, $options);
  }

  public function adduserRoleRelationsCriteria(Criteria $criteria)
  {
    return self::adduserRoleRelationsCriteriaById($criteria, $this->id);
  }

  protected
    $userRoleRelations = null;

  public function getuserRoleRelations(array $options = array())
  {
    if (!isset($this->userRoleRelations))
    {
      if (!isset($this->id))
      {
        $this->userRoleRelations = QubitQuery::create();
      }
      else
      {
        $this->userRoleRelations = self::getuserRoleRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->userRoleRelations;
  }
}
