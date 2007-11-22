<?php


abstract class BaseRightActorRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'right_actor_relationship';

	
	const CLASS_DEFAULT = 'lib.model.RightActorRelationship';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'right_actor_relationship.ID';

	
	const RIGHT_ID = 'right_actor_relationship.RIGHT_ID';

	
	const ACTOR_ID = 'right_actor_relationship.ACTOR_ID';

	
	const RELATIONSHIP_TYPE_ID = 'right_actor_relationship.RELATIONSHIP_TYPE_ID';

	
	const DESCRIPTION = 'right_actor_relationship.DESCRIPTION';

	
	const CREATED_AT = 'right_actor_relationship.CREATED_AT';

	
	const UPDATED_AT = 'right_actor_relationship.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'RightId', 'ActorId', 'RelationshipTypeId', 'Description', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (RightActorRelationshipPeer::ID, RightActorRelationshipPeer::RIGHT_ID, RightActorRelationshipPeer::ACTOR_ID, RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, RightActorRelationshipPeer::DESCRIPTION, RightActorRelationshipPeer::CREATED_AT, RightActorRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'right_id', 'actor_id', 'relationship_type_id', 'description', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'RightId' => 1, 'ActorId' => 2, 'RelationshipTypeId' => 3, 'Description' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (RightActorRelationshipPeer::ID => 0, RightActorRelationshipPeer::RIGHT_ID => 1, RightActorRelationshipPeer::ACTOR_ID => 2, RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, RightActorRelationshipPeer::DESCRIPTION => 4, RightActorRelationshipPeer::CREATED_AT => 5, RightActorRelationshipPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'right_id' => 1, 'actor_id' => 2, 'relationship_type_id' => 3, 'description' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RightActorRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RightActorRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RightActorRelationshipPeer::getTableMap();
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
		return str_replace(RightActorRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RightActorRelationshipPeer::ID);

		$criteria->addSelectColumn(RightActorRelationshipPeer::RIGHT_ID);

		$criteria->addSelectColumn(RightActorRelationshipPeer::ACTOR_ID);

		$criteria->addSelectColumn(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(RightActorRelationshipPeer::DESCRIPTION);

		$criteria->addSelectColumn(RightActorRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(RightActorRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(right_actor_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT right_actor_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = RightActorRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RightActorRelationshipPeer::populateObjects(RightActorRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseRightActorRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RightActorRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RightActorRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinRight(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinRight(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRightActorRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightActorRelationshipPeer::addSelectColumns($c);
		$startcol = (RightActorRelationshipPeer::NUM_COLUMNS - RightActorRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RightPeer::addSelectColumns($c);

		$c->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightActorRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RightPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRight(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRightActorRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRightActorRelationships();
				$obj2->addRightActorRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinActor(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightActorRelationshipPeer::addSelectColumns($c);
		$startcol = (RightActorRelationshipPeer::NUM_COLUMNS - RightActorRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightActorRelationshipPeer::getOMClass();

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
										$temp_obj2->addRightActorRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRightActorRelationships();
				$obj2->addRightActorRelationship($obj1); 			}
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

		RightActorRelationshipPeer::addSelectColumns($c);
		$startcol = (RightActorRelationshipPeer::NUM_COLUMNS - RightActorRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightActorRelationshipPeer::getOMClass();

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
										$temp_obj2->addRightActorRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRightActorRelationships();
				$obj2->addRightActorRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$criteria->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRightActorRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightActorRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightActorRelationshipPeer::NUM_COLUMNS - RightActorRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RightPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RightPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$c->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightActorRelationshipPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = RightPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRight(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRightActorRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRightActorRelationships();
				$obj2->addRightActorRelationship($obj1);
			}


					
			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getActor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRightActorRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRightActorRelationships();
				$obj3->addRightActorRelationship($obj1);
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
					$temp_obj4->addRightActorRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRightActorRelationships();
				$obj4->addRightActorRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptRight(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$criteria->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightActorRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$criteria->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$rs = RightActorRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptRight(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRightActorRelationshipPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightActorRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightActorRelationshipPeer::NUM_COLUMNS - RightActorRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightActorRelationshipPeer::getOMClass();

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
					$temp_obj2->addRightActorRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRightActorRelationships();
				$obj2->addRightActorRelationship($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTerm(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRightActorRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRightActorRelationships();
				$obj3->addRightActorRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptActor(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightActorRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightActorRelationshipPeer::NUM_COLUMNS - RightActorRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RightPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RightPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$c->addJoin(RightActorRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightActorRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RightPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRight(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRightActorRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRightActorRelationships();
				$obj2->addRightActorRelationship($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTerm(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRightActorRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRightActorRelationships();
				$obj3->addRightActorRelationship($obj1);
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

		RightActorRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightActorRelationshipPeer::NUM_COLUMNS - RightActorRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RightPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RightPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(RightActorRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$c->addJoin(RightActorRelationshipPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightActorRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RightPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRight(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRightActorRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRightActorRelationships();
				$obj2->addRightActorRelationship($obj1);
			}

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getActor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRightActorRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRightActorRelationships();
				$obj3->addRightActorRelationship($obj1);
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
		return RightActorRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRightActorRelationshipPeer', $values, $con);
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

		$criteria->remove(RightActorRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRightActorRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRightActorRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(RightActorRelationshipPeer::ID);
			$selectCriteria->add(RightActorRelationshipPeer::ID, $criteria->remove(RightActorRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRightActorRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRightActorRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(RightActorRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RightActorRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RightActorRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RightActorRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(RightActorRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RightActorRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RightActorRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RightActorRelationshipPeer::DATABASE_NAME, RightActorRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RightActorRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(RightActorRelationshipPeer::DATABASE_NAME);

		$criteria->add(RightActorRelationshipPeer::ID, $pk);


		$v = RightActorRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(RightActorRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = RightActorRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRightActorRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RightActorRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RightActorRelationshipMapBuilder');
}
