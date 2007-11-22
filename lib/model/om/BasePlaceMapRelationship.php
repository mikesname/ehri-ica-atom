<?php


abstract class BasePlaceMapRelationship extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $place_id;


	
	protected $map_id;


	
	protected $map_icon_image_id;


	
	protected $map_icon_description;


	
	protected $relationship_type_id;


	
	protected $relationship_note;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aPlace;

	
	protected $aMap;

	
	protected $aDigitalObject;

	
	protected $aTerm;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getPlaceId()
	{

		return $this->place_id;
	}

	
	public function getMapId()
	{

		return $this->map_id;
	}

	
	public function getMapIconImageId()
	{

		return $this->map_icon_image_id;
	}

	
	public function getMapIconDescription()
	{

		return $this->map_icon_description;
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
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::ID;
		}

	} 
	
	public function setPlaceId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->place_id !== $v) {
			$this->place_id = $v;
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::PLACE_ID;
		}

		if ($this->aPlace !== null && $this->aPlace->getId() !== $v) {
			$this->aPlace = null;
		}

	} 
	
	public function setMapId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->map_id !== $v) {
			$this->map_id = $v;
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::MAP_ID;
		}

		if ($this->aMap !== null && $this->aMap->getId() !== $v) {
			$this->aMap = null;
		}

	} 
	
	public function setMapIconImageId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->map_icon_image_id !== $v) {
			$this->map_icon_image_id = $v;
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID;
		}

		if ($this->aDigitalObject !== null && $this->aDigitalObject->getId() !== $v) {
			$this->aDigitalObject = null;
		}

	} 
	
	public function setMapIconDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->map_icon_description !== $v) {
			$this->map_icon_description = $v;
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::MAP_ICON_DESCRIPTION;
		}

	} 
	
	public function setRelationshipTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->relationship_type_id !== $v) {
			$this->relationship_type_id = $v;
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID;
		}

		if ($this->aTerm !== null && $this->aTerm->getId() !== $v) {
			$this->aTerm = null;
		}

	} 
	
	public function setRelationshipNote($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->relationship_note !== $v) {
			$this->relationship_note = $v;
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::RELATIONSHIP_NOTE;
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
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::CREATED_AT;
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
			$this->modifiedColumns[] = PlaceMapRelationshipPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->place_id = $rs->getInt($startcol + 1);

			$this->map_id = $rs->getInt($startcol + 2);

			$this->map_icon_image_id = $rs->getInt($startcol + 3);

			$this->map_icon_description = $rs->getString($startcol + 4);

			$this->relationship_type_id = $rs->getInt($startcol + 5);

			$this->relationship_note = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PlaceMapRelationship object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationship:delete:pre') as $callable)
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
			$con = Propel::getConnection(PlaceMapRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PlaceMapRelationshipPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePlaceMapRelationship:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationship:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(PlaceMapRelationshipPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(PlaceMapRelationshipPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PlaceMapRelationshipPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePlaceMapRelationship:save:post') as $callable)
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


												
			if ($this->aPlace !== null) {
				if ($this->aPlace->isModified()) {
					$affectedRows += $this->aPlace->save($con);
				}
				$this->setPlace($this->aPlace);
			}

			if ($this->aMap !== null) {
				if ($this->aMap->isModified()) {
					$affectedRows += $this->aMap->save($con);
				}
				$this->setMap($this->aMap);
			}

			if ($this->aDigitalObject !== null) {
				if ($this->aDigitalObject->isModified()) {
					$affectedRows += $this->aDigitalObject->save($con);
				}
				$this->setDigitalObject($this->aDigitalObject);
			}

			if ($this->aTerm !== null) {
				if ($this->aTerm->isModified()) {
					$affectedRows += $this->aTerm->save($con);
				}
				$this->setTerm($this->aTerm);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PlaceMapRelationshipPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PlaceMapRelationshipPeer::doUpdate($this, $con);
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


												
			if ($this->aPlace !== null) {
				if (!$this->aPlace->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPlace->getValidationFailures());
				}
			}

			if ($this->aMap !== null) {
				if (!$this->aMap->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMap->getValidationFailures());
				}
			}

			if ($this->aDigitalObject !== null) {
				if (!$this->aDigitalObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDigitalObject->getValidationFailures());
				}
			}

			if ($this->aTerm !== null) {
				if (!$this->aTerm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTerm->getValidationFailures());
				}
			}


			if (($retval = PlaceMapRelationshipPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PlaceMapRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPlaceId();
				break;
			case 2:
				return $this->getMapId();
				break;
			case 3:
				return $this->getMapIconImageId();
				break;
			case 4:
				return $this->getMapIconDescription();
				break;
			case 5:
				return $this->getRelationshipTypeId();
				break;
			case 6:
				return $this->getRelationshipNote();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PlaceMapRelationshipPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPlaceId(),
			$keys[2] => $this->getMapId(),
			$keys[3] => $this->getMapIconImageId(),
			$keys[4] => $this->getMapIconDescription(),
			$keys[5] => $this->getRelationshipTypeId(),
			$keys[6] => $this->getRelationshipNote(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PlaceMapRelationshipPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPlaceId($value);
				break;
			case 2:
				$this->setMapId($value);
				break;
			case 3:
				$this->setMapIconImageId($value);
				break;
			case 4:
				$this->setMapIconDescription($value);
				break;
			case 5:
				$this->setRelationshipTypeId($value);
				break;
			case 6:
				$this->setRelationshipNote($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PlaceMapRelationshipPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPlaceId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMapId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMapIconImageId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMapIconDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRelationshipTypeId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setRelationshipNote($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PlaceMapRelationshipPeer::DATABASE_NAME);

		if ($this->isColumnModified(PlaceMapRelationshipPeer::ID)) $criteria->add(PlaceMapRelationshipPeer::ID, $this->id);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::PLACE_ID)) $criteria->add(PlaceMapRelationshipPeer::PLACE_ID, $this->place_id);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::MAP_ID)) $criteria->add(PlaceMapRelationshipPeer::MAP_ID, $this->map_id);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID)) $criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->map_icon_image_id);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::MAP_ICON_DESCRIPTION)) $criteria->add(PlaceMapRelationshipPeer::MAP_ICON_DESCRIPTION, $this->map_icon_description);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID)) $criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->relationship_type_id);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::RELATIONSHIP_NOTE)) $criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_NOTE, $this->relationship_note);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::CREATED_AT)) $criteria->add(PlaceMapRelationshipPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(PlaceMapRelationshipPeer::UPDATED_AT)) $criteria->add(PlaceMapRelationshipPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PlaceMapRelationshipPeer::DATABASE_NAME);

		$criteria->add(PlaceMapRelationshipPeer::ID, $this->id);

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

		$copyObj->setPlaceId($this->place_id);

		$copyObj->setMapId($this->map_id);

		$copyObj->setMapIconImageId($this->map_icon_image_id);

		$copyObj->setMapIconDescription($this->map_icon_description);

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
			self::$peer = new PlaceMapRelationshipPeer();
		}
		return self::$peer;
	}

	
	public function setPlace($v)
	{


		if ($v === null) {
			$this->setPlaceId(NULL);
		} else {
			$this->setPlaceId($v->getId());
		}


		$this->aPlace = $v;
	}


	
	public function getPlace($con = null)
	{
				include_once 'lib/model/om/BasePlacePeer.php';

		if ($this->aPlace === null && ($this->place_id !== null)) {

			$this->aPlace = PlacePeer::retrieveByPK($this->place_id, $con);

			
		}
		return $this->aPlace;
	}

	
	public function setMap($v)
	{


		if ($v === null) {
			$this->setMapId(NULL);
		} else {
			$this->setMapId($v->getId());
		}


		$this->aMap = $v;
	}


	
	public function getMap($con = null)
	{
				include_once 'lib/model/om/BaseMapPeer.php';

		if ($this->aMap === null && ($this->map_id !== null)) {

			$this->aMap = MapPeer::retrieveByPK($this->map_id, $con);

			
		}
		return $this->aMap;
	}

	
	public function setDigitalObject($v)
	{


		if ($v === null) {
			$this->setMapIconImageId(NULL);
		} else {
			$this->setMapIconImageId($v->getId());
		}


		$this->aDigitalObject = $v;
	}


	
	public function getDigitalObject($con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';

		if ($this->aDigitalObject === null && ($this->map_icon_image_id !== null)) {

			$this->aDigitalObject = DigitalObjectPeer::retrieveByPK($this->map_icon_image_id, $con);

			
		}
		return $this->aDigitalObject;
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
    if (!$callable = sfMixer::getCallable('BasePlaceMapRelationship:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePlaceMapRelationship::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 