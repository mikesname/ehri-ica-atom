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

	
	protected $collinformationObjectsRelatedByLevelOfDescriptionId;

	
	protected $lastinformationObjectRelatedByLevelOfDescriptionIdCriteria = null;

	
	protected $collinformationObjectsRelatedByCollectionTypeId;

	
	protected $lastinformationObjectRelatedByCollectionTypeIdCriteria = null;

	
	protected $collinformationObjectTermRelationshipsRelatedByTermId;

	
	protected $lastinformationObjectTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collinformationObjectTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastinformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collinformationObjectRecursiveRelationships;

	
	protected $lastinformationObjectRecursiveRelationshipCriteria = null;

	
	protected $collNotes;

	
	protected $lastNoteCriteria = null;

	
	protected $colldigitalObjectsRelatedByUseageId;

	
	protected $lastdigitalObjectRelatedByUseageIdCriteria = null;

	
	protected $colldigitalObjectsRelatedByMimeTypeId;

	
	protected $lastdigitalObjectRelatedByMimeTypeIdCriteria = null;

	
	protected $colldigitalObjectsRelatedByMediaTypeId;

	
	protected $lastdigitalObjectRelatedByMediaTypeIdCriteria = null;

	
	protected $colldigitalObjectsRelatedByChecksumTypeId;

	
	protected $lastdigitalObjectRelatedByChecksumTypeIdCriteria = null;

	
	protected $colldigitalObjectsRelatedByLocationId;

	
	protected $lastdigitalObjectRelatedByLocationIdCriteria = null;

	
	protected $colldigitalObjectRecursiveRelationships;

	
	protected $lastdigitalObjectRecursiveRelationshipCriteria = null;

	
	protected $collphysicalObjects;

	
	protected $lastphysicalObjectCriteria = null;

	
	protected $collActorsRelatedByTypeOfEntityId;

	
	protected $lastActorRelatedByTypeOfEntityIdCriteria = null;

	
	protected $collActorsRelatedByStatusId;

	
	protected $lastActorRelatedByStatusIdCriteria = null;

	
	protected $collActorsRelatedByLevelOfDetailId;

	
	protected $lastActorRelatedByLevelOfDetailIdCriteria = null;

	
	protected $collactorNames;

	
	protected $lastactorNameCriteria = null;

	
	protected $collactorRecursiveRelationships;

	
	protected $lastactorRecursiveRelationshipCriteria = null;

	
	protected $collactorTermRelationshipsRelatedByTermId;

	
	protected $lastactorTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collactorTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastactorTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collcontactInformations;

	
	protected $lastcontactInformationCriteria = null;

	
	protected $collPlacesRelatedByTermId;

	
	protected $lastPlaceRelatedByTermIdCriteria = null;

	
	protected $collPlacesRelatedByCountryId;

	
	protected $lastPlaceRelatedByCountryIdCriteria = null;

	
	protected $collPlacesRelatedByPlaceTypeId;

	
	protected $lastPlaceRelatedByPlaceTypeIdCriteria = null;

	
	protected $collplaceMapRelationships;

	
	protected $lastplaceMapRelationshipCriteria = null;

	
	protected $collRepositorysRelatedByRepositoryTypeId;

	
	protected $lastRepositoryRelatedByRepositoryTypeIdCriteria = null;

	
	protected $collRepositorysRelatedByStatusId;

	
	protected $lastRepositoryRelatedByStatusIdCriteria = null;

	
	protected $collRepositorysRelatedByLevelOfDetailId;

	
	protected $lastRepositoryRelatedByLevelOfDetailIdCriteria = null;

	
	protected $collrepositoryTermRelationshipsRelatedByTermId;

	
	protected $lastrepositoryTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collrepositoryTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastrepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $colltermRecursiveRelationshipsRelatedByTermId;

	
	protected $lasttermRecursiveRelationshipRelatedByTermIdCriteria = null;

	
	protected $colltermRecursiveRelationshipsRelatedByRelatedTermId;

	
	protected $lasttermRecursiveRelationshipRelatedByRelatedTermIdCriteria = null;

	
	protected $colltermRecursiveRelationshipsRelatedByRelationshipTypeId;

	
	protected $lasttermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collEventsRelatedByEventTypeId;

	
	protected $lastEventRelatedByEventTypeIdCriteria = null;

	
	protected $collEventsRelatedByActorRoleId;

	
	protected $lastEventRelatedByActorRoleIdCriteria = null;

	
	protected $colleventTermRelationshipsRelatedByTermId;

	
	protected $lasteventTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $colleventTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lasteventTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collsystemEvents;

	
	protected $lastsystemEventCriteria = null;

	
	protected $collhistoricalEventsRelatedByTermId;

	
	protected $lasthistoricalEventRelatedByTermIdCriteria = null;

	
	protected $collhistoricalEventsRelatedByHistoricalEventTypeId;

	
	protected $lasthistoricalEventRelatedByHistoricalEventTypeIdCriteria = null;

	
	protected $collfunctionDescriptionsRelatedByTermId;

	
	protected $lastfunctionDescriptionRelatedByTermIdCriteria = null;

	
	protected $collfunctionDescriptionsRelatedByFunctionDescriptionTypeId;

	
	protected $lastfunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria = null;

	
	protected $collfunctionDescriptionsRelatedByStatusId;

	
	protected $lastfunctionDescriptionRelatedByStatusIdCriteria = null;

	
	protected $collfunctionDescriptionsRelatedByLevelId;

	
	protected $lastfunctionDescriptionRelatedByLevelIdCriteria = null;

	
	protected $collRights;

	
	protected $lastRightCriteria = null;

	
	protected $collrightTermRelationshipsRelatedByTermId;

	
	protected $lastrightTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $collrightTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastrightTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $collrightActorRelationshipsRelatedByActorId;

	
	protected $lastrightActorRelationshipRelatedByActorIdCriteria = null;

	
	protected $collrightActorRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastrightActorRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
	protected $colluserTermRelationshipsRelatedByTermId;

	
	protected $lastuserTermRelationshipRelatedByTermIdCriteria = null;

	
	protected $colluserTermRelationshipsRelatedByRelationshipTypeId;

	
	protected $lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria = null;

	
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

			if ($this->collinformationObjectsRelatedByLevelOfDescriptionId !== null) {
				foreach($this->collinformationObjectsRelatedByLevelOfDescriptionId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collinformationObjectsRelatedByCollectionTypeId !== null) {
				foreach($this->collinformationObjectsRelatedByCollectionTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collinformationObjectTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collinformationObjectTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collinformationObjectRecursiveRelationships !== null) {
				foreach($this->collinformationObjectRecursiveRelationships as $referrerFK) {
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

			if ($this->colldigitalObjectsRelatedByUseageId !== null) {
				foreach($this->colldigitalObjectsRelatedByUseageId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colldigitalObjectsRelatedByMimeTypeId !== null) {
				foreach($this->colldigitalObjectsRelatedByMimeTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colldigitalObjectsRelatedByMediaTypeId !== null) {
				foreach($this->colldigitalObjectsRelatedByMediaTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colldigitalObjectsRelatedByChecksumTypeId !== null) {
				foreach($this->colldigitalObjectsRelatedByChecksumTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colldigitalObjectsRelatedByLocationId !== null) {
				foreach($this->colldigitalObjectsRelatedByLocationId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colldigitalObjectRecursiveRelationships !== null) {
				foreach($this->colldigitalObjectRecursiveRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collphysicalObjects !== null) {
				foreach($this->collphysicalObjects as $referrerFK) {
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

			if ($this->collactorNames !== null) {
				foreach($this->collactorNames as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collactorRecursiveRelationships !== null) {
				foreach($this->collactorRecursiveRelationships as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collactorTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collactorTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collactorTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collactorTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collcontactInformations !== null) {
				foreach($this->collcontactInformations as $referrerFK) {
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

			if ($this->collplaceMapRelationships !== null) {
				foreach($this->collplaceMapRelationships as $referrerFK) {
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

			if ($this->collrepositoryTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collrepositoryTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colltermRecursiveRelationshipsRelatedByTermId !== null) {
				foreach($this->colltermRecursiveRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colltermRecursiveRelationshipsRelatedByRelatedTermId !== null) {
				foreach($this->colltermRecursiveRelationshipsRelatedByRelatedTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

			if ($this->colleventTermRelationshipsRelatedByTermId !== null) {
				foreach($this->colleventTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colleventTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->colleventTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collsystemEvents !== null) {
				foreach($this->collsystemEvents as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collhistoricalEventsRelatedByTermId !== null) {
				foreach($this->collhistoricalEventsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collhistoricalEventsRelatedByHistoricalEventTypeId !== null) {
				foreach($this->collhistoricalEventsRelatedByHistoricalEventTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collfunctionDescriptionsRelatedByTermId !== null) {
				foreach($this->collfunctionDescriptionsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId !== null) {
				foreach($this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collfunctionDescriptionsRelatedByStatusId !== null) {
				foreach($this->collfunctionDescriptionsRelatedByStatusId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collfunctionDescriptionsRelatedByLevelId !== null) {
				foreach($this->collfunctionDescriptionsRelatedByLevelId as $referrerFK) {
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

			if ($this->collrightTermRelationshipsRelatedByTermId !== null) {
				foreach($this->collrightTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collrightTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collrightTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collrightActorRelationshipsRelatedByActorId !== null) {
				foreach($this->collrightActorRelationshipsRelatedByActorId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collrightActorRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->collrightActorRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colluserTermRelationshipsRelatedByTermId !== null) {
				foreach($this->colluserTermRelationshipsRelatedByTermId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->colluserTermRelationshipsRelatedByRelationshipTypeId !== null) {
				foreach($this->colluserTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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


				if ($this->collinformationObjectsRelatedByLevelOfDescriptionId !== null) {
					foreach($this->collinformationObjectsRelatedByLevelOfDescriptionId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collinformationObjectsRelatedByCollectionTypeId !== null) {
					foreach($this->collinformationObjectsRelatedByCollectionTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collinformationObjectTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collinformationObjectTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collinformationObjectRecursiveRelationships !== null) {
					foreach($this->collinformationObjectRecursiveRelationships as $referrerFK) {
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

				if ($this->colldigitalObjectsRelatedByUseageId !== null) {
					foreach($this->colldigitalObjectsRelatedByUseageId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colldigitalObjectsRelatedByMimeTypeId !== null) {
					foreach($this->colldigitalObjectsRelatedByMimeTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colldigitalObjectsRelatedByMediaTypeId !== null) {
					foreach($this->colldigitalObjectsRelatedByMediaTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colldigitalObjectsRelatedByChecksumTypeId !== null) {
					foreach($this->colldigitalObjectsRelatedByChecksumTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colldigitalObjectsRelatedByLocationId !== null) {
					foreach($this->colldigitalObjectsRelatedByLocationId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colldigitalObjectRecursiveRelationships !== null) {
					foreach($this->colldigitalObjectRecursiveRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collphysicalObjects !== null) {
					foreach($this->collphysicalObjects as $referrerFK) {
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

				if ($this->collactorNames !== null) {
					foreach($this->collactorNames as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collactorRecursiveRelationships !== null) {
					foreach($this->collactorRecursiveRelationships as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collactorTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collactorTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collactorTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collactorTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collcontactInformations !== null) {
					foreach($this->collcontactInformations as $referrerFK) {
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

				if ($this->collplaceMapRelationships !== null) {
					foreach($this->collplaceMapRelationships as $referrerFK) {
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

				if ($this->collrepositoryTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collrepositoryTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colltermRecursiveRelationshipsRelatedByTermId !== null) {
					foreach($this->colltermRecursiveRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colltermRecursiveRelationshipsRelatedByRelatedTermId !== null) {
					foreach($this->colltermRecursiveRelationshipsRelatedByRelatedTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

				if ($this->colleventTermRelationshipsRelatedByTermId !== null) {
					foreach($this->colleventTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colleventTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->colleventTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collsystemEvents !== null) {
					foreach($this->collsystemEvents as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collhistoricalEventsRelatedByTermId !== null) {
					foreach($this->collhistoricalEventsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collhistoricalEventsRelatedByHistoricalEventTypeId !== null) {
					foreach($this->collhistoricalEventsRelatedByHistoricalEventTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collfunctionDescriptionsRelatedByTermId !== null) {
					foreach($this->collfunctionDescriptionsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId !== null) {
					foreach($this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collfunctionDescriptionsRelatedByStatusId !== null) {
					foreach($this->collfunctionDescriptionsRelatedByStatusId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collfunctionDescriptionsRelatedByLevelId !== null) {
					foreach($this->collfunctionDescriptionsRelatedByLevelId as $referrerFK) {
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

				if ($this->collrightTermRelationshipsRelatedByTermId !== null) {
					foreach($this->collrightTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collrightTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collrightTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collrightActorRelationshipsRelatedByActorId !== null) {
					foreach($this->collrightActorRelationshipsRelatedByActorId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collrightActorRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->collrightActorRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colluserTermRelationshipsRelatedByTermId !== null) {
					foreach($this->colluserTermRelationshipsRelatedByTermId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->colluserTermRelationshipsRelatedByRelationshipTypeId !== null) {
					foreach($this->colluserTermRelationshipsRelatedByRelationshipTypeId as $referrerFK) {
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

			foreach($this->getinformationObjectsRelatedByLevelOfDescriptionId() as $relObj) {
				$copyObj->addinformationObjectRelatedByLevelOfDescriptionId($relObj->copy($deepCopy));
			}

			foreach($this->getinformationObjectsRelatedByCollectionTypeId() as $relObj) {
				$copyObj->addinformationObjectRelatedByCollectionTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getinformationObjectTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addinformationObjectTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getinformationObjectTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addinformationObjectTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getinformationObjectRecursiveRelationships() as $relObj) {
				$copyObj->addinformationObjectRecursiveRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getNotes() as $relObj) {
				$copyObj->addNote($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectsRelatedByUseageId() as $relObj) {
				$copyObj->adddigitalObjectRelatedByUseageId($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectsRelatedByMimeTypeId() as $relObj) {
				$copyObj->adddigitalObjectRelatedByMimeTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectsRelatedByMediaTypeId() as $relObj) {
				$copyObj->adddigitalObjectRelatedByMediaTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectsRelatedByChecksumTypeId() as $relObj) {
				$copyObj->adddigitalObjectRelatedByChecksumTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectsRelatedByLocationId() as $relObj) {
				$copyObj->adddigitalObjectRelatedByLocationId($relObj->copy($deepCopy));
			}

			foreach($this->getdigitalObjectRecursiveRelationships() as $relObj) {
				$copyObj->adddigitalObjectRecursiveRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getphysicalObjects() as $relObj) {
				$copyObj->addphysicalObject($relObj->copy($deepCopy));
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

			foreach($this->getactorNames() as $relObj) {
				$copyObj->addactorName($relObj->copy($deepCopy));
			}

			foreach($this->getactorRecursiveRelationships() as $relObj) {
				$copyObj->addactorRecursiveRelationship($relObj->copy($deepCopy));
			}

			foreach($this->getactorTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addactorTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getactorTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addactorTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getcontactInformations() as $relObj) {
				$copyObj->addcontactInformation($relObj->copy($deepCopy));
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

			foreach($this->getplaceMapRelationships() as $relObj) {
				$copyObj->addplaceMapRelationship($relObj->copy($deepCopy));
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

			foreach($this->getrepositoryTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addrepositoryTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getrepositoryTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addrepositoryTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->gettermRecursiveRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addtermRecursiveRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->gettermRecursiveRelationshipsRelatedByRelatedTermId() as $relObj) {
				$copyObj->addtermRecursiveRelationshipRelatedByRelatedTermId($relObj->copy($deepCopy));
			}

			foreach($this->gettermRecursiveRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addtermRecursiveRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getEventsRelatedByEventTypeId() as $relObj) {
				$copyObj->addEventRelatedByEventTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getEventsRelatedByActorRoleId() as $relObj) {
				$copyObj->addEventRelatedByActorRoleId($relObj->copy($deepCopy));
			}

			foreach($this->geteventTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addeventTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->geteventTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addeventTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getsystemEvents() as $relObj) {
				$copyObj->addsystemEvent($relObj->copy($deepCopy));
			}

			foreach($this->gethistoricalEventsRelatedByTermId() as $relObj) {
				$copyObj->addhistoricalEventRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->gethistoricalEventsRelatedByHistoricalEventTypeId() as $relObj) {
				$copyObj->addhistoricalEventRelatedByHistoricalEventTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getfunctionDescriptionsRelatedByTermId() as $relObj) {
				$copyObj->addfunctionDescriptionRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getfunctionDescriptionsRelatedByFunctionDescriptionTypeId() as $relObj) {
				$copyObj->addfunctionDescriptionRelatedByFunctionDescriptionTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getfunctionDescriptionsRelatedByStatusId() as $relObj) {
				$copyObj->addfunctionDescriptionRelatedByStatusId($relObj->copy($deepCopy));
			}

			foreach($this->getfunctionDescriptionsRelatedByLevelId() as $relObj) {
				$copyObj->addfunctionDescriptionRelatedByLevelId($relObj->copy($deepCopy));
			}

			foreach($this->getRights() as $relObj) {
				$copyObj->addRight($relObj->copy($deepCopy));
			}

			foreach($this->getrightTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->addrightTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getrightTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addrightTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getrightActorRelationshipsRelatedByActorId() as $relObj) {
				$copyObj->addrightActorRelationshipRelatedByActorId($relObj->copy($deepCopy));
			}

			foreach($this->getrightActorRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->addrightActorRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
			}

			foreach($this->getuserTermRelationshipsRelatedByTermId() as $relObj) {
				$copyObj->adduserTermRelationshipRelatedByTermId($relObj->copy($deepCopy));
			}

			foreach($this->getuserTermRelationshipsRelatedByRelationshipTypeId() as $relObj) {
				$copyObj->adduserTermRelationshipRelatedByRelationshipTypeId($relObj->copy($deepCopy));
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

	
	public function initinformationObjectsRelatedByLevelOfDescriptionId()
	{
		if ($this->collinformationObjectsRelatedByLevelOfDescriptionId === null) {
			$this->collinformationObjectsRelatedByLevelOfDescriptionId = array();
		}
	}

	
	public function getinformationObjectsRelatedByLevelOfDescriptionId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectsRelatedByLevelOfDescriptionId === null) {
			if ($this->isNew()) {
			   $this->collinformationObjectsRelatedByLevelOfDescriptionId = array();
			} else {

				$criteria->add(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

				informationObjectPeer::addSelectColumns($criteria);
				$this->collinformationObjectsRelatedByLevelOfDescriptionId = informationObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

				informationObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastinformationObjectRelatedByLevelOfDescriptionIdCriteria) || !$this->lastinformationObjectRelatedByLevelOfDescriptionIdCriteria->equals($criteria)) {
					$this->collinformationObjectsRelatedByLevelOfDescriptionId = informationObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastinformationObjectRelatedByLevelOfDescriptionIdCriteria = $criteria;
		return $this->collinformationObjectsRelatedByLevelOfDescriptionId;
	}

	
	public function countinformationObjectsRelatedByLevelOfDescriptionId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

		return informationObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addinformationObjectRelatedByLevelOfDescriptionId(informationObject $l)
	{
		$this->collinformationObjectsRelatedByLevelOfDescriptionId[] = $l;
		$l->setTermRelatedByLevelOfDescriptionId($this);
	}


	
	public function getinformationObjectsRelatedByLevelOfDescriptionIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectsRelatedByLevelOfDescriptionId === null) {
			if ($this->isNew()) {
				$this->collinformationObjectsRelatedByLevelOfDescriptionId = array();
			} else {

				$criteria->add(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

				$this->collinformationObjectsRelatedByLevelOfDescriptionId = informationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, $this->getId());

			if (!isset($this->lastinformationObjectRelatedByLevelOfDescriptionIdCriteria) || !$this->lastinformationObjectRelatedByLevelOfDescriptionIdCriteria->equals($criteria)) {
				$this->collinformationObjectsRelatedByLevelOfDescriptionId = informationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastinformationObjectRelatedByLevelOfDescriptionIdCriteria = $criteria;

		return $this->collinformationObjectsRelatedByLevelOfDescriptionId;
	}

	
	public function initinformationObjectsRelatedByCollectionTypeId()
	{
		if ($this->collinformationObjectsRelatedByCollectionTypeId === null) {
			$this->collinformationObjectsRelatedByCollectionTypeId = array();
		}
	}

	
	public function getinformationObjectsRelatedByCollectionTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectsRelatedByCollectionTypeId === null) {
			if ($this->isNew()) {
			   $this->collinformationObjectsRelatedByCollectionTypeId = array();
			} else {

				$criteria->add(informationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

				informationObjectPeer::addSelectColumns($criteria);
				$this->collinformationObjectsRelatedByCollectionTypeId = informationObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(informationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

				informationObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastinformationObjectRelatedByCollectionTypeIdCriteria) || !$this->lastinformationObjectRelatedByCollectionTypeIdCriteria->equals($criteria)) {
					$this->collinformationObjectsRelatedByCollectionTypeId = informationObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastinformationObjectRelatedByCollectionTypeIdCriteria = $criteria;
		return $this->collinformationObjectsRelatedByCollectionTypeId;
	}

	
	public function countinformationObjectsRelatedByCollectionTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(informationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

		return informationObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addinformationObjectRelatedByCollectionTypeId(informationObject $l)
	{
		$this->collinformationObjectsRelatedByCollectionTypeId[] = $l;
		$l->setTermRelatedByCollectionTypeId($this);
	}


	
	public function getinformationObjectsRelatedByCollectionTypeIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectsRelatedByCollectionTypeId === null) {
			if ($this->isNew()) {
				$this->collinformationObjectsRelatedByCollectionTypeId = array();
			} else {

				$criteria->add(informationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

				$this->collinformationObjectsRelatedByCollectionTypeId = informationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectPeer::COLLECTION_TYPE_ID, $this->getId());

			if (!isset($this->lastinformationObjectRelatedByCollectionTypeIdCriteria) || !$this->lastinformationObjectRelatedByCollectionTypeIdCriteria->equals($criteria)) {
				$this->collinformationObjectsRelatedByCollectionTypeId = informationObjectPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastinformationObjectRelatedByCollectionTypeIdCriteria = $criteria;

		return $this->collinformationObjectsRelatedByCollectionTypeId;
	}

	
	public function initinformationObjectTermRelationshipsRelatedByTermId()
	{
		if ($this->collinformationObjectTermRelationshipsRelatedByTermId === null) {
			$this->collinformationObjectTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getinformationObjectTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collinformationObjectTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(informationObjectTermRelationshipPeer::TERM_ID, $this->getId());

				informationObjectTermRelationshipPeer::addSelectColumns($criteria);
				$this->collinformationObjectTermRelationshipsRelatedByTermId = informationObjectTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(informationObjectTermRelationshipPeer::TERM_ID, $this->getId());

				informationObjectTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastinformationObjectTermRelationshipRelatedByTermIdCriteria) || !$this->lastinformationObjectTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collinformationObjectTermRelationshipsRelatedByTermId = informationObjectTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastinformationObjectTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collinformationObjectTermRelationshipsRelatedByTermId;
	}

	
	public function countinformationObjectTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(informationObjectTermRelationshipPeer::TERM_ID, $this->getId());

		return informationObjectTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addinformationObjectTermRelationshipRelatedByTermId(informationObjectTermRelationship $l)
	{
		$this->collinformationObjectTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getinformationObjectTermRelationshipsRelatedByTermIdJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collinformationObjectTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(informationObjectTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collinformationObjectTermRelationshipsRelatedByTermId = informationObjectTermRelationshipPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastinformationObjectTermRelationshipRelatedByTermIdCriteria) || !$this->lastinformationObjectTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collinformationObjectTermRelationshipsRelatedByTermId = informationObjectTermRelationshipPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastinformationObjectTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collinformationObjectTermRelationshipsRelatedByTermId;
	}

	
	public function initinformationObjectTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getinformationObjectTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(informationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				informationObjectTermRelationshipPeer::addSelectColumns($criteria);
				$this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId = informationObjectTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(informationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				informationObjectTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastinformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastinformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId = informationObjectTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastinformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countinformationObjectTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(informationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return informationObjectTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addinformationObjectTermRelationshipRelatedByRelationshipTypeId(informationObjectTermRelationship $l)
	{
		$this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getinformationObjectTermRelationshipsRelatedByRelationshipTypeIdJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(informationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId = informationObjectTermRelationshipPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastinformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastinformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId = informationObjectTermRelationshipPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastinformationObjectTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collinformationObjectTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function initinformationObjectRecursiveRelationships()
	{
		if ($this->collinformationObjectRecursiveRelationships === null) {
			$this->collinformationObjectRecursiveRelationships = array();
		}
	}

	
	public function getinformationObjectRecursiveRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
			   $this->collinformationObjectRecursiveRelationships = array();
			} else {

				$criteria->add(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				informationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collinformationObjectRecursiveRelationships = informationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				informationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastinformationObjectRecursiveRelationshipCriteria) || !$this->lastinformationObjectRecursiveRelationshipCriteria->equals($criteria)) {
					$this->collinformationObjectRecursiveRelationships = informationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastinformationObjectRecursiveRelationshipCriteria = $criteria;
		return $this->collinformationObjectRecursiveRelationships;
	}

	
	public function countinformationObjectRecursiveRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return informationObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addinformationObjectRecursiveRelationship(informationObjectRecursiveRelationship $l)
	{
		$this->collinformationObjectRecursiveRelationships[] = $l;
		$l->setTerm($this);
	}


	
	public function getinformationObjectRecursiveRelationshipsJoininformationObjectRelatedByInformationObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collinformationObjectRecursiveRelationships = array();
			} else {

				$criteria->add(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collinformationObjectRecursiveRelationships = informationObjectRecursiveRelationshipPeer::doSelectJoininformationObjectRelatedByInformationObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastinformationObjectRecursiveRelationshipCriteria) || !$this->lastinformationObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collinformationObjectRecursiveRelationships = informationObjectRecursiveRelationshipPeer::doSelectJoininformationObjectRelatedByInformationObjectId($criteria, $con);
			}
		}
		$this->lastinformationObjectRecursiveRelationshipCriteria = $criteria;

		return $this->collinformationObjectRecursiveRelationships;
	}


	
	public function getinformationObjectRecursiveRelationshipsJoininformationObjectRelatedByRelatedInformationObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseinformationObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collinformationObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collinformationObjectRecursiveRelationships = array();
			} else {

				$criteria->add(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collinformationObjectRecursiveRelationships = informationObjectRecursiveRelationshipPeer::doSelectJoininformationObjectRelatedByRelatedInformationObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastinformationObjectRecursiveRelationshipCriteria) || !$this->lastinformationObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collinformationObjectRecursiveRelationships = informationObjectRecursiveRelationshipPeer::doSelectJoininformationObjectRelatedByRelatedInformationObjectId($criteria, $con);
			}
		}
		$this->lastinformationObjectRecursiveRelationshipCriteria = $criteria;

		return $this->collinformationObjectRecursiveRelationships;
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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

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

				$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

				$this->collNotes = NotePeer::doSelectJoinfunctionDescription($criteria, $con);
			}
		} else {
									
			$criteria->add(NotePeer::NOTE_TYPE_ID, $this->getId());

			if (!isset($this->lastNoteCriteria) || !$this->lastNoteCriteria->equals($criteria)) {
				$this->collNotes = NotePeer::doSelectJoinfunctionDescription($criteria, $con);
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

	
	public function initdigitalObjectsRelatedByUseageId()
	{
		if ($this->colldigitalObjectsRelatedByUseageId === null) {
			$this->colldigitalObjectsRelatedByUseageId = array();
		}
	}

	
	public function getdigitalObjectsRelatedByUseageId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByUseageId === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectsRelatedByUseageId = array();
			} else {

				$criteria->add(digitalObjectPeer::USEAGE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				$this->colldigitalObjectsRelatedByUseageId = digitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectPeer::USEAGE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRelatedByUseageIdCriteria) || !$this->lastdigitalObjectRelatedByUseageIdCriteria->equals($criteria)) {
					$this->colldigitalObjectsRelatedByUseageId = digitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRelatedByUseageIdCriteria = $criteria;
		return $this->colldigitalObjectsRelatedByUseageId;
	}

	
	public function countdigitalObjectsRelatedByUseageId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectPeer::USEAGE_ID, $this->getId());

		return digitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRelatedByUseageId(digitalObject $l)
	{
		$this->colldigitalObjectsRelatedByUseageId[] = $l;
		$l->setTermRelatedByUseageId($this);
	}


	
	public function getdigitalObjectsRelatedByUseageIdJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByUseageId === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectsRelatedByUseageId = array();
			} else {

				$criteria->add(digitalObjectPeer::USEAGE_ID, $this->getId());

				$this->colldigitalObjectsRelatedByUseageId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectPeer::USEAGE_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRelatedByUseageIdCriteria) || !$this->lastdigitalObjectRelatedByUseageIdCriteria->equals($criteria)) {
				$this->colldigitalObjectsRelatedByUseageId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastdigitalObjectRelatedByUseageIdCriteria = $criteria;

		return $this->colldigitalObjectsRelatedByUseageId;
	}

	
	public function initdigitalObjectsRelatedByMimeTypeId()
	{
		if ($this->colldigitalObjectsRelatedByMimeTypeId === null) {
			$this->colldigitalObjectsRelatedByMimeTypeId = array();
		}
	}

	
	public function getdigitalObjectsRelatedByMimeTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByMimeTypeId === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectsRelatedByMimeTypeId = array();
			} else {

				$criteria->add(digitalObjectPeer::MIME_TYPE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				$this->colldigitalObjectsRelatedByMimeTypeId = digitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectPeer::MIME_TYPE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRelatedByMimeTypeIdCriteria) || !$this->lastdigitalObjectRelatedByMimeTypeIdCriteria->equals($criteria)) {
					$this->colldigitalObjectsRelatedByMimeTypeId = digitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRelatedByMimeTypeIdCriteria = $criteria;
		return $this->colldigitalObjectsRelatedByMimeTypeId;
	}

	
	public function countdigitalObjectsRelatedByMimeTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectPeer::MIME_TYPE_ID, $this->getId());

		return digitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRelatedByMimeTypeId(digitalObject $l)
	{
		$this->colldigitalObjectsRelatedByMimeTypeId[] = $l;
		$l->setTermRelatedByMimeTypeId($this);
	}


	
	public function getdigitalObjectsRelatedByMimeTypeIdJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByMimeTypeId === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectsRelatedByMimeTypeId = array();
			} else {

				$criteria->add(digitalObjectPeer::MIME_TYPE_ID, $this->getId());

				$this->colldigitalObjectsRelatedByMimeTypeId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectPeer::MIME_TYPE_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRelatedByMimeTypeIdCriteria) || !$this->lastdigitalObjectRelatedByMimeTypeIdCriteria->equals($criteria)) {
				$this->colldigitalObjectsRelatedByMimeTypeId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastdigitalObjectRelatedByMimeTypeIdCriteria = $criteria;

		return $this->colldigitalObjectsRelatedByMimeTypeId;
	}

	
	public function initdigitalObjectsRelatedByMediaTypeId()
	{
		if ($this->colldigitalObjectsRelatedByMediaTypeId === null) {
			$this->colldigitalObjectsRelatedByMediaTypeId = array();
		}
	}

	
	public function getdigitalObjectsRelatedByMediaTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByMediaTypeId === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectsRelatedByMediaTypeId = array();
			} else {

				$criteria->add(digitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				$this->colldigitalObjectsRelatedByMediaTypeId = digitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRelatedByMediaTypeIdCriteria) || !$this->lastdigitalObjectRelatedByMediaTypeIdCriteria->equals($criteria)) {
					$this->colldigitalObjectsRelatedByMediaTypeId = digitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRelatedByMediaTypeIdCriteria = $criteria;
		return $this->colldigitalObjectsRelatedByMediaTypeId;
	}

	
	public function countdigitalObjectsRelatedByMediaTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

		return digitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRelatedByMediaTypeId(digitalObject $l)
	{
		$this->colldigitalObjectsRelatedByMediaTypeId[] = $l;
		$l->setTermRelatedByMediaTypeId($this);
	}


	
	public function getdigitalObjectsRelatedByMediaTypeIdJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByMediaTypeId === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectsRelatedByMediaTypeId = array();
			} else {

				$criteria->add(digitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

				$this->colldigitalObjectsRelatedByMediaTypeId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectPeer::MEDIA_TYPE_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRelatedByMediaTypeIdCriteria) || !$this->lastdigitalObjectRelatedByMediaTypeIdCriteria->equals($criteria)) {
				$this->colldigitalObjectsRelatedByMediaTypeId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastdigitalObjectRelatedByMediaTypeIdCriteria = $criteria;

		return $this->colldigitalObjectsRelatedByMediaTypeId;
	}

	
	public function initdigitalObjectsRelatedByChecksumTypeId()
	{
		if ($this->colldigitalObjectsRelatedByChecksumTypeId === null) {
			$this->colldigitalObjectsRelatedByChecksumTypeId = array();
		}
	}

	
	public function getdigitalObjectsRelatedByChecksumTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByChecksumTypeId === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectsRelatedByChecksumTypeId = array();
			} else {

				$criteria->add(digitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				$this->colldigitalObjectsRelatedByChecksumTypeId = digitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRelatedByChecksumTypeIdCriteria) || !$this->lastdigitalObjectRelatedByChecksumTypeIdCriteria->equals($criteria)) {
					$this->colldigitalObjectsRelatedByChecksumTypeId = digitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRelatedByChecksumTypeIdCriteria = $criteria;
		return $this->colldigitalObjectsRelatedByChecksumTypeId;
	}

	
	public function countdigitalObjectsRelatedByChecksumTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

		return digitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRelatedByChecksumTypeId(digitalObject $l)
	{
		$this->colldigitalObjectsRelatedByChecksumTypeId[] = $l;
		$l->setTermRelatedByChecksumTypeId($this);
	}


	
	public function getdigitalObjectsRelatedByChecksumTypeIdJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByChecksumTypeId === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectsRelatedByChecksumTypeId = array();
			} else {

				$criteria->add(digitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

				$this->colldigitalObjectsRelatedByChecksumTypeId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectPeer::CHECKSUM_TYPE_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRelatedByChecksumTypeIdCriteria) || !$this->lastdigitalObjectRelatedByChecksumTypeIdCriteria->equals($criteria)) {
				$this->colldigitalObjectsRelatedByChecksumTypeId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastdigitalObjectRelatedByChecksumTypeIdCriteria = $criteria;

		return $this->colldigitalObjectsRelatedByChecksumTypeId;
	}

	
	public function initdigitalObjectsRelatedByLocationId()
	{
		if ($this->colldigitalObjectsRelatedByLocationId === null) {
			$this->colldigitalObjectsRelatedByLocationId = array();
		}
	}

	
	public function getdigitalObjectsRelatedByLocationId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByLocationId === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectsRelatedByLocationId = array();
			} else {

				$criteria->add(digitalObjectPeer::LOCATION_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				$this->colldigitalObjectsRelatedByLocationId = digitalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectPeer::LOCATION_ID, $this->getId());

				digitalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRelatedByLocationIdCriteria) || !$this->lastdigitalObjectRelatedByLocationIdCriteria->equals($criteria)) {
					$this->colldigitalObjectsRelatedByLocationId = digitalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRelatedByLocationIdCriteria = $criteria;
		return $this->colldigitalObjectsRelatedByLocationId;
	}

	
	public function countdigitalObjectsRelatedByLocationId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectPeer::LOCATION_ID, $this->getId());

		return digitalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRelatedByLocationId(digitalObject $l)
	{
		$this->colldigitalObjectsRelatedByLocationId[] = $l;
		$l->setTermRelatedByLocationId($this);
	}


	
	public function getdigitalObjectsRelatedByLocationIdJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectsRelatedByLocationId === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectsRelatedByLocationId = array();
			} else {

				$criteria->add(digitalObjectPeer::LOCATION_ID, $this->getId());

				$this->colldigitalObjectsRelatedByLocationId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRelatedByLocationIdCriteria) || !$this->lastdigitalObjectRelatedByLocationIdCriteria->equals($criteria)) {
				$this->colldigitalObjectsRelatedByLocationId = digitalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastdigitalObjectRelatedByLocationIdCriteria = $criteria;

		return $this->colldigitalObjectsRelatedByLocationId;
	}

	
	public function initdigitalObjectRecursiveRelationships()
	{
		if ($this->colldigitalObjectRecursiveRelationships === null) {
			$this->colldigitalObjectRecursiveRelationships = array();
		}
	}

	
	public function getdigitalObjectRecursiveRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
			   $this->colldigitalObjectRecursiveRelationships = array();
			} else {

				$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				digitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->colldigitalObjectRecursiveRelationships = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				digitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastdigitalObjectRecursiveRelationshipCriteria) || !$this->lastdigitalObjectRecursiveRelationshipCriteria->equals($criteria)) {
					$this->colldigitalObjectRecursiveRelationships = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastdigitalObjectRecursiveRelationshipCriteria = $criteria;
		return $this->colldigitalObjectRecursiveRelationships;
	}

	
	public function countdigitalObjectRecursiveRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return digitalObjectRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adddigitalObjectRecursiveRelationship(digitalObjectRecursiveRelationship $l)
	{
		$this->colldigitalObjectRecursiveRelationships[] = $l;
		$l->setTerm($this);
	}


	
	public function getdigitalObjectRecursiveRelationshipsJoindigitalObjectRelatedByDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectRecursiveRelationships = array();
			} else {

				$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->colldigitalObjectRecursiveRelationships = digitalObjectRecursiveRelationshipPeer::doSelectJoindigitalObjectRelatedByDigitalObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRecursiveRelationshipCriteria) || !$this->lastdigitalObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->colldigitalObjectRecursiveRelationships = digitalObjectRecursiveRelationshipPeer::doSelectJoindigitalObjectRelatedByDigitalObjectId($criteria, $con);
			}
		}
		$this->lastdigitalObjectRecursiveRelationshipCriteria = $criteria;

		return $this->colldigitalObjectRecursiveRelationships;
	}


	
	public function getdigitalObjectRecursiveRelationshipsJoindigitalObjectRelatedByRelatedDigitalObjectId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasedigitalObjectRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colldigitalObjectRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->colldigitalObjectRecursiveRelationships = array();
			} else {

				$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->colldigitalObjectRecursiveRelationships = digitalObjectRecursiveRelationshipPeer::doSelectJoindigitalObjectRelatedByRelatedDigitalObjectId($criteria, $con);
			}
		} else {
									
			$criteria->add(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastdigitalObjectRecursiveRelationshipCriteria) || !$this->lastdigitalObjectRecursiveRelationshipCriteria->equals($criteria)) {
				$this->colldigitalObjectRecursiveRelationships = digitalObjectRecursiveRelationshipPeer::doSelectJoindigitalObjectRelatedByRelatedDigitalObjectId($criteria, $con);
			}
		}
		$this->lastdigitalObjectRecursiveRelationshipCriteria = $criteria;

		return $this->colldigitalObjectRecursiveRelationships;
	}

	
	public function initphysicalObjects()
	{
		if ($this->collphysicalObjects === null) {
			$this->collphysicalObjects = array();
		}
	}

	
	public function getphysicalObjects($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasephysicalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collphysicalObjects === null) {
			if ($this->isNew()) {
			   $this->collphysicalObjects = array();
			} else {

				$criteria->add(physicalObjectPeer::LOCATION_ID, $this->getId());

				physicalObjectPeer::addSelectColumns($criteria);
				$this->collphysicalObjects = physicalObjectPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(physicalObjectPeer::LOCATION_ID, $this->getId());

				physicalObjectPeer::addSelectColumns($criteria);
				if (!isset($this->lastphysicalObjectCriteria) || !$this->lastphysicalObjectCriteria->equals($criteria)) {
					$this->collphysicalObjects = physicalObjectPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastphysicalObjectCriteria = $criteria;
		return $this->collphysicalObjects;
	}

	
	public function countphysicalObjects($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasephysicalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(physicalObjectPeer::LOCATION_ID, $this->getId());

		return physicalObjectPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addphysicalObject(physicalObject $l)
	{
		$this->collphysicalObjects[] = $l;
		$l->setTerm($this);
	}


	
	public function getphysicalObjectsJoininformationObject($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasephysicalObjectPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collphysicalObjects === null) {
			if ($this->isNew()) {
				$this->collphysicalObjects = array();
			} else {

				$criteria->add(physicalObjectPeer::LOCATION_ID, $this->getId());

				$this->collphysicalObjects = physicalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(physicalObjectPeer::LOCATION_ID, $this->getId());

			if (!isset($this->lastphysicalObjectCriteria) || !$this->lastphysicalObjectCriteria->equals($criteria)) {
				$this->collphysicalObjects = physicalObjectPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastphysicalObjectCriteria = $criteria;

		return $this->collphysicalObjects;
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

	
	public function initactorNames()
	{
		if ($this->collactorNames === null) {
			$this->collactorNames = array();
		}
	}

	
	public function getactorNames($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorNamePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorNames === null) {
			if ($this->isNew()) {
			   $this->collactorNames = array();
			} else {

				$criteria->add(actorNamePeer::NAME_TYPE_ID, $this->getId());

				actorNamePeer::addSelectColumns($criteria);
				$this->collactorNames = actorNamePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(actorNamePeer::NAME_TYPE_ID, $this->getId());

				actorNamePeer::addSelectColumns($criteria);
				if (!isset($this->lastactorNameCriteria) || !$this->lastactorNameCriteria->equals($criteria)) {
					$this->collactorNames = actorNamePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastactorNameCriteria = $criteria;
		return $this->collactorNames;
	}

	
	public function countactorNames($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseactorNamePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(actorNamePeer::NAME_TYPE_ID, $this->getId());

		return actorNamePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addactorName(actorName $l)
	{
		$this->collactorNames[] = $l;
		$l->setTerm($this);
	}


	
	public function getactorNamesJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorNamePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorNames === null) {
			if ($this->isNew()) {
				$this->collactorNames = array();
			} else {

				$criteria->add(actorNamePeer::NAME_TYPE_ID, $this->getId());

				$this->collactorNames = actorNamePeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(actorNamePeer::NAME_TYPE_ID, $this->getId());

			if (!isset($this->lastactorNameCriteria) || !$this->lastactorNameCriteria->equals($criteria)) {
				$this->collactorNames = actorNamePeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastactorNameCriteria = $criteria;

		return $this->collactorNames;
	}

	
	public function initactorRecursiveRelationships()
	{
		if ($this->collactorRecursiveRelationships === null) {
			$this->collactorRecursiveRelationships = array();
		}
	}

	
	public function getactorRecursiveRelationships($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorRecursiveRelationships === null) {
			if ($this->isNew()) {
			   $this->collactorRecursiveRelationships = array();
			} else {

				$criteria->add(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				actorRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->collactorRecursiveRelationships = actorRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				actorRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastactorRecursiveRelationshipCriteria) || !$this->lastactorRecursiveRelationshipCriteria->equals($criteria)) {
					$this->collactorRecursiveRelationships = actorRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastactorRecursiveRelationshipCriteria = $criteria;
		return $this->collactorRecursiveRelationships;
	}

	
	public function countactorRecursiveRelationships($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseactorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return actorRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addactorRecursiveRelationship(actorRecursiveRelationship $l)
	{
		$this->collactorRecursiveRelationships[] = $l;
		$l->setTerm($this);
	}


	
	public function getactorRecursiveRelationshipsJoinActorRelatedByActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collactorRecursiveRelationships = array();
			} else {

				$criteria->add(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collactorRecursiveRelationships = actorRecursiveRelationshipPeer::doSelectJoinActorRelatedByActorId($criteria, $con);
			}
		} else {
									
			$criteria->add(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastactorRecursiveRelationshipCriteria) || !$this->lastactorRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collactorRecursiveRelationships = actorRecursiveRelationshipPeer::doSelectJoinActorRelatedByActorId($criteria, $con);
			}
		}
		$this->lastactorRecursiveRelationshipCriteria = $criteria;

		return $this->collactorRecursiveRelationships;
	}


	
	public function getactorRecursiveRelationshipsJoinActorRelatedByRelatedActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorRecursiveRelationships === null) {
			if ($this->isNew()) {
				$this->collactorRecursiveRelationships = array();
			} else {

				$criteria->add(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collactorRecursiveRelationships = actorRecursiveRelationshipPeer::doSelectJoinActorRelatedByRelatedActorId($criteria, $con);
			}
		} else {
									
			$criteria->add(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastactorRecursiveRelationshipCriteria) || !$this->lastactorRecursiveRelationshipCriteria->equals($criteria)) {
				$this->collactorRecursiveRelationships = actorRecursiveRelationshipPeer::doSelectJoinActorRelatedByRelatedActorId($criteria, $con);
			}
		}
		$this->lastactorRecursiveRelationshipCriteria = $criteria;

		return $this->collactorRecursiveRelationships;
	}

	
	public function initactorTermRelationshipsRelatedByTermId()
	{
		if ($this->collactorTermRelationshipsRelatedByTermId === null) {
			$this->collactorTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getactorTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collactorTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(actorTermRelationshipPeer::TERM_ID, $this->getId());

				actorTermRelationshipPeer::addSelectColumns($criteria);
				$this->collactorTermRelationshipsRelatedByTermId = actorTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(actorTermRelationshipPeer::TERM_ID, $this->getId());

				actorTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastactorTermRelationshipRelatedByTermIdCriteria) || !$this->lastactorTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collactorTermRelationshipsRelatedByTermId = actorTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastactorTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collactorTermRelationshipsRelatedByTermId;
	}

	
	public function countactorTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseactorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(actorTermRelationshipPeer::TERM_ID, $this->getId());

		return actorTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addactorTermRelationshipRelatedByTermId(actorTermRelationship $l)
	{
		$this->collactorTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getactorTermRelationshipsRelatedByTermIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collactorTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(actorTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collactorTermRelationshipsRelatedByTermId = actorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(actorTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastactorTermRelationshipRelatedByTermIdCriteria) || !$this->lastactorTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collactorTermRelationshipsRelatedByTermId = actorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastactorTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collactorTermRelationshipsRelatedByTermId;
	}

	
	public function initactorTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collactorTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collactorTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getactorTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collactorTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(actorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				actorTermRelationshipPeer::addSelectColumns($criteria);
				$this->collactorTermRelationshipsRelatedByRelationshipTypeId = actorTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(actorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				actorTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastactorTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastactorTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collactorTermRelationshipsRelatedByRelationshipTypeId = actorTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastactorTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collactorTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countactorTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseactorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(actorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return actorTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addactorTermRelationshipRelatedByRelationshipTypeId(actorTermRelationship $l)
	{
		$this->collactorTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getactorTermRelationshipsRelatedByRelationshipTypeIdJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseactorTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collactorTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collactorTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(actorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collactorTermRelationshipsRelatedByRelationshipTypeId = actorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(actorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastactorTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastactorTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collactorTermRelationshipsRelatedByRelationshipTypeId = actorTermRelationshipPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastactorTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collactorTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function initcontactInformations()
	{
		if ($this->collcontactInformations === null) {
			$this->collcontactInformations = array();
		}
	}

	
	public function getcontactInformations($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasecontactInformationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collcontactInformations === null) {
			if ($this->isNew()) {
			   $this->collcontactInformations = array();
			} else {

				$criteria->add(contactInformationPeer::COUNTRY_ID, $this->getId());

				contactInformationPeer::addSelectColumns($criteria);
				$this->collcontactInformations = contactInformationPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(contactInformationPeer::COUNTRY_ID, $this->getId());

				contactInformationPeer::addSelectColumns($criteria);
				if (!isset($this->lastcontactInformationCriteria) || !$this->lastcontactInformationCriteria->equals($criteria)) {
					$this->collcontactInformations = contactInformationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastcontactInformationCriteria = $criteria;
		return $this->collcontactInformations;
	}

	
	public function countcontactInformations($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasecontactInformationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(contactInformationPeer::COUNTRY_ID, $this->getId());

		return contactInformationPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addcontactInformation(contactInformation $l)
	{
		$this->collcontactInformations[] = $l;
		$l->setTerm($this);
	}


	
	public function getcontactInformationsJoinActor($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasecontactInformationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collcontactInformations === null) {
			if ($this->isNew()) {
				$this->collcontactInformations = array();
			} else {

				$criteria->add(contactInformationPeer::COUNTRY_ID, $this->getId());

				$this->collcontactInformations = contactInformationPeer::doSelectJoinActor($criteria, $con);
			}
		} else {
									
			$criteria->add(contactInformationPeer::COUNTRY_ID, $this->getId());

			if (!isset($this->lastcontactInformationCriteria) || !$this->lastcontactInformationCriteria->equals($criteria)) {
				$this->collcontactInformations = contactInformationPeer::doSelectJoinActor($criteria, $con);
			}
		}
		$this->lastcontactInformationCriteria = $criteria;

		return $this->collcontactInformations;
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

				$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				placeMapRelationshipPeer::addSelectColumns($criteria);
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

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

		$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return placeMapRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addplaceMapRelationship(placeMapRelationship $l)
	{
		$this->collplaceMapRelationships[] = $l;
		$l->setTerm($this);
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

				$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinPlace($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

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

				$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinMap($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoinMap($criteria, $con);
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

				$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoindigitalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastplaceMapRelationshipCriteria) || !$this->lastplaceMapRelationshipCriteria->equals($criteria)) {
				$this->collplaceMapRelationships = placeMapRelationshipPeer::doSelectJoindigitalObject($criteria, $con);
			}
		}
		$this->lastplaceMapRelationshipCriteria = $criteria;

		return $this->collplaceMapRelationships;
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

	
	public function initrepositoryTermRelationshipsRelatedByTermId()
	{
		if ($this->collrepositoryTermRelationshipsRelatedByTermId === null) {
			$this->collrepositoryTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getrepositoryTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrepositoryTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collrepositoryTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(repositoryTermRelationshipPeer::TERM_ID, $this->getId());

				repositoryTermRelationshipPeer::addSelectColumns($criteria);
				$this->collrepositoryTermRelationshipsRelatedByTermId = repositoryTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(repositoryTermRelationshipPeer::TERM_ID, $this->getId());

				repositoryTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrepositoryTermRelationshipRelatedByTermIdCriteria) || !$this->lastrepositoryTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collrepositoryTermRelationshipsRelatedByTermId = repositoryTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrepositoryTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collrepositoryTermRelationshipsRelatedByTermId;
	}

	
	public function countrepositoryTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(repositoryTermRelationshipPeer::TERM_ID, $this->getId());

		return repositoryTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrepositoryTermRelationshipRelatedByTermId(repositoryTermRelationship $l)
	{
		$this->collrepositoryTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getrepositoryTermRelationshipsRelatedByTermIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrepositoryTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collrepositoryTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(repositoryTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collrepositoryTermRelationshipsRelatedByTermId = repositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(repositoryTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastrepositoryTermRelationshipRelatedByTermIdCriteria) || !$this->lastrepositoryTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collrepositoryTermRelationshipsRelatedByTermId = repositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastrepositoryTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collrepositoryTermRelationshipsRelatedByTermId;
	}

	
	public function initrepositoryTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getrepositoryTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(repositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				repositoryTermRelationshipPeer::addSelectColumns($criteria);
				$this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId = repositoryTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(repositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				repositoryTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastrepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId = repositoryTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countrepositoryTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(repositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return repositoryTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrepositoryTermRelationshipRelatedByRelationshipTypeId(repositoryTermRelationship $l)
	{
		$this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getrepositoryTermRelationshipsRelatedByRelationshipTypeIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserepositoryTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(repositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId = repositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(repositoryTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastrepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastrepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId = repositoryTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastrepositoryTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collrepositoryTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function inittermRecursiveRelationshipsRelatedByTermId()
	{
		if ($this->colltermRecursiveRelationshipsRelatedByTermId === null) {
			$this->colltermRecursiveRelationshipsRelatedByTermId = array();
		}
	}

	
	public function gettermRecursiveRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasetermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colltermRecursiveRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->colltermRecursiveRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(termRecursiveRelationshipPeer::TERM_ID, $this->getId());

				termRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->colltermRecursiveRelationshipsRelatedByTermId = termRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(termRecursiveRelationshipPeer::TERM_ID, $this->getId());

				termRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lasttermRecursiveRelationshipRelatedByTermIdCriteria) || !$this->lasttermRecursiveRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->colltermRecursiveRelationshipsRelatedByTermId = termRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasttermRecursiveRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->colltermRecursiveRelationshipsRelatedByTermId;
	}

	
	public function counttermRecursiveRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasetermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(termRecursiveRelationshipPeer::TERM_ID, $this->getId());

		return termRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addtermRecursiveRelationshipRelatedByTermId(termRecursiveRelationship $l)
	{
		$this->colltermRecursiveRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}

	
	public function inittermRecursiveRelationshipsRelatedByRelatedTermId()
	{
		if ($this->colltermRecursiveRelationshipsRelatedByRelatedTermId === null) {
			$this->colltermRecursiveRelationshipsRelatedByRelatedTermId = array();
		}
	}

	
	public function gettermRecursiveRelationshipsRelatedByRelatedTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasetermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colltermRecursiveRelationshipsRelatedByRelatedTermId === null) {
			if ($this->isNew()) {
			   $this->colltermRecursiveRelationshipsRelatedByRelatedTermId = array();
			} else {

				$criteria->add(termRecursiveRelationshipPeer::RELATED_TERM_ID, $this->getId());

				termRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->colltermRecursiveRelationshipsRelatedByRelatedTermId = termRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(termRecursiveRelationshipPeer::RELATED_TERM_ID, $this->getId());

				termRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lasttermRecursiveRelationshipRelatedByRelatedTermIdCriteria) || !$this->lasttermRecursiveRelationshipRelatedByRelatedTermIdCriteria->equals($criteria)) {
					$this->colltermRecursiveRelationshipsRelatedByRelatedTermId = termRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasttermRecursiveRelationshipRelatedByRelatedTermIdCriteria = $criteria;
		return $this->colltermRecursiveRelationshipsRelatedByRelatedTermId;
	}

	
	public function counttermRecursiveRelationshipsRelatedByRelatedTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasetermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(termRecursiveRelationshipPeer::RELATED_TERM_ID, $this->getId());

		return termRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addtermRecursiveRelationshipRelatedByRelatedTermId(termRecursiveRelationship $l)
	{
		$this->colltermRecursiveRelationshipsRelatedByRelatedTermId[] = $l;
		$l->setTermRelatedByRelatedTermId($this);
	}

	
	public function inittermRecursiveRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId === null) {
			$this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function gettermRecursiveRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasetermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(termRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				termRecursiveRelationshipPeer::addSelectColumns($criteria);
				$this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId = termRecursiveRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(termRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				termRecursiveRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lasttermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lasttermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId = termRecursiveRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasttermRecursiveRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function counttermRecursiveRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasetermRecursiveRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(termRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return termRecursiveRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addtermRecursiveRelationshipRelatedByRelationshipTypeId(termRecursiveRelationship $l)
	{
		$this->colltermRecursiveRelationshipsRelatedByRelationshipTypeId[] = $l;
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


	
	public function getEventsRelatedByEventTypeIdJoininformationObject($criteria = null, $con = null)
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

				$this->collEventsRelatedByEventTypeId = EventPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::EVENT_TYPE_ID, $this->getId());

			if (!isset($this->lastEventRelatedByEventTypeIdCriteria) || !$this->lastEventRelatedByEventTypeIdCriteria->equals($criteria)) {
				$this->collEventsRelatedByEventTypeId = EventPeer::doSelectJoininformationObject($criteria, $con);
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


	
	public function getEventsRelatedByActorRoleIdJoininformationObject($criteria = null, $con = null)
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

				$this->collEventsRelatedByActorRoleId = EventPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(EventPeer::ACTOR_ROLE_ID, $this->getId());

			if (!isset($this->lastEventRelatedByActorRoleIdCriteria) || !$this->lastEventRelatedByActorRoleIdCriteria->equals($criteria)) {
				$this->collEventsRelatedByActorRoleId = EventPeer::doSelectJoininformationObject($criteria, $con);
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

	
	public function initeventTermRelationshipsRelatedByTermId()
	{
		if ($this->colleventTermRelationshipsRelatedByTermId === null) {
			$this->colleventTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function geteventTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colleventTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->colleventTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(eventTermRelationshipPeer::TERM_ID, $this->getId());

				eventTermRelationshipPeer::addSelectColumns($criteria);
				$this->colleventTermRelationshipsRelatedByTermId = eventTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(eventTermRelationshipPeer::TERM_ID, $this->getId());

				eventTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lasteventTermRelationshipRelatedByTermIdCriteria) || !$this->lasteventTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->colleventTermRelationshipsRelatedByTermId = eventTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasteventTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->colleventTermRelationshipsRelatedByTermId;
	}

	
	public function counteventTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(eventTermRelationshipPeer::TERM_ID, $this->getId());

		return eventTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addeventTermRelationshipRelatedByTermId(eventTermRelationship $l)
	{
		$this->colleventTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function geteventTermRelationshipsRelatedByTermIdJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colleventTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->colleventTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(eventTermRelationshipPeer::TERM_ID, $this->getId());

				$this->colleventTermRelationshipsRelatedByTermId = eventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(eventTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lasteventTermRelationshipRelatedByTermIdCriteria) || !$this->lasteventTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->colleventTermRelationshipsRelatedByTermId = eventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lasteventTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->colleventTermRelationshipsRelatedByTermId;
	}

	
	public function initeventTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->colleventTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->colleventTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function geteventTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colleventTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->colleventTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(eventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				eventTermRelationshipPeer::addSelectColumns($criteria);
				$this->colleventTermRelationshipsRelatedByRelationshipTypeId = eventTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(eventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				eventTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lasteventTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lasteventTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->colleventTermRelationshipsRelatedByRelationshipTypeId = eventTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasteventTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->colleventTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function counteventTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(eventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return eventTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addeventTermRelationshipRelatedByRelationshipTypeId(eventTermRelationship $l)
	{
		$this->colleventTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function geteventTermRelationshipsRelatedByRelationshipTypeIdJoinEvent($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseeventTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colleventTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->colleventTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(eventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->colleventTermRelationshipsRelatedByRelationshipTypeId = eventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		} else {
									
			$criteria->add(eventTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lasteventTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lasteventTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->colleventTermRelationshipsRelatedByRelationshipTypeId = eventTermRelationshipPeer::doSelectJoinEvent($criteria, $con);
			}
		}
		$this->lasteventTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->colleventTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function initsystemEvents()
	{
		if ($this->collsystemEvents === null) {
			$this->collsystemEvents = array();
		}
	}

	
	public function getsystemEvents($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasesystemEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsystemEvents === null) {
			if ($this->isNew()) {
			   $this->collsystemEvents = array();
			} else {

				$criteria->add(systemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

				systemEventPeer::addSelectColumns($criteria);
				$this->collsystemEvents = systemEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(systemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

				systemEventPeer::addSelectColumns($criteria);
				if (!isset($this->lastsystemEventCriteria) || !$this->lastsystemEventCriteria->equals($criteria)) {
					$this->collsystemEvents = systemEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastsystemEventCriteria = $criteria;
		return $this->collsystemEvents;
	}

	
	public function countsystemEvents($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasesystemEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(systemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

		return systemEventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addsystemEvent(systemEvent $l)
	{
		$this->collsystemEvents[] = $l;
		$l->setTerm($this);
	}


	
	public function getsystemEventsJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasesystemEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collsystemEvents === null) {
			if ($this->isNew()) {
				$this->collsystemEvents = array();
			} else {

				$criteria->add(systemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

				$this->collsystemEvents = systemEventPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(systemEventPeer::SYSTEM_EVENT_TYPE_ID, $this->getId());

			if (!isset($this->lastsystemEventCriteria) || !$this->lastsystemEventCriteria->equals($criteria)) {
				$this->collsystemEvents = systemEventPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastsystemEventCriteria = $criteria;

		return $this->collsystemEvents;
	}

	
	public function inithistoricalEventsRelatedByTermId()
	{
		if ($this->collhistoricalEventsRelatedByTermId === null) {
			$this->collhistoricalEventsRelatedByTermId = array();
		}
	}

	
	public function gethistoricalEventsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasehistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collhistoricalEventsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collhistoricalEventsRelatedByTermId = array();
			} else {

				$criteria->add(historicalEventPeer::TERM_ID, $this->getId());

				historicalEventPeer::addSelectColumns($criteria);
				$this->collhistoricalEventsRelatedByTermId = historicalEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(historicalEventPeer::TERM_ID, $this->getId());

				historicalEventPeer::addSelectColumns($criteria);
				if (!isset($this->lasthistoricalEventRelatedByTermIdCriteria) || !$this->lasthistoricalEventRelatedByTermIdCriteria->equals($criteria)) {
					$this->collhistoricalEventsRelatedByTermId = historicalEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasthistoricalEventRelatedByTermIdCriteria = $criteria;
		return $this->collhistoricalEventsRelatedByTermId;
	}

	
	public function counthistoricalEventsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasehistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(historicalEventPeer::TERM_ID, $this->getId());

		return historicalEventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addhistoricalEventRelatedByTermId(historicalEvent $l)
	{
		$this->collhistoricalEventsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}

	
	public function inithistoricalEventsRelatedByHistoricalEventTypeId()
	{
		if ($this->collhistoricalEventsRelatedByHistoricalEventTypeId === null) {
			$this->collhistoricalEventsRelatedByHistoricalEventTypeId = array();
		}
	}

	
	public function gethistoricalEventsRelatedByHistoricalEventTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasehistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collhistoricalEventsRelatedByHistoricalEventTypeId === null) {
			if ($this->isNew()) {
			   $this->collhistoricalEventsRelatedByHistoricalEventTypeId = array();
			} else {

				$criteria->add(historicalEventPeer::HISTORICAL_EVENT_TYPE_ID, $this->getId());

				historicalEventPeer::addSelectColumns($criteria);
				$this->collhistoricalEventsRelatedByHistoricalEventTypeId = historicalEventPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(historicalEventPeer::HISTORICAL_EVENT_TYPE_ID, $this->getId());

				historicalEventPeer::addSelectColumns($criteria);
				if (!isset($this->lasthistoricalEventRelatedByHistoricalEventTypeIdCriteria) || !$this->lasthistoricalEventRelatedByHistoricalEventTypeIdCriteria->equals($criteria)) {
					$this->collhistoricalEventsRelatedByHistoricalEventTypeId = historicalEventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lasthistoricalEventRelatedByHistoricalEventTypeIdCriteria = $criteria;
		return $this->collhistoricalEventsRelatedByHistoricalEventTypeId;
	}

	
	public function counthistoricalEventsRelatedByHistoricalEventTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasehistoricalEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(historicalEventPeer::HISTORICAL_EVENT_TYPE_ID, $this->getId());

		return historicalEventPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addhistoricalEventRelatedByHistoricalEventTypeId(historicalEvent $l)
	{
		$this->collhistoricalEventsRelatedByHistoricalEventTypeId[] = $l;
		$l->setTermRelatedByHistoricalEventTypeId($this);
	}

	
	public function initfunctionDescriptionsRelatedByTermId()
	{
		if ($this->collfunctionDescriptionsRelatedByTermId === null) {
			$this->collfunctionDescriptionsRelatedByTermId = array();
		}
	}

	
	public function getfunctionDescriptionsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collfunctionDescriptionsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collfunctionDescriptionsRelatedByTermId = array();
			} else {

				$criteria->add(functionDescriptionPeer::TERM_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				$this->collfunctionDescriptionsRelatedByTermId = functionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(functionDescriptionPeer::TERM_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastfunctionDescriptionRelatedByTermIdCriteria) || !$this->lastfunctionDescriptionRelatedByTermIdCriteria->equals($criteria)) {
					$this->collfunctionDescriptionsRelatedByTermId = functionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastfunctionDescriptionRelatedByTermIdCriteria = $criteria;
		return $this->collfunctionDescriptionsRelatedByTermId;
	}

	
	public function countfunctionDescriptionsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(functionDescriptionPeer::TERM_ID, $this->getId());

		return functionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addfunctionDescriptionRelatedByTermId(functionDescription $l)
	{
		$this->collfunctionDescriptionsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}

	
	public function initfunctionDescriptionsRelatedByFunctionDescriptionTypeId()
	{
		if ($this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId === null) {
			$this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId = array();
		}
	}

	
	public function getfunctionDescriptionsRelatedByFunctionDescriptionTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId === null) {
			if ($this->isNew()) {
			   $this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId = array();
			} else {

				$criteria->add(functionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				$this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId = functionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(functionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastfunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria) || !$this->lastfunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria->equals($criteria)) {
					$this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId = functionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastfunctionDescriptionRelatedByFunctionDescriptionTypeIdCriteria = $criteria;
		return $this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId;
	}

	
	public function countfunctionDescriptionsRelatedByFunctionDescriptionTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(functionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, $this->getId());

		return functionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addfunctionDescriptionRelatedByFunctionDescriptionTypeId(functionDescription $l)
	{
		$this->collfunctionDescriptionsRelatedByFunctionDescriptionTypeId[] = $l;
		$l->setTermRelatedByFunctionDescriptionTypeId($this);
	}

	
	public function initfunctionDescriptionsRelatedByStatusId()
	{
		if ($this->collfunctionDescriptionsRelatedByStatusId === null) {
			$this->collfunctionDescriptionsRelatedByStatusId = array();
		}
	}

	
	public function getfunctionDescriptionsRelatedByStatusId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collfunctionDescriptionsRelatedByStatusId === null) {
			if ($this->isNew()) {
			   $this->collfunctionDescriptionsRelatedByStatusId = array();
			} else {

				$criteria->add(functionDescriptionPeer::STATUS_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				$this->collfunctionDescriptionsRelatedByStatusId = functionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(functionDescriptionPeer::STATUS_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastfunctionDescriptionRelatedByStatusIdCriteria) || !$this->lastfunctionDescriptionRelatedByStatusIdCriteria->equals($criteria)) {
					$this->collfunctionDescriptionsRelatedByStatusId = functionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastfunctionDescriptionRelatedByStatusIdCriteria = $criteria;
		return $this->collfunctionDescriptionsRelatedByStatusId;
	}

	
	public function countfunctionDescriptionsRelatedByStatusId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(functionDescriptionPeer::STATUS_ID, $this->getId());

		return functionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addfunctionDescriptionRelatedByStatusId(functionDescription $l)
	{
		$this->collfunctionDescriptionsRelatedByStatusId[] = $l;
		$l->setTermRelatedByStatusId($this);
	}

	
	public function initfunctionDescriptionsRelatedByLevelId()
	{
		if ($this->collfunctionDescriptionsRelatedByLevelId === null) {
			$this->collfunctionDescriptionsRelatedByLevelId = array();
		}
	}

	
	public function getfunctionDescriptionsRelatedByLevelId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collfunctionDescriptionsRelatedByLevelId === null) {
			if ($this->isNew()) {
			   $this->collfunctionDescriptionsRelatedByLevelId = array();
			} else {

				$criteria->add(functionDescriptionPeer::LEVEL_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				$this->collfunctionDescriptionsRelatedByLevelId = functionDescriptionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(functionDescriptionPeer::LEVEL_ID, $this->getId());

				functionDescriptionPeer::addSelectColumns($criteria);
				if (!isset($this->lastfunctionDescriptionRelatedByLevelIdCriteria) || !$this->lastfunctionDescriptionRelatedByLevelIdCriteria->equals($criteria)) {
					$this->collfunctionDescriptionsRelatedByLevelId = functionDescriptionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastfunctionDescriptionRelatedByLevelIdCriteria = $criteria;
		return $this->collfunctionDescriptionsRelatedByLevelId;
	}

	
	public function countfunctionDescriptionsRelatedByLevelId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasefunctionDescriptionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(functionDescriptionPeer::LEVEL_ID, $this->getId());

		return functionDescriptionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addfunctionDescriptionRelatedByLevelId(functionDescription $l)
	{
		$this->collfunctionDescriptionsRelatedByLevelId[] = $l;
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

				$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoininformationObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoininformationObject($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}


	
	public function getRightsJoindigitalObject($criteria = null, $con = null)
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

				$this->collRights = RightPeer::doSelectJoindigitalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoindigitalObject($criteria, $con);
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

				$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

				$this->collRights = RightPeer::doSelectJoinphysicalObject($criteria, $con);
			}
		} else {
									
			$criteria->add(RightPeer::PERMISSION_ID, $this->getId());

			if (!isset($this->lastRightCriteria) || !$this->lastRightCriteria->equals($criteria)) {
				$this->collRights = RightPeer::doSelectJoinphysicalObject($criteria, $con);
			}
		}
		$this->lastRightCriteria = $criteria;

		return $this->collRights;
	}

	
	public function initrightTermRelationshipsRelatedByTermId()
	{
		if ($this->collrightTermRelationshipsRelatedByTermId === null) {
			$this->collrightTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getrightTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->collrightTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(rightTermRelationshipPeer::TERM_ID, $this->getId());

				rightTermRelationshipPeer::addSelectColumns($criteria);
				$this->collrightTermRelationshipsRelatedByTermId = rightTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(rightTermRelationshipPeer::TERM_ID, $this->getId());

				rightTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrightTermRelationshipRelatedByTermIdCriteria) || !$this->lastrightTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->collrightTermRelationshipsRelatedByTermId = rightTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrightTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->collrightTermRelationshipsRelatedByTermId;
	}

	
	public function countrightTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(rightTermRelationshipPeer::TERM_ID, $this->getId());

		return rightTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrightTermRelationshipRelatedByTermId(rightTermRelationship $l)
	{
		$this->collrightTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getrightTermRelationshipsRelatedByTermIdJoinRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->collrightTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(rightTermRelationshipPeer::TERM_ID, $this->getId());

				$this->collrightTermRelationshipsRelatedByTermId = rightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(rightTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastrightTermRelationshipRelatedByTermIdCriteria) || !$this->lastrightTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->collrightTermRelationshipsRelatedByTermId = rightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastrightTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->collrightTermRelationshipsRelatedByTermId;
	}

	
	public function initrightTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collrightTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collrightTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getrightTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collrightTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(rightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				rightTermRelationshipPeer::addSelectColumns($criteria);
				$this->collrightTermRelationshipsRelatedByRelationshipTypeId = rightTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(rightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				rightTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrightTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastrightTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collrightTermRelationshipsRelatedByRelationshipTypeId = rightTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrightTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collrightTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countrightTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(rightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return rightTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrightTermRelationshipRelatedByRelationshipTypeId(rightTermRelationship $l)
	{
		$this->collrightTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getrightTermRelationshipsRelatedByRelationshipTypeIdJoinRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collrightTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(rightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collrightTermRelationshipsRelatedByRelationshipTypeId = rightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(rightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastrightTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastrightTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collrightTermRelationshipsRelatedByRelationshipTypeId = rightTermRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastrightTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collrightTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function initrightActorRelationshipsRelatedByActorId()
	{
		if ($this->collrightActorRelationshipsRelatedByActorId === null) {
			$this->collrightActorRelationshipsRelatedByActorId = array();
		}
	}

	
	public function getrightActorRelationshipsRelatedByActorId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightActorRelationshipsRelatedByActorId === null) {
			if ($this->isNew()) {
			   $this->collrightActorRelationshipsRelatedByActorId = array();
			} else {

				$criteria->add(rightActorRelationshipPeer::ACTOR_ID, $this->getId());

				rightActorRelationshipPeer::addSelectColumns($criteria);
				$this->collrightActorRelationshipsRelatedByActorId = rightActorRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(rightActorRelationshipPeer::ACTOR_ID, $this->getId());

				rightActorRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrightActorRelationshipRelatedByActorIdCriteria) || !$this->lastrightActorRelationshipRelatedByActorIdCriteria->equals($criteria)) {
					$this->collrightActorRelationshipsRelatedByActorId = rightActorRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrightActorRelationshipRelatedByActorIdCriteria = $criteria;
		return $this->collrightActorRelationshipsRelatedByActorId;
	}

	
	public function countrightActorRelationshipsRelatedByActorId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(rightActorRelationshipPeer::ACTOR_ID, $this->getId());

		return rightActorRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrightActorRelationshipRelatedByActorId(rightActorRelationship $l)
	{
		$this->collrightActorRelationshipsRelatedByActorId[] = $l;
		$l->setTermRelatedByActorId($this);
	}


	
	public function getrightActorRelationshipsRelatedByActorIdJoinRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightActorRelationshipsRelatedByActorId === null) {
			if ($this->isNew()) {
				$this->collrightActorRelationshipsRelatedByActorId = array();
			} else {

				$criteria->add(rightActorRelationshipPeer::ACTOR_ID, $this->getId());

				$this->collrightActorRelationshipsRelatedByActorId = rightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(rightActorRelationshipPeer::ACTOR_ID, $this->getId());

			if (!isset($this->lastrightActorRelationshipRelatedByActorIdCriteria) || !$this->lastrightActorRelationshipRelatedByActorIdCriteria->equals($criteria)) {
				$this->collrightActorRelationshipsRelatedByActorId = rightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastrightActorRelationshipRelatedByActorIdCriteria = $criteria;

		return $this->collrightActorRelationshipsRelatedByActorId;
	}

	
	public function initrightActorRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->collrightActorRelationshipsRelatedByRelationshipTypeId === null) {
			$this->collrightActorRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getrightActorRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightActorRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->collrightActorRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				rightActorRelationshipPeer::addSelectColumns($criteria);
				$this->collrightActorRelationshipsRelatedByRelationshipTypeId = rightActorRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				rightActorRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastrightActorRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastrightActorRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->collrightActorRelationshipsRelatedByRelationshipTypeId = rightActorRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastrightActorRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->collrightActorRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countrightActorRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return rightActorRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addrightActorRelationshipRelatedByRelationshipTypeId(rightActorRelationship $l)
	{
		$this->collrightActorRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getrightActorRelationshipsRelatedByRelationshipTypeIdJoinRight($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaserightActorRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collrightActorRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->collrightActorRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->collrightActorRelationshipsRelatedByRelationshipTypeId = rightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		} else {
									
			$criteria->add(rightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastrightActorRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastrightActorRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->collrightActorRelationshipsRelatedByRelationshipTypeId = rightActorRelationshipPeer::doSelectJoinRight($criteria, $con);
			}
		}
		$this->lastrightActorRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->collrightActorRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function inituserTermRelationshipsRelatedByTermId()
	{
		if ($this->colluserTermRelationshipsRelatedByTermId === null) {
			$this->colluserTermRelationshipsRelatedByTermId = array();
		}
	}

	
	public function getuserTermRelationshipsRelatedByTermId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
			   $this->colluserTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(userTermRelationshipPeer::TERM_ID, $this->getId());

				userTermRelationshipPeer::addSelectColumns($criteria);
				$this->colluserTermRelationshipsRelatedByTermId = userTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(userTermRelationshipPeer::TERM_ID, $this->getId());

				userTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastuserTermRelationshipRelatedByTermIdCriteria) || !$this->lastuserTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
					$this->colluserTermRelationshipsRelatedByTermId = userTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastuserTermRelationshipRelatedByTermIdCriteria = $criteria;
		return $this->colluserTermRelationshipsRelatedByTermId;
	}

	
	public function countuserTermRelationshipsRelatedByTermId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(userTermRelationshipPeer::TERM_ID, $this->getId());

		return userTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adduserTermRelationshipRelatedByTermId(userTermRelationship $l)
	{
		$this->colluserTermRelationshipsRelatedByTermId[] = $l;
		$l->setTermRelatedByTermId($this);
	}


	
	public function getuserTermRelationshipsRelatedByTermIdJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->colluserTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(userTermRelationshipPeer::TERM_ID, $this->getId());

				$this->colluserTermRelationshipsRelatedByTermId = userTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(userTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastuserTermRelationshipRelatedByTermIdCriteria) || !$this->lastuserTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->colluserTermRelationshipsRelatedByTermId = userTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastuserTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->colluserTermRelationshipsRelatedByTermId;
	}


	
	public function getuserTermRelationshipsRelatedByTermIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationshipsRelatedByTermId === null) {
			if ($this->isNew()) {
				$this->colluserTermRelationshipsRelatedByTermId = array();
			} else {

				$criteria->add(userTermRelationshipPeer::TERM_ID, $this->getId());

				$this->colluserTermRelationshipsRelatedByTermId = userTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(userTermRelationshipPeer::TERM_ID, $this->getId());

			if (!isset($this->lastuserTermRelationshipRelatedByTermIdCriteria) || !$this->lastuserTermRelationshipRelatedByTermIdCriteria->equals($criteria)) {
				$this->colluserTermRelationshipsRelatedByTermId = userTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastuserTermRelationshipRelatedByTermIdCriteria = $criteria;

		return $this->colluserTermRelationshipsRelatedByTermId;
	}

	
	public function inituserTermRelationshipsRelatedByRelationshipTypeId()
	{
		if ($this->colluserTermRelationshipsRelatedByRelationshipTypeId === null) {
			$this->colluserTermRelationshipsRelatedByRelationshipTypeId = array();
		}
	}

	
	public function getuserTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
			   $this->colluserTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				userTermRelationshipPeer::addSelectColumns($criteria);
				$this->colluserTermRelationshipsRelatedByRelationshipTypeId = userTermRelationshipPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				userTermRelationshipPeer::addSelectColumns($criteria);
				if (!isset($this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
					$this->colluserTermRelationshipsRelatedByRelationshipTypeId = userTermRelationshipPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;
		return $this->colluserTermRelationshipsRelatedByRelationshipTypeId;
	}

	
	public function countuserTermRelationshipsRelatedByRelationshipTypeId($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

		return userTermRelationshipPeer::doCount($criteria, $distinct, $con);
	}

	
	public function adduserTermRelationshipRelatedByRelationshipTypeId(userTermRelationship $l)
	{
		$this->colluserTermRelationshipsRelatedByRelationshipTypeId[] = $l;
		$l->setTermRelatedByRelationshipTypeId($this);
	}


	
	public function getuserTermRelationshipsRelatedByRelationshipTypeIdJoinUser($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->colluserTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->colluserTermRelationshipsRelatedByRelationshipTypeId = userTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		} else {
									
			$criteria->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->colluserTermRelationshipsRelatedByRelationshipTypeId = userTermRelationshipPeer::doSelectJoinUser($criteria, $con);
			}
		}
		$this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->colluserTermRelationshipsRelatedByRelationshipTypeId;
	}


	
	public function getuserTermRelationshipsRelatedByRelationshipTypeIdJoinRepository($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseuserTermRelationshipPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->colluserTermRelationshipsRelatedByRelationshipTypeId === null) {
			if ($this->isNew()) {
				$this->colluserTermRelationshipsRelatedByRelationshipTypeId = array();
			} else {

				$criteria->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

				$this->colluserTermRelationshipsRelatedByRelationshipTypeId = userTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		} else {
									
			$criteria->add(userTermRelationshipPeer::RELATIONSHIP_TYPE_ID, $this->getId());

			if (!isset($this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria) || !$this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria->equals($criteria)) {
				$this->colluserTermRelationshipsRelatedByRelationshipTypeId = userTermRelationshipPeer::doSelectJoinRepository($criteria, $con);
			}
		}
		$this->lastuserTermRelationshipRelatedByRelationshipTypeIdCriteria = $criteria;

		return $this->colluserTermRelationshipsRelatedByRelationshipTypeId;
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