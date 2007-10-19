<?php


abstract class BaseinformationObjectRecursiveRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'information_object_recursive_relationship';

	
	const CLASS_DEFAULT = 'lib.model.informationObjectRecursiveRelationship';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'information_object_recursive_relationship.ID';

	
	const INFORMATION_OBJECT_ID = 'information_object_recursive_relationship.INFORMATION_OBJECT_ID';

	
	const RELATED_INFORMATION_OBJECT_ID = 'information_object_recursive_relationship.RELATED_INFORMATION_OBJECT_ID';

	
	const RELATIONSHIP_TYPE_ID = 'information_object_recursive_relationship.RELATIONSHIP_TYPE_ID';

	
	const RELATIONSHIP_DESCRIPTION = 'information_object_recursive_relationship.RELATIONSHIP_DESCRIPTION';

	
	const RELATIONSHIP_START_DATE = 'information_object_recursive_relationship.RELATIONSHIP_START_DATE';

	
	const RELATIONSHIP_END_DATE = 'information_object_recursive_relationship.RELATIONSHIP_END_DATE';

	
	const DATE_DISPLAY = 'information_object_recursive_relationship.DATE_DISPLAY';

	
	const CREATED_AT = 'information_object_recursive_relationship.CREATED_AT';

	
	const UPDATED_AT = 'information_object_recursive_relationship.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'InformationObjectId', 'RelatedInformationObjectId', 'RelationshipTypeId', 'RelationshipDescription', 'RelationshipStartDate', 'RelationshipEndDate', 'DateDisplay', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (informationObjectRecursiveRelationshipPeer::ID, informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_START_DATE, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_END_DATE, informationObjectRecursiveRelationshipPeer::DATE_DISPLAY, informationObjectRecursiveRelationshipPeer::CREATED_AT, informationObjectRecursiveRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'information_object_id', 'related_information_object_id', 'relationship_type_id', 'relationship_description', 'relationship_start_date', 'relationship_end_date', 'date_display', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'InformationObjectId' => 1, 'RelatedInformationObjectId' => 2, 'RelationshipTypeId' => 3, 'RelationshipDescription' => 4, 'RelationshipStartDate' => 5, 'RelationshipEndDate' => 6, 'DateDisplay' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (informationObjectRecursiveRelationshipPeer::ID => 0, informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID => 1, informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID => 2, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION => 4, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_START_DATE => 5, informationObjectRecursiveRelationshipPeer::RELATIONSHIP_END_DATE => 6, informationObjectRecursiveRelationshipPeer::DATE_DISPLAY => 7, informationObjectRecursiveRelationshipPeer::CREATED_AT => 8, informationObjectRecursiveRelationshipPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'information_object_id' => 1, 'related_information_object_id' => 2, 'relationship_type_id' => 3, 'relationship_description' => 4, 'relationship_start_date' => 5, 'relationship_end_date' => 6, 'date_display' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/informationObjectRecursiveRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.informationObjectRecursiveRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = informationObjectRecursiveRelationshipPeer::getTableMap();
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
		return str_replace(informationObjectRecursiveRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::ID);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_START_DATE);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_END_DATE);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::DATE_DISPLAY);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(information_object_recursive_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT information_object_recursive_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = informationObjectRecursiveRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return informationObjectRecursiveRelationshipPeer::populateObjects(informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseinformationObjectRecursiveRelationshipPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseinformationObjectRecursiveRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			informationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = informationObjectRecursiveRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoininformationObjectRelatedByInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoininformationObjectRelatedByRelatedInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoininformationObjectRelatedByInformationObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (informationObjectRecursiveRelationshipPeer::NUM_COLUMNS - informationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		informationObjectPeer::addSelectColumns($c);

		$c->addJoin(informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getinformationObjectRelatedByInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addinformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initinformationObjectRecursiveRelationshipsRelatedByInformationObjectId();
				$obj2->addinformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoininformationObjectRelatedByRelatedInformationObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (informationObjectRecursiveRelationshipPeer::NUM_COLUMNS - informationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		informationObjectPeer::addSelectColumns($c);

		$c->addJoin(informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, informationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getinformationObjectRelatedByRelatedInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addinformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initinformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId();
				$obj2->addinformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1); 			}
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

		informationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (informationObjectRecursiveRelationshipPeer::NUM_COLUMNS - informationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectRecursiveRelationshipPeer::getOMClass();

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
										$temp_obj2->addinformationObjectRecursiveRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initinformationObjectRecursiveRelationships();
				$obj2->addinformationObjectRecursiveRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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

		informationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (informationObjectRecursiveRelationshipPeer::NUM_COLUMNS - informationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		informationObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + informationObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectRecursiveRelationshipPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = informationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getinformationObjectRelatedByInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addinformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjectRecursiveRelationshipsRelatedByInformationObjectId();
				$obj2->addinformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1);
			}


					
			$omClass = informationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getinformationObjectRelatedByRelatedInformationObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addinformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initinformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId();
				$obj3->addinformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1);
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
					$temp_obj4->addinformationObjectRecursiveRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initinformationObjectRecursiveRelationships();
				$obj4->addinformationObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptinformationObjectRelatedByInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptinformationObjectRelatedByRelatedInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = informationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptinformationObjectRelatedByInformationObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (informationObjectRecursiveRelationshipPeer::NUM_COLUMNS - informationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addinformationObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjectRecursiveRelationships();
				$obj2->addinformationObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptinformationObjectRelatedByRelatedInformationObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (informationObjectRecursiveRelationshipPeer::NUM_COLUMNS - informationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addinformationObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjectRecursiveRelationships();
				$obj2->addinformationObjectRecursiveRelationship($obj1);
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

		informationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (informationObjectRecursiveRelationshipPeer::NUM_COLUMNS - informationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		informationObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + informationObjectPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(informationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, informationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = informationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getinformationObjectRelatedByInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addinformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjectRecursiveRelationshipsRelatedByInformationObjectId();
				$obj2->addinformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1);
			}

			$omClass = informationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getinformationObjectRelatedByRelatedInformationObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addinformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initinformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId();
				$obj3->addinformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1);
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
		return informationObjectRecursiveRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseinformationObjectRecursiveRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseinformationObjectRecursiveRelationshipPeer', $values, $con);
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

		$criteria->remove(informationObjectRecursiveRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseinformationObjectRecursiveRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseinformationObjectRecursiveRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseinformationObjectRecursiveRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseinformationObjectRecursiveRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(informationObjectRecursiveRelationshipPeer::ID);
			$selectCriteria->add(informationObjectRecursiveRelationshipPeer::ID, $criteria->remove(informationObjectRecursiveRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseinformationObjectRecursiveRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseinformationObjectRecursiveRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(informationObjectRecursiveRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(informationObjectRecursiveRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof informationObjectRecursiveRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(informationObjectRecursiveRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(informationObjectRecursiveRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(informationObjectRecursiveRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(informationObjectRecursiveRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(informationObjectRecursiveRelationshipPeer::DATABASE_NAME, informationObjectRecursiveRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = informationObjectRecursiveRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(informationObjectRecursiveRelationshipPeer::DATABASE_NAME);

		$criteria->add(informationObjectRecursiveRelationshipPeer::ID, $pk);


		$v = informationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(informationObjectRecursiveRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = informationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseinformationObjectRecursiveRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/informationObjectRecursiveRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.informationObjectRecursiveRelationshipMapBuilder');
}
