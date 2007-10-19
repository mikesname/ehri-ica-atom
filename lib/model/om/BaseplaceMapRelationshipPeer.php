<?php


abstract class BaseplaceMapRelationshipPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'place_map_relationship';

	
	const CLASS_DEFAULT = 'lib.model.placeMapRelationship';

	
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
		BasePeer::TYPE_COLNAME => array (placeMapRelationshipPeer::ID, placeMapRelationshipPeer::PLACE_ID, placeMapRelationshipPeer::MAP_ID, placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, placeMapRelationshipPeer::MAP_ICON_DESCRIPTION, placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, placeMapRelationshipPeer::RELATIONSHIP_NOTE, placeMapRelationshipPeer::CREATED_AT, placeMapRelationshipPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'place_id', 'map_id', 'map_icon_image_id', 'map_icon_description', 'relationship_type_id', 'relationship_note', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'PlaceId' => 1, 'MapId' => 2, 'MapIconImageId' => 3, 'MapIconDescription' => 4, 'RelationshipTypeId' => 5, 'RelationshipNote' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (placeMapRelationshipPeer::ID => 0, placeMapRelationshipPeer::PLACE_ID => 1, placeMapRelationshipPeer::MAP_ID => 2, placeMapRelationshipPeer::MAP_ICON_IMAGE_ID => 3, placeMapRelationshipPeer::MAP_ICON_DESCRIPTION => 4, placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID => 5, placeMapRelationshipPeer::RELATIONSHIP_NOTE => 6, placeMapRelationshipPeer::CREATED_AT => 7, placeMapRelationshipPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'place_id' => 1, 'map_id' => 2, 'map_icon_image_id' => 3, 'map_icon_description' => 4, 'relationship_type_id' => 5, 'relationship_note' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/placeMapRelationshipMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.placeMapRelationshipMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = placeMapRelationshipPeer::getTableMap();
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
		return str_replace(placeMapRelationshipPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(placeMapRelationshipPeer::ID);

		$criteria->addSelectColumn(placeMapRelationshipPeer::PLACE_ID);

		$criteria->addSelectColumn(placeMapRelationshipPeer::MAP_ID);

		$criteria->addSelectColumn(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID);

		$criteria->addSelectColumn(placeMapRelationshipPeer::MAP_ICON_DESCRIPTION);

		$criteria->addSelectColumn(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID);

		$criteria->addSelectColumn(placeMapRelationshipPeer::RELATIONSHIP_NOTE);

		$criteria->addSelectColumn(placeMapRelationshipPeer::CREATED_AT);

		$criteria->addSelectColumn(placeMapRelationshipPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(place_map_relationship.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT place_map_relationship.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
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
		$objects = placeMapRelationshipPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return placeMapRelationshipPeer::populateObjects(placeMapRelationshipPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseplaceMapRelationshipPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseplaceMapRelationshipPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			placeMapRelationshipPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = placeMapRelationshipPeer::getOMClass();
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
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoindigitalObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPlace(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PlacePeer::addSelectColumns($c);

		$c->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

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
										$temp_obj2->addplaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1); 			}
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

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MapPeer::addSelectColumns($c);

		$c->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

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
										$temp_obj2->addplaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoindigitalObject(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		digitalObjectPeer::addSelectColumns($c);

		$c->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getdigitalObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addplaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1); 			}
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

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

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
										$temp_obj2->addplaceMapRelationship($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
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

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		MapPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MapPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + digitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		$c->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$c->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();


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
					$temp_obj2->addplaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1);
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
					$temp_obj3->addplaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initplaceMapRelationships();
				$obj3->addplaceMapRelationship($obj1);
			}


					
			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getdigitalObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addplaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initplaceMapRelationships();
				$obj4->addplaceMapRelationship($obj1);
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
					$temp_obj5->addplaceMapRelationship($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initplaceMapRelationships();
				$obj5->addplaceMapRelationship($obj1);
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
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptdigitalObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(placeMapRelationshipPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$criteria->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$rs = placeMapRelationshipPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPlace(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MapPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MapPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + digitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$c->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

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
					$temp_obj2->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1);
			}

			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getdigitalObject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initplaceMapRelationships();
				$obj3->addplaceMapRelationship($obj1);
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
					$temp_obj4->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initplaceMapRelationships();
				$obj4->addplaceMapRelationship($obj1);
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

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + digitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);

		$c->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

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
					$temp_obj2->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1);
			}

			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getdigitalObject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initplaceMapRelationships();
				$obj3->addplaceMapRelationship($obj1);
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
					$temp_obj4->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initplaceMapRelationships();
				$obj4->addplaceMapRelationship($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptdigitalObject(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		MapPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MapPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(placeMapRelationshipPeer::RELATIONSHIP_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

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
					$temp_obj2->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1);
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
					$temp_obj3->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initplaceMapRelationships();
				$obj3->addplaceMapRelationship($obj1);
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
					$temp_obj4->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initplaceMapRelationships();
				$obj4->addplaceMapRelationship($obj1);
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

		placeMapRelationshipPeer::addSelectColumns($c);
		$startcol2 = (placeMapRelationshipPeer::NUM_COLUMNS - placeMapRelationshipPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PlacePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PlacePeer::NUM_COLUMNS;

		MapPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + MapPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + digitalObjectPeer::NUM_COLUMNS;

		$c->addJoin(placeMapRelationshipPeer::PLACE_ID, PlacePeer::ID);

		$c->addJoin(placeMapRelationshipPeer::MAP_ID, MapPeer::ID);

		$c->addJoin(placeMapRelationshipPeer::MAP_ICON_IMAGE_ID, digitalObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = placeMapRelationshipPeer::getOMClass();

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
					$temp_obj2->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initplaceMapRelationships();
				$obj2->addplaceMapRelationship($obj1);
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
					$temp_obj3->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initplaceMapRelationships();
				$obj3->addplaceMapRelationship($obj1);
			}

			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getdigitalObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addplaceMapRelationship($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initplaceMapRelationships();
				$obj4->addplaceMapRelationship($obj1);
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
		return placeMapRelationshipPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseplaceMapRelationshipPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseplaceMapRelationshipPeer', $values, $con);
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

		$criteria->remove(placeMapRelationshipPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseplaceMapRelationshipPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseplaceMapRelationshipPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseplaceMapRelationshipPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseplaceMapRelationshipPeer', $values, $con);
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
			$comparison = $criteria->getComparison(placeMapRelationshipPeer::ID);
			$selectCriteria->add(placeMapRelationshipPeer::ID, $criteria->remove(placeMapRelationshipPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseplaceMapRelationshipPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseplaceMapRelationshipPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(placeMapRelationshipPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(placeMapRelationshipPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof placeMapRelationship) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(placeMapRelationshipPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(placeMapRelationship $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(placeMapRelationshipPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(placeMapRelationshipPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(placeMapRelationshipPeer::DATABASE_NAME, placeMapRelationshipPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = placeMapRelationshipPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(placeMapRelationshipPeer::DATABASE_NAME);

		$criteria->add(placeMapRelationshipPeer::ID, $pk);


		$v = placeMapRelationshipPeer::doSelect($criteria, $con);

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
			$criteria->add(placeMapRelationshipPeer::ID, $pks, Criteria::IN);
			$objs = placeMapRelationshipPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseplaceMapRelationshipPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/placeMapRelationshipMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.placeMapRelationshipMapBuilder');
}
