<?php


abstract class BaseSystemEventPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'system_event';

	
	const CLASS_DEFAULT = 'lib.model.SystemEvent';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'system_event.ID';

	
	const SYSTEM_EVENT_TYPE_ID = 'system_event.SYSTEM_EVENT_TYPE_ID';

	
	const OBJECT_CLASS = 'system_event.OBJECT_CLASS';

	
	const OBJECT_ID = 'system_event.OBJECT_ID';

	
	const PRE_EVENT_SNAPSHOT = 'system_event.PRE_EVENT_SNAPSHOT';

	
	const POST_EVENT_SNAPSHOT = 'system_event.POST_EVENT_SNAPSHOT';

	
	const DATE = 'system_event.DATE';

	
	const USER_NAME = 'system_event.USER_NAME';

	
	const USER_ID = 'system_event.USER_ID';

	
	const CREATED_AT = 'system_event.CREATED_AT';

	
	const UPDATED_AT = 'system_event.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'SystemEventTypeId', 'ObjectClass', 'ObjectId', 'PreEventSnapshot', 'PostEventSnapshot', 'Date', 'UserName', 'UserId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (SystemEventPeer::ID, SystemEventPeer::SYSTEM_EVENT_TYPE_ID, SystemEventPeer::OBJECT_CLASS, SystemEventPeer::OBJECT_ID, SystemEventPeer::PRE_EVENT_SNAPSHOT, SystemEventPeer::POST_EVENT_SNAPSHOT, SystemEventPeer::DATE, SystemEventPeer::USER_NAME, SystemEventPeer::USER_ID, SystemEventPeer::CREATED_AT, SystemEventPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'system_event_type_id', 'object_class', 'object_id', 'pre_event_snapshot', 'post_event_snapshot', 'date', 'user_name', 'user_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'SystemEventTypeId' => 1, 'ObjectClass' => 2, 'ObjectId' => 3, 'PreEventSnapshot' => 4, 'PostEventSnapshot' => 5, 'Date' => 6, 'UserName' => 7, 'UserId' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ),
		BasePeer::TYPE_COLNAME => array (SystemEventPeer::ID => 0, SystemEventPeer::SYSTEM_EVENT_TYPE_ID => 1, SystemEventPeer::OBJECT_CLASS => 2, SystemEventPeer::OBJECT_ID => 3, SystemEventPeer::PRE_EVENT_SNAPSHOT => 4, SystemEventPeer::POST_EVENT_SNAPSHOT => 5, SystemEventPeer::DATE => 6, SystemEventPeer::USER_NAME => 7, SystemEventPeer::USER_ID => 8, SystemEventPeer::CREATED_AT => 9, SystemEventPeer::UPDATED_AT => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'system_event_type_id' => 1, 'object_class' => 2, 'object_id' => 3, 'pre_event_snapshot' => 4, 'post_event_snapshot' => 5, 'date' => 6, 'user_name' => 7, 'user_id' => 8, 'created_at' => 9, 'updated_at' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SystemEventMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SystemEventMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SystemEventPeer::getTableMap();
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
		return str_replace(SystemEventPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SystemEventPeer::ID);

		$criteria->addSelectColumn(SystemEventPeer::SYSTEM_EVENT_TYPE_ID);

		$criteria->addSelectColumn(SystemEventPeer::OBJECT_CLASS);

		$criteria->addSelectColumn(SystemEventPeer::OBJECT_ID);

		$criteria->addSelectColumn(SystemEventPeer::PRE_EVENT_SNAPSHOT);

		$criteria->addSelectColumn(SystemEventPeer::POST_EVENT_SNAPSHOT);

		$criteria->addSelectColumn(SystemEventPeer::DATE);

		$criteria->addSelectColumn(SystemEventPeer::USER_NAME);

		$criteria->addSelectColumn(SystemEventPeer::USER_ID);

		$criteria->addSelectColumn(SystemEventPeer::CREATED_AT);

		$criteria->addSelectColumn(SystemEventPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(system_event.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT system_event.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SystemEventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SystemEventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SystemEventPeer::doSelectRS($criteria, $con);
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
		$objects = SystemEventPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SystemEventPeer::populateObjects(SystemEventPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEventPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseSystemEventPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SystemEventPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SystemEventPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinTerm(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SystemEventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SystemEventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, TermPeer::ID);

		$rs = SystemEventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SystemEventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SystemEventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SystemEventPeer::USER_ID, UserPeer::ID);

		$rs = SystemEventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinTerm(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEventPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseSystemEventPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SystemEventPeer::addSelectColumns($c);
		$startcol = (SystemEventPeer::NUM_COLUMNS - SystemEventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SystemEventPeer::getOMClass();

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
										$temp_obj2->addSystemEvent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSystemEvents();
				$obj2->addSystemEvent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SystemEventPeer::addSelectColumns($c);
		$startcol = (SystemEventPeer::NUM_COLUMNS - SystemEventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(SystemEventPeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SystemEventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSystemEvent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSystemEvents();
				$obj2->addSystemEvent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SystemEventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SystemEventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(SystemEventPeer::USER_ID, UserPeer::ID);

		$rs = SystemEventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEventPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseSystemEventPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SystemEventPeer::addSelectColumns($c);
		$startcol2 = (SystemEventPeer::NUM_COLUMNS - SystemEventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UserPeer::NUM_COLUMNS;

		$c->addJoin(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, TermPeer::ID);

		$c->addJoin(SystemEventPeer::USER_ID, UserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SystemEventPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTerm(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSystemEvent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSystemEvents();
				$obj2->addSystemEvent($obj1);
			}


					
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUser(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addSystemEvent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initSystemEvents();
				$obj3->addSystemEvent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptTerm(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SystemEventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SystemEventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SystemEventPeer::USER_ID, UserPeer::ID);

		$rs = SystemEventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SystemEventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SystemEventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, TermPeer::ID);

		$rs = SystemEventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptTerm(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEventPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseSystemEventPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SystemEventPeer::addSelectColumns($c);
		$startcol2 = (SystemEventPeer::NUM_COLUMNS - SystemEventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UserPeer::NUM_COLUMNS;

		$c->addJoin(SystemEventPeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SystemEventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSystemEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSystemEvents();
				$obj2->addSystemEvent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUser(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SystemEventPeer::addSelectColumns($c);
		$startcol2 = (SystemEventPeer::NUM_COLUMNS - SystemEventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(SystemEventPeer::SYSTEM_EVENT_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SystemEventPeer::getOMClass();

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
					$temp_obj2->addSystemEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initSystemEvents();
				$obj2->addSystemEvent($obj1);
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
		return SystemEventPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEventPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSystemEventPeer', $values, $con);
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

		$criteria->remove(SystemEventPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseSystemEventPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseSystemEventPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseSystemEventPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseSystemEventPeer', $values, $con);
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
			$comparison = $criteria->getComparison(SystemEventPeer::ID);
			$selectCriteria->add(SystemEventPeer::ID, $criteria->remove(SystemEventPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseSystemEventPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseSystemEventPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(SystemEventPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(SystemEventPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof SystemEvent) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SystemEventPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(SystemEvent $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SystemEventPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SystemEventPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(SystemEventPeer::DATABASE_NAME, SystemEventPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SystemEventPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(SystemEventPeer::DATABASE_NAME);

		$criteria->add(SystemEventPeer::ID, $pk);


		$v = SystemEventPeer::doSelect($criteria, $con);

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
			$criteria->add(SystemEventPeer::ID, $pks, Criteria::IN);
			$objs = SystemEventPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSystemEventPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SystemEventMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SystemEventMapBuilder');
}
