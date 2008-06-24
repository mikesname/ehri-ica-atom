<?php

abstract class BaseContactInformation
{
  const DATABASE_NAME = 'propel';

  const TABLE_NAME = 'q_contact_information';

  const ACTOR_ID = 'q_contact_information.ACTOR_ID';
  const PRIMARY_CONTACT = 'q_contact_information.PRIMARY_CONTACT';
  const CONTACT_PERSON = 'q_contact_information.CONTACT_PERSON';
  const STREET_ADDRESS = 'q_contact_information.STREET_ADDRESS';
  const WEBSITE = 'q_contact_information.WEBSITE';
  const EMAIL = 'q_contact_information.EMAIL';
  const TELEPHONE = 'q_contact_information.TELEPHONE';
  const FAX = 'q_contact_information.FAX';
  const POSTAL_CODE = 'q_contact_information.POSTAL_CODE';
  const COUNTRY_CODE = 'q_contact_information.COUNTRY_CODE';
  const LONGTITUDE = 'q_contact_information.LONGTITUDE';
  const LATITUDE = 'q_contact_information.LATITUDE';
  const CREATED_AT = 'q_contact_information.CREATED_AT';
  const UPDATED_AT = 'q_contact_information.UPDATED_AT';
  const SOURCE_CULTURE = 'q_contact_information.SOURCE_CULTURE';
  const ID = 'q_contact_information.ID';

  public static function addSelectColumns(Criteria $criteria)
  {
    $criteria->addSelectColumn(QubitContactInformation::ACTOR_ID);
    $criteria->addSelectColumn(QubitContactInformation::PRIMARY_CONTACT);
    $criteria->addSelectColumn(QubitContactInformation::CONTACT_PERSON);
    $criteria->addSelectColumn(QubitContactInformation::STREET_ADDRESS);
    $criteria->addSelectColumn(QubitContactInformation::WEBSITE);
    $criteria->addSelectColumn(QubitContactInformation::EMAIL);
    $criteria->addSelectColumn(QubitContactInformation::TELEPHONE);
    $criteria->addSelectColumn(QubitContactInformation::FAX);
    $criteria->addSelectColumn(QubitContactInformation::POSTAL_CODE);
    $criteria->addSelectColumn(QubitContactInformation::COUNTRY_CODE);
    $criteria->addSelectColumn(QubitContactInformation::LONGTITUDE);
    $criteria->addSelectColumn(QubitContactInformation::LATITUDE);
    $criteria->addSelectColumn(QubitContactInformation::CREATED_AT);
    $criteria->addSelectColumn(QubitContactInformation::UPDATED_AT);
    $criteria->addSelectColumn(QubitContactInformation::SOURCE_CULTURE);
    $criteria->addSelectColumn(QubitContactInformation::ID);

    return $criteria;
  }

  protected static $contactInformations = array();

  public static function getFromResultSet(ResultSet $resultSet)
  {
    if (!isset(self::$contactInformations[$id = $resultSet->getInt(16)]))
    {
      $contactInformation = new QubitContactInformation;
      $contactInformation->hydrate($resultSet);

      self::$contactInformations[$id] = $contactInformation;
    }

    return self::$contactInformations[$id];
  }

  public static function get(Criteria $criteria, array $options = array())
  {
    if (!isset($options['connection']))
    {
      $options['connection'] = Propel::getConnection(QubitContactInformation::DATABASE_NAME);
    }

    self::addSelectColumns($criteria);

    return QubitQuery::createFromCriteria($criteria, 'QubitContactInformation', $options);
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
    $criteria->add(QubitContactInformation::ID, $id);

    return self::get($criteria, $options)->offsetGet(0, array('defaultValue' => null));
  }

