<?php

abstract class BaseMapI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_map_i18n';

  const TITLE = 'q_map_i18n.TITLE';
  const DESCRIPTION = 'q_map_i18n.DESCRIPTION';
  const ID = 'q_map_i18n.ID';
  const CULTURE = 'q_map_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitMapI18n::TITLE);
    $criteria->addSelectColumn(QubitMapI18n::DESCRIPTION);
    $criteria->addSelectColumn(QubitMapI18n::ID);
    $criteria->addSelectColumn(QubitMapI18n::CULTURE);

    return $criteria;
  }

  protected static $mapI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$mapI18ns[$key = serialize(array($resultSet->getInt(3), $resultSet->getString(4)))]))
    {
      $mapI18n = new QubitMapI18n;
      $mapI18n->hydrate($resultSet);

      self::$mapI18ns[$key] = $mapI18n;
    }

    return self::$mapI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitMapI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitMapI18n', $options);
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
    $criteria->add(QubitMapI18n::ID, $id);
    $criteria->add(QubitMapI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMapI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $title = null;

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  protected $description = null;

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($description)
  {
    $this->description = $description;

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
    $this->columnValues['title'] = $this->title;
    $this->columnValues['description'] = $this->description;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->title = $results->getString($columnOffset++);
    $this->description = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitMapI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitMapI18n::ID, $this->id);
    $criteria->add(QubitMapI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('title'))
    {
      $criteria->add(QubitMapI18n::TITLE, $this->title);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitMapI18n::DESCRIPTION, $this->description);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitMapI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitMapI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitMapI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('title'))
    {
      $criteria->add(QubitMapI18n::TITLE, $this->title);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitMapI18n::DESCRIPTION, $this->description);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitMapI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitMapI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitMapI18n::ID, $this->id);
      $selectCriteria->add(QubitMapI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitMapI18n::DATABASE_NAME);
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
    $criteria->add(QubitMapI18n::ID, $this->id);
    $criteria->add(QubitMapI18n::CULTURE, $this->culture);

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

  public static function addJoinMapCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitMapI18n::ID, QubitMap::ID);

    return $criteria;
  }

  public function getMap(array $options = array())
  {
    return $this->map = QubitMap::getById($this->id, $options);
  }

  public function setMap(QubitMap $map)
  {
    $this->id = $map->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.MapI18nMapBuilder');
