<?php


abstract class BaseEvent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $description;


	
	protected $start_date;


	
	protected $start_time;


	
	protected $end_date;


	
	protected $end_time;


	
	protected $date_display;


	
	protected $event_type_id;


	
	protected $actor_role_id;


	
	protected $information_object_id;


	
	protected $actor_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTermRelatedByEventTypeId;

	
	protected $aTermRelatedByActorRoleId;

	
	protected $ainformationObject;

	
	protected $aActor;

	
	protected $colleventTermRelationships;

	
	protected $lasteventTermRelationshipCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getStartDate()
	{

		return $this->start_date;
	}

	
	public function getStartTime($format = 'H:i:s')
	{

		if ($this->start_time === null || $this->start_time === '') {
			return null;
		} elseif (!is_int($this->start_time)) {
						$ts = strtotime($this->start_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [start_time] as date/time value: " . var_export($this->start_time, true));
			}
		} else {
			$ts = $this->start_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getEndDate()
	{

		return $this->end_date;
	}

	
	public function getEndTime($format = 'H:i:s')
	{

		if ($this->end_time === null || $this->end_time === '') {
			return null;
		} elseif (!is_int($this->end_time)) {
						$ts = strtotime($this->end_time);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [end_time] as date/time value: " . var_export($this->end_time, true));
			}
		} else {
			$ts = $this->end_time;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDateDisplay()
	{

		return $this->date_display;
	}

	
	public function getEventTypeId()
	{

		return $this->event_type_id;
	}

	
	public function getActorRoleId()
	{

		return $this->actor_role_id;
	}

	
	public function getInformationObjectId()
	{

		return $this->information_object_id;
	}

	
	public function getActorId()
	{

		return $this->actor_id;
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
			$this->modifiedColumns[] = EventPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = EventPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = EventPeer::DESCRIPTION;
		}

	} 
	
	public function setStartDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->start_date !== $v) {
			$this->start_date = $v;
			$this->modifiedColumns[] = EventPeer::START_DATE;
		}

	} 
	
	public function setStartTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [start_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->start_time !== $ts) {
			$this->start_time = $ts;
			$this->modifiedColumns[] = EventPeer::START_TIME;
		}

	} 
	
	public function setEndDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->end_date !== $v) {
			$this->end_date = $v;
			$this->modifiedColumns[] = EventPeer::END_DATE;
		}

	} 
	
	public function setEndTime($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [end_time] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->end_time !== $ts) {
			$this->end_time = $ts;
			$this->modifiedColumns[] = EventPeer::END_TIME;
		}

	} 
	
	public function setDateDisplay($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->date_display !== $v) {
			$this->date_display = $v;
			$this->modifiedColumns[] = EventPeer::DATE_DISPLAY;
		}

	} 
	
	public function setEventTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->event_type_id !== $v) {
			$this->event_type_id = $v;
			$this->modifiedColumns[] = EventPeer::EVENT_TYPE_ID;
		}

		if ($this->aTermRelatedByEventTypeId !== null && $this->aTermRelatedByEventTypeId->getId() !== $v) {
			$this->aTermRelatedByEventTypeId = null;
		}

	} 
	
	public function setActorRoleId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->actor_role_id !== $v) {
			$this->actor_role_id = $v;
			$this->modifiedColumns[] = EventPeer::ACTOR_ROLE_ID;
		}

		if ($this->aTermRelatedByActorRoleId !== null && $this->aTermRelatedByActorRoleId->getId() !== $v) {
			$this->aTermRelatedByActorRoleId = null;
		}

	} 
	
	public function setInformationObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->information_object_id !== $v) {
			$this->information_object_id = $v;
			$this->modifiedColumns[] = EventPeer::INFORMATION_OBJECT_ID;
		}

		if ($this->ainformationObject !== null && $this->ainformationObject->getId() !== $v) {
			$this->ainformationObject = null;
		}

	} 
	
	public function setActorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->actor_id !== $v) {
			$this->actor_id = $v;
			$this->modifiedColumns[] = EventPeer::ACTOR_ID;
		}

		if ($this->aActor !== null && $this->aActor->getId() !== $v) {
			$this->aActor = null;
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
			$this->modifiedColumns[] = EventPeer::CREATED_AT;
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
			$this->modifiedColumns[] = EventPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->start_date = $rs->getString($startcol + 3);

			$this->start_time = $rs->getTime($startcol + 4, null);

			$this->end_date = $rs->getString($startcol + 5);

			$this->end_time = $rs->getTime($startcol + 6, null);

			$this->date_display = $rs->getString($startcol + 7);

			$this->event_type_id = $rs->getInt($startcol + 8);

			$this->actor_role_id = $rs->getInt($startcol + 9);

			$this->information_object_id = $rs->getInt($startcol + 10);

			$this->actor_id = $rs->getInt($startcol + 11);

			$this->created_at = $rs->getTimestamp($startcol + 12, null);

			$this->updated_at = $rs->getTimestamp($startcol + 13, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Event object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseEvent:delete:pre') as $callable)
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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			EventPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseEvent:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseEvent:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(EventPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(EventPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(EventPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseEvent:save:post') as $callable)
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


												
			if ($this->aTermRelatedByEventTypeId !== null) {
				if ($this->aTermRelatedByEventTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByEventTypeId->save($con);
				}
				$this->setTermRelatedByEventTypeId($this->aTermRelatedByEventTypeId);
			}

			if ($this->aTermRelatedByActorRoleId !== null) {
				if ($this->aTermRelatedByActorRoleId->isModified()) {
					$affectedRows += $this->aTermRelatedByActorRoleId->save($con);
				}
				$this->setTermRelatedByActorRoleId($this->aTermRelatedByActorRoleId);
			}

			if ($this->ainformationObject !== null) {
				if ($this->ainformationObject->isModified()) {
					$affectedRows += $this->ainformationObject->save($con);
				}
				$this->setinformationObject($this->ainformationObject);
			}

			if ($this->aActor !== null) {
				if ($this->aActor->isModified()) {
					$affectedRows += $this->aActor->save($con);
				}
				$this->setActor($this->aActor);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EventPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EventPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->colleventTermRelationships !== null) {
				foreach($this->colleventTermRelationships as $referrerFK) {
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


												
			if ($this->aTermRelatedByEventTypeId !== null) {
				if (!$this->aTermRelatedByEventTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByEventTypeId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByActorRoleId !== null) {
				if (!$this->aTermRelatedByActorRoleId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByActorRoleId->getValidationFailures());
				}
			}

			if ($this->ainformationObject !== null) {
				if (!$this->ainformationObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->ainformationObject->getValidationFailures());
				}
			}

			if ($this->aActor !== null) {
				if (!$this->aActor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActor->getValidationFailures());
				}
			}


			if (($retval = EventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->colleventTermRelationships !== null) {
					foreach($this->colleventTermRelationships as $referrerFK) {
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
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getStartDate();
				break;
			case 4:
				return $this->getStartTime();
				break;
			case 5:
				return $this->getEndDate();
				break;
			case 6:
				return $this->getEndTime();
				break;
			case 7:
				return $this->getDateDisplay();
				break;
			case 8:
				return $this->getEventTypeId();
				break;
			case 9:
				return $this->getActorRoleId();
				break;
			case 10:
				return $this->getInformationObjectId();
				break;
			case 11:
				return $this->getActorId();
				break;
			case 12:
				return $this->getCreatedAt();
				break;
			case 13:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getStartDate(),
			$keys[4] => $this->getStartTime(),
			$keys[5] => $this->getEndDate(),
			$keys[6] => $this->getEndTime(),
			$keys[7] => $this->getDateDisplay(),
			$keys[8] => $this->getEventTypeId(),
			$keys[9] => $this->getActorRoleId(),
			$keys[10] => $this->getInformationObjectId(),
			$keys[11] => $this->getActorId(),
			$keys[12] => $this->getCreatedAt(),
			$keys[13] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setStartDate($value);
				break;
			case 4:
				$this->setStartTime($value);
				break;
			case 5:
				$this->setEndDate($value);
				break;
			case 6:
				$this->setEndTime($value);
				break;
			case 7:
				$this->setDateDisplay($value);
				break;
			case 8:
				$this->setEventTypeId($value);
				break;
			case 9:
				$this->setActorRoleId($value);
				break;
			case 10:
				$this->setInformationObjectId($value);
				break;
			case 11:
				$this->setActorId($value);
				break;
			case 12:
				$this->setCreatedAt($value);
				break;
			case 13:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStartDate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStartTime($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEndDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEndTime($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDateDisplay($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEventTypeId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setActorRoleId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setInformationObjectId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setActorId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EventPeer::DATABASE_NAME);

		if ($this->isColumnModified(EventPeer::ID)) $criteria->add(EventPeer::ID, $this->id);
		if ($this->isColumnModified(EventPeer::NAME)) $criteria->add(EventPeer::NAME, $this->name);
		if ($this->isColumnModified(EventPeer::DESCRIPTION)) $criteria->add(EventPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(EventPeer::START_DATE)) $criteria->add(EventPeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(EventPeer::START_TIME)) $criteria->add(EventPeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(EventPeer::END_DATE)) $criteria->add(EventPeer::END_DATE, $this->end_date);
		if ($this->isColumnModified(EventPeer::END_TIME)) $criteria->add(EventPeer::END_TIME, $this->end_time);
		if ($this->isColumnModified(EventPeer::DATE_DISPLAY)) $criteria->add(EventPeer::DATE_DISPLAY, $this->date_display);
		if ($this->isColumnModified(EventPeer::EVENT_TYPE_ID)) $criteria->add(EventPeer::EVENT_TYPE_ID, $this->event_type_id);
		if ($this->isColumnModified(EventPeer::ACTOR_ROLE_ID)) $criteria->add(EventPeer::ACTOR_ROLE_ID, $this->actor_role_id);
		if ($this->isColumnModified(EventPeer::INFORMATION_OBJECT_ID)) $criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->information_object_id);
		if ($this->isColumnModified(EventPeer::ACTOR_ID)) $criteria->add(EventPeer::ACTOR_ID, $this->actor_id);
		if ($this->isColumnModified(EventPeer::CREATED_AT)) $criteria->add(EventPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(EventPeer::UPDATED_AT)) $criteria->add(EventPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EventPeer::DATABASE_NAME);

		$criteria->add(EventPeer::ID, $this->id);

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

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setStartDate($this->start_date);

		$copyObj->setStartTime($this->start_time);

		$copyObj->setEndDate($this->end_date);

		$copyObj->setEndTime($this->end_time);

		$copyObj->setDateDisplay($this->date_display);

		$copyObj->setEventTypeId($this->event_type_id);

		$copyObj->setActorRoleId($this->actor_role_id);

		$copyObj->setInformationObjectId($this->information_object_id);

		$copyObj->setActorId($this->actor_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->geteventTermRelationships() as $relObj) {
				$copyObj->addeventTermRelationship($relObj->copy($deepCopy));
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
			self::$peer = new EventPeer();
		}
		return self::$peer;
	}

	
	public function setTermRelatedByEventTypeId($v)
	{


		if ($v === null) {
			$this->setEventTypeId(NULL);
		} else {
			$this->setEventTypeId($v->getId());
		}


		$this->aTermRelatedByEventTypeId = $v;
	}


	
	public function getTermRelatedByEventTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByEventTypeId === null && ($this->event_type_id !== null)) {

			$this->aTermRelatedByEventTypeId = TermPeer::retrieveByPK($this->event_type_id, $con);

			
		}
		return $this->aTermRelatedByEventTypeId;
	}

	
	public function setTermRelatedByActorRoleId($v)
	{


		if ($v === null) {
			$this->setActorRoleId(NULL);
		} else {
			$this->setActorRoleId($v->getId());
		}


		$this->aTermRelatedByActorRoleId = $v;
	}


	
	public function getTermRelatedByActorRoleId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByActorRoleId === null && ($this->actor_role_id !== null)) {

			$this->aTermRelatedByActorRoleId = TermPeer::retrieveByPK($this->actor_role_id, $con);

			
		}
		return $this->aTermRelatedByActorRoleId;
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

	
	public function initeventTermRelationships()
	{
		if ($this->colleventTermRelationships === null) {
			$this->colleventTermRelationships = array();
		}
	}

	
	public function geteventTermRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colleventTermRelationships === null) {
			if ($this->isNew()) {
			   $this->colleventTermRelationships = array();
			} else {

				$criteria->add(eventTermRelationshipPeer::EVENT_ID, $this->getId());

				eventTermRelationshipPeer::addSelectColumns($criteria);
				$this->colleventTermRelationships = eventTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(eventTermRelationshipPeer::EVENT_ID, $this->getId());

				eventTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lasteventTermRelationshipCriteria) || !$this->lasteventTermRelationshipCriteria->equals($criteria)) {
					$this->colleventTermRelationships = eventTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasteventTermRelationshipCriteria = $criteria;
		return $this->colleventTermRelationships;
	}

	
	public function counteventTermRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(eventTermRelationshipPeer::EVENT_ID, $this->getId());

		return eventTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addeventTermRelationship(eventTermRelationship $l)
	{
		$this->colleventTermRelationships[] = $l;
		$l->setEvent($this);
	}


	
	public function geteventTermRelationshipsJoinTermRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colleventTermRelationships === null) {
			if ($this->isNew()) {
				$this->colleventTermRelationships = array();
			} else {

				$criteria->add(eventTermRelationshipPeer::EVENT_ID, $this->getId());

				$this->colleventTermRelationships = eventTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		} else {
									
			$criteria->add(eventTermRelationshipPeer::EVENT_ID, $this->getId());

			if (!isset($this->lasteventTermRelationshipCriteria) || !$this->lasteventTermRelationshipCriteria->equals($criteria)) {
				$this->colleventTermRelationships = eventTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		}
		$this->lasteventTermRelationshipCriteria = $criteria;

		return $this->colleventTermRelationships;
	}


	
	public function geteventTermRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colleventTermRelationships === null) {
			if ($this->isNew()) {
				$this->colleventTermRelationships = array();
			} else {

				$criteria->add(eventTermRelationshipPeer::EVENT_ID, $this->getId());

				$this->colleventTermRelationships = eventTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(eventTermRelationshipPeer::EVENT_ID, $this->getId());

			if (!isset($this->lasteventTermRelationshipCriteria) || !$this->lasteventTermRelationshipCriteria->equals($criteria)) {
				$this->colleventTermRelationships = eventTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lasteventTermRelationshipCriteria = $criteria;

		return $this->colleventTermRelationships;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseEvent:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseEvent::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 