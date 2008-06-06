<?php

abstract class BaseUser extends QubitActor
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_user';

  const ID = 'q_user.ID';
  const USERNAME = 'q_user.USERNAME';
  const EMAIL = 'q_user.EMAIL';
  const SHA1_PASSWORD = 'q_user.SHA1_PASSWORD';
  const SALT = 'q_user.SALT';

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

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  protected $username = null;

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($username)
  {
    $this->username = $username;

    return $this;
  }

  protected $email = null;

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  protected $sha1Password = null;

  public function getSha1Password()
  {
    return $this->sha1Password;
  }

  public function setSha1Password($sha1Password)
  {
    $this->sha1Password = $sha1Password;

    return $this;
  }

  protected $salt = null;

  public function getSalt()
  {
    return $this->salt;
  }

  public function setSalt($salt)
  {
    $this->salt = $salt;

    return $this;
  }

  protected function resetModified()
  {
    parent::resetModified();

    $this->columnValues['id'] = $this->id;
    $this->columnValues['username'] = $this->username;
    $this->columnValues['email'] = $this->email;
    $this->columnValues['sha1Password'] = $this->sha1Password;
    $this->columnValues['salt'] = $this->salt;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $columnOffset = parent::hydrate($results, $columnOffset);

    $this->id = $results->getInt($columnOffset++);
    $this->username = $results->getString($columnOffset++);
    $this->email = $results->getString($columnOffset++);
    $this->sha1Password = $results->getString($columnOffset++);
    $this->salt = $results->getString($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitUser::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitUser::ID, $this->id);

    self::addSelectColumns($criteria);

    $resultSet = BasePeer::doSelect($criteria, $options['connection']);
    $resultSet->next();

    return $this->hydrate($resultSet);
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $affectedRows += parent::insert($connection);

    $criteria = new Criteria;

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitUser::ID, $this->id);
    }

    if ($this->isColumnModified('username'))
    {
      $criteria->add(QubitUser::USERNAME, $this->username);
    }

    if ($this->isColumnModified('email'))
    {
      $criteria->add(QubitUser::EMAIL, $this->email);
    }

    if ($this->isColumnModified('sha1Password'))
    {
      $criteria->add(QubitUser::SHA1_PASSWORD, $this->sha1Password);
    }

    if ($this->isColumnModified('salt'))
    {
      $criteria->add(QubitUser::SALT, $this->salt);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitUser::DATABASE_NAME);
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
      $criteria->add(QubitUser::ID, $this->id);
    }

    if ($this->isColumnModified('username'))
    {
      $criteria->add(QubitUser::USERNAME, $this->username);
    }

    if ($this->isColumnModified('email'))
    {
      $criteria->add(QubitUser::EMAIL, $this->email);
    }

    if ($this->isColumnModified('sha1Password'))
    {
      $criteria->add(QubitUser::SHA1_PASSWORD, $this->sha1Password);
    }

    if ($this->isColumnModified('salt'))
    {
      $criteria->add(QubitUser::SALT, $this->salt);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitUser::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitUser::DATABASE_NAME);
      }

      $affectedRows += BasePeer::doUpdate($selectCriteria, $criteria, $connection);
    }

    return $affectedRows;
  }

  public static function addNotesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitNote::USER_ID, $id);

    return $criteria;
  }

  public static function getNotesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addNotesCriteriaById($criteria, $id);

    return QubitNote::get($criteria, $options);
  }

  public function addNotesCriteria(Criteria $criteria)
  {
    return self::addNotesCriteriaById($criteria, $this->id);
  }

  protected $notes = null;

  public function getNotes(array $options = array())
  {
    if (!isset($this->notes))
    {
      if (!isset($this->id))
      {
        $this->notes = QubitQuery::create();
      }
      else
      {
        $this->notes = self::getNotesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->notes;
  }

  public static function addSystemEventsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitSystemEvent::USER_ID, $id);

    return $criteria;
  }

  public static function getSystemEventsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addSystemEventsCriteriaById($criteria, $id);

    return QubitSystemEvent::get($criteria, $options);
  }

  public function addSystemEventsCriteria(Criteria $criteria)
  {
    return self::addSystemEventsCriteriaById($criteria, $this->id);
  }

  protected $systemEvents = null;

  public function getSystemEvents(array $options = array())
  {
    if (!isset($this->systemEvents))
    {
      if (!isset($this->id))
      {
        $this->systemEvents = QubitQuery::create();
      }
      else
      {
        $this->systemEvents = self::getSystemEventsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->systemEvents;
  }

  public static function addUserRoleRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitUserRoleRelation::USER_ID, $id);

    return $criteria;
  }

  public static function getUserRoleRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addUserRoleRelationsCriteriaById($criteria, $id);

    return QubitUserRoleRelation::get($criteria, $options);
  }

  public function addUserRoleRelationsCriteria(Criteria $criteria)
  {
    return self::addUserRoleRelationsCriteriaById($criteria, $this->id);
  }

  protected $userRoleRelations = null;

  public function getUserRoleRelations(array $options = array())
  {
    if (!isset($this->userRoleRelations))
    {
      if (!isset($this->id))
      {
        $this->userRoleRelations = QubitQuery::create();
      }
      else
      {
        $this->userRoleRelations = self::getUserRoleRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->userRoleRelations;
  }

  public static function addPermissionScopesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPermissionScope::USER_ID, $id);

    return $criteria;
  }

  public static function getPermissionScopesById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addPermissionScopesCriteriaById($criteria, $id);

    return QubitPermissionScope::get($criteria, $options);
  }

  public function addPermissionScopesCriteria(Criteria $criteria)
  {
    return self::addPermissionScopesCriteriaById($criteria, $this->id);
  }

  protected $permissionScopes = null;

  public function getPermissionScopes(array $options = array())
  {
    if (!isset($this->permissionScopes))
    {
      if (!isset($this->id))
      {
        $this->permissionScopes = QubitQuery::create();
      }
      else
      {
        $this->permissionScopes = self::getPermissionScopesById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->permissionScopes;
  }
}

BasePeer::getMapBuilder('lib.model.map.UserMapBuilder');
