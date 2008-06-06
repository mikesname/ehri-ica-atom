<?php

abstract class BaseContactInformationI18n
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_contact_information_i18n';

  const CONTACT_TYPE = 'q_contact_information_i18n.CONTACT_TYPE';
  const CITY = 'q_contact_information_i18n.CITY';
  const REGION = 'q_contact_information_i18n.REGION';
  const NOTE = 'q_contact_information_i18n.NOTE';
  const ID = 'q_contact_information_i18n.ID';
  const CULTURE = 'q_contact_information_i18n.CULTURE';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitContactInformationI18n::CONTACT_TYPE);
    $criteria->addSelectColumn(QubitContactInformationI18n::CITY);
    $criteria->addSelectColumn(QubitContactInformationI18n::REGION);
    $criteria->addSelectColumn(QubitContactInformationI18n::NOTE);
    $criteria->addSelectColumn(QubitContactInformationI18n::ID);
    $criteria->addSelectColumn(QubitContactInformationI18n::CULTURE);

    return $criteria;
  }

  protected static $contactInformationI18ns = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$contactInformationI18ns[$key = serialize(array($resultSet->getInt(5), $resultSet->getString(6)))]))
    {
      $contactInformationI18n = new QubitContactInformationI18n;
      $contactInformationI18n->hydrate($resultSet);

      self::$contactInformationI18ns[$key] = $contactInformationI18n;
    }

    return self::$contactInformationI18ns[$key];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitContactInformationI18n::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitContactInformationI18n', $options);
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
    $criteria->add(QubitContactInformationI18n::ID, $id);
    $criteria->add(QubitContactInformationI18n::CULTURE, $culture);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitContactInformationI18n::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $contactType = null;

  public function getContactType()
  {
    return $this->contactType;
  }

  public function setContactType($contactType)
  {
    $this->contactType = $contactType;

    return $this;
  }

  protected $city = null;

  public function getCity()
  {
    return $this->city;
  }

  public function setCity($city)
  {
    $this->city = $city;

    return $this;
  }

  protected $region = null;

  public function getRegion()
  {
    return $this->region;
  }

  public function setRegion($region)
  {
    $this->region = $region;

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
    $this->columnValues['contactType'] = $this->contactType;
    $this->columnValues['city'] = $this->city;
    $this->columnValues['region'] = $this->region;
    $this->columnValues['note'] = $this->note;
    $this->columnValues['id'] = $this->id;
    $this->columnValues['culture'] = $this->culture;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->contactType = $results->getString($columnOffset++);
    $this->city = $results->getString($columnOffset++);
    $this->region = $results->getString($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitContactInformationI18n::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitContactInformationI18n::ID, $this->id);
    $criteria->add(QubitContactInformationI18n::CULTURE, $this->culture);

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

    if ($this->isColumnModified('contactType'))
    {
      $criteria->add(QubitContactInformationI18n::CONTACT_TYPE, $this->contactType);
    }

    if ($this->isColumnModified('city'))
    {
      $criteria->add(QubitContactInformationI18n::CITY, $this->city);
    }

    if ($this->isColumnModified('region'))
    {
      $criteria->add(QubitContactInformationI18n::REGION, $this->region);
    }

    if ($this->isColumnModified('note'))
    {
      $criteria->add(QubitContactInformationI18n::NOTE, $this->note);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitContactInformationI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitContactInformationI18n::CULTURE, $this->culture);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitContactInformationI18n::DATABASE_NAME);
    }

    BasePeer::doInsert($criteria, $connection);
    $affectedRows += 1;

    return $affectedRows;
  }

  protected function update($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('contactType'))
    {
      $criteria->add(QubitContactInformationI18n::CONTACT_TYPE, $this->contactType);
    }

    if ($this->isColumnModified('city'))
    {
      $criteria->add(QubitContactInformationI18n::CITY, $this->city);
    }

    if ($this->isColumnModified('region'))
    {
      $criteria->add(QubitContactInformationI18n::REGION, $this->region);
    }

    if ($this->isColumnModified('note'))
    {
      $criteria->add(QubitContactInformationI18n::NOTE, $this->note);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitContactInformationI18n::ID, $this->id);
    }

    if ($this->isColumnModified('culture'))
    {
      $criteria->add(QubitContactInformationI18n::CULTURE, $this->culture);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitContactInformationI18n::ID, $this->id);
      $selectCriteria->add(QubitContactInformationI18n::CULTURE, $this->culture);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitContactInformationI18n::DATABASE_NAME);
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
    $criteria->add(QubitContactInformationI18n::ID, $this->id);
    $criteria->add(QubitContactInformationI18n::CULTURE, $this->culture);

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

  public static function addJoinContactInformationCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitContactInformationI18n::ID, QubitContactInformation::ID);

    return $criteria;
  }

  public function getContactInformation(array $options = array())
  {
    return $this->contactInformation = QubitContactInformation::getById($this->id, $options);
  }

  public function setContactInformation(QubitContactInformation $contactInformation)
  {
    $this->id = $contactInformation->getId();

    return $this;
  }
}

BasePeer::getMapBuilder('lib.model.map.ContactInformationI18nMapBuilder');
