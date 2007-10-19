<?php


abstract class BasedigitalObjectRecursiveRelationship extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $digital_object_id;


	
	protected $related_digital_object_id;


	
	protected $relationship_type_id;


	
	protected $relationship_description;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $adigitalObjectRelatedByDigitalObjectId;

	
	protected $adigitalObjectRelatedByRelatedDigitalObjectId;

	
	protected $aTerm;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDigitalObjectId()
	{

		return $this->digital_object_id;
	}

	
	public function getRelatedDigitalObjectId()
	{

		return $this->related_digital_object_id;
	}

	
	public function getRelationshipTypeId()
	{

		return $this->relationship_type_id;
	}

	
	public function getRelationshipDescription()
	{

		return $this->relationship_description;
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
			$this->modifiedColumns[] = digitalObjectRecursiveRelationshipPeer::ID;
		}

	} 
	
	public function setDigitalObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->digital_object_id !== $v) {
			$this->digital_object_id = $v;
			$this->modifiedColumns[] = digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID;
		}

		if ($this->adigitalObjectRelatedByDigitalObjectId !== null && $this->adigitalObjectRelatedByDigitalObjectId->getId() !== $v) {
			$this->adigitalObjectRelatedByDigitalObjectId = null;
		}

	} 
	
	public function setRelatedDigitalObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->related_digital_object_id !== $v) {
			$this->related_digital_object_id = $v;
			$this->modifiedColumns[] = digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID;
		}

		if ($this->adigitalObjectRelatedByRelatedDigitalObjectId !== null && $this->adigitalObjectRelatedByRelatedDigitalObjectId->getId() !== $v) {
			$this->adigitalObjectRelatedByRelatedDigitalObjectId = null;
		}

	} 
	
	public function setRelationshipTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relationship_type_id !== $v) {
			$this->relationship_type_id = $v;
			$this->modifiedColumns[] = digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

	} 
	
	public function setRelationshipDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->relationship_description !== $v) {
			$this->relationship_description = $v;
			$this->modifiedColumns[] = digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION;
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
			$this->modifiedColumns[] = digitalObjectRecursiveRelationshipPeer::CREATED_AT;
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
			$this->modifiedColumns[] = digitalObjectRecursiveRelationshipPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->digital_object_id = $rs->getInt($startcol + 1);

			$this->related_digital_object_id = $rs->getInt($startcol + 2);

			$this->relationship_type_id = $rs->getInt($startcol + 3);

			$this->relationship_description = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating digitalObjectRecursiveRelationship object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationship:delete:pre') as $callable)
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
			$con = Propel::getConnection(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			digitalObjectRecursiveRelationshipPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationship:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationship:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(digitalObjectRecursiveRelationshipPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(digitalObjectRecursiveRelationshipPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationship:save:post') as $callable)
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


												
			if ($this->adigitalObjectRelatedByDigitalObjectId !== null) {
				if ($this->adigitalObjectRelatedByDigitalObjectId->isModified()) {
					$affectedRows += $this->adigitalObjectRelatedByDigitalObjectId->save($con);
				}
				$this->setdigitalObjectRelatedByDigitalObjectId($this->adigitalObjectRelatedByDigitalObjectId);
			}

			if ($this->adigitalObjectRelatedByRelatedDigitalObjectId !== null) {
				if ($this->adigitalObjectRelatedByRelatedDigitalObjectId->isModified()) {
					$affectedRows += $this->adigitalObjectRelatedByRelatedDigitalObjectId->save($con);
				}
				$this->setdigitalObjectRelatedByRelatedDigitalObjectId($this->adigitalObjectRelatedByRelatedDigitalObjectId);
			}

			if ($this->aTerm !== null) {
				if ($this->aTerm->isModified()) {
					$affectedRows += $this->aTerm->save($con);
				}
				$this->setTerm($this->aTerm);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = digitalObjectRecursiveRelationshipPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += digitalObjectRecursiveRelationshipPeer::doUpdate($this, $con);
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


												
			if ($this->adigitalObjectRelatedByDigitalObjectId !== null) {
				if (!$this->adigitalObjectRelatedByDigitalObjectId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->adigitalObjectRelatedByDigitalObjectId->getValidationFailures());
				}
			}

			if ($this->adigitalObjectRelatedByRelatedDigitalObjectId !== null) {
				if (!$this->adigitalObjectRelatedByRelatedDigitalObjectId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->adigitalObjectRelatedByRelatedDigitalObjectId->getValidationFailures());
				}
			}

			if ($this->aTerm !== null) {
				if (!$this->aTerm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTerm->getValidationFailures());
				}
			}


			if (($retval = digitalObjectRecursiveRelationshipPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = digitalObjectRecursiveRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDigitalObjectId();
				break;
			case 2:
				return $this->getRelatedDigitalObjectId();
				break;
			case 3:
				return $this->getRelationshipTypeId();
				break;
			case 4:
				return $this->getRelationshipDescription();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			case 6:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = digitalObjectRecursiveRelationshipPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDigitalObjectId(),
			$keys[2] => $this->getRelatedDigitalObjectId(),
			$keys[3] => $this->getRelationshipTypeId(),
			$keys[4] => $this->getRelationshipDescription(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = digitalObjectRecursiveRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDigitalObjectId($value);
				break;
			case 2:
				$this->setRelatedDigitalObjectId($value);
				break;
			case 3:
				$this->setRelationshipTypeId($value);
				break;
			case 4:
				$this->setRelationshipDescription($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
			case 6:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = digitalObjectRecursiveRelationshipPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDigitalObjectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRelatedDigitalObjectId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRelationshipTypeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRelationshipDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME);

		if ($this->isColumnModified(digitalObjectRecursiveRelationshipPeer::ID)) $criteria->add(digitalObjectRecursiveRelationshipPeer::ID, $this->id);
		if ($this->isColumnModified(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID)) $criteria->add(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->digital_object_id);
		if ($this->isColumnModified(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID)) $criteria->add(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->related_digital_object_id);
		if ($this->isColumnModified(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID)) $criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->relationship_type_id);
		if ($this->isColumnModified(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION)) $criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION, $this->relationship_description);
		if ($this->isColumnModified(digitalObjectRecursiveRelationshipPeer::CREATED_AT)) $criteria->add(digitalObjectRecursiveRelationshipPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(digitalObjectRecursiveRelationshipPeer::UPDATED_AT)) $criteria->add(digitalObjectRecursiveRelationshipPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME);

		$criteria->add(digitalObjectRecursiveRelationshipPeer::ID, $this->id);

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

		$copyObj->setDigitalObjectId($this->digital_object_id);

		$copyObj->setRelatedDigitalObjectId($this->related_digital_object_id);

		$copyObj->setRelationshipTypeId($this->relationship_type_id);

		$copyObj->setRelationshipDescription($this->relationship_description);

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
			self::$peer = new digitalObjectRecursiveRelationshipPeer();
		}
		return self::$peer;
	}

	
	public function setdigitalObjectRelatedByDigitalObjectId($v)
	{


		if ($v === null) {
			$this->setDigitalObjectId(NULL);
		} else {
			$this->setDigitalObjectId($v->getId());
		}


		$this->adigitalObjectRelatedByDigitalObjectId = $v;
	}


	
	public function getdigitalObjectRelatedByDigitalObjectId($con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';

		if ($this->adigitalObjectRelatedByDigitalObjectId === null && ($this->digital_object_id !== null)) {

			$this->adigitalObjectRelatedByDigitalObjectId = digitalObjectPeer::retrieveByPK($this->digital_object_id, $con);

			
		}
		return $this->adigitalObjectRelatedByDigitalObjectId;
	}

	
	public function setdigitalObjectRelatedByRelatedDigitalObjectId($v)
	{


		if ($v === null) {
			$this->setRelatedDigitalObjectId(NULL);
		} else {
			$this->setRelatedDigitalObjectId($v->getId());
		}


		$this->adigitalObjectRelatedByRelatedDigitalObjectId = $v;
	}


	
	public function getdigitalObjectRelatedByRelatedDigitalObjectId($con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';

		if ($this->adigitalObjectRelatedByRelatedDigitalObjectId === null && ($this->related_digital_object_id !== null)) {

			$this->adigitalObjectRelatedByRelatedDigitalObjectId = digitalObjectPeer::retrieveByPK($this->related_digital_object_id, $con);

			
		}
		return $this->adigitalObjectRelatedByRelatedDigitalObjectId;
	}

	
	public function setTerm($v)
	{


		if ($v === null) {
			$this->setRelationshipTypeId(NULL);
		} else {
			$this->setRelationshipTypeId($v->getId());
		}


		$this->aTerm = $v;
	}


	
	public function getTerm($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTerm === null && ($this->relationship_type_id !== null)) {

			$this->aTerm = TermPeer::retrieveByPK($this->relationship_type_id, $con);

			
		}
		return $this->aTerm;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasedigitalObjectRecursiveRelationship:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasedigitalObjectRecursiveRelationship::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 