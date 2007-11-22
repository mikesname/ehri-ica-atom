<?php


abstract class BasePhysicalObjectPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'physical_object';

	
	const CLASS_DEFAULT = 'lib.model.PhysicalObject';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'physical_object.ID';

	
	const NAME = 'physical_object.NAME';

	
	const DESCRIPTION = 'physical_object.DESCRIPTION';

	
	const INFORMATION_OBJECT_ID = 'physical_object.INFORMATION_OBJECT_ID';

	
	const LOCATION_ID = 'physical_object.LOCATION_ID';

	
	const TREE_ID = 'physical_object.TREE_ID';

	
	const TREE_LEFT_ID = 'physical_object.TREE_LEFT_ID';

	
	const TREE_RIGHT_ID = 'physical_object.TREE_RIGHT_ID';

	
	const TREE_PARENT_ID = 'physical_object.TREE_PARENT_ID';

	
	const CREATED_AT = 'physical_object.CREATED_AT';

	
	const UPDATED_AT = 'physical_object.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'InformationObjectId', 'LocationId', 'TreeId', 'TreeLeftId', 'TreeRightId', 'TreeParentId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (PhysicalObjectPeer::ID, PhysicalObjectPeer::NAME, PhysicalObjectPeer::DESCRIPTION, PhysicalObjectPeer::INFORMATION_OBJECT_ID, PhysicalObjectPeer::LOCATION_ID, PhysicalObjectPeer::TREE_ID, PhysicalObjectPeer::TREE_LEFT_ID, PhysicalObjectPeer::TREE_RIGHT_ID, PhysicalObjectPeer::TREE_PARENT_ID, PhysicalObjectPeer::CREATED_AT, PhysicalObjectPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'information_object_id', 'location_id', 'tree_id', 'tree_left_id', 'tree_right_id', 'tree_parent_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'InformationObjectId' => 3, 'LocationId' => 4, 'TreeId' => 5, 'TreeLeftId' => 6, 'TreeRightId' => 7, 'TreeParentId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (PhysicalObjectPeer::ID => 0, PhysicalObjectPeer::NAME => 1, PhysicalObjectPeer::DESCRIPTION => 2, PhysicalObjectPeer::INFORMATION_OBJECT_ID => 3, PhysicalObjectPeer::LOCATION_ID => 4, PhysicalObjectPeer::TREE_ID => 5, PhysicalObjectPeer::TREE_LEFT_ID => 6, PhysicalObjectPeer::TREE_RIGHT_ID => 7, PhysicalObjectPeer::TREE_PARENT_ID => 8, PhysicalObjectPeer::CREATED_AT => 9, PhysicalObjectPeer::UPDATED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'information_object_id' => 3, 'location_id' => 4, 'tree_id' => 5, 'tree_left_id' => 6, 'tree_right_id' => 7, 'tree_parent_id' => 8, 'created_at' => 9, 'updated_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PhysicalObjectMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PhysicalObjectMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PhysicalObjectPeer::getTableMap();
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
		return str_replace(PhysicalObjectPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PhysicalObjectPeer::ID);

		$criteria->addSelectColumn(PhysicalObjectPeer::NAME);

		$criteria->addSelectColumn(PhysicalObjectPeer::DESCRIPTION);

		$criteria->addSelectColumn(PhysicalObjectPeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(PhysicalObjectPeer::LOCATION_ID);

		$criteria->addSelectColumn(PhysicalObjectPeer::TREE_ID);

		$criteria->addSelectColumn(PhysicalObjectPeer::TREE_LEFT_ID);

		$criteria->addSelectColumn(PhysicalObjectPeer::TREE_RIGHT_ID);

		$criteria->addSelectColumn(PhysicalObjectPeer::TREE_PARENT_ID);

		$criteria->addSelectColumn(PhysicalObjectPeer::CREATED_AT);

		$criteria->addSelectColumn(PhysicalObjectPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(physical_object.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT physical_object.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PhysicalObjectPeer::doSelectRS($criteria, $con);
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
		$objects = PhysicalObjectPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PhysicalObjectPeer::populateObjects(PhysicalObjectPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BasePhysicalObjectPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PhysicalObjectPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PhysicalObjectPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinInformationObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PhysicalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = PhysicalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PhysicalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = PhysicalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinInformationObject(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BasePhysicalObjectPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PhysicalObjectPeer::addSelectColumns($c);
		$startcol = (PhysicalObjectPeer::NUM_COLUMNS - PhysicalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InformationObjectPeer::addSelectColumns($c);

		$c->addJoin(PhysicalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PhysicalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InformationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getInformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addPhysicalObject($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPhysicalObjects();
				$obj2->addPhysicalObject($obj1); 			}
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

		PhysicalObjectPeer::addSelectColumns($c);
		$startcol = (PhysicalObjectPeer::NUM_COLUMNS - PhysicalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(PhysicalObjectPeer::LOCATION_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PhysicalObjectPeer::getOMClass();

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
										$temp_obj2->addPhysicalObject($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initPhysicalObjects();
				$obj2->addPhysicalObject($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PhysicalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$criteria->addJoin(PhysicalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = PhysicalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BasePhysicalObjectPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PhysicalObjectPeer::addSelectColumns($c);
		$startcol2 = (PhysicalObjectPeer::NUM_COLUMNS - PhysicalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		$c->addJoin(PhysicalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$c->addJoin(PhysicalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PhysicalObjectPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getInformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPhysicalObject($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initPhysicalObjects();
				$obj2->addPhysicalObject($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTerm(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPhysicalObject($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initPhysicalObjects();
				$obj3->addPhysicalObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptInformationObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PhysicalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = PhysicalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PhysicalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PhysicalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = PhysicalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptInformationObject(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BasePhysicalObjectPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PhysicalObjectPeer::addSelectColumns($c);
		$startcol2 = (PhysicalObjectPeer::NUM_COLUMNS - PhysicalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(PhysicalObjectPeer::LOCATION_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PhysicalObjectPeer::getOMClass();

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
					$temp_obj2->addPhysicalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPhysicalObjects();
				$obj2->addPhysicalObject($obj1);
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

		PhysicalObjectPeer::addSelectColumns($c);
		$startcol2 = (PhysicalObjectPeer::NUM_COLUMNS - PhysicalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		$c->addJoin(PhysicalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PhysicalObjectPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getInformationObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPhysicalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPhysicalObjects();
				$obj2->addPhysicalObject($obj1);
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
		return PhysicalObjectPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePhysicalObjectPeer', $values, $con);
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

		$criteria->remove(PhysicalObjectPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePhysicalObjectPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePhysicalObjectPeer', $values, $con);
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
			$comparison = $criteria->getComparison(PhysicalObjectPeer::ID);
			$selectCriteria->add(PhysicalObjectPeer::ID, $criteria->remove(PhysicalObjectPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePhysicalObjectPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePhysicalObjectPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(PhysicalObjectPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(PhysicalObjectPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof PhysicalObject) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PhysicalObjectPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(PhysicalObject $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PhysicalObjectPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PhysicalObjectPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PhysicalObjectPeer::DATABASE_NAME, PhysicalObjectPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PhysicalObjectPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(PhysicalObjectPeer::DATABASE_NAME);

		$criteria->add(PhysicalObjectPeer::ID, $pk);


		$v = PhysicalObjectPeer::doSelect($criteria, $con);

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
			$criteria->add(PhysicalObjectPeer::ID, $pks, Criteria::IN);
			$objs = PhysicalObjectPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePhysicalObjectPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PhysicalObjectMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PhysicalObjectMapBuilder');
}
