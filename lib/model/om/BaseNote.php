<?php


abstract class BaseNote extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $information_object_id;


	
	protected $actor_id;


	
	protected $repository_id;


	
	protected $function_description_id;


	
	protected $note;


	
	protected $note_type_id;


	
	protected $user_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $ainformationObject;

	
	protected $aActor;

	
	protected $aRepository;

	
	protected $afunctionDescription;

	
	protected $aTerm;

	
	protected $aUser;

	
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

	
	public function getActorId()
	{

		return $this->actor_id;
	}

	
	public function getRepositoryId()
	{

		return $this->repository_id;
	}

	
	public function getFunctionDescriptionId()
	{

		return $this->function_description_id;
	}

	
	public function getNote()
	{

		return $this->note;
	}

	
	public function getNoteTypeId()
	{

		return $this->note_type_id;
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
			$this->modifiedColumns[] = NotePeer::ID;
		}

	} 
	
	public function setInformationObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->information_object_id !== $v) {
			$this->information_object_id = $v;
			$this->modifiedColumns[] = NotePeer::INFORMATION_OBJECT_ID;
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
			$this->modifiedColumns[] = NotePeer::ACTOR_ID;
		}

		if ($this->aActor !== null && $this->aActor->getId() !== $v) {
			$this->aActor = null;
		}

	} 
	
	public function setRepositoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->repository_id !== $v) {
			$this->repository_id = $v;
			$this->modifiedColumns[] = NotePeer::REPOSITORY_ID;
		}

		if ($this->aRepository !== null && $this->aRepository->getId() !== $v) {
			$this->aRepository = null;
		}

	} 
	
	public function setFunctionDescriptionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->function_description_id !== $v) {
			$this->function_description_id = $v;
			$this->modifiedColumns[] = NotePeer::FUNCTION_DESCRIPTION_ID;
		}

		if ($this->afunctionDescription !== null && $this->afunctionDescription->getId() !== $v) {
			$this->afunctionDescription = null;
		}

	} 
	
	public function setNote($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = NotePeer::NOTE;
		}

	} 
	
	public function setNoteTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->note_type_id !== $v) {
			$this->note_type_id = $v;
			$this->modifiedColumns[] = NotePeer::NOTE_TYPE_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

	} 
	
	public function setUserId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->user_id !== $v) {
			$this->user_id = $v;
			$this->modifiedColumns[] = NotePeer::USER_ID;
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
			$this->modifiedColumns[] = NotePeer::CREATED_AT;
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
			$this->modifiedColumns[] = NotePeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->information_object_id = $rs->getInt($startcol + 1);

			$this->actor_id = $rs->getInt($startcol + 2);

			$this->repository_id = $rs->getInt($startcol + 3);

			$this->function_description_id = $rs->getInt($startcol + 4);

			$this->note = $rs->getString($startcol + 5);

			$this->note_type_id = $rs->getInt($startcol + 6);

			$this->user_id = $rs->getInt($startcol + 7);

			$this->created_at = $rs->getTimestamp($startcol + 8, null);

			$this->updated_at = $rs->getTimestamp($startcol + 9, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Note object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseNote:delete:pre') as $callable)
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
			$con = Propel::getConnection(NotePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NotePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseNote:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseNote:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(NotePeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(NotePeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NotePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseNote:save:post') as $callable)
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

			if ($this->aActor !== null) {
				if ($this->aActor->isModified()) {
					$affectedRows += $this->aActor->save($con);
				}
				$this->setActor($this->aActor);
			}

			if ($this->aRepository !== null) {
				if ($this->aRepository->isModified()) {
					$affectedRows += $this->aRepository->save($con);
				}
				$this->setRepository($this->aRepository);
			}

			if ($this->afunctionDescription !== null) {
				if ($this->afunctionDescription->isModified()) {
					$affectedRows += $this->afunctionDescription->save($con);
				}
				$this->setfunctionDescription($this->afunctionDescription);
			}

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
					$pk = NotePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NotePeer::doUpdate($this, $con);
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

			if ($this->aRepository !== null) {
				if (!$this->aRepository->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepository->getValidationFailures());
				}
			}

			if ($this->afunctionDescription !== null) {
				if (!$this->afunctionDescription->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->afunctionDescription->getValidationFailures());
				}
			}

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


			if (($retval = NotePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getActorId();
				break;
			case 3:
				return $this->getRepositoryId();
				break;
			case 4:
				return $this->getFunctionDescriptionId();
				break;
			case 5:
				return $this->getNote();
				break;
			case 6:
				return $this->getNoteTypeId();
				break;
			case 7:
				return $this->getUserId();
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
		$keys = NotePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getInformationObjectId(),
			$keys[2] => $this->getActorId(),
			$keys[3] => $this->getRepositoryId(),
			$keys[4] => $this->getFunctionDescriptionId(),
			$keys[5] => $this->getNote(),
			$keys[6] => $this->getNoteTypeId(),
			$keys[7] => $this->getUserId(),
			$keys[8] => $this->getCreatedAt(),
			$keys[9] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setActorId($value);
				break;
			case 3:
				$this->setRepositoryId($value);
				break;
			case 4:
				$this->setFunctionDescriptionId($value);
				break;
			case 5:
				$this->setNote($value);
				break;
			case 6:
				$this->setNoteTypeId($value);
				break;
			case 7:
				$this->setUserId($value);
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
		$keys = NotePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setInformationObjectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setActorId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRepositoryId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setFunctionDescriptionId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNote($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNoteTypeId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUserId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NotePeer::DATABASE_NAME);

		if ($this->isColumnModified(NotePeer::ID)) $criteria->add(NotePeer::ID, $this->id);
		if ($this->isColumnModified(NotePeer::INFORMATION_OBJECT_ID)) $criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->information_object_id);
		if ($this->isColumnModified(NotePeer::ACTOR_ID)) $criteria->add(NotePeer::ACTOR_ID, $this->actor_id);
		if ($this->isColumnModified(NotePeer::REPOSITORY_ID)) $criteria->add(NotePeer::REPOSITORY_ID, $this->repository_id);
		if ($this->isColumnModified(NotePeer::FUNCTION_DESCRIPTION_ID)) $criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->function_description_id);
		if ($this->isColumnModified(NotePeer::NOTE)) $criteria->add(NotePeer::NOTE, $this->note);
		if ($this->isColumnModified(NotePeer::NOTE_TYPE_ID)) $criteria->add(NotePeer::NOTE_TYPE_ID, $this->note_type_id);
		if ($this->isColumnModified(NotePeer::USER_ID)) $criteria->add(NotePeer::USER_ID, $this->user_id);
		if ($this->isColumnModified(NotePeer::CREATED_AT)) $criteria->add(NotePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(NotePeer::UPDATED_AT)) $criteria->add(NotePeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NotePeer::DATABASE_NAME);

		$criteria->add(NotePeer::ID, $this->id);

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

		$copyObj->setActorId($this->actor_id);

		$copyObj->setRepositoryId($this->repository_id);

		$copyObj->setFunctionDescriptionId($this->function_description_id);

		$copyObj->setNote($this->note);

		$copyObj->setNoteTypeId($this->note_type_id);

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
			self::$peer = new NotePeer();
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

	
	public function setRepository($v)
	{


		if ($v === null) {
			$this->setRepositoryId(NULL);
		} else {
			$this->setRepositoryId($v->getId());
		}


		$this->aRepository = $v;
	}


	
	public function getRepository($con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';

		if ($this->aRepository === null && ($this->repository_id !== null)) {

			$this->aRepository = RepositoryPeer::retrieveByPK($this->repository_id, $con);

			
		}
		return $this->aRepository;
	}

	
	public function setfunctionDescription($v)
	{


		if ($v === null) {
			$this->setFunctionDescriptionId(NULL);
		} else {
			$this->setFunctionDescriptionId($v->getId());
		}


		$this->afunctionDescription = $v;
	}


	
	public function getfunctionDescription($con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';

		if ($this->afunctionDescription === null && ($this->function_description_id !== null)) {

			$this->afunctionDescription = functionDescriptionPeer::retrieveByPK($this->function_description_id, $con);

			
		}
		return $this->afunctionDescription;
	}

	
	public function setTerm($v)
	{


		if ($v === null) {
			$this->setNoteTypeId(NULL);
		} else {
			$this->setNoteTypeId($v->getId());
		}


		$this->aTerm = $v;
	}


	
	public function getTerm($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTerm === null && ($this->note_type_id !== null)) {

			$this->aTerm = TermPeer::retrieveByPK($this->note_type_id, $con);

			
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
    if (!$callable = sfMixer::getCallable('BaseNote:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseNote::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 