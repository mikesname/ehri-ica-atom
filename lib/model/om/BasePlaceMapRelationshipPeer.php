<?php


abstract class BasePlaceMapRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'place_map_relationship';

	
	const CLASS_DEFAULT = 'lib.model.PlaceMapRelationship';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'place_map_relationship.ID';

	
	const PLACE_ID = 'place_map_relationship.PLACE_ID';

	
	const MAP_ID = 'place_map_relationship.MAP_ID';

	
	const MAP_ICON_IMAGE_ID = 'place_map_relationship.MAP_ICON_IMAGE_ID';

	
	const MAP_ICON_DESCRIPTION = 'place_map_relationship.MAP_ICON_DESCRIPTION';

	
	const RELATIONSHIP_TYPE_ID = 'place_map_relationship.RELATIONSHIP_TYPE_ID';

	
	const RELATIONSHIP_NOTE = 'place_map_relationship.RELATIONSHIP_NOTE';

	
	const CREATED_AT = 'place_map_relationship.CREATED_AT';

	
	const UPDATED_AT = 'place_map_relationship.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'PlaceId', 'MapId', 'MapIconImageId', 'MapIconDescription', 'RelationshipTypeId', 'RelationshipNote', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (PlaceMapRelationshipPeer::ID, PlaceMapRelationshipPeer::PLACE_ID, PlaceMapRelationshipPeer::MAP_ID, PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, PlaceMapRelationshipPeer::MAP_ICON_DESCRIPTION, PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, PlaceMapRelationshipPeer::RELATIONSHIP_NOTE, PlaceMapRelationshipPeer::CREATED_AT, PlaceMapRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'place_id', 'map_id', 'map_icon_image_id', 'map_icon_description', 'relationship_type_id', 'relationship_note', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PlaceId' => 1, 'MapId' => 2, 'MapIconImageId' => 3, 'MapIconDescription' => 4, 'RelationshipTypeId' => 5, 'RelationshipNote' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (PlaceMapRelationshipPeer::ID => 0, PlaceMapRelationshipPeer::PLACE_ID => 1, PlaceMapRelationshipPeer::MAP_ID => 2, PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID => 3, PlaceMapRelationshipPeer::MAP_ICON_DESCRIPTION => 4, PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID => 5, PlaceMapRelationshipPeer::RELATIONSHIP_NOTE => 6, PlaceMapRelationshipPeer::CREATED_AT => 7, PlaceMapRelationshipPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'place_id' => 1, 'map_id' => 2, 'map_icon_image_id' => 3, 'map_icon_description' => 4, 'relationship_type_id' => 5, 'relationship_note' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PlaceMapRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PlaceMapRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PlaceMapRelationshipPeer::getTableMap();
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
		return str_replace(PlaceMapRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::ID);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::PLACE_ID);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::MAP_ID);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::MAP_ICON_DESCRIPTION);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::RELATIONSHIP_NOTE);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(PlaceMapRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(place_map_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT place_map_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = PlaceMapRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PlaceMapRelationshipPeer::populateObjects(PlaceMapRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BasePlaceMapRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PlaceMapRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PlaceMapRelationshipPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPlace(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinMap(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinDigitalObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPlace(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePlaceMapRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PlacePeer::addSelectColumns($c);

		$c->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PlacePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPlace(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPlaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinMap(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MapPeer::addSelectColumns($c);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MapPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMap(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPlaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinDigitalObject(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DigitalObjectPeer::addSelectColumns($c);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DigitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDigitalObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPlaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1); 			}
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

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

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
										$temp_obj2->addPlaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePlaceMapRelationshipPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		MapPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MapPeer::NUM_COLUMNS;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + DigitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		$c->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PlacePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPlace(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPlaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1);
			}


					
			$omClass = MapPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getMap(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPlaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPlaceMapRelationships();
				$obj3->addPlaceMapRelationship($obj1);
			}


					
			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getDigitalObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPlaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initPlaceMapRelationships();
				$obj4->addPlaceMapRelationship($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTerm(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addPlaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initPlaceMapRelationships();
				$obj5->addPlaceMapRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPlace(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptMap(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptDigitalObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PlaceMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$rs = PlaceMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPlace(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasePlaceMapRelationshipPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MapPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MapPeer::NUM_COLUMNS;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DigitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MapPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMap(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1);
			}

			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDigitalObject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPlaceMapRelationships();
				$obj3->addPlaceMapRelationship($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTerm(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPlaceMapRelationships();
				$obj4->addPlaceMapRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptMap(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + DigitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PlacePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPlace(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1);
			}

			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getDigitalObject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPlaceMapRelationships();
				$obj3->addPlaceMapRelationship($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTerm(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPlaceMapRelationships();
				$obj4->addPlaceMapRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptDigitalObject(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		MapPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MapPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PlacePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPlace(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1);
			}

			$omClass = MapPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getMap(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPlaceMapRelationships();
				$obj3->addPlaceMapRelationship($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTerm(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPlaceMapRelationships();
				$obj4->addPlaceMapRelationship($obj1);
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

		PlaceMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (PlaceMapRelationshipPeer::NUM_COLUMNS - PlaceMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		MapPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MapPeer::NUM_COLUMNS;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + DigitalObjectPeer::NUM_COLUMNS;

		$c->addJoin(PlaceMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(PlaceMapRelationshipPeer::MAP_ICON_IMAGE_ID, DigitalObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PlaceMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PlacePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPlace(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPlaceMapRelationships();
				$obj2->addPlaceMapRelationship($obj1);
			}

			$omClass = MapPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getMap(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPlaceMapRelationships();
				$obj3->addPlaceMapRelationship($obj1);
			}

			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getDigitalObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPlaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPlaceMapRelationships();
				$obj4->addPlaceMapRelationship($obj1);
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
		return PlaceMapRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePlaceMapRelationshipPeer', $values, $con);
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

		$criteria->remove(PlaceMapRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePlaceMapRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePlaceMapRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(PlaceMapRelationshipPeer::ID);
			$selectCriteria->add(PlaceMapRelationshipPeer::ID, $criteria->remove(PlaceMapRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePlaceMapRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePlaceMapRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(PlaceMapRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PlaceMapRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PlaceMapRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PlaceMapRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PlaceMapRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PlaceMapRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PlaceMapRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PlaceMapRelationshipPeer::DATABASE_NAME, PlaceMapRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PlaceMapRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PlaceMapRelationshipPeer::DATABASE_NAME);

		$criteria->add(PlaceMapRelationshipPeer::ID, $pk);


		$v = PlaceMapRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(PlaceMapRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = PlaceMapRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePlaceMapRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PlaceMapRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PlaceMapRelationshipMapBuilder');
}
