<?php


abstract class BaseRightTermRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'right_term_relationship';

	
	const CLASS_DEFAULT = 'lib.model.RightTermRelationship';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'right_term_relationship.ID';

	
	const RIGHT_ID = 'right_term_relationship.RIGHT_ID';

	
	const TERM_ID = 'right_term_relationship.TERM_ID';

	
	const RELATIONSHIP_TYPE_ID = 'right_term_relationship.RELATIONSHIP_TYPE_ID';

	
	const DESCRIPTION = 'right_term_relationship.DESCRIPTION';

	
	const CREATED_AT = 'right_term_relationship.CREATED_AT';

	
	const UPDATED_AT = 'right_term_relationship.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'RightId', 'TermId', 'RelationshipTypeId', 'Description', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (RightTermRelationshipPeer::ID, RightTermRelationshipPeer::RIGHT_ID, RightTermRelationshipPeer::TERM_ID, RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, RightTermRelationshipPeer::DESCRIPTION, RightTermRelationshipPeer::CREATED_AT, RightTermRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'right_id', 'term_id', 'relationship_type_id', 'description', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'RightId' => 1, 'TermId' => 2, 'RelationshipTypeId' => 3, 'Description' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (RightTermRelationshipPeer::ID => 0, RightTermRelationshipPeer::RIGHT_ID => 1, RightTermRelationshipPeer::TERM_ID => 2, RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, RightTermRelationshipPeer::DESCRIPTION => 4, RightTermRelationshipPeer::CREATED_AT => 5, RightTermRelationshipPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'right_id' => 1, 'term_id' => 2, 'relationship_type_id' => 3, 'description' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RightTermRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RightTermRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RightTermRelationshipPeer::getTableMap();
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
		return str_replace(RightTermRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RightTermRelationshipPeer::ID);

		$criteria->addSelectColumn(RightTermRelationshipPeer::RIGHT_ID);

		$criteria->addSelectColumn(RightTermRelationshipPeer::TERM_ID);

		$criteria->addSelectColumn(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(RightTermRelationshipPeer::DESCRIPTION);

		$criteria->addSelectColumn(RightTermRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(RightTermRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(right_term_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT right_term_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = RightTermRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RightTermRelationshipPeer::populateObjects(RightTermRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseRightTermRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RightTermRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RightTermRelationshipPeer::getOMClass();
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
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinRight(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRightTermRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightTermRelationshipPeer::addSelectColumns($c);
		$startcol = (RightTermRelationshipPeer::NUM_COLUMNS - RightTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RightPeer::addSelectColumns($c);

		$c->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightTermRelationshipPeer::getOMClass();

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
										$temp_obj2->addRightTermRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRightTermRelationships();
				$obj2->addRightTermRelationship($obj1); 			}
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

		RightTermRelationshipPeer::addSelectColumns($c);
		$startcol = (RightTermRelationshipPeer::NUM_COLUMNS - RightTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(RightTermRelationshipPeer::TERM_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightTermRelationshipPeer::getOMClass();

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
										$temp_obj2->addRightTermRelationshipRelatedByTermId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRightTermRelationshipsRelatedByTermId();
				$obj2->addRightTermRelationshipRelatedByTermId($obj1); 			}
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

		RightTermRelationshipPeer::addSelectColumns($c);
		$startcol = (RightTermRelationshipPeer::NUM_COLUMNS - RightTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightTermRelationshipPeer::getOMClass();

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
										$temp_obj2->addRightTermRelationshipRelatedByRelationshipTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRightTermRelationshipsRelatedByRelationshipTypeId();
				$obj2->addRightTermRelationshipRelatedByRelationshipTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$criteria->addJoin(RightTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$criteria->addJoin(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRightTermRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightTermRelationshipPeer::NUM_COLUMNS - RightTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RightPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RightPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$c->addJoin(RightTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$c->addJoin(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightTermRelationshipPeer::getOMClass();


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
					$temp_obj2->addRightTermRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRightTermRelationships();
				$obj2->addRightTermRelationship($obj1);
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
					$temp_obj3->addRightTermRelationshipRelatedByTermId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRightTermRelationshipsRelatedByTermId();
				$obj3->addRightTermRelationshipRelatedByTermId($obj1);
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
					$temp_obj4->addRightTermRelationshipRelatedByRelationshipTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRightTermRelationshipsRelatedByRelationshipTypeId();
				$obj4->addRightTermRelationshipRelatedByRelationshipTypeId($obj1);
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
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$criteria->addJoin(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightTermRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);

		$rs = RightTermRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptRight(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRightTermRelationshipPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightTermRelationshipPeer::NUM_COLUMNS - RightTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightTermRelationshipPeer::TERM_ID, TermPeer::ID);

		$c->addJoin(RightTermRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightTermRelationshipPeer::getOMClass();

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
					$temp_obj2->addRightTermRelationshipRelatedByTermId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRightTermRelationshipsRelatedByTermId();
				$obj2->addRightTermRelationshipRelatedByTermId($obj1);
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
					$temp_obj3->addRightTermRelationshipRelatedByRelationshipTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRightTermRelationshipsRelatedByRelationshipTypeId();
				$obj3->addRightTermRelationshipRelatedByRelationshipTypeId($obj1);
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

		RightTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightTermRelationshipPeer::NUM_COLUMNS - RightTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RightPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RightPeer::NUM_COLUMNS;

		$c->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightTermRelationshipPeer::getOMClass();

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
					$temp_obj2->addRightTermRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRightTermRelationships();
				$obj2->addRightTermRelationship($obj1);
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

		RightTermRelationshipPeer::addSelectColumns($c);
		$startcol2 = (RightTermRelationshipPeer::NUM_COLUMNS - RightTermRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RightPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RightPeer::NUM_COLUMNS;

		$c->addJoin(RightTermRelationshipPeer::RIGHT_ID, RightPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightTermRelationshipPeer::getOMClass();

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
					$temp_obj2->addRightTermRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRightTermRelationships();
				$obj2->addRightTermRelationship($obj1);
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
		return RightTermRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRightTermRelationshipPeer', $values, $con);
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

		$criteria->remove(RightTermRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRightTermRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRightTermRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(RightTermRelationshipPeer::ID);
			$selectCriteria->add(RightTermRelationshipPeer::ID, $criteria->remove(RightTermRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRightTermRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRightTermRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(RightTermRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RightTermRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof RightTermRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RightTermRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(RightTermRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RightTermRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RightTermRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RightTermRelationshipPeer::DATABASE_NAME, RightTermRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RightTermRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(RightTermRelationshipPeer::DATABASE_NAME);

		$criteria->add(RightTermRelationshipPeer::ID, $pk);


		$v = RightTermRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(RightTermRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = RightTermRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRightTermRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RightTermRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RightTermRelationshipMapBuilder');
}
