<?php


abstract class BaseTerm extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $taxonomy_id;


	
	protected $term_name;


	
	protected $scope_note;


	
	protected $code_alpha;


	
	protected $code_alpha2;


	
	protected $code_numeric;


	
	protected $sort_order;


	
	protected $source;


	
	protected $locked;


	
	protected $tree_id;


	
	protected $tree_left_id;


	
	protected $tree_right_id;


	
	protected $tree_parent_id;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aTaxonomy;

	
	protected $collInformationObjectsRelatedByLevelOfDescriptionId;

	
	protected $lastInformationObjectRelatedByLevelOfDescriptionIdCriteria = null;

	
	protected $collInformationObjectsRelatedByCollectionTypeId;

	
	protected $lastInformationObjectRelatedByCollectionTypeIdCriteria = null;

	
	protected $collInformationObjectTermRelationshipsRelatedByTermId;

	
	protected $lastInformationObjectTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collInformationObjectTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastInformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collInformationObjectRecursiveRelationships;

	
	protected $lastInformationObjectRecursiveRelationshipCriteria = null;

	
	protected $collNotes;

	
	protected $lastNoteCriteria = null;

	
	protected $collDigitalObjectsRelatedByUseageId;

	
	protected $lastDigitalObjectRelatedByUseageIdCriteria = null;

	
	protected $collDigitalObjectsRelatedByMimeTypeId;

	
	protected $lastDigitalObjectRelatedByMimeTypeIdCriteria = null;

	
	protected $collDigitalObjectsRelatedByMediaTypeId;

	
	protected $lastDigitalObjectRelatedByMediaTypeIdCriteria = null;

	
	protected $collDigitalObjectsRelatedByChecksumTypeId;

	
	protected $lastDigitalObjectRelatedByChecksumTypeIdCriteria = null;

	
	protected $collDigitalObjectsRelatedByLocationId;

	
	protected $lastDigitalObjectRelatedByLocationIdCriteria = null;

	
	protected $collDigitalObjectRecursiveRelationships;

	
	protected $lastDigitalObjectRecursiveRelationshipCriteria = null;

	
	protected $collPhysicalObjects;

	
	protected $lastPhysicalObjectCriteria = null;

	
	protected $collActorsRelatedByTypeOfEntityId;

	
	protected $lastActorRelatedByTypeOfEntityIdCriteria = null;

	
	protected $collActorsRelatedByStatusId;

	
	protected $lastActorRelatedByStatusIdCriteria = null;

	
	protected $collActorsRelatedByLevelOfDetailId;

	
	protected $lastActorRelatedByLevelOfDetailIdCriteria = null;

	
	protected $collActorNames;

	
	protected $lastActorNameCriteria = null;

	
	protected $collActorRecursiveRelationships;

	
	protected $lastActorRecursiveRelationshipCriteria = null;

	
	protected $collActorTermRelationshipsRelatedByTermId;

	
	protected $lastActorTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collActorTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastActorTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collContactInformations;

	
	protected $lastContactInformationCriteria = null;

	
	protected $collPlacesRelatedByTermId;

	
	protected $lastPlaceRelatedByTermIdCriteria = null;

	
	protected $collPlacesRelatedByCountryId;

	
	protected $lastPlaceRelatedByCountryIdCriteria = null;

	
	protected $collPlacesRelatedByPlaceTypeId;

	
	protected $lastPlaceRelatedByPlaceTypeIdCriteria = null;

	
	protected $collPlaceMapRelationships;

	
	protected $lastPlaceMapRelationshipCriteria = null;

	
	protected $collRepositorysRelatedByRepositoryTypeId;

	
	protected $lastRepositoryRelatedByRepositoryTypeIdCriteria = null;

	
	protected $collRepositorysRelatedByStatusId;

	
	protected $lastRepositoryRelatedByStatusIdCriteria = null;

	
	protected $collRepositorysRelatedByLevelOfDetailId;

	
	protected $lastRepositoryRelatedByLevelOfDetailIdCriteria = null;

	
	protected $collRepositoryTermRelationshipsRelatedByTermId;

	
	protected $lastRepositoryTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collRepositoryTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastRepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collTermRecursiveRelationshipsRelatedByTermId;

	
	protected $lastTermRecursiveRelationshipRelatedByTermIdCriteria = null;

	
	protected $collTermRecursiveRelationshipsRelatedByRelatedTermId;

	
	protected $lastTermRecursiveRelationshipRelatedByRelatedTermIdCriteria = null;

	
	protected $collTermRecursiveRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastTermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collEventsRelatedByEventTypeId;

	
	protected $lastEventRelatedByEventTypeIdCriteria = null;

	
	protected $collEventsRelatedByActorRoleId;

	
	protected $lastEventRelatedByActorRoleIdCriteria = null;

	
	protected $collEventTermRelationshipsRelatedByTermId;

	
	protected $lastEventTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collEventTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastEventTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collSystemEvents;

	
	protected $lastSystemEventCriteria = null;

	
	protected $collHistoricalEventsRelatedByTermId;

	
	protected $lastHistoricalEventRelatedByTermIdCriteria = null;

	
	protected $collHistoricalEventsRelatedByHistoricalEventTypeId;

	
	protected $lastHistoricalEventRelatedByHistoricalEventTypeIdCriteria = null;

	
	protected $collFunctionDescriptionsRelatedByTermId;

	
	protected $lastFunctionDescriptionRelatedByTermIdCriteria = null;

	
	protected $collFunctionDescriptionsRelatedByFunctionDescriptionTypeId;

	
	protected $lastFunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria = null;

	
	protected $collFunctionDescriptionsRelatedByStatusId;

	
	protected $lastFunctionDescriptionRelatedByStatusIdCriteria = null;

	
	protected $collFunctionDescriptionsRelatedByLevelId;

	
	protected $lastFunctionDescriptionRelatedByLevelIdCriteria = null;

	
	protected $collRights;

	
	protected $lastRightCriteria = null;

	
	protected $collRightTermRelationshipsRelatedByTermId;

	
	protected $lastRightTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collRightTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastRightTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collRightActorRelationships;

	
	protected $lastRightActorRelationshipCriteria = null;

	
	protected $collUserTermRelationshipsRelatedByTermId;

	
	protected $lastUserTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collUserTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTaxonomyId()
	{

		return $this->taxonomy_id;
	}

	
	public function getTermName()
	{

		return $this->term_name;
	}

	
	public function getScopeNote()
	{

		return $this->scope_note;
	}

	
	public function getCodeAlpha()
	{

		return $this->code_alpha;
	}

	
	public function getCodeAlpha2()
	{

		return $this->code_alpha2;
	}

	
	public function getCodeNumeric()
	{

		return $this->code_numeric;
	}

	
	public function getSortOrder()
	{

		return $this->sort_order;
	}

	
	public function getSource()
	{

		return $this->source;
	}

	
	public function getLocked()
	{

		return $this->locked;
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
			$this->modifiedColumns[] = TermPeer::ID;
		}

	} 
	
	public function setTaxonomyId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->taxonomy_id !== $v) {
			$this->taxonomy_id = $v;
			$this->modifiedColumns[] = TermPeer::TAXONOMY_ID;
		}

		if ($this->aTaxonomy !== null && $this->aTaxonomy->getId() !== $v) {
			$this->aTaxonomy = null;
		}

	} 
	
	public function setTermName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->term_name !== $v) {
			$this->term_name = $v;
			$this->modifiedColumns[] = TermPeer::TERM_NAME;
		}

	} 
	
	public function setScopeNote($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->scope_note !== $v) {
			$this->scope_note = $v;
			$this->modifiedColumns[] = TermPeer::SCOPE_NOTE;
		}

	} 
	
	public function setCodeAlpha($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->code_alpha !== $v) {
			$this->code_alpha = $v;
			$this->modifiedColumns[] = TermPeer::CODE_ALPHA;
		}

	} 
	
	public function setCodeAlpha2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->code_alpha2 !== $v) {
			$this->code_alpha2 = $v;
			$this->modifiedColumns[] = TermPeer::CODE_ALPHA2;
		}

	} 
	
	public function setCodeNumeric($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->code_numeric !== $v) {
			$this->code_numeric = $v;
			$this->modifiedColumns[] = TermPeer::CODE_NUMERIC;
		}

	} 
	
	public function setSortOrder($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sort_order !== $v) {
			$this->sort_order = $v;
			$this->modifiedColumns[] = TermPeer::SORT_ORDER;
		}

	} 
	
	public function setSource($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source !== $v) {
			$this->source = $v;
			$this->modifiedColumns[] = TermPeer::SOURCE;
		}

	} 
	
	public function setLocked($v)
	{

		if ($this->locked !== $v) {
			$this->locked = $v;
			$this->modifiedColumns[] = TermPeer::LOCKED;
		}

	} 
	
	public function setTreeId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_id !== $v) {
			$this->tree_id = $v;
			$this->modifiedColumns[] = TermPeer::TREE_ID;
		}

	} 
	
	public function setTreeLeftId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_left_id !== $v) {
			$this->tree_left_id = $v;
			$this->modifiedColumns[] = TermPeer::TREE_LEFT_ID;
		}

	} 
	
	public function setTreeRightId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_right_id !== $v) {
			$this->tree_right_id = $v;
			$this->modifiedColumns[] = TermPeer::TREE_RIGHT_ID;
		}

	} 
	
	public function setTreeParentId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_parent_id !== $v) {
			$this->tree_parent_id = $v;
			$this->modifiedColumns[] = TermPeer::TREE_PARENT_ID;
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
			$this->modifiedColumns[] = TermPeer::CREATED_AT;
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
			$this->modifiedColumns[] = TermPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->taxonomy_id = $rs->getInt($startcol + 1);

			$this->term_name = $rs->getString($startcol + 2);

			$this->scope_note = $rs->getString($startcol + 3);

			$this->code_alpha = $rs->getString($startcol + 4);

			$this->code_alpha2 = $rs->getString($startcol + 5);

			$this->code_numeric = $rs->getInt($startcol + 6);

			$this->sort_order = $rs->getInt($startcol + 7);

			$this->source = $rs->getString($startcol + 8);

			$this->locked = $rs->getBoolean($startcol + 9);

			$this->tree_id = $rs->getInt($startcol + 10);

			$this->tree_left_id = $rs->getInt($startcol + 11);

			$this->tree_right_id = $rs->getInt($startcol + 12);

			$this->tree_parent_id = $rs->getInt($startcol + 13);

			$this->created_at = $rs->getTimestamp($startcol + 14, null);

			$this->updated_at = $rs->getTimestamp($startcol + 15, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Term object", $e);
		}
	}

	
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseTerm:delete:pre') as $callable)
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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TermPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTerm:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseTerm:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(TermPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(TermPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TermPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTerm:save:post') as $callable)
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


												
			if ($this->aTaxonomy !== null) {
				if ($this->aTaxonomy->isModified()) {
					$affectedRows += $this->aTaxonomy->save($con);
				}
				$this->setTaxonomy($this->aTaxonomy);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TermPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TermPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collInformationObjectsRelatedByLevelOfDescriptionId !== null) {
				foreach($this->collInformationObjectsRelatedByLevelOfDescriptionId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInformationObjectsRelatedByCollectionTypeId !== null) {
				foreach($this->collInformationObjectsRelatedByCollectionTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInformationObjectTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collInformationObjectTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInformationObjectRecursiveRelationships !== null) {
				foreach($this->collInformationObjectRecursiveRelationships as $referrerFK) {
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

			if ($this->collDigitalObjectsRelatedByUseageId !== null) {
				foreach($this->collDigitalObjectsRelatedByUseageId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjectsRelatedByMimeTypeId !== null) {
				foreach($this->collDigitalObjectsRelatedByMimeTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjectsRelatedByMediaTypeId !== null) {
				foreach($this->collDigitalObjectsRelatedByMediaTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjectsRelatedByChecksumTypeId !== null) {
				foreach($this->collDigitalObjectsRelatedByChecksumTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjectsRelatedByLocationId !== null) {
				foreach($this->collDigitalObjectsRelatedByLocationId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDigitalObjectRecursiveRelationships !== null) {
				foreach($this->collDigitalObjectRecursiveRelationships as $referrerFK) {
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

			if ($this->collActorsRelatedByTypeOfEntityId !== null) {
				foreach($this->collActorsRelatedByTypeOfEntityId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorsRelatedByStatusId !== null) {
				foreach($this->collActorsRelatedByStatusId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorsRelatedByLevelOfDetailId !== null) {
				foreach($this->collActorsRelatedByLevelOfDetailId as $referrerFK) {
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

			if ($this->collActorRecursiveRelationships !== null) {
				foreach($this->collActorRecursiveRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collActorTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collActorTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collActorTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

			if ($this->collPlacesRelatedByTermId !== null) {
				foreach($this->collPlacesRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPlacesRelatedByCountryId !== null) {
				foreach($this->collPlacesRelatedByCountryId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPlacesRelatedByPlaceTypeId !== null) {
				foreach($this->collPlacesRelatedByPlaceTypeId as $referrerFK) {
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

			if ($this->collRepositorysRelatedByRepositoryTypeId !== null) {
				foreach($this->collRepositorysRelatedByRepositoryTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepositorysRelatedByStatusId !== null) {
				foreach($this->collRepositorysRelatedByStatusId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepositorysRelatedByLevelOfDetailId !== null) {
				foreach($this->collRepositorysRelatedByLevelOfDetailId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepositoryTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collRepositoryTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTermRecursiveRelationshipsRelatedByTermId !== null) {
				foreach($this->collTermRecursiveRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTermRecursiveRelationshipsRelatedByRelatedTermId !== null) {
				foreach($this->collTermRecursiveRelationshipsRelatedByRelatedTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventsRelatedByEventTypeId !== null) {
				foreach($this->collEventsRelatedByEventTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventsRelatedByActorRoleId !== null) {
				foreach($this->collEventsRelatedByActorRoleId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collEventTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEventTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collEventTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

			if ($this->collHistoricalEventsRelatedByTermId !== null) {
				foreach($this->collHistoricalEventsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHistoricalEventsRelatedByHistoricalEventTypeId !== null) {
				foreach($this->collHistoricalEventsRelatedByHistoricalEventTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFunctionDescriptionsRelatedByTermId !== null) {
				foreach($this->collFunctionDescriptionsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId !== null) {
				foreach($this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFunctionDescriptionsRelatedByStatusId !== null) {
				foreach($this->collFunctionDescriptionsRelatedByStatusId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFunctionDescriptionsRelatedByLevelId !== null) {
				foreach($this->collFunctionDescriptionsRelatedByLevelId as $referrerFK) {
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

			if ($this->collRightTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collRightTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRightTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collRightTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

			if ($this->collUserTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collUserTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUserTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collUserTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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


												
			if ($this->aTaxonomy !== null) {
				if (!$this->aTaxonomy->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTaxonomy->getValidationFailures());
				}
			}


			if (($retval = TermPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInformationObjectsRelatedByLevelOfDescriptionId !== null) {
					foreach($this->collInformationObjectsRelatedByLevelOfDescriptionId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInformationObjectsRelatedByCollectionTypeId !== null) {
					foreach($this->collInformationObjectsRelatedByCollectionTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInformationObjectTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collInformationObjectTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInformationObjectRecursiveRelationships !== null) {
					foreach($this->collInformationObjectRecursiveRelationships as $referrerFK) {
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

				if ($this->collDigitalObjectsRelatedByUseageId !== null) {
					foreach($this->collDigitalObjectsRelatedByUseageId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjectsRelatedByMimeTypeId !== null) {
					foreach($this->collDigitalObjectsRelatedByMimeTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjectsRelatedByMediaTypeId !== null) {
					foreach($this->collDigitalObjectsRelatedByMediaTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjectsRelatedByChecksumTypeId !== null) {
					foreach($this->collDigitalObjectsRelatedByChecksumTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjectsRelatedByLocationId !== null) {
					foreach($this->collDigitalObjectsRelatedByLocationId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDigitalObjectRecursiveRelationships !== null) {
					foreach($this->collDigitalObjectRecursiveRelationships as $referrerFK) {
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

				if ($this->collActorsRelatedByTypeOfEntityId !== null) {
					foreach($this->collActorsRelatedByTypeOfEntityId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorsRelatedByStatusId !== null) {
					foreach($this->collActorsRelatedByStatusId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorsRelatedByLevelOfDetailId !== null) {
					foreach($this->collActorsRelatedByLevelOfDetailId as $referrerFK) {
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

				if ($this->collActorRecursiveRelationships !== null) {
					foreach($this->collActorRecursiveRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collActorTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collActorTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collActorTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

				if ($this->collPlacesRelatedByTermId !== null) {
					foreach($this->collPlacesRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPlacesRelatedByCountryId !== null) {
					foreach($this->collPlacesRelatedByCountryId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPlacesRelatedByPlaceTypeId !== null) {
					foreach($this->collPlacesRelatedByPlaceTypeId as $referrerFK) {
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

				if ($this->collRepositorysRelatedByRepositoryTypeId !== null) {
					foreach($this->collRepositorysRelatedByRepositoryTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepositorysRelatedByStatusId !== null) {
					foreach($this->collRepositorysRelatedByStatusId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepositorysRelatedByLevelOfDetailId !== null) {
					foreach($this->collRepositorysRelatedByLevelOfDetailId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepositoryTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collRepositoryTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTermRecursiveRelationshipsRelatedByTermId !== null) {
					foreach($this->collTermRecursiveRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTermRecursiveRelationshipsRelatedByRelatedTermId !== null) {
					foreach($this->collTermRecursiveRelationshipsRelatedByRelatedTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventsRelatedByEventTypeId !== null) {
					foreach($this->collEventsRelatedByEventTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventsRelatedByActorRoleId !== null) {
					foreach($this->collEventsRelatedByActorRoleId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collEventTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEventTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collEventTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

				if ($this->collHistoricalEventsRelatedByTermId !== null) {
					foreach($this->collHistoricalEventsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHistoricalEventsRelatedByHistoricalEventTypeId !== null) {
					foreach($this->collHistoricalEventsRelatedByHistoricalEventTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFunctionDescriptionsRelatedByTermId !== null) {
					foreach($this->collFunctionDescriptionsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId !== null) {
					foreach($this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFunctionDescriptionsRelatedByStatusId !== null) {
					foreach($this->collFunctionDescriptionsRelatedByStatusId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFunctionDescriptionsRelatedByLevelId !== null) {
					foreach($this->collFunctionDescriptionsRelatedByLevelId as $referrerFK) {
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

				if ($this->collRightTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collRightTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRightTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collRightTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

				if ($this->collUserTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collUserTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUserTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collUserTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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
		$pos = TermPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTaxonomyId();
				break;
			case 2:
				return $this->getTermName();
				break;
			case 3:
				return $this->getScopeNote();
				break;
			case 4:
				return $this->getCodeAlpha();
				break;
			case 5:
				return $this->getCodeAlpha2();
				break;
			case 6:
				return $this->getCodeNumeric();
				break;
			case 7:
				return $this->getSortOrder();
				break;
			case 8:
				return $this->getSource();
				break;
			case 9:
				return $this->getLocked();
				break;
			case 10:
				return $this->getTreeId();
				break;
			case 11:
				return $this->getTreeLeftId();
				break;
			case 12:
				return $this->getTreeRightId();
				break;
			case 13:
				return $this->getTreeParentId();
				break;
			case 14:
				return $this->getCreatedAt();
				break;
			case 15:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TermPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTaxonomyId(),
			$keys[2] => $this->getTermName(),
			$keys[3] => $this->getScopeNote(),
			$keys[4] => $this->getCodeAlpha(),
			$keys[5] => $this->getCodeAlpha2(),
			$keys[6] => $this->getCodeNumeric(),
			$keys[7] => $this->getSortOrder(),
			$keys[8] => $this->getSource(),
			$keys[9] => $this->getLocked(),
			$keys[10] => $this->getTreeId(),
			$keys[11] => $this->getTreeLeftId(),
			$keys[12] => $this->getTreeRightId(),
			$keys[13] => $this->getTreeParentId(),
			$keys[14] => $this->getCreatedAt(),
			$keys[15] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TermPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTaxonomyId($value);
				break;
			case 2:
				$this->setTermName($value);
				break;
			case 3:
				$this->setScopeNote($value);
				break;
			case 4:
				$this->setCodeAlpha($value);
				break;
			case 5:
				$this->setCodeAlpha2($value);
				break;
			case 6:
				$this->setCodeNumeric($value);
				break;
			case 7:
				$this->setSortOrder($value);
				break;
			case 8:
				$this->setSource($value);
				break;
			case 9:
				$this->setLocked($value);
				break;
			case 10:
				$this->setTreeId($value);
				break;
			case 11:
				$this->setTreeLeftId($value);
				break;
			case 12:
				$this->setTreeRightId($value);
				break;
			case 13:
				$this->setTreeParentId($value);
				break;
			case 14:
				$this->setCreatedAt($value);
				break;
			case 15:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TermPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTaxonomyId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTermName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setScopeNote($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCodeAlpha($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCodeAlpha2($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCodeNumeric($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSortOrder($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setSource($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setLocked($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTreeId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTreeLeftId($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTreeRightId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTreeParentId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setUpdatedAt($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TermPeer::DATABASE_NAME);

		if ($this->isColumnModified(TermPeer::ID)) $criteria->add(TermPeer::ID, $this->id);
		if ($this->isColumnModified(TermPeer::TAXONOMY_ID)) $criteria->add(TermPeer::TAXONOMY_ID, $this->taxonomy_id);
		if ($this->isColumnModified(TermPeer::TERM_NAME)) $criteria->add(TermPeer::TERM_NAME, $this->term_name);
		if ($this->isColumnModified(TermPeer::SCOPE_NOTE)) $criteria->add(TermPeer::SCOPE_NOTE, $this->scope_note);
		if ($this->isColumnModified(TermPeer::CODE_ALPHA)) $criteria->add(TermPeer::CODE_ALPHA, $this->code_alpha);
		if ($this->isColumnModified(TermPeer::CODE_ALPHA2)) $criteria->add(TermPeer::CODE_ALPHA2, $this->code_alpha2);
		if ($this->isColumnModified(TermPeer::CODE_NUMERIC)) $criteria->add(TermPeer::CODE_NUMERIC, $this->code_numeric);
		if ($this->isColumnModified(TermPeer::SORT_ORDER)) $criteria->add(TermPeer::SORT_ORDER, $this->sort_order);
		if ($this->isColumnModified(TermPeer::SOURCE)) $criteria->add(TermPeer::SOURCE, $this->source);
		if ($this->isColumnModified(TermPeer::LOCKED)) $criteria->add(TermPeer::LOCKED, $this->locked);
		if ($this->isColumnModified(TermPeer::TREE_ID)) $criteria->add(TermPeer::TREE_ID, $this->tree_id);
		if ($this->isColumnModified(TermPeer::TREE_LEFT_ID)) $criteria->add(TermPeer::TREE_LEFT_ID, $this->tree_left_id);
		if ($this->isColumnModified(TermPeer::TREE_RIGHT_ID)) $criteria->add(TermPeer::TREE_RIGHT_ID, $this->tree_right_id);
		if ($this->isColumnModified(TermPeer::TREE_PARENT_ID)) $criteria->add(TermPeer::TREE_PARENT_ID, $this->tree_parent_id);
		if ($this->isColumnModified(TermPeer::CREATED_AT)) $criteria->add(TermPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TermPeer::UPDATED_AT)) $criteria->add(TermPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TermPeer::DATABASE_NAME);

		$criteria->add(TermPeer::ID, $this->id);

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

		$copyObj->setTaxonomyId($this->taxonomy_id);

		$copyObj->setTermName($this->term_name);

		$copyObj->setScopeNote($this->scope_note);

		$copyObj->setCodeAlpha($this->code_alpha);

		$copyObj->setCodeAlpha2($this->code_alpha2);

		$copyObj->setCodeNumeric($this->code_numeric);

		$copyObj->setSortOrder($this->sort_order);

		$copyObj->setSource($this->source);

		$copyObj->setLocked($this->locked);

		$copyObj->setTreeId($this->tree_id);

		$copyObj->setTreeLeftId($this->tree_left_id);

		$copyObj->setTreeRightId($this->tree_right_id);

		$copyObj->setTreeParentId($this->tree_parent_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getInformationObjectsRelatedByLevelOfDescriptionId() as $relObj) {
				$copyObj->addInformationObjectRelatedByLevelOfDescriptionId($relObj->copy($deepCopy));
			}

			foreach($this->getInformationObjectsRelatedByCollectionTypeId() as $relObj) {
				$copyObj->addInformationObjectRelatedByCollectionTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getInformationObjectTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addInformationObjectTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getInformationObjectTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addInformationObjectTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getInformationObjectRecursiveRelationships() as $relObj) {
				$copyObj->addInformationObjectRecursiveRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getNotes() as $relObj) {
				$copyObj->addNote($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectsRelatedByUseageId() as $relObj) {
				$copyObj->addDigitalObjectRelatedByUseageId($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectsRelatedByMimeTypeId() as $relObj) {
				$copyObj->addDigitalObjectRelatedByMimeTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectsRelatedByMediaTypeId() as $relObj) {
				$copyObj->addDigitalObjectRelatedByMediaTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectsRelatedByChecksumTypeId() as $relObj) {
				$copyObj->addDigitalObjectRelatedByChecksumTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectsRelatedByLocationId() as $relObj) {
				$copyObj->addDigitalObjectRelatedByLocationId($relObj->copy($deepCopy));
			}

			foreach($this->getDigitalObjectRecursiveRelationships() as $relObj) {
				$copyObj->addDigitalObjectRecursiveRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getPhysicalObjects() as $relObj) {
				$copyObj->addPhysicalObject($relObj->copy($deepCopy));
			}

			foreach($this->getActorsRelatedByTypeOfEntityId() as $relObj) {
				$copyObj->addActorRelatedByTypeOfEntityId($relObj->copy($deepCopy));
			}

			foreach($this->getActorsRelatedByStatusId() as $relObj) {
				$copyObj->addActorRelatedByStatusId($relObj->copy($deepCopy));
			}

			foreach($this->getActorsRelatedByLevelOfDetailId() as $relObj) {
				$copyObj->addActorRelatedByLevelOfDetailId($relObj->copy($deepCopy));
			}

			foreach($this->getActorNames() as $relObj) {
				$copyObj->addActorName($relObj->copy($deepCopy));
			}

			foreach($this->getActorRecursiveRelationships() as $relObj) {
				$copyObj->addActorRecursiveRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getActorTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addActorTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getActorTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addActorTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getContactInformations() as $relObj) {
				$copyObj->addContactInformation($relObj->copy($deepCopy));
			}

			foreach($this->getPlacesRelatedByTermId() as $relObj) {
				$copyObj->addPlaceRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getPlacesRelatedByCountryId() as $relObj) {
				$copyObj->addPlaceRelatedByCountryId($relObj->copy($deepCopy));
			}

			foreach($this->getPlacesRelatedByPlaceTypeId() as $relObj) {
				$copyObj->addPlaceRelatedByPlaceTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getPlaceMapRelationships() as $relObj) {
				$copyObj->addPlaceMapRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getRepositorysRelatedByRepositoryTypeId() as $relObj) {
				$copyObj->addRepositoryRelatedByRepositoryTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getRepositorysRelatedByStatusId() as $relObj) {
				$copyObj->addRepositoryRelatedByStatusId($relObj->copy($deepCopy));
			}

			foreach($this->getRepositorysRelatedByLevelOfDetailId() as $relObj) {
				$copyObj->addRepositoryRelatedByLevelOfDetailId($relObj->copy($deepCopy));
			}

			foreach($this->getRepositoryTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addRepositoryTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getRepositoryTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addRepositoryTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getTermRecursiveRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addTermRecursiveRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getTermRecursiveRelationshipsRelatedByRelatedTermId() as $relObj) {
				$copyObj->addTermRecursiveRelationshipRelatedByRelatedTermId($relObj->copy($deepCopy));
			}

			foreach($this->getTermRecursiveRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addTermRecursiveRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getEventsRelatedByEventTypeId() as $relObj) {
				$copyObj->addEventRelatedByEventTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getEventsRelatedByActorRoleId() as $relObj) {
				$copyObj->addEventRelatedByActorRoleId($relObj->copy($deepCopy));
			}

			foreach($this->getEventTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addEventTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getEventTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addEventTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getSystemEvents() as $relObj) {
				$copyObj->addSystemEvent($relObj->copy($deepCopy));
			}

			foreach($this->getHistoricalEventsRelatedByTermId() as $relObj) {
				$copyObj->addHistoricalEventRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getHistoricalEventsRelatedByHistoricalEventTypeId() as $relObj) {
				$copyObj->addHistoricalEventRelatedByHistoricalEventTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getFunctionDescriptionsRelatedByTermId() as $relObj) {
				$copyObj->addFunctionDescriptionRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getFunctionDescriptionsRelatedByFunctionDescriptionTypeId() as $relObj) {
				$copyObj->addFunctionDescriptionRelatedByFunctionDescriptionTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getFunctionDescriptionsRelatedByStatusId() as $relObj) {
				$copyObj->addFunctionDescriptionRelatedByStatusId($relObj->copy($deepCopy));
			}

			foreach($this->getFunctionDescriptionsRelatedByLevelId() as $relObj) {
				$copyObj->addFunctionDescriptionRelatedByLevelId($relObj->copy($deepCopy));
			}

			foreach($this->getRights() as $relObj) {
				$copyObj->addRight($relObj->copy($deepCopy));
			}

			foreach($this->getRightTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addRightTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getRightTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addRightTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getRightActorRelationships() as $relObj) {
				$copyObj->addRightActorRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getUserTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addUserTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getUserTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addUserTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
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
			self::$peer = new TermPeer();
		}
		return self::$peer;
	}

	
	public function setTaxonomy($v)
	{


		if ($v === null) {
			$this->setTaxonomyId(NULL);
		} else {
			$this->setTaxonomyId($v->getId());
		}


		$this->aTaxonomy = $v;
	}


	
	public function getTaxonomy($con = null)
	{
				include_once 'lib/model/om/BaseTaxonomyPeer.php';

		if ($this->aTaxonomy === null && ($this->taxonomy_id !== null)) {

			$this->aTaxonomy = TaxonomyPeer::retrieveByPK($this->taxonomy_id, $con);

			
		}
		return $this->aTaxonomy;
	}

	
	public function initInformationObjectsRelatedByLevelOfDescriptionId()
	{
		if ($this->collInformationObjectsRelatedByLevelOfDescriptionId === null) {
			$this->collInformationObjectsRelatedByLevelOfDescriptionId = array();
		}
	}

	
	public function getInformationObjectsRelatedByLevelOfDescriptionId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectsRelatedByLevelOfDescriptionId === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectsRelatedByLevelOfDescriptionId = array();
			} else {

				$criteria->add(InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

				InformationObjectPeer::addSelectColumns($criteria);
				$this->collInformationObjectsRelatedByLevelOfDescriptionId = InformationObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

				InformationObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectRelatedByLevelOfDescriptionIdCriteria) || !$this->lastInformationObjectRelatedByLevelOfDescriptionIdCriteria->equals($criteria)) {
					$this->collInformationObjectsRelatedByLevelOfDescriptionId = InformationObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectRelatedByLevelOfDescriptionIdCriteria = $criteria;
		return $this->collInformationObjectsRelatedByLevelOfDescriptionId;
	}

	
	public function countInformationObjectsRelatedByLevelOfDescriptionId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

		return InformationObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectRelatedByLevelOfDescriptionId(InformationObject $l)
	{
		$this->collInformationObjectsRelatedByLevelOfDescriptionId[] = $l;
		$l->setTermRelatedByLevelOfDescriptionId($this);
	}


	
	public function getInformationObjectsRelatedByLevelOfDescriptionIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectsRelatedByLevelOfDescriptionId === null) {
			if ($this->isNew()) {
				$this->collInformationObjectsRelatedByLevelOfDescriptionId = array();
			} else {

				$criteria->add(InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

				$this->collInformationObjectsRelatedByLevelOfDescriptionId = InformationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

			if (!isset($this->lastInformationObjectRelatedByLevelOfDescriptionIdCriteria) || !$this->lastInformationObjectRelatedByLevelOfDescriptionIdCriteria->equals($criteria)) {
				$this->collInformationObjectsRelatedByLevelOfDescriptionId = InformationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastInformationObjectRelatedByLevelOfDescriptionIdCriteria = $criteria;

		return $this->collInformationObjectsRelatedByLevelOfDescriptionId;
	}

	
	public function initInformationObjectsRelatedByCollectionTypeId()
	{
		if ($this->collInformationObjectsRelatedByCollectionTypeId === null) {
			$this->collInformationObjectsRelatedByCollectionTypeId = array();
		}
	}

	
	public function getInformationObjectsRelatedByCollectionTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectsRelatedByCollectionTypeId === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectsRelatedByCollectionTypeId = array();
			} else {

				$criteria->add(InformationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

				InformationObjectPeer::addSelectColumns($criteria);
				$this->collInformationObjectsRelatedByCollectionTypeId = InformationObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

				InformationObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectRelatedByCollectionTypeIdCriteria) || !$this->lastInformationObjectRelatedByCollectionTypeIdCriteria->equals($criteria)) {
					$this->collInformationObjectsRelatedByCollectionTypeId = InformationObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectRelatedByCollectionTypeIdCriteria = $criteria;
		return $this->collInformationObjectsRelatedByCollectionTypeId;
	}

	
	public function countInformationObjectsRelatedByCollectionTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

		return InformationObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectRelatedByCollectionTypeId(InformationObject $l)
	{
		$this->collInformationObjectsRelatedByCollectionTypeId[] = $l;
		$l->setTermRelatedByCollectionTypeId($this);
	}


	
	public function getInformationObjectsRelatedByCollectionTypeIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectsRelatedByCollectionTypeId === null) {
			if ($this->isNew()) {
				$this->collInformationObjectsRelatedByCollectionTypeId = array();
			} else {

				$criteria->add(InformationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

				$this->collInformationObjectsRelatedByCollectionTypeId = InformationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

			if (!isset($this->lastInformationObjectRelatedByCollectionTypeIdCriteria) || !$this->lastInformationObjectRelatedByCollectionTypeIdCriteria->equals($criteria)) {
				$this->collInformationObjectsRelatedByCollectionTypeId = InformationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastInformationObjectRelatedByCollectionTypeIdCriteria = $criteria;

		return $this->collInformationObjectsRelatedByCollectionTypeId;
	}

	
	public function initInformationObjectTermRelationshipsRelatedByTermId()
	{
		if ($this->collInformationObjectTermRelationshipsRelatedByTermId === null) {
			$this->collInformationObjectTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getInformationObjectTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(InformationObjectTermRelationshipPeer::TERM_ID, $this->getId());

				InformationObjectTermRelationshipPeer::addSelectColumns($criteria);
				$this->collInformationObjectTermRelationshipsRelatedByTermId = InformationObjectTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectTermRelationshipPeer::TERM_ID, $this->getId());

				InformationObjectTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectTermRelationshipRelatedByTermIdCriteria) || !$this->lastInformationObjectTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collInformationObjectTermRelationshipsRelatedByTermId = InformationObjectTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collInformationObjectTermRelationshipsRelatedByTermId;
	}

	
	public function countInformationObjectTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectTermRelationshipPeer::TERM_ID, $this->getId());

		return InformationObjectTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectTermRelationshipRelatedByTermId(InformationObjectTermRelationship $l)
	{
		$this->collInformationObjectTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getInformationObjectTermRelationshipsRelatedByTermIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collInformationObjectTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(InformationObjectTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collInformationObjectTermRelationshipsRelatedByTermId = InformationObjectTermRelationshipPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastInformationObjectTermRelationshipRelatedByTermIdCriteria) || !$this->lastInformationObjectTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collInformationObjectTermRelationshipsRelatedByTermId = InformationObjectTermRelationshipPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastInformationObjectTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collInformationObjectTermRelationshipsRelatedByTermId;
	}

	
	public function initInformationObjectTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getInformationObjectTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(InformationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				InformationObjectTermRelationshipPeer::addSelectColumns($criteria);
				$this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId = InformationObjectTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				InformationObjectTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastInformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId = InformationObjectTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countInformationObjectTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return InformationObjectTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectTermRelationshipRelatedByRelationshipTypeId(InformationObjectTermRelationship $l)
	{
		$this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getInformationObjectTermRelationshipsRelatedByRelationshipTypeIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(InformationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId = InformationObjectTermRelationshipPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastInformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastInformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId = InformationObjectTermRelationshipPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastInformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collInformationObjectTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function initInformationObjectRecursiveRelationships()
	{
		if ($this->collInformationObjectRecursiveRelationships === null) {
			$this->collInformationObjectRecursiveRelationships = array();
		}
	}

	
	public function getInformationObjectRecursiveRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
			   $this->collInformationObjectRecursiveRelationships = array();
			} else {

				$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				InformationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collInformationObjectRecursiveRelationships = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				InformationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformationObjectRecursiveRelationshipCriteria) || !$this->lastInformationObjectRecursiveRelationshipCriteria->equals($criteria)) {
					$this->collInformationObjectRecursiveRelationships = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformationObjectRecursiveRelationshipCriteria = $criteria;
		return $this->collInformationObjectRecursiveRelationships;
	}

	
	public function countInformationObjectRecursiveRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return InformationObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformationObjectRecursiveRelationship(InformationObjectRecursiveRelationship $l)
	{
		$this->collInformationObjectRecursiveRelationships[] = $l;
		$l->setTerm($this);
	}


	
	public function getInformationObjectRecursiveRelationshipsJoinInformationObjectRelatedByInformationObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collInformationObjectRecursiveRelationships = array();
			} else {

				$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collInformationObjectRecursiveRelationships = InformationObjectRecursiveRelationshipPeer::doSelectJoinInformationObjectRelatedByInformationObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastInformationObjectRecursiveRelationshipCriteria) || !$this->lastInformationObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collInformationObjectRecursiveRelationships = InformationObjectRecursiveRelationshipPeer::doSelectJoinInformationObjectRelatedByInformationObjectId($criteria, $con);
			}
		}
		$this->lastInformationObjectRecursiveRelationshipCriteria = $criteria;

		return $this->collInformationObjectRecursiveRelationships;
	}


	
	public function getInformationObjectRecursiveRelationshipsJoinInformationObjectRelatedByRelatedInformationObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformationObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collInformationObjectRecursiveRelationships = array();
			} else {

				$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collInformationObjectRecursiveRelationships = InformationObjectRecursiveRelationshipPeer::doSelectJoinInformationObjectRelatedByRelatedInformationObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastInformationObjectRecursiveRelationshipCriteria) || !$this->lastInformationObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collInformationObjectRecursiveRelationships = InformationObjectRecursiveRelationshipPeer::doSelectJoinInformationObjectRelatedByRelatedInformationObjectId($criteria, $con);
			}
		}
		$this->lastInformationObjectRecursiveRelationshipCriteria = $criteria;

		return $this->collInformationObjectRecursiveRelationships;
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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				NotePeer::addSelectColumns($criteria);
				$this->collNotes = NotePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

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

		$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

		return NotePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNote(Note $l)
	{
		$this->collNotes[] = $l;
		$l->setTerm($this);
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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinFunctionDescription($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinFunctionDescription($criteria, $con);
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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastNoteCriteria = $criteria;

		return $this->collNotes;
	}

	
	public function initDigitalObjectsRelatedByUseageId()
	{
		if ($this->collDigitalObjectsRelatedByUseageId === null) {
			$this->collDigitalObjectsRelatedByUseageId = array();
		}
	}

	
	public function getDigitalObjectsRelatedByUseageId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByUseageId === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectsRelatedByUseageId = array();
			} else {

				$criteria->add(DigitalObjectPeer::USEAGE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				$this->collDigitalObjectsRelatedByUseageId = DigitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectPeer::USEAGE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRelatedByUseageIdCriteria) || !$this->lastDigitalObjectRelatedByUseageIdCriteria->equals($criteria)) {
					$this->collDigitalObjectsRelatedByUseageId = DigitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRelatedByUseageIdCriteria = $criteria;
		return $this->collDigitalObjectsRelatedByUseageId;
	}

	
	public function countDigitalObjectsRelatedByUseageId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectPeer::USEAGE_ID, $this->getId());

		return DigitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRelatedByUseageId(DigitalObject $l)
	{
		$this->collDigitalObjectsRelatedByUseageId[] = $l;
		$l->setTermRelatedByUseageId($this);
	}


	
	public function getDigitalObjectsRelatedByUseageIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByUseageId === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectsRelatedByUseageId = array();
			} else {

				$criteria->add(DigitalObjectPeer::USEAGE_ID, $this->getId());

				$this->collDigitalObjectsRelatedByUseageId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::USEAGE_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRelatedByUseageIdCriteria) || !$this->lastDigitalObjectRelatedByUseageIdCriteria->equals($criteria)) {
				$this->collDigitalObjectsRelatedByUseageId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastDigitalObjectRelatedByUseageIdCriteria = $criteria;

		return $this->collDigitalObjectsRelatedByUseageId;
	}

	
	public function initDigitalObjectsRelatedByMimeTypeId()
	{
		if ($this->collDigitalObjectsRelatedByMimeTypeId === null) {
			$this->collDigitalObjectsRelatedByMimeTypeId = array();
		}
	}

	
	public function getDigitalObjectsRelatedByMimeTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByMimeTypeId === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectsRelatedByMimeTypeId = array();
			} else {

				$criteria->add(DigitalObjectPeer::MIME_TYPE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				$this->collDigitalObjectsRelatedByMimeTypeId = DigitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectPeer::MIME_TYPE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRelatedByMimeTypeIdCriteria) || !$this->lastDigitalObjectRelatedByMimeTypeIdCriteria->equals($criteria)) {
					$this->collDigitalObjectsRelatedByMimeTypeId = DigitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRelatedByMimeTypeIdCriteria = $criteria;
		return $this->collDigitalObjectsRelatedByMimeTypeId;
	}

	
	public function countDigitalObjectsRelatedByMimeTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectPeer::MIME_TYPE_ID, $this->getId());

		return DigitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRelatedByMimeTypeId(DigitalObject $l)
	{
		$this->collDigitalObjectsRelatedByMimeTypeId[] = $l;
		$l->setTermRelatedByMimeTypeId($this);
	}


	
	public function getDigitalObjectsRelatedByMimeTypeIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByMimeTypeId === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectsRelatedByMimeTypeId = array();
			} else {

				$criteria->add(DigitalObjectPeer::MIME_TYPE_ID, $this->getId());

				$this->collDigitalObjectsRelatedByMimeTypeId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::MIME_TYPE_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRelatedByMimeTypeIdCriteria) || !$this->lastDigitalObjectRelatedByMimeTypeIdCriteria->equals($criteria)) {
				$this->collDigitalObjectsRelatedByMimeTypeId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastDigitalObjectRelatedByMimeTypeIdCriteria = $criteria;

		return $this->collDigitalObjectsRelatedByMimeTypeId;
	}

	
	public function initDigitalObjectsRelatedByMediaTypeId()
	{
		if ($this->collDigitalObjectsRelatedByMediaTypeId === null) {
			$this->collDigitalObjectsRelatedByMediaTypeId = array();
		}
	}

	
	public function getDigitalObjectsRelatedByMediaTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByMediaTypeId === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectsRelatedByMediaTypeId = array();
			} else {

				$criteria->add(DigitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				$this->collDigitalObjectsRelatedByMediaTypeId = DigitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRelatedByMediaTypeIdCriteria) || !$this->lastDigitalObjectRelatedByMediaTypeIdCriteria->equals($criteria)) {
					$this->collDigitalObjectsRelatedByMediaTypeId = DigitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRelatedByMediaTypeIdCriteria = $criteria;
		return $this->collDigitalObjectsRelatedByMediaTypeId;
	}

	
	public function countDigitalObjectsRelatedByMediaTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

		return DigitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRelatedByMediaTypeId(DigitalObject $l)
	{
		$this->collDigitalObjectsRelatedByMediaTypeId[] = $l;
		$l->setTermRelatedByMediaTypeId($this);
	}


	
	public function getDigitalObjectsRelatedByMediaTypeIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByMediaTypeId === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectsRelatedByMediaTypeId = array();
			} else {

				$criteria->add(DigitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

				$this->collDigitalObjectsRelatedByMediaTypeId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRelatedByMediaTypeIdCriteria) || !$this->lastDigitalObjectRelatedByMediaTypeIdCriteria->equals($criteria)) {
				$this->collDigitalObjectsRelatedByMediaTypeId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastDigitalObjectRelatedByMediaTypeIdCriteria = $criteria;

		return $this->collDigitalObjectsRelatedByMediaTypeId;
	}

	
	public function initDigitalObjectsRelatedByChecksumTypeId()
	{
		if ($this->collDigitalObjectsRelatedByChecksumTypeId === null) {
			$this->collDigitalObjectsRelatedByChecksumTypeId = array();
		}
	}

	
	public function getDigitalObjectsRelatedByChecksumTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByChecksumTypeId === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectsRelatedByChecksumTypeId = array();
			} else {

				$criteria->add(DigitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				$this->collDigitalObjectsRelatedByChecksumTypeId = DigitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRelatedByChecksumTypeIdCriteria) || !$this->lastDigitalObjectRelatedByChecksumTypeIdCriteria->equals($criteria)) {
					$this->collDigitalObjectsRelatedByChecksumTypeId = DigitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRelatedByChecksumTypeIdCriteria = $criteria;
		return $this->collDigitalObjectsRelatedByChecksumTypeId;
	}

	
	public function countDigitalObjectsRelatedByChecksumTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

		return DigitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRelatedByChecksumTypeId(DigitalObject $l)
	{
		$this->collDigitalObjectsRelatedByChecksumTypeId[] = $l;
		$l->setTermRelatedByChecksumTypeId($this);
	}


	
	public function getDigitalObjectsRelatedByChecksumTypeIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByChecksumTypeId === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectsRelatedByChecksumTypeId = array();
			} else {

				$criteria->add(DigitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

				$this->collDigitalObjectsRelatedByChecksumTypeId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRelatedByChecksumTypeIdCriteria) || !$this->lastDigitalObjectRelatedByChecksumTypeIdCriteria->equals($criteria)) {
				$this->collDigitalObjectsRelatedByChecksumTypeId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastDigitalObjectRelatedByChecksumTypeIdCriteria = $criteria;

		return $this->collDigitalObjectsRelatedByChecksumTypeId;
	}

	
	public function initDigitalObjectsRelatedByLocationId()
	{
		if ($this->collDigitalObjectsRelatedByLocationId === null) {
			$this->collDigitalObjectsRelatedByLocationId = array();
		}
	}

	
	public function getDigitalObjectsRelatedByLocationId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByLocationId === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectsRelatedByLocationId = array();
			} else {

				$criteria->add(DigitalObjectPeer::LOCATION_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				$this->collDigitalObjectsRelatedByLocationId = DigitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectPeer::LOCATION_ID, $this->getId());

				DigitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRelatedByLocationIdCriteria) || !$this->lastDigitalObjectRelatedByLocationIdCriteria->equals($criteria)) {
					$this->collDigitalObjectsRelatedByLocationId = DigitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRelatedByLocationIdCriteria = $criteria;
		return $this->collDigitalObjectsRelatedByLocationId;
	}

	
	public function countDigitalObjectsRelatedByLocationId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectPeer::LOCATION_ID, $this->getId());

		return DigitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRelatedByLocationId(DigitalObject $l)
	{
		$this->collDigitalObjectsRelatedByLocationId[] = $l;
		$l->setTermRelatedByLocationId($this);
	}


	
	public function getDigitalObjectsRelatedByLocationIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectsRelatedByLocationId === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectsRelatedByLocationId = array();
			} else {

				$criteria->add(DigitalObjectPeer::LOCATION_ID, $this->getId());

				$this->collDigitalObjectsRelatedByLocationId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRelatedByLocationIdCriteria) || !$this->lastDigitalObjectRelatedByLocationIdCriteria->equals($criteria)) {
				$this->collDigitalObjectsRelatedByLocationId = DigitalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastDigitalObjectRelatedByLocationIdCriteria = $criteria;

		return $this->collDigitalObjectsRelatedByLocationId;
	}

	
	public function initDigitalObjectRecursiveRelationships()
	{
		if ($this->collDigitalObjectRecursiveRelationships === null) {
			$this->collDigitalObjectRecursiveRelationships = array();
		}
	}

	
	public function getDigitalObjectRecursiveRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
			   $this->collDigitalObjectRecursiveRelationships = array();
			} else {

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				DigitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collDigitalObjectRecursiveRelationships = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				DigitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastDigitalObjectRecursiveRelationshipCriteria) || !$this->lastDigitalObjectRecursiveRelationshipCriteria->equals($criteria)) {
					$this->collDigitalObjectRecursiveRelationships = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDigitalObjectRecursiveRelationshipCriteria = $criteria;
		return $this->collDigitalObjectRecursiveRelationships;
	}

	
	public function countDigitalObjectRecursiveRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return DigitalObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDigitalObjectRecursiveRelationship(DigitalObjectRecursiveRelationship $l)
	{
		$this->collDigitalObjectRecursiveRelationships[] = $l;
		$l->setTerm($this);
	}


	
	public function getDigitalObjectRecursiveRelationshipsJoinDigitalObjectRelatedByDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectRecursiveRelationships = array();
			} else {

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collDigitalObjectRecursiveRelationships = DigitalObjectRecursiveRelationshipPeer::doSelectJoinDigitalObjectRelatedByDigitalObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRecursiveRelationshipCriteria) || !$this->lastDigitalObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collDigitalObjectRecursiveRelationships = DigitalObjectRecursiveRelationshipPeer::doSelectJoinDigitalObjectRelatedByDigitalObjectId($criteria, $con);
			}
		}
		$this->lastDigitalObjectRecursiveRelationshipCriteria = $criteria;

		return $this->collDigitalObjectRecursiveRelationships;
	}


	
	public function getDigitalObjectRecursiveRelationshipsJoinDigitalObjectRelatedByRelatedDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDigitalObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collDigitalObjectRecursiveRelationships = array();
			} else {

				$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collDigitalObjectRecursiveRelationships = DigitalObjectRecursiveRelationshipPeer::doSelectJoinDigitalObjectRelatedByRelatedDigitalObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastDigitalObjectRecursiveRelationshipCriteria) || !$this->lastDigitalObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collDigitalObjectRecursiveRelationships = DigitalObjectRecursiveRelationshipPeer::doSelectJoinDigitalObjectRelatedByRelatedDigitalObjectId($criteria, $con);
			}
		}
		$this->lastDigitalObjectRecursiveRelationshipCriteria = $criteria;

		return $this->collDigitalObjectRecursiveRelationships;
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

				$criteria->add(PhysicalObjectPeer::LOCATION_ID, $this->getId());

				PhysicalObjectPeer::addSelectColumns($criteria);
				$this->collPhysicalObjects = PhysicalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PhysicalObjectPeer::LOCATION_ID, $this->getId());

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

		$criteria->add(PhysicalObjectPeer::LOCATION_ID, $this->getId());

		return PhysicalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPhysicalObject(PhysicalObject $l)
	{
		$this->collPhysicalObjects[] = $l;
		$l->setTerm($this);
	}


	
	public function getPhysicalObjectsJoinInformationObject($criteria = null, $con = null)
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

				$criteria->add(PhysicalObjectPeer::LOCATION_ID, $this->getId());

				$this->collPhysicalObjects = PhysicalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(PhysicalObjectPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastPhysicalObjectCriteria) || !$this->lastPhysicalObjectCriteria->equals($criteria)) {
				$this->collPhysicalObjects = PhysicalObjectPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastPhysicalObjectCriteria = $criteria;

		return $this->collPhysicalObjects;
	}

	
	public function initActorsRelatedByTypeOfEntityId()
	{
		if ($this->collActorsRelatedByTypeOfEntityId === null) {
			$this->collActorsRelatedByTypeOfEntityId = array();
		}
	}

	
	public function getActorsRelatedByTypeOfEntityId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorsRelatedByTypeOfEntityId === null) {
			if ($this->isNew()) {
			   $this->collActorsRelatedByTypeOfEntityId = array();
			} else {

				$criteria->add(ActorPeer::TYPE_OF_ENTITY_ID, $this->getId());

				ActorPeer::addSelectColumns($criteria);
				$this->collActorsRelatedByTypeOfEntityId = ActorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorPeer::TYPE_OF_ENTITY_ID, $this->getId());

				ActorPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorRelatedByTypeOfEntityIdCriteria) || !$this->lastActorRelatedByTypeOfEntityIdCriteria->equals($criteria)) {
					$this->collActorsRelatedByTypeOfEntityId = ActorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorRelatedByTypeOfEntityIdCriteria = $criteria;
		return $this->collActorsRelatedByTypeOfEntityId;
	}

	
	public function countActorsRelatedByTypeOfEntityId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorPeer::TYPE_OF_ENTITY_ID, $this->getId());

		return ActorPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorRelatedByTypeOfEntityId(Actor $l)
	{
		$this->collActorsRelatedByTypeOfEntityId[] = $l;
		$l->setTermRelatedByTypeOfEntityId($this);
	}

	
	public function initActorsRelatedByStatusId()
	{
		if ($this->collActorsRelatedByStatusId === null) {
			$this->collActorsRelatedByStatusId = array();
		}
	}

	
	public function getActorsRelatedByStatusId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorsRelatedByStatusId === null) {
			if ($this->isNew()) {
			   $this->collActorsRelatedByStatusId = array();
			} else {

				$criteria->add(ActorPeer::STATUS_ID, $this->getId());

				ActorPeer::addSelectColumns($criteria);
				$this->collActorsRelatedByStatusId = ActorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorPeer::STATUS_ID, $this->getId());

				ActorPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorRelatedByStatusIdCriteria) || !$this->lastActorRelatedByStatusIdCriteria->equals($criteria)) {
					$this->collActorsRelatedByStatusId = ActorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorRelatedByStatusIdCriteria = $criteria;
		return $this->collActorsRelatedByStatusId;
	}

	
	public function countActorsRelatedByStatusId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorPeer::STATUS_ID, $this->getId());

		return ActorPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorRelatedByStatusId(Actor $l)
	{
		$this->collActorsRelatedByStatusId[] = $l;
		$l->setTermRelatedByStatusId($this);
	}

	
	public function initActorsRelatedByLevelOfDetailId()
	{
		if ($this->collActorsRelatedByLevelOfDetailId === null) {
			$this->collActorsRelatedByLevelOfDetailId = array();
		}
	}

	
	public function getActorsRelatedByLevelOfDetailId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorsRelatedByLevelOfDetailId === null) {
			if ($this->isNew()) {
			   $this->collActorsRelatedByLevelOfDetailId = array();
			} else {

				$criteria->add(ActorPeer::LEVEL_OF_DETAIL_ID, $this->getId());

				ActorPeer::addSelectColumns($criteria);
				$this->collActorsRelatedByLevelOfDetailId = ActorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorPeer::LEVEL_OF_DETAIL_ID, $this->getId());

				ActorPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorRelatedByLevelOfDetailIdCriteria) || !$this->lastActorRelatedByLevelOfDetailIdCriteria->equals($criteria)) {
					$this->collActorsRelatedByLevelOfDetailId = ActorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorRelatedByLevelOfDetailIdCriteria = $criteria;
		return $this->collActorsRelatedByLevelOfDetailId;
	}

	
	public function countActorsRelatedByLevelOfDetailId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorPeer::LEVEL_OF_DETAIL_ID, $this->getId());

		return ActorPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorRelatedByLevelOfDetailId(Actor $l)
	{
		$this->collActorsRelatedByLevelOfDetailId[] = $l;
		$l->setTermRelatedByLevelOfDetailId($this);
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

				$criteria->add(ActorNamePeer::NAME_TYPE_ID, $this->getId());

				ActorNamePeer::addSelectColumns($criteria);
				$this->collActorNames = ActorNamePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorNamePeer::NAME_TYPE_ID, $this->getId());

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

		$criteria->add(ActorNamePeer::NAME_TYPE_ID, $this->getId());

		return ActorNamePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorName(ActorName $l)
	{
		$this->collActorNames[] = $l;
		$l->setTerm($this);
	}


	
	public function getActorNamesJoinActor($criteria = null, $con = null)
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

				$criteria->add(ActorNamePeer::NAME_TYPE_ID, $this->getId());

				$this->collActorNames = ActorNamePeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorNamePeer::NAME_TYPE_ID, $this->getId());

			if (!isset($this->lastActorNameCriteria) || !$this->lastActorNameCriteria->equals($criteria)) {
				$this->collActorNames = ActorNamePeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastActorNameCriteria = $criteria;

		return $this->collActorNames;
	}

	
	public function initActorRecursiveRelationships()
	{
		if ($this->collActorRecursiveRelationships === null) {
			$this->collActorRecursiveRelationships = array();
		}
	}

	
	public function getActorRecursiveRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorRecursiveRelationships === null) {
			if ($this->isNew()) {
			   $this->collActorRecursiveRelationships = array();
			} else {

				$criteria->add(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				ActorRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collActorRecursiveRelationships = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				ActorRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorRecursiveRelationshipCriteria) || !$this->lastActorRecursiveRelationshipCriteria->equals($criteria)) {
					$this->collActorRecursiveRelationships = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorRecursiveRelationshipCriteria = $criteria;
		return $this->collActorRecursiveRelationships;
	}

	
	public function countActorRecursiveRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return ActorRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorRecursiveRelationship(ActorRecursiveRelationship $l)
	{
		$this->collActorRecursiveRelationships[] = $l;
		$l->setTerm($this);
	}


	
	public function getActorRecursiveRelationshipsJoinActorRelatedByActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collActorRecursiveRelationships = array();
			} else {

				$criteria->add(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collActorRecursiveRelationships = ActorRecursiveRelationshipPeer::doSelectJoinActorRelatedByActorId($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastActorRecursiveRelationshipCriteria) || !$this->lastActorRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collActorRecursiveRelationships = ActorRecursiveRelationshipPeer::doSelectJoinActorRelatedByActorId($criteria, $con);
			}
		}
		$this->lastActorRecursiveRelationshipCriteria = $criteria;

		return $this->collActorRecursiveRelationships;
	}


	
	public function getActorRecursiveRelationshipsJoinActorRelatedByRelatedActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collActorRecursiveRelationships = array();
			} else {

				$criteria->add(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collActorRecursiveRelationships = ActorRecursiveRelationshipPeer::doSelectJoinActorRelatedByRelatedActorId($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastActorRecursiveRelationshipCriteria) || !$this->lastActorRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collActorRecursiveRelationships = ActorRecursiveRelationshipPeer::doSelectJoinActorRelatedByRelatedActorId($criteria, $con);
			}
		}
		$this->lastActorRecursiveRelationshipCriteria = $criteria;

		return $this->collActorRecursiveRelationships;
	}

	
	public function initActorTermRelationshipsRelatedByTermId()
	{
		if ($this->collActorTermRelationshipsRelatedByTermId === null) {
			$this->collActorTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getActorTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collActorTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(ActorTermRelationshipPeer::TERM_ID, $this->getId());

				ActorTermRelationshipPeer::addSelectColumns($criteria);
				$this->collActorTermRelationshipsRelatedByTermId = ActorTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorTermRelationshipPeer::TERM_ID, $this->getId());

				ActorTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorTermRelationshipRelatedByTermIdCriteria) || !$this->lastActorTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collActorTermRelationshipsRelatedByTermId = ActorTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collActorTermRelationshipsRelatedByTermId;
	}

	
	public function countActorTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorTermRelationshipPeer::TERM_ID, $this->getId());

		return ActorTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorTermRelationshipRelatedByTermId(ActorTermRelationship $l)
	{
		$this->collActorTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getActorTermRelationshipsRelatedByTermIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collActorTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(ActorTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collActorTermRelationshipsRelatedByTermId = ActorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastActorTermRelationshipRelatedByTermIdCriteria) || !$this->lastActorTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collActorTermRelationshipsRelatedByTermId = ActorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastActorTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collActorTermRelationshipsRelatedByTermId;
	}

	
	public function initActorTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collActorTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collActorTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getActorTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collActorTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				ActorTermRelationshipPeer::addSelectColumns($criteria);
				$this->collActorTermRelationshipsRelatedByRelationshipTypeId = ActorTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				ActorTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastActorTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastActorTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collActorTermRelationshipsRelatedByRelationshipTypeId = ActorTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastActorTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collActorTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countActorTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return ActorTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addActorTermRelationshipRelatedByRelationshipTypeId(ActorTermRelationship $l)
	{
		$this->collActorTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getActorTermRelationshipsRelatedByRelationshipTypeIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseActorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collActorTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collActorTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collActorTermRelationshipsRelatedByRelationshipTypeId = ActorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastActorTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastActorTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collActorTermRelationshipsRelatedByRelationshipTypeId = ActorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastActorTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collActorTermRelationshipsRelatedByRelationshipTypeId;
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

				$criteria->add(ContactInformationPeer::COUNTRY_ID, $this->getId());

				ContactInformationPeer::addSelectColumns($criteria);
				$this->collContactInformations = ContactInformationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactInformationPeer::COUNTRY_ID, $this->getId());

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

		$criteria->add(ContactInformationPeer::COUNTRY_ID, $this->getId());

		return ContactInformationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addContactInformation(ContactInformation $l)
	{
		$this->collContactInformations[] = $l;
		$l->setTerm($this);
	}


	
	public function getContactInformationsJoinActor($criteria = null, $con = null)
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

				$criteria->add(ContactInformationPeer::COUNTRY_ID, $this->getId());

				$this->collContactInformations = ContactInformationPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(ContactInformationPeer::COUNTRY_ID, $this->getId());

			if (!isset($this->lastContactInformationCriteria) || !$this->lastContactInformationCriteria->equals($criteria)) {
				$this->collContactInformations = ContactInformationPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastContactInformationCriteria = $criteria;

		return $this->collContactInformations;
	}

	
	public function initPlacesRelatedByTermId()
	{
		if ($this->collPlacesRelatedByTermId === null) {
			$this->collPlacesRelatedByTermId = array();
		}
	}

	
	public function getPlacesRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlacePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlacesRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collPlacesRelatedByTermId = array();
			} else {

				$criteria->add(PlacePeer::TERM_ID, $this->getId());

				PlacePeer::addSelectColumns($criteria);
				$this->collPlacesRelatedByTermId = PlacePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PlacePeer::TERM_ID, $this->getId());

				PlacePeer::addSelectColumns($criteria);
				if (!isset($this->lastPlaceRelatedByTermIdCriteria) || !$this->lastPlaceRelatedByTermIdCriteria->equals($criteria)) {
					$this->collPlacesRelatedByTermId = PlacePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPlaceRelatedByTermIdCriteria = $criteria;
		return $this->collPlacesRelatedByTermId;
	}

	
	public function countPlacesRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePlacePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PlacePeer::TERM_ID, $this->getId());

		return PlacePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPlaceRelatedByTermId(Place $l)
	{
		$this->collPlacesRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}

	
	public function initPlacesRelatedByCountryId()
	{
		if ($this->collPlacesRelatedByCountryId === null) {
			$this->collPlacesRelatedByCountryId = array();
		}
	}

	
	public function getPlacesRelatedByCountryId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlacePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlacesRelatedByCountryId === null) {
			if ($this->isNew()) {
			   $this->collPlacesRelatedByCountryId = array();
			} else {

				$criteria->add(PlacePeer::COUNTRY_ID, $this->getId());

				PlacePeer::addSelectColumns($criteria);
				$this->collPlacesRelatedByCountryId = PlacePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PlacePeer::COUNTRY_ID, $this->getId());

				PlacePeer::addSelectColumns($criteria);
				if (!isset($this->lastPlaceRelatedByCountryIdCriteria) || !$this->lastPlaceRelatedByCountryIdCriteria->equals($criteria)) {
					$this->collPlacesRelatedByCountryId = PlacePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPlaceRelatedByCountryIdCriteria = $criteria;
		return $this->collPlacesRelatedByCountryId;
	}

	
	public function countPlacesRelatedByCountryId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePlacePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PlacePeer::COUNTRY_ID, $this->getId());

		return PlacePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPlaceRelatedByCountryId(Place $l)
	{
		$this->collPlacesRelatedByCountryId[] = $l;
		$l->setTermRelatedByCountryId($this);
	}

	
	public function initPlacesRelatedByPlaceTypeId()
	{
		if ($this->collPlacesRelatedByPlaceTypeId === null) {
			$this->collPlacesRelatedByPlaceTypeId = array();
		}
	}

	
	public function getPlacesRelatedByPlaceTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePlacePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPlacesRelatedByPlaceTypeId === null) {
			if ($this->isNew()) {
			   $this->collPlacesRelatedByPlaceTypeId = array();
			} else {

				$criteria->add(PlacePeer::PLACE_TYPE_ID, $this->getId());

				PlacePeer::addSelectColumns($criteria);
				$this->collPlacesRelatedByPlaceTypeId = PlacePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PlacePeer::PLACE_TYPE_ID, $this->getId());

				PlacePeer::addSelectColumns($criteria);
				if (!isset($this->lastPlaceRelatedByPlaceTypeIdCriteria) || !$this->lastPlaceRelatedByPlaceTypeIdCriteria->equals($criteria)) {
					$this->collPlacesRelatedByPlaceTypeId = PlacePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPlaceRelatedByPlaceTypeIdCriteria = $criteria;
		return $this->collPlacesRelatedByPlaceTypeId;
	}

	
	public function countPlacesRelatedByPlaceTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePlacePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PlacePeer::PLACE_TYPE_ID, $this->getId());

		return PlacePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPlaceRelatedByPlaceTypeId(Place $l)
	{
		$this->collPlacesRelatedByPlaceTypeId[] = $l;
		$l->setTermRelatedByPlaceTypeId($this);
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

				$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				PlaceMapRelationshipPeer::addSelectColumns($criteria);
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

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

		$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return PlaceMapRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPlaceMapRelationship(PlaceMapRelationship $l)
	{
		$this->collPlaceMapRelationships[] = $l;
		$l->setTerm($this);
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

				$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

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

				$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
	}


	
	public function getPlaceMapRelationshipsJoinDigitalObject($criteria = null, $con = null)
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

				$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinDigitalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastPlaceMapRelationshipCriteria) || !$this->lastPlaceMapRelationshipCriteria->equals($criteria)) {
				$this->collPlaceMapRelationships = PlaceMapRelationshipPeer::doSelectJoinDigitalObject($criteria, $con);
			}
		}
		$this->lastPlaceMapRelationshipCriteria = $criteria;

		return $this->collPlaceMapRelationships;
	}

	
	public function initRepositorysRelatedByRepositoryTypeId()
	{
		if ($this->collRepositorysRelatedByRepositoryTypeId === null) {
			$this->collRepositorysRelatedByRepositoryTypeId = array();
		}
	}

	
	public function getRepositorysRelatedByRepositoryTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorysRelatedByRepositoryTypeId === null) {
			if ($this->isNew()) {
			   $this->collRepositorysRelatedByRepositoryTypeId = array();
			} else {

				$criteria->add(RepositoryPeer::REPOSITORY_TYPE_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				$this->collRepositorysRelatedByRepositoryTypeId = RepositoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepositoryPeer::REPOSITORY_TYPE_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepositoryRelatedByRepositoryTypeIdCriteria) || !$this->lastRepositoryRelatedByRepositoryTypeIdCriteria->equals($criteria)) {
					$this->collRepositorysRelatedByRepositoryTypeId = RepositoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepositoryRelatedByRepositoryTypeIdCriteria = $criteria;
		return $this->collRepositorysRelatedByRepositoryTypeId;
	}

	
	public function countRepositorysRelatedByRepositoryTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepositoryPeer::REPOSITORY_TYPE_ID, $this->getId());

		return RepositoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRepositoryRelatedByRepositoryTypeId(Repository $l)
	{
		$this->collRepositorysRelatedByRepositoryTypeId[] = $l;
		$l->setTermRelatedByRepositoryTypeId($this);
	}


	
	public function getRepositorysRelatedByRepositoryTypeIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorysRelatedByRepositoryTypeId === null) {
			if ($this->isNew()) {
				$this->collRepositorysRelatedByRepositoryTypeId = array();
			} else {

				$criteria->add(RepositoryPeer::REPOSITORY_TYPE_ID, $this->getId());

				$this->collRepositorysRelatedByRepositoryTypeId = RepositoryPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryPeer::REPOSITORY_TYPE_ID, $this->getId());

			if (!isset($this->lastRepositoryRelatedByRepositoryTypeIdCriteria) || !$this->lastRepositoryRelatedByRepositoryTypeIdCriteria->equals($criteria)) {
				$this->collRepositorysRelatedByRepositoryTypeId = RepositoryPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastRepositoryRelatedByRepositoryTypeIdCriteria = $criteria;

		return $this->collRepositorysRelatedByRepositoryTypeId;
	}

	
	public function initRepositorysRelatedByStatusId()
	{
		if ($this->collRepositorysRelatedByStatusId === null) {
			$this->collRepositorysRelatedByStatusId = array();
		}
	}

	
	public function getRepositorysRelatedByStatusId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorysRelatedByStatusId === null) {
			if ($this->isNew()) {
			   $this->collRepositorysRelatedByStatusId = array();
			} else {

				$criteria->add(RepositoryPeer::STATUS_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				$this->collRepositorysRelatedByStatusId = RepositoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepositoryPeer::STATUS_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepositoryRelatedByStatusIdCriteria) || !$this->lastRepositoryRelatedByStatusIdCriteria->equals($criteria)) {
					$this->collRepositorysRelatedByStatusId = RepositoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepositoryRelatedByStatusIdCriteria = $criteria;
		return $this->collRepositorysRelatedByStatusId;
	}

	
	public function countRepositorysRelatedByStatusId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepositoryPeer::STATUS_ID, $this->getId());

		return RepositoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRepositoryRelatedByStatusId(Repository $l)
	{
		$this->collRepositorysRelatedByStatusId[] = $l;
		$l->setTermRelatedByStatusId($this);
	}


	
	public function getRepositorysRelatedByStatusIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorysRelatedByStatusId === null) {
			if ($this->isNew()) {
				$this->collRepositorysRelatedByStatusId = array();
			} else {

				$criteria->add(RepositoryPeer::STATUS_ID, $this->getId());

				$this->collRepositorysRelatedByStatusId = RepositoryPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryPeer::STATUS_ID, $this->getId());

			if (!isset($this->lastRepositoryRelatedByStatusIdCriteria) || !$this->lastRepositoryRelatedByStatusIdCriteria->equals($criteria)) {
				$this->collRepositorysRelatedByStatusId = RepositoryPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastRepositoryRelatedByStatusIdCriteria = $criteria;

		return $this->collRepositorysRelatedByStatusId;
	}

	
	public function initRepositorysRelatedByLevelOfDetailId()
	{
		if ($this->collRepositorysRelatedByLevelOfDetailId === null) {
			$this->collRepositorysRelatedByLevelOfDetailId = array();
		}
	}

	
	public function getRepositorysRelatedByLevelOfDetailId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorysRelatedByLevelOfDetailId === null) {
			if ($this->isNew()) {
			   $this->collRepositorysRelatedByLevelOfDetailId = array();
			} else {

				$criteria->add(RepositoryPeer::LEVEL_OF_DETAIL_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				$this->collRepositorysRelatedByLevelOfDetailId = RepositoryPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepositoryPeer::LEVEL_OF_DETAIL_ID, $this->getId());

				RepositoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepositoryRelatedByLevelOfDetailIdCriteria) || !$this->lastRepositoryRelatedByLevelOfDetailIdCriteria->equals($criteria)) {
					$this->collRepositorysRelatedByLevelOfDetailId = RepositoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepositoryRelatedByLevelOfDetailIdCriteria = $criteria;
		return $this->collRepositorysRelatedByLevelOfDetailId;
	}

	
	public function countRepositorysRelatedByLevelOfDetailId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepositoryPeer::LEVEL_OF_DETAIL_ID, $this->getId());

		return RepositoryPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRepositoryRelatedByLevelOfDetailId(Repository $l)
	{
		$this->collRepositorysRelatedByLevelOfDetailId[] = $l;
		$l->setTermRelatedByLevelOfDetailId($this);
	}


	
	public function getRepositorysRelatedByLevelOfDetailIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositorysRelatedByLevelOfDetailId === null) {
			if ($this->isNew()) {
				$this->collRepositorysRelatedByLevelOfDetailId = array();
			} else {

				$criteria->add(RepositoryPeer::LEVEL_OF_DETAIL_ID, $this->getId());

				$this->collRepositorysRelatedByLevelOfDetailId = RepositoryPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryPeer::LEVEL_OF_DETAIL_ID, $this->getId());

			if (!isset($this->lastRepositoryRelatedByLevelOfDetailIdCriteria) || !$this->lastRepositoryRelatedByLevelOfDetailIdCriteria->equals($criteria)) {
				$this->collRepositorysRelatedByLevelOfDetailId = RepositoryPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastRepositoryRelatedByLevelOfDetailIdCriteria = $criteria;

		return $this->collRepositorysRelatedByLevelOfDetailId;
	}

	
	public function initRepositoryTermRelationshipsRelatedByTermId()
	{
		if ($this->collRepositoryTermRelationshipsRelatedByTermId === null) {
			$this->collRepositoryTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getRepositoryTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositoryTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collRepositoryTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(RepositoryTermRelationshipPeer::TERM_ID, $this->getId());

				RepositoryTermRelationshipPeer::addSelectColumns($criteria);
				$this->collRepositoryTermRelationshipsRelatedByTermId = RepositoryTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepositoryTermRelationshipPeer::TERM_ID, $this->getId());

				RepositoryTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepositoryTermRelationshipRelatedByTermIdCriteria) || !$this->lastRepositoryTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collRepositoryTermRelationshipsRelatedByTermId = RepositoryTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepositoryTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collRepositoryTermRelationshipsRelatedByTermId;
	}

	
	public function countRepositoryTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepositoryTermRelationshipPeer::TERM_ID, $this->getId());

		return RepositoryTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRepositoryTermRelationshipRelatedByTermId(RepositoryTermRelationship $l)
	{
		$this->collRepositoryTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getRepositoryTermRelationshipsRelatedByTermIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositoryTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collRepositoryTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(RepositoryTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collRepositoryTermRelationshipsRelatedByTermId = RepositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastRepositoryTermRelationshipRelatedByTermIdCriteria) || !$this->lastRepositoryTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collRepositoryTermRelationshipsRelatedByTermId = RepositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastRepositoryTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collRepositoryTermRelationshipsRelatedByTermId;
	}

	
	public function initRepositoryTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getRepositoryTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				RepositoryTermRelationshipPeer::addSelectColumns($criteria);
				$this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId = RepositoryTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				RepositoryTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastRepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId = RepositoryTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countRepositoryTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return RepositoryTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRepositoryTermRelationshipRelatedByRelationshipTypeId(RepositoryTermRelationship $l)
	{
		$this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getRepositoryTermRelationshipsRelatedByRelationshipTypeIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId = RepositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(RepositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastRepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastRepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId = RepositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastRepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collRepositoryTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function initTermRecursiveRelationshipsRelatedByTermId()
	{
		if ($this->collTermRecursiveRelationshipsRelatedByTermId === null) {
			$this->collTermRecursiveRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getTermRecursiveRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTermRecursiveRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collTermRecursiveRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(TermRecursiveRelationshipPeer::TERM_ID, $this->getId());

				TermRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collTermRecursiveRelationshipsRelatedByTermId = TermRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TermRecursiveRelationshipPeer::TERM_ID, $this->getId());

				TermRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastTermRecursiveRelationshipRelatedByTermIdCriteria) || !$this->lastTermRecursiveRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collTermRecursiveRelationshipsRelatedByTermId = TermRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTermRecursiveRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collTermRecursiveRelationshipsRelatedByTermId;
	}

	
	public function countTermRecursiveRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TermRecursiveRelationshipPeer::TERM_ID, $this->getId());

		return TermRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTermRecursiveRelationshipRelatedByTermId(TermRecursiveRelationship $l)
	{
		$this->collTermRecursiveRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}

	
	public function initTermRecursiveRelationshipsRelatedByRelatedTermId()
	{
		if ($this->collTermRecursiveRelationshipsRelatedByRelatedTermId === null) {
			$this->collTermRecursiveRelationshipsRelatedByRelatedTermId = array();
		}
	}

	
	public function getTermRecursiveRelationshipsRelatedByRelatedTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTermRecursiveRelationshipsRelatedByRelatedTermId === null) {
			if ($this->isNew()) {
			   $this->collTermRecursiveRelationshipsRelatedByRelatedTermId = array();
			} else {

				$criteria->add(TermRecursiveRelationshipPeer::RELATED_TERM_ID, $this->getId());

				TermRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collTermRecursiveRelationshipsRelatedByRelatedTermId = TermRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TermRecursiveRelationshipPeer::RELATED_TERM_ID, $this->getId());

				TermRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastTermRecursiveRelationshipRelatedByRelatedTermIdCriteria) || !$this->lastTermRecursiveRelationshipRelatedByRelatedTermIdCriteria->equals($criteria)) {
					$this->collTermRecursiveRelationshipsRelatedByRelatedTermId = TermRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTermRecursiveRelationshipRelatedByRelatedTermIdCriteria = $criteria;
		return $this->collTermRecursiveRelationshipsRelatedByRelatedTermId;
	}

	
	public function countTermRecursiveRelationshipsRelatedByRelatedTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TermRecursiveRelationshipPeer::RELATED_TERM_ID, $this->getId());

		return TermRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTermRecursiveRelationshipRelatedByRelatedTermId(TermRecursiveRelationship $l)
	{
		$this->collTermRecursiveRelationshipsRelatedByRelatedTermId[] = $l;
		$l->setTermRelatedByRelatedTermId($this);
	}

	
	public function initTermRecursiveRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getTermRecursiveRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(TermRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				TermRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId = TermRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TermRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				TermRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastTermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastTermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId = TermRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countTermRecursiveRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TermRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return TermRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTermRecursiveRelationshipRelatedByRelationshipTypeId(TermRecursiveRelationship $l)
	{
		$this->collTermRecursiveRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}

	
	public function initEventsRelatedByEventTypeId()
	{
		if ($this->collEventsRelatedByEventTypeId === null) {
			$this->collEventsRelatedByEventTypeId = array();
		}
	}

	
	public function getEventsRelatedByEventTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventsRelatedByEventTypeId === null) {
			if ($this->isNew()) {
			   $this->collEventsRelatedByEventTypeId = array();
			} else {

				$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEventsRelatedByEventTypeId = EventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventRelatedByEventTypeIdCriteria) || !$this->lastEventRelatedByEventTypeIdCriteria->equals($criteria)) {
					$this->collEventsRelatedByEventTypeId = EventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventRelatedByEventTypeIdCriteria = $criteria;
		return $this->collEventsRelatedByEventTypeId;
	}

	
	public function countEventsRelatedByEventTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventRelatedByEventTypeId(Event $l)
	{
		$this->collEventsRelatedByEventTypeId[] = $l;
		$l->setTermRelatedByEventTypeId($this);
	}


	
	public function getEventsRelatedByEventTypeIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventsRelatedByEventTypeId === null) {
			if ($this->isNew()) {
				$this->collEventsRelatedByEventTypeId = array();
			} else {

				$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

				$this->collEventsRelatedByEventTypeId = EventPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

			if (!isset($this->lastEventRelatedByEventTypeIdCriteria) || !$this->lastEventRelatedByEventTypeIdCriteria->equals($criteria)) {
				$this->collEventsRelatedByEventTypeId = EventPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastEventRelatedByEventTypeIdCriteria = $criteria;

		return $this->collEventsRelatedByEventTypeId;
	}


	
	public function getEventsRelatedByEventTypeIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventsRelatedByEventTypeId === null) {
			if ($this->isNew()) {
				$this->collEventsRelatedByEventTypeId = array();
			} else {

				$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

				$this->collEventsRelatedByEventTypeId = EventPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

			if (!isset($this->lastEventRelatedByEventTypeIdCriteria) || !$this->lastEventRelatedByEventTypeIdCriteria->equals($criteria)) {
				$this->collEventsRelatedByEventTypeId = EventPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastEventRelatedByEventTypeIdCriteria = $criteria;

		return $this->collEventsRelatedByEventTypeId;
	}

	
	public function initEventsRelatedByActorRoleId()
	{
		if ($this->collEventsRelatedByActorRoleId === null) {
			$this->collEventsRelatedByActorRoleId = array();
		}
	}

	
	public function getEventsRelatedByActorRoleId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventsRelatedByActorRoleId === null) {
			if ($this->isNew()) {
			   $this->collEventsRelatedByActorRoleId = array();
			} else {

				$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEventsRelatedByActorRoleId = EventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventRelatedByActorRoleIdCriteria) || !$this->lastEventRelatedByActorRoleIdCriteria->equals($criteria)) {
					$this->collEventsRelatedByActorRoleId = EventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventRelatedByActorRoleIdCriteria = $criteria;
		return $this->collEventsRelatedByActorRoleId;
	}

	
	public function countEventsRelatedByActorRoleId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventRelatedByActorRoleId(Event $l)
	{
		$this->collEventsRelatedByActorRoleId[] = $l;
		$l->setTermRelatedByActorRoleId($this);
	}


	
	public function getEventsRelatedByActorRoleIdJoinInformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventsRelatedByActorRoleId === null) {
			if ($this->isNew()) {
				$this->collEventsRelatedByActorRoleId = array();
			} else {

				$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

				$this->collEventsRelatedByActorRoleId = EventPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

			if (!isset($this->lastEventRelatedByActorRoleIdCriteria) || !$this->lastEventRelatedByActorRoleIdCriteria->equals($criteria)) {
				$this->collEventsRelatedByActorRoleId = EventPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastEventRelatedByActorRoleIdCriteria = $criteria;

		return $this->collEventsRelatedByActorRoleId;
	}


	
	public function getEventsRelatedByActorRoleIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventsRelatedByActorRoleId === null) {
			if ($this->isNew()) {
				$this->collEventsRelatedByActorRoleId = array();
			} else {

				$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

				$this->collEventsRelatedByActorRoleId = EventPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

			if (!isset($this->lastEventRelatedByActorRoleIdCriteria) || !$this->lastEventRelatedByActorRoleIdCriteria->equals($criteria)) {
				$this->collEventsRelatedByActorRoleId = EventPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastEventRelatedByActorRoleIdCriteria = $criteria;

		return $this->collEventsRelatedByActorRoleId;
	}

	
	public function initEventTermRelationshipsRelatedByTermId()
	{
		if ($this->collEventTermRelationshipsRelatedByTermId === null) {
			$this->collEventTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getEventTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collEventTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(EventTermRelationshipPeer::TERM_ID, $this->getId());

				EventTermRelationshipPeer::addSelectColumns($criteria);
				$this->collEventTermRelationshipsRelatedByTermId = EventTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventTermRelationshipPeer::TERM_ID, $this->getId());

				EventTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventTermRelationshipRelatedByTermIdCriteria) || !$this->lastEventTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collEventTermRelationshipsRelatedByTermId = EventTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collEventTermRelationshipsRelatedByTermId;
	}

	
	public function countEventTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventTermRelationshipPeer::TERM_ID, $this->getId());

		return EventTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventTermRelationshipRelatedByTermId(EventTermRelationship $l)
	{
		$this->collEventTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getEventTermRelationshipsRelatedByTermIdJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collEventTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(EventTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collEventTermRelationshipsRelatedByTermId = EventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(EventTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastEventTermRelationshipRelatedByTermIdCriteria) || !$this->lastEventTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collEventTermRelationshipsRelatedByTermId = EventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lastEventTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collEventTermRelationshipsRelatedByTermId;
	}

	
	public function initEventTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collEventTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collEventTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getEventTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collEventTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(EventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				EventTermRelationshipPeer::addSelectColumns($criteria);
				$this->collEventTermRelationshipsRelatedByRelationshipTypeId = EventTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(EventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				EventTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastEventTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collEventTermRelationshipsRelatedByRelationshipTypeId = EventTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collEventTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countEventTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseEventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return EventTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addEventTermRelationshipRelatedByRelationshipTypeId(EventTermRelationship $l)
	{
		$this->collEventTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getEventTermRelationshipsRelatedByRelationshipTypeIdJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseEventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEventTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collEventTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(EventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collEventTermRelationshipsRelatedByRelationshipTypeId = EventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(EventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastEventTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastEventTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collEventTermRelationshipsRelatedByRelationshipTypeId = EventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lastEventTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collEventTermRelationshipsRelatedByRelationshipTypeId;
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

				$criteria->add(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

				SystemEventPeer::addSelectColumns($criteria);
				$this->collSystemEvents = SystemEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

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

		$criteria->add(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

		return SystemEventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSystemEvent(SystemEvent $l)
	{
		$this->collSystemEvents[] = $l;
		$l->setTerm($this);
	}


	
	public function getSystemEventsJoinUser($criteria = null, $con = null)
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

				$criteria->add(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

				$this->collSystemEvents = SystemEventPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

			if (!isset($this->lastSystemEventCriteria) || !$this->lastSystemEventCriteria->equals($criteria)) {
				$this->collSystemEvents = SystemEventPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastSystemEventCriteria = $criteria;

		return $this->collSystemEvents;
	}

	
	public function initHistoricalEventsRelatedByTermId()
	{
		if ($this->collHistoricalEventsRelatedByTermId === null) {
			$this->collHistoricalEventsRelatedByTermId = array();
		}
	}

	
	public function getHistoricalEventsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistoricalEventsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collHistoricalEventsRelatedByTermId = array();
			} else {

				$criteria->add(HistoricalEventPeer::TERM_ID, $this->getId());

				HistoricalEventPeer::addSelectColumns($criteria);
				$this->collHistoricalEventsRelatedByTermId = HistoricalEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HistoricalEventPeer::TERM_ID, $this->getId());

				HistoricalEventPeer::addSelectColumns($criteria);
				if (!isset($this->lastHistoricalEventRelatedByTermIdCriteria) || !$this->lastHistoricalEventRelatedByTermIdCriteria->equals($criteria)) {
					$this->collHistoricalEventsRelatedByTermId = HistoricalEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHistoricalEventRelatedByTermIdCriteria = $criteria;
		return $this->collHistoricalEventsRelatedByTermId;
	}

	
	public function countHistoricalEventsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HistoricalEventPeer::TERM_ID, $this->getId());

		return HistoricalEventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHistoricalEventRelatedByTermId(HistoricalEvent $l)
	{
		$this->collHistoricalEventsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}

	
	public function initHistoricalEventsRelatedByHistoricalEventTypeId()
	{
		if ($this->collHistoricalEventsRelatedByHistoricalEventTypeId === null) {
			$this->collHistoricalEventsRelatedByHistoricalEventTypeId = array();
		}
	}

	
	public function getHistoricalEventsRelatedByHistoricalEventTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistoricalEventsRelatedByHistoricalEventTypeId === null) {
			if ($this->isNew()) {
			   $this->collHistoricalEventsRelatedByHistoricalEventTypeId = array();
			} else {

				$criteria->add(HistoricalEventPeer::HISTORICAL_EVENT_TYPE_ID, $this->getId());

				HistoricalEventPeer::addSelectColumns($criteria);
				$this->collHistoricalEventsRelatedByHistoricalEventTypeId = HistoricalEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HistoricalEventPeer::HISTORICAL_EVENT_TYPE_ID, $this->getId());

				HistoricalEventPeer::addSelectColumns($criteria);
				if (!isset($this->lastHistoricalEventRelatedByHistoricalEventTypeIdCriteria) || !$this->lastHistoricalEventRelatedByHistoricalEventTypeIdCriteria->equals($criteria)) {
					$this->collHistoricalEventsRelatedByHistoricalEventTypeId = HistoricalEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHistoricalEventRelatedByHistoricalEventTypeIdCriteria = $criteria;
		return $this->collHistoricalEventsRelatedByHistoricalEventTypeId;
	}

	
	public function countHistoricalEventsRelatedByHistoricalEventTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HistoricalEventPeer::HISTORICAL_EVENT_TYPE_ID, $this->getId());

		return HistoricalEventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHistoricalEventRelatedByHistoricalEventTypeId(HistoricalEvent $l)
	{
		$this->collHistoricalEventsRelatedByHistoricalEventTypeId[] = $l;
		$l->setTermRelatedByHistoricalEventTypeId($this);
	}

	
	public function initFunctionDescriptionsRelatedByTermId()
	{
		if ($this->collFunctionDescriptionsRelatedByTermId === null) {
			$this->collFunctionDescriptionsRelatedByTermId = array();
		}
	}

	
	public function getFunctionDescriptionsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFunctionDescriptionsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collFunctionDescriptionsRelatedByTermId = array();
			} else {

				$criteria->add(FunctionDescriptionPeer::TERM_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				$this->collFunctionDescriptionsRelatedByTermId = FunctionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FunctionDescriptionPeer::TERM_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastFunctionDescriptionRelatedByTermIdCriteria) || !$this->lastFunctionDescriptionRelatedByTermIdCriteria->equals($criteria)) {
					$this->collFunctionDescriptionsRelatedByTermId = FunctionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFunctionDescriptionRelatedByTermIdCriteria = $criteria;
		return $this->collFunctionDescriptionsRelatedByTermId;
	}

	
	public function countFunctionDescriptionsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FunctionDescriptionPeer::TERM_ID, $this->getId());

		return FunctionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFunctionDescriptionRelatedByTermId(FunctionDescription $l)
	{
		$this->collFunctionDescriptionsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}

	
	public function initFunctionDescriptionsRelatedByFunctionDescriptionTypeId()
	{
		if ($this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId === null) {
			$this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId = array();
		}
	}

	
	public function getFunctionDescriptionsRelatedByFunctionDescriptionTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId === null) {
			if ($this->isNew()) {
			   $this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId = array();
			} else {

				$criteria->add(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				$this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId = FunctionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastFunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria) || !$this->lastFunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria->equals($criteria)) {
					$this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId = FunctionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria = $criteria;
		return $this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId;
	}

	
	public function countFunctionDescriptionsRelatedByFunctionDescriptionTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, $this->getId());

		return FunctionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFunctionDescriptionRelatedByFunctionDescriptionTypeId(FunctionDescription $l)
	{
		$this->collFunctionDescriptionsRelatedByFunctionDescriptionTypeId[] = $l;
		$l->setTermRelatedByFunctionDescriptionTypeId($this);
	}

	
	public function initFunctionDescriptionsRelatedByStatusId()
	{
		if ($this->collFunctionDescriptionsRelatedByStatusId === null) {
			$this->collFunctionDescriptionsRelatedByStatusId = array();
		}
	}

	
	public function getFunctionDescriptionsRelatedByStatusId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFunctionDescriptionsRelatedByStatusId === null) {
			if ($this->isNew()) {
			   $this->collFunctionDescriptionsRelatedByStatusId = array();
			} else {

				$criteria->add(FunctionDescriptionPeer::STATUS_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				$this->collFunctionDescriptionsRelatedByStatusId = FunctionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FunctionDescriptionPeer::STATUS_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastFunctionDescriptionRelatedByStatusIdCriteria) || !$this->lastFunctionDescriptionRelatedByStatusIdCriteria->equals($criteria)) {
					$this->collFunctionDescriptionsRelatedByStatusId = FunctionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFunctionDescriptionRelatedByStatusIdCriteria = $criteria;
		return $this->collFunctionDescriptionsRelatedByStatusId;
	}

	
	public function countFunctionDescriptionsRelatedByStatusId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FunctionDescriptionPeer::STATUS_ID, $this->getId());

		return FunctionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFunctionDescriptionRelatedByStatusId(FunctionDescription $l)
	{
		$this->collFunctionDescriptionsRelatedByStatusId[] = $l;
		$l->setTermRelatedByStatusId($this);
	}

	
	public function initFunctionDescriptionsRelatedByLevelId()
	{
		if ($this->collFunctionDescriptionsRelatedByLevelId === null) {
			$this->collFunctionDescriptionsRelatedByLevelId = array();
		}
	}

	
	public function getFunctionDescriptionsRelatedByLevelId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFunctionDescriptionsRelatedByLevelId === null) {
			if ($this->isNew()) {
			   $this->collFunctionDescriptionsRelatedByLevelId = array();
			} else {

				$criteria->add(FunctionDescriptionPeer::LEVEL_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				$this->collFunctionDescriptionsRelatedByLevelId = FunctionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FunctionDescriptionPeer::LEVEL_ID, $this->getId());

				FunctionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastFunctionDescriptionRelatedByLevelIdCriteria) || !$this->lastFunctionDescriptionRelatedByLevelIdCriteria->equals($criteria)) {
					$this->collFunctionDescriptionsRelatedByLevelId = FunctionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFunctionDescriptionRelatedByLevelIdCriteria = $criteria;
		return $this->collFunctionDescriptionsRelatedByLevelId;
	}

	
	public function countFunctionDescriptionsRelatedByLevelId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FunctionDescriptionPeer::LEVEL_ID, $this->getId());

		return FunctionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFunctionDescriptionRelatedByLevelId(FunctionDescription $l)
	{
		$this->collFunctionDescriptionsRelatedByLevelId[] = $l;
		$l->setTermRelatedByLevelId($this);
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

				$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

				RightPeer::addSelectColumns($criteria);
				$this->collRights = RightPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

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

		$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

		return RightPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRight(Right $l)
	{
		$this->collRights[] = $l;
		$l->setTerm($this);
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

				$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinInformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinInformationObject($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
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

				$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinDigitalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

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

				$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinPhysicalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinPhysicalObject($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}

	
	public function initRightTermRelationshipsRelatedByTermId()
	{
		if ($this->collRightTermRelationshipsRelatedByTermId === null) {
			$this->collRightTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getRightTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRightTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collRightTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(RightTermRelationshipPeer::TERM_ID, $this->getId());

				RightTermRelationshipPeer::addSelectColumns($criteria);
				$this->collRightTermRelationshipsRelatedByTermId = RightTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RightTermRelationshipPeer::TERM_ID, $this->getId());

				RightTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastRightTermRelationshipRelatedByTermIdCriteria) || !$this->lastRightTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collRightTermRelationshipsRelatedByTermId = RightTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRightTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collRightTermRelationshipsRelatedByTermId;
	}

	
	public function countRightTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RightTermRelationshipPeer::TERM_ID, $this->getId());

		return RightTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRightTermRelationshipRelatedByTermId(RightTermRelationship $l)
	{
		$this->collRightTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getRightTermRelationshipsRelatedByTermIdJoinRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRightTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collRightTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(RightTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collRightTermRelationshipsRelatedByTermId = RightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(RightTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastRightTermRelationshipRelatedByTermIdCriteria) || !$this->lastRightTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collRightTermRelationshipsRelatedByTermId = RightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastRightTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collRightTermRelationshipsRelatedByTermId;
	}

	
	public function initRightTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collRightTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collRightTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getRightTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRightTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collRightTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				RightTermRelationshipPeer::addSelectColumns($criteria);
				$this->collRightTermRelationshipsRelatedByRelationshipTypeId = RightTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				RightTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastRightTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastRightTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collRightTermRelationshipsRelatedByRelationshipTypeId = RightTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRightTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collRightTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countRightTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseRightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return RightTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRightTermRelationshipRelatedByRelationshipTypeId(RightTermRelationship $l)
	{
		$this->collRightTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getRightTermRelationshipsRelatedByRelationshipTypeIdJoinRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseRightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRightTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collRightTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collRightTermRelationshipsRelatedByRelationshipTypeId = RightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastRightTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastRightTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collRightTermRelationshipsRelatedByRelationshipTypeId = RightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastRightTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collRightTermRelationshipsRelatedByRelationshipTypeId;
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

				$criteria->add(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				RightActorRelationshipPeer::addSelectColumns($criteria);
				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

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

		$criteria->add(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return RightActorRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addRightActorRelationship(RightActorRelationship $l)
	{
		$this->collRightActorRelationships[] = $l;
		$l->setTerm($this);
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

				$criteria->add(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastRightActorRelationshipCriteria) || !$this->lastRightActorRelationshipCriteria->equals($criteria)) {
				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastRightActorRelationshipCriteria = $criteria;

		return $this->collRightActorRelationships;
	}


	
	public function getRightActorRelationshipsJoinActor($criteria = null, $con = null)
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

				$criteria->add(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastRightActorRelationshipCriteria) || !$this->lastRightActorRelationshipCriteria->equals($criteria)) {
				$this->collRightActorRelationships = RightActorRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastRightActorRelationshipCriteria = $criteria;

		return $this->collRightActorRelationships;
	}

	
	public function initUserTermRelationshipsRelatedByTermId()
	{
		if ($this->collUserTermRelationshipsRelatedByTermId === null) {
			$this->collUserTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getUserTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collUserTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::TERM_ID, $this->getId());

				UserTermRelationshipPeer::addSelectColumns($criteria);
				$this->collUserTermRelationshipsRelatedByTermId = UserTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTermRelationshipPeer::TERM_ID, $this->getId());

				UserTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserTermRelationshipRelatedByTermIdCriteria) || !$this->lastUserTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collUserTermRelationshipsRelatedByTermId = UserTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collUserTermRelationshipsRelatedByTermId;
	}

	
	public function countUserTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserTermRelationshipPeer::TERM_ID, $this->getId());

		return UserTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserTermRelationshipRelatedByTermId(UserTermRelationship $l)
	{
		$this->collUserTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getUserTermRelationshipsRelatedByTermIdJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collUserTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collUserTermRelationshipsRelatedByTermId = UserTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(UserTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastUserTermRelationshipRelatedByTermIdCriteria) || !$this->lastUserTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collUserTermRelationshipsRelatedByTermId = UserTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastUserTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collUserTermRelationshipsRelatedByTermId;
	}


	
	public function getUserTermRelationshipsRelatedByTermIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collUserTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collUserTermRelationshipsRelatedByTermId = UserTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(UserTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastUserTermRelationshipRelatedByTermIdCriteria) || !$this->lastUserTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collUserTermRelationshipsRelatedByTermId = UserTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastUserTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collUserTermRelationshipsRelatedByTermId;
	}

	
	public function initUserTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collUserTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collUserTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getUserTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collUserTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				UserTermRelationshipPeer::addSelectColumns($criteria);
				$this->collUserTermRelationshipsRelatedByRelationshipTypeId = UserTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UserTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				UserTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collUserTermRelationshipsRelatedByRelationshipTypeId = UserTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collUserTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countUserTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UserTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return UserTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUserTermRelationshipRelatedByRelationshipTypeId(UserTermRelationship $l)
	{
		$this->collUserTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getUserTermRelationshipsRelatedByRelationshipTypeIdJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collUserTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collUserTermRelationshipsRelatedByRelationshipTypeId = UserTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(UserTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collUserTermRelationshipsRelatedByRelationshipTypeId = UserTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collUserTermRelationshipsRelatedByRelationshipTypeId;
	}


	
	public function getUserTermRelationshipsRelatedByRelationshipTypeIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUserTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collUserTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(UserTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collUserTermRelationshipsRelatedByRelationshipTypeId = UserTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(UserTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collUserTermRelationshipsRelatedByRelationshipTypeId = UserTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastUserTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collUserTermRelationshipsRelatedByRelationshipTypeId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTerm:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTerm::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 