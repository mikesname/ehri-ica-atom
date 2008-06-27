<?php

abstract class BaseSetting
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_setting';

  const NAME = 'q_setting.NAME';
  const SCOPE = 'q_setting.SCOPE';
  const EDITABLE = 'q_setting.EDITABLE';
  const DELETEABLE = 'q_setting.DELETEABLE';
  const SOURCE_CULTURE = 'q_setting.SOURCE_CULTURE';
  const ID = 'q_setting.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitSetting::NAME);
    $criteria->addSelectColumn(QubitSetting::SCOPE);
    $criteria->addSelectColumn(QubitSetting::EDITABLE);
    $criteria->addSelectColumn(QubitSetting::DELETEABLE);
    $criteria->addSelectColumn(QubitSetting::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitSetting::ID);

    return $criteria;
  }

  protected static $settings = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$settings[$id = $resultSet->getInt(6)]))
    {
      $setting = new QubitSetting;
      $setting->hydrate($resultSet);

      self::$settings[$id] = $setting;
    }

    return self::$settings[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitSetting::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitSetting', $options);
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
    $criteria->add(QubitSetting::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitSetting::DATABASE_NAME);
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

  protected $scope = null;

  public function getScope()
  {
    return $this->scope;
  }

  public function setScope($scope)
  {
    $this->scope = $scope;

    return $this;
  }

  protected $editable = '';

  public function getEditable()
  {
    return $this->editable;
  }

  public function setEditable($editable)
  {
    $this->editable = $editable;

    return $this;
  }

  protected $deleteable = '';

  public function getDeleteable()
  {
    return $this->deleteable;
  }

  public function setDeleteable($deleteable)
  {
    $this->deleteable = $deleteable;

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
    $this->columnValues['name'] = $this->name;
    $this->columnValues['scope'] = $this->scope;
    $this->columnValues['editable'] = $this->editable;
    $this->columnValues['deleteable'] = $this->deleteable;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->name = $results->getString($columnOffset++);
    $this->scope = $results->getString($columnOffset++);
    $this->editable = $results->getBoolean($columnOffset++);
    $this->deleteable = $results->getBoolean($columnOffset++);
    $this->sourceCulture = $results->getString($columnOffset++);
    $this->id = $results->getInt($columnOffset++);

    $this->new = false;
    $this->resetModified();

    return $columnOffset;
  }

  public function refresh(array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitSetting::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitSetting::ID, $this->id);

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

    foreach ($this->settingI18ns as $settingI18n)
    {
      $settingI18n->setId($this->id);

      $affectedRows += $settingI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitSetting::NAME, $this->name);
    }

    if ($this->isColumnModified('scope'))
    {
      $criteria->add(QubitSetting::SCOPE, $this->scope);
    }

    if ($this->isColumnModified('editable'))
    {
      $criteria->add(QubitSetting::EDITABLE, $this->editable);
    }

    if ($this->isColumnModified('deleteable'))
    {
      $criteria->add(QubitSetting::DELETEABLE, $this->deleteable);
    }

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitSetting::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitSetting::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitSetting::DATABASE_NAME);
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

    if ($this->isColumnModified('name'))
    {
      $criteria->add(QubitSetting::NAME, $this->name);
    }

    if ($this->isColumnModified('scope'))
    {
      $criteria->add(QubitSetting::SCOPE, $this->scope);
    }

    if ($this->isColumnModified('editable'))
    {
      $criteria->add(QubitSetting::EDITABLE, $this->editable);
    }

    if ($this->isColumnModified('deleteable'))
    {
      $criteria->add(QubitSetting::DELETEABLE, $this->deleteable);
    }

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitSetting::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitSetting::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitSetting::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitSetting::DATABASE_NAME);
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
    $criteria->add(QubitSetting::ID, $this->id);

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

  public static function addSettingI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitSettingI18n::ID, $id);

    return $criteria;
  }

  public static function getSettingI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addSettingI18nsCriteriaById($criteria, $id);

    return QubitSettingI18n::get($criteria, $options);
  }

  public function addSettingI18nsCriteria(Criteria $criteria)
  {
    return self::addSettingI18nsCriteriaById($criteria, $this->id);
  }

  protected $settingI18ns = null;

  public function getSettingI18ns(array $options = array())
  {
    if (!isset($this->settingI18ns))
    {
      if (!isset($this->id))
      {
        $this->settingI18ns = QubitQuery::create();
      }
      else
      {
        $this->settingI18ns = self::getSettingI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->settingI18ns;
  }

  public function getValue(array $options = array())
  {
    $value = $this->getCurrentSettingI18n($options)->getValue();
    if (!empty($options['cultureFallback']) && strlen($value) < 1)
    {
      $value = $this->getCurrentSettingI18n(array('sourceCulture' => true) + $options)->getValue();
    }

    return $value;
  }

  public function setValue($value, array $options = array())
  {
    $this->getCurrentSettingI18n($options)->setValue($value);

    return $this;
  }

  public function getCurrentSettingI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->settingI18ns[$options['culture']]))
    {
      if (null === $settingI18n = QubitSettingI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $settingI18n = new QubitSettingI18n;
        $settingI18n->setCulture($options['culture']);
      }
      $this->settingI18ns[$options['culture']] = $settingI18n;
    }

    return $this->settingI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.SettingMapBuilder');
