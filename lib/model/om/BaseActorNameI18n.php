<?php

abstract class BaseActorNameI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_actor_name_i18n';

  const NAME = 'q_actor_name_i18n.NAME';
  const NOTE = 'q_actor_name_i18n.NOTE';
  const ID = 'q_actor_name_i18n.ID';
  const CULTURE = 'q_actor_name_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitActorNameI18n::NAME);
    $criteria->addSelectColumn(QubitActorNameI18n::NOTE);
    $criteria->addSelectColumn(QubitActorNameI18n::ID);
    $criteria->addSelectColumn(QubitActorNameI18n::CULTURE);

    return $criteria;
  }

  protected static $actorNameI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$actorNameI18ns[$key = serialize(array($resultSet->getInt(3), $resultSet->getString(4)))]))
    {
      $actorNameI18n = new QubitActorNameI18n;
      $actorNameI18n->hydrate($resultSet);

      self::$actorNameI18ns[$key] = $actorNameI18n;
    }

    return self::$actorNameI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitActorNameI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitActorNameI18n', $options);
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
    $criteria->add(QubitActorNameI18n::ID, $id);
    $criteria->add(QubitActorNameI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitActorNameI18n::DATABASE_NAME);
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

  protected $note = null;

  public function getNote()
  {
    return $this->note;
  }

  public function setNote($note)
  {
    $this->note = $note;

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
    $this->columnValues['note'] = $this->note;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->name = $results->getString($columnOffset++);
    $this->note = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitActorNameI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitActorNameI18n::ID, $this->id);
    $criteria->add(QubitActorNameI18n::CULTURE, $this->culture);

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
      $criteria->add(QubitActorNameI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('note'))
    {
      $criteria->add(QubitActorNameI18n::NOTE, $this->note);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActorNameI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitActorNameI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitActorNameI18n::DATABASE_NAME);
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
      $criteria->add(QubitActorNameI18n::NAME, $this->name);
    }

    if ($this->isColumnModified('note'))
    {
      $criteria->add(QubitActorNameI18n::NOTE, $this->note);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitActorNameI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitActorNameI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitActorNameI18n::ID, $this->id);
      $selectCriteria->add(QubitActorNameI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitActorNameI18n::DATABASE_NAME);
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
    $criteria->add(QubitActorNameI18n::ID, $this->id);
    $criteria->add(QubitActorNameI18n::CULTURE, $this->culture);

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

  public static function addJoinActorNameCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitActorNameI18n::ID, QubitActorName::ID);

    return $criteria;
  }

  public function getActorName(array $options = array())
  {
    return $this->actorName = QubitActorName::getById($this->id, $options);
  }

  public function setActorName(QubitActorName $actorName)
  {
    $this->id = $actorName->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.ActorNameI18nMapBuilder');
