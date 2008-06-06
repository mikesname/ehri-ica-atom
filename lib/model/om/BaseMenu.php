<?php

abstract class BaseMenu
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_menu';

  const URL = 'q_menu.URL';
  const PARENT_ID = 'q_menu.PARENT_ID';
  const LFT = 'q_menu.LFT';
  const RGT = 'q_menu.RGT';
  const CREATED_AT = 'q_menu.CREATED_AT';
  const UPDATED_AT = 'q_menu.UPDATED_AT';
  const SOURCE_CULTURE = 'q_menu.SOURCE_CULTURE';
  const ID = 'q_menu.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitMenu::URL);
    $criteria->addSelectColumn(QubitMenu::PARENT_ID);
    $criteria->addSelectColumn(QubitMenu::LFT);
    $criteria->addSelectColumn(QubitMenu::RGT);
    $criteria->addSelectColumn(QubitMenu::CREATED_AT);
    $criteria->addSelectColumn(QubitMenu::UPDATED_AT);
    $criteria->addSelectColumn(QubitMenu::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitMenu::ID);

    return $criteria;
  }

  protected static $menus = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$menus[$id = $resultSet->getInt(8)]))
    {
      $menu = new QubitMenu;
      $menu->hydrate($resultSet);

      self::$menus[$id] = $menu;
    }

    return self::$menus[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitMenu::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitMenu', $options);
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
    $criteria->add(QubitMenu::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $url = null;

  public function getUrl()
  {
    return $this->url;
  }

  public function setUrl($url)
  {
    $this->url = $url;

    return $this;
  }

  protected $parentId = null;

  public function getParentId()
  {
    return $this->parentId;
  }

  public function setParentId($parentId)
  {
    $this->parentId = $parentId;

    return $this;
  }

  protected $lft = null;

  public function getLft()
  {
    return $this->lft;
  }

  public function setLft($lft)
  {
    $this->lft = $lft;

    return $this;
  }

  protected $rgt = null;

  public function getRgt()
  {
    return $this->rgt;
  }

  public function setRgt($rgt)
  {
    $this->rgt = $rgt;

    return $this;
  }

  protected $createdAt = null;

  public function getCreatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->createdAt);
    }

    return $this->createdAt;
  }

  public function setCreatedAt($createdAt)
  {
    if (is_string($createdAt) && false === $createdAt = strtotime($createdAt))
    {
      throw new PropelException('Unable to parse date / time value for [createdAt] from input: '.var_export($createdAt, true));
    }

    $this->createdAt = $createdAt;

    return $this;
  }

  protected $updatedAt = null;

  public function getUpdatedAt(array $options = array())
  {
    $options += array('format' => 'Y-m-d H:i:s');
    if (isset($options['format']))
    {
      return date($options['format'], $this->updatedAt);
    }

    return $this->updatedAt;
  }

  public function setUpdatedAt($updatedAt)
  {
    if (is_string($updatedAt) && false === $updatedAt = strtotime($updatedAt))
    {
      throw new PropelException('Unable to parse date / time value for [updatedAt] from input: '.var_export($updatedAt, true));
    }

    $this->updatedAt = $updatedAt;

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
    $this->columnValues['url'] = $this->url;
    $this->columnValues['parentId'] = $this->parentId;
    $this->columnValues['lft'] = $this->lft;
    $this->columnValues['rgt'] = $this->rgt;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->url = $results->getString($columnOffset++);
    $this->parentId = $results->getInt($columnOffset++);
    $this->lft = $results->getInt($columnOffset++);
    $this->rgt = $results->getInt($columnOffset++);
    $this->createdAt = $results->getTimestamp($columnOffset++, null);
    $this->updatedAt = $results->getTimestamp($columnOffset++, null);
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
      $options['connection'] = Propel::getConnection(QubitMenu::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitMenu::ID, $this->id);

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

    foreach ($this->menuI18ns as $menuI18n)
    {
      $menuI18n->setId($this->id);

      $affectedRows += $menuI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('url'))
    {
      $criteria->add(QubitMenu::URL, $this->url);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitMenu::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitMenu::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitMenu::RGT, $this->rgt);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitMenu::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitMenu::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitMenu::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitMenu::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
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

    if ($this->isColumnModified('url'))
    {
      $criteria->add(QubitMenu::URL, $this->url);
    }

    if ($this->isColumnModified('parentId'))
    {
      $criteria->add(QubitMenu::PARENT_ID, $this->parentId);
    }

    if ($this->isColumnModified('lft'))
    {
      $criteria->add(QubitMenu::LFT, $this->lft);
    }

    if ($this->isColumnModified('rgt'))
    {
      $criteria->add(QubitMenu::RGT, $this->rgt);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitMenu::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitMenu::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitMenu::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitMenu::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitMenu::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitMenu::DATABASE_NAME);
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
    $criteria->add(QubitMenu::ID, $this->id);

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

  public static function addMenuI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitMenuI18n::ID, $id);

    return $criteria;
  }

  public static function getMenuI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addMenuI18nsCriteriaById($criteria, $id);

    return QubitMenuI18n::get($criteria, $options);
  }

  public function addMenuI18nsCriteria(Criteria $criteria)
  {
    return self::addMenuI18nsCriteriaById($criteria, $this->id);
  }

  protected $menuI18ns = null;

  public function getMenuI18ns(array $options = array())
  {
    if (!isset($this->menuI18ns))
    {
      if (!isset($this->id))
      {
        $this->menuI18ns = QubitQuery::create();
      }
      else
      {
        $this->menuI18ns = self::getMenuI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->menuI18ns;
  }

  public function getName(array $options = array())
  {
    return $this->getCurrentMenuI18n($options)->getName();
  }

  public function setName($value, array $options = array())
  {
    $this->getCurrentMenuI18n($options)->setName($value);

    return $this;
  }

  public function getCurrentMenuI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->menuI18ns[$options['culture']]))
    {
      if (null === $menuI18n = QubitMenuI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $menuI18n = new QubitMenuI18n;
        $menuI18n->setCulture($options['culture']);
      }
      $this->menuI18ns[$options['culture']] = $menuI18n;
    }

    return $this->menuI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.MenuMapBuilder');
