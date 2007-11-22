<?php


abstract class BaseUser extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $user_name;


	
	protected $email;


	
	protected $sha1_password;


	
	protected $salt;


	
	protected $actor_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aActor;

	
	protected $collNotes;

	
	protected $lastNoteCriteria = null;

	
	protected $collSystemEvents;

	
	protected $lastSystemEventCriteria = null;

	
	protected $collUserTermRelationships;

	
	protected $lastUserTermRelationshipCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getUserName()
	{

		return $this->user_name;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getSha1Password()
	{

		return $this->sha1_password;
	}

	
	public function getSalt()
	{

		return $this->salt;
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
			$this->modifiedColumns[] = UserPeer::ID;
		}

	} 
	
	public function setUserName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user_name !== $v) {
			$this->user_name = $v;
			$this->modifiedColumns[] = UserPeer::USER_NAME;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = UserPeer::EMAIL;
		}

	} 
	
	public function setSha1Password($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sha1_password !== $v) {
			$this->sha1_password = $v;
			$this->modifiedColumns[] = UserPeer::SHA1_PASSWORD;
		}

	} 
	
	public function setSalt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->salt !== $v) {
			$this->salt = $v;
			$this->modifiedColumns[] = UserPeer::SALT;
		}

	} 
	
	public function setActorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->actor_id !== $v) {
			$this->actor_id = $v;
			$this->modifiedColumns[] = UserPeer::ACTOR_ID;
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
			$this->modifiedColumns[] = UserPeer::CREATED_AT;
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
			$this->modifiedColumns[] = UserPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->user_name = $rs->getString($startcol + 1);

			$this->email = $rs->getString($startcol + 2);

			$this->sha1_password = $rs->getString($startcol + 3);

			$this->salt = $rs->getString($startcol + 4);

			$this->actor_id = $rs->getInt($startcol + 5);

			$this->created_at = $rs->getTimestamp($startcol + 6, null);

			$this->updated_at = $rs->getTimestamp($startcol + 7, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating User object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseUser:delete:pre') as $callable)
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
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UserPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUser:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseUser:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(UserPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(UserPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UserPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUser:save:post') as $callable)
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


												
			if ($this->aActor !== null) {
				if ($this->aActor->isModified()) {
					$affectedRows += $this->aActor->save($con);
				}
				$this->setActor($this->aActor);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UserPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UserPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collNotes !== null) {
				foreach($this->collNotes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSystemEvents !== null) {
				foreach($this->collSystemEvents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserTermRelationships !== null) {
				foreach($this->collUserTermRelationships as $referrerFK) {
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


												
			if ($this->aActor !== null) {
				if (!$this->aActor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aActor->getValidationFailures());
				}
			}


			if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNotes !== null) {
					foreach($this->collNotes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSystemEvents !== null) {
					foreach($this->collSystemEvents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserTermRelationships !== null) {
					foreach($this->collUserTermRelationships as $referrerFK) {
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
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getUserName();
				break;
			case 2:
				return $this->getEmail();
				break;
			case 3:
				return $this->getSha1Password();
				break;
			case 4:
				return $this->getSalt();
				break;
			case 5:
				return $this->getActorId();
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
		$keys = UserPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUserName(),
			$keys[2] => $this->getEmail(),
			$keys[3] => $this->getSha1Password(),
			$keys[4] => $this->getSalt(),
			$keys[5] => $this->getActorId(),
			$keys[6] => $this->getCreatedAt(),
			$keys[7] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setUserName($value);
				break;
			case 2:
				$this->setEmail($value);
				break;
			case 3:
				$this->setSha1Password($value);
				break;
			case 4:
				$this->setSalt($value);
				break;
			case 5:
				$this->setActorId($value);
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
		$keys = UserPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUserName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSha1Password($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSalt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setActorId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setUpdatedAt($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
		if ($this->isColumnModified(UserPeer::USER_NAME)) $criteria->add(UserPeer::USER_NAME, $this->user_name);
		if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
		if ($this->isColumnModified(UserPeer::SHA1_PASSWORD)) $criteria->add(UserPeer::SHA1_PASSWORD, $this->sha1_password);
		if ($this->isColumnModified(UserPeer::SALT)) $criteria->add(UserPeer::SALT, $this->salt);
		if ($this->isColumnModified(UserPeer::ACTOR_ID)) $criteria->add(UserPeer::ACTOR_ID, $this->actor_id);
		if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(UserPeer::UPDATED_AT)) $criteria->add(UserPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UserPeer::DATABASE_NAME);

		$criteria->add(UserPeer::ID, $this->id);

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

		$copyObj->setUserName($this->user_name);

		$copyObj->setEmail($this->email);

		$copyObj->setSha1Password($this->sha1_password);

		$copyObj->setSalt($this->salt);

		$copyObj->setActorId($this->actor_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getNotes() as $relObj) {
				$copyObj->addNote($relObj->copy($deepCopy));
			}

			foreach($this->getSystemEvents() as $relObj) {
				$copyObj->addSystemEvent($relObj->copy($deepCopy));
			}

			foreach($this->getUserTermRelationships() as $relObj) {
				$copyObj->addUserTermRelationship($relObj->copy($deepCopy));
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
			self::$peer = new UserPeer();
		}
		return self::$peer;
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

	
	public function initNotes()
	{
		if ($this->collNotes === null) {
			$this->collNotes = array();
		}
	}

	
	public function getNotes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotes === null) {
			if ($this->isNew()) {
			   $this->collNotes = array();
			} else {

				$criteria->add(NotePeer::USER_ID, $this->getId());

				NotePeer::addSelectColumns($criteria);
				$this->collNotes = NotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotePeer::USER_ID, $this->getId());

				NotePeer::addSelectColumns($criteria);
				if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
					$this->collNotes = NotePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNoteCriteria = $criteria;
		return $this->collNotes;
	}

	
	public function countNotes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NotePeer::USER_ID, $this->getId());

		return NotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNote(Note $l)
	{
		$this->collNotes[] = $l;
		$l->setUser($this);
	}


	
	public function getNotesJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotes === null) {
			if ($this->isNew()) {
				$this->collNotes = array();
			} else {

				$criteria->add(NotePeer::USER_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::USER_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}


	
	public function getNotesJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotes === null) {
			if ($this->isNew()) {
				$this->collNotes = array();
			} else {

				$criteria->add(NotePeer::USER_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::USER_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}


	
	public function getNotesJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotes === null) {
			if ($this->isNew()) {
				$this->collNotes = array();
			} else {

				$criteria->add(NotePeer::USER_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::USER_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}


	
	public function getNotesJoinFunctionDescription($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotes === null) {
			if ($this->isNew()) {
				$this->collNotes = array();
			} else {

				$criteria->add(NotePeer::USER_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinFunctionDescription($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::USER_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinFunctionDescription($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}


	
	public function getNotesJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNotePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotes === null) {
			if ($this->isNew()) {
				$this->collNotes = array();
			} else {

				$criteria->add(NotePeer::USER_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::USER_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}

	
	public function initSystemEvents()
	{
		if ($this->collSystemEvents === null) {
			$this->collSystemEvents = array();
		}
	}

	
	public function getSystemEvents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSystemEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSystemEvents === null) {
			if ($this->isNew()) {
			   $this->collSystemEvents = array();
			} else {

				$criteria->add(SystemEventPeer::USER_ID, $this->getId());

				SystemEventPeer::addSelectColumns($criteria);
				$this->collSystemEvents = SystemEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SystemEventPeer::USER_ID, $this->getId());

				SystemEventPeer::addSelectColumns($criteria);
				if (!isset($this->lastSystemEventCriteria) || !$this->lastSystemEventCriteria->equals($criteria)) {
					$this->collSystemEvents = SystemEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSystemEventCriteria = $criteria;
		return $this->collSystemEvents;
	}

	
	public function countSystemEvents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSystemEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SystemEventPeer::USER_ID, $this->getId());

		return SystemEventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSystemEvent(SystemEvent $l)
	{
		$this->collSystemEvents[] = $l;
		$l->setUser($this);
	}


	
	public function getSystemEventsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSystemEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSystemEvents === null) {
			if ($this->isNew()) {
				$this->collSystemEvents = array();
			} else {

				$criteria->add(SystemEventPeer::USER_ID, $this->getId());

				$this->collSystemEvents = SystemEventPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(SystemEventPeer::USER_ID, $this->getId());

			if (!isset($this->lastSystemEventCriteria) || !$this->lastSystemEventCriteria->equals($criteria)) {
				$this->collSystemEvents = SystemEventPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastSystemEventCriteria = $criteria;

		return $this->collSystemEvents;
	}

	
	public function initUserTermRelationships()
	{
		if ($this->collUserTermRelationships === null) {
			$this->collUserTermRelationships = array();
		}
	}

	
	public function getUserTermRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationships === null) {
			if ($this->isNew()) {
			   $this->collUserTermRelationships = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

				UserTermRelationshipPeer::addSelectColumns($criteria);
				$this->collUserTermRelationships = UserTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

				UserTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserTermRelationshipCriteria) || !$this->lastUserTermRelationshipCriteria->equals($criteria)) {
					$this->collUserTermRelationships = UserTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserTermRelationshipCriteria = $criteria;
		return $this->collUserTermRelationships;
	}

	
	public function countUserTermRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

		return UserTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserTermRelationship(UserTermRelationship $l)
	{
		$this->collUserTermRelationships[] = $l;
		$l->setUser($this);
	}


	
	public function getUserTermRelationshipsJoinTermRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationships === null) {
			if ($this->isNew()) {
				$this->collUserTermRelationships = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

				$this->collUserTermRelationships = UserTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		} else {
									
			$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

			if (!isset($this->lastUserTermRelationshipCriteria) || !$this->lastUserTermRelationshipCriteria->equals($criteria)) {
				$this->collUserTermRelationships = UserTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		}
		$this->lastUserTermRelationshipCriteria = $criteria;

		return $this->collUserTermRelationships;
	}


	
	public function getUserTermRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationships === null) {
			if ($this->isNew()) {
				$this->collUserTermRelationships = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

				$this->collUserTermRelationships = UserTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

			if (!isset($this->lastUserTermRelationshipCriteria) || !$this->lastUserTermRelationshipCriteria->equals($criteria)) {
				$this->collUserTermRelationships = UserTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lastUserTermRelationshipCriteria = $criteria;

		return $this->collUserTermRelationships;
	}


	
	public function getUserTermRelationshipsJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationships === null) {
			if ($this->isNew()) {
				$this->collUserTermRelationships = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

				$this->collUserTermRelationships = UserTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(UserTermRelationshipPeer::USER_ID, $this->getId());

			if (!isset($this->lastUserTermRelationshipCriteria) || !$this->lastUserTermRelationshipCriteria->equals($criteria)) {
				$this->collUserTermRelationships = UserTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastUserTermRelationshipCriteria = $criteria;

		return $this->collUserTermRelationships;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUser:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUser::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 