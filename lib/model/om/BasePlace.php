<?php


abstract class BasePlace extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $term_id;


	
	protected $address;


	
	protected $country_id;


	
	protected $place_type_id;


	
	protected $longtitude;


	
	protected $latitude;


	
	protected $altitude;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTermRelatedByTermId;

	
	protected $aTermRelatedByCountryId;

	
	protected $aTermRelatedByPlaceTypeId;

	
	protected $collPlaceMapRelationships;

	
	protected $lastPlaceMapRelationshipCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTermId()
	{

		return $this->term_id;
	}

	
	public function getAddress()
	{

		return $this->address;
	}

	
	public function getCountryId()
	{

		return $this->country_id;
	}

	
	public function getPlaceTypeId()
	{

		return $this->place_type_id;
	}

	
	public function getLongtitude()
	{

		return $this->longtitude;
	}

	
	public function getLatitude()
	{

		return $this->latitude;
	}

	
	public function getAltitude()
	{

		return $this->altitude;
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
			$this->modifiedColumns[] = PlacePeer::ID;
		}

	} 
	
	public function setTermId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->term_id !== $v) {
			$this->term_id = $v;
			$this->modifiedColumns[] = PlacePeer::TERM_ID;
		}

		if ($this->aTermRelatedByTermId !== null && $this->aTermRelatedByTermId->getId() !== $v) {
			$this->aTermRelatedByTermId = null;
		}

	} 
	
	public function setAddress($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address !== $v) {
			$this->address = $v;
			$this->modifiedColumns[] = PlacePeer::ADDRESS;
		}

	} 
	
	public function setCountryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->country_id !== $v) {
			$this->country_id = $v;
			$this->modifiedColumns[] = PlacePeer::COUNTRY_ID;
		}

		if ($this->aTermRelatedByCountryId !== null && $this->aTermRelatedByCountryId->getId() !== $v) {
			$this->aTermRelatedByCountryId = null;
		}

	} 
	
	public function setPlaceTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->place_type_id !== $v) {
			$this->place_type_id = $v;
			$this->modifiedColumns[] = PlacePeer::PLACE_TYPE_ID;
		}

		if ($this->aTermRelatedByPlaceTypeId !== null && $this->aTermRelatedByPlaceTypeId->getId() !== $v) {
			$this->aTermRelatedByPlaceTypeId = null;
		}

	} 
	
	public function setLongtitude($v)
	{

		if ($this->longtitude !== $v) {
			$this->longtitude = $v;
			$this->modifiedColumns[] = PlacePeer::LONGTITUDE;
		}

	} 
	
	public function setLatitude($v)
	{

		if ($this->latitude !== $v) {
			$this->latitude = $v;
			$this->modifiedColumns[] = PlacePeer::LATITUDE;
		}

	} 
	
	public function setAltitude($v)
	{

		if ($this->altitude !== $v) {
			$this->altitude = $v;
			$this->modifiedColumns[] = PlacePeer::ALTITUDE;
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
			$this->modifiedColumns[] = PlacePeer::CREATED_AT;
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
			$this->modifiedColumns[] = PlacePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->term_id = $rs->getInt($startcol + 1);

			$this->address = $rs->getString($startcol + 2);

			$this->country_id = $rs->getInt($startcol + 3);

			$this->place_type_id = $rs->getInt($startcol + 4);

			$this->longtitude = $rs->getFloat($startcol + 5);

			$this->latitude = $rs->getFloat($startcol + 6);

			$this->altitude = $rs->getFloat($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Place object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePlace:delete:pre') as $callable)
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
			$con = Propel::getConnection(PlacePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PlacePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePlace:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePlace:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(PlacePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PlacePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PlacePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePlace:save:post') as $callable)
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


												
			if ($this->aTermRelatedByTermId !== null) {
				if ($this->aTermRelatedByTermId->isModified()) {
					$affectedRows += $this->aTermRelatedByTermId->save($con);
				}
				$this->setTermRelatedByTermId($this->aTermRelatedByTermId);
			}

			if ($this->aTermRelatedByCountryId !== null) {
				if ($this->aTermRelatedByCountryId->isModified()) {
					$affectedRows += $this->aTermRelatedByCountryId->save($con);
				}
				$this->setTermRelatedByCountryId($this->aTermRelatedByCountryId);
			}

			if ($this->aTermRelatedByPlaceTypeId !== null) {
				if ($this->aTermRelatedByPlaceTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByPlaceTypeId->save($con);
				}
				$this->setTermRelatedByPlaceTypeId($this->aTermRelatedByPlaceTypeId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PlacePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PlacePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collPlaceMapRelationships !== null) {
				foreach($this->collPlaceMapRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->aTermRelatedByTermId !== null) {
				if (!$this->aTermRelatedByTermId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByTermId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByCountryId !== null) {
				if (!$this->aTermRelatedByCountryId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByCountryId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByPlaceTypeId !== null) {
				if (!$this->aTermRelatedByPlaceTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByPlaceTypeId->getValidationFailures());
				}
			}


			if (($retval = PlacePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPlaceMapRelationships !== null) {
					foreach($this->collPlaceMapRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PlacePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTermId();
				break;
			case 2:
				return $this->getAddress();
				break;
			case 3:
				return $this->getCountryId();
				break;
			case 4:
				return $this->getPlaceTypeId();
				break;
			case 5:
				return $this->getLongtitude();
				break;
			case 6:
				return $this->getLatitude();
				break;
			case 7:
				return $this->getAltitude();
				break;
			case 8:
				return $this->getCreatedAt();
				break;
			case 9:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PlacePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTermId(),
			$keys[2] => $this->getAddress(),
			$keys[3] => $this->getCountryId(),
			$keys[4] => $this->getPlaceTypeId(),
			$keys[5] => $this->getLongtitude(),
			$keys[6] => $this->getLatitude(),
			$keys[7] => $this->getAltitude(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PlacePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTermId($value);
				break;
			case 2:
				$this->setAddress($value);
				break;
			case 3:
				$this->setCountryId($value);
				break;
			case 4:
				$this->setPlaceTypeId($value);
				break;
			case 5:
				$this->setLongtitude($value);
				break;
			case 6:
				$this->setLatitude($value);
				break;
			case 7:
				$this->setAltitude($value);
				break;
			case 8:
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PlacePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTermId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAddress($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCountryId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPlaceTypeId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLongtitude($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLatitude($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setAltitude($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PlacePeer::DATABASE_NAME);

		if ($this->isColumnModified(PlacePeer::ID)) $criteria->add(PlacePeer::ID, $this->id);
		if ($this->isColumnModified(PlacePeer::TERM_ID)) $criteria->add(PlacePeer::TERM_ID, $this->term_id);
		if ($this->isColumnModified(PlacePeer::ADDRESS)) $criteria->add(PlacePeer::ADDRESS, $this->address);
		if ($this->isColumnModified(PlacePeer::COUNTRY_ID)) $criteria->add(PlacePeer::COUNTRY_ID, $this->country_id);
		if ($this->isColumnModified(PlacePeer::PLACE_TYPE_ID)) $criteria->add(PlacePeer::PLACE_TYPE_ID, $this->place_type_id);
		if ($this->isColumnModified(PlacePeer::LONGTITUDE)) $criteria->add(PlacePeer::LONGTITUDE, $this->longtitude);
		if ($this->isColumnModified(PlacePeer::LATITUDE)) $criteria->add(PlacePeer::LATITUDE, $this->latitude);
		if ($this->isColumnModified(PlacePeer::ALTITUDE)) $criteria->add(PlacePeer::ALTITUDE, $this->altitude);
		if ($this->isColumnModified(PlacePeer::CREATED_AT)) $criteria->add(PlacePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PlacePeer::UPDATED_AT)) $criteria->add(PlacePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PlacePeer::DATABASE_NAME);

		$criteria->add(PlacePeer::ID, $this->id);

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

		$copyObj->setTermId($this->term_id);

		$copyObj->setAddress($this->address);

		$copyObj->setCountryId($this->country_id);

		$copyObj->setPlaceTypeId($this->place_type_id);

		$copyObj->setLongtitude($this->longtitude);

		$copyObj->setLatitude($this->latitude);

		$copyObj->setAltitude($this->altitude);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getPlaceMapRelationships() as $relObj) {
				$copyObj->addPlaceMapRelationship($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new PlacePeer();
		}
		return self::$peer;
	}

	
	public function setTermRelatedByTermId($v)
	{


		if ($v === null) {
			$this->setTermId(NULL);
		} else {
			$this->setTermId($v->getId());
		}


		$this->aTermRelatedByTermId = $v;
	}


	
	public function getTermRelatedByTermId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByTermId === null && ($this->term_id !== null)) {

			$this->aTermRelatedByTermId = TermPeer::retrieveByPK($this->term_id, $con);

			
		}
		return $this->aTermRelatedByTermId;
	}

	
	public function setTermRelatedByCountryId($v)
	{


		if ($v === null) {
			$this->setCountryId(NULL);
		} else {
			$this->setCountryId($v->getId());
		}


		$this->aTermRelatedByCountryId = $v;
	}


	
	public function getTermRelatedByCountryId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByCountryId === null && ($this->country_id !== null)) {

			$this->aTermRelatedByCountryId = TermPeer::retrieveByPK($this->country_id, $con);

			
		}
		return $this->aTermRelatedByCountryId;
	}

	
	public function setTermRelatedByPlaceTypeId($v)
	{


		if ($v === null) {
			$this->setPlaceTypeId(NULL);
		} else {
			$this->setPlaceTypeId($v->getId());
		}


		$this->aTermRelatedByPlaceTypeId = $v;
	}


	
	public function getTermRelatedByPlaceTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByPlaceTypeId === null && ($this->place_type_id !== null)) {

			$this->aTermRelatedByPlaceTypeId = TermPeer::retrieveByPK($this->place_type_id, $con);

			
		}
		return $this->aTermRelatedByPlaceTypeId;
	}

	
	public function initPlaceMapRelationships()
	{
		if ($this->collPlaceMapRelationships === null) {
			$this->collPlaceMapRelationships = array();
		}
	}

	
	public function getPlaceMapRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
			   $this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

				PlaceMapRelationshipPeer::addSelectColumns($criteria);
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

				PlaceMapRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
					$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;
		return $this->collPlaceMapRelationships;
	}

	
	public function countPlaceMapRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

		return PlaceMapRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPlaceMapRelationship(PlaceMapRelationship $l)
	{
		$this->collPlaceMapRelationships[] = $l;
		$l->setPlace($this);
	}


	
	public function getPlaceMapRelationshipsJoinMap($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
	}


	
	public function getPlaceMapRelationshipsJoinDigitalObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinDigitalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinDigitalObject($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
	}


	
	public function getPlaceMapRelationshipsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePlace:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePlace::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 