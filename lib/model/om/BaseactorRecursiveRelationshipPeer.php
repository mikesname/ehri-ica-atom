<?php


abstract class BaseactorRecursiveRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'actor_recursive_relationship';

	
	const CLASS_DEFAULT = 'lib.model.actorRecursiveRelationship';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'actor_recursive_relationship.ID';

	
	const ACTOR_ID = 'actor_recursive_relationship.ACTOR_ID';

	
	const RELATED_ACTOR_ID = 'actor_recursive_relationship.RELATED_ACTOR_ID';

	
	const RELATIONSHIP_TYPE_ID = 'actor_recursive_relationship.RELATIONSHIP_TYPE_ID';

	
	const RELATIONSHIP_DESCRIPTION = 'actor_recursive_relationship.RELATIONSHIP_DESCRIPTION';

	
	const RELATIONSHIP_START_DATE = 'actor_recursive_relationship.RELATIONSHIP_START_DATE';

	
	const RELATIONSHIP_END_DATE = 'actor_recursive_relationship.RELATIONSHIP_END_DATE';

	
	const DATE_DISPLAY = 'actor_recursive_relationship.DATE_DISPLAY';

	
	const CREATED_AT = 'actor_recursive_relationship.CREATED_AT';

	
	const UPDATED_AT = 'actor_recursive_relationship.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ActorId', 'RelatedActorId', 'RelationshipTypeId', 'RelationshipDescription', 'RelationshipStartDate', 'RelationshipEndDate', 'DateDisplay', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (actorRecursiveRelationshipPeer::ID, actorRecursiveRelationshipPeer::ACTOR_ID, actorRecursiveRelationshipPeer::RELATED_ACTOR_ID, actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, actorRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION, actorRecursiveRelationshipPeer::RELATIONSHIP_START_DATE, actorRecursiveRelationshipPeer::RELATIONSHIP_END_DATE, actorRecursiveRelationshipPeer::DATE_DISPLAY, actorRecursiveRelationshipPeer::CREATED_AT, actorRecursiveRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'actor_id', 'related_actor_id', 'relationship_type_id', 'relationship_description', 'relationship_start_date', 'relationship_end_date', 'date_display', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ActorId' => 1, 'RelatedActorId' => 2, 'RelationshipTypeId' => 3, 'RelationshipDescription' => 4, 'RelationshipStartDate' => 5, 'RelationshipEndDate' => 6, 'DateDisplay' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (actorRecursiveRelationshipPeer::ID => 0, actorRecursiveRelationshipPeer::ACTOR_ID => 1, actorRecursiveRelationshipPeer::RELATED_ACTOR_ID => 2, actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, actorRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION => 4, actorRecursiveRelationshipPeer::RELATIONSHIP_START_DATE => 5, actorRecursiveRelationshipPeer::RELATIONSHIP_END_DATE => 6, actorRecursiveRelationshipPeer::DATE_DISPLAY => 7, actorRecursiveRelationshipPeer::CREATED_AT => 8, actorRecursiveRelationshipPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'actor_id' => 1, 'related_actor_id' => 2, 'relationship_type_id' => 3, 'relationship_description' => 4, 'relationship_start_date' => 5, 'relationship_end_date' => 6, 'date_display' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/actorRecursiveRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.actorRecursiveRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = actorRecursiveRelationshipPeer::getTableMap();
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

	
	public static function alias($alias, $column)
	{
		return str_replace(actorRecursiveRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::ID);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::ACTOR_ID);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::RELATED_ACTOR_ID);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::RELATIONSHIP_START_DATE);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::RELATIONSHIP_END_DATE);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::DATE_DISPLAY);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(actorRecursiveRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(actor_recursive_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT actor_recursive_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = actorRecursiveRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return actorRecursiveRelationshipPeer::populateObjects(actorRecursiveRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseactorRecursiveRelationshipPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseactorRecursiveRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			actorRecursiveRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = actorRecursiveRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinActorRelatedByActorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(actorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinActorRelatedByRelatedActorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(actorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTerm(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinActorRelatedByActorId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		actorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (actorRecursiveRelationshipPeer::NUM_COLUMNS - actorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(actorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = actorRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getActorRelatedByActorId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addactorRecursiveRelationshipRelatedByActorId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initactorRecursiveRelationshipsRelatedByActorId();
				$obj2->addactorRecursiveRelationshipRelatedByActorId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinActorRelatedByRelatedActorId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		actorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (actorRecursiveRelationshipPeer::NUM_COLUMNS - actorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(actorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = actorRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getActorRelatedByRelatedActorId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addactorRecursiveRelationshipRelatedByRelatedActorId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initactorRecursiveRelationshipsRelatedByRelatedActorId();
				$obj2->addactorRecursiveRelationshipRelatedByRelatedActorId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTerm(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		actorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (actorRecursiveRelationshipPeer::NUM_COLUMNS - actorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = actorRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTerm(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addactorRecursiveRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initactorRecursiveRelationships();
				$obj2->addactorRecursiveRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(actorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(actorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		actorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (actorRecursiveRelationshipPeer::NUM_COLUMNS - actorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(actorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(actorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$c->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = actorRecursiveRelationshipPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getActorRelatedByActorId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addactorRecursiveRelationshipRelatedByActorId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initactorRecursiveRelationshipsRelatedByActorId();
				$obj2->addactorRecursiveRelationshipRelatedByActorId($obj1);
			}


					
			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getActorRelatedByRelatedActorId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addactorRecursiveRelationshipRelatedByRelatedActorId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initactorRecursiveRelationshipsRelatedByRelatedActorId();
				$obj3->addactorRecursiveRelationshipRelatedByRelatedActorId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTerm(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addactorRecursiveRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initactorRecursiveRelationships();
				$obj4->addactorRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptActorRelatedByActorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptActorRelatedByRelatedActorId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTerm(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(actorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(actorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(actorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$rs = actorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptActorRelatedByActorId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		actorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (actorRecursiveRelationshipPeer::NUM_COLUMNS - actorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = actorRecursiveRelationshipPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTerm(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addactorRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initactorRecursiveRelationships();
				$obj2->addactorRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptActorRelatedByRelatedActorId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		actorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (actorRecursiveRelationshipPeer::NUM_COLUMNS - actorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(actorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = actorRecursiveRelationshipPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTerm(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addactorRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initactorRecursiveRelationships();
				$obj2->addactorRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTerm(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		actorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (actorRecursiveRelationshipPeer::NUM_COLUMNS - actorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(actorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(actorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = actorRecursiveRelationshipPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getActorRelatedByActorId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addactorRecursiveRelationshipRelatedByActorId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initactorRecursiveRelationshipsRelatedByActorId();
				$obj2->addactorRecursiveRelationshipRelatedByActorId($obj1);
			}

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getActorRelatedByRelatedActorId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addactorRecursiveRelationshipRelatedByRelatedActorId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initactorRecursiveRelationshipsRelatedByRelatedActorId();
				$obj3->addactorRecursiveRelationshipRelatedByRelatedActorId($obj1);
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
		return actorRecursiveRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseactorRecursiveRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseactorRecursiveRelationshipPeer', $values, $con);
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

		$criteria->remove(actorRecursiveRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseactorRecursiveRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseactorRecursiveRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseactorRecursiveRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseactorRecursiveRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(actorRecursiveRelationshipPeer::ID);
			$selectCriteria->add(actorRecursiveRelationshipPeer::ID, $criteria->remove(actorRecursiveRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseactorRecursiveRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseactorRecursiveRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(actorRecursiveRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(actorRecursiveRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof actorRecursiveRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(actorRecursiveRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(actorRecursiveRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(actorRecursiveRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(actorRecursiveRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(actorRecursiveRelationshipPeer::DATABASE_NAME, actorRecursiveRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = actorRecursiveRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(actorRecursiveRelationshipPeer::DATABASE_NAME);

		$criteria->add(actorRecursiveRelationshipPeer::ID, $pk);


		$v = actorRecursiveRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(actorRecursiveRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = actorRecursiveRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseactorRecursiveRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/actorRecursiveRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.actorRecursiveRelationshipMapBuilder');
}
