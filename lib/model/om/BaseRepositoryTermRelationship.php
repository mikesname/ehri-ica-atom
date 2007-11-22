<?php


abstract class BaseRepositoryTermRelationship extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $repository_id;


	
	protected $term_id;


	
	protected $relationship_type_id;


	
	protected $relationship_note;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aRepository;

	
	protected $aTermRelatedByTermId;

	
	protected $aTermRelatedByRelationshipTypeId;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getRepositoryId()
	{

		return $this->repository_id;
	}

	
	public function getTermId()
	{

		return $this->term_id;
	}

	
	public function getRelationshipTypeId()
	{

		return $this->relationship_type_id;
	}

	
	public function getRelationshipNote()
	{

		return $this->relationship_note;
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
			$this->modifiedColumns[] = RepositoryTermRelationshipPeer::ID;
		}

	} 
	
	public function setRepositoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->repository_id !== $v) {
			$this->repository_id = $v;
			$this->modifiedColumns[] = RepositoryTermRelationshipPeer::REPOSITORY_ID;
		}

		if ($this->aRepository !== null && $this->aRepository->getId() !== $v) {
			$this->aRepository = null;
		}

	} 
	
	public function setTermId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->term_id !== $v) {
			$this->term_id = $v;
			$this->modifiedColumns[] = RepositoryTermRelationshipPeer::TERM_ID;
		}

		if ($this->aTermRelatedByTermId !== null && $this->aTermRelatedByTermId->getId() !== $v) {
			$this->aTermRelatedByTermId = null;
		}

	} 
	
	public function setRelationshipTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relationship_type_id !== $v) {
			$this->relationship_type_id = $v;
			$this->modifiedColumns[] = RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID;
		}

		if ($this->aTermRelatedByRelationshipTypeId !== null && $this->aTermRelatedByRelationshipTypeId->getId() !== $v) {
			$this->aTermRelatedByRelationshipTypeId = null;
		}

	} 
	
	public function setRelationshipNote($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->relationship_note !== $v) {
			$this->relationship_note = $v;
			$this->modifiedColumns[] = RepositoryTermRelationshipPeer::RELATIONSHIP_NOTE;
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
			$this->modifiedColumns[] = RepositoryTermRelationshipPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RepositoryTermRelationshipPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->repository_id = $rs->getInt($startcol + 1);

			$this->term_id = $rs->getInt($startcol + 2);

			$this->relationship_type_id = $rs->getInt($startcol + 3);

			$this->relationship_note = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->updated_at = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepositoryTermRelationship object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryTermRelationship:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepositoryTermRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RepositoryTermRelationshipPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepositoryTermRelationship:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryTermRelationship:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(RepositoryTermRelationshipPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RepositoryTermRelationshipPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RepositoryTermRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepositoryTermRelationship:save:post') as $callable)
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


												
			if ($this->aRepository !== null) {
				if ($this->aRepository->isModified()) {
					$affectedRows += $this->aRepository->save($con);
				}
				$this->setRepository($this->aRepository);
			}

			if ($this->aTermRelatedByTermId !== null) {
				if ($this->aTermRelatedByTermId->isModified()) {
					$affectedRows += $this->aTermRelatedByTermId->save($con);
				}
				$this->setTermRelatedByTermId($this->aTermRelatedByTermId);
			}

			if ($this->aTermRelatedByRelationshipTypeId !== null) {
				if ($this->aTermRelatedByRelationshipTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByRelationshipTypeId->save($con);
				}
				$this->setTermRelatedByRelationshipTypeId($this->aTermRelatedByRelationshipTypeId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepositoryTermRelationshipPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RepositoryTermRelationshipPeer::doUpdate($this, $con);
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


												
			if ($this->aRepository !== null) {
				if (!$this->aRepository->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepository->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByTermId !== null) {
				if (!$this->aTermRelatedByTermId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByTermId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByRelationshipTypeId !== null) {
				if (!$this->aTermRelatedByRelationshipTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByRelationshipTypeId->getValidationFailures());
				}
			}


			if (($retval = RepositoryTermRelationshipPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepositoryTermRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getRepositoryId();
				break;
			case 2:
				return $this->getTermId();
				break;
			case 3:
				return $this->getRelationshipTypeId();
				break;
			case 4:
				return $this->getRelationshipNote();
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
		$keys = RepositoryTermRelationshipPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getRepositoryId(),
			$keys[2] => $this->getTermId(),
			$keys[3] => $this->getRelationshipTypeId(),
			$keys[4] => $this->getRelationshipNote(),
			$keys[5] => $this->getCreatedAt(),
			$keys[6] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepositoryTermRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setRepositoryId($value);
				break;
			case 2:
				$this->setTermId($value);
				break;
			case 3:
				$this->setRelationshipTypeId($value);
				break;
			case 4:
				$this->setRelationshipNote($value);
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
		$keys = RepositoryTermRelationshipPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRepositoryId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTermId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRelationshipTypeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRelationshipNote($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUpdatedAt($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepositoryTermRelationshipPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepositoryTermRelationshipPeer::ID)) $criteria->add(RepositoryTermRelationshipPeer::ID, $this->id);
		if ($this->isColumnModified(RepositoryTermRelationshipPeer::REPOSITORY_ID)) $criteria->add(RepositoryTermRelationshipPeer::REPOSITORY_ID, $this->repository_id);
		if ($this->isColumnModified(RepositoryTermRelationshipPeer::TERM_ID)) $criteria->add(RepositoryTermRelationshipPeer::TERM_ID, $this->term_id);
		if ($this->isColumnModified(RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID)) $criteria->add(RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->relationship_type_id);
		if ($this->isColumnModified(RepositoryTermRelationshipPeer::RELATIONSHIP_NOTE)) $criteria->add(RepositoryTermRelationshipPeer::RELATIONSHIP_NOTE, $this->relationship_note);
		if ($this->isColumnModified(RepositoryTermRelationshipPeer::CREATED_AT)) $criteria->add(RepositoryTermRelationshipPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RepositoryTermRelationshipPeer::UPDATED_AT)) $criteria->add(RepositoryTermRelationshipPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepositoryTermRelationshipPeer::DATABASE_NAME);

		$criteria->add(RepositoryTermRelationshipPeer::ID, $this->id);

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

		$copyObj->setRepositoryId($this->repository_id);

		$copyObj->setTermId($this->term_id);

		$copyObj->setRelationshipTypeId($this->relationship_type_id);

		$copyObj->setRelationshipNote($this->relationship_note);

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
			self::$peer = new RepositoryTermRelationshipPeer();
		}
		return self::$peer;
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
    if (!$callable = sfMixer::getCallable('BaseRepositoryTermRelationship:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepositoryTermRelationship::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 