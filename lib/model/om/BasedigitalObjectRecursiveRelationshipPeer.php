<?php


abstract class BasedigitalObjectRecursiveRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'digital_object_recursive_relationship';

	
	const CLASS_DEFAULT = 'lib.model.digitalObjectRecursiveRelationship';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'digital_object_recursive_relationship.ID';

	
	const DIGITAL_OBJECT_ID = 'digital_object_recursive_relationship.DIGITAL_OBJECT_ID';

	
	const RELATED_DIGITAL_OBJECT_ID = 'digital_object_recursive_relationship.RELATED_DIGITAL_OBJECT_ID';

	
	const RELATIONSHIP_TYPE_ID = 'digital_object_recursive_relationship.RELATIONSHIP_TYPE_ID';

	
	const RELATIONSHIP_DESCRIPTION = 'digital_object_recursive_relationship.RELATIONSHIP_DESCRIPTION';

	
	const CREATED_AT = 'digital_object_recursive_relationship.CREATED_AT';

	
	const UPDATED_AT = 'digital_object_recursive_relationship.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DigitalObjectId', 'RelatedDigitalObjectId', 'RelationshipTypeId', 'RelationshipDescription', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (digitalObjectRecursiveRelationshipPeer::ID, digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION, digitalObjectRecursiveRelationshipPeer::CREATED_AT, digitalObjectRecursiveRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'digital_object_id', 'related_digital_object_id', 'relationship_type_id', 'relationship_description', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DigitalObjectId' => 1, 'RelatedDigitalObjectId' => 2, 'RelationshipTypeId' => 3, 'RelationshipDescription' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (digitalObjectRecursiveRelationshipPeer::ID => 0, digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID => 1, digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID => 2, digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION => 4, digitalObjectRecursiveRelationshipPeer::CREATED_AT => 5, digitalObjectRecursiveRelationshipPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'digital_object_id' => 1, 'related_digital_object_id' => 2, 'relationship_type_id' => 3, 'relationship_description' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/digitalObjectRecursiveRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.digitalObjectRecursiveRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = digitalObjectRecursiveRelationshipPeer::getTableMap();
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
		return str_replace(digitalObjectRecursiveRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::ID);

		$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID);

		$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID);

		$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION);

		$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(digital_object_recursive_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT digital_object_recursive_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = digitalObjectRecursiveRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return digitalObjectRecursiveRelationshipPeer::populateObjects(digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationshipPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasedigitalObjectRecursiveRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			digitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = digitalObjectRecursiveRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoindigitalObjectRelatedByDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoindigitalObjectRelatedByRelatedDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoindigitalObjectRelatedByDigitalObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (digitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - digitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		digitalObjectPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getdigitalObjectRelatedByDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId();
				$obj2->adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoindigitalObjectRelatedByRelatedDigitalObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (digitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - digitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		digitalObjectPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, digitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getdigitalObjectRelatedByRelatedDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId();
				$obj2->adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1); 			}
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

		digitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (digitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - digitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectRecursiveRelationshipPeer::getOMClass();

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
										$temp_obj2->adddigitalObjectRecursiveRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectRecursiveRelationships();
				$obj2->adddigitalObjectRecursiveRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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

		digitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - digitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		digitalObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + digitalObjectPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + digitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectRecursiveRelationshipPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getdigitalObjectRelatedByDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId();
				$obj2->adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1);
			}


					
			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getdigitalObjectRelatedByRelatedDigitalObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId();
				$obj3->adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1);
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
					$temp_obj4->adddigitalObjectRecursiveRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initdigitalObjectRecursiveRelationships();
				$obj4->adddigitalObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptdigitalObjectRelatedByDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptdigitalObjectRelatedByRelatedDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$criteria->addJoin(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$rs = digitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptdigitalObjectRelatedByDigitalObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - digitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->adddigitalObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjectRecursiveRelationships();
				$obj2->adddigitalObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptdigitalObjectRelatedByRelatedDigitalObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - digitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->adddigitalObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjectRecursiveRelationships();
				$obj2->adddigitalObjectRecursiveRelationship($obj1);
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

		digitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - digitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		digitalObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + digitalObjectPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + digitalObjectPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$c->addJoin(digitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, digitalObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getdigitalObjectRelatedByDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId();
				$obj2->adddigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1);
			}

			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getdigitalObjectRelatedByRelatedDigitalObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initdigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId();
				$obj3->adddigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1);
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
		return digitalObjectRecursiveRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasedigitalObjectRecursiveRelationshipPeer', $values, $con);
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

		$criteria->remove(digitalObjectRecursiveRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasedigitalObjectRecursiveRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasedigitalObjectRecursiveRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(digitalObjectRecursiveRelationshipPeer::ID);
			$selectCriteria->add(digitalObjectRecursiveRelationshipPeer::ID, $criteria->remove(digitalObjectRecursiveRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasedigitalObjectRecursiveRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasedigitalObjectRecursiveRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(digitalObjectRecursiveRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof digitalObjectRecursiveRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(digitalObjectRecursiveRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(digitalObjectRecursiveRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(digitalObjectRecursiveRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME, digitalObjectRecursiveRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = digitalObjectRecursiveRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(digitalObjectRecursiveRelationshipPeer::DATABASE_NAME);

		$criteria->add(digitalObjectRecursiveRelationshipPeer::ID, $pk);


		$v = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(digitalObjectRecursiveRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = digitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasedigitalObjectRecursiveRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/digitalObjectRecursiveRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.digitalObjectRecursiveRelationshipMapBuilder');
}
