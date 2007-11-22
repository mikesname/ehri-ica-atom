<?php


abstract class BaseFunctionDescriptionPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'function_description';

	
	const CLASS_DEFAULT = 'lib.model.FunctionDescription';

	
	const NUM_COLUMNS = 17;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'function_description.ID';

	
	const TERM_ID = 'function_description.TERM_ID';

	
	const FUNCTION_DESCRIPTION_TYPE_ID = 'function_description.FUNCTION_DESCRIPTION_TYPE_ID';

	
	const CLASSIFICATION = 'function_description.CLASSIFICATION';

	
	const DOMAIN = 'function_description.DOMAIN';

	
	const DATES = 'function_description.DATES';

	
	const HISTORY = 'function_description.HISTORY';

	
	const LEGISLATION = 'function_description.LEGISLATION';

	
	const GENERAL_CONTEXT = 'function_description.GENERAL_CONTEXT';

	
	const DESCRIPTION_IDENTIFIER = 'function_description.DESCRIPTION_IDENTIFIER';

	
	const INSTITUTION_IDENTIFIER = 'function_description.INSTITUTION_IDENTIFIER';

	
	const RULES = 'function_description.RULES';

	
	const STATUS_ID = 'function_description.STATUS_ID';

	
	const LEVEL_ID = 'function_description.LEVEL_ID';

	
	const SOURCES = 'function_description.SOURCES';

	
	const CREATED_AT = 'function_description.CREATED_AT';

	
	const UPDATED_AT = 'function_description.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'TermId', 'FunctionDescriptionTypeId', 'Classification', 'Domain', 'Dates', 'History', 'Legislation', 'GeneralContext', 'DescriptionIdentifier', 'InstitutionIdentifier', 'Rules', 'StatusId', 'LevelId', 'Sources', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (FunctionDescriptionPeer::ID, FunctionDescriptionPeer::TERM_ID, FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, FunctionDescriptionPeer::CLASSIFICATION, FunctionDescriptionPeer::DOMAIN, FunctionDescriptionPeer::DATES, FunctionDescriptionPeer::HISTORY, FunctionDescriptionPeer::LEGISLATION, FunctionDescriptionPeer::GENERAL_CONTEXT, FunctionDescriptionPeer::DESCRIPTION_IDENTIFIER, FunctionDescriptionPeer::INSTITUTION_IDENTIFIER, FunctionDescriptionPeer::RULES, FunctionDescriptionPeer::STATUS_ID, FunctionDescriptionPeer::LEVEL_ID, FunctionDescriptionPeer::SOURCES, FunctionDescriptionPeer::CREATED_AT, FunctionDescriptionPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'term_id', 'function_description_type_id', 'classification', 'domain', 'dates', 'history', 'legislation', 'general_context', 'description_identifier', 'institution_identifier', 'rules', 'status_id', 'level_id', 'sources', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TermId' => 1, 'FunctionDescriptionTypeId' => 2, 'Classification' => 3, 'Domain' => 4, 'Dates' => 5, 'History' => 6, 'Legislation' => 7, 'GeneralContext' => 8, 'DescriptionIdentifier' => 9, 'InstitutionIdentifier' => 10, 'Rules' => 11, 'StatusId' => 12, 'LevelId' => 13, 'Sources' => 14, 'CreatedAt' => 15, 'UpdatedAt' => 16, ),
		BasePeer::TYPE_COLNAME => array (FunctionDescriptionPeer::ID => 0, FunctionDescriptionPeer::TERM_ID => 1, FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID => 2, FunctionDescriptionPeer::CLASSIFICATION => 3, FunctionDescriptionPeer::DOMAIN => 4, FunctionDescriptionPeer::DATES => 5, FunctionDescriptionPeer::HISTORY => 6, FunctionDescriptionPeer::LEGISLATION => 7, FunctionDescriptionPeer::GENERAL_CONTEXT => 8, FunctionDescriptionPeer::DESCRIPTION_IDENTIFIER => 9, FunctionDescriptionPeer::INSTITUTION_IDENTIFIER => 10, FunctionDescriptionPeer::RULES => 11, FunctionDescriptionPeer::STATUS_ID => 12, FunctionDescriptionPeer::LEVEL_ID => 13, FunctionDescriptionPeer::SOURCES => 14, FunctionDescriptionPeer::CREATED_AT => 15, FunctionDescriptionPeer::UPDATED_AT => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'term_id' => 1, 'function_description_type_id' => 2, 'classification' => 3, 'domain' => 4, 'dates' => 5, 'history' => 6, 'legislation' => 7, 'general_context' => 8, 'description_identifier' => 9, 'institution_identifier' => 10, 'rules' => 11, 'status_id' => 12, 'level_id' => 13, 'sources' => 14, 'created_at' => 15, 'updated_at' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/FunctionDescriptionMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.FunctionDescriptionMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = FunctionDescriptionPeer::getTableMap();
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
		return str_replace(FunctionDescriptionPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(FunctionDescriptionPeer::ID);

		$criteria->addSelectColumn(FunctionDescriptionPeer::TERM_ID);

		$criteria->addSelectColumn(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID);

		$criteria->addSelectColumn(FunctionDescriptionPeer::CLASSIFICATION);

		$criteria->addSelectColumn(FunctionDescriptionPeer::DOMAIN);

		$criteria->addSelectColumn(FunctionDescriptionPeer::DATES);

		$criteria->addSelectColumn(FunctionDescriptionPeer::HISTORY);

		$criteria->addSelectColumn(FunctionDescriptionPeer::LEGISLATION);

		$criteria->addSelectColumn(FunctionDescriptionPeer::GENERAL_CONTEXT);

		$criteria->addSelectColumn(FunctionDescriptionPeer::DESCRIPTION_IDENTIFIER);

		$criteria->addSelectColumn(FunctionDescriptionPeer::INSTITUTION_IDENTIFIER);

		$criteria->addSelectColumn(FunctionDescriptionPeer::RULES);

		$criteria->addSelectColumn(FunctionDescriptionPeer::STATUS_ID);

		$criteria->addSelectColumn(FunctionDescriptionPeer::LEVEL_ID);

		$criteria->addSelectColumn(FunctionDescriptionPeer::SOURCES);

		$criteria->addSelectColumn(FunctionDescriptionPeer::CREATED_AT);

		$criteria->addSelectColumn(FunctionDescriptionPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(function_description.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT function_description.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
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
		$objects = FunctionDescriptionPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return FunctionDescriptionPeer::populateObjects(FunctionDescriptionPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseFunctionDescriptionPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FunctionDescriptionPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = FunctionDescriptionPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinTermRelatedByTermId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FunctionDescriptionPeer::TERM_ID, TermPeer::ID);

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByFunctionDescriptionTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, TermPeer::ID);

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByStatusId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FunctionDescriptionPeer::STATUS_ID, TermPeer::ID);

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByLevelId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FunctionDescriptionPeer::LEVEL_ID, TermPeer::ID);

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinTermRelatedByTermId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseFunctionDescriptionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(FunctionDescriptionPeer::TERM_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByTermId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFunctionDescriptionRelatedByTermId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFunctionDescriptionsRelatedByTermId();
				$obj2->addFunctionDescriptionRelatedByTermId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByFunctionDescriptionTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByFunctionDescriptionTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFunctionDescriptionRelatedByFunctionDescriptionTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFunctionDescriptionsRelatedByFunctionDescriptionTypeId();
				$obj2->addFunctionDescriptionRelatedByFunctionDescriptionTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByStatusId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(FunctionDescriptionPeer::STATUS_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByStatusId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFunctionDescriptionRelatedByStatusId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFunctionDescriptionsRelatedByStatusId();
				$obj2->addFunctionDescriptionRelatedByStatusId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByLevelId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(FunctionDescriptionPeer::LEVEL_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByLevelId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addFunctionDescriptionRelatedByLevelId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initFunctionDescriptionsRelatedByLevelId();
				$obj2->addFunctionDescriptionRelatedByLevelId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FunctionDescriptionPeer::TERM_ID, TermPeer::ID);

		$criteria->addJoin(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(FunctionDescriptionPeer::STATUS_ID, TermPeer::ID);

		$criteria->addJoin(FunctionDescriptionPeer::LEVEL_ID, TermPeer::ID);

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseFunctionDescriptionPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol2 = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		$c->addJoin(FunctionDescriptionPeer::TERM_ID, TermPeer::ID);

		$c->addJoin(FunctionDescriptionPeer::FUNCTION_DESCRIPTION_TYPE_ID, TermPeer::ID);

		$c->addJoin(FunctionDescriptionPeer::STATUS_ID, TermPeer::ID);

		$c->addJoin(FunctionDescriptionPeer::LEVEL_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getTermRelatedByTermId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFunctionDescriptionRelatedByTermId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initFunctionDescriptionsRelatedByTermId();
				$obj2->addFunctionDescriptionRelatedByTermId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByFunctionDescriptionTypeId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFunctionDescriptionRelatedByFunctionDescriptionTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initFunctionDescriptionsRelatedByFunctionDescriptionTypeId();
				$obj3->addFunctionDescriptionRelatedByFunctionDescriptionTypeId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTermRelatedByStatusId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFunctionDescriptionRelatedByStatusId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initFunctionDescriptionsRelatedByStatusId();
				$obj4->addFunctionDescriptionRelatedByStatusId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTermRelatedByLevelId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFunctionDescriptionRelatedByLevelId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initFunctionDescriptionsRelatedByLevelId();
				$obj5->addFunctionDescriptionRelatedByLevelId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptTermRelatedByTermId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByFunctionDescriptionTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByStatusId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByLevelId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FunctionDescriptionPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FunctionDescriptionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptTermRelatedByTermId(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseFunctionDescriptionPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol2 = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByFunctionDescriptionTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol2 = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByStatusId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol2 = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByLevelId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FunctionDescriptionPeer::addSelectColumns($c);
		$startcol2 = (FunctionDescriptionPeer::NUM_COLUMNS - FunctionDescriptionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FunctionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

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
		return FunctionDescriptionPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFunctionDescriptionPeer', $values, $con);
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

		$criteria->remove(FunctionDescriptionPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFunctionDescriptionPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFunctionDescriptionPeer', $values, $con);
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
			$comparison = $criteria->getComparison(FunctionDescriptionPeer::ID);
			$selectCriteria->add(FunctionDescriptionPeer::ID, $criteria->remove(FunctionDescriptionPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFunctionDescriptionPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFunctionDescriptionPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(FunctionDescriptionPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(FunctionDescriptionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof FunctionDescription) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FunctionDescriptionPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(FunctionDescription $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FunctionDescriptionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FunctionDescriptionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FunctionDescriptionPeer::DATABASE_NAME, FunctionDescriptionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FunctionDescriptionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(FunctionDescriptionPeer::DATABASE_NAME);

		$criteria->add(FunctionDescriptionPeer::ID, $pk);


		$v = FunctionDescriptionPeer::doSelect($criteria, $con);

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
			$criteria->add(FunctionDescriptionPeer::ID, $pks, Criteria::IN);
			$objs = FunctionDescriptionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseFunctionDescriptionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/FunctionDescriptionMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.FunctionDescriptionMapBuilder');
}
