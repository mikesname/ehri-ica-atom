<?php


abstract class BaseInformationObjectRecursiveRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'information_object_recursive_relationship';

	
	const CLASS_DEFAULT = 'lib.model.InformationObjectRecursiveRelationship';

	
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
		BasePeer::TYPE_COLNAME => array (InformationObjectRecursiveRelationshipPeer::ID, InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_START_DATE, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_END_DATE, InformationObjectRecursiveRelationshipPeer::DATE_DISPLAY, InformationObjectRecursiveRelationshipPeer::CREATED_AT, InformationObjectRecursiveRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'information_object_id', 'related_information_object_id', 'relationship_type_id', 'relationship_description', 'relationship_start_date', 'relationship_end_date', 'date_display', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'InformationObjectId' => 1, 'RelatedInformationObjectId' => 2, 'RelationshipTypeId' => 3, 'RelationshipDescription' => 4, 'RelationshipStartDate' => 5, 'RelationshipEndDate' => 6, 'DateDisplay' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (InformationObjectRecursiveRelationshipPeer::ID => 0, InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID => 1, InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID => 2, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID => 3, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION => 4, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_START_DATE => 5, InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_END_DATE => 6, InformationObjectRecursiveRelationshipPeer::DATE_DISPLAY => 7, InformationObjectRecursiveRelationshipPeer::CREATED_AT => 8, InformationObjectRecursiveRelationshipPeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'information_object_id' => 1, 'related_information_object_id' => 2, 'relationship_type_id' => 3, 'relationship_description' => 4, 'relationship_start_date' => 5, 'relationship_end_date' => 6, 'date_display' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/InformationObjectRecursiveRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.InformationObjectRecursiveRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InformationObjectRecursiveRelationshipPeer::getTableMap();
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
		return str_replace(InformationObjectRecursiveRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::ID);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_DESCRIPTION);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_START_DATE);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_END_DATE);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::DATE_DISPLAY);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(information_object_recursive_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT information_object_recursive_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = InformationObjectRecursiveRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InformationObjectRecursiveRelationshipPeer::populateObjects(InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InformationObjectRecursiveRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InformationObjectRecursiveRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinInformationObjectRelatedByInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinInformationObjectRelatedByRelatedInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinInformationObjectRelatedByInformationObjectId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InformationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (InformationObjectRecursiveRelationshipPeer::NUM_COLUMNS - InformationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InformationObjectPeer::addSelectColumns($c);

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformationObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InformationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getInformationObjectRelatedByInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInformationObjectRecursiveRelationshipsRelatedByInformationObjectId();
				$obj2->addInformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinInformationObjectRelatedByRelatedInformationObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InformationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (InformationObjectRecursiveRelationshipPeer::NUM_COLUMNS - InformationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InformationObjectPeer::addSelectColumns($c);

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, InformationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformationObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InformationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getInformationObjectRelatedByRelatedInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId();
				$obj2->addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1); 			}
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

		InformationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol = (InformationObjectRecursiveRelationshipPeer::NUM_COLUMNS - InformationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformationObjectRecursiveRelationshipPeer::getOMClass();

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
										$temp_obj2->addInformationObjectRecursiveRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInformationObjectRecursiveRelationships();
				$obj2->addInformationObjectRecursiveRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InformationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (InformationObjectRecursiveRelationshipPeer::NUM_COLUMNS - InformationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		InformationObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + InformationObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformationObjectRecursiveRelationshipPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = InformationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInformationObjectRelatedByInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInformationObjectRecursiveRelationshipsRelatedByInformationObjectId();
				$obj2->addInformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1);
			}


					
			$omClass = InformationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getInformationObjectRelatedByRelatedInformationObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId();
				$obj3->addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1);
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
					$temp_obj4->addInformationObjectRecursiveRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initInformationObjectRecursiveRelationships();
				$obj4->addInformationObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptInformationObjectRelatedByInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptInformationObjectRelatedByRelatedInformationObjectId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InformationObjectRecursiveRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$criteria->addJoin(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = InformationObjectRecursiveRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptInformationObjectRelatedByInformationObjectId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InformationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (InformationObjectRecursiveRelationshipPeer::NUM_COLUMNS - InformationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformationObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addInformationObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInformationObjectRecursiveRelationships();
				$obj2->addInformationObjectRecursiveRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptInformationObjectRelatedByRelatedInformationObjectId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InformationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (InformationObjectRecursiveRelationshipPeer::NUM_COLUMNS - InformationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformationObjectRecursiveRelationshipPeer::getOMClass();

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
					$temp_obj2->addInformationObjectRecursiveRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInformationObjectRecursiveRelationships();
				$obj2->addInformationObjectRecursiveRelationship($obj1);
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

		InformationObjectRecursiveRelationshipPeer::addSelectColumns($c);
		$startcol2 = (InformationObjectRecursiveRelationshipPeer::NUM_COLUMNS - InformationObjectRecursiveRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		InformationObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + InformationObjectPeer::NUM_COLUMNS;

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$c->addJoin(InformationObjectRecursiveRelationshipPeer::RELATED_INFORMATION_OBJECT_ID, InformationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InformationObjectRecursiveRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InformationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInformationObjectRelatedByInformationObjectId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInformationObjectRecursiveRelationshipsRelatedByInformationObjectId();
				$obj2->addInformationObjectRecursiveRelationshipRelatedByInformationObjectId($obj1);
			}

			$omClass = InformationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getInformationObjectRelatedByRelatedInformationObjectId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initInformationObjectRecursiveRelationshipsRelatedByRelatedInformationObjectId();
				$obj3->addInformationObjectRecursiveRelationshipRelatedByRelatedInformationObjectId($obj1);
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
		return InformationObjectRecursiveRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $values, $con);
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

		$criteria->remove(InformationObjectRecursiveRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(InformationObjectRecursiveRelationshipPeer::ID);
			$selectCriteria->add(InformationObjectRecursiveRelationshipPeer::ID, $criteria->remove(InformationObjectRecursiveRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseInformationObjectRecursiveRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseInformationObjectRecursiveRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(InformationObjectRecursiveRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InformationObjectRecursiveRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof InformationObjectRecursiveRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InformationObjectRecursiveRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(InformationObjectRecursiveRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InformationObjectRecursiveRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InformationObjectRecursiveRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InformationObjectRecursiveRelationshipPeer::DATABASE_NAME, InformationObjectRecursiveRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InformationObjectRecursiveRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(InformationObjectRecursiveRelationshipPeer::DATABASE_NAME);

		$criteria->add(InformationObjectRecursiveRelationshipPeer::ID, $pk);


		$v = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(InformationObjectRecursiveRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = InformationObjectRecursiveRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseInformationObjectRecursiveRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/InformationObjectRecursiveRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.InformationObjectRecursiveRelationshipMapBuilder');
}
