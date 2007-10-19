<?php


abstract class BaseMap extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $description;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collplaceMapRelationships;

	
	protected $lastplaceMapRelationshipCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
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
			$this->modifiedColumns[] = MapPeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = MapPeer::TITLE;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = MapPeer::DESCRIPTION;
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
			$this->modifiedColumns[] = MapPeer::CREATED_AT;
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
			$this->modifiedColumns[] = MapPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Map object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseMap:delete:pre') as $callable)
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
			$con = Propel::getConnection(MapPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MapPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMap:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseMap:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(MapPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(MapPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MapPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMap:save:post') as $callable)
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MapPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MapPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collplaceMapRelationships !== null) {
				foreach($this->collplaceMapRelationships as $referrerFK) {
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


			if (($retval = MapPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collplaceMapRelationships !== null) {
					foreach($this->collplaceMapRelationships as $referrerFK) {
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
		$pos = MapPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MapPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MapPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MapPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MapPeer::DATABASE_NAME);

		if ($this->isColumnModified(MapPeer::ID)) $criteria->add(MapPeer::ID, $this->id);
		if ($this->isColumnModified(MapPeer::TITLE)) $criteria->add(MapPeer::TITLE, $this->title);
		if ($this->isColumnModified(MapPeer::DESCRIPTION)) $criteria->add(MapPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(MapPeer::CREATED_AT)) $criteria->add(MapPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MapPeer::UPDATED_AT)) $criteria->add(MapPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MapPeer::DATABASE_NAME);

		$criteria->add(MapPeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setDescription($this->description);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getplaceMapRelationships() as $relObj) {
				$copyObj->addplaceMapRelationship($relObj->copy($deepCopy));
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
			self::$peer = new MapPeer();
		}
		return self::$peer;
	}

	
	public function initplaceMapRelationships()
	{
		if ($this->collplaceMapRelationships === null) {
			$this->collplaceMapRelationships = array();
		}
	}

	
	public function getplaceMapRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseplaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collplaceMapRelationships === null) {
			if ($this->isNew()) {
			   $this->collplaceMapRelationships = array();
			} else {

				$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

				placeMapRelationshipPeer::addSelectColumns($criteria);
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

				placeMapRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
					$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastplaceMapRelationshipCriteria = $criteria;
		return $this->collplaceMapRelationships;
	}

	
	public function countplaceMapRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseplaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

		return placeMapRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addplaceMapRelationship(placeMapRelationship $l)
	{
		$this->collplaceMapRelationships[] = $l;
		$l->setMap($this);
	}


	
	public function getplaceMapRelationshipsJoinPlace($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseplaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collplaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collplaceMapRelationships = array();
			} else {

				$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		}
		$this->lastplaceMapRelationshipCriteria = $criteria;

		return $this->collplaceMapRelationships;
	}


	
	public function getplaceMapRelationshipsJoindigitalObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseplaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collplaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collplaceMapRelationships = array();
			} else {

				$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoindigitalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoindigitalObject($criteria, $con);
			}
		}
		$this->lastplaceMapRelationshipCriteria = $criteria;

		return $this->collplaceMapRelationships;
	}


	
	public function getplaceMapRelationshipsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseplaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collplaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collplaceMapRelationships = array();
			} else {

				$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::MAP_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastplaceMapRelationshipCriteria = $criteria;

		return $this->collplaceMapRelationships;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMap:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMap::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 