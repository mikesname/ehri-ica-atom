<?php


abstract class BaseRightPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'right';

	
	const CLASS_DEFAULT = 'lib.model.Right';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'right.ID';

	
	const INFORMATION_OBJECT_ID = 'right.INFORMATION_OBJECT_ID';

	
	const DIGITAL_OBJECT_ID = 'right.DIGITAL_OBJECT_ID';

	
	const PHYSICAL_OBJECT_ID = 'right.PHYSICAL_OBJECT_ID';

	
	const PERMISSION_ID = 'right.PERMISSION_ID';

	
	const DESCRIPTION = 'right.DESCRIPTION';

	
	const CREATED_AT = 'right.CREATED_AT';

	
	const UPDATED_AT = 'right.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'InformationObjectId', 'DigitalObjectId', 'PhysicalObjectId', 'PermissionId', 'Description', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (RightPeer::ID, RightPeer::INFORMATION_OBJECT_ID, RightPeer::DIGITAL_OBJECT_ID, RightPeer::PHYSICAL_OBJECT_ID, RightPeer::PERMISSION_ID, RightPeer::DESCRIPTION, RightPeer::CREATED_AT, RightPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'information_object_id', 'digital_object_id', 'physical_object_id', 'permission_id', 'description', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'InformationObjectId' => 1, 'DigitalObjectId' => 2, 'PhysicalObjectId' => 3, 'PermissionId' => 4, 'Description' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
		BasePeer::TYPE_COLNAME => array (RightPeer::ID => 0, RightPeer::INFORMATION_OBJECT_ID => 1, RightPeer::DIGITAL_OBJECT_ID => 2, RightPeer::PHYSICAL_OBJECT_ID => 3, RightPeer::PERMISSION_ID => 4, RightPeer::DESCRIPTION => 5, RightPeer::CREATED_AT => 6, RightPeer::UPDATED_AT => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'information_object_id' => 1, 'digital_object_id' => 2, 'physical_object_id' => 3, 'permission_id' => 4, 'description' => 5, 'created_at' => 6, 'updated_at' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RightMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RightMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RightPeer::getTableMap();
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
		return str_replace(RightPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RightPeer::ID);

		$criteria->addSelectColumn(RightPeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(RightPeer::DIGITAL_OBJECT_ID);

		$criteria->addSelectColumn(RightPeer::PHYSICAL_OBJECT_ID);

		$criteria->addSelectColumn(RightPeer::PERMISSION_ID);

		$criteria->addSelectColumn(RightPeer::DESCRIPTION);

		$criteria->addSelectColumn(RightPeer::CREATED_AT);

		$criteria->addSelectColumn(RightPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(right.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT right.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RightPeer::doSelectRS($criteria, $con);
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
		$objects = RightPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RightPeer::populateObjects(RightPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseRightPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RightPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RightPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoininformationObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinphysicalObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoininformationObject(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightPeer::addSelectColumns($c);
		$startcol = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		informationObjectPeer::addSelectColumns($c);

		$c->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getinformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRight($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1); 			}
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

		RightPeer::addSelectColumns($c);
		$startcol = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		digitalObjectPeer::addSelectColumns($c);

		$c->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

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
										$temp_obj2->addRight($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinphysicalObject(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightPeer::addSelectColumns($c);
		$startcol = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		physicalObjectPeer::addSelectColumns($c);

		$c->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = physicalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getphysicalObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRight($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1); 			}
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

		RightPeer::addSelectColumns($c);
		$startcol = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

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
										$temp_obj2->addRight($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$criteria->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$criteria->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
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

		RightPeer::addSelectColumns($c);
		$startcol2 = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + digitalObjectPeer::NUM_COLUMNS;

		physicalObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + physicalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$c->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$c->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getinformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRight($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1);
			}


					
			$omClass = digitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getdigitalObject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRight($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRights();
				$obj3->addRight($obj1);
			}


					
			$omClass = physicalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getphysicalObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRight($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRights();
				$obj4->addRight($obj1);
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
					$temp_obj5->addRight($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initRights();
				$obj5->addRight($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptinformationObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$criteria->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$criteria->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$criteria->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptphysicalObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$criteria->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RightPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RightPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$criteria->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$rs = RightPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptinformationObject(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightPeer::addSelectColumns($c);
		$startcol2 = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		digitalObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + digitalObjectPeer::NUM_COLUMNS;

		physicalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + physicalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$c->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$c->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getdigitalObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1);
			}

			$omClass = physicalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getphysicalObject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRights();
				$obj3->addRight($obj1);
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
					$temp_obj4->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initRights();
				$obj4->addRight($obj1);
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

		RightPeer::addSelectColumns($c);
		$startcol2 = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		physicalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + physicalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);

		$c->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getinformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1);
			}

			$omClass = physicalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getphysicalObject(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRights();
				$obj3->addRight($obj1);
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
					$temp_obj4->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initRights();
				$obj4->addRight($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptphysicalObject(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RightPeer::addSelectColumns($c);
		$startcol2 = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + digitalObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$c->addJoin(RightPeer::PERMISSION_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getinformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1);
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
					$temp_obj3->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRights();
				$obj3->addRight($obj1);
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
					$temp_obj4->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initRights();
				$obj4->addRight($obj1);
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

		RightPeer::addSelectColumns($c);
		$startcol2 = (RightPeer::NUM_COLUMNS - RightPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		digitalObjectPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + digitalObjectPeer::NUM_COLUMNS;

		physicalObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + physicalObjectPeer::NUM_COLUMNS;

		$c->addJoin(RightPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(RightPeer::DIGITAL_OBJECT_ID, digitalObjectPeer::ID);

		$c->addJoin(RightPeer::PHYSICAL_OBJECT_ID, physicalObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RightPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getinformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRights();
				$obj2->addRight($obj1);
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
					$temp_obj3->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRights();
				$obj3->addRight($obj1);
			}

			$omClass = physicalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getphysicalObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRight($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initRights();
				$obj4->addRight($obj1);
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
		return RightPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRightPeer', $values, $con);
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

		$criteria->remove(RightPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseRightPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRightPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRightPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRightPeer', $values, $con);
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
			$comparison = $criteria->getComparison(RightPeer::ID);
			$selectCriteria->add(RightPeer::ID, $criteria->remove(RightPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRightPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRightPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(RightPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RightPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Right) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RightPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Right $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RightPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RightPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RightPeer::DATABASE_NAME, RightPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RightPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(RightPeer::DATABASE_NAME);

		$criteria->add(RightPeer::ID, $pk);


		$v = RightPeer::doSelect($criteria, $con);

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
			$criteria->add(RightPeer::ID, $pks, Criteria::IN);
			$objs = RightPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRightPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RightMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RightMapBuilder');
}
