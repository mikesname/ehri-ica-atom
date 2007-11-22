<?php


abstract class BaseActorTermRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'actor_term_relationship';

	
	const CLASS_DEFAULT = 'lib.model.ActorTermRelationship';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'actor_term_relationship.ID';

	
	const ACTOR_ID = 'actor_term_relationship.ACTOR_ID';

	
	const TERM_ID = 'actor_term_relationship.TERM_ID';

	
	const RELATIONSHIP_TYPE_ID = 'actor_term_relationship.RELATIONSHIP_TYPE_ID';

	
	const RELATIONSHIP_NOTE = 'actor_term_relationship.RELATIONSHIP_NOTE';

	
	const RELATIONSHIP_START_DATE = 'actor_term_relationship.RELATIONSHIP_START_DATE';

	
	const RELATIONSHIP_END_DATE = 'actor_term_relationship.RELATIONSHIP_END_DATE';

	
	const DATE_DISPLAY = 'actor_term_relationship.DATE_DISPLAY';

	
	const CREATED_AT = 'actor_term_relationship.CREATED_AT';

	
	const UPDATED_AT = 'actor_term_relationship.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ActorId', 'TermId', 'RelationshipTypeId', 'RelationshipNote', 'RelationshipStartDate', 'RelationshipEndDate', 'DateDisplay', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ActorTermRelationshipPeer::ID, ActorTermRelationshipPeer::ACTOR_ID, ActorTermRelationshipPeer::TERM_ID, ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, ActorTermRelationshipPeer::RELATIONSHIP_NOTE, ActorTermRelationshipPeer::RELATIONSHIP_START_DATE, ActorTermRelationshipPeer::RELATIONSHIP_END_DATE, ActorTermRelationshipPeer::DATE_DISPLAY, ActorTermRelationshipPeer::CREATED_AT, ActorTermRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'actor_id', 'term_id', 'relationship_type_id', 'relationship_note', 'relationship_start_date', 'relationship_end_date', 'date_display', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ActorId' => 1, 'TermId' => 2, 'RelationshipTypeId' => 3, 'RelationshipNote' => 4, 'RelationshipStartDate' => 5, 'RelationshipEndDate' => 6, 'DateDisplay' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (ActorTermRelationshipPeer::ID => 0, ActorTermRelationshipPeer::ACTOR_ID => 1, ActorTermRelationshipPeer::TERM_ID => 2, ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, ActorTermRelationshipPeer::RELATIONSHIP_NOTE => 4, ActorTermRelationshipPeer::RELATIONSHIP_START_DATE => 5, ActorTermRelationshipPeer::RELATIONSHIP_END_DATE => 6, ActorTermRelationshipPeer::DATE_DISPLAY => 7, ActorTermRelationshipPeer::CREATED_AT => 8, ActorTermRelationshipPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'actor_id' => 1, 'term_id' => 2, 'relationship_type_id' => 3, 'relationship_note' => 4, 'relationship_start_date' => 5, 'relationship_end_date' => 6, 'date_display' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ActorTermRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ActorTermRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ActorTermRelationshipPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

  public static function getColumnNames()
  {
    return self::$fieldNames[BasePeer::TYPE_COLNAME];
  }
	
	public static function alias($alias, $column)
	{
		return str_replace(ActorTermRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ActorTermRelationshipPeer::ID);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::ACTOR_ID);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::TERM_ID);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::RELATIONSHIP_NOTE);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::RELATIONSHIP_START_DATE);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::RELATIONSHIP_END_DATE);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::DATE_DISPLAY);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(ActorTermRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(actor_term_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT actor_term_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ActorTermRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ActorTermRelationshipPeer::populateObjects(ActorTermRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseActorTermRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ActorTermRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ActorTermRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByTermId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByRelationshipTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinActor(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseActorTermRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorTermRelationshipPeer::addSelectColumns($c);
		$startcol = (ActorTermRelationshipPeer::NUM_COLUMNS - ActorTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorTermRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addActorTermRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorTermRelationships();
				$obj2->addActorTermRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByTermId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorTermRelationshipPeer::addSelectColumns($c);
		$startcol = (ActorTermRelationshipPeer::NUM_COLUMNS - ActorTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(ActorTermRelationshipPeer::TERM_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorTermRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByTermId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addActorTermRelationshipRelatedByTermId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorTermRelationshipsRelatedByTermId();
				$obj2->addActorTermRelationshipRelatedByTermId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByRelationshipTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorTermRelationshipPeer::addSelectColumns($c);
		$startcol = (ActorTermRelationshipPeer::NUM_COLUMNS - ActorTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorTermRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByRelationshipTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addActorTermRelationshipRelatedByRelationshipTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorTermRelationshipsRelatedByRelationshipTypeId();
				$obj2->addActorTermRelationshipRelatedByRelationshipTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(ActorTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$criteria->addJoin(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseActorTermRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorTermRelationshipPeer::NUM_COLUMNS - ActorTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(ActorTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$c->addJoin(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorTermRelationshipPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addActorTermRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initActorTermRelationships();
				$obj2->addActorTermRelationship($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByTermId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addActorTermRelationshipRelatedByTermId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initActorTermRelationshipsRelatedByTermId();
				$obj3->addActorTermRelationshipRelatedByTermId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTermRelatedByRelationshipTypeId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addActorTermRelationshipRelatedByRelationshipTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initActorTermRelationshipsRelatedByRelationshipTypeId();
				$obj4->addActorTermRelationshipRelatedByRelationshipTypeId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$criteria->addJoin(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByTermId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByRelationshipTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$rs = ActorTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptActor(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseActorTermRelationshipPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorTermRelationshipPeer::NUM_COLUMNS - ActorTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ActorTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$c->addJoin(ActorTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorTermRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTermRelatedByTermId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addActorTermRelationshipRelatedByTermId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initActorTermRelationshipsRelatedByTermId();
				$obj2->addActorTermRelationshipRelatedByTermId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByRelationshipTypeId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addActorTermRelationshipRelatedByRelationshipTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initActorTermRelationshipsRelatedByRelationshipTypeId();
				$obj3->addActorTermRelationshipRelatedByRelationshipTypeId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByTermId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorTermRelationshipPeer::NUM_COLUMNS - ActorTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorTermRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addActorTermRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initActorTermRelationships();
				$obj2->addActorTermRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByRelationshipTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorTermRelationshipPeer::NUM_COLUMNS - ActorTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(ActorTermRelationshipPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorTermRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addActorTermRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initActorTermRelationships();
				$obj2->addActorTermRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ActorTermRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseActorTermRelationshipPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(ActorTermRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseActorTermRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseActorTermRelationshipPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ActorTermRelationshipPeer::ID);
			$selectCriteria->add(ActorTermRelationshipPeer::ID, $criteria->remove(ActorTermRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseActorTermRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseActorTermRelationshipPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ActorTermRelationshipPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ActorTermRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ActorTermRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ActorTermRelationshipPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(ActorTermRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ActorTermRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ActorTermRelationshipPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(ActorTermRelationshipPeer::DATABASE_NAME, ActorTermRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ActorTermRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ActorTermRelationshipPeer::DATABASE_NAME);

		$criteria->add(ActorTermRelationshipPeer::ID, $pk);


		$v = ActorTermRelationshipPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(ActorTermRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = ActorTermRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseActorTermRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ActorTermRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ActorTermRelationshipMapBuilder');
}
