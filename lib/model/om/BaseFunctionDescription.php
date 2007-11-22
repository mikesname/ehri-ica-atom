<?php


abstract class BaseFunctionDescription extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $term_id;


	
	protected $function_description_type_id;


	
	protected $classification;


	
	protected $domain;


	
	protected $dates;


	
	protected $history;


	
	protected $legislation;


	
	protected $general_context;


	
	protected $description_identifier;


	
	protected $institution_identifier;


	
	protected $rules;


	
	protected $status_id;


	
	protected $level_id;


	
	protected $sources;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTermRelatedByTermId;

	
	protected $aTermRelatedByFunctionDescriptionTypeId;

	
	protected $aTermRelatedByStatusId;

	
	protected $aTermRelatedByLevelId;

	
	protected $collNotes;

	
	protected $lastNoteCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTermId()
	{

		return $this->term_id;
	}

	
	public function getFunctionDescriptionTypeId()
	{

		return $this->function_description_type_id;
	}

	
	public function getClassification()
	{

		return $this->classification;
	}

	
	public function getDomain()
	{

		return $this->domain;
	}

	
	public function getDates()
	{

		return $this->dates;
	}

	
	public function getHistory()
	{

		return $this->history;
	}

	
	public function getLegislation()
	{

		return $this->legislation;
	}

	
	public function getGeneralContext()
	{

		return $this->general_context;
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

	
	public function getLevelId()
	{

		return $this->level_id;
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
			$this->modifiedColumns[] = FunctionDescriptionPeer::ID;
		}

	} 
	
	public function setTermId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->term_id !== $v) {
			$this->term_id = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::TERM_ID;
		}

		if ($this->aTermRelatedByTermId !== null && $this->aTermRelatedByTermId->getId() !== $v) {
			$this->aTermRelatedByTermId = null;
		}

	} 
	
	public function setFunctionDescriptionTypeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->function_description_type_id !== $v) {
			$this->function_description_type_id = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID;
		}

		if ($this->aTermRelatedByFunctionDescriptionTypeId !== null && $this->aTermRelatedByFunctionDescriptionTypeId->getId() !== $v) {
			$this->aTermRelatedByFunctionDescriptionTypeId = null;
		}

	} 
	
	public function setClassification($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->classification !== $v) {
			$this->classification = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::CLASSIFICATION;
		}

	} 
	
	public function setDomain($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->domain !== $v) {
			$this->domain = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::DOMAIN;
		}

	} 
	
	public function setDates($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dates !== $v) {
			$this->dates = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::DATES;
		}

	} 
	
	public function setHistory($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->history !== $v) {
			$this->history = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::HISTORY;
		}

	} 
	
	public function setLegislation($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->legislation !== $v) {
			$this->legislation = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::LEGISLATION;
		}

	} 
	
	public function setGeneralContext($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->general_context !== $v) {
			$this->general_context = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::GENERAL_CONTEXT;
		}

	} 
	
	public function setDescriptionIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description_identifier !== $v) {
			$this->description_identifier = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::DESCRIPTION_IDENTIFIER;
		}

	} 
	
	public function setInstitutionIdentifier($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->institution_identifier !== $v) {
			$this->institution_identifier = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::INSTITUTION_IDENTIFIER;
		}

	} 
	
	public function setRules($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rules !== $v) {
			$this->rules = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::RULES;
		}

	} 
	
	public function setStatusId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::STATUS_ID;
		}

		if ($this->aTermRelatedByStatusId !== null && $this->aTermRelatedByStatusId->getId() !== $v) {
			$this->aTermRelatedByStatusId = null;
		}

	} 
	
	public function setLevelId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->level_id !== $v) {
			$this->level_id = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::LEVEL_ID;
		}

		if ($this->aTermRelatedByLevelId !== null && $this->aTermRelatedByLevelId->getId() !== $v) {
			$this->aTermRelatedByLevelId = null;
		}

	} 
	
	public function setSources($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sources !== $v) {
			$this->sources = $v;
			$this->modifiedColumns[] = FunctionDescriptionPeer::SOURCES;
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
			$this->modifiedColumns[] = FunctionDescriptionPeer::CREATED_AT;
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
			$this->modifiedColumns[] = FunctionDescriptionPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->term_id = $rs->getInt($startcol + 1);

			$this->function_description_type_id = $rs->getInt($startcol + 2);

			$this->classification = $rs->getString($startcol + 3);

			$this->domain = $rs->getString($startcol + 4);

			$this->dates = $rs->getString($startcol + 5);

			$this->history = $rs->getString($startcol + 6);

			$this->legislation = $rs->getString($startcol + 7);

			$this->general_context = $rs->getString($startcol + 8);

			$this->description_identifier = $rs->getString($startcol + 9);

			$this->institution_identifier = $rs->getString($startcol + 10);

			$this->rules = $rs->getString($startcol + 11);

			$this->status_id = $rs->getInt($startcol + 12);

			$this->level_id = $rs->getInt($startcol + 13);

			$this->sources = $rs->getString($startcol + 14);

			$this->created_at = $rs->getTimestamp($startcol + 15, null);

			$this->updated_at = $rs->getTimestamp($startcol + 16, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FunctionDescription object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescription:delete:pre') as $callable)
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
			$con = Propel::getConnection(FunctionDescriptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FunctionDescriptionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFunctionDescription:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescription:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(FunctionDescriptionPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(FunctionDescriptionPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FunctionDescriptionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFunctionDescription:save:post') as $callable)
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


												
			if ($this->aTermRelatedByTermId !== null) {
				if ($this->aTermRelatedByTermId->isModified()) {
					$affectedRows += $this->aTermRelatedByTermId->save($con);
				}
				$this->setTermRelatedByTermId($this->aTermRelatedByTermId);
			}

			if ($this->aTermRelatedByFunctionDescriptionTypeId !== null) {
				if ($this->aTermRelatedByFunctionDescriptionTypeId->isModified()) {
					$affectedRows += $this->aTermRelatedByFunctionDescriptionTypeId->save($con);
				}
				$this->setTermRelatedByFunctionDescriptionTypeId($this->aTermRelatedByFunctionDescriptionTypeId);
			}

			if ($this->aTermRelatedByStatusId !== null) {
				if ($this->aTermRelatedByStatusId->isModified()) {
					$affectedRows += $this->aTermRelatedByStatusId->save($con);
				}
				$this->setTermRelatedByStatusId($this->aTermRelatedByStatusId);
			}

			if ($this->aTermRelatedByLevelId !== null) {
				if ($this->aTermRelatedByLevelId->isModified()) {
					$affectedRows += $this->aTermRelatedByLevelId->save($con);
				}
				$this->setTermRelatedByLevelId($this->aTermRelatedByLevelId);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FunctionDescriptionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FunctionDescriptionPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collNotes !== null) {
				foreach($this->collNotes as $referrerFK) {
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


												
			if ($this->aTermRelatedByTermId !== null) {
				if (!$this->aTermRelatedByTermId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByTermId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByFunctionDescriptionTypeId !== null) {
				if (!$this->aTermRelatedByFunctionDescriptionTypeId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByFunctionDescriptionTypeId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByStatusId !== null) {
				if (!$this->aTermRelatedByStatusId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByStatusId->getValidationFailures());
				}
			}

			if ($this->aTermRelatedByLevelId !== null) {
				if (!$this->aTermRelatedByLevelId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTermRelatedByLevelId->getValidationFailures());
				}
			}


			if (($retval = FunctionDescriptionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNotes !== null) {
					foreach($this->collNotes as $referrerFK) {
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
		$pos = FunctionDescriptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTermId();
				break;
			case 2:
				return $this->getFunctionDescriptionTypeId();
				break;
			case 3:
				return $this->getClassification();
				break;
			case 4:
				return $this->getDomain();
				break;
			case 5:
				return $this->getDates();
				break;
			case 6:
				return $this->getHistory();
				break;
			case 7:
				return $this->getLegislation();
				break;
			case 8:
				return $this->getGeneralContext();
				break;
			case 9:
				return $this->getDescriptionIdentifier();
				break;
			case 10:
				return $this->getInstitutionIdentifier();
				break;
			case 11:
				return $this->getRules();
				break;
			case 12:
				return $this->getStatusId();
				break;
			case 13:
				return $this->getLevelId();
				break;
			case 14:
				return $this->getSources();
				break;
			case 15:
				return $this->getCreatedAt();
				break;
			case 16:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FunctionDescriptionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTermId(),
			$keys[2] => $this->getFunctionDescriptionTypeId(),
			$keys[3] => $this->getClassification(),
			$keys[4] => $this->getDomain(),
			$keys[5] => $this->getDates(),
			$keys[6] => $this->getHistory(),
			$keys[7] => $this->getLegislation(),
			$keys[8] => $this->getGeneralContext(),
			$keys[9] => $this->getDescriptionIdentifier(),
			$keys[10] => $this->getInstitutionIdentifier(),
			$keys[11] => $this->getRules(),
			$keys[12] => $this->getStatusId(),
			$keys[13] => $this->getLevelId(),
			$keys[14] => $this->getSources(),
			$keys[15] => $this->getCreatedAt(),
			$keys[16] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FunctionDescriptionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTermId($value);
				break;
			case 2:
				$this->setFunctionDescriptionTypeId($value);
				break;
			case 3:
				$this->setClassification($value);
				break;
			case 4:
				$this->setDomain($value);
				break;
			case 5:
				$this->setDates($value);
				break;
			case 6:
				$this->setHistory($value);
				break;
			case 7:
				$this->setLegislation($value);
				break;
			case 8:
				$this->setGeneralContext($value);
				break;
			case 9:
				$this->setDescriptionIdentifier($value);
				break;
			case 10:
				$this->setInstitutionIdentifier($value);
				break;
			case 11:
				$this->setRules($value);
				break;
			case 12:
				$this->setStatusId($value);
				break;
			case 13:
				$this->setLevelId($value);
				break;
			case 14:
				$this->setSources($value);
				break;
			case 15:
				$this->setCreatedAt($value);
				break;
			case 16:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FunctionDescriptionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTermId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFunctionDescriptionTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClassification($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDomain($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDates($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setHistory($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setLegislation($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setGeneralContext($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDescriptionIdentifier($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setInstitutionIdentifier($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setRules($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStatusId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLevelId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setSources($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCreatedAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FunctionDescriptionPeer::DATABASE_NAME);

		if ($this->isColumnModified(FunctionDescriptionPeer::ID)) $criteria->add(FunctionDescriptionPeer::ID, $this->id);
		if ($this->isColumnModified(FunctionDescriptionPeer::TERM_ID)) $criteria->add(FunctionDescriptionPeer::TERM_ID, $this->term_id);
		if ($this->isColumnModified(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID)) $criteria->add(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, $this->function_description_type_id);
		if ($this->isColumnModified(FunctionDescriptionPeer::CLASSIFICATION)) $criteria->add(FunctionDescriptionPeer::CLASSIFICATION, $this->classification);
		if ($this->isColumnModified(FunctionDescriptionPeer::DOMAIN)) $criteria->add(FunctionDescriptionPeer::DOMAIN, $this->domain);
		if ($this->isColumnModified(FunctionDescriptionPeer::DATES)) $criteria->add(FunctionDescriptionPeer::DATES, $this->dates);
		if ($this->isColumnModified(FunctionDescriptionPeer::HISTORY)) $criteria->add(FunctionDescriptionPeer::HISTORY, $this->history);
		if ($this->isColumnModified(FunctionDescriptionPeer::LEGISLATION)) $criteria->add(FunctionDescriptionPeer::LEGISLATION, $this->legislation);
		if ($this->isColumnModified(FunctionDescriptionPeer::GENERAL_CONTEXT)) $criteria->add(FunctionDescriptionPeer::GENERAL_CONTEXT, $this->general_context);
		if ($this->isColumnModified(FunctionDescriptionPeer::DESCRIPTION_IDENTIFIER)) $criteria->add(FunctionDescriptionPeer::DESCRIPTION_IDENTIFIER, $this->description_identifier);
		if ($this->isColumnModified(FunctionDescriptionPeer::INSTITUTION_IDENTIFIER)) $criteria->add(FunctionDescriptionPeer::INSTITUTION_IDENTIFIER, $this->institution_identifier);
		if ($this->isColumnModified(FunctionDescriptionPeer::RULES)) $criteria->add(FunctionDescriptionPeer::RULES, $this->rules);
		if ($this->isColumnModified(FunctionDescriptionPeer::STATUS_ID)) $criteria->add(FunctionDescriptionPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(FunctionDescriptionPeer::LEVEL_ID)) $criteria->add(FunctionDescriptionPeer::LEVEL_ID, $this->level_id);
		if ($this->isColumnModified(FunctionDescriptionPeer::SOURCES)) $criteria->add(FunctionDescriptionPeer::SOURCES, $this->sources);
		if ($this->isColumnModified(FunctionDescriptionPeer::CREATED_AT)) $criteria->add(FunctionDescriptionPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(FunctionDescriptionPeer::UPDATED_AT)) $criteria->add(FunctionDescriptionPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FunctionDescriptionPeer::DATABASE_NAME);

		$criteria->add(FunctionDescriptionPeer::ID, $this->id);

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

		$copyObj->setTermId($this->term_id);

		$copyObj->setFunctionDescriptionTypeId($this->function_description_type_id);

		$copyObj->setClassification($this->classification);

		$copyObj->setDomain($this->domain);

		$copyObj->setDates($this->dates);

		$copyObj->setHistory($this->history);

		$copyObj->setLegislation($this->legislation);

		$copyObj->setGeneralContext($this->general_context);

		$copyObj->setDescriptionIdentifier($this->description_identifier);

		$copyObj->setInstitutionIdentifier($this->institution_identifier);

		$copyObj->setRules($this->rules);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setLevelId($this->level_id);

		$copyObj->setSources($this->sources);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getNotes() as $relObj) {
				$copyObj->addNote($relObj->copy($deepCopy));
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
			self::$peer = new FunctionDescriptionPeer();
		}
		return self::$peer;
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

	
	public function setTermRelatedByFunctionDescriptionTypeId($v)
	{


		if ($v === null) {
			$this->setFunctionDescriptionTypeId(NULL);
		} else {
			$this->setFunctionDescriptionTypeId($v->getId());
		}


		$this->aTermRelatedByFunctionDescriptionTypeId = $v;
	}


	
	public function getTermRelatedByFunctionDescriptionTypeId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByFunctionDescriptionTypeId === null && ($this->function_description_type_id !== null)) {

			$this->aTermRelatedByFunctionDescriptionTypeId = TermPeer::retrieveByPK($this->function_description_type_id, $con);

			
		}
		return $this->aTermRelatedByFunctionDescriptionTypeId;
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

	
	public function setTermRelatedByLevelId($v)
	{


		if ($v === null) {
			$this->setLevelId(NULL);
		} else {
			$this->setLevelId($v->getId());
		}


		$this->aTermRelatedByLevelId = $v;
	}


	
	public function getTermRelatedByLevelId($con = null)
	{
				include_once 'lib/model/om/BaseTermPeer.php';

		if ($this->aTermRelatedByLevelId === null && ($this->level_id !== null)) {

			$this->aTermRelatedByLevelId = TermPeer::retrieveByPK($this->level_id, $con);

			
		}
		return $this->aTermRelatedByLevelId;
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

				$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

				NotePeer::addSelectColumns($criteria);
				$this->collNotes = NotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

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

		$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

		return NotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNote(Note $l)
	{
		$this->collNotes[] = $l;
		$l->setFunctionDescription($this);
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

				$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

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

				$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

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

				$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinRepository($criteria, $con);
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

				$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinTerm($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

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

				$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::FUNCTION_DESCRIPTION_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFunctionDescription:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFunctionDescription::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 