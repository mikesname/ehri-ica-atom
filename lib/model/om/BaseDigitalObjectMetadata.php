<?php


abstract class BaseDigitalObjectMetadata extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $digital_object_id;


	
	protected $element;


	
	protected $value;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aDigitalObject;

	
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

	
	public function getElement()
	{

		return $this->element;
	}

	
	public function getValue()
	{

		return $this->value;
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
			$this->modifiedColumns[] = DigitalObjectMetadataPeer::ID;
		}

	} 
	
	public function setDigitalObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->digital_object_id !== $v) {
			$this->digital_object_id = $v;
			$this->modifiedColumns[] = DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID;
		}

		if ($this->aDigitalObject !== null && $this->aDigitalObject->getId() !== $v) {
			$this->aDigitalObject = null;
		}

	} 
	
	public function setElement($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->element !== $v) {
			$this->element = $v;
			$this->modifiedColumns[] = DigitalObjectMetadataPeer::ELEMENT;
		}

	} 
	
	public function setValue($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->value !== $v) {
			$this->value = $v;
			$this->modifiedColumns[] = DigitalObjectMetadataPeer::VALUE;
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
			$this->modifiedColumns[] = DigitalObjectMetadataPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DigitalObjectMetadataPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->digital_object_id = $rs->getInt($startcol + 1);

			$this->element = $rs->getString($startcol + 2);

			$this->value = $rs->getString($startcol + 3);

			$this->created_at = $rs->getTimestamp($startcol + 4, null);

			$this->updated_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DigitalObjectMetadata object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadata:delete:pre') as $callable)
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
			$con = Propel::getConnection(DigitalObjectMetadataPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DigitalObjectMetadataPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadata:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadata:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DigitalObjectMetadataPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DigitalObjectMetadataPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DigitalObjectMetadataPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDigitalObjectMetadata:save:post') as $callable)
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


												
			if ($this->aDigitalObject !== null) {
				if ($this->aDigitalObject->isModified()) {
					$affectedRows += $this->aDigitalObject->save($con);
				}
				$this->setDigitalObject($this->aDigitalObject);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DigitalObjectMetadataPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DigitalObjectMetadataPeer::doUpdate($this, $con);
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


												
			if ($this->aDigitalObject !== null) {
				if (!$this->aDigitalObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDigitalObject->getValidationFailures());
				}
			}


			if (($retval = DigitalObjectMetadataPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DigitalObjectMetadataPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getElement();
				break;
			case 3:
				return $this->getValue();
				break;
			case 4:
				return $this->getCreatedAt();
				break;
			case 5:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DigitalObjectMetadataPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDigitalObjectId(),
			$keys[2] => $this->getElement(),
			$keys[3] => $this->getValue(),
			$keys[4] => $this->getCreatedAt(),
			$keys[5] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DigitalObjectMetadataPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setElement($value);
				break;
			case 3:
				$this->setValue($value);
				break;
			case 4:
				$this->setCreatedAt($value);
				break;
			case 5:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DigitalObjectMetadataPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDigitalObjectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setElement($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setValue($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCreatedAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUpdatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DigitalObjectMetadataPeer::DATABASE_NAME);

		if ($this->isColumnModified(DigitalObjectMetadataPeer::ID)) $criteria->add(DigitalObjectMetadataPeer::ID, $this->id);
		if ($this->isColumnModified(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID)) $criteria->add(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, $this->digital_object_id);
		if ($this->isColumnModified(DigitalObjectMetadataPeer::ELEMENT)) $criteria->add(DigitalObjectMetadataPeer::ELEMENT, $this->element);
		if ($this->isColumnModified(DigitalObjectMetadataPeer::VALUE)) $criteria->add(DigitalObjectMetadataPeer::VALUE, $this->value);
		if ($this->isColumnModified(DigitalObjectMetadataPeer::CREATED_AT)) $criteria->add(DigitalObjectMetadataPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DigitalObjectMetadataPeer::UPDATED_AT)) $criteria->add(DigitalObjectMetadataPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DigitalObjectMetadataPeer::DATABASE_NAME);

		$criteria->add(DigitalObjectMetadataPeer::ID, $this->id);

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

		$copyObj->setElement($this->element);

		$copyObj->setValue($this->value);

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
			self::$peer = new DigitalObjectMetadataPeer();
		}
		return self::$peer;
	}

	
	public function setDigitalObject($v)
	{


		if ($v === null) {
			$this->setDigitalObjectId(NULL);
		} else {
			$this->setDigitalObjectId($v->getId());
		}


		$this->aDigitalObject = $v;
	}


	
	public function getDigitalObject($con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';

		if ($this->aDigitalObject === null && ($this->digital_object_id !== null)) {

			$this->aDigitalObject = DigitalObjectPeer::retrieveByPK($this->digital_object_id, $con);

			
		}
		return $this->aDigitalObject;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDigitalObjectMetadata:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDigitalObjectMetadata::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 