<?php


abstract class BaseContactInformation extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $actor_id;


	
	protected $contact_type;


	
	protected $primary_contact;


	
	protected $street_address;


	
	protected $city;


	
	protected $region;


	
	protected $postal_code;


	
	protected $country_id;


	
	protected $longtitude;


	
	protected $latitude;


	
	protected $telephone;


	
	protected $fax;


	
	protected $website;


	
	protected $email;


	
	protected $note;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aActor;

	
	protected $aTerm;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getActorId()
	{

		return $this->actor_id;
	}

	
	public function getContactType()
	{

		return $this->contact_type;
	}

	
	public function getPrimaryContact()
	{

		return $this->primary_contact;
	}

	
	public function getStreetAddress()
	{

		return $this->street_address;
	}

	
	public function getCity()
	{

		return $this->city;
	}

	
	public function getRegion()
	{

		return $this->region;
	}

	
	public function getPostalCode()
	{

		return $this->postal_code;
	}

	
	public function getCountryId()
	{

		return $this->country_id;
	}

	
	public function getLongtitude()
	{

		return $this->longtitude;
	}

	
	public function getLatitude()
	{

		return $this->latitude;
	}

	
	public function getTelephone()
	{

		return $this->telephone;
	}

	
	public function getFax()
	{

		return $this->fax;
	}

	
	public function getWebsite()
	{

		return $this->website;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getNote()
	{

		return $this->note;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ContactInformationPeer::ID;
		}

	} 
	
	public function setActorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->actor_id !== $v) {
			$this->actor_id = $v;
			$this->modifiedColumns[] = ContactInformationPeer::ACTOR_ID;
		}

		if ($this->aActor !== null && $this->aActor->getId() !== $v) {
			$this->aActor = null;
		}

	} 
	
	public function setContactType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->contact_type !== $v) {
			$this->contact_type = $v;
			$this->modifiedColumns[] = ContactInformationPeer::CONTACT_TYPE;
		}

	} 
	
	public function setPrimaryContact($v)
	{

		if ($this->primary_contact !== $v) {
			$this->primary_contact = $v;
			$this->modifiedColumns[] = ContactInformationPeer::PRIMARY_CONTACT;
		}

	} 
	
	public function setStreetAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->street_address !== $v) {
			$this->street_address = $v;
			$this->modifiedColumns[] = ContactInformationPeer::STREET_ADDRESS;
		}

	} 
	
	public function setCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->city !== $v) {
			$this->city = $v;
			$this->modifiedColumns[] = ContactInformationPeer::CITY;
		}

	} 
	
	public function setRegion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->region !== $v) {
			$this->region = $v;
			$this->modifiedColumns[] = ContactInformationPeer::REGION;
		}

	} 
	
	public function setPostalCode($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->postal_code !== $v) {
			$this->postal_code = $v;
			$this->modifiedColumns[] = ContactInformationPeer::POSTAL_CODE;
		}

	} 
	
	public function setCountryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->country_id !== $v) {
			$this->country_id = $v;
			$this->modifiedColumns[] = ContactInformationPeer::COUNTRY_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

	} 
	
	public function setLongtitude($v)
	{

		if ($this->longtitude !== $v) {
			$this->longtitude = $v;
			$this->modifiedColumns[] = ContactInformationPeer::LONGTITUDE;
		}

	} 
	
	public function setLatitude($v)
	{

		if ($this->latitude !== $v) {
			$this->latitude = $v;
			$this->modifiedColumns[] = ContactInformationPeer::LATITUDE;
		}

	} 
	
	public function setTelephone($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->telephone !== $v) {
			$this->telephone = $v;
			$this->modifiedColumns[] = ContactInformationPeer::TELEPHONE;
		}

	} 
	
	public function setFax($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fax !== $v) {
			$this->fax = $v;
			$this->modifiedColumns[] = ContactInformationPeer::FAX;
		}

	} 
	
	public function setWebsite($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->website !== $v) {
			$this->website = $v;
			$this->modifiedColumns[] = ContactInformationPeer::WEBSITE;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = ContactInformationPeer::EMAIL;
		}

	} 
	
	public function setNote($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = ContactInformationPeer::NOTE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = ContactInformationPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = ContactInformationPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->actor_id = $rs->getInt($startcol + 1);

			$this->contact_type = $rs->getString($startcol + 2);

			$this->primary_contact = $rs->getBoolean($startcol + 3);

			$this->street_address = $rs->getString($startcol + 4);

			$this->city = $rs->getString($startcol + 5);

			$this->region = $rs->getString($startcol + 6);

			$this->postal_code = $rs->getString($startcol + 7);

			$this->country_id = $rs->getInt($startcol + 8);

			$this->longtitude = $rs->getFloat($startcol + 9);

			$this->latitude = $rs->getFloat($startcol + 10);

			$this->telephone = $rs->getString($startcol + 11);

			$this->fax = $rs->getString($startcol + 12);

			$this->website = $rs->getString($startcol + 13);

			$this->email = $rs->getString($startcol + 14);

			$this->note = $rs->getString($startcol + 15);

			$this->created_at = $rs->getTimestamp($startcol + 16, null);

			$this->updated_at = $rs->getTimestamp($startcol + 17, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ContactInformation object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformation:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ContactInformationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ContactInformationPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseContactInformation:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformation:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ContactInformationPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ContactInformationPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ContactInformationPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseContactInformation:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aActor !== null) {
				if ($this->aActor->isModified()) {
					$affectedRows += $this->aActor->save($con);
				}
				$this->setActor($this->aActor);
			}

			if ($this->aTerm !== null) {
				if ($this->aTerm->isModified()) {
					$affectedRows += $this->aTerm->save($con);
				}
				$this->setTerm($this->aTerm);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ContactInformationPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ContactInformationPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aActor !== null) {
				if (!$this->aActor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActor->getValidationFailures());
				}
			}

			if ($this->aTerm !== null) {
				if (!$this->aTerm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTerm->getValidationFailures());
				}
			}


			if (($retval = ContactInformationPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactInformationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getActorId();
				break;
			case 2:
				return $this->getContactType();
				break;
			case 3:
				return $this->getPrimaryContact();
				break;
			case 4:
				return $this->getStreetAddress();
				break;
			case 5:
				return $this->getCity();
				break;
			case 6:
				return $this->getRegion();
				break;
			case 7:
				return $this->getPostalCode();
				break;
			case 8:
				return $this->getCountryId();
				break;
			case 9:
				return $this->getLongtitude();
				break;
			case 10:
				return $this->getLatitude();
				break;
			case 11:
				return $this->getTelephone();
				break;
			case 12:
				return $this->getFax();
				break;
			case 13:
				return $this->getWebsite();
				break;
			case 14:
				return $this->getEmail();
				break;
			case 15:
				return $this->getNote();
				break;
			case 16:
				return $this->getCreatedAt();
				break;
			case 17:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ContactInformationPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getActorId(),
			$keys[2] => $this->getContactType(),
			$keys[3] => $this->getPrimaryContact(),
			$keys[4] => $this->getStreetAddress(),
			$keys[5] => $this->getCity(),
			$keys[6] => $this->getRegion(),
			$keys[7] => $this->getPostalCode(),
			$keys[8] => $this->getCountryId(),
			$keys[9] => $this->getLongtitude(),
			$keys[10] => $this->getLatitude(),
			$keys[11] => $this->getTelephone(),
			$keys[12] => $this->getFax(),
			$keys[13] => $this->getWebsite(),
			$keys[14] => $this->getEmail(),
			$keys[15] => $this->getNote(),
			$keys[16] => $this->getCreatedAt(),
			$keys[17] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactInformationPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setActorId($value);
				break;
			case 2:
				$this->setContactType($value);
				break;
			case 3:
				$this->setPrimaryContact($value);
				break;
			case 4:
				$this->setStreetAddress($value);
				break;
			case 5:
				$this->setCity($value);
				break;
			case 6:
				$this->setRegion($value);
				break;
			case 7:
				$this->setPostalCode($value);
				break;
			case 8:
				$this->setCountryId($value);
				break;
			case 9:
				$this->setLongtitude($value);
				break;
			case 10:
				$this->setLatitude($value);
				break;
			case 11:
				$this->setTelephone($value);
				break;
			case 12:
				$this->setFax($value);
				break;
			case 13:
				$this->setWebsite($value);
				break;
			case 14:
				$this->setEmail($value);
				break;
			case 15:
				$this->setNote($value);
				break;
			case 16:
				$this->setCreatedAt($value);
				break;
			case 17:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ContactInformationPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setActorId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setContactType($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPrimaryContact($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStreetAddress($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setRegion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPostalCode($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCountryId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLongtitude($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setLatitude($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTelephone($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setFax($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setWebsite($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setEmail($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setNote($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ContactInformationPeer::DATABASE_NAME);

		if ($this->isColumnModified(ContactInformationPeer::ID)) $criteria->add(ContactInformationPeer::ID, $this->id);
		if ($this->isColumnModified(ContactInformationPeer::ACTOR_ID)) $criteria->add(ContactInformationPeer::ACTOR_ID, $this->actor_id);
		if ($this->isColumnModified(ContactInformationPeer::CONTACT_TYPE)) $criteria->add(ContactInformationPeer::CONTACT_TYPE, $this->contact_type);
		if ($this->isColumnModified(ContactInformationPeer::PRIMARY_CONTACT)) $criteria->add(ContactInformationPeer::PRIMARY_CONTACT, $this->primary_contact);
		if ($this->isColumnModified(ContactInformationPeer::STREET_ADDRESS)) $criteria->add(ContactInformationPeer::STREET_ADDRESS, $this->street_address);
		if ($this->isColumnModified(ContactInformationPeer::CITY)) $criteria->add(ContactInformationPeer::CITY, $this->city);
		if ($this->isColumnModified(ContactInformationPeer::REGION)) $criteria->add(ContactInformationPeer::REGION, $this->region);
		if ($this->isColumnModified(ContactInformationPeer::POSTAL_CODE)) $criteria->add(ContactInformationPeer::POSTAL_CODE, $this->postal_code);
		if ($this->isColumnModified(ContactInformationPeer::COUNTRY_ID)) $criteria->add(ContactInformationPeer::COUNTRY_ID, $this->country_id);
		if ($this->isColumnModified(ContactInformationPeer::LONGTITUDE)) $criteria->add(ContactInformationPeer::LONGTITUDE, $this->longtitude);
		if ($this->isColumnModified(ContactInformationPeer::LATITUDE)) $criteria->add(ContactInformationPeer::LATITUDE, $this->latitude);
		if ($this->isColumnModified(ContactInformationPeer::TELEPHONE)) $criteria->add(ContactInformationPeer::TELEPHONE, $this->telephone);
		if ($this->isColumnModified(ContactInformationPeer::FAX)) $criteria->add(ContactInformationPeer::FAX, $this->fax);
		if ($this->isColumnModified(ContactInformationPeer::WEBSITE)) $criteria->add(ContactInformationPeer::WEBSITE, $this->website);
		if ($this->isColumnModified(ContactInformationPeer::EMAIL)) $criteria->add(ContactInformationPeer::EMAIL, $this->email);
		if ($this->isColumnModified(ContactInformationPeer::NOTE)) $criteria->add(ContactInformationPeer::NOTE, $this->note);
		if ($this->isColumnModified(ContactInformationPeer::CREATED_AT)) $criteria->add(ContactInformationPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ContactInformationPeer::UPDATED_AT)) $criteria->add(ContactInformationPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ContactInformationPeer::DATABASE_NAME);

		$criteria->add(ContactInformationPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setActorId($this->actor_id);

		$copyObj->setContactType($this->contact_type);

		$copyObj->setPrimaryContact($this->primary_contact);

		$copyObj->setStreetAddress($this->street_address);

		$copyObj->setCity($this->city);

		$copyObj->setRegion($this->region);

		$copyObj->setPostalCode($this->postal_code);

		$copyObj->setCountryId($this->country_id);

		$copyObj->setLongtitude($this->longtitude);

		$copyObj->setLatitude($this->latitude);

		$copyObj->setTelephone($this->telephone);

		$copyObj->setFax($this->fax);

		$copyObj->setWebsite($this->website);

		$copyObj->setEmail($this->email);

		$copyObj->setNote($this->note);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ContactInformationPeer();
		}
		return self::$peer;
	}

	
	public function setActor($v)
	{


		if ($v === null) {
			$this->setActorId(NULL);
		} else {
			$this->setActorId($v->getId());
		}


		$this->aActor = $v;
	}


	
	public function getActor($con = null)
	{
				include_once 'lib/model/om/BaseActorPeer.php';

		if ($this->aActor === null && ($this->actor_id !== null)) {

			$this->aActor = ActorPeer::retrieveByPK($this->actor_id, $con);

			
		}
		return $this->aActor;
	}

	
	public function setTerm($v)
	{


		if ($v === null) {
			$this->setCountryId(NULL);
		} else {
			$this->setCountryId($v->getId());
		}


		$this->aTerm = $v;
	}


	
	public function getTerm($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTerm === null && ($this->country_id !== null)) {

			$this->aTerm = TermPeer::retrieveByPK($this->country_id, $con);

			
		}
		return $this->aTerm;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseContactInformation:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseContactInformation::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 