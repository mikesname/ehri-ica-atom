<?php


abstract class BaseinformationObjectPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'information_object';

	
	const CLASS_DEFAULT = 'lib.model.informationObject';

	
	const NUM_COLUMNS = 29;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'information_object.ID';

	
	const IDENTIFIER = 'information_object.IDENTIFIER';

	
	const TITLE = 'information_object.TITLE';

	
	const ALTERNATETITLE = 'information_object.ALTERNATETITLE';

	
	const VERSION = 'information_object.VERSION';

	
	const LEVEL_OF_DESCRIPTION_ID = 'information_object.LEVEL_OF_DESCRIPTION_ID';

	
	const EXTENT_AND_MEDIUM = 'information_object.EXTENT_AND_MEDIUM';

	
	const ARCHIVAL_HISTORY = 'information_object.ARCHIVAL_HISTORY';

	
	const ACQUISITION = 'information_object.ACQUISITION';

	
	const SCOPE_AND_CONTENT = 'information_object.SCOPE_AND_CONTENT';

	
	const APPRAISAL = 'information_object.APPRAISAL';

	
	const ACCRUALS = 'information_object.ACCRUALS';

	
	const ARRANGEMENT = 'information_object.ARRANGEMENT';

	
	const ACCESS_CONDITIONS = 'information_object.ACCESS_CONDITIONS';

	
	const REPRODUCTION_CONDITIONS = 'information_object.REPRODUCTION_CONDITIONS';

	
	const PHYSICAL_CHARACTERISTICS = 'information_object.PHYSICAL_CHARACTERISTICS';

	
	const FINDING_AIDS = 'information_object.FINDING_AIDS';

	
	const LOCATION_OF_ORIGINALS = 'information_object.LOCATION_OF_ORIGINALS';

	
	const LOCATION_OF_COPIES = 'information_object.LOCATION_OF_COPIES';

	
	const RELATED_UNITS_OF_DESCRIPTION = 'information_object.RELATED_UNITS_OF_DESCRIPTION';

	
	const RULES = 'information_object.RULES';

	
	const COLLECTION_TYPE_ID = 'information_object.COLLECTION_TYPE_ID';

	
	const REPOSITORY_ID = 'information_object.REPOSITORY_ID';

	
	const TREE_ID = 'information_object.TREE_ID';

	
	const TREE_LEFT_ID = 'information_object.TREE_LEFT_ID';

	
	const TREE_RIGHT_ID = 'information_object.TREE_RIGHT_ID';

	
	const TREE_PARENT_ID = 'information_object.TREE_PARENT_ID';

	
	const CREATED_AT = 'information_object.CREATED_AT';

	
	const UPDATED_AT = 'information_object.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Identifier', 'Title', 'Alternatetitle', 'Version', 'LevelOfDescriptionId', 'ExtentAndMedium', 'ArchivalHistory', 'Acquisition', 'ScopeAndContent', 'Appraisal', 'Accruals', 'Arrangement', 'AccessConditions', 'ReproductionConditions', 'PhysicalCharacteristics', 'FindingAids', 'LocationOfOriginals', 'LocationOfCopies', 'RelatedUnitsOfDescription', 'Rules', 'CollectionTypeId', 'RepositoryId', 'TreeId', 'TreeLeftId', 'TreeRightId', 'TreeParentId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (informationObjectPeer::ID, informationObjectPeer::IDENTIFIER, informationObjectPeer::TITLE, informationObjectPeer::ALTERNATETITLE, informationObjectPeer::VERSION, informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, informationObjectPeer::EXTENT_AND_MEDIUM, informationObjectPeer::ARCHIVAL_HISTORY, informationObjectPeer::ACQUISITION, informationObjectPeer::SCOPE_AND_CONTENT, informationObjectPeer::APPRAISAL, informationObjectPeer::ACCRUALS, informationObjectPeer::ARRANGEMENT, informationObjectPeer::ACCESS_CONDITIONS, informationObjectPeer::REPRODUCTION_CONDITIONS, informationObjectPeer::PHYSICAL_CHARACTERISTICS, informationObjectPeer::FINDING_AIDS, informationObjectPeer::LOCATION_OF_ORIGINALS, informationObjectPeer::LOCATION_OF_COPIES, informationObjectPeer::RELATED_UNITS_OF_DESCRIPTION, informationObjectPeer::RULES, informationObjectPeer::COLLECTION_TYPE_ID, informationObjectPeer::REPOSITORY_ID, informationObjectPeer::TREE_ID, informationObjectPeer::TREE_LEFT_ID, informationObjectPeer::TREE_RIGHT_ID, informationObjectPeer::TREE_PARENT_ID, informationObjectPeer::CREATED_AT, informationObjectPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'identifier', 'title', 'alternateTitle', 'version', 'level_of_description_id', 'extent_and_medium', 'archival_history', 'acquisition', 'scope_and_content', 'appraisal', 'accruals', 'arrangement', 'access_conditions', 'reproduction_conditions', 'physical_characteristics', 'finding_aids', 'location_of_originals', 'location_of_copies', 'related_units_of_description', 'rules', 'collection_type_id', 'repository_id', 'tree_id', 'tree_left_id', 'tree_right_id', 'tree_parent_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Identifier' => 1, 'Title' => 2, 'Alternatetitle' => 3, 'Version' => 4, 'LevelOfDescriptionId' => 5, 'ExtentAndMedium' => 6, 'ArchivalHistory' => 7, 'Acquisition' => 8, 'ScopeAndContent' => 9, 'Appraisal' => 10, 'Accruals' => 11, 'Arrangement' => 12, 'AccessConditions' => 13, 'ReproductionConditions' => 14, 'PhysicalCharacteristics' => 15, 'FindingAids' => 16, 'LocationOfOriginals' => 17, 'LocationOfCopies' => 18, 'RelatedUnitsOfDescription' => 19, 'Rules' => 20, 'CollectionTypeId' => 21, 'RepositoryId' => 22, 'TreeId' => 23, 'TreeLeftId' => 24, 'TreeRightId' => 25, 'TreeParentId' => 26, 'CreatedAt' => 27, 'UpdatedAt' => 28, ),
		BasePeer::TYPE_COLNAME => array (informationObjectPeer::ID => 0, informationObjectPeer::IDENTIFIER => 1, informationObjectPeer::TITLE => 2, informationObjectPeer::ALTERNATETITLE => 3, informationObjectPeer::VERSION => 4, informationObjectPeer::LEVEL_OF_DESCRIPTION_ID => 5, informationObjectPeer::EXTENT_AND_MEDIUM => 6, informationObjectPeer::ARCHIVAL_HISTORY => 7, informationObjectPeer::ACQUISITION => 8, informationObjectPeer::SCOPE_AND_CONTENT => 9, informationObjectPeer::APPRAISAL => 10, informationObjectPeer::ACCRUALS => 11, informationObjectPeer::ARRANGEMENT => 12, informationObjectPeer::ACCESS_CONDITIONS => 13, informationObjectPeer::REPRODUCTION_CONDITIONS => 14, informationObjectPeer::PHYSICAL_CHARACTERISTICS => 15, informationObjectPeer::FINDING_AIDS => 16, informationObjectPeer::LOCATION_OF_ORIGINALS => 17, informationObjectPeer::LOCATION_OF_COPIES => 18, informationObjectPeer::RELATED_UNITS_OF_DESCRIPTION => 19, informationObjectPeer::RULES => 20, informationObjectPeer::COLLECTION_TYPE_ID => 21, informationObjectPeer::REPOSITORY_ID => 22, informationObjectPeer::TREE_ID => 23, informationObjectPeer::TREE_LEFT_ID => 24, informationObjectPeer::TREE_RIGHT_ID => 25, informationObjectPeer::TREE_PARENT_ID => 26, informationObjectPeer::CREATED_AT => 27, informationObjectPeer::UPDATED_AT => 28, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'identifier' => 1, 'title' => 2, 'alternateTitle' => 3, 'version' => 4, 'level_of_description_id' => 5, 'extent_and_medium' => 6, 'archival_history' => 7, 'acquisition' => 8, 'scope_and_content' => 9, 'appraisal' => 10, 'accruals' => 11, 'arrangement' => 12, 'access_conditions' => 13, 'reproduction_conditions' => 14, 'physical_characteristics' => 15, 'finding_aids' => 16, 'location_of_originals' => 17, 'location_of_copies' => 18, 'related_units_of_description' => 19, 'rules' => 20, 'collection_type_id' => 21, 'repository_id' => 22, 'tree_id' => 23, 'tree_left_id' => 24, 'tree_right_id' => 25, 'tree_parent_id' => 26, 'created_at' => 27, 'updated_at' => 28, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/informationObjectMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.informationObjectMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = informationObjectPeer::getTableMap();
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
		return str_replace(informationObjectPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(informationObjectPeer::ID);

		$criteria->addSelectColumn(informationObjectPeer::IDENTIFIER);

		$criteria->addSelectColumn(informationObjectPeer::TITLE);

		$criteria->addSelectColumn(informationObjectPeer::ALTERNATETITLE);

		$criteria->addSelectColumn(informationObjectPeer::VERSION);

		$criteria->addSelectColumn(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID);

		$criteria->addSelectColumn(informationObjectPeer::EXTENT_AND_MEDIUM);

		$criteria->addSelectColumn(informationObjectPeer::ARCHIVAL_HISTORY);

		$criteria->addSelectColumn(informationObjectPeer::ACQUISITION);

		$criteria->addSelectColumn(informationObjectPeer::SCOPE_AND_CONTENT);

		$criteria->addSelectColumn(informationObjectPeer::APPRAISAL);

		$criteria->addSelectColumn(informationObjectPeer::ACCRUALS);

		$criteria->addSelectColumn(informationObjectPeer::ARRANGEMENT);

		$criteria->addSelectColumn(informationObjectPeer::ACCESS_CONDITIONS);

		$criteria->addSelectColumn(informationObjectPeer::REPRODUCTION_CONDITIONS);

		$criteria->addSelectColumn(informationObjectPeer::PHYSICAL_CHARACTERISTICS);

		$criteria->addSelectColumn(informationObjectPeer::FINDING_AIDS);

		$criteria->addSelectColumn(informationObjectPeer::LOCATION_OF_ORIGINALS);

		$criteria->addSelectColumn(informationObjectPeer::LOCATION_OF_COPIES);

		$criteria->addSelectColumn(informationObjectPeer::RELATED_UNITS_OF_DESCRIPTION);

		$criteria->addSelectColumn(informationObjectPeer::RULES);

		$criteria->addSelectColumn(informationObjectPeer::COLLECTION_TYPE_ID);

		$criteria->addSelectColumn(informationObjectPeer::REPOSITORY_ID);

		$criteria->addSelectColumn(informationObjectPeer::TREE_ID);

		$criteria->addSelectColumn(informationObjectPeer::TREE_LEFT_ID);

		$criteria->addSelectColumn(informationObjectPeer::TREE_RIGHT_ID);

		$criteria->addSelectColumn(informationObjectPeer::TREE_PARENT_ID);

		$criteria->addSelectColumn(informationObjectPeer::CREATED_AT);

		$criteria->addSelectColumn(informationObjectPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(information_object.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT information_object.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
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
		$objects = informationObjectPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return informationObjectPeer::populateObjects(informationObjectPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseinformationObjectPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseinformationObjectPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			informationObjectPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = informationObjectPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinTermRelatedByLevelOfDescriptionId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, TermPeer::ID);

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByCollectionTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectPeer::COLLECTION_TYPE_ID, TermPeer::ID);

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinRepository(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinTermRelatedByLevelOfDescriptionId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectPeer::addSelectColumns($c);
		$startcol = (informationObjectPeer::NUM_COLUMNS - informationObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByLevelOfDescriptionId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addinformationObjectRelatedByLevelOfDescriptionId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initinformationObjectsRelatedByLevelOfDescriptionId();
				$obj2->addinformationObjectRelatedByLevelOfDescriptionId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByCollectionTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectPeer::addSelectColumns($c);
		$startcol = (informationObjectPeer::NUM_COLUMNS - informationObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(informationObjectPeer::COLLECTION_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByCollectionTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addinformationObjectRelatedByCollectionTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initinformationObjectsRelatedByCollectionTypeId();
				$obj2->addinformationObjectRelatedByCollectionTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinRepository(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectPeer::addSelectColumns($c);
		$startcol = (informationObjectPeer::NUM_COLUMNS - informationObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RepositoryPeer::addSelectColumns($c);

		$c->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RepositoryPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getRepository(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addinformationObject($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initinformationObjects();
				$obj2->addinformationObject($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, TermPeer::ID);

		$criteria->addJoin(informationObjectPeer::COLLECTION_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
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

		informationObjectPeer::addSelectColumns($c);
		$startcol2 = (informationObjectPeer::NUM_COLUMNS - informationObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		RepositoryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RepositoryPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, TermPeer::ID);

		$c->addJoin(informationObjectPeer::COLLECTION_TYPE_ID, TermPeer::ID);

		$c->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getTermRelatedByLevelOfDescriptionId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addinformationObjectRelatedByLevelOfDescriptionId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjectsRelatedByLevelOfDescriptionId();
				$obj2->addinformationObjectRelatedByLevelOfDescriptionId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByCollectionTypeId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addinformationObjectRelatedByCollectionTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initinformationObjectsRelatedByCollectionTypeId();
				$obj3->addinformationObjectRelatedByCollectionTypeId($obj1);
			}


					
			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getRepository(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addinformationObject($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initinformationObjects();
				$obj4->addinformationObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptTermRelatedByLevelOfDescriptionId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByCollectionTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptRepository(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(informationObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(informationObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, TermPeer::ID);

		$criteria->addJoin(informationObjectPeer::COLLECTION_TYPE_ID, TermPeer::ID);

		$rs = informationObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptTermRelatedByLevelOfDescriptionId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectPeer::addSelectColumns($c);
		$startcol2 = (informationObjectPeer::NUM_COLUMNS - informationObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RepositoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RepositoryPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRepository(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addinformationObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjects();
				$obj2->addinformationObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByCollectionTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectPeer::addSelectColumns($c);
		$startcol2 = (informationObjectPeer::NUM_COLUMNS - informationObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		RepositoryPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + RepositoryPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectPeer::REPOSITORY_ID, RepositoryPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getRepository(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addinformationObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjects();
				$obj2->addinformationObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptRepository(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		informationObjectPeer::addSelectColumns($c);
		$startcol2 = (informationObjectPeer::NUM_COLUMNS - informationObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		$c->addJoin(informationObjectPeer::LEVEL_OF_DESCRIPTION_ID, TermPeer::ID);

		$c->addJoin(informationObjectPeer::COLLECTION_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = informationObjectPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTermRelatedByLevelOfDescriptionId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addinformationObjectRelatedByLevelOfDescriptionId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initinformationObjectsRelatedByLevelOfDescriptionId();
				$obj2->addinformationObjectRelatedByLevelOfDescriptionId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByCollectionTypeId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addinformationObjectRelatedByCollectionTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initinformationObjectsRelatedByCollectionTypeId();
				$obj3->addinformationObjectRelatedByCollectionTypeId($obj1);
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
		return informationObjectPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseinformationObjectPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseinformationObjectPeer', $values, $con);
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

		$criteria->remove(informationObjectPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseinformationObjectPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseinformationObjectPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseinformationObjectPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseinformationObjectPeer', $values, $con);
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
			$comparison = $criteria->getComparison(informationObjectPeer::ID);
			$selectCriteria->add(informationObjectPeer::ID, $criteria->remove(informationObjectPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseinformationObjectPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseinformationObjectPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(informationObjectPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(informationObjectPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof informationObject) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(informationObjectPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(informationObject $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(informationObjectPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(informationObjectPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(informationObjectPeer::DATABASE_NAME, informationObjectPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = informationObjectPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(informationObjectPeer::DATABASE_NAME);

		$criteria->add(informationObjectPeer::ID, $pk);


		$v = informationObjectPeer::doSelect($criteria, $con);

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
			$criteria->add(informationObjectPeer::ID, $pks, Criteria::IN);
			$objs = informationObjectPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseinformationObjectPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/informationObjectMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.informationObjectMapBuilder');
}
