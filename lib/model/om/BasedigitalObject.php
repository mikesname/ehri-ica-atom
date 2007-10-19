<?php


abstract class BasedigitalObject extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $information_object_id;


	
	protected $useage_id;


	
	protected $name;


	
	protected $description;


	
	protected $mime_type_id;


	
	protected $media_type_id;


	
	protected $sequence;


	
	protected $byte_size;


	
	protected $checksum;


	
	protected $checksum_type_id;


	
	protected $location_id;


	
	protected $tree_id;


	
	protected $tree_left_id;


	
	protected $tree_right_id;


	
	protected $tree_parent_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $ainformationObject;

	
	protected $aTermRelatedByUseageId;

	
	protected $aTermRelatedByMimeTypeId;

	
	protected $aTermRelatedByMediaTypeId;

	
	protected $aTermRelatedByChecksumTypeId;

	
	protected $aTermRelatedByLocationId;

	
	protected $colldigitalObjectMetadatas;

	
	protected $lastdigitalObjectMetadataCriteria = null;

	
	protected $colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId;

	
	protected $lastdigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria = null;

	
	protected $colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId;

	
	protected $lastdigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria = null;

	
	protected $collplaceMapRelationships;

	
	protected $lastplaceMapRelationshipCriteria = null;

	
	protected $collRights;

	
	protected $lastRightCriteria = null;

	
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

	
	public function getUseageId()
	{

		return $this->useage_id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getMimeTypeId()
	{

		return $this->mime_type_id;
	}

	
	public function getMediaTypeId()
	{

		return $this->media_type_id;
	}

	
	public function getSequence()
	{

		return $this->sequence;
	}

	
	public function getByteSize()
	{

		return $this->byte_size;
	}

	
	public function getChecksum()
	{

		return $this->checksum;
	}

	
	public function getChecksumTypeId()
	{

		return $this->checksum_type_id;
	}

	
	public function getLocationId()
	{

		return $this->location_id;
	}

	
	public function getTreeId()
	{

		return $this->tree_id;
	}

	
	public function getTreeLeftId()
	{

		return $this->tree_left_id;
	}

	
	public function getTreeRightId()
	{

		return $this->tree_right_id;
	}

	
	public function getTreeParentId()
	{

		return $this->tree_parent_id;
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
			$this->modifiedColumns[] = digitalObjectPeer::ID;
		}

	} 
	
	public function setInformationObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->information_object_id !== $v) {
			$this->information_object_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::INFORMATION_OBJECT_ID;
		}

		if ($this->ainformationObject !== null && $this->ainformationObject->getId() !== $v) {
			$this->ainformationObject = null;
		}

	} 
	
	public function setUseageId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->useage_id !== $v) {
			$this->useage_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::USEAGE_ID;
		}

		if ($this->aTermRelatedByUseageId !== null && $this->aTermRelatedByUseageId->getId() !== $v) {
			$this->aTermRelatedByUseageId = null;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = digitalObjectPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = digitalObjectPeer::DESCRIPTION;
		}

	} 
	
	public function setMimeTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mime_type_id !== $v) {
			$this->mime_type_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::MIME_TYPE_ID;
		}

		if ($this->aTermRelatedByMimeTypeId !== null && $this->aTermRelatedByMimeTypeId->getId() !== $v) {
			$this->aTermRelatedByMimeTypeId = null;
		}

	} 
	
	public function setMediaTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->media_type_id !== $v) {
			$this->media_type_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::MEDIA_TYPE_ID;
		}

		if ($this->aTermRelatedByMediaTypeId !== null && $this->aTermRelatedByMediaTypeId->getId() !== $v) {
			$this->aTermRelatedByMediaTypeId = null;
		}

	} 
	
	public function setSequence($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sequence !== $v) {
			$this->sequence = $v;
			$this->modifiedColumns[] = digitalObjectPeer::SEQUENCE;
		}

	} 
	
	public function setByteSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->byte_size !== $v) {
			$this->byte_size = $v;
			$this->modifiedColumns[] = digitalObjectPeer::BYTE_SIZE;
		}

	} 
	
	public function setChecksum($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->checksum !== $v) {
			$this->checksum = $v;
			$this->modifiedColumns[] = digitalObjectPeer::CHECKSUM;
		}

	} 
	
	public function setChecksumTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->checksum_type_id !== $v) {
			$this->checksum_type_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::CHECKSUM_TYPE_ID;
		}

		if ($this->aTermRelatedByChecksumTypeId !== null && $this->aTermRelatedByChecksumTypeId->getId() !== $v) {
			$this->aTermRelatedByChecksumTypeId = null;
		}

	} 
	
	public function setLocationId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->location_id !== $v) {
			$this->location_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::LOCATION_ID;
		}

		if ($this->aTermRelatedByLocationId !== null && $this->aTermRelatedByLocationId->getId() !== $v) {
			$this->aTermRelatedByLocationId = null;
		}

	} 
	
	public function setTreeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_id !== $v) {
			$this->tree_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::TREE_ID;
		}

	} 
	
	public function setTreeLeftId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_left_id !== $v) {
			$this->tree_left_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::TREE_LEFT_ID;
		}

	} 
	
	public function setTreeRightId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_right_id !== $v) {
			$this->tree_right_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::TREE_RIGHT_ID;
		}

	} 
	
	public function setTreeParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_parent_id !== $v) {
			$this->tree_parent_id = $v;
			$this->modifiedColumns[] = digitalObjectPeer::TREE_PARENT_ID;
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
			$this->modifiedColumns[] = digitalObjectPeer::CREATED_AT;
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
			$this->modifiedColumns[] = digitalObjectPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->information_object_id = $rs->getInt($startcol + 1);

			$this->useage_id = $rs->getInt($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->mime_type_id = $rs->getInt($startcol + 5);

			$this->media_type_id = $rs->getInt($startcol + 6);

			$this->sequence = $rs->getInt($startcol + 7);

			$this->byte_size = $rs->getInt($startcol + 8);

			$this->checksum = $rs->getString($startcol + 9);

			$this->checksum_type_id = $rs->getInt($startcol + 10);

			$this->location_id = $rs->getInt($startcol + 11);

			$this->tree_id = $rs->getInt($startcol + 12);

			$this->tree_left_id = $rs->getInt($startcol + 13);

			$this->tree_right_id = $rs->getInt($startcol + 14);

			$this->tree_parent_id = $rs->getInt($startcol + 15);

			$this->created_at = $rs->getTimestamp($startcol + 16, null);

			$this->updated_at = $rs->getTimestamp($startcol + 17, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating digitalObject object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObject:delete:pre') as $callable)
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
			$con = Propel::getConnection(digitalObjectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			digitalObjectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasedigitalObject:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObject:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(digitalObjectPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(digitalObjectPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(digitalObjectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasedigitalObject:save:post') as $callable)
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

			if ($this->aTermRelatedByUseageId !== null) {
				if ($this->aTermRelatedByUseageId->isModified()) {
					$affectedRows += $this->aTermRelatedByUseageId->save($con);
				}
				$this->setTermRelatedByUseageId($this->aTermRelatedByUseageId);
			}

			if ($this->aTermRelatedByMimeTypeId !== null) {
				if ($this->aTermRelatedByMimeTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByMimeTypeId->save($con);
				}
				$this->setTermRelatedByMimeTypeId($this->aTermRelatedByMimeTypeId);
			}

			if ($this->aTermRelatedByMediaTypeId !== null) {
				if ($this->aTermRelatedByMediaTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByMediaTypeId->save($con);
				}
				$this->setTermRelatedByMediaTypeId($this->aTermRelatedByMediaTypeId);
			}

			if ($this->aTermRelatedByChecksumTypeId !== null) {
				if ($this->aTermRelatedByChecksumTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByChecksumTypeId->save($con);
				}
				$this->setTermRelatedByChecksumTypeId($this->aTermRelatedByChecksumTypeId);
			}

			if ($this->aTermRelatedByLocationId !== null) {
				if ($this->aTermRelatedByLocationId->isModified()) {
					$affectedRows += $this->aTermRelatedByLocationId->save($con);
				}
				$this->setTermRelatedByLocationId($this->aTermRelatedByLocationId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = digitalObjectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += digitalObjectPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->colldigitalObjectMetadatas !== null) {
				foreach($this->colldigitalObjectMetadatas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId !== null) {
				foreach($this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId !== null) {
				foreach($this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collplaceMapRelationships !== null) {
				foreach($this->collplaceMapRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRights !== null) {
				foreach($this->collRights as $referrerFK) {
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


												
			if ($this->ainformationObject !== null) {
				if (!$this->ainformationObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->ainformationObject->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByUseageId !== null) {
				if (!$this->aTermRelatedByUseageId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByUseageId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByMimeTypeId !== null) {
				if (!$this->aTermRelatedByMimeTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByMimeTypeId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByMediaTypeId !== null) {
				if (!$this->aTermRelatedByMediaTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByMediaTypeId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByChecksumTypeId !== null) {
				if (!$this->aTermRelatedByChecksumTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByChecksumTypeId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByLocationId !== null) {
				if (!$this->aTermRelatedByLocationId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByLocationId->getValidationFailures());
				}
			}


			if (($retval = digitalObjectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->colldigitalObjectMetadatas !== null) {
					foreach($this->colldigitalObjectMetadatas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId !== null) {
					foreach($this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId !== null) {
					foreach($this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collplaceMapRelationships !== null) {
					foreach($this->collplaceMapRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRights !== null) {
					foreach($this->collRights as $referrerFK) {
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
		$pos = digitalObjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUseageId();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getDescription();
				break;
			case 5:
				return $this->getMimeTypeId();
				break;
			case 6:
				return $this->getMediaTypeId();
				break;
			case 7:
				return $this->getSequence();
				break;
			case 8:
				return $this->getByteSize();
				break;
			case 9:
				return $this->getChecksum();
				break;
			case 10:
				return $this->getChecksumTypeId();
				break;
			case 11:
				return $this->getLocationId();
				break;
			case 12:
				return $this->getTreeId();
				break;
			case 13:
				return $this->getTreeLeftId();
				break;
			case 14:
				return $this->getTreeRightId();
				break;
			case 15:
				return $this->getTreeParentId();
				break;
			case 16:
				return $this->getCreatedAt();
				break;
			case 17:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = digitalObjectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getInformationObjectId(),
			$keys[2] => $this->getUseageId(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getMimeTypeId(),
			$keys[6] => $this->getMediaTypeId(),
			$keys[7] => $this->getSequence(),
			$keys[8] => $this->getByteSize(),
			$keys[9] => $this->getChecksum(),
			$keys[10] => $this->getChecksumTypeId(),
			$keys[11] => $this->getLocationId(),
			$keys[12] => $this->getTreeId(),
			$keys[13] => $this->getTreeLeftId(),
			$keys[14] => $this->getTreeRightId(),
			$keys[15] => $this->getTreeParentId(),
			$keys[16] => $this->getCreatedAt(),
			$keys[17] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = digitalObjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUseageId($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
			case 5:
				$this->setMimeTypeId($value);
				break;
			case 6:
				$this->setMediaTypeId($value);
				break;
			case 7:
				$this->setSequence($value);
				break;
			case 8:
				$this->setByteSize($value);
				break;
			case 9:
				$this->setChecksum($value);
				break;
			case 10:
				$this->setChecksumTypeId($value);
				break;
			case 11:
				$this->setLocationId($value);
				break;
			case 12:
				$this->setTreeId($value);
				break;
			case 13:
				$this->setTreeLeftId($value);
				break;
			case 14:
				$this->setTreeRightId($value);
				break;
			case 15:
				$this->setTreeParentId($value);
				break;
			case 16:
				$this->setCreatedAt($value);
				break;
			case 17:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = digitalObjectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setInformationObjectId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUseageId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setMimeTypeId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMediaTypeId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSequence($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setByteSize($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setChecksum($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setChecksumTypeId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLocationId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTreeId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTreeLeftId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setTreeRightId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setTreeParentId($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCreatedAt($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setUpdatedAt($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(digitalObjectPeer::DATABASE_NAME);

		if ($this->isColumnModified(digitalObjectPeer::ID)) $criteria->add(digitalObjectPeer::ID, $this->id);
		if ($this->isColumnModified(digitalObjectPeer::INFORMATION_OBJECT_ID)) $criteria->add(digitalObjectPeer::INFORMATION_OBJECT_ID, $this->information_object_id);
		if ($this->isColumnModified(digitalObjectPeer::USEAGE_ID)) $criteria->add(digitalObjectPeer::USEAGE_ID, $this->useage_id);
		if ($this->isColumnModified(digitalObjectPeer::NAME)) $criteria->add(digitalObjectPeer::NAME, $this->name);
		if ($this->isColumnModified(digitalObjectPeer::DESCRIPTION)) $criteria->add(digitalObjectPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(digitalObjectPeer::MIME_TYPE_ID)) $criteria->add(digitalObjectPeer::MIME_TYPE_ID, $this->mime_type_id);
		if ($this->isColumnModified(digitalObjectPeer::MEDIA_TYPE_ID)) $criteria->add(digitalObjectPeer::MEDIA_TYPE_ID, $this->media_type_id);
		if ($this->isColumnModified(digitalObjectPeer::SEQUENCE)) $criteria->add(digitalObjectPeer::SEQUENCE, $this->sequence);
		if ($this->isColumnModified(digitalObjectPeer::BYTE_SIZE)) $criteria->add(digitalObjectPeer::BYTE_SIZE, $this->byte_size);
		if ($this->isColumnModified(digitalObjectPeer::CHECKSUM)) $criteria->add(digitalObjectPeer::CHECKSUM, $this->checksum);
		if ($this->isColumnModified(digitalObjectPeer::CHECKSUM_TYPE_ID)) $criteria->add(digitalObjectPeer::CHECKSUM_TYPE_ID, $this->checksum_type_id);
		if ($this->isColumnModified(digitalObjectPeer::LOCATION_ID)) $criteria->add(digitalObjectPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(digitalObjectPeer::TREE_ID)) $criteria->add(digitalObjectPeer::TREE_ID, $this->tree_id);
		if ($this->isColumnModified(digitalObjectPeer::TREE_LEFT_ID)) $criteria->add(digitalObjectPeer::TREE_LEFT_ID, $this->tree_left_id);
		if ($this->isColumnModified(digitalObjectPeer::TREE_RIGHT_ID)) $criteria->add(digitalObjectPeer::TREE_RIGHT_ID, $this->tree_right_id);
		if ($this->isColumnModified(digitalObjectPeer::TREE_PARENT_ID)) $criteria->add(digitalObjectPeer::TREE_PARENT_ID, $this->tree_parent_id);
		if ($this->isColumnModified(digitalObjectPeer::CREATED_AT)) $criteria->add(digitalObjectPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(digitalObjectPeer::UPDATED_AT)) $criteria->add(digitalObjectPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(digitalObjectPeer::DATABASE_NAME);

		$criteria->add(digitalObjectPeer::ID, $this->id);

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

		$copyObj->setUseageId($this->useage_id);

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setMimeTypeId($this->mime_type_id);

		$copyObj->setMediaTypeId($this->media_type_id);

		$copyObj->setSequence($this->sequence);

		$copyObj->setByteSize($this->byte_size);

		$copyObj->setChecksum($this->checksum);

		$copyObj->setChecksumTypeId($this->checksum_type_id);

		$copyObj->setLocationId($this->location_id);

		$copyObj->setTreeId($this->tree_id);

		$copyObj->setTreeLeftId($this->tree_left_id);

		$copyObj->setTreeRightId($this->tree_right_id);

		$copyObj->setTreeParentId($this->tree_parent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getdigitalObjectMetadatas() as $relObj) {
				$copyObj->adddigitalObjectMetadata($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId() as $relObj) {
				$copyObj->adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId() as $relObj) {
				$copyObj->adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($relObj->copy($deepCopy));
			}

			foreach($this->getplaceMapRelationships() as $relObj) {
				$copyObj->addplaceMapRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getRights() as $relObj) {
				$copyObj->addRight($relObj->copy($deepCopy));
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
			self::$peer = new digitalObjectPeer();
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

	
	public function setTermRelatedByUseageId($v)
	{


		if ($v === null) {
			$this->setUseageId(NULL);
		} else {
			$this->setUseageId($v->getId());
		}


		$this->aTermRelatedByUseageId = $v;
	}


	
	public function getTermRelatedByUseageId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByUseageId === null && ($this->useage_id !== null)) {

			$this->aTermRelatedByUseageId = TermPeer::retrieveByPK($this->useage_id, $con);

			
		}
		return $this->aTermRelatedByUseageId;
	}

	
	public function setTermRelatedByMimeTypeId($v)
	{


		if ($v === null) {
			$this->setMimeTypeId(NULL);
		} else {
			$this->setMimeTypeId($v->getId());
		}


		$this->aTermRelatedByMimeTypeId = $v;
	}


	
	public function getTermRelatedByMimeTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByMimeTypeId === null && ($this->mime_type_id !== null)) {

			$this->aTermRelatedByMimeTypeId = TermPeer::retrieveByPK($this->mime_type_id, $con);

			
		}
		return $this->aTermRelatedByMimeTypeId;
	}

	
	public function setTermRelatedByMediaTypeId($v)
	{


		if ($v === null) {
			$this->setMediaTypeId(NULL);
		} else {
			$this->setMediaTypeId($v->getId());
		}


		$this->aTermRelatedByMediaTypeId = $v;
	}


	
	public function getTermRelatedByMediaTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByMediaTypeId === null && ($this->media_type_id !== null)) {

			$this->aTermRelatedByMediaTypeId = TermPeer::retrieveByPK($this->media_type_id, $con);

			
		}
		return $this->aTermRelatedByMediaTypeId;
	}

	
	public function setTermRelatedByChecksumTypeId($v)
	{


		if ($v === null) {
			$this->setChecksumTypeId(NULL);
		} else {
			$this->setChecksumTypeId($v->getId());
		}


		$this->aTermRelatedByChecksumTypeId = $v;
	}


	
	public function getTermRelatedByChecksumTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByChecksumTypeId === null && ($this->checksum_type_id !== null)) {

			$this->aTermRelatedByChecksumTypeId = TermPeer::retrieveByPK($this->checksum_type_id, $con);

			
		}
		return $this->aTermRelatedByChecksumTypeId;
	}

	
	public function setTermRelatedByLocationId($v)
	{


		if ($v === null) {
			$this->setLocationId(NULL);
		} else {
			$this->setLocationId($v->getId());
		}


		$this->aTermRelatedByLocationId = $v;
	}


	
	public function getTermRelatedByLocationId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByLocationId === null && ($this->location_id !== null)) {

			$this->aTermRelatedByLocationId = TermPeer::retrieveByPK($this->location_id, $con);

			
		}
		return $this->aTermRelatedByLocationId;
	}

	
	public function initdigitalObjectMetadatas()
	{
		if ($this->colldigitalObjectMetadatas === null) {
			$this->colldigitalObjectMetadatas = array();
		}
	}

	
	public function getdigitalObjectMetadatas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectMetadataPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectMetadatas === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectMetadatas = array();
			} else {

				$criteria->add(digitalObjectMetadataPeer::DIGITAL_OBJECT_ID, $this->getId());

				digitalObjectMetadataPeer::addSelectColumns($criteria);
				$this->colldigitalObjectMetadatas = digitalObjectMetadataPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectMetadataPeer::DIGITAL_OBJECT_ID, $this->getId());

				digitalObjectMetadataPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectMetadataCriteria) || !$this->lastdigitalObjectMetadataCriteria->equals($criteria)) {
					$this->colldigitalObjectMetadatas = digitalObjectMetadataPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectMetadataCriteria = $criteria;
		return $this->colldigitalObjectMetadatas;
	}

	
	public function countdigitalObjectMetadatas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectMetadataPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectMetadataPeer::DIGITAL_OBJECT_ID, $this->getId());

		return digitalObjectMetadataPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectMetadata(digitalObjectMetadata $l)
	{
		$this->colldigitalObjectMetadatas[] = $l;
		$l->setdigitalObject($this);
	}

	
	public function initdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId()
	{
		if ($this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId === null) {
			$this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = array();
		}
	}

	
	public function getdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = array();
			} else {

				$criteria->add(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

				digitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

				digitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria) || !$this->lastdigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria->equals($criteria)) {
					$this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria = $criteria;
		return $this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId;
	}

	
	public function countdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

		return digitalObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId(digitalObjectRecursiveRelationship $l)
	{
		$this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId[] = $l;
		$l->setdigitalObjectRelatedByDigitalObjectId($this);
	}


	
	public function getdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = array();
			} else {

				$criteria->add(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

				$this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria) || !$this->lastdigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria->equals($criteria)) {
				$this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastdigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria = $criteria;

		return $this->colldigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId;
	}

	
	public function initdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId()
	{
		if ($this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId === null) {
			$this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = array();
		}
	}

	
	public function getdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = array();
			} else {

				$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

				digitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

				digitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria) || !$this->lastdigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria->equals($criteria)) {
					$this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria = $criteria;
		return $this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId;
	}

	
	public function countdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

		return digitalObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId(digitalObjectRecursiveRelationship $l)
	{
		$this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId[] = $l;
		$l->setdigitalObjectRelatedByRelatedDigitalObjectId($this);
	}


	
	public function getdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = array();
			} else {

				$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

				$this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria) || !$this->lastdigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria->equals($criteria)) {
				$this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = digitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastdigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria = $criteria;

		return $this->colldigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId;
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

				$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				placeMapRelationshipPeer::addSelectColumns($criteria);
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

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

		$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

		return placeMapRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addplaceMapRelationship(placeMapRelationship $l)
	{
		$this->collplaceMapRelationships[] = $l;
		$l->setdigitalObject($this);
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

				$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		}
		$this->lastplaceMapRelationshipCriteria = $criteria;

		return $this->collplaceMapRelationships;
	}


	
	public function getplaceMapRelationshipsJoinMap($criteria = null, $con = null)
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

				$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinMap($criteria, $con);
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

				$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastplaceMapRelationshipCriteria = $criteria;

		return $this->collplaceMapRelationships;
	}

	
	public function initRights()
	{
		if ($this->collRights === null) {
			$this->collRights = array();
		}
	}

	
	public function getRights($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRights === null) {
			if ($this->isNew()) {
			   $this->collRights = array();
			} else {

				$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

				RightPeer::addSelectColumns($criteria);
				$this->collRights = RightPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

				RightPeer::addSelectColumns($criteria);
				if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
					$this->collRights = RightPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRightCriteria = $criteria;
		return $this->collRights;
	}

	
	public function countRights($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRightPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

		return RightPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRight(Right $l)
	{
		$this->collRights[] = $l;
		$l->setdigitalObject($this);
	}


	
	public function getRightsJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRights === null) {
			if ($this->isNew()) {
				$this->collRights = array();
			} else {

				$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}


	
	public function getRightsJoinphysicalObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRights === null) {
			if ($this->isNew()) {
				$this->collRights = array();
			} else {

				$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinphysicalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinphysicalObject($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}


	
	public function getRightsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRights === null) {
			if ($this->isNew()) {
				$this->collRights = array();
			} else {

				$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasedigitalObject:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasedigitalObject::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 