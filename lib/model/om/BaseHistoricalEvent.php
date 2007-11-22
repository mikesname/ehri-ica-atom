<?php


abstract class BaseHistoricalEvent extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $term_id;


	
	protected $historical_event_type_id;


	
	protected $start_date;


	
	protected $start_time;


	
	protected $end_date;


	
	protected $end_time;


	
	protected $date_display;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTermRelatedByTermId;

	
	protected $aTermRelatedByHistoricalEventTypeId;

	
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

	
	public function getHistoricalEventTypeId()
	{

		return $this->historical_event_type_id;
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
			$this->modifiedColumns[] = HistoricalEventPeer::ID;
		}

	} 
	
	public function setTermId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->term_id !== $v) {
			$this->term_id = $v;
			$this->modifiedColumns[] = HistoricalEventPeer::TERM_ID;
		}

		if ($this->aTermRelatedByTermId !== null && $this->aTermRelatedByTermId->getId() !== $v) {
			$this->aTermRelatedByTermId = null;
		}

	} 
	
	public function setHistoricalEventTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->historical_event_type_id !== $v) {
			$this->historical_event_type_id = $v;
			$this->modifiedColumns[] = HistoricalEventPeer::HISTORICAL_EVENT_TYPE_ID;
		}

		if ($this->aTermRelatedByHistoricalEventTypeId !== null && $this->aTermRelatedByHistoricalEventTypeId->getId() !== $v) {
			$this->aTermRelatedByHistoricalEventTypeId = null;
		}

	} 
	
	public function setStartDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->start_date !== $v) {
			$this->start_date = $v;
			$this->modifiedColumns[] = HistoricalEventPeer::START_DATE;
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
			$this->modifiedColumns[] = HistoricalEventPeer::START_TIME;
		}

	} 
	
	public function setEndDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->end_date !== $v) {
			$this->end_date = $v;
			$this->modifiedColumns[] = HistoricalEventPeer::END_DATE;
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
			$this->modifiedColumns[] = HistoricalEventPeer::END_TIME;
		}

	} 
	
	public function setDateDisplay($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->date_display !== $v) {
			$this->date_display = $v;
			$this->modifiedColumns[] = HistoricalEventPeer::DATE_DISPLAY;
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
			$this->modifiedColumns[] = HistoricalEventPeer::CREATED_AT;
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
			$this->modifiedColumns[] = HistoricalEventPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->term_id = $rs->getInt($startcol + 1);

			$this->historical_event_type_id = $rs->getInt($startcol + 2);

			$this->start_date = $rs->getString($startcol + 3);

			$this->start_time = $rs->getTime($startcol + 4, null);

			$this->end_date = $rs->getString($startcol + 5);

			$this->end_time = $rs->getTime($startcol + 6, null);

			$this->date_display = $rs->getString($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HistoricalEvent object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseHistoricalEvent:delete:pre') as $callable)
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
			$con = Propel::getConnection(HistoricalEventPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HistoricalEventPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHistoricalEvent:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseHistoricalEvent:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(HistoricalEventPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(HistoricalEventPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HistoricalEventPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHistoricalEvent:save:post') as $callable)
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

			if ($this->aTermRelatedByHistoricalEventTypeId !== null) {
				if ($this->aTermRelatedByHistoricalEventTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByHistoricalEventTypeId->save($con);
				}
				$this->setTermRelatedByHistoricalEventTypeId($this->aTermRelatedByHistoricalEventTypeId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HistoricalEventPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HistoricalEventPeer::doUpdate($this, $con);
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


												
			if ($this->aTermRelatedByTermId !== null) {
				if (!$this->aTermRelatedByTermId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByTermId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByHistoricalEventTypeId !== null) {
				if (!$this->aTermRelatedByHistoricalEventTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByHistoricalEventTypeId->getValidationFailures());
				}
			}


			if (($retval = HistoricalEventPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HistoricalEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getHistoricalEventTypeId();
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
		$keys = HistoricalEventPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTermId(),
			$keys[2] => $this->getHistoricalEventTypeId(),
			$keys[3] => $this->getStartDate(),
			$keys[4] => $this->getStartTime(),
			$keys[5] => $this->getEndDate(),
			$keys[6] => $this->getEndTime(),
			$keys[7] => $this->getDateDisplay(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HistoricalEventPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setHistoricalEventTypeId($value);
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
				$this->setCreatedAt($value);
				break;
			case 9:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HistoricalEventPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTermId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setHistoricalEventTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStartDate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setStartTime($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEndDate($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEndTime($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDateDisplay($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HistoricalEventPeer::DATABASE_NAME);

		if ($this->isColumnModified(HistoricalEventPeer::ID)) $criteria->add(HistoricalEventPeer::ID, $this->id);
		if ($this->isColumnModified(HistoricalEventPeer::TERM_ID)) $criteria->add(HistoricalEventPeer::TERM_ID, $this->term_id);
		if ($this->isColumnModified(HistoricalEventPeer::HISTORICAL_EVENT_TYPE_ID)) $criteria->add(HistoricalEventPeer::HISTORICAL_EVENT_TYPE_ID, $this->historical_event_type_id);
		if ($this->isColumnModified(HistoricalEventPeer::START_DATE)) $criteria->add(HistoricalEventPeer::START_DATE, $this->start_date);
		if ($this->isColumnModified(HistoricalEventPeer::START_TIME)) $criteria->add(HistoricalEventPeer::START_TIME, $this->start_time);
		if ($this->isColumnModified(HistoricalEventPeer::END_DATE)) $criteria->add(HistoricalEventPeer::END_DATE, $this->end_date);
		if ($this->isColumnModified(HistoricalEventPeer::END_TIME)) $criteria->add(HistoricalEventPeer::END_TIME, $this->end_time);
		if ($this->isColumnModified(HistoricalEventPeer::DATE_DISPLAY)) $criteria->add(HistoricalEventPeer::DATE_DISPLAY, $this->date_display);
		if ($this->isColumnModified(HistoricalEventPeer::CREATED_AT)) $criteria->add(HistoricalEventPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(HistoricalEventPeer::UPDATED_AT)) $criteria->add(HistoricalEventPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HistoricalEventPeer::DATABASE_NAME);

		$criteria->add(HistoricalEventPeer::ID, $this->id);

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

		$copyObj->setHistoricalEventTypeId($this->historical_event_type_id);

		$copyObj->setStartDate($this->start_date);

		$copyObj->setStartTime($this->start_time);

		$copyObj->setEndDate($this->end_date);

		$copyObj->setEndTime($this->end_time);

		$copyObj->setDateDisplay($this->date_display);

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
			self::$peer = new HistoricalEventPeer();
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

	
	public function setTermRelatedByHistoricalEventTypeId($v)
	{


		if ($v === null) {
			$this->setHistoricalEventTypeId(NULL);
		} else {
			$this->setHistoricalEventTypeId($v->getId());
		}


		$this->aTermRelatedByHistoricalEventTypeId = $v;
	}


	
	public function getTermRelatedByHistoricalEventTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByHistoricalEventTypeId === null && ($this->historical_event_type_id !== null)) {

			$this->aTermRelatedByHistoricalEventTypeId = TermPeer::retrieveByPK($this->historical_event_type_id, $con);

			
		}
		return $this->aTermRelatedByHistoricalEventTypeId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHistoricalEvent:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHistoricalEvent::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 