<?php


abstract class BaseDigitalObject extends BaseObject  implements Persistent {


	
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

	
	protected $aInformationObject;

	
	protected $aTermRelatedByUseageId;

	
	protected $aTermRelatedByMimeTypeId;

	
	protected $aTermRelatedByMediaTypeId;

	
	protected $aTermRelatedByChecksumTypeId;

	
	protected $aTermRelatedByLocationId;

	
	protected $collDigitalObjectMetadatas;

	
	protected $lastDigitalObjectMetadataCriteria = null;

	
	protected $collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId;

	
	protected $lastDigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria = null;

	
	protected $collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId;

	
	protected $lastDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria = null;

	
	protected $collPlaceMapRelationships;

	
	protected $lastPlaceMapRelationshipCriteria = null;

	
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
			$this->modifiedColumns[] = DigitalObjectPeer::ID;
		}

	} 
	
	public function setInformationObjectId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->information_object_id !== $v) {
			$this->information_object_id = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::INFORMATION_OBJECT_ID;
		}

		if ($this->aInformationObject !== null && $this->aInformationObject->getId() !== $v) {
			$this->aInformationObject = null;
		}

	} 
	
	public function setUseageId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->useage_id !== $v) {
			$this->useage_id = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::USEAGE_ID;
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
			$this->modifiedColumns[] = DigitalObjectPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::DESCRIPTION;
		}

	} 
	
	public function setMimeTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mime_type_id !== $v) {
			$this->mime_type_id = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::MIME_TYPE_ID;
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
			$this->modifiedColumns[] = DigitalObjectPeer::MEDIA_TYPE_ID;
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
			$this->modifiedColumns[] = DigitalObjectPeer::SEQUENCE;
		}

	} 
	
	public function setByteSize($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->byte_size !== $v) {
			$this->byte_size = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::BYTE_SIZE;
		}

	} 
	
	public function setChecksum($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->checksum !== $v) {
			$this->checksum = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::CHECKSUM;
		}

	} 
	
	public function setChecksumTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->checksum_type_id !== $v) {
			$this->checksum_type_id = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::CHECKSUM_TYPE_ID;
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
			$this->modifiedColumns[] = DigitalObjectPeer::LOCATION_ID;
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
			$this->modifiedColumns[] = DigitalObjectPeer::TREE_ID;
		}

	} 
	
	public function setTreeLeftId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_left_id !== $v) {
			$this->tree_left_id = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::TREE_LEFT_ID;
		}

	} 
	
	public function setTreeRightId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_right_id !== $v) {
			$this->tree_right_id = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::TREE_RIGHT_ID;
		}

	} 
	
	public function setTreeParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_parent_id !== $v) {
			$this->tree_parent_id = $v;
			$this->modifiedColumns[] = DigitalObjectPeer::TREE_PARENT_ID;
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
			$this->modifiedColumns[] = DigitalObjectPeer::CREATED_AT;
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
			$this->modifiedColumns[] = DigitalObjectPeer::UPDATED_AT;
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
			throw new PropelException("Error populating DigitalObject object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObject:delete:pre') as $callable)
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
			$con = Propel::getConnection(DigitalObjectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DigitalObjectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDigitalObject:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObject:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(DigitalObjectPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(DigitalObjectPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DigitalObjectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDigitalObject:save:post') as $callable)
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


												
			if ($this->aInformationObject !== null) {
				if ($this->aInformationObject->isModified()) {
					$affectedRows += $this->aInformationObject->save($con);
				}
				$this->setInformationObject($this->aInformationObject);
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
					$pk = DigitalObjectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DigitalObjectPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDigitalObjectMetadatas !== null) {
				foreach($this->collDigitalObjectMetadatas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId !== null) {
				foreach($this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId !== null) {
				foreach($this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPlaceMapRelationships !== null) {
				foreach($this->collPlaceMapRelationships as $referrerFK) {
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


												
			if ($this->aInformationObject !== null) {
				if (!$this->aInformationObject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInformationObject->getValidationFailures());
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


			if (($retval = DigitalObjectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDigitalObjectMetadatas !== null) {
					foreach($this->collDigitalObjectMetadatas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId !== null) {
					foreach($this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId !== null) {
					foreach($this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPlaceMapRelationships !== null) {
					foreach($this->collPlaceMapRelationships as $referrerFK) {
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
		$pos = DigitalObjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = DigitalObjectPeer::getFieldNames($keyType);
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
		$pos = DigitalObjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = DigitalObjectPeer::getFieldNames($keyType);

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
		$criteria = new Criteria(DigitalObjectPeer::DATABASE_NAME);

		if ($this->isColumnModified(DigitalObjectPeer::ID)) $criteria->add(DigitalObjectPeer::ID, $this->id);
		if ($this->isColumnModified(DigitalObjectPeer::INFORMATION_OBJECT_ID)) $criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->information_object_id);
		if ($this->isColumnModified(DigitalObjectPeer::USEAGE_ID)) $criteria->add(DigitalObjectPeer::USEAGE_ID, $this->useage_id);
		if ($this->isColumnModified(DigitalObjectPeer::NAME)) $criteria->add(DigitalObjectPeer::NAME, $this->name);
		if ($this->isColumnModified(DigitalObjectPeer::DESCRIPTION)) $criteria->add(DigitalObjectPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(DigitalObjectPeer::MIME_TYPE_ID)) $criteria->add(DigitalObjectPeer::MIME_TYPE_ID, $this->mime_type_id);
		if ($this->isColumnModified(DigitalObjectPeer::MEDIA_TYPE_ID)) $criteria->add(DigitalObjectPeer::MEDIA_TYPE_ID, $this->media_type_id);
		if ($this->isColumnModified(DigitalObjectPeer::SEQUENCE)) $criteria->add(DigitalObjectPeer::SEQUENCE, $this->sequence);
		if ($this->isColumnModified(DigitalObjectPeer::BYTE_SIZE)) $criteria->add(DigitalObjectPeer::BYTE_SIZE, $this->byte_size);
		if ($this->isColumnModified(DigitalObjectPeer::CHECKSUM)) $criteria->add(DigitalObjectPeer::CHECKSUM, $this->checksum);
		if ($this->isColumnModified(DigitalObjectPeer::CHECKSUM_TYPE_ID)) $criteria->add(DigitalObjectPeer::CHECKSUM_TYPE_ID, $this->checksum_type_id);
		if ($this->isColumnModified(DigitalObjectPeer::LOCATION_ID)) $criteria->add(DigitalObjectPeer::LOCATION_ID, $this->location_id);
		if ($this->isColumnModified(DigitalObjectPeer::TREE_ID)) $criteria->add(DigitalObjectPeer::TREE_ID, $this->tree_id);
		if ($this->isColumnModified(DigitalObjectPeer::TREE_LEFT_ID)) $criteria->add(DigitalObjectPeer::TREE_LEFT_ID, $this->tree_left_id);
		if ($this->isColumnModified(DigitalObjectPeer::TREE_RIGHT_ID)) $criteria->add(DigitalObjectPeer::TREE_RIGHT_ID, $this->tree_right_id);
		if ($this->isColumnModified(DigitalObjectPeer::TREE_PARENT_ID)) $criteria->add(DigitalObjectPeer::TREE_PARENT_ID, $this->tree_parent_id);
		if ($this->isColumnModified(DigitalObjectPeer::CREATED_AT)) $criteria->add(DigitalObjectPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(DigitalObjectPeer::UPDATED_AT)) $criteria->add(DigitalObjectPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DigitalObjectPeer::DATABASE_NAME);

		$criteria->add(DigitalObjectPeer::ID, $this->id);

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

			foreach($this->getDigitalObjectMetadatas() as $relObj) {
				$copyObj->addDigitalObjectMetadata($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId() as $relObj) {
				$copyObj->addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId() as $relObj) {
				$copyObj->addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($relObj->copy($deepCopy));
			}

			foreach($this->getPlaceMapRelationships() as $relObj) {
				$copyObj->addPlaceMapRelationship($relObj->copy($deepCopy));
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
			self::$peer = new DigitalObjectPeer();
		}
		return self::$peer;
	}

	
	public function setInformationObject($v)
	{


		if ($v === null) {
			$this->setInformationObjectId(NULL);
		} else {
			$this->setInformationObjectId($v->getId());
		}


		$this->aInformationObject = $v;
	}


	
	public function getInformationObject($con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectPeer.php';

		if ($this->aInformationObject === null && ($this->information_object_id !== null)) {

			$this->aInformationObject = InformationObjectPeer::retrieveByPK($this->information_object_id, $con);

			
		}
		return $this->aInformationObject;
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

	
	public function initDigitalObjectMetadatas()
	{
		if ($this->collDigitalObjectMetadatas === null) {
			$this->collDigitalObjectMetadatas = array();
		}
	}

	
	public function getDigitalObjectMetadatas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectMetadataPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectMetadatas === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectMetadatas = array();
			} else {

				$criteria->add(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, $this->getId());

				DigitalObjectMetadataPeer::addSelectColumns($criteria);
				$this->collDigitalObjectMetadatas = DigitalObjectMetadataPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, $this->getId());

				DigitalObjectMetadataPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectMetadataCriteria) || !$this->lastDigitalObjectMetadataCriteria->equals($criteria)) {
					$this->collDigitalObjectMetadatas = DigitalObjectMetadataPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectMetadataCriteria = $criteria;
		return $this->collDigitalObjectMetadatas;
	}

	
	public function countDigitalObjectMetadatas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectMetadataPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, $this->getId());

		return DigitalObjectMetadataPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectMetadata(DigitalObjectMetadata $l)
	{
		$this->collDigitalObjectMetadatas[] = $l;
		$l->setDigitalObject($this);
	}

	
	public function initDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId()
	{
		if ($this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId === null) {
			$this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = array();
		}
	}

	
	public function getDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = array();
			} else {

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

				DigitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

				DigitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria) || !$this->lastDigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria->equals($criteria)) {
					$this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria = $criteria;
		return $this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId;
	}

	
	public function countDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

		return DigitalObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId(DigitalObjectRecursiveRelationship $l)
	{
		$this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId[] = $l;
		$l->setDigitalObjectRelatedByDigitalObjectId($this);
	}


	
	public function getDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = array();
			} else {

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

				$this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria) || !$this->lastDigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria->equals($criteria)) {
				$this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastDigitalObjectRecursiveRelationshipRelatedByDigitalObjectIdCriteria = $criteria;

		return $this->collDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId;
	}

	
	public function initDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId()
	{
		if ($this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId === null) {
			$this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = array();
		}
	}

	
	public function getDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = array();
			} else {

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

				DigitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

				DigitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria) || !$this->lastDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria->equals($criteria)) {
					$this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria = $criteria;
		return $this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId;
	}

	
	public function countDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

		return DigitalObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId(DigitalObjectRecursiveRelationship $l)
	{
		$this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId[] = $l;
		$l->setDigitalObjectRelatedByRelatedDigitalObjectId($this);
	}


	
	public function getDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = array();
			} else {

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

				$this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria) || !$this->lastDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria->equals($criteria)) {
				$this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId = DigitalObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectIdCriteria = $criteria;

		return $this->collDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId;
	}

	
	public function initPlaceMapRelationships()
	{
		if ($this->collPlaceMapRelationships === null) {
			$this->collPlaceMapRelationships = array();
		}
	}

	
	public function getPlaceMapRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
			   $this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				PlaceMapRelationshipPeer::addSelectColumns($criteria);
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				PlaceMapRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
					$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;
		return $this->collPlaceMapRelationships;
	}

	
	public function countPlaceMapRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

		return PlaceMapRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPlaceMapRelationship(PlaceMapRelationship $l)
	{
		$this->collPlaceMapRelationships[] = $l;
		$l->setDigitalObject($this);
	}


	
	public function getPlaceMapRelationshipsJoinPlace($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
	}


	
	public function getPlaceMapRelationshipsJoinMap($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
	}


	
	public function getPlaceMapRelationshipsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlaceMapRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlaceMapRelationships === null) {
			if ($this->isNew()) {
				$this->collPlaceMapRelationships = array();
			} else {

				$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
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
		$l->setDigitalObject($this);
	}


	
	public function getRightsJoinInformationObject($criteria = null, $con = null)
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

				$this->collRights = RightPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}


	
	public function getRightsJoinPhysicalObject($criteria = null, $con = null)
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

				$this->collRights = RightPeer::doSelectJoinPhysicalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::DIGITAL_OBJECT_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinPhysicalObject($criteria, $con);
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
    if (!$callable = sfMixer::getCallable('BaseDigitalObject:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDigitalObject::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 