  public static function doDelete(Criteria $criteria, $connection = null)
  {
    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitContactInformation::DATABASE_NAME);
    }

    $affectedRows = 0;

    $affectedRows += BasePeer::doDelete($criteria, $connection);

    return $affectedRows;
  }

  protected $actorId = null;

  public function getActorId()
  {
    return $this->actorId;
  }

  public function setActorId($actorId)
  {
    $this->actorId = $actorId;

    return $this;
  }

  protected $primaryContact = null;

  public function getPrimaryContact()
  {
    return $this->primaryContact;
  }

  public function setPrimaryContact($primaryContact)
  {
    $this->primaryContact = $primaryContact;

    return $this;
  }

  protected $contactPerson = null;

  public function getContactPerson()
  {
    return $this->contactPerson;
  }

  public function setContactPerson($contactPerson)
  {
    $this->contactPerson = $contactPerson;

    return $this;
  }

  protected $streetAddress = null;

  public function getStreetAddress()
  {
    return $this->streetAddress;
  }

  public function setStreetAddress($streetAddress)
  {
    $this->streetAddress = $streetAddress;

    return $this;
  }

  protected $website = null;

  public function getWebsite()
  {
    return $this->website;
  }

  public function setWebsite($website)
  {
    $this->website = $website;

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

  protected $telephone = null;

  public function getTelephone()
  {
    return $this->telephone;
  }

  public function setTelephone($telephone)
  {
    $this->telephone = $telephone;

    return $this;
  }

  protected $fax = null;

  public function getFax()
  {
    return $this->fax;
  }

  public function setFax($fax)
  {
    $this->fax = $fax;

    return $this;
  }

  protected $postalCode = null;

  public function getPostalCode()
  {
    return $this->postalCode;
  }

  public function setPostalCode($postalCode)
  {
    $this->postalCode = $postalCode;

    return $this;
  }

  protected $countryCode = null;

  public function getCountryCode()
  {
    return $this->countryCode;
  }

  public function setCountryCode($countryCode)
  {
    $this->countryCode = $countryCode;

    return $this;
  }

  protected $longtitude = null;

  public function getLongtitude()
  {
    return $this->longtitude;
  }

  public function setLongtitude($longtitude)
  {
    $this->longtitude = $longtitude;

    return $this;
  }

  protected $latitude = null;

  public function getLatitude()
  {
    return $this->latitude;
  }

  public function setLatitude($latitude)
  {
    $this->latitude = $latitude;

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
    $this->columnValues['actorId'] = $this->actorId;
    $this->columnValues['primaryContact'] = $this->primaryContact;
    $this->columnValues['contactPerson'] = $this->contactPerson;
    $this->columnValues['streetAddress'] = $this->streetAddress;
    $this->columnValues['website'] = $this->website;
    $this->columnValues['email'] = $this->email;
    $this->columnValues['telephone'] = $this->telephone;
    $this->columnValues['fax'] = $this->fax;
    $this->columnValues['postalCode'] = $this->postalCode;
    $this->columnValues['countryCode'] = $this->countryCode;
    $this->columnValues['longtitude'] = $this->longtitude;
    $this->columnValues['latitude'] = $this->latitude;
    $this->columnValues['createdAt'] = $this->createdAt;
    $this->columnValues['updatedAt'] = $this->updatedAt;
    $this->columnValues['sourceCulture'] = $this->sourceCulture;
    $this->columnValues['id'] = $this->id;

    return $this;
  }

  public function hydrate(ResultSet $results, $columnOffset = 1)
  {
    $this->actorId = $results->getInt($columnOffset++);
    $this->primaryContact = $results->getBoolean($columnOffset++);
    $this->contactPerson = $results->getString($columnOffset++);
    $this->streetAddress = $results->getString($columnOffset++);
    $this->website = $results->getString($columnOffset++);
    $this->email = $results->getString($columnOffset++);
    $this->telephone = $results->getString($columnOffset++);
    $this->fax = $results->getString($columnOffset++);
    $this->postalCode = $results->getString($columnOffset++);
    $this->countryCode = $results->getString($columnOffset++);
    $this->longtitude = $results->getFloat($columnOffset++);
    $this->latitude = $results->getFloat($columnOffset++);
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
      $options['connection'] = Propel::getConnection(QubitContactInformation::DATABASE_NAME);
    }

    $criteria = new Criteria;
    $criteria->add(QubitContactInformation::ID, $this->id);

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

    foreach ($this->contactInformationI18ns as $contactInformationI18n)
    {
      $contactInformationI18n->setId($this->id);

      $affectedRows += $contactInformationI18n->save($connection);
    }

    return $affectedRows;
  }

  protected function insert($connection = null)
  {
    $affectedRows = 0;

    $criteria = new Criteria;

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitContactInformation::ACTOR_ID, $this->actorId);
    }

    if ($this->isColumnModified('primaryContact'))
    {
      $criteria->add(QubitContactInformation::PRIMARY_CONTACT, $this->primaryContact);
    }

    if ($this->isColumnModified('contactPerson'))
    {
      $criteria->add(QubitContactInformation::CONTACT_PERSON, $this->contactPerson);
    }

    if ($this->isColumnModified('streetAddress'))
    {
      $criteria->add(QubitContactInformation::STREET_ADDRESS, $this->streetAddress);
    }

    if ($this->isColumnModified('website'))
    {
      $criteria->add(QubitContactInformation::WEBSITE, $this->website);
    }

    if ($this->isColumnModified('email'))
    {
      $criteria->add(QubitContactInformation::EMAIL, $this->email);
    }

    if ($this->isColumnModified('telephone'))
    {
      $criteria->add(QubitContactInformation::TELEPHONE, $this->telephone);
    }

    if ($this->isColumnModified('fax'))
    {
      $criteria->add(QubitContactInformation::FAX, $this->fax);
    }

    if ($this->isColumnModified('postalCode'))
    {
      $criteria->add(QubitContactInformation::POSTAL_CODE, $this->postalCode);
    }

    if ($this->isColumnModified('countryCode'))
    {
      $criteria->add(QubitContactInformation::COUNTRY_CODE, $this->countryCode);
    }

    if ($this->isColumnModified('longtitude'))
    {
      $criteria->add(QubitContactInformation::LONGTITUDE, $this->longtitude);
    }

    if ($this->isColumnModified('latitude'))
    {
      $criteria->add(QubitContactInformation::LATITUDE, $this->latitude);
    }

    if (!$this->isColumnModified('createdAt'))
    {
      $this->createdAt = time();
    }
    $criteria->add(QubitContactInformation::CREATED_AT, $this->createdAt);

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitContactInformation::UPDATED_AT, $this->updatedAt);

    if (!$this->isColumnModified('sourceCulture'))
    {
      $this->sourceCulture = sfPropel::getDefaultCulture();
    }
    $criteria->add(QubitContactInformation::SOURCE_CULTURE, $this->sourceCulture);

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitContactInformation::ID, $this->id);
    }

    if (!isset($connection))
    {
      $connection = QubitTransactionFilter::getConnection(QubitContactInformation::DATABASE_NAME);
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

    if ($this->isColumnModified('actorId'))
    {
      $criteria->add(QubitContactInformation::ACTOR_ID, $this->actorId);
    }

    if ($this->isColumnModified('primaryContact'))
    {
      $criteria->add(QubitContactInformation::PRIMARY_CONTACT, $this->primaryContact);
    }

    if ($this->isColumnModified('contactPerson'))
    {
      $criteria->add(QubitContactInformation::CONTACT_PERSON, $this->contactPerson);
    }

    if ($this->isColumnModified('streetAddress'))
    {
      $criteria->add(QubitContactInformation::STREET_ADDRESS, $this->streetAddress);
    }

    if ($this->isColumnModified('website'))
    {
      $criteria->add(QubitContactInformation::WEBSITE, $this->website);
    }

    if ($this->isColumnModified('email'))
    {
      $criteria->add(QubitContactInformation::EMAIL, $this->email);
    }

    if ($this->isColumnModified('telephone'))
    {
      $criteria->add(QubitContactInformation::TELEPHONE, $this->telephone);
    }

    if ($this->isColumnModified('fax'))
    {
      $criteria->add(QubitContactInformation::FAX, $this->fax);
    }

    if ($this->isColumnModified('postalCode'))
    {
      $criteria->add(QubitContactInformation::POSTAL_CODE, $this->postalCode);
    }

    if ($this->isColumnModified('countryCode'))
    {
      $criteria->add(QubitContactInformation::COUNTRY_CODE, $this->countryCode);
    }

    if ($this->isColumnModified('longtitude'))
    {
      $criteria->add(QubitContactInformation::LONGTITUDE, $this->longtitude);
    }

    if ($this->isColumnModified('latitude'))
    {
      $criteria->add(QubitContactInformation::LATITUDE, $this->latitude);
    }

    if ($this->isColumnModified('createdAt'))
    {
      $criteria->add(QubitContactInformation::CREATED_AT, $this->createdAt);
    }

    if (!$this->isColumnModified('updatedAt'))
    {
      $this->updatedAt = time();
    }
    $criteria->add(QubitContactInformation::UPDATED_AT, $this->updatedAt);

    if ($this->isColumnModified('sourceCulture'))
    {
      $criteria->add(QubitContactInformation::SOURCE_CULTURE, $this->sourceCulture);
    }

    if ($this->isColumnModified('id'))
    {
      $criteria->add(QubitContactInformation::ID, $this->id);
    }

    if ($criteria->size() > 0)
    {
      $selectCriteria = new Criteria;
      $selectCriteria->add(QubitContactInformation::ID, $this->id);

      if (!isset($connection))
      {
        $connection = QubitTransactionFilter::getConnection(QubitContactInformation::DATABASE_NAME);
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
    $criteria->add(QubitContactInformation::ID, $this->id);

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

  public static function addJoinActorCriteria(Criteria $criteria)
  {
    $criteria->addJoin(QubitContactInformation::ACTOR_ID, QubitActor::ID);

    return $criteria;
  }

  public function getActor(array $options = array())
  {
    return $this->actor = QubitActor::getById($this->actorId, $options);
  }

  public function setActor(QubitActor $actor)
  {
    $this->actorId = $actor->getId();

    return $this;
  }

  public static function addContactInformationI18nsCriteriaById(Criteria $criteria, $id)
  {
    $criteria->add(QubitContactInformationI18n::ID, $id);

    return $criteria;
  }

  public static function getContactInformationI18nsById($id, array $options = array())
  {
    $criteria = new Criteria;
    self::addContactInformationI18nsCriteriaById($criteria, $id);

    return QubitContactInformationI18n::get($criteria, $options);
  }

  public function addContactInformationI18nsCriteria(Criteria $criteria)
  {
    return self::addContactInformationI18nsCriteriaById($criteria, $this->id);
  }

  protected $contactInformationI18ns = null;

  public function getContactInformationI18ns(array $options = array())
  {
    if (!isset($this->contactInformationI18ns))
    {
      if (!isset($this->id))
      {
        $this->contactInformationI18ns = QubitQuery::create();
      }
      else
      {
        $this->contactInformationI18ns = self::getContactInformationI18nsById($this->id, array('self' => $this) + $options);
      }
    }

    return $this->contactInformationI18ns;
  }

  public function getContactType(array $options = array())
  {
    $contactType = $this->getCurrentContactInformationI18n($options)->getContactType();
    if (!empty($options['cultureFallback']) && $contactType === null)
    {
      $contactType = $this->getCurrentContactInformationI18n(array('sourceCulture' => true) + $options)->getContactType();
    }

    return $contactType;
  }

  public function setContactType($value, array $options = array())
  {
    $this->getCurrentContactInformationI18n($options)->setContactType($value);

    return $this;
  }

  public function getCity(array $options = array())
  {
    $city = $this->getCurrentContactInformationI18n($options)->getCity();
    if (!empty($options['cultureFallback']) && $city === null)
    {
      $city = $this->getCurrentContactInformationI18n(array('sourceCulture' => true) + $options)->getCity();
    }

    return $city;
  }

  public function setCity($value, array $options = array())
  {
    $this->getCurrentContactInformationI18n($options)->setCity($value);

    return $this;
  }

  public function getRegion(array $options = array())
  {
    $region = $this->getCurrentContactInformationI18n($options)->getRegion();
    if (!empty($options['cultureFallback']) && $region === null)
    {
      $region = $this->getCurrentContactInformationI18n(array('sourceCulture' => true) + $options)->getRegion();
    }

    return $region;
  }

  public function setRegion($value, array $options = array())
  {
    $this->getCurrentContactInformationI18n($options)->setRegion($value);

    return $this;
  }

  public function getNote(array $options = array())
  {
    $note = $this->getCurrentContactInformationI18n($options)->getNote();
    if (!empty($options['cultureFallback']) && $note === null)
    {
      $note = $this->getCurrentContactInformationI18n(array('sourceCulture' => true) + $options)->getNote();
    }

    return $note;
  }

  public function setNote($value, array $options = array())
  {
    $this->getCurrentContactInformationI18n($options)->setNote($value);

    return $this;
  }

  public function getCurrentContactInformationI18n(array $options = array())
  {
    if (!empty($options['sourceCulture']))
    {
      $options['culture'] = $this->sourceCulture;
    }

    if (!isset($options['culture']))
    {
      $options['culture'] = sfPropel::getDefaultCulture();
    }

    if (!isset($this->contactInformationI18ns[$options['culture']]))
    {
      if (null === $contactInformationI18n = QubitContactInformationI18n::getByIdAndCulture($this->id, $options['culture'], $options))
      {
        $contactInformationI18n = new QubitContactInformationI18n;
        $contactInformationI18n->setCulture($options['culture']);
      }
      $this->contactInformationI18ns[$options['culture']] = $contactInformationI18n;
    }

    return $this->contactInformationI18ns[$options['culture']];
  }
}

BasePeer::getMapBuilder('lib.model.map.ContactInformationMapBuilder');
