<?php


abstract class BaseActor extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $authorized_form_of_name;


	
	protected $type_of_entity_id;


	
	protected $identifiers;


	
	protected $history;


	
	protected $legal_status;


	
	protected $functions;


	
	protected $mandates;


	
	protected $internal_structures;


	
	protected $general_context;


	
	protected $authority_record_identifier;


	
	protected $institution_identifier;


	
	protected $rules;


	
	protected $status_id;


	
	protected $level_of_detail_id;


	
	protected $sources;


	
	protected $tree_id;


	
	protected $tree_left_id;


	
	protected $tree_right_id;


	
	protected $tree_parent_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTermRelatedByTypeOfEntityId;

	
	protected $aTermRelatedByStatusId;

	
	protected $aTermRelatedByLevelOfDetailId;

	
	protected $collNotes;

	
	protected $lastNoteCriteria = null;

	
	protected $collActorNames;

	
	protected $lastActorNameCriteria = null;

	
	protected $collActorRecursiveRelationshipsRelatedByActorId;

	
	protected $lastActorRecursiveRelationshipRelatedByActorIdCriteria = null;

	
	protected $collActorRecursiveRelationshipsRelatedByRelatedActorId;

	
	protected $lastActorRecursiveRelationshipRelatedByRelatedActorIdCriteria = null;

	
	protected $collActorTermRelationships;

	
	protected $lastActorTermRelationshipCriteria = null;

	
	protected $collContactInformations;

	
	protected $lastContactInformationCriteria = null;

	
	protected $collRepositorys;

	
	protected $lastRepositoryCriteria = null;

	
	protected $collEvents;

	
	protected $lastEventCriteria = null;

	
	protected $collRightActorRelationships;

	
	protected $lastRightActorRelationshipCriteria = null;

	
	protected $collUsers;

	
	protected $lastUserCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getAuthorizedFormOfName()
	{

		return $this->authorized_form_of_name;
	}

	
	public function getTypeOfEntityId()
	{

		return $this->type_of_entity_id;
	}

	
	public function getIdentifiers()
	{

		return $this->identifiers;
	}

	
	public function getHistory()
	{

		return $this->history;
	}

	
	public function getLegalStatus()
	{

		return $this->legal_status;
	}

	
	public function getFunctions()
	{

		return $this->functions;
	}

	
	public function getMandates()
	{

		return $this->mandates;
	}

	
	public function getInternalStructures()
	{

		return $this->internal_structures;
	}

	
	public function getGeneralContext()
	{

		return $this->general_context;
	}

	
	public function getAuthorityRecordIdentifier()
	{

		return $this->authority_record_identifier;
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
			$this->modifiedColumns[] = ActorPeer::ID;
		}

	} 
	
	public function setAuthorizedFormOfName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->authorized_form_of_name !== $v) {
			$this->authorized_form_of_name = $v;
			$this->modifiedColumns[] = ActorPeer::AUTHORIZED_FORM_OF_NAME;
		}

	} 
	
	public function setTypeOfEntityId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->type_of_entity_id !== $v) {
			$this->type_of_entity_id = $v;
			$this->modifiedColumns[] = ActorPeer::TYPE_OF_ENTITY_ID;
		}

		if ($this->aTermRelatedByTypeOfEntityId !== null && $this->aTermRelatedByTypeOfEntityId->getId() !== $v) {
			$this->aTermRelatedByTypeOfEntityId = null;
		}

	} 
	
	public function setIdentifiers($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->identifiers !== $v) {
			$this->identifiers = $v;
			$this->modifiedColumns[] = ActorPeer::IDENTIFIERS;
		}

	} 
	
	public function setHistory($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->history !== $v) {
			$this->history = $v;
			$this->modifiedColumns[] = ActorPeer::HISTORY;
		}

	} 
	
	public function setLegalStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->legal_status !== $v) {
			$this->legal_status = $v;
			$this->modifiedColumns[] = ActorPeer::LEGAL_STATUS;
		}

	} 
	
	public function setFunctions($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->functions !== $v) {
			$this->functions = $v;
			$this->modifiedColumns[] = ActorPeer::FUNCTIONS;
		}

	} 
	
	public function setMandates($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mandates !== $v) {
			$this->mandates = $v;
			$this->modifiedColumns[] = ActorPeer::MANDATES;
		}

	} 
	
	public function setInternalStructures($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->internal_structures !== $v) {
			$this->internal_structures = $v;
			$this->modifiedColumns[] = ActorPeer::INTERNAL_STRUCTURES;
		}

	} 
	
	public function setGeneralContext($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->general_context !== $v) {
			$this->general_context = $v;
			$this->modifiedColumns[] = ActorPeer::GENERAL_CONTEXT;
		}

	} 
	
	public function setAuthorityRecordIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->authority_record_identifier !== $v) {
			$this->authority_record_identifier = $v;
			$this->modifiedColumns[] = ActorPeer::AUTHORITY_RECORD_IDENTIFIER;
		}

	} 
	
	public function setInstitutionIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->institution_identifier !== $v) {
			$this->institution_identifier = $v;
			$this->modifiedColumns[] = ActorPeer::INSTITUTION_IDENTIFIER;
		}

	} 
	
	public function setRules($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rules !== $v) {
			$this->rules = $v;
			$this->modifiedColumns[] = ActorPeer::RULES;
		}

	} 
	
	public function setStatusId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = ActorPeer::STATUS_ID;
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
			$this->modifiedColumns[] = ActorPeer::LEVEL_OF_DETAIL_ID;
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
			$this->modifiedColumns[] = ActorPeer::SOURCES;
		}

	} 
	
	public function setTreeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_id !== $v) {
			$this->tree_id = $v;
			$this->modifiedColumns[] = ActorPeer::TREE_ID;
		}

	} 
	
	public function setTreeLeftId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_left_id !== $v) {
			$this->tree_left_id = $v;
			$this->modifiedColumns[] = ActorPeer::TREE_LEFT_ID;
		}

	} 
	
	public function setTreeRightId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_right_id !== $v) {
			$this->tree_right_id = $v;
			$this->modifiedColumns[] = ActorPeer::TREE_RIGHT_ID;
		}

	} 
	
	public function setTreeParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_parent_id !== $v) {
			$this->tree_parent_id = $v;
			$this->modifiedColumns[] = ActorPeer::TREE_PARENT_ID;
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
			$this->modifiedColumns[] = ActorPeer::CREATED_AT;
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
			$this->modifiedColumns[] = ActorPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->authorized_form_of_name = $rs->getString($startcol + 1);

			$this->type_of_entity_id = $rs->getInt($startcol + 2);

			$this->identifiers = $rs->getString($startcol + 3);

			$this->history = $rs->getString($startcol + 4);

			$this->legal_status = $rs->getString($startcol + 5);

			$this->functions = $rs->getString($startcol + 6);

			$this->mandates = $rs->getString($startcol + 7);

			$this->internal_structures = $rs->getString($startcol + 8);

			$this->general_context = $rs->getString($startcol + 9);

			$this->authority_record_identifier = $rs->getString($startcol + 10);

			$this->institution_identifier = $rs->getString($startcol + 11);

			$this->rules = $rs->getString($startcol + 12);

			$this->status_id = $rs->getInt($startcol + 13);

			$this->level_of_detail_id = $rs->getInt($startcol + 14);

			$this->sources = $rs->getString($startcol + 15);

			$this->tree_id = $rs->getInt($startcol + 16);

			$this->tree_left_id = $rs->getInt($startcol + 17);

			$this->tree_right_id = $rs->getInt($startcol + 18);

			$this->tree_parent_id = $rs->getInt($startcol + 19);

			$this->created_at = $rs->getTimestamp($startcol + 20, null);

			$this->updated_at = $rs->getTimestamp($startcol + 21, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 22; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Actor object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseActor:delete:pre') as $callable)
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
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ActorPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseActor:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseActor:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(ActorPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(ActorPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseActor:save:post') as $callable)
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


												
			if ($this->aTermRelatedByTypeOfEntityId !== null) {
				if ($this->aTermRelatedByTypeOfEntityId->isModified()) {
					$affectedRows += $this->aTermRelatedByTypeOfEntityId->save($con);
				}
				$this->setTermRelatedByTypeOfEntityId($this->aTermRelatedByTypeOfEntityId);
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
					$pk = ActorPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ActorPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collNotes !== null) {
				foreach($this->collNotes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorNames !== null) {
				foreach($this->collActorNames as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorRecursiveRelationshipsRelatedByActorId !== null) {
				foreach($this->collActorRecursiveRelationshipsRelatedByActorId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorRecursiveRelationshipsRelatedByRelatedActorId !== null) {
				foreach($this->collActorRecursiveRelationshipsRelatedByRelatedActorId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorTermRelationships !== null) {
				foreach($this->collActorTermRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactInformations !== null) {
				foreach($this->collContactInformations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepositorys !== null) {
				foreach($this->collRepositorys as $referrerFK) {
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

			if ($this->collRightActorRelationships !== null) {
				foreach($this->collRightActorRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsers !== null) {
				foreach($this->collUsers as $referrerFK) {
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


												
			if ($this->aTermRelatedByTypeOfEntityId !== null) {
				if (!$this->aTermRelatedByTypeOfEntityId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByTypeOfEntityId->getValidationFailures());
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


			if (($retval = ActorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNotes !== null) {
					foreach($this->collNotes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorNames !== null) {
					foreach($this->collActorNames as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorRecursiveRelationshipsRelatedByActorId !== null) {
					foreach($this->collActorRecursiveRelationshipsRelatedByActorId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorRecursiveRelationshipsRelatedByRelatedActorId !== null) {
					foreach($this->collActorRecursiveRelationshipsRelatedByRelatedActorId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorTermRelationships !== null) {
					foreach($this->collActorTermRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactInformations !== null) {
					foreach($this->collContactInformations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepositorys !== null) {
					foreach($this->collRepositorys as $referrerFK) {
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

				if ($this->collRightActorRelationships !== null) {
					foreach($this->collRightActorRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsers !== null) {
					foreach($this->collUsers as $referrerFK) {
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
		$pos = ActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getAuthorizedFormOfName();
				break;
			case 2:
				return $this->getTypeOfEntityId();
				break;
			case 3:
				return $this->getIdentifiers();
				break;
			case 4:
				return $this->getHistory();
				break;
			case 5:
				return $this->getLegalStatus();
				break;
			case 6:
				return $this->getFunctions();
				break;
			case 7:
				return $this->getMandates();
				break;
			case 8:
				return $this->getInternalStructures();
				break;
			case 9:
				return $this->getGeneralContext();
				break;
			case 10:
				return $this->getAuthorityRecordIdentifier();
				break;
			case 11:
				return $this->getInstitutionIdentifier();
				break;
			case 12:
				return $this->getRules();
				break;
			case 13:
				return $this->getStatusId();
				break;
			case 14:
				return $this->getLevelOfDetailId();
				break;
			case 15:
				return $this->getSources();
				break;
			case 16:
				return $this->getTreeId();
				break;
			case 17:
				return $this->getTreeLeftId();
				break;
			case 18:
				return $this->getTreeRightId();
				break;
			case 19:
				return $this->getTreeParentId();
				break;
			case 20:
				return $this->getCreatedAt();
				break;
			case 21:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ActorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAuthorizedFormOfName(),
			$keys[2] => $this->getTypeOfEntityId(),
			$keys[3] => $this->getIdentifiers(),
			$keys[4] => $this->getHistory(),
			$keys[5] => $this->getLegalStatus(),
			$keys[6] => $this->getFunctions(),
			$keys[7] => $this->getMandates(),
			$keys[8] => $this->getInternalStructures(),
			$keys[9] => $this->getGeneralContext(),
			$keys[10] => $this->getAuthorityRecordIdentifier(),
			$keys[11] => $this->getInstitutionIdentifier(),
			$keys[12] => $this->getRules(),
			$keys[13] => $this->getStatusId(),
			$keys[14] => $this->getLevelOfDetailId(),
			$keys[15] => $this->getSources(),
			$keys[16] => $this->getTreeId(),
			$keys[17] => $this->getTreeLeftId(),
			$keys[18] => $this->getTreeRightId(),
			$keys[19] => $this->getTreeParentId(),
			$keys[20] => $this->getCreatedAt(),
			$keys[21] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ActorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setAuthorizedFormOfName($value);
				break;
			case 2:
				$this->setTypeOfEntityId($value);
				break;
			case 3:
				$this->setIdentifiers($value);
				break;
			case 4:
				$this->setHistory($value);
				break;
			case 5:
				$this->setLegalStatus($value);
				break;
			case 6:
				$this->setFunctions($value);
				break;
			case 7:
				$this->setMandates($value);
				break;
			case 8:
				$this->setInternalStructures($value);
				break;
			case 9:
				$this->setGeneralContext($value);
				break;
			case 10:
				$this->setAuthorityRecordIdentifier($value);
				break;
			case 11:
				$this->setInstitutionIdentifier($value);
				break;
			case 12:
				$this->setRules($value);
				break;
			case 13:
				$this->setStatusId($value);
				break;
			case 14:
				$this->setLevelOfDetailId($value);
				break;
			case 15:
				$this->setSources($value);
				break;
			case 16:
				$this->setTreeId($value);
				break;
			case 17:
				$this->setTreeLeftId($value);
				break;
			case 18:
				$this->setTreeRightId($value);
				break;
			case 19:
				$this->setTreeParentId($value);
				break;
			case 20:
				$this->setCreatedAt($value);
				break;
			case 21:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ActorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAuthorizedFormOfName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTypeOfEntityId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIdentifiers($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHistory($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLegalStatus($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFunctions($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMandates($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setInternalStructures($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setGeneralContext($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setAuthorityRecordIdentifier($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setInstitutionIdentifier($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setRules($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setStatusId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLevelOfDetailId($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setSources($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setTreeId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setTreeLeftId($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setTreeRightId($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setTreeParentId($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCreatedAt($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setUpdatedAt($arr[$keys[21]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ActorPeer::DATABASE_NAME);

		if ($this->isColumnModified(ActorPeer::ID)) $criteria->add(ActorPeer::ID, $this->id);
		if ($this->isColumnModified(ActorPeer::AUTHORIZED_FORM_OF_NAME)) $criteria->add(ActorPeer::AUTHORIZED_FORM_OF_NAME, $this->authorized_form_of_name);
		if ($this->isColumnModified(ActorPeer::TYPE_OF_ENTITY_ID)) $criteria->add(ActorPeer::TYPE_OF_ENTITY_ID, $this->type_of_entity_id);
		if ($this->isColumnModified(ActorPeer::IDENTIFIERS)) $criteria->add(ActorPeer::IDENTIFIERS, $this->identifiers);
		if ($this->isColumnModified(ActorPeer::HISTORY)) $criteria->add(ActorPeer::HISTORY, $this->history);
		if ($this->isColumnModified(ActorPeer::LEGAL_STATUS)) $criteria->add(ActorPeer::LEGAL_STATUS, $this->legal_status);
		if ($this->isColumnModified(ActorPeer::FUNCTIONS)) $criteria->add(ActorPeer::FUNCTIONS, $this->functions);
		if ($this->isColumnModified(ActorPeer::MANDATES)) $criteria->add(ActorPeer::MANDATES, $this->mandates);
		if ($this->isColumnModified(ActorPeer::INTERNAL_STRUCTURES)) $criteria->add(ActorPeer::INTERNAL_STRUCTURES, $this->internal_structures);
		if ($this->isColumnModified(ActorPeer::GENERAL_CONTEXT)) $criteria->add(ActorPeer::GENERAL_CONTEXT, $this->general_context);
		if ($this->isColumnModified(ActorPeer::AUTHORITY_RECORD_IDENTIFIER)) $criteria->add(ActorPeer::AUTHORITY_RECORD_IDENTIFIER, $this->authority_record_identifier);
		if ($this->isColumnModified(ActorPeer::INSTITUTION_IDENTIFIER)) $criteria->add(ActorPeer::INSTITUTION_IDENTIFIER, $this->institution_identifier);
		if ($this->isColumnModified(ActorPeer::RULES)) $criteria->add(ActorPeer::RULES, $this->rules);
		if ($this->isColumnModified(ActorPeer::STATUS_ID)) $criteria->add(ActorPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(ActorPeer::LEVEL_OF_DETAIL_ID)) $criteria->add(ActorPeer::LEVEL_OF_DETAIL_ID, $this->level_of_detail_id);
		if ($this->isColumnModified(ActorPeer::SOURCES)) $criteria->add(ActorPeer::SOURCES, $this->sources);
		if ($this->isColumnModified(ActorPeer::TREE_ID)) $criteria->add(ActorPeer::TREE_ID, $this->tree_id);
		if ($this->isColumnModified(ActorPeer::TREE_LEFT_ID)) $criteria->add(ActorPeer::TREE_LEFT_ID, $this->tree_left_id);
		if ($this->isColumnModified(ActorPeer::TREE_RIGHT_ID)) $criteria->add(ActorPeer::TREE_RIGHT_ID, $this->tree_right_id);
		if ($this->isColumnModified(ActorPeer::TREE_PARENT_ID)) $criteria->add(ActorPeer::TREE_PARENT_ID, $this->tree_parent_id);
		if ($this->isColumnModified(ActorPeer::CREATED_AT)) $criteria->add(ActorPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ActorPeer::UPDATED_AT)) $criteria->add(ActorPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ActorPeer::DATABASE_NAME);

		$criteria->add(ActorPeer::ID, $this->id);

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

		$copyObj->setAuthorizedFormOfName($this->authorized_form_of_name);

		$copyObj->setTypeOfEntityId($this->type_of_entity_id);

		$copyObj->setIdentifiers($this->identifiers);

		$copyObj->setHistory($this->history);

		$copyObj->setLegalStatus($this->legal_status);

		$copyObj->setFunctions($this->functions);

		$copyObj->setMandates($this->mandates);

		$copyObj->setInternalStructures($this->internal_structures);

		$copyObj->setGeneralContext($this->general_context);

		$copyObj->setAuthorityRecordIdentifier($this->authority_record_identifier);

		$copyObj->setInstitutionIdentifier($this->institution_identifier);

		$copyObj->setRules($this->rules);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setLevelOfDetailId($this->level_of_detail_id);

		$copyObj->setSources($this->sources);

		$copyObj->setTreeId($this->tree_id);

		$copyObj->setTreeLeftId($this->tree_left_id);

		$copyObj->setTreeRightId($this->tree_right_id);

		$copyObj->setTreeParentId($this->tree_parent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getNotes() as $relObj) {
				$copyObj->addNote($relObj->copy($deepCopy));
			}

			foreach($this->getActorNames() as $relObj) {
				$copyObj->addActorName($relObj->copy($deepCopy));
			}

			foreach($this->getActorRecursiveRelationshipsRelatedByActorId() as $relObj) {
				$copyObj->addActorRecursiveRelationshipRelatedByActorId($relObj->copy($deepCopy));
			}

			foreach($this->getActorRecursiveRelationshipsRelatedByRelatedActorId() as $relObj) {
				$copyObj->addActorRecursiveRelationshipRelatedByRelatedActorId($relObj->copy($deepCopy));
			}

			foreach($this->getActorTermRelationships() as $relObj) {
				$copyObj->addActorTermRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getContactInformations() as $relObj) {
				$copyObj->addContactInformation($relObj->copy($deepCopy));
			}

			foreach($this->getRepositorys() as $relObj) {
				$copyObj->addRepository($relObj->copy($deepCopy));
			}

			foreach($this->getEvents() as $relObj) {
				$copyObj->addEvent($relObj->copy($deepCopy));
			}

			foreach($this->getRightActorRelationships() as $relObj) {
				$copyObj->addRightActorRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getUsers() as $relObj) {
				$copyObj->addUser($relObj->copy($deepCopy));
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
			self::$peer = new ActorPeer();
		}
		return self::$peer;
	}

	
	public function setTermRelatedByTypeOfEntityId($v)
	{


		if ($v === null) {
			$this->setTypeOfEntityId(NULL);
		} else {
			$this->setTypeOfEntityId($v->getId());
		}


		$this->aTermRelatedByTypeOfEntityId = $v;
	}


	
	public function getTermRelatedByTypeOfEntityId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByTypeOfEntityId === null && ($this->type_of_entity_id !== null)) {

			$this->aTermRelatedByTypeOfEntityId = TermPeer::retrieveByPK($this->type_of_entity_id, $con);

			
		}
		return $this->aTermRelatedByTypeOfEntityId;
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

				$criteria->add(NotePeer::ACTOR_ID, $this->getId());

				NotePeer::addSelectColumns($criteria);
				$this->collNotes = NotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotePeer::ACTOR_ID, $this->getId());

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

		$criteria->add(NotePeer::ACTOR_ID, $this->getId());

		return NotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNote(Note $l)
	{
		$this->collNotes[] = $l;
		$l->setActor($this);
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

				$criteria->add(NotePeer::ACTOR_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinInformationObject($criteria, $con);
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

				$criteria->add(NotePeer::ACTOR_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::ACTOR_ID, $this->getId());

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

				$criteria->add(NotePeer::ACTOR_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinFunctionDescription($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::ACTOR_ID, $this->getId());

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

				$criteria->add(NotePeer::ACTOR_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::ACTOR_ID, $this->getId());

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

				$criteria->add(NotePeer::ACTOR_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}

	
	public function initActorNames()
	{
		if ($this->collActorNames === null) {
			$this->collActorNames = array();
		}
	}

	
	public function getActorNames($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorNamePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorNames === null) {
			if ($this->isNew()) {
			   $this->collActorNames = array();
			} else {

				$criteria->add(ActorNamePeer::ACTOR_ID, $this->getId());

				ActorNamePeer::addSelectColumns($criteria);
				$this->collActorNames = ActorNamePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorNamePeer::ACTOR_ID, $this->getId());

				ActorNamePeer::addSelectColumns($criteria);
				if (!isset($this->lastActorNameCriteria) || !$this->lastActorNameCriteria->equals($criteria)) {
					$this->collActorNames = ActorNamePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorNameCriteria = $criteria;
		return $this->collActorNames;
	}

	
	public function countActorNames($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorNamePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorNamePeer::ACTOR_ID, $this->getId());

		return ActorNamePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorName(ActorName $l)
	{
		$this->collActorNames[] = $l;
		$l->setActor($this);
	}


	
	public function getActorNamesJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorNamePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorNames === null) {
			if ($this->isNew()) {
				$this->collActorNames = array();
			} else {

				$criteria->add(ActorNamePeer::ACTOR_ID, $this->getId());

				$this->collActorNames = ActorNamePeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorNamePeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastActorNameCriteria) || !$this->lastActorNameCriteria->equals($criteria)) {
				$this->collActorNames = ActorNamePeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastActorNameCriteria = $criteria;

		return $this->collActorNames;
	}

	
	public function initActorRecursiveRelationshipsRelatedByActorId()
	{
		if ($this->collActorRecursiveRelationshipsRelatedByActorId === null) {
			$this->collActorRecursiveRelationshipsRelatedByActorId = array();
		}
	}

	
	public function getActorRecursiveRelationshipsRelatedByActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorRecursiveRelationshipsRelatedByActorId === null) {
			if ($this->isNew()) {
			   $this->collActorRecursiveRelationshipsRelatedByActorId = array();
			} else {

				$criteria->add(ActorRecursiveRelationshipPeer::ACTOR_ID, $this->getId());

				ActorRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collActorRecursiveRelationshipsRelatedByActorId = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorRecursiveRelationshipPeer::ACTOR_ID, $this->getId());

				ActorRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorRecursiveRelationshipRelatedByActorIdCriteria) || !$this->lastActorRecursiveRelationshipRelatedByActorIdCriteria->equals($criteria)) {
					$this->collActorRecursiveRelationshipsRelatedByActorId = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorRecursiveRelationshipRelatedByActorIdCriteria = $criteria;
		return $this->collActorRecursiveRelationshipsRelatedByActorId;
	}

	
	public function countActorRecursiveRelationshipsRelatedByActorId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorRecursiveRelationshipPeer::ACTOR_ID, $this->getId());

		return ActorRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorRecursiveRelationshipRelatedByActorId(ActorRecursiveRelationship $l)
	{
		$this->collActorRecursiveRelationshipsRelatedByActorId[] = $l;
		$l->setActorRelatedByActorId($this);
	}


	
	public function getActorRecursiveRelationshipsRelatedByActorIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorRecursiveRelationshipsRelatedByActorId === null) {
			if ($this->isNew()) {
				$this->collActorRecursiveRelationshipsRelatedByActorId = array();
			} else {

				$criteria->add(ActorRecursiveRelationshipPeer::ACTOR_ID, $this->getId());

				$this->collActorRecursiveRelationshipsRelatedByActorId = ActorRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorRecursiveRelationshipPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastActorRecursiveRelationshipRelatedByActorIdCriteria) || !$this->lastActorRecursiveRelationshipRelatedByActorIdCriteria->equals($criteria)) {
				$this->collActorRecursiveRelationshipsRelatedByActorId = ActorRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastActorRecursiveRelationshipRelatedByActorIdCriteria = $criteria;

		return $this->collActorRecursiveRelationshipsRelatedByActorId;
	}

	
	public function initActorRecursiveRelationshipsRelatedByRelatedActorId()
	{
		if ($this->collActorRecursiveRelationshipsRelatedByRelatedActorId === null) {
			$this->collActorRecursiveRelationshipsRelatedByRelatedActorId = array();
		}
	}

	
	public function getActorRecursiveRelationshipsRelatedByRelatedActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorRecursiveRelationshipsRelatedByRelatedActorId === null) {
			if ($this->isNew()) {
			   $this->collActorRecursiveRelationshipsRelatedByRelatedActorId = array();
			} else {

				$criteria->add(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, $this->getId());

				ActorRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collActorRecursiveRelationshipsRelatedByRelatedActorId = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, $this->getId());

				ActorRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorRecursiveRelationshipRelatedByRelatedActorIdCriteria) || !$this->lastActorRecursiveRelationshipRelatedByRelatedActorIdCriteria->equals($criteria)) {
					$this->collActorRecursiveRelationshipsRelatedByRelatedActorId = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorRecursiveRelationshipRelatedByRelatedActorIdCriteria = $criteria;
		return $this->collActorRecursiveRelationshipsRelatedByRelatedActorId;
	}

	
	public function countActorRecursiveRelationshipsRelatedByRelatedActorId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, $this->getId());

		return ActorRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorRecursiveRelationshipRelatedByRelatedActorId(ActorRecursiveRelationship $l)
	{
		$this->collActorRecursiveRelationshipsRelatedByRelatedActorId[] = $l;
		$l->setActorRelatedByRelatedActorId($this);
	}


	
	public function getActorRecursiveRelationshipsRelatedByRelatedActorIdJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorRecursiveRelationshipsRelatedByRelatedActorId === null) {
			if ($this->isNew()) {
				$this->collActorRecursiveRelationshipsRelatedByRelatedActorId = array();
			} else {

				$criteria->add(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, $this->getId());

				$this->collActorRecursiveRelationshipsRelatedByRelatedActorId = ActorRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, $this->getId());

			if (!isset($this->lastActorRecursiveRelationshipRelatedByRelatedActorIdCriteria) || !$this->lastActorRecursiveRelationshipRelatedByRelatedActorIdCriteria->equals($criteria)) {
				$this->collActorRecursiveRelationshipsRelatedByRelatedActorId = ActorRecursiveRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastActorRecursiveRelationshipRelatedByRelatedActorIdCriteria = $criteria;

		return $this->collActorRecursiveRelationshipsRelatedByRelatedActorId;
	}

	
	public function initActorTermRelationships()
	{
		if ($this->collActorTermRelationships === null) {
			$this->collActorTermRelationships = array();
		}
	}

	
	public function getActorTermRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorTermRelationships === null) {
			if ($this->isNew()) {
			   $this->collActorTermRelationships = array();
			} else {

				$criteria->add(ActorTermRelationshipPeer::ACTOR_ID, $this->getId());

				ActorTermRelationshipPeer::addSelectColumns($criteria);
				$this->collActorTermRelationships = ActorTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorTermRelationshipPeer::ACTOR_ID, $this->getId());

				ActorTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorTermRelationshipCriteria) || !$this->lastActorTermRelationshipCriteria->equals($criteria)) {
					$this->collActorTermRelationships = ActorTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorTermRelationshipCriteria = $criteria;
		return $this->collActorTermRelationships;
	}

	
	public function countActorTermRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorTermRelationshipPeer::ACTOR_ID, $this->getId());

		return ActorTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorTermRelationship(ActorTermRelationship $l)
	{
		$this->collActorTermRelationships[] = $l;
		$l->setActor($this);
	}


	
	public function getActorTermRelationshipsJoinTermRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorTermRelationships === null) {
			if ($this->isNew()) {
				$this->collActorTermRelationships = array();
			} else {

				$criteria->add(ActorTermRelationshipPeer::ACTOR_ID, $this->getId());

				$this->collActorTermRelationships = ActorTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorTermRelationshipPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastActorTermRelationshipCriteria) || !$this->lastActorTermRelationshipCriteria->equals($criteria)) {
				$this->collActorTermRelationships = ActorTermRelationshipPeer::doSelectJoinTermRelatedByTermId($criteria, $con);
			}
		}
		$this->lastActorTermRelationshipCriteria = $criteria;

		return $this->collActorTermRelationships;
	}


	
	public function getActorTermRelationshipsJoinTermRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorTermRelationships === null) {
			if ($this->isNew()) {
				$this->collActorTermRelationships = array();
			} else {

				$criteria->add(ActorTermRelationshipPeer::ACTOR_ID, $this->getId());

				$this->collActorTermRelationships = ActorTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorTermRelationshipPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastActorTermRelationshipCriteria) || !$this->lastActorTermRelationshipCriteria->equals($criteria)) {
				$this->collActorTermRelationships = ActorTermRelationshipPeer::doSelectJoinTermRelatedByRelationshipTypeId($criteria, $con);
			}
		}
		$this->lastActorTermRelationshipCriteria = $criteria;

		return $this->collActorTermRelationships;
	}

	
	public function initContactInformations()
	{
		if ($this->collContactInformations === null) {
			$this->collContactInformations = array();
		}
	}

	
	public function getContactInformations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseContactInformationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactInformations === null) {
			if ($this->isNew()) {
			   $this->collContactInformations = array();
			} else {

				$criteria->add(ContactInformationPeer::ACTOR_ID, $this->getId());

				ContactInformationPeer::addSelectColumns($criteria);
				$this->collContactInformations = ContactInformationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactInformationPeer::ACTOR_ID, $this->getId());

				ContactInformationPeer::addSelectColumns($criteria);
				if (!isset($this->lastContactInformationCriteria) || !$this->lastContactInformationCriteria->equals($criteria)) {
					$this->collContactInformations = ContactInformationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactInformationCriteria = $criteria;
		return $this->collContactInformations;
	}

	
	public function countContactInformations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseContactInformationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ContactInformationPeer::ACTOR_ID, $this->getId());

		return ContactInformationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addContactInformation(ContactInformation $l)
	{
		$this->collContactInformations[] = $l;
		$l->setActor($this);
	}


	
	public function getContactInformationsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseContactInformationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactInformations === null) {
			if ($this->isNew()) {
				$this->collContactInformations = array();
			} else {

				$criteria->add(ContactInformationPeer::ACTOR_ID, $this->getId());

				$this->collContactInformations = ContactInformationPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(ContactInformationPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastContactInformationCriteria) || !$this->lastContactInformationCriteria->equals($criteria)) {
				$this->collContactInformations = ContactInformationPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastContactInformationCriteria = $criteria;

		return $this->collContactInformations;
	}

	
	public function initRepositorys()
	{
		if ($this->collRepositorys === null) {
			$this->collRepositorys = array();
		}
	}

	
	public function getRepositorys($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorys === null) {
			if ($this->isNew()) {
			   $this->collRepositorys = array();
			} else {

				$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				$this->collRepositorys = RepositoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepositoryCriteria) || !$this->lastRepositoryCriteria->equals($criteria)) {
					$this->collRepositorys = RepositoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepositoryCriteria = $criteria;
		return $this->collRepositorys;
	}

	
	public function countRepositorys($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

		return RepositoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRepository(Repository $l)
	{
		$this->collRepositorys[] = $l;
		$l->setActor($this);
	}


	
	public function getRepositorysJoinTermRelatedByRepositoryTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorys === null) {
			if ($this->isNew()) {
				$this->collRepositorys = array();
			} else {

				$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

				$this->collRepositorys = RepositoryPeer::doSelectJoinTermRelatedByRepositoryTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastRepositoryCriteria) || !$this->lastRepositoryCriteria->equals($criteria)) {
				$this->collRepositorys = RepositoryPeer::doSelectJoinTermRelatedByRepositoryTypeId($criteria, $con);
			}
		}
		$this->lastRepositoryCriteria = $criteria;

		return $this->collRepositorys;
	}


	
	public function getRepositorysJoinTermRelatedByStatusId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorys === null) {
			if ($this->isNew()) {
				$this->collRepositorys = array();
			} else {

				$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

				$this->collRepositorys = RepositoryPeer::doSelectJoinTermRelatedByStatusId($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastRepositoryCriteria) || !$this->lastRepositoryCriteria->equals($criteria)) {
				$this->collRepositorys = RepositoryPeer::doSelectJoinTermRelatedByStatusId($criteria, $con);
			}
		}
		$this->lastRepositoryCriteria = $criteria;

		return $this->collRepositorys;
	}


	
	public function getRepositorysJoinTermRelatedByLevelOfDetailId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorys === null) {
			if ($this->isNew()) {
				$this->collRepositorys = array();
			} else {

				$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

				$this->collRepositorys = RepositoryPeer::doSelectJoinTermRelatedByLevelOfDetailId($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastRepositoryCriteria) || !$this->lastRepositoryCriteria->equals($criteria)) {
				$this->collRepositorys = RepositoryPeer::doSelectJoinTermRelatedByLevelOfDetailId($criteria, $con);
			}
		}
		$this->lastRepositoryCriteria = $criteria;

		return $this->collRepositorys;
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

				$criteria->add(EventPeer::ACTOR_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEvents = EventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPeer::ACTOR_ID, $this->getId());

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

		$criteria->add(EventPeer::ACTOR_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEvent(Event $l)
	{
		$this->collEvents[] = $l;
		$l->setActor($this);
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

				$criteria->add(EventPeer::ACTOR_ID, $this->getId());

				$this->collEvents = EventPeer::doSelectJoinTermRelatedByEventTypeId($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::ACTOR_ID, $this->getId());

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

				$criteria->add(EventPeer::ACTOR_ID, $this->getId());

				$this->collEvents = EventPeer::doSelectJoinTermRelatedByActorRoleId($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
				$this->collEvents = EventPeer::doSelectJoinTermRelatedByActorRoleId($criteria, $con);
			}
		}
		$this->lastEventCriteria = $criteria;

		return $this->collEvents;
	}


	
	public function getEventsJoinInformationObject($criteria = null, $con = null)
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

				$criteria->add(EventPeer::ACTOR_ID, $this->getId());

				$this->collEvents = EventPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
				$this->collEvents = EventPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastEventCriteria = $criteria;

		return $this->collEvents;
	}

	
	public function initRightActorRelationships()
	{
		if ($this->collRightActorRelationships === null) {
			$this->collRightActorRelationships = array();
		}
	}

	
	public function getRightActorRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRightActorRelationships === null) {
			if ($this->isNew()) {
			   $this->collRightActorRelationships = array();
			} else {

				$criteria->add(RightActorRelationshipPeer::ACTOR_ID, $this->getId());

				RightActorRelationshipPeer::addSelectColumns($criteria);
				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RightActorRelationshipPeer::ACTOR_ID, $this->getId());

				RightActorRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastRightActorRelationshipCriteria) || !$this->lastRightActorRelationshipCriteria->equals($criteria)) {
					$this->collRightActorRelationships = RightActorRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRightActorRelationshipCriteria = $criteria;
		return $this->collRightActorRelationships;
	}

	
	public function countRightActorRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RightActorRelationshipPeer::ACTOR_ID, $this->getId());

		return RightActorRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRightActorRelationship(RightActorRelationship $l)
	{
		$this->collRightActorRelationships[] = $l;
		$l->setActor($this);
	}


	
	public function getRightActorRelationshipsJoinRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRightActorRelationships === null) {
			if ($this->isNew()) {
				$this->collRightActorRelationships = array();
			} else {

				$criteria->add(RightActorRelationshipPeer::ACTOR_ID, $this->getId());

				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(RightActorRelationshipPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastRightActorRelationshipCriteria) || !$this->lastRightActorRelationshipCriteria->equals($criteria)) {
				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastRightActorRelationshipCriteria = $criteria;

		return $this->collRightActorRelationships;
	}


	
	public function getRightActorRelationshipsJoinTerm($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRightActorRelationships === null) {
			if ($this->isNew()) {
				$this->collRightActorRelationships = array();
			} else {

				$criteria->add(RightActorRelationshipPeer::ACTOR_ID, $this->getId());

				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(RightActorRelationshipPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastRightActorRelationshipCriteria) || !$this->lastRightActorRelationshipCriteria->equals($criteria)) {
				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinTerm($criteria, $con);
			}
		}
		$this->lastRightActorRelationshipCriteria = $criteria;

		return $this->collRightActorRelationships;
	}

	
	public function initUsers()
	{
		if ($this->collUsers === null) {
			$this->collUsers = array();
		}
	}

	
	public function getUsers($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsers === null) {
			if ($this->isNew()) {
			   $this->collUsers = array();
			} else {

				$criteria->add(UserPeer::ACTOR_ID, $this->getId());

				UserPeer::addSelectColumns($criteria);
				$this->collUsers = UserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserPeer::ACTOR_ID, $this->getId());

				UserPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserCriteria) || !$this->lastUserCriteria->equals($criteria)) {
					$this->collUsers = UserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserCriteria = $criteria;
		return $this->collUsers;
	}

	
	public function countUsers($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserPeer::ACTOR_ID, $this->getId());

		return UserPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUser(User $l)
	{
		$this->collUsers[] = $l;
		$l->setActor($this);
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseActor:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseActor::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 