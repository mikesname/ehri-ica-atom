<?php


abstract class BasedigitalObjectPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'digital_object';

	
	const CLASS_DEFAULT = 'lib.model.digitalObject';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'digital_object.ID';

	
	const INFORMATION_OBJECT_ID = 'digital_object.INFORMATION_OBJECT_ID';

	
	const USEAGE_ID = 'digital_object.USEAGE_ID';

	
	const NAME = 'digital_object.NAME';

	
	const DESCRIPTION = 'digital_object.DESCRIPTION';

	
	const MIME_TYPE_ID = 'digital_object.MIME_TYPE_ID';

	
	const MEDIA_TYPE_ID = 'digital_object.MEDIA_TYPE_ID';

	
	const SEQUENCE = 'digital_object.SEQUENCE';

	
	const BYTE_SIZE = 'digital_object.BYTE_SIZE';

	
	const CHECKSUM = 'digital_object.CHECKSUM';

	
	const CHECKSUM_TYPE_ID = 'digital_object.CHECKSUM_TYPE_ID';

	
	const LOCATION_ID = 'digital_object.LOCATION_ID';

	
	const TREE_ID = 'digital_object.TREE_ID';

	
	const TREE_LEFT_ID = 'digital_object.TREE_LEFT_ID';

	
	const TREE_RIGHT_ID = 'digital_object.TREE_RIGHT_ID';

	
	const TREE_PARENT_ID = 'digital_object.TREE_PARENT_ID';

	
	const CREATED_AT = 'digital_object.CREATED_AT';

	
	const UPDATED_AT = 'digital_object.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'InformationObjectId', 'UseageId', 'Name', 'Description', 'MimeTypeId', 'MediaTypeId', 'Sequence', 'ByteSize', 'Checksum', 'ChecksumTypeId', 'LocationId', 'TreeId', 'TreeLeftId', 'TreeRightId', 'TreeParentId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (digitalObjectPeer::ID, digitalObjectPeer::INFORMATION_OBJECT_ID, digitalObjectPeer::USEAGE_ID, digitalObjectPeer::NAME, digitalObjectPeer::DESCRIPTION, digitalObjectPeer::MIME_TYPE_ID, digitalObjectPeer::MEDIA_TYPE_ID, digitalObjectPeer::SEQUENCE, digitalObjectPeer::BYTE_SIZE, digitalObjectPeer::CHECKSUM, digitalObjectPeer::CHECKSUM_TYPE_ID, digitalObjectPeer::LOCATION_ID, digitalObjectPeer::TREE_ID, digitalObjectPeer::TREE_LEFT_ID, digitalObjectPeer::TREE_RIGHT_ID, digitalObjectPeer::TREE_PARENT_ID, digitalObjectPeer::CREATED_AT, digitalObjectPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'information_object_id', 'useage_id', 'name', 'description', 'mime_type_id', 'media_type_id', 'sequence', 'byte_size', 'checksum', 'checksum_type_id', 'location_id', 'tree_id', 'tree_left_id', 'tree_right_id', 'tree_parent_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'InformationObjectId' => 1, 'UseageId' => 2, 'Name' => 3, 'Description' => 4, 'MimeTypeId' => 5, 'MediaTypeId' => 6, 'Sequence' => 7, 'ByteSize' => 8, 'Checksum' => 9, 'ChecksumTypeId' => 10, 'LocationId' => 11, 'TreeId' => 12, 'TreeLeftId' => 13, 'TreeRightId' => 14, 'TreeParentId' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ),
		BasePeer::TYPE_COLNAME => array (digitalObjectPeer::ID => 0, digitalObjectPeer::INFORMATION_OBJECT_ID => 1, digitalObjectPeer::USEAGE_ID => 2, digitalObjectPeer::NAME => 3, digitalObjectPeer::DESCRIPTION => 4, digitalObjectPeer::MIME_TYPE_ID => 5, digitalObjectPeer::MEDIA_TYPE_ID => 6, digitalObjectPeer::SEQUENCE => 7, digitalObjectPeer::BYTE_SIZE => 8, digitalObjectPeer::CHECKSUM => 9, digitalObjectPeer::CHECKSUM_TYPE_ID => 10, digitalObjectPeer::LOCATION_ID => 11, digitalObjectPeer::TREE_ID => 12, digitalObjectPeer::TREE_LEFT_ID => 13, digitalObjectPeer::TREE_RIGHT_ID => 14, digitalObjectPeer::TREE_PARENT_ID => 15, digitalObjectPeer::CREATED_AT => 16, digitalObjectPeer::UPDATED_AT => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'information_object_id' => 1, 'useage_id' => 2, 'name' => 3, 'description' => 4, 'mime_type_id' => 5, 'media_type_id' => 6, 'sequence' => 7, 'byte_size' => 8, 'checksum' => 9, 'checksum_type_id' => 10, 'location_id' => 11, 'tree_id' => 12, 'tree_left_id' => 13, 'tree_right_id' => 14, 'tree_parent_id' => 15, 'created_at' => 16, 'updated_at' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/digitalObjectMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.digitalObjectMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = digitalObjectPeer::getTableMap();
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
		return str_replace(digitalObjectPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(digitalObjectPeer::ID);

		$criteria->addSelectColumn(digitalObjectPeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(digitalObjectPeer::USEAGE_ID);

		$criteria->addSelectColumn(digitalObjectPeer::NAME);

		$criteria->addSelectColumn(digitalObjectPeer::DESCRIPTION);

		$criteria->addSelectColumn(digitalObjectPeer::MIME_TYPE_ID);

		$criteria->addSelectColumn(digitalObjectPeer::MEDIA_TYPE_ID);

		$criteria->addSelectColumn(digitalObjectPeer::SEQUENCE);

		$criteria->addSelectColumn(digitalObjectPeer::BYTE_SIZE);

		$criteria->addSelectColumn(digitalObjectPeer::CHECKSUM);

		$criteria->addSelectColumn(digitalObjectPeer::CHECKSUM_TYPE_ID);

		$criteria->addSelectColumn(digitalObjectPeer::LOCATION_ID);

		$criteria->addSelectColumn(digitalObjectPeer::TREE_ID);

		$criteria->addSelectColumn(digitalObjectPeer::TREE_LEFT_ID);

		$criteria->addSelectColumn(digitalObjectPeer::TREE_RIGHT_ID);

		$criteria->addSelectColumn(digitalObjectPeer::TREE_PARENT_ID);

		$criteria->addSelectColumn(digitalObjectPeer::CREATED_AT);

		$criteria->addSelectColumn(digitalObjectPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(digital_object.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT digital_object.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
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
		$objects = digitalObjectPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return digitalObjectPeer::populateObjects(digitalObjectPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasedigitalObjectPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			digitalObjectPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = digitalObjectPeer::getOMClass();
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
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByUseageId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByMimeTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByMediaTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByChecksumTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTermRelatedByLocationId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
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

		digitalObjectPeer::addSelectColumns($c);
		$startcol = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		informationObjectPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

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
										$temp_obj2->adddigitalObject($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjects();
				$obj2->adddigitalObject($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByUseageId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectPeer::USEAGE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByUseageId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->adddigitalObjectRelatedByUseageId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectsRelatedByUseageId();
				$obj2->adddigitalObjectRelatedByUseageId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByMimeTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByMimeTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->adddigitalObjectRelatedByMimeTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectsRelatedByMimeTypeId();
				$obj2->adddigitalObjectRelatedByMimeTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByMediaTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByMediaTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->adddigitalObjectRelatedByMediaTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectsRelatedByMediaTypeId();
				$obj2->adddigitalObjectRelatedByMediaTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByChecksumTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByChecksumTypeId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->adddigitalObjectRelatedByChecksumTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectsRelatedByChecksumTypeId();
				$obj2->adddigitalObjectRelatedByChecksumTypeId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTermRelatedByLocationId(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(digitalObjectPeer::LOCATION_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTermRelatedByLocationId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->adddigitalObjectRelatedByLocationId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initdigitalObjectsRelatedByLocationId();
				$obj2->adddigitalObjectRelatedByLocationId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(digitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
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

		digitalObjectPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + TermPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(digitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();


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
					$temp_obj2->adddigitalObject($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjects();
				$obj2->adddigitalObject($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByUseageId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->adddigitalObjectRelatedByUseageId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initdigitalObjectsRelatedByUseageId();
				$obj3->adddigitalObjectRelatedByUseageId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTermRelatedByMimeTypeId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->adddigitalObjectRelatedByMimeTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initdigitalObjectsRelatedByMimeTypeId();
				$obj4->adddigitalObjectRelatedByMimeTypeId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTermRelatedByMediaTypeId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->adddigitalObjectRelatedByMediaTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initdigitalObjectsRelatedByMediaTypeId();
				$obj5->adddigitalObjectRelatedByMediaTypeId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getTermRelatedByChecksumTypeId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->adddigitalObjectRelatedByChecksumTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initdigitalObjectsRelatedByChecksumTypeId();
				$obj6->adddigitalObjectRelatedByChecksumTypeId($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getTermRelatedByLocationId(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->adddigitalObjectRelatedByLocationId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj7->initdigitalObjectsRelatedByLocationId();
				$obj7->adddigitalObjectRelatedByLocationId($obj1);
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
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(digitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByUseageId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByMimeTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByMediaTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByChecksumTypeId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTermRelatedByLocationId(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(digitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = digitalObjectPeer::doSelectRS($criteria, $con);
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

		digitalObjectPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + TermPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$c->addJoin(digitalObjectPeer::LOCATION_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTermRelatedByUseageId(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->adddigitalObjectRelatedByUseageId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjectsRelatedByUseageId();
				$obj2->adddigitalObjectRelatedByUseageId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTermRelatedByMimeTypeId(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->adddigitalObjectRelatedByMimeTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initdigitalObjectsRelatedByMimeTypeId();
				$obj3->adddigitalObjectRelatedByMimeTypeId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTermRelatedByMediaTypeId(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->adddigitalObjectRelatedByMediaTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initdigitalObjectsRelatedByMediaTypeId();
				$obj4->adddigitalObjectRelatedByMediaTypeId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTermRelatedByChecksumTypeId(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->adddigitalObjectRelatedByChecksumTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initdigitalObjectsRelatedByChecksumTypeId();
				$obj5->adddigitalObjectRelatedByChecksumTypeId($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getTermRelatedByLocationId(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->adddigitalObjectRelatedByLocationId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initdigitalObjectsRelatedByLocationId();
				$obj6->adddigitalObjectRelatedByLocationId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByUseageId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

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
					$temp_obj2->adddigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjects();
				$obj2->adddigitalObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByMimeTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

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
					$temp_obj2->adddigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjects();
				$obj2->adddigitalObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByMediaTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

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
					$temp_obj2->adddigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjects();
				$obj2->adddigitalObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByChecksumTypeId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

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
					$temp_obj2->adddigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjects();
				$obj2->adddigitalObject($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTermRelatedByLocationId(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		digitalObjectPeer::addSelectColumns($c);
		$startcol2 = (digitalObjectPeer::NUM_COLUMNS - digitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		$c->addJoin(digitalObjectPeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = digitalObjectPeer::getOMClass();

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
					$temp_obj2->adddigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initdigitalObjects();
				$obj2->adddigitalObject($obj1);
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
		return digitalObjectPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasedigitalObjectPeer', $values, $con);
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

		$criteria->remove(digitalObjectPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BasedigitalObjectPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasedigitalObjectPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasedigitalObjectPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasedigitalObjectPeer', $values, $con);
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
			$comparison = $criteria->getComparison(digitalObjectPeer::ID);
			$selectCriteria->add(digitalObjectPeer::ID, $criteria->remove(digitalObjectPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasedigitalObjectPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasedigitalObjectPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(digitalObjectPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(digitalObjectPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof digitalObject) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(digitalObjectPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(digitalObject $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(digitalObjectPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(digitalObjectPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(digitalObjectPeer::DATABASE_NAME, digitalObjectPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = digitalObjectPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(digitalObjectPeer::DATABASE_NAME);

		$criteria->add(digitalObjectPeer::ID, $pk);


		$v = digitalObjectPeer::doSelect($criteria, $con);

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
			$criteria->add(digitalObjectPeer::ID, $pks, Criteria::IN);
			$objs = digitalObjectPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasedigitalObjectPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/digitalObjectMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.digitalObjectMapBuilder');
}
