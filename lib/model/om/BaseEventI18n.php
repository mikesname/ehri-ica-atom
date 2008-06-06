<?php

abstract class BaseEventI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_event_i18n';

  const NAME = 'q_event_i18n.NAME';
  const DESCRIPTION = 'q_event_i18n.DESCRIPTION';
  const DATE_DISPLAY = 'q_event_i18n.DATE_DISPLAY';
  const ID = 'q_event_i18n.ID';
  const CULTURE = 'q_event_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitEventI18n::NAME);
    $criteria->addSelectColumn(QubitEventI18n::DESCRIPTION);
    $criteria->addSelectColumn(QubitEventI18n::DATE_DISPLAY);
    $criteria->addSelectColumn(QubitEventI18n::ID);
    $criteria->addSelectColumn(QubitEventI18n::CULTURE);

    return $criteria;
  }

  protected static $eventI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$eventI18ns[$key = serialize(array($resultSet->getInt(4), $resultSet->getString(5)))]))
    {
      $eventI18n = new QubitEventI18n;
      $eventI18n->hydrate($resultSet);

      self::$eventI18ns[$key] = $eventI18n;
    }

    return self::$eventI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitEventI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitEventI18n', $options);
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
    $criteria->add(QubitEventI18n::ID, $id);
    $criteria->add(QubitEventI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitEventI18n::DATABASE_NAME);
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

  protected $dateDisplay = null;

  public function getDateDisplay()
  {
    return $this->dateDisplay;
  }

  public function setDateDisplay($dateDisplay)
  {
    $this->dateDisplay = $dateDisplay;

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
    $this->columnValues['description'] = $this->description;
    $this->columnValues['dateDisplay'] = $this->dateDisplay;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->name = $results->getString($columnOffset++);
    $this->description = $results->getString($columnOffset++);
    $this->dateDisplay = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitEventI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitEventI18n::ID, $this->id);
    $criteria->add(QubitEventI18n::CULTURE, $this->culture);

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
      $criteria->add(QubitEventI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitEventI18n::DESCRIPTION, $this->description);
    }

    if ($this->isColumnModified('dateDisplay'))
    {
      $criteria->add(QubitEventI18n::DATE_DISPLAY, $this->dateDisplay);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitEventI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitEventI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitEventI18n::DATABASE_NAME);
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
      $criteria->add(QubitEventI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('description'))
    {
      $criteria->add(QubitEventI18n::DESCRIPTION, $this->description);
    }

    if ($this->isColumnModified('dateDisplay'))
    {
      $criteria->add(QubitEventI18n::DATE_DISPLAY, $this->dateDisplay);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitEventI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitEventI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitEventI18n::ID, $this->id);
      $selectCriteria->add(QubitEventI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitEventI18n::DATABASE_NAME);
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
    $criteria->add(QubitEventI18n::ID, $this->id);
    $criteria->add(QubitEventI18n::CULTURE, $this->culture);

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

  public static function addJoinEventCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitEventI18n::ID, QubitEvent::ID);

    return $criteria;
  }

  public function getEvent(array $options = array())
  {
    return $this->event = QubitEvent::getById($this->id, $options);
  }

  public function setEvent(QubitEvent $event)
  {
    $this->id = $event->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.EventI18nMapBuilder');
