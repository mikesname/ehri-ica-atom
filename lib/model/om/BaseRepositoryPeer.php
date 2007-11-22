<?php


abstract class BaseRepositoryPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'repository';

	
	const CLASS_DEFAULT = 'lib.model.Repository';

	
	const NUM_COLUMNS = 25;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'repository.ID';

	
	const ACTOR_ID = 'repository.ACTOR_ID';

	
	const IDENTIFIER = 'repository.IDENTIFIER';

	
	const REPOSITORY_TYPE_ID = 'repository.REPOSITORY_TYPE_ID';

	
	const OFFICERS_IN_CHARGE = 'repository.OFFICERS_IN_CHARGE';

	
	const GEOCULTURAL_CONTEXT = 'repository.GEOCULTURAL_CONTEXT';

	
	const COLLECTING_POLICIES = 'repository.COLLECTING_POLICIES';

	
	const BUILDINGS = 'repository.BUILDINGS';

	
	const HOLDINGS = 'repository.HOLDINGS';

	
	const FINDING_AIDS = 'repository.FINDING_AIDS';

	
	const OPENING_TIMES = 'repository.OPENING_TIMES';

	
	const ACCESS_CONDITIONS = 'repository.ACCESS_CONDITIONS';

	
	const DISABLED_ACCESS = 'repository.DISABLED_ACCESS';

	
	const TRANSPORT = 'repository.TRANSPORT';

	
	const RESEARCH_SERVICES = 'repository.RESEARCH_SERVICES';

	
	const REPRODUCTION_SERVICES = 'repository.REPRODUCTION_SERVICES';

	
	const PUBLIC_FACILITIES = 'repository.PUBLIC_FACILITIES';

	
	const DESCRIPTION_IDENTIFIER = 'repository.DESCRIPTION_IDENTIFIER';

	
	const INSTITUTION_IDENTIFIER = 'repository.INSTITUTION_IDENTIFIER';

	
	const RULES = 'repository.RULES';

	
	const STATUS_ID = 'repository.STATUS_ID';

	
	const LEVEL_OF_DETAIL_ID = 'repository.LEVEL_OF_DETAIL_ID';

	
	const SOURCES = 'repository.SOURCES';

	
	const CREATED_AT = 'repository.CREATED_AT';

	
	const UPDATED_AT = 'repository.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ActorId', 'Identifier', 'RepositoryTypeId', 'OfficersInCharge', 'GeoculturalContext', 'CollectingPolicies', 'Buildings', 'Holdings', 'FindingAids', 'OpeningTimes', 'AccessConditions', 'DisabledAccess', 'Transport', 'ResearchServices', 'ReproductionServices', 'PublicFacilities', 'DescriptionIdentifier', 'InstitutionIdentifier', 'Rules', 'StatusId', 'LevelOfDetailId', 'Sources', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (RepositoryPeer::ID, RepositoryPeer::ACTOR_ID, RepositoryPeer::IDENTIFIER, RepositoryPeer::REPOSITORY_TYPE_ID, RepositoryPeer::OFFICERS_IN_CHARGE, RepositoryPeer::GEOCULTURAL_CONTEXT, RepositoryPeer::COLLECTING_POLICIES, RepositoryPeer::BUILDINGS, RepositoryPeer::HOLDINGS, RepositoryPeer::FINDING_AIDS, RepositoryPeer::OPENING_TIMES, RepositoryPeer::ACCESS_CONDITIONS, RepositoryPeer::DISABLED_ACCESS, RepositoryPeer::TRANSPORT, RepositoryPeer::RESEARCH_SERVICES, RepositoryPeer::REPRODUCTION_SERVICES, RepositoryPeer::PUBLIC_FACILITIES, RepositoryPeer::DESCRIPTION_IDENTIFIER, RepositoryPeer::INSTITUTION_IDENTIFIER, RepositoryPeer::RULES, RepositoryPeer::STATUS_ID, RepositoryPeer::LEVEL_OF_DETAIL_ID, RepositoryPeer::SOURCES, RepositoryPeer::CREATED_AT, RepositoryPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'actor_id', 'identifier', 'repository_type_id', 'officers_in_charge', 'geocultural_context', 'collecting_policies', 'buildings', 'holdings', 'finding_aids', 'opening_times', 'access_conditions', 'disabled_access', 'transport', 'research_services', 'reproduction_services', 'public_facilities', 'description_identifier', 'institution_identifier', 'rules', 'status_id', 'level_of_detail_id', 'sources', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ActorId' => 1, 'Identifier' => 2, 'RepositoryTypeId' => 3, 'OfficersInCharge' => 4, 'GeoculturalContext' => 5, 'CollectingPolicies' => 6, 'Buildings' => 7, 'Holdings' => 8, 'FindingAids' => 9, 'OpeningTimes' => 10, 'AccessConditions' => 11, 'DisabledAccess' => 12, 'Transport' => 13, 'ResearchServices' => 14, 'ReproductionServices' => 15, 'PublicFacilities' => 16, 'DescriptionIdentifier' => 17, 'InstitutionIdentifier' => 18, 'Rules' => 19, 'StatusId' => 20, 'LevelOfDetailId' => 21, 'Sources' => 22, 'CreatedAt' => 23, 'UpdatedAt' => 24, ),
		BasePeer::TYPE_COLNAME => array (RepositoryPeer::ID => 0, RepositoryPeer::ACTOR_ID => 1, RepositoryPeer::IDENTIFIER => 2, RepositoryPeer::REPOSITORY_TYPE_ID => 3, RepositoryPeer::OFFICERS_IN_CHARGE => 4, RepositoryPeer::GEOCULTURAL_CONTEXT => 5, RepositoryPeer::COLLECTING_POLICIES => 6, RepositoryPeer::BUILDINGS => 7, RepositoryPeer::HOLDINGS => 8, RepositoryPeer::FINDING_AIDS => 9, RepositoryPeer::OPENING_TIMES => 10, RepositoryPeer::ACCESS_CONDITIONS => 11, RepositoryPeer::DISABLED_ACCESS => 12, RepositoryPeer::TRANSPORT => 13, RepositoryPeer::RESEARCH_SERVICES => 14, RepositoryPeer::REPRODUCTION_SERVICES => 15, RepositoryPeer::PUBLIC_FACILITIES => 16, RepositoryPeer::DESCRIPTION_IDENTIFIER => 17, RepositoryPeer::INSTITUTION_IDENTIFIER => 18, RepositoryPeer::RULES => 19, RepositoryPeer::STATUS_ID => 20, RepositoryPeer::LEVEL_OF_DETAIL_ID => 21, RepositoryPeer::SOURCES => 22, RepositoryPeer::CREATED_AT => 23, RepositoryPeer::UPDATED_AT => 24, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'actor_id' => 1, 'identifier' => 2, 'repository_type_id' => 3, 'officers_in_charge' => 4, 'geocultural_context' => 5, 'collecting_policies' => 6, 'buildings' => 7, 'holdings' => 8, 'finding_aids' => 9, 'opening_times' => 10, 'access_conditions' => 11, 'disabled_access' => 12, 'transport' => 13, 'research_services' => 14, 'reproduction_services' => 15, 'public_facilities' => 16, 'description_identifier' => 17, 'institution_identifier' => 18, 'rules' => 19, 'status_id' => 20, 'level_of_detail_id' => 21, 'sources' => 22, 'created_at' => 23, 'updated_at' => 24, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/RepositoryMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.RepositoryMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = RepositoryPeer::getTableMap();
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
		return str_replace(RepositoryPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(RepositoryPeer::ID);

		$criteria->addSelectColumn(RepositoryPeer::ACTOR_ID);

		$criteria->addSelectColumn(RepositoryPeer::IDENTIFIER);

		$criteria->addSelectColumn(RepositoryPeer::REPOSITORY_TYPE_ID);

		$criteria->addSelectColumn(RepositoryPeer::OFFICERS_IN_CHARGE);

		$criteria->addSelectColumn(RepositoryPeer::GEOCULTURAL_CONTEXT);

		$criteria->addSelectColumn(RepositoryPeer::COLLECTING_POLICIES);

		$criteria->addSelectColumn(RepositoryPeer::BUILDINGS);

		$criteria->addSelectColumn(RepositoryPeer::HOLDINGS);

		$criteria->addSelectColumn(RepositoryPeer::FINDING_AIDS);

		$criteria->addSelectColumn(RepositoryPeer::OPENING_TIMES);

		$criteria->addSelectColumn(RepositoryPeer::ACCESS_CONDITIONS);

		$criteria->addSelectColumn(RepositoryPeer::DISABLED_ACCESS);

		$criteria->addSelectColumn(RepositoryPeer::TRANSPORT);

		$criteria->addSelectColumn(RepositoryPeer::RESEARCH_SERVICES);

		$criteria->addSelectColumn(RepositoryPeer::REPRODUCTION_SERVICES);

		$criteria->addSelectColumn(RepositoryPeer::PUBLIC_FACILITIES);

		$criteria->addSelectColumn(RepositoryPeer::DESCRIPTION_IDENTIFIER);

		$criteria->addSelectColumn(RepositoryPeer::INSTITUTION_IDENTIFIER);

		$criteria->addSelectColumn(RepositoryPeer::RULES);

		$criteria->addSelectColumn(RepositoryPeer::STATUS_ID);

		$criteria->addSelectColumn(RepositoryPeer::LEVEL_OF_DETAIL_ID);

		$criteria->addSelectColumn(RepositoryPeer::SOURCES);

		$criteria->addSelectColumn(RepositoryPeer::CREATED_AT);

		$criteria->addSelectColumn(RepositoryPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(repository.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT repository.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
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
		$objects = RepositoryPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return RepositoryPeer::populateObjects(RepositoryPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseRepositoryPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			RepositoryPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = RepositoryPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByRepositoryTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::REPOSITORY_TYPE_ID, TermPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::STATUS_ID, TermPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByLevelOfDetailId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinActor(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseRepositoryPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepositoryPeer::addSelectColumns($c);
		$startcol = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

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
										$temp_obj2->addRepository($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRepositorys();
				$obj2->addRepository($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByRepositoryTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepositoryPeer::addSelectColumns($c);
		$startcol = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(RepositoryPeer::REPOSITORY_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByRepositoryTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRepositoryRelatedByRepositoryTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRepositorysRelatedByRepositoryTypeId();
				$obj2->addRepositoryRelatedByRepositoryTypeId($obj1); 			}
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

		RepositoryPeer::addSelectColumns($c);
		$startcol = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(RepositoryPeer::STATUS_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

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
										$temp_obj2->addRepositoryRelatedByStatusId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRepositorysRelatedByStatusId();
				$obj2->addRepositoryRelatedByStatusId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByLevelOfDetailId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepositoryPeer::addSelectColumns($c);
		$startcol = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(RepositoryPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByLevelOfDetailId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addRepositoryRelatedByLevelOfDetailId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initRepositorysRelatedByLevelOfDetailId();
				$obj2->addRepositoryRelatedByLevelOfDetailId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(RepositoryPeer::REPOSITORY_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(RepositoryPeer::STATUS_ID, TermPeer::ID);

		$criteria->addJoin(RepositoryPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseRepositoryPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepositoryPeer::addSelectColumns($c);
		$startcol2 = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(RepositoryPeer::REPOSITORY_TYPE_ID, TermPeer::ID);

		$c->addJoin(RepositoryPeer::STATUS_ID, TermPeer::ID);

		$c->addJoin(RepositoryPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepository($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initRepositorys();
				$obj2->addRepository($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByRepositoryTypeId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRepositoryRelatedByRepositoryTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initRepositorysRelatedByRepositoryTypeId();
				$obj3->addRepositoryRelatedByRepositoryTypeId($obj1);
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
					$temp_obj4->addRepositoryRelatedByStatusId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initRepositorysRelatedByStatusId();
				$obj4->addRepositoryRelatedByStatusId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTermRelatedByLevelOfDetailId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addRepositoryRelatedByLevelOfDetailId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initRepositorysRelatedByLevelOfDetailId();
				$obj5->addRepositoryRelatedByLevelOfDetailId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptActor(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::REPOSITORY_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(RepositoryPeer::STATUS_ID, TermPeer::ID);

		$criteria->addJoin(RepositoryPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByRepositoryTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByLevelOfDetailId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepositoryPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepositoryPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);

		$rs = RepositoryPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptActor(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseRepositoryPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepositoryPeer::addSelectColumns($c);
		$startcol2 = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(RepositoryPeer::REPOSITORY_TYPE_ID, TermPeer::ID);

		$c->addJoin(RepositoryPeer::STATUS_ID, TermPeer::ID);

		$c->addJoin(RepositoryPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTermRelatedByRepositoryTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepositoryRelatedByRepositoryTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepositorysRelatedByRepositoryTypeId();
				$obj2->addRepositoryRelatedByRepositoryTypeId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByStatusId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRepositoryRelatedByStatusId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initRepositorysRelatedByStatusId();
				$obj3->addRepositoryRelatedByStatusId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTermRelatedByLevelOfDetailId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addRepositoryRelatedByLevelOfDetailId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initRepositorysRelatedByLevelOfDetailId();
				$obj4->addRepositoryRelatedByLevelOfDetailId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByRepositoryTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepositoryPeer::addSelectColumns($c);
		$startcol2 = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepository($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepositorys();
				$obj2->addRepository($obj1);
			}

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

		RepositoryPeer::addSelectColumns($c);
		$startcol2 = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepository($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepositorys();
				$obj2->addRepository($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByLevelOfDetailId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepositoryPeer::addSelectColumns($c);
		$startcol2 = (RepositoryPeer::NUM_COLUMNS - RepositoryPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(RepositoryPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepositoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getActor(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepository($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepositorys();
				$obj2->addRepository($obj1);
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
		return RepositoryPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepositoryPeer', $values, $con);
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

		$criteria->remove(RepositoryPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseRepositoryPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseRepositoryPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepositoryPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseRepositoryPeer', $values, $con);
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
			$comparison = $criteria->getComparison(RepositoryPeer::ID);
			$selectCriteria->add(RepositoryPeer::ID, $criteria->remove(RepositoryPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseRepositoryPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseRepositoryPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(RepositoryPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(RepositoryPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Repository) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepositoryPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Repository $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepositoryPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepositoryPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepositoryPeer::DATABASE_NAME, RepositoryPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepositoryPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(RepositoryPeer::DATABASE_NAME);

		$criteria->add(RepositoryPeer::ID, $pk);


		$v = RepositoryPeer::doSelect($criteria, $con);

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
			$criteria->add(RepositoryPeer::ID, $pks, Criteria::IN);
			$objs = RepositoryPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseRepositoryPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/RepositoryMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.RepositoryMapBuilder');
}
