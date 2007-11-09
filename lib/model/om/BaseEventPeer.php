<?php


abstract class BaseEventPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'event';

	
	const CLASS_DEFAULT = 'lib.model.Event';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'event.ID';

	
	const NAME = 'event.NAME';

	
	const DESCRIPTION = 'event.DESCRIPTION';

	
	const START_DATE = 'event.START_DATE';

	
	const START_TIME = 'event.START_TIME';

	
	const END_DATE = 'event.END_DATE';

	
	const END_TIME = 'event.END_TIME';

	
	const DATE_DISPLAY = 'event.DATE_DISPLAY';

	
	const EVENT_TYPE_ID = 'event.EVENT_TYPE_ID';

	
	const ACTOR_ROLE_ID = 'event.ACTOR_ROLE_ID';

	
	const INFORMATION_OBJECT_ID = 'event.INFORMATION_OBJECT_ID';

	
	const ACTOR_ID = 'event.ACTOR_ID';

	
	const CREATED_AT = 'event.CREATED_AT';

	
	const UPDATED_AT = 'event.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Name', 'Description', 'StartDate', 'StartTime', 'EndDate', 'EndTime', 'DateDisplay', 'EventTypeId', 'ActorRoleId', 'InformationObjectId', 'ActorId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (EventPeer::ID, EventPeer::NAME, EventPeer::DESCRIPTION, EventPeer::START_DATE, EventPeer::START_TIME, EventPeer::END_DATE, EventPeer::END_TIME, EventPeer::DATE_DISPLAY, EventPeer::EVENT_TYPE_ID, EventPeer::ACTOR_ROLE_ID, EventPeer::INFORMATION_OBJECT_ID, EventPeer::ACTOR_ID, EventPeer::CREATED_AT, EventPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'name', 'description', 'start_date', 'start_time', 'end_date', 'end_time', 'date_display', 'event_type_id', 'actor_role_id', 'information_object_id', 'actor_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Name' => 1, 'Description' => 2, 'StartDate' => 3, 'StartTime' => 4, 'EndDate' => 5, 'EndTime' => 6, 'DateDisplay' => 7, 'EventTypeId' => 8, 'ActorRoleId' => 9, 'InformationObjectId' => 10, 'ActorId' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ),
		BasePeer::TYPE_COLNAME => array (EventPeer::ID => 0, EventPeer::NAME => 1, EventPeer::DESCRIPTION => 2, EventPeer::START_DATE => 3, EventPeer::START_TIME => 4, EventPeer::END_DATE => 5, EventPeer::END_TIME => 6, EventPeer::DATE_DISPLAY => 7, EventPeer::EVENT_TYPE_ID => 8, EventPeer::ACTOR_ROLE_ID => 9, EventPeer::INFORMATION_OBJECT_ID => 10, EventPeer::ACTOR_ID => 11, EventPeer::CREATED_AT => 12, EventPeer::UPDATED_AT => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'name' => 1, 'description' => 2, 'start_date' => 3, 'start_time' => 4, 'end_date' => 5, 'end_time' => 6, 'date_display' => 7, 'event_type_id' => 8, 'actor_role_id' => 9, 'information_object_id' => 10, 'actor_id' => 11, 'created_at' => 12, 'updated_at' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/EventMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.EventMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = EventPeer::getTableMap();
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
		return str_replace(EventPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EventPeer::ID);

		$criteria->addSelectColumn(EventPeer::NAME);

		$criteria->addSelectColumn(EventPeer::DESCRIPTION);

		$criteria->addSelectColumn(EventPeer::START_DATE);

		$criteria->addSelectColumn(EventPeer::START_TIME);

		$criteria->addSelectColumn(EventPeer::END_DATE);

		$criteria->addSelectColumn(EventPeer::END_TIME);

		$criteria->addSelectColumn(EventPeer::DATE_DISPLAY);

		$criteria->addSelectColumn(EventPeer::EVENT_TYPE_ID);

		$criteria->addSelectColumn(EventPeer::ACTOR_ROLE_ID);

		$criteria->addSelectColumn(EventPeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(EventPeer::ACTOR_ID);

		$criteria->addSelectColumn(EventPeer::CREATED_AT);

		$criteria->addSelectColumn(EventPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(event.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT event.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = EventPeer::doSelectRS($criteria, $con);
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
		$objects = EventPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return EventPeer::populateObjects(EventPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseEventPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseEventPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			EventPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = EventPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinTermRelatedByEventTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByActorRoleId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoininformationObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinTermRelatedByEventTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByEventTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventRelatedByEventTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventsRelatedByEventTypeId();
				$obj2->addEventRelatedByEventTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByActorRoleId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByActorRoleId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEventRelatedByActorRoleId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEventsRelatedByActorRoleId();
				$obj2->addEventRelatedByActorRoleId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoininformationObject(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		informationObjectPeer::addSelectColumns($c);

		$c->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

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
										$temp_obj2->addEvent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEvents();
				$obj2->addEvent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinActor(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addEvent($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initEvents();
				$obj2->addEvent($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);

		$criteria->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
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

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		informationObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);

		$c->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);

		$c->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getTermRelatedByEventTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventRelatedByEventTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initEventsRelatedByEventTypeId();
				$obj2->addEventRelatedByEventTypeId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByActorRoleId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventRelatedByActorRoleId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initEventsRelatedByActorRoleId();
				$obj3->addEventRelatedByActorRoleId($obj1);
			}


					
			$omClass = informationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getinformationObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEvent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initEvents();
				$obj4->addEvent($obj1);
			}


					
			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getActor(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addEvent($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initEvents();
				$obj5->addEvent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptTermRelatedByEventTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByActorRoleId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptinformationObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);

		$criteria->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(EventPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(EventPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);

		$criteria->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = EventPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptTermRelatedByEventTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

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
					$temp_obj2->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEvents();
				$obj2->addEvent($obj1);
			}

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getActor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEvents();
				$obj3->addEvent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByActorRoleId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

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
					$temp_obj2->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEvents();
				$obj2->addEvent($obj1);
			}

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getActor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEvents();
				$obj3->addEvent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptinformationObject(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);

		$c->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);

		$c->addJoin(EventPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTermRelatedByEventTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventRelatedByEventTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventsRelatedByEventTypeId();
				$obj2->addEventRelatedByEventTypeId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByActorRoleId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventRelatedByActorRoleId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventsRelatedByActorRoleId();
				$obj3->addEventRelatedByActorRoleId($obj1);
			}

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getActor(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initEvents();
				$obj4->addEvent($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptActor(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EventPeer::addSelectColumns($c);
		$startcol2 = (EventPeer::NUM_COLUMNS - EventPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		informationObjectPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + informationObjectPeer::NUM_COLUMNS;

		$c->addJoin(EventPeer::EVENT_TYPE_ID, TermPeer::ID);

		$c->addJoin(EventPeer::ACTOR_ROLE_ID, TermPeer::ID);

		$c->addJoin(EventPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = EventPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTermRelatedByEventTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addEventRelatedByEventTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initEventsRelatedByEventTypeId();
				$obj2->addEventRelatedByEventTypeId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByActorRoleId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addEventRelatedByActorRoleId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initEventsRelatedByActorRoleId();
				$obj3->addEventRelatedByActorRoleId($obj1);
			}

			$omClass = informationObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getinformationObject(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addEvent($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initEvents();
				$obj4->addEvent($obj1);
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
		return EventPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseEventPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEventPeer', $values, $con);
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

		$criteria->remove(EventPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseEventPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseEventPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseEventPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEventPeer', $values, $con);
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
			$comparison = $criteria->getComparison(EventPeer::ID);
			$selectCriteria->add(EventPeer::ID, $criteria->remove(EventPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseEventPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseEventPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(EventPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EventPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Event) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EventPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Event $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EventPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EventPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EventPeer::DATABASE_NAME, EventPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EventPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(EventPeer::DATABASE_NAME);

		$criteria->add(EventPeer::ID, $pk);


		$v = EventPeer::doSelect($criteria, $con);

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
			$criteria->add(EventPeer::ID, $pks, Criteria::IN);
			$objs = EventPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseEventPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/EventMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.EventMapBuilder');
}
