<?php


abstract class BaseInformationObject extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $identifier;


	
	protected $title;


	
	protected $alternate_title;


	
	protected $version;


	
	protected $level_of_description_id;


	
	protected $extent_and_medium;


	
	protected $archival_history;


	
	protected $acquisition;


	
	protected $scope_and_content;


	
	protected $appraisal;


	
	protected $accruals;


	
	protected $arrangement;


	
	protected $access_conditions;


	
	protected $reproduction_conditions;


	
	protected $physical_characteristics;


	
	protected $finding_aids;


	
	protected $location_of_originals;


	
	protected $location_of_copies;


	
	protected $related_units_of_description;


	
	protected $rules;


	
	protected $collection_type_id;


	
	protected $repository_id;


	
	protected $tree_id;


	
	protected $tree_left_id;


	
	protected $tree_right_id;


	
	protected $tree_parent_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTermRelatedByLevelOfDescriptionId;

	
	protected $aTermRelatedByCollectionTypeId;

	
	protected $aRepository;

	
	protected $collInformationObjectTermRelationships;

	
	protected $lastInformationObjectTermRelationshipCriteria = null;

	
	protected $collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId;

	
	protected $lastInformationObjectRecursiveRelationshipRelatedByInformationObjectIdCriteria = null;

	
	protected $collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId;

	
	protected $lastInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectIdCriteria = null;

	
	protected $collNotes;

	
	protected $lastNoteCriteria = null;

	
	protected $collDigitalObjects;

	
	protected $lastDigitalObjectCriteria = null;

	
	protected $collPhysicalObjects;

	
	protected $lastPhysicalObjectCriteria = null;

	
	protected $collEvents;

	
	protected $lastEventCriteria = null;

	
	protected $collRights;

	
	protected $lastRightCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdentifier()
	{

		return $this->identifier;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getAlternateTitle()
	{

		return $this->alternate_title;
	}

	
	public function getVersion()
	{

		return $this->version;
	}

	
	public function getLevelOfDescriptionId()
	{

		return $this->level_of_description_id;
	}

	
	public function getExtentAndMedium()
	{

		return $this->extent_and_medium;
	}

	
	public function getArchivalHistory()
	{

		return $this->archival_history;
	}

	
	public function getAcquisition()
	{

		return $this->acquisition;
	}

	
	public function getScopeAndContent()
	{

		return $this->scope_and_content;
	}

	
	public function getAppraisal()
	{

		return $this->appraisal;
	}

	
	public function getAccruals()
	{

		return $this->accruals;
	}

	
	public function getArrangement()
	{

		return $this->arrangement;
	}

	
	public function getAccessConditions()
	{

		return $this->access_conditions;
	}

	
	public function getReproductionConditions()
	{

		return $this->reproduction_conditions;
	}

	
	public function getPhysicalCharacteristics()
	{

		return $this->physical_characteristics;
	}

	
	public function getFindingAids()
	{

		return $this->finding_aids;
	}

	
	public function getLocationOfOriginals()
	{

		return $this->location_of_originals;
	}

	
	public function getLocationOfCopies()
	{

		return $this->location_of_copies;
	}

	
	public function getRelatedUnitsOfDescription()
	{

		return $this->related_units_of_description;
	}

	
	public function getRules()
	{

		return $this->rules;
	}

	
	public function getCollectionTypeId()
	{

		return $this->collection_type_id;
	}

	
	public function getRepositoryId()
	{

		return $this->repository_id;
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
			$this->modifiedColumns[] = InformationObjectPeer::ID;
		}

	} 
	
	public function setIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->identifier !== $v) {
			$this->identifier = $v;
			$this->modifiedColumns[] = InformationObjectPeer::IDENTIFIER;
		}

	} 
	
	public function setTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = InformationObjectPeer::TITLE;
		}

	} 
	
	public function setAlternateTitle($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->alternate_title !== $v) {
			$this->alternate_title = $v;
			$this->modifiedColumns[] = InformationObjectPeer::ALTERNATE_TITLE;
		}

	} 
	
	public function setVersion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->version !== $v) {
			$this->version = $v;
			$this->modifiedColumns[] = InformationObjectPeer::VERSION;
		}

	} 
	
	public function setLevelOfDescriptionId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->level_of_description_id !== $v) {
			$this->level_of_description_id = $v;
			$this->modifiedColumns[] = InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID;
		}

		if ($this->aTermRelatedByLevelOfDescriptionId !== null && $this->aTermRelatedByLevelOfDescriptionId->getId() !== $v) {
			$this->aTermRelatedByLevelOfDescriptionId = null;
		}

	} 
	
	public function setExtentAndMedium($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->extent_and_medium !== $v) {
			$this->extent_and_medium = $v;
			$this->modifiedColumns[] = InformationObjectPeer::EXTENT_AND_MEDIUM;
		}

	} 
	
	public function setArchivalHistory($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->archival_history !== $v) {
			$this->archival_history = $v;
			$this->modifiedColumns[] = InformationObjectPeer::ARCHIVAL_HISTORY;
		}

	} 
	
	public function setAcquisition($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->acquisition !== $v) {
			$this->acquisition = $v;
			$this->modifiedColumns[] = InformationObjectPeer::ACQUISITION;
		}

	} 
	
	public function setScopeAndContent($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->scope_and_content !== $v) {
			$this->scope_and_content = $v;
			$this->modifiedColumns[] = InformationObjectPeer::SCOPE_AND_CONTENT;
		}

	} 
	
	public function setAppraisal($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->appraisal !== $v) {
			$this->appraisal = $v;
			$this->modifiedColumns[] = InformationObjectPeer::APPRAISAL;
		}

	} 
	
	public function setAccruals($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->accruals !== $v) {
			$this->accruals = $v;
			$this->modifiedColumns[] = InformationObjectPeer::ACCRUALS;
		}

	} 
	
	public function setArrangement($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->arrangement !== $v) {
			$this->arrangement = $v;
			$this->modifiedColumns[] = InformationObjectPeer::ARRANGEMENT;
		}

	} 
	
	public function setAccessConditions($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->access_conditions !== $v) {
			$this->access_conditions = $v;
			$this->modifiedColumns[] = InformationObjectPeer::ACCESS_CONDITIONS;
		}

	} 
	
	public function setReproductionConditions($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->reproduction_conditions !== $v) {
			$this->reproduction_conditions = $v;
			$this->modifiedColumns[] = InformationObjectPeer::REPRODUCTION_CONDITIONS;
		}

	} 
	
	public function setPhysicalCharacteristics($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->physical_characteristics !== $v) {
			$this->physical_characteristics = $v;
			$this->modifiedColumns[] = InformationObjectPeer::PHYSICAL_CHARACTERISTICS;
		}

	} 
	
	public function setFindingAids($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->finding_aids !== $v) {
			$this->finding_aids = $v;
			$this->modifiedColumns[] = InformationObjectPeer::FINDING_AIDS;
		}

	} 
	
	public function setLocationOfOriginals($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->location_of_originals !== $v) {
			$this->location_of_originals = $v;
			$this->modifiedColumns[] = InformationObjectPeer::LOCATION_OF_ORIGINALS;
		}

	} 
	
	public function setLocationOfCopies($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->location_of_copies !== $v) {
			$this->location_of_copies = $v;
			$this->modifiedColumns[] = InformationObjectPeer::LOCATION_OF_COPIES;
		}

	} 
	
	public function setRelatedUnitsOfDescription($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->related_units_of_description !== $v) {
			$this->related_units_of_description = $v;
			$this->modifiedColumns[] = InformationObjectPeer::RELATED_UNITS_OF_DESCRIPTION;
		}

	} 
	
	public function setRules($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rules !== $v) {
			$this->rules = $v;
			$this->modifiedColumns[] = InformationObjectPeer::RULES;
		}

	} 
	
	public function setCollectionTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->collection_type_id !== $v) {
			$this->collection_type_id = $v;
			$this->modifiedColumns[] = InformationObjectPeer::COLLECTION_TYPE_ID;
		}

		if ($this->aTermRelatedByCollectionTypeId !== null && $this->aTermRelatedByCollectionTypeId->getId() !== $v) {
			$this->aTermRelatedByCollectionTypeId = null;
		}

	} 
	
	public function setRepositoryId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->repository_id !== $v) {
			$this->repository_id = $v;
			$this->modifiedColumns[] = InformationObjectPeer::REPOSITORY_ID;
		}

		if ($this->aRepository !== null && $this->aRepository->getId() !== $v) {
			$this->aRepository = null;
		}

	} 
	
	public function setTreeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_id !== $v) {
			$this->tree_id = $v;
			$this->modifiedColumns[] = InformationObjectPeer::TREE_ID;
		}

	} 
	
	public function setTreeLeftId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_left_id !== $v) {
			$this->tree_left_id = $v;
			$this->modifiedColumns[] = InformationObjectPeer::TREE_LEFT_ID;
		}

	} 
	
	public function setTreeRightId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_right_id !== $v) {
			$this->tree_right_id = $v;
			$this->modifiedColumns[] = InformationObjectPeer::TREE_RIGHT_ID;
		}

	} 
	
	public function setTreeParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_parent_id !== $v) {
			$this->tree_parent_id = $v;
			$this->modifiedColumns[] = InformationObjectPeer::TREE_PARENT_ID;
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
			$this->modifiedColumns[] = InformationObjectPeer::CREATED_AT;
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
			$this->modifiedColumns[] = InformationObjectPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->identifier = $rs->getString($startcol + 1);

			$this->title = $rs->getString($startcol + 2);

			$this->alternate_title = $rs->getString($startcol + 3);

			$this->version = $rs->getString($startcol + 4);

			$this->level_of_description_id = $rs->getInt($startcol + 5);

			$this->extent_and_medium = $rs->getString($startcol + 6);

			$this->archival_history = $rs->getString($startcol + 7);

			$this->acquisition = $rs->getString($startcol + 8);

			$this->scope_and_content = $rs->getString($startcol + 9);

			$this->appraisal = $rs->getString($startcol + 10);

			$this->accruals = $rs->getString($startcol + 11);

			$this->arrangement = $rs->getString($startcol + 12);

			$this->access_conditions = $rs->getString($startcol + 13);

			$this->reproduction_conditions = $rs->getString($startcol + 14);

			$this->physical_characteristics = $rs->getString($startcol + 15);

			$this->finding_aids = $rs->getString($startcol + 16);

			$this->location_of_originals = $rs->getString($startcol + 17);

			$this->location_of_copies = $rs->getString($startcol + 18);

			$this->related_units_of_description = $rs->getString($startcol + 19);

			$this->rules = $rs->getString($startcol + 20);

			$this->collection_type_id = $rs->getInt($startcol + 21);

			$this->repository_id = $rs->getInt($startcol + 22);

			$this->tree_id = $rs->getInt($startcol + 23);

			$this->tree_left_id = $rs->getInt($startcol + 24);

			$this->tree_right_id = $rs->getInt($startcol + 25);

			$this->tree_parent_id = $rs->getInt($startcol + 26);

			$this->created_at = $rs->getTimestamp($startcol + 27, null);

			$this->updated_at = $rs->getTimestamp($startcol + 28, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 29; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InformationObject object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObject:delete:pre') as $callable)
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
			$con = Propel::getConnection(InformationObjectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InformationObjectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInformationObject:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObject:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(InformationObjectPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(InformationObjectPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InformationObjectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInformationObject:save:post') as $callable)
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


												
			if ($this->aTermRelatedByLevelOfDescriptionId !== null) {
				if ($this->aTermRelatedByLevelOfDescriptionId->isModified()) {
					$affectedRows += $this->aTermRelatedByLevelOfDescriptionId->save($con);
				}
				$this->setTermRelatedByLevelOfDescriptionId($this->aTermRelatedByLevelOfDescriptionId);
			}

			if ($this->aTermRelatedByCollectionTypeId !== null) {
				if ($this->aTermRelatedByCollectionTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByCollectionTypeId->save($con);
				}
				$this->setTermRelatedByCollectionTypeId($this->aTermRelatedByCollectionTypeId);
			}

			if ($this->aRepository !== null) {
				if ($this->aRepository->isModified()) {
					$affectedRows += $this->aRepository->save($con);
				}
				$this->setRepository($this->aRepository);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InformationObjectPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += InformationObjectPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collInformationObjectTermRelationships !== null) {
				foreach($this->collInformationObjectTermRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId !== null) {
				foreach($this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId !== null) {
				foreach($this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotes !== null) {
				foreach($this->collNotes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjects !== null) {
				foreach($this->collDigitalObjects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPhysicalObjects !== null) {
				foreach($this->collPhysicalObjects as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEvents !== null) {
				foreach($this->collEvents as $referrerFK) {
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


												
			if ($this->aTermRelatedByLevelOfDescriptionId !== null) {
				if (!$this->aTermRelatedByLevelOfDescriptionId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByLevelOfDescriptionId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByCollectionTypeId !== null) {
				if (!$this->aTermRelatedByCollectionTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByCollectionTypeId->getValidationFailures());
				}
			}

			if ($this->aRepository !== null) {
				if (!$this->aRepository->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRepository->getValidationFailures());
				}
			}


			if (($retval = InformationObjectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInformationObjectTermRelationships !== null) {
					foreach($this->collInformationObjectTermRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId !== null) {
					foreach($this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId !== null) {
					foreach($this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotes !== null) {
					foreach($this->collNotes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjects !== null) {
					foreach($this->collDigitalObjects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPhysicalObjects !== null) {
					foreach($this->collPhysicalObjects as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEvents !== null) {
					foreach($this->collEvents as $referrerFK) {
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
		$pos = InformationObjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdentifier();
				break;
			case 2:
				return $this->getTitle();
				break;
			case 3:
				return $this->getAlternateTitle();
				break;
			case 4:
				return $this->getVersion();
				break;
			case 5:
				return $this->getLevelOfDescriptionId();
				break;
			case 6:
				return $this->getExtentAndMedium();
				break;
			case 7:
				return $this->getArchivalHistory();
				break;
			case 8:
				return $this->getAcquisition();
				break;
			case 9:
				return $this->getScopeAndContent();
				break;
			case 10:
				return $this->getAppraisal();
				break;
			case 11:
				return $this->getAccruals();
				break;
			case 12:
				return $this->getArrangement();
				break;
			case 13:
				return $this->getAccessConditions();
				break;
			case 14:
				return $this->getReproductionConditions();
				break;
			case 15:
				return $this->getPhysicalCharacteristics();
				break;
			case 16:
				return $this->getFindingAids();
				break;
			case 17:
				return $this->getLocationOfOriginals();
				break;
			case 18:
				return $this->getLocationOfCopies();
				break;
			case 19:
				return $this->getRelatedUnitsOfDescription();
				break;
			case 20:
				return $this->getRules();
				break;
			case 21:
				return $this->getCollectionTypeId();
				break;
			case 22:
				return $this->getRepositoryId();
				break;
			case 23:
				return $this->getTreeId();
				break;
			case 24:
				return $this->getTreeLeftId();
				break;
			case 25:
				return $this->getTreeRightId();
				break;
			case 26:
				return $this->getTreeParentId();
				break;
			case 27:
				return $this->getCreatedAt();
				break;
			case 28:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InformationObjectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdentifier(),
			$keys[2] => $this->getTitle(),
			$keys[3] => $this->getAlternateTitle(),
			$keys[4] => $this->getVersion(),
			$keys[5] => $this->getLevelOfDescriptionId(),
			$keys[6] => $this->getExtentAndMedium(),
			$keys[7] => $this->getArchivalHistory(),
			$keys[8] => $this->getAcquisition(),
			$keys[9] => $this->getScopeAndContent(),
			$keys[10] => $this->getAppraisal(),
			$keys[11] => $this->getAccruals(),
			$keys[12] => $this->getArrangement(),
			$keys[13] => $this->getAccessConditions(),
			$keys[14] => $this->getReproductionConditions(),
			$keys[15] => $this->getPhysicalCharacteristics(),
			$keys[16] => $this->getFindingAids(),
			$keys[17] => $this->getLocationOfOriginals(),
			$keys[18] => $this->getLocationOfCopies(),
			$keys[19] => $this->getRelatedUnitsOfDescription(),
			$keys[20] => $this->getRules(),
			$keys[21] => $this->getCollectionTypeId(),
			$keys[22] => $this->getRepositoryId(),
			$keys[23] => $this->getTreeId(),
			$keys[24] => $this->getTreeLeftId(),
			$keys[25] => $this->getTreeRightId(),
			$keys[26] => $this->getTreeParentId(),
			$keys[27] => $this->getCreatedAt(),
			$keys[28] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InformationObjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdentifier($value);
				break;
			case 2:
				$this->setTitle($value);
				break;
			case 3:
				$this->setAlternateTitle($value);
				break;
			case 4:
				$this->setVersion($value);
				break;
			case 5:
				$this->setLevelOfDescriptionId($value);
				break;
			case 6:
				$this->setExtentAndMedium($value);
				break;
			case 7:
				$this->setArchivalHistory($value);
				break;
			case 8:
				$this->setAcquisition($value);
				break;
			case 9:
				$this->setScopeAndContent($value);
				break;
			case 10:
				$this->setAppraisal($value);
				break;
			case 11:
				$this->setAccruals($value);
				break;
			case 12:
				$this->setArrangement($value);
				break;
			case 13:
				$this->setAccessConditions($value);
				break;
			case 14:
				$this->setReproductionConditions($value);
				break;
			case 15:
				$this->setPhysicalCharacteristics($value);
				break;
			case 16:
				$this->setFindingAids($value);
				break;
			case 17:
				$this->setLocationOfOriginals($value);
				break;
			case 18:
				$this->setLocationOfCopies($value);
				break;
			case 19:
				$this->setRelatedUnitsOfDescription($value);
				break;
			case 20:
				$this->setRules($value);
				break;
			case 21:
				$this->setCollectionTypeId($value);
				break;
			case 22:
				$this->setRepositoryId($value);
				break;
			case 23:
				$this->setTreeId($value);
				break;
			case 24:
				$this->setTreeLeftId($value);
				break;
			case 25:
				$this->setTreeRightId($value);
				break;
			case 26:
				$this->setTreeParentId($value);
				break;
			case 27:
				$this->setCreatedAt($value);
				break;
			case 28:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InformationObjectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdentifier($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setAlternateTitle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVersion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLevelOfDescriptionId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setExtentAndMedium($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setArchivalHistory($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setAcquisition($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setScopeAndContent($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setAppraisal($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setAccruals($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setArrangement($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setAccessConditions($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setReproductionConditions($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPhysicalCharacteristics($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setFindingAids($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setLocationOfOriginals($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setLocationOfCopies($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setRelatedUnitsOfDescription($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setRules($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCollectionTypeId($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setRepositoryId($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setTreeId($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setTreeLeftId($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setTreeRightId($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setTreeParentId($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCreatedAt($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setUpdatedAt($arr[$keys[28]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InformationObjectPeer::DATABASE_NAME);

		if ($this->isColumnModified(InformationObjectPeer::ID)) $criteria->add(InformationObjectPeer::ID, $this->id);
		if ($this->isColumnModified(InformationObjectPeer::IDENTIFIER)) $criteria->add(InformationObjectPeer::IDENTIFIER, $this->identifier);
		if ($this->isColumnModified(InformationObjectPeer::TITLE)) $criteria->add(InformationObjectPeer::TITLE, $this->title);
		if ($this->isColumnModified(InformationObjectPeer::ALTERNATE_TITLE)) $criteria->add(InformationObjectPeer::ALTERNATE_TITLE, $this->alternate_title);
		if ($this->isColumnModified(InformationObjectPeer::VERSION)) $criteria->add(InformationObjectPeer::VERSION, $this->version);
		if ($this->isColumnModified(InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID)) $criteria->add(InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->level_of_description_id);
		if ($this->isColumnModified(InformationObjectPeer::EXTENT_AND_MEDIUM)) $criteria->add(InformationObjectPeer::EXTENT_AND_MEDIUM, $this->extent_and_medium);
		if ($this->isColumnModified(InformationObjectPeer::ARCHIVAL_HISTORY)) $criteria->add(InformationObjectPeer::ARCHIVAL_HISTORY, $this->archival_history);
		if ($this->isColumnModified(InformationObjectPeer::ACQUISITION)) $criteria->add(InformationObjectPeer::ACQUISITION, $this->acquisition);
		if ($this->isColumnModified(InformationObjectPeer::SCOPE_AND_CONTENT)) $criteria->add(InformationObjectPeer::SCOPE_AND_CONTENT, $this->scope_and_content);
		if ($this->isColumnModified(InformationObjectPeer::APPRAISAL)) $criteria->add(InformationObjectPeer::APPRAISAL, $this->appraisal);
		if ($this->isColumnModified(InformationObjectPeer::ACCRUALS)) $criteria->add(InformationObjectPeer::ACCRUALS, $this->accruals);
		if ($this->isColumnModified(InformationObjectPeer::ARRANGEMENT)) $criteria->add(InformationObjectPeer::ARRANGEMENT, $this->arrangement);
		if ($this->isColumnModified(InformationObjectPeer::ACCESS_CONDITIONS)) $criteria->add(InformationObjectPeer::ACCESS_CONDITIONS, $this->access_conditions);
		if ($this->isColumnModified(InformationObjectPeer::REPRODUCTION_CONDITIONS)) $criteria->add(InformationObjectPeer::REPRODUCTION_CONDITIONS, $this->reproduction_conditions);
		if ($this->isColumnModified(InformationObjectPeer::PHYSICAL_CHARACTERISTICS)) $criteria->add(InformationObjectPeer::PHYSICAL_CHARACTERISTICS, $this->physical_characteristics);
		if ($this->isColumnModified(InformationObjectPeer::FINDING_AIDS)) $criteria->add(InformationObjectPeer::FINDING_AIDS, $this->finding_aids);
		if ($this->isColumnModified(InformationObjectPeer::LOCATION_OF_ORIGINALS)) $criteria->add(InformationObjectPeer::LOCATION_OF_ORIGINALS, $this->location_of_originals);
		if ($this->isColumnModified(InformationObjectPeer::LOCATION_OF_COPIES)) $criteria->add(InformationObjectPeer::LOCATION_OF_COPIES, $this->location_of_copies);
		if ($this->isColumnModified(InformationObjectPeer::RELATED_UNITS_OF_DESCRIPTION)) $criteria->add(InformationObjectPeer::RELATED_UNITS_OF_DESCRIPTION, $this->related_units_of_description);
		if ($this->isColumnModified(InformationObjectPeer::RULES)) $criteria->add(InformationObjectPeer::RULES, $this->rules);
		if ($this->isColumnModified(InformationObjectPeer::COLLECTION_TYPE_ID)) $criteria->add(InformationObjectPeer::COLLECTION_TYPE_ID, $this->collection_type_id);
		if ($this->isColumnModified(InformationObjectPeer::REPOSITORY_ID)) $criteria->add(InformationObjectPeer::REPOSITORY_ID, $this->repository_id);
		if ($this->isColumnModified(InformationObjectPeer::TREE_ID)) $criteria->add(InformationObjectPeer::TREE_ID, $this->tree_id);
		if ($this->isColumnModified(InformationObjectPeer::TREE_LEFT_ID)) $criteria->add(InformationObjectPeer::TREE_LEFT_ID, $this->tree_left_id);
		if ($this->isColumnModified(InformationObjectPeer::TREE_RIGHT_ID)) $criteria->add(InformationObjectPeer::TREE_RIGHT_ID, $this->tree_right_id);
		if ($this->isColumnModified(InformationObjectPeer::TREE_PARENT_ID)) $criteria->add(InformationObjectPeer::TREE_PARENT_ID, $this->tree_parent_id);
		if ($this->isColumnModified(InformationObjectPeer::CREATED_AT)) $criteria->add(InformationObjectPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(InformationObjectPeer::UPDATED_AT)) $criteria->add(InformationObjectPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InformationObjectPeer::DATABASE_NAME);

		$criteria->add(InformationObjectPeer::ID, $this->id);

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

		$copyObj->setIdentifier($this->identifier);

		$copyObj->setTitle($this->title);

		$copyObj->setAlternateTitle($this->alternate_title);

		$copyObj->setVersion($this->version);

		$copyObj->setLevelOfDescriptionId($this->level_of_description_id);

		$copyObj->setExtentAndMedium($this->extent_and_medium);

		$copyObj->setArchivalHistory($this->archival_history);

		$copyObj->setAcquisition($this->acquisition);

		$copyObj->setScopeAndContent($this->scope_and_content);

		$copyObj->setAppraisal($this->appraisal);

		$copyObj->setAccruals($this->accruals);

		$copyObj->setArrangement($this->arrangement);

		$copyObj->setAccessConditions($this->access_conditions);

		$copyObj->setReproductionConditions($this->reproduction_conditions);

		$copyObj->setPhysicalCharacteristics($this->physical_characteristics);

		$copyObj->setFindingAids($this->finding_aids);

		$copyObj->setLocationOfOriginals($this->location_of_originals);

		$copyObj->setLocationOfCopies($this->location_of_copies);

		$copyObj->setRelatedUnitsOfDescription($this->related_units_of_description);

		$copyObj->setRules($this->rules);

		$copyObj->setCollectionTypeId($this->collection_type_id);

		$copyObj->setRepositoryId($this->repository_id);

		$copyObj->setTreeId($this->tree_id);

		$copyObj->setTreeLeftId($this->tree_left_id);

		$copyObj->setTreeRightId($this->tree_right_id);

		$copyObj->setTreeParentId($this->tree_parent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getInformationObjectTermRelationships() as $relObj) {
				$copyObj->addInformationObjectTermRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getInformationObjectRecursiveRelationshipsRelatedByInformationObjectId() as $relObj) {
				$copyObj->addInformationObjectRecursiveRelationshipRelatedByInformationObjectId($relObj->copy($deepCopy));
			}

			foreach($this->getInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId() as $relObj) {
				$copyObj->addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($relObj->copy($deepCopy));
			}

			foreach($this->getNotes() as $relObj) {
				$copyObj->addNote($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjects() as $relObj) {
				$copyObj->addDigitalObject($relObj->copy($deepCopy));
			}

			foreach($this->getPhysicalObjects() as $relObj) {
				$copyObj->addPhysicalObject($relObj->copy($deepCopy));
			}

			foreach($this->getEvents() as $relObj) {
				$copyObj->addEvent($relObj->copy($deepCopy));
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
			self::$peer = new InformationObjectPeer();
		}
		return self::$peer;
	}

	
	public function setTermRelatedByLevelOfDescriptionId($v)
	{


		if ($v === null) {
			$this->setLevelOfDescriptionId(NULL);
		} else {
			$this->setLevelOfDescriptionId($v->getId());
		}


		$this->aTermRelatedByLevelOfDescriptionId = $v;
	}


	
	public function getTermRelatedByLevelOfDescriptionId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByLevelOfDescriptionId === null && ($this->level_of_description_id !== null)) {

			$this->aTermRelatedByLevelOfDescriptionId = TermPeer::retrieveByPK($this->level_of_description_id, $con);

			
		}
		return $this->aTermRelatedByLevelOfDescriptionId;
	}

	
	public function setTermRelatedByCollectionTypeId($v)
	{


		if ($v === null) {
			$this->setCollectionTypeId(NULL);
		} else {
			$this->setCollectionTypeId($v->getId());
		}


		$this->aTermRelatedByCollectionTypeId = $v;
	}


	
	public function getTermRelatedByCollectionTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByCollectionTypeId === null && ($this->collection_type_id !== null)) {

			$this->aTermRelatedByCollectionTypeId = TermPeer::retrieveByPK($this->collection_type_id, $con);

			
		}
		return $this->aTermRelatedByCollectionTypeId;
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

	
	public function initInformationObjectTermRelationships()
	{
		if ($this->collInformationObjectTermRelationships === null) {
			$this->collInformationObjectTermRelationships = array();
		}
	}

	
	public function getInformationObjectTermRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectTermRelationships === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectTermRelationships = array();
			} else {

				$criteria->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

				InformationObjectTermRelationshipPeer::addSelectColumns($criteria);
				$this->collInformationObjectTermRelationships = InformationObjectTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

				InformationObjectTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectTermRelationshipCriteria) || !$this->lastInformationObjectTermRelationshipCriteria->equals($criteria)) {
					$this->collInformationObjectTermRelationships = InformationObjectTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectTermRelationshipCriteria = $criteria;
		return $this->collInformationObjectTermRelationships;
	}

	
	public function countInformationObjectTermRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

		return InformationObjectTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectTermRelationship(InformationObjectTermRelationship $l)
	{
		$this->collInformationObjectTermRelationships[] = $l;
		$l->setInformationObject($this);
	}


	
	public function getInformationObjectTermRelationshipsJoinTermRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectTermRelationships === null) {
			if ($this->isNew()) {
				$this->collInformationObjectTermRelationships = array();
			} else {

				$criteria->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collInformationObjectTermRelationships = InformationObjectTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastInformationObjectTermRelationshipCriteria) || !$this->lastInformationObjectTermRelationshipCriteria->equals($criteria)) {
				$this->collInformationObjectTermRelationships = InformationObjectTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		}
		$this->lastInformationObjectTermRelationshipCriteria = $criteria;

		return $this->collInformationObjectTermRelationships;
	}


	
	public function getInformationObjectTermRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectTermRelationships === null) {
			if ($this->isNew()) {
				$this->collInformationObjectTermRelationships = array();
			} else {

				$criteria->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collInformationObjectTermRelationships = InformationObjectTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectTermRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastInformationObjectTermRelationshipCriteria) || !$this->lastInformationObjectTermRelationshipCriteria->equals($criteria)) {
				$this->collInformationObjectTermRelationships = InformationObjectTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lastInformationObjectTermRelationshipCriteria = $criteria;

		return $this->collInformationObjectTermRelationships;
	}

	
	public function initInformationObjectRecursiveRelationshipsRelatedByInformationObjectId()
	{
		if ($this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId === null) {
			$this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId = array();
		}
	}

	
	public function getInformationObjectRecursiveRelationshipsRelatedByInformationObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId = array();
			} else {

				$criteria->add(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

				InformationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

				InformationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectRecursiveRelationshipRelatedByInformationObjectIdCriteria) || !$this->lastInformationObjectRecursiveRelationshipRelatedByInformationObjectIdCriteria->equals($criteria)) {
					$this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectRecursiveRelationshipRelatedByInformationObjectIdCriteria = $criteria;
		return $this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId;
	}

	
	public function countInformationObjectRecursiveRelationshipsRelatedByInformationObjectId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

		return InformationObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectRecursiveRelationshipRelatedByInformationObjectId(InformationObjectRecursiveRelationship $l)
	{
		$this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId[] = $l;
		$l->setInformationObjectRelatedByInformationObjectId($this);
	}


	
	public function getInformationObjectRecursiveRelationshipsRelatedByInformationObjectIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId === null) {
			if ($this->isNew()) {
				$this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId = array();
			} else {

				$criteria->add(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastInformationObjectRecursiveRelationshipRelatedByInformationObjectIdCriteria) || !$this->lastInformationObjectRecursiveRelationshipRelatedByInformationObjectIdCriteria->equals($criteria)) {
				$this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastInformationObjectRecursiveRelationshipRelatedByInformationObjectIdCriteria = $criteria;

		return $this->collInformationObjectRecursiveRelationshipsRelatedByInformationObjectId;
	}

	
	public function initInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId()
	{
		if ($this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId === null) {
			$this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId = array();
		}
	}

	
	public function getInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId = array();
			} else {

				$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, $this->getId());

				InformationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, $this->getId());

				InformationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectIdCriteria) || !$this->lastInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectIdCriteria->equals($criteria)) {
					$this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectIdCriteria = $criteria;
		return $this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId;
	}

	
	public function countInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, $this->getId());

		return InformationObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId(InformationObjectRecursiveRelationship $l)
	{
		$this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId[] = $l;
		$l->setInformationObjectRelatedByRelatedInformationObjectId($this);
	}


	
	public function getInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId === null) {
			if ($this->isNew()) {
				$this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId = array();
			} else {

				$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, $this->getId());

				$this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectIdCriteria) || !$this->lastInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectIdCriteria->equals($criteria)) {
				$this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId = InformationObjectRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectIdCriteria = $criteria;

		return $this->collInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId;
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

				$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

				NotePeer::addSelectColumns($criteria);
				$this->collNotes = NotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

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

		$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

		return NotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNote(Note $l)
	{
		$this->collNotes[] = $l;
		$l->setInformationObject($this);
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

				$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

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

				$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

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

				$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinFunctionDescription($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

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

				$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}


	
	public function getNotesJoinUser($criteria = null, $con = null)
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

				$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}

	
	public function initDigitalObjects()
	{
		if ($this->collDigitalObjects === null) {
			$this->collDigitalObjects = array();
		}
	}

	
	public function getDigitalObjects($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjects === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjects = array();
			} else {

				$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				$this->collDigitalObjects = DigitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectCriteria) || !$this->lastDigitalObjectCriteria->equals($criteria)) {
					$this->collDigitalObjects = DigitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectCriteria = $criteria;
		return $this->collDigitalObjects;
	}

	
	public function countDigitalObjects($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

		return DigitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObject(DigitalObject $l)
	{
		$this->collDigitalObjects[] = $l;
		$l->setInformationObject($this);
	}


	
	public function getDigitalObjectsJoinTermRelatedByUseageId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjects === null) {
			if ($this->isNew()) {
				$this->collDigitalObjects = array();
			} else {

				$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByUseageId($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastDigitalObjectCriteria) || !$this->lastDigitalObjectCriteria->equals($criteria)) {
				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByUseageId($criteria, $con);
			}
		}
		$this->lastDigitalObjectCriteria = $criteria;

		return $this->collDigitalObjects;
	}


	
	public function getDigitalObjectsJoinTermRelatedByMimeTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjects === null) {
			if ($this->isNew()) {
				$this->collDigitalObjects = array();
			} else {

				$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByMimeTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastDigitalObjectCriteria) || !$this->lastDigitalObjectCriteria->equals($criteria)) {
				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByMimeTypeId($criteria, $con);
			}
		}
		$this->lastDigitalObjectCriteria = $criteria;

		return $this->collDigitalObjects;
	}


	
	public function getDigitalObjectsJoinTermRelatedByMediaTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjects === null) {
			if ($this->isNew()) {
				$this->collDigitalObjects = array();
			} else {

				$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByMediaTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastDigitalObjectCriteria) || !$this->lastDigitalObjectCriteria->equals($criteria)) {
				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByMediaTypeId($criteria, $con);
			}
		}
		$this->lastDigitalObjectCriteria = $criteria;

		return $this->collDigitalObjects;
	}


	
	public function getDigitalObjectsJoinTermRelatedByChecksumTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjects === null) {
			if ($this->isNew()) {
				$this->collDigitalObjects = array();
			} else {

				$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByChecksumTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastDigitalObjectCriteria) || !$this->lastDigitalObjectCriteria->equals($criteria)) {
				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByChecksumTypeId($criteria, $con);
			}
		}
		$this->lastDigitalObjectCriteria = $criteria;

		return $this->collDigitalObjects;
	}


	
	public function getDigitalObjectsJoinTermRelatedByLocationId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjects === null) {
			if ($this->isNew()) {
				$this->collDigitalObjects = array();
			} else {

				$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByLocationId($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastDigitalObjectCriteria) || !$this->lastDigitalObjectCriteria->equals($criteria)) {
				$this->collDigitalObjects = DigitalObjectPeer::doSelectJoinTermRelatedByLocationId($criteria, $con);
			}
		}
		$this->lastDigitalObjectCriteria = $criteria;

		return $this->collDigitalObjects;
	}

	
	public function initPhysicalObjects()
	{
		if ($this->collPhysicalObjects === null) {
			$this->collPhysicalObjects = array();
		}
	}

	
	public function getPhysicalObjects($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePhysicalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPhysicalObjects === null) {
			if ($this->isNew()) {
			   $this->collPhysicalObjects = array();
			} else {

				$criteria->add(PhysicalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				PhysicalObjectPeer::addSelectColumns($criteria);
				$this->collPhysicalObjects = PhysicalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PhysicalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				PhysicalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastPhysicalObjectCriteria) || !$this->lastPhysicalObjectCriteria->equals($criteria)) {
					$this->collPhysicalObjects = PhysicalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPhysicalObjectCriteria = $criteria;
		return $this->collPhysicalObjects;
	}

	
	public function countPhysicalObjects($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePhysicalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PhysicalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

		return PhysicalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPhysicalObject(PhysicalObject $l)
	{
		$this->collPhysicalObjects[] = $l;
		$l->setInformationObject($this);
	}


	
	public function getPhysicalObjectsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePhysicalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPhysicalObjects === null) {
			if ($this->isNew()) {
				$this->collPhysicalObjects = array();
			} else {

				$criteria->add(PhysicalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collPhysicalObjects = PhysicalObjectPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(PhysicalObjectPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastPhysicalObjectCriteria) || !$this->lastPhysicalObjectCriteria->equals($criteria)) {
				$this->collPhysicalObjects = PhysicalObjectPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastPhysicalObjectCriteria = $criteria;

		return $this->collPhysicalObjects;
	}

	
	public function initEvents()
	{
		if ($this->collEvents === null) {
			$this->collEvents = array();
		}
	}

	
	public function getEvents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvents === null) {
			if ($this->isNew()) {
			   $this->collEvents = array();
			} else {

				$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEvents = EventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
					$this->collEvents = EventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventCriteria = $criteria;
		return $this->collEvents;
	}

	
	public function countEvents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvent(Event $l)
	{
		$this->collEvents[] = $l;
		$l->setInformationObject($this);
	}


	
	public function getEventsJoinTermRelatedByEventTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvents === null) {
			if ($this->isNew()) {
				$this->collEvents = array();
			} else {

				$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collEvents = EventPeer::doSelectJoinTermRelatedByEventTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
				$this->collEvents = EventPeer::doSelectJoinTermRelatedByEventTypeId($criteria, $con);
			}
		}
		$this->lastEventCriteria = $criteria;

		return $this->collEvents;
	}


	
	public function getEventsJoinTermRelatedByActorRoleId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvents === null) {
			if ($this->isNew()) {
				$this->collEvents = array();
			} else {

				$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collEvents = EventPeer::doSelectJoinTermRelatedByActorRoleId($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
				$this->collEvents = EventPeer::doSelectJoinTermRelatedByActorRoleId($criteria, $con);
			}
		}
		$this->lastEventCriteria = $criteria;

		return $this->collEvents;
	}


	
	public function getEventsJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvents === null) {
			if ($this->isNew()) {
				$this->collEvents = array();
			} else {

				$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collEvents = EventPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
				$this->collEvents = EventPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastEventCriteria = $criteria;

		return $this->collEvents;
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

				$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

				RightPeer::addSelectColumns($criteria);
				$this->collRights = RightPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

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

		$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

		return RightPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRight(Right $l)
	{
		$this->collRights[] = $l;
		$l->setInformationObject($this);
	}


	
	public function getRightsJoinDigitalObject($criteria = null, $con = null)
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

				$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinDigitalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinDigitalObject($criteria, $con);
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

				$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinPhysicalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

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

				$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::INFORMATION_OBJECT_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInformationObject:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInformationObject::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


  public function addIsAncestor(Criteria $c)
  {
    $c->add(InformationObjectPeer::TREE_LEFT_ID, $this->tree_left_id, Criteria::LESS_THAN);
    $c->add(InformationObjectPeer::TREE_RIGHT_ID, $this->tree_right_id, Criteria::GREATER_THAN);
  }
} 