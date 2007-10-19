<?php


abstract class BaseRight extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $information_object_id;


	
	protected $digital_object_id;


	
	protected $physical_object_id;


	
	protected $permission_id;


	
	protected $description;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $ainformationObject;

	
	protected $adigitalObject;

	
	protected $aphysicalObject;

	
	protected $aTerm;

	
	protected $collrightTermRelationships;

	
	protected $lastrightTermRelationshipCriteria = null;

	
	protected $collrightActorRelationships;

	
	protected $lastrightActorRelationshipCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getInformationObjectId()
	{

		return $this->information_object_id;
	}

	
	public function getDigitalObjectId()
	{

		return $this->digital_object_id;
	}

	
	public function getPhysicalObjectId()
	{

		return $this->physical_object_id;
	}

	
	public function getPermissionId()
	{

		return $this->permission_id;
	}

	
	public function getDescription()
	{

		return $this->description;
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
			$this->modifiedColumns[] = RightPeer::ID;
		}

	} 
	
	public function setInformationObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->information_object_id !== $v) {
			$this->information_object_id = $v;
			$this->modifiedColumns[] = RightPeer::INFORMATION_OBJECT_ID;
		}

		if ($this->ainformationObject !== null && $this->ainformationObject->getId() !== $v) {
			$this->ainformationObject = null;
		}

	} 
	
	public function setDigitalObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->digital_object_id !== $v) {
			$this->digital_object_id = $v;
			$this->modifiedColumns[] = RightPeer::DIGITAL_OBJECT_ID;
		}

		if ($this->adigitalObject !== null && $this->adigitalObject->getId() !== $v) {
			$this->adigitalObject = null;
		}

	} 
	
	public function setPhysicalObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->physical_object_id !== $v) {
			$this->physical_object_id = $v;
			$this->modifiedColumns[] = RightPeer::PHYSICAL_OBJECT_ID;
		}

		if ($this->aphysicalObject !== null && $this->aphysicalObject->getId() !== $v) {
			$this->aphysicalObject = null;
		}

	} 
	
	public function setPermissionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->permission_id !== $v) {
			$this->permission_id = $v;
			$this->modifiedColumns[] = RightPeer::PERMISSION_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = RightPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = RightPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RightPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->information_object_id = $rs->getInt($startcol + 1);

			$this->digital_object_id = $rs->getInt($startcol + 2);

			$this->physical_object_id = $rs->getInt($startcol + 3);

			$this->permission_id = $rs->getInt($startcol + 4);

			$this->description = $rs->getString($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Right object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseRight:delete:pre') as $callable)
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
			$con = Propel::getConnection(RightPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RightPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRight:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseRight:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(RightPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RightPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RightPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRight:save:post') as $callable)
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


												
			if ($this->ainformationObject !== null) {
				if ($this->ainformationObject->isModified()) {
					$affectedRows += $this->ainformationObject->save($con);
				}
				$this->setinformationObject($this->ainformationObject);
			}

			if ($this->adigitalObject !== null) {
				if ($this->adigitalObject->isModified()) {
					$affectedRows += $this->adigitalObject->save($con);
				}
				$this->setdigitalObject($this->adigitalObject);
			}

			if ($this->aphysicalObject !== null) {
				if ($this->aphysicalObject->isModified()) {
					$affectedRows += $this->aphysicalObject->save($con);
				}
				$this->setphysicalObject($this->aphysicalObject);
			}

			if ($this->aTerm !== null) {
				if ($this->aTerm->isModified()) {
					$affectedRows += $this->aTerm->save($con);
				}
				$this->setTerm($this->aTerm);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RightPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RightPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collrightTermRelationships !== null) {
				foreach($this->collrightTermRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collrightActorRelationships !== null) {
				foreach($this->collrightActorRelationships as $referrerFK) {
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


												
			if ($this->ainformationObject !== null) {
				if (!$this->ainformationObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->ainformationObject->getValidationFailures());
				}
			}

			if ($this->adigitalObject !== null) {
				if (!$this->adigitalObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->adigitalObject->getValidationFailures());
				}
			}

			if ($this->aphysicalObject !== null) {
				if (!$this->aphysicalObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aphysicalObject->getValidationFailures());
				}
			}

			if ($this->aTerm !== null) {
				if (!$this->aTerm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTerm->getValidationFailures());
				}
			}


			if (($retval = RightPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collrightTermRelationships !== null) {
					foreach($this->collrightTermRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collrightActorRelationships !== null) {
					foreach($this->collrightActorRelationships as $referrerFK) {
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
		$pos = RightPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getInformationObjectId();
				break;
			case 2:
				return $this->getDigitalObjectId();
				break;
			case 3:
				return $this->getPhysicalObjectId();
				break;
			case 4:
				return $this->getPermissionId();
				break;
			case 5:
				return $this->getDescription();
				break;
			case 6:
				return $this->getCreatedAt();
				break;
			case 7:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RightPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getInformationObjectId(),
			$keys[2] => $this->getDigitalObjectId(),
			$keys[3] => $this->getPhysicalObjectId(),
			$keys[4] => $this->getPermissionId(),
			$keys[5] => $this->getDescription(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RightPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setInformationObjectId($value);
				break;
			case 2:
				$this->setDigitalObjectId($value);
				break;
			case 3:
				$this->setPhysicalObjectId($value);
				break;
			case 4:
				$this->setPermissionId($value);
				break;
			case 5:
				$this->setDescription($value);
				break;
			case 6:
				$this->setCreatedAt($value);
				break;
			case 7:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RightPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setInformationObjectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDigitalObjectId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPhysicalObjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPermissionId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDescription($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RightPeer::DATABASE_NAME);

		if ($this->isColumnModified(RightPeer::ID)) $criteria->add(RightPeer::ID, $this->id);
		if ($this->isColumnModified(RightPeer::INFORMATION_OBJECT_ID)) $criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->information_object_id);
		if ($this->isColumnModified(RightPeer::DIGITAL_OBJECT_ID)) $criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->digital_object_id);
		if ($this->isColumnModified(RightPeer::PHYSICAL_OBJECT_ID)) $criteria->add(RightPeer::PHYSICAL_OBJECT_ID, $this->physical_object_id);
		if ($this->isColumnModified(RightPeer::PERMISSION_ID)) $criteria->add(RightPeer::PERMISSION_ID, $this->permission_id);
		if ($this->isColumnModified(RightPeer::DESCRIPTION)) $criteria->add(RightPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(RightPeer::CREATED_AT)) $criteria->add(RightPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RightPeer::UPDATED_AT)) $criteria->add(RightPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RightPeer::DATABASE_NAME);

		$criteria->add(RightPeer::ID, $this->id);

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

		$copyObj->setInformationObjectId($this->information_object_id);

		$copyObj->setDigitalObjectId($this->digital_object_id);

		$copyObj->setPhysicalObjectId($this->physical_object_id);

		$copyObj->setPermissionId($this->permission_id);

		$copyObj->setDescription($this->description);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getrightTermRelationships() as $relObj) {
				$copyObj->addrightTermRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getrightActorRelationships() as $relObj) {
				$copyObj->addrightActorRelationship($relObj->copy($deepCopy));
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
			self::$peer = new RightPeer();
		}
		return self::$peer;
	}

	
	public function setinformationObject($v)
	{


		if ($v === null) {
			$this->setInformationObjectId(NULL);
		} else {
			$this->setInformationObjectId($v->getId());
		}


		$this->ainformationObject = $v;
	}


	
	public function getinformationObject($con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';

		if ($this->ainformationObject === null && ($this->information_object_id !== null)) {

			$this->ainformationObject = informationObjectPeer::retrieveByPK($this->information_object_id, $con);

			
		}
		return $this->ainformationObject;
	}

	
	public function setdigitalObject($v)
	{


		if ($v === null) {
			$this->setDigitalObjectId(NULL);
		} else {
			$this->setDigitalObjectId($v->getId());
		}


		$this->adigitalObject = $v;
	}


	
	public function getdigitalObject($con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';

		if ($this->adigitalObject === null && ($this->digital_object_id !== null)) {

			$this->adigitalObject = digitalObjectPeer::retrieveByPK($this->digital_object_id, $con);

			
		}
		return $this->adigitalObject;
	}

	
	public function setphysicalObject($v)
	{


		if ($v === null) {
			$this->setPhysicalObjectId(NULL);
		} else {
			$this->setPhysicalObjectId($v->getId());
		}


		$this->aphysicalObject = $v;
	}


	
	public function getphysicalObject($con = null)
	{
				include_once 'lib/model/om/BasephysicalObjectPeer.php';

		if ($this->aphysicalObject === null && ($this->physical_object_id !== null)) {

			$this->aphysicalObject = physicalObjectPeer::retrieveByPK($this->physical_object_id, $con);

			
		}
		return $this->aphysicalObject;
	}

	
	public function setTerm($v)
	{


		if ($v === null) {
			$this->setPermissionId(NULL);
		} else {
			$this->setPermissionId($v->getId());
		}


		$this->aTerm = $v;
	}


	
	public function getTerm($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTerm === null && ($this->permission_id !== null)) {

			$this->aTerm = TermPeer::retrieveByPK($this->permission_id, $con);

			
		}
		return $this->aTerm;
	}

	
	public function initrightTermRelationships()
	{
		if ($this->collrightTermRelationships === null) {
			$this->collrightTermRelationships = array();
		}
	}

	
	public function getrightTermRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightTermRelationships === null) {
			if ($this->isNew()) {
			   $this->collrightTermRelationships = array();
			} else {

				$criteria->add(rightTermRelationshipPeer::RIGHT_ID, $this->getId());

				rightTermRelationshipPeer::addSelectColumns($criteria);
				$this->collrightTermRelationships = rightTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(rightTermRelationshipPeer::RIGHT_ID, $this->getId());

				rightTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrightTermRelationshipCriteria) || !$this->lastrightTermRelationshipCriteria->equals($criteria)) {
					$this->collrightTermRelationships = rightTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrightTermRelationshipCriteria = $criteria;
		return $this->collrightTermRelationships;
	}

	
	public function countrightTermRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(rightTermRelationshipPeer::RIGHT_ID, $this->getId());

		return rightTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrightTermRelationship(rightTermRelationship $l)
	{
		$this->collrightTermRelationships[] = $l;
		$l->setRight($this);
	}


	
	public function getrightTermRelationshipsJoinTermRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightTermRelationships === null) {
			if ($this->isNew()) {
				$this->collrightTermRelationships = array();
			} else {

				$criteria->add(rightTermRelationshipPeer::RIGHT_ID, $this->getId());

				$this->collrightTermRelationships = rightTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		} else {
									
			$criteria->add(rightTermRelationshipPeer::RIGHT_ID, $this->getId());

			if (!isset($this->lastrightTermRelationshipCriteria) || !$this->lastrightTermRelationshipCriteria->equals($criteria)) {
				$this->collrightTermRelationships = rightTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		}
		$this->lastrightTermRelationshipCriteria = $criteria;

		return $this->collrightTermRelationships;
	}


	
	public function getrightTermRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightTermRelationships === null) {
			if ($this->isNew()) {
				$this->collrightTermRelationships = array();
			} else {

				$criteria->add(rightTermRelationshipPeer::RIGHT_ID, $this->getId());

				$this->collrightTermRelationships = rightTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(rightTermRelationshipPeer::RIGHT_ID, $this->getId());

			if (!isset($this->lastrightTermRelationshipCriteria) || !$this->lastrightTermRelationshipCriteria->equals($criteria)) {
				$this->collrightTermRelationships = rightTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lastrightTermRelationshipCriteria = $criteria;

		return $this->collrightTermRelationships;
	}

	
	public function initrightActorRelationships()
	{
		if ($this->collrightActorRelationships === null) {
			$this->collrightActorRelationships = array();
		}
	}

	
	public function getrightActorRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightActorRelationships === null) {
			if ($this->isNew()) {
			   $this->collrightActorRelationships = array();
			} else {

				$criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->getId());

				rightActorRelationshipPeer::addSelectColumns($criteria);
				$this->collrightActorRelationships = rightActorRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->getId());

				rightActorRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrightActorRelationshipCriteria) || !$this->lastrightActorRelationshipCriteria->equals($criteria)) {
					$this->collrightActorRelationships = rightActorRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrightActorRelationshipCriteria = $criteria;
		return $this->collrightActorRelationships;
	}

	
	public function countrightActorRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->getId());

		return rightActorRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrightActorRelationship(rightActorRelationship $l)
	{
		$this->collrightActorRelationships[] = $l;
		$l->setRight($this);
	}


	
	public function getrightActorRelationshipsJoinTermRelatedByActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightActorRelationships === null) {
			if ($this->isNew()) {
				$this->collrightActorRelationships = array();
			} else {

				$criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->getId());

				$this->collrightActorRelationships = rightActorRelationshipPeer::doSelectJoinTermRelatedByActorId($criteria, $con);
			}
		} else {
									
			$criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->getId());

			if (!isset($this->lastrightActorRelationshipCriteria) || !$this->lastrightActorRelationshipCriteria->equals($criteria)) {
				$this->collrightActorRelationships = rightActorRelationshipPeer::doSelectJoinTermRelatedByActorId($criteria, $con);
			}
		}
		$this->lastrightActorRelationshipCriteria = $criteria;

		return $this->collrightActorRelationships;
	}


	
	public function getrightActorRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightActorRelationships === null) {
			if ($this->isNew()) {
				$this->collrightActorRelationships = array();
			} else {

				$criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->getId());

				$this->collrightActorRelationships = rightActorRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->getId());

			if (!isset($this->lastrightActorRelationshipCriteria) || !$this->lastrightActorRelationshipCriteria->equals($criteria)) {
				$this->collrightActorRelationships = rightActorRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lastrightActorRelationshipCriteria = $criteria;

		return $this->collrightActorRelationships;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRight:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRight::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 