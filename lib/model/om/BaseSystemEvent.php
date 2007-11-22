<?php


abstract class BaseSystemEvent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $system_event_type_id;


	
	protected $object_class;


	
	protected $object_id;


	
	protected $pre_event_snapshot;


	
	protected $post_event_snapshot;


	
	protected $date;


	
	protected $user_name;


	
	protected $user_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTerm;

	
	protected $aUser;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getSystemEventTypeId()
	{

		return $this->system_event_type_id;
	}

	
	public function getObjectClass()
	{

		return $this->object_class;
	}

	
	public function getObjectId()
	{

		return $this->object_id;
	}

	
	public function getPreEventSnapshot()
	{

		return $this->pre_event_snapshot;
	}

	
	public function getPostEventSnapshot()
	{

		return $this->post_event_snapshot;
	}

	
	public function getDate($format = 'Y-m-d H:i:s')
	{

		if ($this->date === null || $this->date === '') {
			return null;
		} elseif (!is_int($this->date)) {
						$ts = strtotime($this->date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [date] as date/time value: " . var_export($this->date, true));
			}
		} else {
			$ts = $this->date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUserName()
	{

		return $this->user_name;
	}

	
	public function getUserId()
	{

		return $this->user_id;
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
			$this->modifiedColumns[] = SystemEventPeer::ID;
		}

	} 
	
	public function setSystemEventTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->system_event_type_id !== $v) {
			$this->system_event_type_id = $v;
			$this->modifiedColumns[] = SystemEventPeer::SYSTEM_EVENT_TYPE_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

	} 
	
	public function setObjectClass($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->object_class !== $v) {
			$this->object_class = $v;
			$this->modifiedColumns[] = SystemEventPeer::OBJECT_CLASS;
		}

	} 
	
	public function setObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->object_id !== $v) {
			$this->object_id = $v;
			$this->modifiedColumns[] = SystemEventPeer::OBJECT_ID;
		}

	} 
	
	public function setPreEventSnapshot($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pre_event_snapshot !== $v) {
			$this->pre_event_snapshot = $v;
			$this->modifiedColumns[] = SystemEventPeer::PRE_EVENT_SNAPSHOT;
		}

	} 
	
	public function setPostEventSnapshot($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->post_event_snapshot !== $v) {
			$this->post_event_snapshot = $v;
			$this->modifiedColumns[] = SystemEventPeer::POST_EVENT_SNAPSHOT;
		}

	} 
	
	public function setDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date !== $ts) {
			$this->date = $ts;
			$this->modifiedColumns[] = SystemEventPeer::DATE;
		}

	} 
	
	public function setUserName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_name !== $v) {
			$this->user_name = $v;
			$this->modifiedColumns[] = SystemEventPeer::USER_NAME;
		}

	} 
	
	public function setUserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = SystemEventPeer::USER_ID;
		}

		if ($this->aUser !== null && $this->aUser->getId() !== $v) {
			$this->aUser = null;
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
			$this->modifiedColumns[] = SystemEventPeer::CREATED_AT;
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
			$this->modifiedColumns[] = SystemEventPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->system_event_type_id = $rs->getInt($startcol + 1);

			$this->object_class = $rs->getString($startcol + 2);

			$this->object_id = $rs->getInt($startcol + 3);

			$this->pre_event_snapshot = $rs->getString($startcol + 4);

			$this->post_event_snapshot = $rs->getString($startcol + 5);

			$this->date = $rs->getTimestamp($startcol + 6, null);

			$this->user_name = $rs->getString($startcol + 7);

			$this->user_id = $rs->getInt($startcol + 8);

			$this->created_at = $rs->getTimestamp($startcol + 9, null);

			$this->updated_at = $rs->getTimestamp($startcol + 10, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating SystemEvent object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEvent:delete:pre') as $callable)
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
			$con = Propel::getConnection(SystemEventPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SystemEventPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSystemEvent:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEvent:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(SystemEventPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SystemEventPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SystemEventPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSystemEvent:save:post') as $callable)
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


												
			if ($this->aTerm !== null) {
				if ($this->aTerm->isModified()) {
					$affectedRows += $this->aTerm->save($con);
				}
				$this->setTerm($this->aTerm);
			}

			if ($this->aUser !== null) {
				if ($this->aUser->isModified()) {
					$affectedRows += $this->aUser->save($con);
				}
				$this->setUser($this->aUser);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SystemEventPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SystemEventPeer::doUpdate($this, $con);
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


												
			if ($this->aTerm !== null) {
				if (!$this->aTerm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTerm->getValidationFailures());
				}
			}

			if ($this->aUser !== null) {
				if (!$this->aUser->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUser->getValidationFailures());
				}
			}


			if (($retval = SystemEventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SystemEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getSystemEventTypeId();
				break;
			case 2:
				return $this->getObjectClass();
				break;
			case 3:
				return $this->getObjectId();
				break;
			case 4:
				return $this->getPreEventSnapshot();
				break;
			case 5:
				return $this->getPostEventSnapshot();
				break;
			case 6:
				return $this->getDate();
				break;
			case 7:
				return $this->getUserName();
				break;
			case 8:
				return $this->getUserId();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SystemEventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSystemEventTypeId(),
			$keys[2] => $this->getObjectClass(),
			$keys[3] => $this->getObjectId(),
			$keys[4] => $this->getPreEventSnapshot(),
			$keys[5] => $this->getPostEventSnapshot(),
			$keys[6] => $this->getDate(),
			$keys[7] => $this->getUserName(),
			$keys[8] => $this->getUserId(),
			$keys[9] => $this->getCreatedAt(),
			$keys[10] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SystemEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setSystemEventTypeId($value);
				break;
			case 2:
				$this->setObjectClass($value);
				break;
			case 3:
				$this->setObjectId($value);
				break;
			case 4:
				$this->setPreEventSnapshot($value);
				break;
			case 5:
				$this->setPostEventSnapshot($value);
				break;
			case 6:
				$this->setDate($value);
				break;
			case 7:
				$this->setUserName($value);
				break;
			case 8:
				$this->setUserId($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SystemEventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSystemEventTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setObjectClass($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setObjectId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPreEventSnapshot($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPostEventSnapshot($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setDate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUserName($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUserId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SystemEventPeer::DATABASE_NAME);

		if ($this->isColumnModified(SystemEventPeer::ID)) $criteria->add(SystemEventPeer::ID, $this->id);
		if ($this->isColumnModified(SystemEventPeer::SYSTEM_EVENT_TYPE_ID)) $criteria->add(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->system_event_type_id);
		if ($this->isColumnModified(SystemEventPeer::OBJECT_CLASS)) $criteria->add(SystemEventPeer::OBJECT_CLASS, $this->object_class);
		if ($this->isColumnModified(SystemEventPeer::OBJECT_ID)) $criteria->add(SystemEventPeer::OBJECT_ID, $this->object_id);
		if ($this->isColumnModified(SystemEventPeer::PRE_EVENT_SNAPSHOT)) $criteria->add(SystemEventPeer::PRE_EVENT_SNAPSHOT, $this->pre_event_snapshot);
		if ($this->isColumnModified(SystemEventPeer::POST_EVENT_SNAPSHOT)) $criteria->add(SystemEventPeer::POST_EVENT_SNAPSHOT, $this->post_event_snapshot);
		if ($this->isColumnModified(SystemEventPeer::DATE)) $criteria->add(SystemEventPeer::DATE, $this->date);
		if ($this->isColumnModified(SystemEventPeer::USER_NAME)) $criteria->add(SystemEventPeer::USER_NAME, $this->user_name);
		if ($this->isColumnModified(SystemEventPeer::USER_ID)) $criteria->add(SystemEventPeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(SystemEventPeer::CREATED_AT)) $criteria->add(SystemEventPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SystemEventPeer::UPDATED_AT)) $criteria->add(SystemEventPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SystemEventPeer::DATABASE_NAME);

		$criteria->add(SystemEventPeer::ID, $this->id);

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

		$copyObj->setSystemEventTypeId($this->system_event_type_id);

		$copyObj->setObjectClass($this->object_class);

		$copyObj->setObjectId($this->object_id);

		$copyObj->setPreEventSnapshot($this->pre_event_snapshot);

		$copyObj->setPostEventSnapshot($this->post_event_snapshot);

		$copyObj->setDate($this->date);

		$copyObj->setUserName($this->user_name);

		$copyObj->setUserId($this->user_id);

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
			self::$peer = new SystemEventPeer();
		}
		return self::$peer;
	}

	
	public function setTerm($v)
	{


		if ($v === null) {
			$this->setSystemEventTypeId(NULL);
		} else {
			$this->setSystemEventTypeId($v->getId());
		}


		$this->aTerm = $v;
	}


	
	public function getTerm($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTerm === null && ($this->system_event_type_id !== null)) {

			$this->aTerm = TermPeer::retrieveByPK($this->system_event_type_id, $con);

			
		}
		return $this->aTerm;
	}

	
	public function setUser($v)
	{


		if ($v === null) {
			$this->setUserId(NULL);
		} else {
			$this->setUserId($v->getId());
		}


		$this->aUser = $v;
	}


	
	public function getUser($con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';

		if ($this->aUser === null && ($this->user_id !== null)) {

			$this->aUser = UserPeer::retrieveByPK($this->user_id, $con);

			
		}
		return $this->aUser;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSystemEvent:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSystemEvent::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 