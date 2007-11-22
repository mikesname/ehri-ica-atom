<?php


abstract class BaseActorRecursiveRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'actor_recursive_relationship';

	
	const CLASS_DEFAULT = 'lib.model.ActorRecursiveRelationship';

	
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
		BasePeer::TYPE_COLNAME => array (ActorRecursiveRelationshipPeer::ID, ActorRecursiveRelationshipPeer::ACTOR_ID, ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, ActorRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION, ActorRecursiveRelationshipPeer::RELATIONSHIP_START_DATE, ActorRecursiveRelationshipPeer::RELATIONSHIP_END_DATE, ActorRecursiveRelationshipPeer::DATE_DISPLAY, ActorRecursiveRelationshipPeer::CREATED_AT, ActorRecursiveRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'actor_id', 'related_actor_id', 'relationship_type_id', 'relationship_description', 'relationship_start_date', 'relationship_end_date', 'date_display', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ActorId' => 1, 'RelatedActorId' => 2, 'RelationshipTypeId' => 3, 'RelationshipDescription' => 4, 'RelationshipStartDate' => 5, 'RelationshipEndDate' => 6, 'DateDisplay' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (ActorRecursiveRelationshipPeer::ID => 0, ActorRecursiveRelationshipPeer::ACTOR_ID => 1, ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID => 2, ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, ActorRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION => 4, ActorRecursiveRelationshipPeer::RELATIONSHIP_START_DATE => 5, ActorRecursiveRelationshipPeer::RELATIONSHIP_END_DATE => 6, ActorRecursiveRelationshipPeer::DATE_DISPLAY => 7, ActorRecursiveRelationshipPeer::CREATED_AT => 8, ActorRecursiveRelationshipPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'actor_id' => 1, 'related_actor_id' => 2, 'relationship_type_id' => 3, 'relationship_description' => 4, 'relationship_start_date' => 5, 'relationship_end_date' => 6, 'date_display' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ActorRecursiveRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ActorRecursiveRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ActorRecursiveRelationshipPeer::getTableMap();
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
		return str_replace(ActorRecursiveRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::ID);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::ACTOR_ID);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::RELATIONSHIP_START_DATE);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::RELATIONSHIP_END_DATE);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::DATE_DISPLAY);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(actor_recursive_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT actor_recursive_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = ActorRecursiveRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ActorRecursiveRelationshipPeer::populateObjects(ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ActorRecursiveRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ActorRecursiveRelationshipPeer::getOMClass();
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
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinActorRelatedByActorId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (ActorRecursiveRelationshipPeer::NUM_COLUMNS - ActorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(ActorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorRecursiveRelationshipPeer::getOMClass();

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
										$temp_obj2->addActorRecursiveRelationshipRelatedByActorId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorRecursiveRelationshipsRelatedByActorId();
				$obj2->addActorRecursiveRelationshipRelatedByActorId($obj1); 			}
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

		ActorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (ActorRecursiveRelationshipPeer::NUM_COLUMNS - ActorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorRecursiveRelationshipPeer::getOMClass();

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
										$temp_obj2->addActorRecursiveRelationshipRelatedByRelatedActorId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorRecursiveRelationshipsRelatedByRelatedActorId();
				$obj2->addActorRecursiveRelationshipRelatedByRelatedActorId($obj1); 			}
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

		ActorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (ActorRecursiveRelationshipPeer::NUM_COLUMNS - ActorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorRecursiveRelationshipPeer::getOMClass();

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
										$temp_obj2->addActorRecursiveRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorRecursiveRelationships();
				$obj2->addActorRecursiveRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorRecursiveRelationshipPeer::NUM_COLUMNS - ActorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ActorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$c->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorRecursiveRelationshipPeer::getOMClass();


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
					$temp_obj2->addActorRecursiveRelationshipRelatedByActorId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initActorRecursiveRelationshipsRelatedByActorId();
				$obj2->addActorRecursiveRelationshipRelatedByActorId($obj1);
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
					$temp_obj3->addActorRecursiveRelationshipRelatedByRelatedActorId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initActorRecursiveRelationshipsRelatedByRelatedActorId();
				$obj3->addActorRecursiveRelationshipRelatedByRelatedActorId($obj1);
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
					$temp_obj4->addActorRecursiveRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initActorRecursiveRelationships();
				$obj4->addActorRecursiveRelationship($obj1);
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
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);

		$rs = ActorRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptActorRelatedByActorId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorRecursiveRelationshipPeer::NUM_COLUMNS - ActorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addActorRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initActorRecursiveRelationships();
				$obj2->addActorRecursiveRelationship($obj1);
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

		ActorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorRecursiveRelationshipPeer::NUM_COLUMNS - ActorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ActorRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addActorRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initActorRecursiveRelationships();
				$obj2->addActorRecursiveRelationship($obj1);
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

		ActorRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (ActorRecursiveRelationshipPeer::NUM_COLUMNS - ActorRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(ActorRecursiveRelationshipPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(ActorRecursiveRelationshipPeer::RELATED_ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addActorRecursiveRelationshipRelatedByActorId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initActorRecursiveRelationshipsRelatedByActorId();
				$obj2->addActorRecursiveRelationshipRelatedByActorId($obj1);
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
					$temp_obj3->addActorRecursiveRelationshipRelatedByRelatedActorId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initActorRecursiveRelationshipsRelatedByRelatedActorId();
				$obj3->addActorRecursiveRelationshipRelatedByRelatedActorId($obj1);
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
		return ActorRecursiveRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $values, $con);
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

		$criteria->remove(ActorRecursiveRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(ActorRecursiveRelationshipPeer::ID);
			$selectCriteria->add(ActorRecursiveRelationshipPeer::ID, $criteria->remove(ActorRecursiveRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseActorRecursiveRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseActorRecursiveRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ActorRecursiveRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ActorRecursiveRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ActorRecursiveRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ActorRecursiveRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ActorRecursiveRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ActorRecursiveRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ActorRecursiveRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ActorRecursiveRelationshipPeer::DATABASE_NAME, ActorRecursiveRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ActorRecursiveRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ActorRecursiveRelationshipPeer::DATABASE_NAME);

		$criteria->add(ActorRecursiveRelationshipPeer::ID, $pk);


		$v = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(ActorRecursiveRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = ActorRecursiveRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseActorRecursiveRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ActorRecursiveRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ActorRecursiveRelationshipMapBuilder');
}
