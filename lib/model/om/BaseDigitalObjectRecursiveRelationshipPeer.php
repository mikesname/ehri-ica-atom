<?php


abstract class BaseDigitalObjectRecursiveRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'digital_object_recursive_relationship';

	
	const CLASS_DEFAULT = 'lib.model.DigitalObjectRecursiveRelationship';

	
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
		BasePeer::TYPE_COLNAME => array (DigitalObjectRecursiveRelationshipPeer::ID, DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION, DigitalObjectRecursiveRelationshipPeer::CREATED_AT, DigitalObjectRecursiveRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'digital_object_id', 'related_digital_object_id', 'relationship_type_id', 'relationship_description', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DigitalObjectId' => 1, 'RelatedDigitalObjectId' => 2, 'RelationshipTypeId' => 3, 'RelationshipDescription' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (DigitalObjectRecursiveRelationshipPeer::ID => 0, DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID => 1, DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID => 2, DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION => 4, DigitalObjectRecursiveRelationshipPeer::CREATED_AT => 5, DigitalObjectRecursiveRelationshipPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'digital_object_id' => 1, 'related_digital_object_id' => 2, 'relationship_type_id' => 3, 'relationship_description' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DigitalObjectRecursiveRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DigitalObjectRecursiveRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DigitalObjectRecursiveRelationshipPeer::getTableMap();
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
		return str_replace(DigitalObjectRecursiveRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::ID);

		$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID);

		$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID);

		$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION);

		$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(digital_object_recursive_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT digital_object_recursive_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = DigitalObjectRecursiveRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DigitalObjectRecursiveRelationshipPeer::populateObjects(DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DigitalObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DigitalObjectRecursiveRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDigitalObjectRelatedByDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDigitalObjectRelatedByRelatedDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDigitalObjectRelatedByDigitalObjectId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (DigitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - DigitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DigitalObjectPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DigitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDigitalObjectRelatedByDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId();
				$obj2->addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDigitalObjectRelatedByRelatedDigitalObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (DigitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - DigitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DigitalObjectPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DigitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDigitalObjectRelatedByRelatedDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId();
				$obj2->addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1); 			}
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

		DigitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (DigitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - DigitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectRecursiveRelationshipPeer::getOMClass();

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
										$temp_obj2->addDigitalObjectRecursiveRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectRecursiveRelationships();
				$obj2->addDigitalObjectRecursiveRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - DigitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DigitalObjectPeer::NUM_COLUMNS;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DigitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectRecursiveRelationshipPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDigitalObjectRelatedByDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId();
				$obj2->addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1);
			}


					
			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDigitalObjectRelatedByRelatedDigitalObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId();
				$obj3->addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1);
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
					$temp_obj4->addDigitalObjectRecursiveRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initDigitalObjectRecursiveRelationships();
				$obj4->addDigitalObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptDigitalObjectRelatedByDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDigitalObjectRelatedByRelatedDigitalObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$criteria->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$rs = DigitalObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptDigitalObjectRelatedByDigitalObjectId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - DigitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addDigitalObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjectRecursiveRelationships();
				$obj2->addDigitalObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDigitalObjectRelatedByRelatedDigitalObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - DigitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addDigitalObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjectRecursiveRelationships();
				$obj2->addDigitalObjectRecursiveRelationship($obj1);
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

		DigitalObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectRecursiveRelationshipPeer::NUM_COLUMNS - DigitalObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DigitalObjectPeer::NUM_COLUMNS;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DigitalObjectPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$c->addJoin(DigitalObjectRecursiveRelationshipPeer::RELATED_DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDigitalObjectRelatedByDigitalObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjectRecursiveRelationshipsRelatedByDigitalObjectId();
				$obj2->addDigitalObjectRecursiveRelationshipRelatedByDigitalObjectId($obj1);
			}

			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDigitalObjectRelatedByRelatedDigitalObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDigitalObjectRecursiveRelationshipsRelatedByRelatedDigitalObjectId();
				$obj3->addDigitalObjectRecursiveRelationshipRelatedByRelatedDigitalObjectId($obj1);
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
		return DigitalObjectRecursiveRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $values, $con);
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

		$criteria->remove(DigitalObjectRecursiveRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(DigitalObjectRecursiveRelationshipPeer::ID);
			$selectCriteria->add(DigitalObjectRecursiveRelationshipPeer::ID, $criteria->remove(DigitalObjectRecursiveRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDigitalObjectRecursiveRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectRecursiveRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(DigitalObjectRecursiveRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DigitalObjectRecursiveRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DigitalObjectRecursiveRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DigitalObjectRecursiveRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DigitalObjectRecursiveRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DigitalObjectRecursiveRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DigitalObjectRecursiveRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DigitalObjectRecursiveRelationshipPeer::DATABASE_NAME, DigitalObjectRecursiveRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DigitalObjectRecursiveRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DigitalObjectRecursiveRelationshipPeer::DATABASE_NAME);

		$criteria->add(DigitalObjectRecursiveRelationshipPeer::ID, $pk);


		$v = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(DigitalObjectRecursiveRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = DigitalObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDigitalObjectRecursiveRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DigitalObjectRecursiveRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DigitalObjectRecursiveRelationshipMapBuilder');
}
