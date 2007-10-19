<?php


abstract class BaserightActorRelationship extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $right_id;


	
	protected $actor_id;


	
	protected $relationship_type_id;


	
	protected $description;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRight;

	
	protected $aTermRelatedByActorId;

	
	protected $aTermRelatedByRelationshipTypeId;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRightId()
	{

		return $this->right_id;
	}

	
	public function getActorId()
	{

		return $this->actor_id;
	}

	
	public function getRelationshipTypeId()
	{

		return $this->relationship_type_id;
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
			$this->modifiedColumns[] = rightActorRelationshipPeer::ID;
		}

	} 
	
	public function setRightId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->right_id !== $v) {
			$this->right_id = $v;
			$this->modifiedColumns[] = rightActorRelationshipPeer::RIGHT_ID;
		}

		if ($this->aRight !== null && $this->aRight->getId() !== $v) {
			$this->aRight = null;
		}

	} 
	
	public function setActorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->actor_id !== $v) {
			$this->actor_id = $v;
			$this->modifiedColumns[] = rightActorRelationshipPeer::ACTOR_ID;
		}

		if ($this->aTermRelatedByActorId !== null && $this->aTermRelatedByActorId->getId() !== $v) {
			$this->aTermRelatedByActorId = null;
		}

	} 
	
	public function setRelationshipTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relationship_type_id !== $v) {
			$this->relationship_type_id = $v;
			$this->modifiedColumns[] = rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID;
		}

		if ($this->aTermRelatedByRelationshipTypeId !== null && $this->aTermRelatedByRelationshipTypeId->getId() !== $v) {
			$this->aTermRelatedByRelationshipTypeId = null;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = rightActorRelationshipPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = rightActorRelationshipPeer::CREATED_AT;
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
			$this->modifiedColumns[] = rightActorRelationshipPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->right_id = $rs->getInt($startcol + 1);

			$this->actor_id = $rs->getInt($startcol + 2);

			$this->relationship_type_id = $rs->getInt($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating rightActorRelationship object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaserightActorRelationship:delete:pre') as $callable)
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
			$con = Propel::getConnection(rightActorRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			rightActorRelationshipPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaserightActorRelationship:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaserightActorRelationship:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(rightActorRelationshipPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(rightActorRelationshipPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(rightActorRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaserightActorRelationship:save:post') as $callable)
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


												
			if ($this->aRight !== null) {
				if ($this->aRight->isModified()) {
					$affectedRows += $this->aRight->save($con);
				}
				$this->setRight($this->aRight);
			}

			if ($this->aTermRelatedByActorId !== null) {
				if ($this->aTermRelatedByActorId->isModified()) {
					$affectedRows += $this->aTermRelatedByActorId->save($con);
				}
				$this->setTermRelatedByActorId($this->aTermRelatedByActorId);
			}

			if ($this->aTermRelatedByRelationshipTypeId !== null) {
				if ($this->aTermRelatedByRelationshipTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByRelationshipTypeId->save($con);
				}
				$this->setTermRelatedByRelationshipTypeId($this->aTermRelatedByRelationshipTypeId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = rightActorRelationshipPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += rightActorRelationshipPeer::doUpdate($this, $con);
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


												
			if ($this->aRight !== null) {
				if (!$this->aRight->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRight->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByActorId !== null) {
				if (!$this->aTermRelatedByActorId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByActorId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByRelationshipTypeId !== null) {
				if (!$this->aTermRelatedByRelationshipTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByRelationshipTypeId->getValidationFailures());
				}
			}


			if (($retval = rightActorRelationshipPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = rightActorRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRightId();
				break;
			case 2:
				return $this->getActorId();
				break;
			case 3:
				return $this->getRelationshipTypeId();
				break;
			case 4:
				return $this->getDescription();
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
		$keys = rightActorRelationshipPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRightId(),
			$keys[2] => $this->getActorId(),
			$keys[3] => $this->getRelationshipTypeId(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = rightActorRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRightId($value);
				break;
			case 2:
				$this->setActorId($value);
				break;
			case 3:
				$this->setRelationshipTypeId($value);
				break;
			case 4:
				$this->setDescription($value);
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
		$keys = rightActorRelationshipPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRightId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setActorId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRelationshipTypeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(rightActorRelationshipPeer::DATABASE_NAME);

		if ($this->isColumnModified(rightActorRelationshipPeer::ID)) $criteria->add(rightActorRelationshipPeer::ID, $this->id);
		if ($this->isColumnModified(rightActorRelationshipPeer::RIGHT_ID)) $criteria->add(rightActorRelationshipPeer::RIGHT_ID, $this->right_id);
		if ($this->isColumnModified(rightActorRelationshipPeer::ACTOR_ID)) $criteria->add(rightActorRelationshipPeer::ACTOR_ID, $this->actor_id);
		if ($this->isColumnModified(rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID)) $criteria->add(rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->relationship_type_id);
		if ($this->isColumnModified(rightActorRelationshipPeer::DESCRIPTION)) $criteria->add(rightActorRelationshipPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(rightActorRelationshipPeer::CREATED_AT)) $criteria->add(rightActorRelationshipPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(rightActorRelationshipPeer::UPDATED_AT)) $criteria->add(rightActorRelationshipPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(rightActorRelationshipPeer::DATABASE_NAME);

		$criteria->add(rightActorRelationshipPeer::ID, $this->id);

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

		$copyObj->setRightId($this->right_id);

		$copyObj->setActorId($this->actor_id);

		$copyObj->setRelationshipTypeId($this->relationship_type_id);

		$copyObj->setDescription($this->description);

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
			self::$peer = new rightActorRelationshipPeer();
		}
		return self::$peer;
	}

	
	public function setRight($v)
	{


		if ($v === null) {
			$this->setRightId(NULL);
		} else {
			$this->setRightId($v->getId());
		}


		$this->aRight = $v;
	}


	
	public function getRight($con = null)
	{
				include_once 'lib/model/om/BaseRightPeer.php';

		if ($this->aRight === null && ($this->right_id !== null)) {

			$this->aRight = RightPeer::retrieveByPK($this->right_id, $con);

			
		}
		return $this->aRight;
	}

	
	public function setTermRelatedByActorId($v)
	{


		if ($v === null) {
			$this->setActorId(NULL);
		} else {
			$this->setActorId($v->getId());
		}


		$this->aTermRelatedByActorId = $v;
	}


	
	public function getTermRelatedByActorId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByActorId === null && ($this->actor_id !== null)) {

			$this->aTermRelatedByActorId = TermPeer::retrieveByPK($this->actor_id, $con);

			
		}
		return $this->aTermRelatedByActorId;
	}

	
	public function setTermRelatedByRelationshipTypeId($v)
	{


		if ($v === null) {
			$this->setRelationshipTypeId(NULL);
		} else {
			$this->setRelationshipTypeId($v->getId());
		}


		$this->aTermRelatedByRelationshipTypeId = $v;
	}


	
	public function getTermRelatedByRelationshipTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByRelationshipTypeId === null && ($this->relationship_type_id !== null)) {

			$this->aTermRelatedByRelationshipTypeId = TermPeer::retrieveByPK($this->relationship_type_id, $con);

			
		}
		return $this->aTermRelatedByRelationshipTypeId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaserightActorRelationship:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaserightActorRelationship::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 