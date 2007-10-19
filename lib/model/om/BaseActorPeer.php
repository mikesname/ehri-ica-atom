<?php


abstract class BaseActorPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'actor';

	
	const CLASS_DEFAULT = 'lib.model.Actor';

	
	const NUM_COLUMNS = 22;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'actor.ID';

	
	const AUTHORIZED_FORM_OF_NAME = 'actor.AUTHORIZED_FORM_OF_NAME';

	
	const TYPE_OF_ENTITY_ID = 'actor.TYPE_OF_ENTITY_ID';

	
	const IDENTIFIERS = 'actor.IDENTIFIERS';

	
	const HISTORY = 'actor.HISTORY';

	
	const LEGAL_STATUS = 'actor.LEGAL_STATUS';

	
	const FUNCTIONS = 'actor.FUNCTIONS';

	
	const MANDATES = 'actor.MANDATES';

	
	const INTERNAL_STRUCTURES = 'actor.INTERNAL_STRUCTURES';

	
	const GENERAL_CONTEXT = 'actor.GENERAL_CONTEXT';

	
	const AUTHORITY_RECORD_IDENTIFIER = 'actor.AUTHORITY_RECORD_IDENTIFIER';

	
	const INSTITUTION_IDENTIFIER = 'actor.INSTITUTION_IDENTIFIER';

	
	const RULES = 'actor.RULES';

	
	const STATUS_ID = 'actor.STATUS_ID';

	
	const LEVEL_OF_DETAIL_ID = 'actor.LEVEL_OF_DETAIL_ID';

	
	const SOURCES = 'actor.SOURCES';

	
	const TREE_ID = 'actor.TREE_ID';

	
	const TREE_LEFT_ID = 'actor.TREE_LEFT_ID';

	
	const TREE_RIGHT_ID = 'actor.TREE_RIGHT_ID';

	
	const TREE_PARENT_ID = 'actor.TREE_PARENT_ID';

	
	const CREATED_AT = 'actor.CREATED_AT';

	
	const UPDATED_AT = 'actor.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'AuthorizedFormOfName', 'TypeOfEntityId', 'Identifiers', 'History', 'LegalStatus', 'Functions', 'Mandates', 'InternalStructures', 'GeneralContext', 'AuthorityRecordIdentifier', 'InstitutionIdentifier', 'Rules', 'StatusId', 'LevelOfDetailId', 'Sources', 'TreeId', 'TreeLeftId', 'TreeRightId', 'TreeParentId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ActorPeer::ID, ActorPeer::AUTHORIZED_FORM_OF_NAME, ActorPeer::TYPE_OF_ENTITY_ID, ActorPeer::IDENTIFIERS, ActorPeer::HISTORY, ActorPeer::LEGAL_STATUS, ActorPeer::FUNCTIONS, ActorPeer::MANDATES, ActorPeer::INTERNAL_STRUCTURES, ActorPeer::GENERAL_CONTEXT, ActorPeer::AUTHORITY_RECORD_IDENTIFIER, ActorPeer::INSTITUTION_IDENTIFIER, ActorPeer::RULES, ActorPeer::STATUS_ID, ActorPeer::LEVEL_OF_DETAIL_ID, ActorPeer::SOURCES, ActorPeer::TREE_ID, ActorPeer::TREE_LEFT_ID, ActorPeer::TREE_RIGHT_ID, ActorPeer::TREE_PARENT_ID, ActorPeer::CREATED_AT, ActorPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'authorized_form_of_name', 'type_of_entity_id', 'identifiers', 'history', 'legal_status', 'functions', 'mandates', 'internal_structures', 'general_context', 'authority_record_identifier', 'institution_identifier', 'rules', 'status_id', 'level_of_detail_id', 'sources', 'tree_id', 'tree_left_id', 'tree_right_id', 'tree_parent_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'AuthorizedFormOfName' => 1, 'TypeOfEntityId' => 2, 'Identifiers' => 3, 'History' => 4, 'LegalStatus' => 5, 'Functions' => 6, 'Mandates' => 7, 'InternalStructures' => 8, 'GeneralContext' => 9, 'AuthorityRecordIdentifier' => 10, 'InstitutionIdentifier' => 11, 'Rules' => 12, 'StatusId' => 13, 'LevelOfDetailId' => 14, 'Sources' => 15, 'TreeId' => 16, 'TreeLeftId' => 17, 'TreeRightId' => 18, 'TreeParentId' => 19, 'CreatedAt' => 20, 'UpdatedAt' => 21, ),
		BasePeer::TYPE_COLNAME => array (ActorPeer::ID => 0, ActorPeer::AUTHORIZED_FORM_OF_NAME => 1, ActorPeer::TYPE_OF_ENTITY_ID => 2, ActorPeer::IDENTIFIERS => 3, ActorPeer::HISTORY => 4, ActorPeer::LEGAL_STATUS => 5, ActorPeer::FUNCTIONS => 6, ActorPeer::MANDATES => 7, ActorPeer::INTERNAL_STRUCTURES => 8, ActorPeer::GENERAL_CONTEXT => 9, ActorPeer::AUTHORITY_RECORD_IDENTIFIER => 10, ActorPeer::INSTITUTION_IDENTIFIER => 11, ActorPeer::RULES => 12, ActorPeer::STATUS_ID => 13, ActorPeer::LEVEL_OF_DETAIL_ID => 14, ActorPeer::SOURCES => 15, ActorPeer::TREE_ID => 16, ActorPeer::TREE_LEFT_ID => 17, ActorPeer::TREE_RIGHT_ID => 18, ActorPeer::TREE_PARENT_ID => 19, ActorPeer::CREATED_AT => 20, ActorPeer::UPDATED_AT => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'authorized_form_of_name' => 1, 'type_of_entity_id' => 2, 'identifiers' => 3, 'history' => 4, 'legal_status' => 5, 'functions' => 6, 'mandates' => 7, 'internal_structures' => 8, 'general_context' => 9, 'authority_record_identifier' => 10, 'institution_identifier' => 11, 'rules' => 12, 'status_id' => 13, 'level_of_detail_id' => 14, 'sources' => 15, 'tree_id' => 16, 'tree_left_id' => 17, 'tree_right_id' => 18, 'tree_parent_id' => 19, 'created_at' => 20, 'updated_at' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ActorMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ActorMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ActorPeer::getTableMap();
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
		return str_replace(ActorPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ActorPeer::ID);

		$criteria->addSelectColumn(ActorPeer::AUTHORIZED_FORM_OF_NAME);

		$criteria->addSelectColumn(ActorPeer::TYPE_OF_ENTITY_ID);

		$criteria->addSelectColumn(ActorPeer::IDENTIFIERS);

		$criteria->addSelectColumn(ActorPeer::HISTORY);

		$criteria->addSelectColumn(ActorPeer::LEGAL_STATUS);

		$criteria->addSelectColumn(ActorPeer::FUNCTIONS);

		$criteria->addSelectColumn(ActorPeer::MANDATES);

		$criteria->addSelectColumn(ActorPeer::INTERNAL_STRUCTURES);

		$criteria->addSelectColumn(ActorPeer::GENERAL_CONTEXT);

		$criteria->addSelectColumn(ActorPeer::AUTHORITY_RECORD_IDENTIFIER);

		$criteria->addSelectColumn(ActorPeer::INSTITUTION_IDENTIFIER);

		$criteria->addSelectColumn(ActorPeer::RULES);

		$criteria->addSelectColumn(ActorPeer::STATUS_ID);

		$criteria->addSelectColumn(ActorPeer::LEVEL_OF_DETAIL_ID);

		$criteria->addSelectColumn(ActorPeer::SOURCES);

		$criteria->addSelectColumn(ActorPeer::TREE_ID);

		$criteria->addSelectColumn(ActorPeer::TREE_LEFT_ID);

		$criteria->addSelectColumn(ActorPeer::TREE_RIGHT_ID);

		$criteria->addSelectColumn(ActorPeer::TREE_PARENT_ID);

		$criteria->addSelectColumn(ActorPeer::CREATED_AT);

		$criteria->addSelectColumn(ActorPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(actor.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT actor.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ActorPeer::doSelectRS($criteria, $con);
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
		$objects = ActorPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ActorPeer::populateObjects(ActorPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseActorPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ActorPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ActorPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinTermRelatedByTypeOfEntityId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorPeer::TYPE_OF_ENTITY_ID, TermPeer::ID);

		$rs = ActorPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorPeer::STATUS_ID, TermPeer::ID);

		$rs = ActorPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);

		$rs = ActorPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinTermRelatedByTypeOfEntityId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorPeer::addSelectColumns($c);
		$startcol = (ActorPeer::NUM_COLUMNS - ActorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(ActorPeer::TYPE_OF_ENTITY_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByTypeOfEntityId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addActorRelatedByTypeOfEntityId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorsRelatedByTypeOfEntityId();
				$obj2->addActorRelatedByTypeOfEntityId($obj1); 			}
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

		ActorPeer::addSelectColumns($c);
		$startcol = (ActorPeer::NUM_COLUMNS - ActorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(ActorPeer::STATUS_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorPeer::getOMClass();

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
										$temp_obj2->addActorRelatedByStatusId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorsRelatedByStatusId();
				$obj2->addActorRelatedByStatusId($obj1); 			}
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

		ActorPeer::addSelectColumns($c);
		$startcol = (ActorPeer::NUM_COLUMNS - ActorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(ActorPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorPeer::getOMClass();

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
										$temp_obj2->addActorRelatedByLevelOfDetailId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initActorsRelatedByLevelOfDetailId();
				$obj2->addActorRelatedByLevelOfDetailId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ActorPeer::TYPE_OF_ENTITY_ID, TermPeer::ID);

		$criteria->addJoin(ActorPeer::STATUS_ID, TermPeer::ID);

		$criteria->addJoin(ActorPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);

		$rs = ActorPeer::doSelectRS($criteria, $con);
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

		ActorPeer::addSelectColumns($c);
		$startcol2 = (ActorPeer::NUM_COLUMNS - ActorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ActorPeer::TYPE_OF_ENTITY_ID, TermPeer::ID);

		$c->addJoin(ActorPeer::STATUS_ID, TermPeer::ID);

		$c->addJoin(ActorPeer::LEVEL_OF_DETAIL_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorPeer::getOMClass();


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
				$temp_obj2 = $temp_obj1->getTermRelatedByTypeOfEntityId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addActorRelatedByTypeOfEntityId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initActorsRelatedByTypeOfEntityId();
				$obj2->addActorRelatedByTypeOfEntityId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByStatusId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addActorRelatedByStatusId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initActorsRelatedByStatusId();
				$obj3->addActorRelatedByStatusId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTermRelatedByLevelOfDetailId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addActorRelatedByLevelOfDetailId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initActorsRelatedByLevelOfDetailId();
				$obj4->addActorRelatedByLevelOfDetailId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptTermRelatedByTypeOfEntityId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ActorPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ActorPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ActorPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ActorPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ActorPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptTermRelatedByTypeOfEntityId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ActorPeer::addSelectColumns($c);
		$startcol2 = (ActorPeer::NUM_COLUMNS - ActorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorPeer::getOMClass();

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

		ActorPeer::addSelectColumns($c);
		$startcol2 = (ActorPeer::NUM_COLUMNS - ActorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

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

		ActorPeer::addSelectColumns($c);
		$startcol2 = (ActorPeer::NUM_COLUMNS - ActorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ActorPeer::getOMClass();

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
		return ActorPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseActorPeer', $values, $con);
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

		$criteria->remove(ActorPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseActorPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseActorPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseActorPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseActorPeer', $values, $con);
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
			$comparison = $criteria->getComparison(ActorPeer::ID);
			$selectCriteria->add(ActorPeer::ID, $criteria->remove(ActorPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseActorPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseActorPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ActorPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ActorPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Actor) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ActorPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Actor $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ActorPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ActorPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ActorPeer::DATABASE_NAME, ActorPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ActorPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ActorPeer::DATABASE_NAME);

		$criteria->add(ActorPeer::ID, $pk);


		$v = ActorPeer::doSelect($criteria, $con);

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
			$criteria->add(ActorPeer::ID, $pks, Criteria::IN);
			$objs = ActorPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseActorPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ActorMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ActorMapBuilder');
}
