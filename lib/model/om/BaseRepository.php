<?php


abstract class BaseRepository extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $actor_id;


	
	protected $identifier;


	
	protected $repository_type_id;


	
	protected $officers_in_charge;


	
	protected $geocultural_context;


	
	protected $collecting_policies;


	
	protected $buildings;


	
	protected $holdings;


	
	protected $finding_aids;


	
	protected $opening_times;


	
	protected $access_conditions;


	
	protected $disabled_access;


	
	protected $transport;


	
	protected $research_services;


	
	protected $reproduction_services;


	
	protected $public_facilities;


	
	protected $description_identifier;


	
	protected $institution_identifier;


	
	protected $rules;


	
	protected $status_id;


	
	protected $level_of_detail_id;


	
	protected $sources;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aActor;

	
	protected $aTermRelatedByRepositoryTypeId;

	
	protected $aTermRelatedByStatusId;

	
	protected $aTermRelatedByLevelOfDetailId;

	
	protected $collinformationObjects;

	
	protected $lastinformationObjectCriteria = null;

	
	protected $collNotes;

	
	protected $lastNoteCriteria = null;

	
	protected $collrepositoryTermRelationships;

	
	protected $lastrepositoryTermRelationshipCriteria = null;

	
	protected $colluserTermRelationships;

	
	protected $lastuserTermRelationshipCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getActorId()
	{

		return $this->actor_id;
	}

	
	public function getIdentifier()
	{

		return $this->identifier;
	}

	
	public function getRepositoryTypeId()
	{

		return $this->repository_type_id;
	}

	
	public function getOfficersInCharge()
	{

		return $this->officers_in_charge;
	}

	
	public function getGeoculturalContext()
	{

		return $this->geocultural_context;
	}

	
	public function getCollectingPolicies()
	{

		return $this->collecting_policies;
	}

	
	public function getBuildings()
	{

		return $this->buildings;
	}

	
	public function getHoldings()
	{

		return $this->holdings;
	}

	
	public function getFindingAids()
	{

		return $this->finding_aids;
	}

	
	public function getOpeningTimes()
	{

		return $this->opening_times;
	}

	
	public function getAccessConditions()
	{

		return $this->access_conditions;
	}

	
	public function getDisabledAccess()
	{

		return $this->disabled_access;
	}

	
	public function getTransport()
	{

		return $this->transport;
	}

	
	public function getResearchServices()
	{

		return $this->research_services;
	}

	
	public function getReproductionServices()
	{

		return $this->reproduction_services;
	}

	
	public function getPublicFacilities()
	{

		return $this->public_facilities;
	}

	
	public function getDescriptionIdentifier()
	{

		return $this->description_identifier;
	}

	
	public function getInstitutionIdentifier()
	{

		return $this->institution_identifier;
	}

	
	public function getRules()
	{

		return $this->rules;
	}

	
	public function getStatusId()
	{

		return $this->status_id;
	}

	
	public function getLevelOfDetailId()
	{

		return $this->level_of_detail_id;
	}

	
	public function getSources()
	{

		return $this->sources;
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
			$this->modifiedColumns[] = RepositoryPeer::ID;
		}

	} 
	
	public function setActorId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->actor_id !== $v) {
			$this->actor_id = $v;
			$this->modifiedColumns[] = RepositoryPeer::ACTOR_ID;
		}

		if ($this->aActor !== null && $this->aActor->getId() !== $v) {
			$this->aActor = null;
		}

	} 
	
	public function setIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->identifier !== $v) {
			$this->identifier = $v;
			$this->modifiedColumns[] = RepositoryPeer::IDENTIFIER;
		}

	} 
	
	public function setRepositoryTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->repository_type_id !== $v) {
			$this->repository_type_id = $v;
			$this->modifiedColumns[] = RepositoryPeer::REPOSITORY_TYPE_ID;
		}

		if ($this->aTermRelatedByRepositoryTypeId !== null && $this->aTermRelatedByRepositoryTypeId->getId() !== $v) {
			$this->aTermRelatedByRepositoryTypeId = null;
		}

	} 
	
	public function setOfficersInCharge($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->officers_in_charge !== $v) {
			$this->officers_in_charge = $v;
			$this->modifiedColumns[] = RepositoryPeer::OFFICERS_IN_CHARGE;
		}

	} 
	
	public function setGeoculturalContext($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->geocultural_context !== $v) {
			$this->geocultural_context = $v;
			$this->modifiedColumns[] = RepositoryPeer::GEOCULTURAL_CONTEXT;
		}

	} 
	
	public function setCollectingPolicies($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->collecting_policies !== $v) {
			$this->collecting_policies = $v;
			$this->modifiedColumns[] = RepositoryPeer::COLLECTING_POLICIES;
		}

	} 
	
	public function setBuildings($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->buildings !== $v) {
			$this->buildings = $v;
			$this->modifiedColumns[] = RepositoryPeer::BUILDINGS;
		}

	} 
	
	public function setHoldings($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->holdings !== $v) {
			$this->holdings = $v;
			$this->modifiedColumns[] = RepositoryPeer::HOLDINGS;
		}

	} 
	
	public function setFindingAids($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->finding_aids !== $v) {
			$this->finding_aids = $v;
			$this->modifiedColumns[] = RepositoryPeer::FINDING_AIDS;
		}

	} 
	
	public function setOpeningTimes($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->opening_times !== $v) {
			$this->opening_times = $v;
			$this->modifiedColumns[] = RepositoryPeer::OPENING_TIMES;
		}

	} 
	
	public function setAccessConditions($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->access_conditions !== $v) {
			$this->access_conditions = $v;
			$this->modifiedColumns[] = RepositoryPeer::ACCESS_CONDITIONS;
		}

	} 
	
	public function setDisabledAccess($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->disabled_access !== $v) {
			$this->disabled_access = $v;
			$this->modifiedColumns[] = RepositoryPeer::DISABLED_ACCESS;
		}

	} 
	
	public function setTransport($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->transport !== $v) {
			$this->transport = $v;
			$this->modifiedColumns[] = RepositoryPeer::TRANSPORT;
		}

	} 
	
	public function setResearchServices($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->research_services !== $v) {
			$this->research_services = $v;
			$this->modifiedColumns[] = RepositoryPeer::RESEARCH_SERVICES;
		}

	} 
	
	public function setReproductionServices($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->reproduction_services !== $v) {
			$this->reproduction_services = $v;
			$this->modifiedColumns[] = RepositoryPeer::REPRODUCTION_SERVICES;
		}

	} 
	
	public function setPublicFacilities($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->public_facilities !== $v) {
			$this->public_facilities = $v;
			$this->modifiedColumns[] = RepositoryPeer::PUBLIC_FACILITIES;
		}

	} 
	
	public function setDescriptionIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description_identifier !== $v) {
			$this->description_identifier = $v;
			$this->modifiedColumns[] = RepositoryPeer::DESCRIPTION_IDENTIFIER;
		}

	} 
	
	public function setInstitutionIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->institution_identifier !== $v) {
			$this->institution_identifier = $v;
			$this->modifiedColumns[] = RepositoryPeer::INSTITUTION_IDENTIFIER;
		}

	} 
	
	public function setRules($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rules !== $v) {
			$this->rules = $v;
			$this->modifiedColumns[] = RepositoryPeer::RULES;
		}

	} 
	
	public function setStatusId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = RepositoryPeer::STATUS_ID;
		}

		if ($this->aTermRelatedByStatusId !== null && $this->aTermRelatedByStatusId->getId() !== $v) {
			$this->aTermRelatedByStatusId = null;
		}

	} 
	
	public function setLevelOfDetailId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->level_of_detail_id !== $v) {
			$this->level_of_detail_id = $v;
			$this->modifiedColumns[] = RepositoryPeer::LEVEL_OF_DETAIL_ID;
		}

		if ($this->aTermRelatedByLevelOfDetailId !== null && $this->aTermRelatedByLevelOfDetailId->getId() !== $v) {
			$this->aTermRelatedByLevelOfDetailId = null;
		}

	} 
	
	public function setSources($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sources !== $v) {
			$this->sources = $v;
			$this->modifiedColumns[] = RepositoryPeer::SOURCES;
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
			$this->modifiedColumns[] = RepositoryPeer::CREATED_AT;
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
			$this->modifiedColumns[] = RepositoryPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->actor_id = $rs->getInt($startcol + 1);

			$this->identifier = $rs->getString($startcol + 2);

			$this->repository_type_id = $rs->getInt($startcol + 3);

			$this->officers_in_charge = $rs->getString($startcol + 4);

			$this->geocultural_context = $rs->getString($startcol + 5);

			$this->collecting_policies = $rs->getString($startcol + 6);

			$this->buildings = $rs->getString($startcol + 7);

			$this->holdings = $rs->getString($startcol + 8);

			$this->finding_aids = $rs->getString($startcol + 9);

			$this->opening_times = $rs->getString($startcol + 10);

			$this->access_conditions = $rs->getString($startcol + 11);

			$this->disabled_access = $rs->getString($startcol + 12);

			$this->transport = $rs->getString($startcol + 13);

			$this->research_services = $rs->getString($startcol + 14);

			$this->reproduction_services = $rs->getString($startcol + 15);

			$this->public_facilities = $rs->getString($startcol + 16);

			$this->description_identifier = $rs->getString($startcol + 17);

			$this->institution_identifier = $rs->getString($startcol + 18);

			$this->rules = $rs->getString($startcol + 19);

			$this->status_id = $rs->getInt($startcol + 20);

			$this->level_of_detail_id = $rs->getInt($startcol + 21);

			$this->sources = $rs->getString($startcol + 22);

			$this->created_at = $rs->getTimestamp($startcol + 23, null);

			$this->updated_at = $rs->getTimestamp($startcol + 24, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 25; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Repository object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseRepository:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepositoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RepositoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepository:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseRepository:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(RepositoryPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(RepositoryPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RepositoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepository:save:post') as $callable)
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

			if ($this->aTermRelatedByRepositoryTypeId !== null) {
				if ($this->aTermRelatedByRepositoryTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByRepositoryTypeId->save($con);
				}
				$this->setTermRelatedByRepositoryTypeId($this->aTermRelatedByRepositoryTypeId);
			}

			if ($this->aTermRelatedByStatusId !== null) {
				if ($this->aTermRelatedByStatusId->isModified()) {
					$affectedRows += $this->aTermRelatedByStatusId->save($con);
				}
				$this->setTermRelatedByStatusId($this->aTermRelatedByStatusId);
			}

			if ($this->aTermRelatedByLevelOfDetailId !== null) {
				if ($this->aTermRelatedByLevelOfDetailId->isModified()) {
					$affectedRows += $this->aTermRelatedByLevelOfDetailId->save($con);
				}
				$this->setTermRelatedByLevelOfDetailId($this->aTermRelatedByLevelOfDetailId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepositoryPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RepositoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collinformationObjects !== null) {
				foreach($this->collinformationObjects as $referrerFK) {
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

			if ($this->collrepositoryTermRelationships !== null) {
				foreach($this->collrepositoryTermRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colluserTermRelationships !== null) {
				foreach($this->colluserTermRelationships as $referrerFK) {
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

			if ($this->aTermRelatedByRepositoryTypeId !== null) {
				if (!$this->aTermRelatedByRepositoryTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByRepositoryTypeId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByStatusId !== null) {
				if (!$this->aTermRelatedByStatusId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByStatusId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByLevelOfDetailId !== null) {
				if (!$this->aTermRelatedByLevelOfDetailId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByLevelOfDetailId->getValidationFailures());
				}
			}


			if (($retval = RepositoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collinformationObjects !== null) {
					foreach($this->collinformationObjects as $referrerFK) {
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

				if ($this->collrepositoryTermRelationships !== null) {
					foreach($this->collrepositoryTermRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colluserTermRelationships !== null) {
					foreach($this->colluserTermRelationships as $referrerFK) {
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
		$pos = RepositoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getActorId();
				break;
			case 2:
				return $this->getIdentifier();
				break;
			case 3:
				return $this->getRepositoryTypeId();
				break;
			case 4:
				return $this->getOfficersInCharge();
				break;
			case 5:
				return $this->getGeoculturalContext();
				break;
			case 6:
				return $this->getCollectingPolicies();
				break;
			case 7:
				return $this->getBuildings();
				break;
			case 8:
				return $this->getHoldings();
				break;
			case 9:
				return $this->getFindingAids();
				break;
			case 10:
				return $this->getOpeningTimes();
				break;
			case 11:
				return $this->getAccessConditions();
				break;
			case 12:
				return $this->getDisabledAccess();
				break;
			case 13:
				return $this->getTransport();
				break;
			case 14:
				return $this->getResearchServices();
				break;
			case 15:
				return $this->getReproductionServices();
				break;
			case 16:
				return $this->getPublicFacilities();
				break;
			case 17:
				return $this->getDescriptionIdentifier();
				break;
			case 18:
				return $this->getInstitutionIdentifier();
				break;
			case 19:
				return $this->getRules();
				break;
			case 20:
				return $this->getStatusId();
				break;
			case 21:
				return $this->getLevelOfDetailId();
				break;
			case 22:
				return $this->getSources();
				break;
			case 23:
				return $this->getCreatedAt();
				break;
			case 24:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepositoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getActorId(),
			$keys[2] => $this->getIdentifier(),
			$keys[3] => $this->getRepositoryTypeId(),
			$keys[4] => $this->getOfficersInCharge(),
			$keys[5] => $this->getGeoculturalContext(),
			$keys[6] => $this->getCollectingPolicies(),
			$keys[7] => $this->getBuildings(),
			$keys[8] => $this->getHoldings(),
			$keys[9] => $this->getFindingAids(),
			$keys[10] => $this->getOpeningTimes(),
			$keys[11] => $this->getAccessConditions(),
			$keys[12] => $this->getDisabledAccess(),
			$keys[13] => $this->getTransport(),
			$keys[14] => $this->getResearchServices(),
			$keys[15] => $this->getReproductionServices(),
			$keys[16] => $this->getPublicFacilities(),
			$keys[17] => $this->getDescriptionIdentifier(),
			$keys[18] => $this->getInstitutionIdentifier(),
			$keys[19] => $this->getRules(),
			$keys[20] => $this->getStatusId(),
			$keys[21] => $this->getLevelOfDetailId(),
			$keys[22] => $this->getSources(),
			$keys[23] => $this->getCreatedAt(),
			$keys[24] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepositoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setActorId($value);
				break;
			case 2:
				$this->setIdentifier($value);
				break;
			case 3:
				$this->setRepositoryTypeId($value);
				break;
			case 4:
				$this->setOfficersInCharge($value);
				break;
			case 5:
				$this->setGeoculturalContext($value);
				break;
			case 6:
				$this->setCollectingPolicies($value);
				break;
			case 7:
				$this->setBuildings($value);
				break;
			case 8:
				$this->setHoldings($value);
				break;
			case 9:
				$this->setFindingAids($value);
				break;
			case 10:
				$this->setOpeningTimes($value);
				break;
			case 11:
				$this->setAccessConditions($value);
				break;
			case 12:
				$this->setDisabledAccess($value);
				break;
			case 13:
				$this->setTransport($value);
				break;
			case 14:
				$this->setResearchServices($value);
				break;
			case 15:
				$this->setReproductionServices($value);
				break;
			case 16:
				$this->setPublicFacilities($value);
				break;
			case 17:
				$this->setDescriptionIdentifier($value);
				break;
			case 18:
				$this->setInstitutionIdentifier($value);
				break;
			case 19:
				$this->setRules($value);
				break;
			case 20:
				$this->setStatusId($value);
				break;
			case 21:
				$this->setLevelOfDetailId($value);
				break;
			case 22:
				$this->setSources($value);
				break;
			case 23:
				$this->setCreatedAt($value);
				break;
			case 24:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepositoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setActorId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdentifier($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRepositoryTypeId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setOfficersInCharge($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setGeoculturalContext($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCollectingPolicies($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBuildings($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setHoldings($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setFindingAids($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setOpeningTimes($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setAccessConditions($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDisabledAccess($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTransport($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setResearchServices($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setReproductionServices($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setPublicFacilities($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDescriptionIdentifier($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setInstitutionIdentifier($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setRules($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setStatusId($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setLevelOfDetailId($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setSources($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCreatedAt($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setUpdatedAt($arr[$keys[24]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepositoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepositoryPeer::ID)) $criteria->add(RepositoryPeer::ID, $this->id);
		if ($this->isColumnModified(RepositoryPeer::ACTOR_ID)) $criteria->add(RepositoryPeer::ACTOR_ID, $this->actor_id);
		if ($this->isColumnModified(RepositoryPeer::IDENTIFIER)) $criteria->add(RepositoryPeer::IDENTIFIER, $this->identifier);
		if ($this->isColumnModified(RepositoryPeer::REPOSITORY_TYPE_ID)) $criteria->add(RepositoryPeer::REPOSITORY_TYPE_ID, $this->repository_type_id);
		if ($this->isColumnModified(RepositoryPeer::OFFICERS_IN_CHARGE)) $criteria->add(RepositoryPeer::OFFICERS_IN_CHARGE, $this->officers_in_charge);
		if ($this->isColumnModified(RepositoryPeer::GEOCULTURAL_CONTEXT)) $criteria->add(RepositoryPeer::GEOCULTURAL_CONTEXT, $this->geocultural_context);
		if ($this->isColumnModified(RepositoryPeer::COLLECTING_POLICIES)) $criteria->add(RepositoryPeer::COLLECTING_POLICIES, $this->collecting_policies);
		if ($this->isColumnModified(RepositoryPeer::BUILDINGS)) $criteria->add(RepositoryPeer::BUILDINGS, $this->buildings);
		if ($this->isColumnModified(RepositoryPeer::HOLDINGS)) $criteria->add(RepositoryPeer::HOLDINGS, $this->holdings);
		if ($this->isColumnModified(RepositoryPeer::FINDING_AIDS)) $criteria->add(RepositoryPeer::FINDING_AIDS, $this->finding_aids);
		if ($this->isColumnModified(RepositoryPeer::OPENING_TIMES)) $criteria->add(RepositoryPeer::OPENING_TIMES, $this->opening_times);
		if ($this->isColumnModified(RepositoryPeer::ACCESS_CONDITIONS)) $criteria->add(RepositoryPeer::ACCESS_CONDITIONS, $this->access_conditions);
		if ($this->isColumnModified(RepositoryPeer::DISABLED_ACCESS)) $criteria->add(RepositoryPeer::DISABLED_ACCESS, $this->disabled_access);
		if ($this->isColumnModified(RepositoryPeer::TRANSPORT)) $criteria->add(RepositoryPeer::TRANSPORT, $this->transport);
		if ($this->isColumnModified(RepositoryPeer::RESEARCH_SERVICES)) $criteria->add(RepositoryPeer::RESEARCH_SERVICES, $this->research_services);
		if ($this->isColumnModified(RepositoryPeer::REPRODUCTION_SERVICES)) $criteria->add(RepositoryPeer::REPRODUCTION_SERVICES, $this->reproduction_services);
		if ($this->isColumnModified(RepositoryPeer::PUBLIC_FACILITIES)) $criteria->add(RepositoryPeer::PUBLIC_FACILITIES, $this->public_facilities);
		if ($this->isColumnModified(RepositoryPeer::DESCRIPTION_IDENTIFIER)) $criteria->add(RepositoryPeer::DESCRIPTION_IDENTIFIER, $this->description_identifier);
		if ($this->isColumnModified(RepositoryPeer::INSTITUTION_IDENTIFIER)) $criteria->add(RepositoryPeer::INSTITUTION_IDENTIFIER, $this->institution_identifier);
		if ($this->isColumnModified(RepositoryPeer::RULES)) $criteria->add(RepositoryPeer::RULES, $this->rules);
		if ($this->isColumnModified(RepositoryPeer::STATUS_ID)) $criteria->add(RepositoryPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(RepositoryPeer::LEVEL_OF_DETAIL_ID)) $criteria->add(RepositoryPeer::LEVEL_OF_DETAIL_ID, $this->level_of_detail_id);
		if ($this->isColumnModified(RepositoryPeer::SOURCES)) $criteria->add(RepositoryPeer::SOURCES, $this->sources);
		if ($this->isColumnModified(RepositoryPeer::CREATED_AT)) $criteria->add(RepositoryPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(RepositoryPeer::UPDATED_AT)) $criteria->add(RepositoryPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepositoryPeer::DATABASE_NAME);

		$criteria->add(RepositoryPeer::ID, $this->id);

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

		$copyObj->setActorId($this->actor_id);

		$copyObj->setIdentifier($this->identifier);

		$copyObj->setRepositoryTypeId($this->repository_type_id);

		$copyObj->setOfficersInCharge($this->officers_in_charge);

		$copyObj->setGeoculturalContext($this->geocultural_context);

		$copyObj->setCollectingPolicies($this->collecting_policies);

		$copyObj->setBuildings($this->buildings);

		$copyObj->setHoldings($this->holdings);

		$copyObj->setFindingAids($this->finding_aids);

		$copyObj->setOpeningTimes($this->opening_times);

		$copyObj->setAccessConditions($this->access_conditions);

		$copyObj->setDisabledAccess($this->disabled_access);

		$copyObj->setTransport($this->transport);

		$copyObj->setResearchServices($this->research_services);

		$copyObj->setReproductionServices($this->reproduction_services);

		$copyObj->setPublicFacilities($this->public_facilities);

		$copyObj->setDescriptionIdentifier($this->description_identifier);

		$copyObj->setInstitutionIdentifier($this->institution_identifier);

		$copyObj->setRules($this->rules);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setLevelOfDetailId($this->level_of_detail_id);

		$copyObj->setSources($this->sources);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getinformationObjects() as $relObj) {
				$copyObj->addinformationObject($relObj->copy($deepCopy));
			}

			foreach($this->getNotes() as $relObj) {
				$copyObj->addNote($relObj->copy($deepCopy));
			}

			foreach($this->getrepositoryTermRelationships() as $relObj) {
				$copyObj->addrepositoryTermRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getuserTermRelationships() as $relObj) {
				$copyObj->adduserTermRelationship($relObj->copy($deepCopy));
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
			self::$peer = new RepositoryPeer();
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

	
	public function setTermRelatedByRepositoryTypeId($v)
	{


		if ($v === null) {
			$this->setRepositoryTypeId(NULL);
		} else {
			$this->setRepositoryTypeId($v->getId());
		}


		$this->aTermRelatedByRepositoryTypeId = $v;
	}


	
	public function getTermRelatedByRepositoryTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByRepositoryTypeId === null && ($this->repository_type_id !== null)) {

			$this->aTermRelatedByRepositoryTypeId = TermPeer::retrieveByPK($this->repository_type_id, $con);

			
		}
		return $this->aTermRelatedByRepositoryTypeId;
	}

	
	public function setTermRelatedByStatusId($v)
	{


		if ($v === null) {
			$this->setStatusId(NULL);
		} else {
			$this->setStatusId($v->getId());
		}


		$this->aTermRelatedByStatusId = $v;
	}


	
	public function getTermRelatedByStatusId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByStatusId === null && ($this->status_id !== null)) {

			$this->aTermRelatedByStatusId = TermPeer::retrieveByPK($this->status_id, $con);

			
		}
		return $this->aTermRelatedByStatusId;
	}

	
	public function setTermRelatedByLevelOfDetailId($v)
	{


		if ($v === null) {
			$this->setLevelOfDetailId(NULL);
		} else {
			$this->setLevelOfDetailId($v->getId());
		}


		$this->aTermRelatedByLevelOfDetailId = $v;
	}


	
	public function getTermRelatedByLevelOfDetailId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByLevelOfDetailId === null && ($this->level_of_detail_id !== null)) {

			$this->aTermRelatedByLevelOfDetailId = TermPeer::retrieveByPK($this->level_of_detail_id, $con);

			
		}
		return $this->aTermRelatedByLevelOfDetailId;
	}

	
	public function initinformationObjects()
	{
		if ($this->collinformationObjects === null) {
			$this->collinformationObjects = array();
		}
	}

	
	public function getinformationObjects($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjects === null) {
			if ($this->isNew()) {
			   $this->collinformationObjects = array();
			} else {

				$criteria->add(informationObjectPeer::REPOSITORY_ID, $this->getId());

				informationObjectPeer::addSelectColumns($criteria);
				$this->collinformationObjects = informationObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(informationObjectPeer::REPOSITORY_ID, $this->getId());

				informationObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastinformationObjectCriteria) || !$this->lastinformationObjectCriteria->equals($criteria)) {
					$this->collinformationObjects = informationObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastinformationObjectCriteria = $criteria;
		return $this->collinformationObjects;
	}

	
	public function countinformationObjects($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(informationObjectPeer::REPOSITORY_ID, $this->getId());

		return informationObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addinformationObject(informationObject $l)
	{
		$this->collinformationObjects[] = $l;
		$l->setRepository($this);
	}


	
	public function getinformationObjectsJoinTermRelatedByLevelOfDescriptionId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjects === null) {
			if ($this->isNew()) {
				$this->collinformationObjects = array();
			} else {

				$criteria->add(informationObjectPeer::REPOSITORY_ID, $this->getId());

				$this->collinformationObjects = informationObjectPeer::doSelectJoinTermRelatedByLevelOfDescriptionId($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectPeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastinformationObjectCriteria) || !$this->lastinformationObjectCriteria->equals($criteria)) {
				$this->collinformationObjects = informationObjectPeer::doSelectJoinTermRelatedByLevelOfDescriptionId($criteria, $con);
			}
		}
		$this->lastinformationObjectCriteria = $criteria;

		return $this->collinformationObjects;
	}


	
	public function getinformationObjectsJoinTermRelatedByCollectionTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjects === null) {
			if ($this->isNew()) {
				$this->collinformationObjects = array();
			} else {

				$criteria->add(informationObjectPeer::REPOSITORY_ID, $this->getId());

				$this->collinformationObjects = informationObjectPeer::doSelectJoinTermRelatedByCollectionTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectPeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastinformationObjectCriteria) || !$this->lastinformationObjectCriteria->equals($criteria)) {
				$this->collinformationObjects = informationObjectPeer::doSelectJoinTermRelatedByCollectionTypeId($criteria, $con);
			}
		}
		$this->lastinformationObjectCriteria = $criteria;

		return $this->collinformationObjects;
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

				$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

				NotePeer::addSelectColumns($criteria);
				$this->collNotes = NotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

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

		$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

		return NotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNote(Note $l)
	{
		$this->collNotes[] = $l;
		$l->setRepository($this);
	}


	
	public function getNotesJoininformationObject($criteria = null, $con = null)
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

				$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoininformationObject($criteria, $con);
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

				$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}


	
	public function getNotesJoinfunctionDescription($criteria = null, $con = null)
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

				$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinfunctionDescription($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinfunctionDescription($criteria, $con);
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

				$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

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

				$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}

	
	public function initrepositoryTermRelationships()
	{
		if ($this->collrepositoryTermRelationships === null) {
			$this->collrepositoryTermRelationships = array();
		}
	}

	
	public function getrepositoryTermRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrepositoryTermRelationships === null) {
			if ($this->isNew()) {
			   $this->collrepositoryTermRelationships = array();
			} else {

				$criteria->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				repositoryTermRelationshipPeer::addSelectColumns($criteria);
				$this->collrepositoryTermRelationships = repositoryTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				repositoryTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrepositoryTermRelationshipCriteria) || !$this->lastrepositoryTermRelationshipCriteria->equals($criteria)) {
					$this->collrepositoryTermRelationships = repositoryTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrepositoryTermRelationshipCriteria = $criteria;
		return $this->collrepositoryTermRelationships;
	}

	
	public function countrepositoryTermRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

		return repositoryTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrepositoryTermRelationship(repositoryTermRelationship $l)
	{
		$this->collrepositoryTermRelationships[] = $l;
		$l->setRepository($this);
	}


	
	public function getrepositoryTermRelationshipsJoinTermRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrepositoryTermRelationships === null) {
			if ($this->isNew()) {
				$this->collrepositoryTermRelationships = array();
			} else {

				$criteria->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				$this->collrepositoryTermRelationships = repositoryTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		} else {
									
			$criteria->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastrepositoryTermRelationshipCriteria) || !$this->lastrepositoryTermRelationshipCriteria->equals($criteria)) {
				$this->collrepositoryTermRelationships = repositoryTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		}
		$this->lastrepositoryTermRelationshipCriteria = $criteria;

		return $this->collrepositoryTermRelationships;
	}


	
	public function getrepositoryTermRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrepositoryTermRelationships === null) {
			if ($this->isNew()) {
				$this->collrepositoryTermRelationships = array();
			} else {

				$criteria->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				$this->collrepositoryTermRelationships = repositoryTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(repositoryTermRelationshipPeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastrepositoryTermRelationshipCriteria) || !$this->lastrepositoryTermRelationshipCriteria->equals($criteria)) {
				$this->collrepositoryTermRelationships = repositoryTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lastrepositoryTermRelationshipCriteria = $criteria;

		return $this->collrepositoryTermRelationships;
	}

	
	public function inituserTermRelationships()
	{
		if ($this->colluserTermRelationships === null) {
			$this->colluserTermRelationships = array();
		}
	}

	
	public function getuserTermRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationships === null) {
			if ($this->isNew()) {
			   $this->colluserTermRelationships = array();
			} else {

				$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				userTermRelationshipPeer::addSelectColumns($criteria);
				$this->colluserTermRelationships = userTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				userTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastuserTermRelationshipCriteria) || !$this->lastuserTermRelationshipCriteria->equals($criteria)) {
					$this->colluserTermRelationships = userTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastuserTermRelationshipCriteria = $criteria;
		return $this->colluserTermRelationships;
	}

	
	public function countuserTermRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

		return userTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adduserTermRelationship(userTermRelationship $l)
	{
		$this->colluserTermRelationships[] = $l;
		$l->setRepository($this);
	}


	
	public function getuserTermRelationshipsJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationships === null) {
			if ($this->isNew()) {
				$this->colluserTermRelationships = array();
			} else {

				$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				$this->colluserTermRelationships = userTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastuserTermRelationshipCriteria) || !$this->lastuserTermRelationshipCriteria->equals($criteria)) {
				$this->colluserTermRelationships = userTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastuserTermRelationshipCriteria = $criteria;

		return $this->colluserTermRelationships;
	}


	
	public function getuserTermRelationshipsJoinTermRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationships === null) {
			if ($this->isNew()) {
				$this->colluserTermRelationships = array();
			} else {

				$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				$this->colluserTermRelationships = userTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		} else {
									
			$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastuserTermRelationshipCriteria) || !$this->lastuserTermRelationshipCriteria->equals($criteria)) {
				$this->colluserTermRelationships = userTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		}
		$this->lastuserTermRelationshipCriteria = $criteria;

		return $this->colluserTermRelationships;
	}


	
	public function getuserTermRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationships === null) {
			if ($this->isNew()) {
				$this->colluserTermRelationships = array();
			} else {

				$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

				$this->colluserTermRelationships = userTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(userTermRelationshipPeer::REPOSITORY_ID, $this->getId());

			if (!isset($this->lastuserTermRelationshipCriteria) || !$this->lastuserTermRelationshipCriteria->equals($criteria)) {
				$this->colluserTermRelationships = userTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lastuserTermRelationshipCriteria = $criteria;

		return $this->colluserTermRelationships;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRepository:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepository::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 