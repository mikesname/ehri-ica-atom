<?php

abstract class BasePermission
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_permission';

  const MODULE = 'q_permission.MODULE';
  const ACTION = 'q_permission.ACTION';
  const ID = 'q_permission.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitPermission::MODULE);
    $criteria->addSelectColumn(QubitPermission::ACTION);
    $criteria->addSelectColumn(QubitPermission::ID);

    return $criteria;
  }

  protected static $permissions = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$permissions[$id = $resultSet->getInt(3)]))
    {
      $permission = new QubitPermission;
      $permission->hydrate($resultSet);

      self::$permissions[$id] = $permission;
    }

    return self::$permissions[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPermission::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitPermission', $options);
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
    $criteria->add(QubitPermission::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPermission::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $module = null;

  public function getModule()
  {
    return $this->module;
  }

  public function setModule($module)
  {
    $this->module = $module;

    return $this;
  }

  protected $action = null;

  public function getAction()
  {
    return $this->action;
  }

  public function setAction($action)
  {
    $this->action = $action;

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

  protected $new = true;

  protected $deleted = false;

  protected $columnValues = null;

  protected function isColumnModified($name)
  {
    return $this->$name != $this->columnValues[$name];
  }

  protected function resetModified()
  {
    $this->columnValues['module'] = $this->module;
    $this->columnValues['action'] = $this->action;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->module = $results->getString($columnOffset++);
    $this->action = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitPermission::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitPermission::ID, $this->id);

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

    if ($this->isColumnModified('module'))
    {
      $criteria->add(QubitPermission::MODULE, $this->module);
    }

    if ($this->isColumnModified('action'))
    {
      $criteria->add(QubitPermission::ACTION, $this->action);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPermission::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitPermission::DATABASE_NAME);
    }

    $id = BasePeer::doInsert($criteria, $connection);
    $this->id = $id;
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('module'))
    {
      $criteria->add(QubitPermission::MODULE, $this->module);
    }

    if ($this->isColumnModified('action'))
    {
      $criteria->add(QubitPermission::ACTION, $this->action);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitPermission::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitPermission::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitPermission::DATABASE_NAME);
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
    $criteria->add(QubitPermission::ID, $this->id);

    $affectedRows += self::doDelete($criteria, $connection);

    $this->deleted = true;

    return $affectedRows;
  }

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

  public static function addRolePermissionRelationsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitRolePermissionRelation::PERMISSION_ID, $id);

    return $criteria;
  }

  public static function getRolePermissionRelationsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addRolePermissionRelationsCriteriaById($criteria, $id);

    return QubitRolePermissionRelation::get($criteria, $options);
  }

  public function addRolePermissionRelationsCriteria(Criteria $criteria)
  {
    return self::addRolePermissionRelationsCriteriaById($criteria, $this->id);
  }

  protected $rolePermissionRelations = null;

  public function getRolePermissionRelations(array $options = array())
  {
    if (!isset($this->rolePermissionRelations))
    {
      if (!isset($this->id))
      {
        $this->rolePermissionRelations = QubitQuery::create();
      }
      else
      {
        $this->rolePermissionRelations = self::getRolePermissionRelationsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->rolePermissionRelations;
  }

  public static function addPermissionScopesCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitPermissionScope::PERMISSION_ID, $id);

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

BasePeer::getMapBuilder('lib.model.map.PermissionMapBuilder');
