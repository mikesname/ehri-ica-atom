<?php


abstract class BaseDigitalObjectPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'digital_object';

	
	const CLASS_DEFAULT = 'lib.model.DigitalObject';

	
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
		BasePeer::TYPE_COLNAME => array (DigitalObjectPeer::ID, DigitalObjectPeer::INFORMATION_OBJECT_ID, DigitalObjectPeer::USEAGE_ID, DigitalObjectPeer::NAME, DigitalObjectPeer::DESCRIPTION, DigitalObjectPeer::MIME_TYPE_ID, DigitalObjectPeer::MEDIA_TYPE_ID, DigitalObjectPeer::SEQUENCE, DigitalObjectPeer::BYTE_SIZE, DigitalObjectPeer::CHECKSUM, DigitalObjectPeer::CHECKSUM_TYPE_ID, DigitalObjectPeer::LOCATION_ID, DigitalObjectPeer::TREE_ID, DigitalObjectPeer::TREE_LEFT_ID, DigitalObjectPeer::TREE_RIGHT_ID, DigitalObjectPeer::TREE_PARENT_ID, DigitalObjectPeer::CREATED_AT, DigitalObjectPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'information_object_id', 'useage_id', 'name', 'description', 'mime_type_id', 'media_type_id', 'sequence', 'byte_size', 'checksum', 'checksum_type_id', 'location_id', 'tree_id', 'tree_left_id', 'tree_right_id', 'tree_parent_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'InformationObjectId' => 1, 'UseageId' => 2, 'Name' => 3, 'Description' => 4, 'MimeTypeId' => 5, 'MediaTypeId' => 6, 'Sequence' => 7, 'ByteSize' => 8, 'Checksum' => 9, 'ChecksumTypeId' => 10, 'LocationId' => 11, 'TreeId' => 12, 'TreeLeftId' => 13, 'TreeRightId' => 14, 'TreeParentId' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ),
		BasePeer::TYPE_COLNAME => array (DigitalObjectPeer::ID => 0, DigitalObjectPeer::INFORMATION_OBJECT_ID => 1, DigitalObjectPeer::USEAGE_ID => 2, DigitalObjectPeer::NAME => 3, DigitalObjectPeer::DESCRIPTION => 4, DigitalObjectPeer::MIME_TYPE_ID => 5, DigitalObjectPeer::MEDIA_TYPE_ID => 6, DigitalObjectPeer::SEQUENCE => 7, DigitalObjectPeer::BYTE_SIZE => 8, DigitalObjectPeer::CHECKSUM => 9, DigitalObjectPeer::CHECKSUM_TYPE_ID => 10, DigitalObjectPeer::LOCATION_ID => 11, DigitalObjectPeer::TREE_ID => 12, DigitalObjectPeer::TREE_LEFT_ID => 13, DigitalObjectPeer::TREE_RIGHT_ID => 14, DigitalObjectPeer::TREE_PARENT_ID => 15, DigitalObjectPeer::CREATED_AT => 16, DigitalObjectPeer::UPDATED_AT => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'information_object_id' => 1, 'useage_id' => 2, 'name' => 3, 'description' => 4, 'mime_type_id' => 5, 'media_type_id' => 6, 'sequence' => 7, 'byte_size' => 8, 'checksum' => 9, 'checksum_type_id' => 10, 'location_id' => 11, 'tree_id' => 12, 'tree_left_id' => 13, 'tree_right_id' => 14, 'tree_parent_id' => 15, 'created_at' => 16, 'updated_at' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DigitalObjectMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DigitalObjectMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DigitalObjectPeer::getTableMap();
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
		return str_replace(DigitalObjectPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DigitalObjectPeer::ID);

		$criteria->addSelectColumn(DigitalObjectPeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::USEAGE_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::NAME);

		$criteria->addSelectColumn(DigitalObjectPeer::DESCRIPTION);

		$criteria->addSelectColumn(DigitalObjectPeer::MIME_TYPE_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::MEDIA_TYPE_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::SEQUENCE);

		$criteria->addSelectColumn(DigitalObjectPeer::BYTE_SIZE);

		$criteria->addSelectColumn(DigitalObjectPeer::CHECKSUM);

		$criteria->addSelectColumn(DigitalObjectPeer::CHECKSUM_TYPE_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::LOCATION_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::TREE_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::TREE_LEFT_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::TREE_RIGHT_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::TREE_PARENT_ID);

		$criteria->addSelectColumn(DigitalObjectPeer::CREATED_AT);

		$criteria->addSelectColumn(DigitalObjectPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(digital_object.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT digital_object.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
		$objects = DigitalObjectPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DigitalObjectPeer::populateObjects(DigitalObjectPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DigitalObjectPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DigitalObjectPeer::getOMClass();
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinInformationObject(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectPeer::addSelectColumns($c);
		$startcol = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InformationObjectPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
										$temp_obj2->addDigitalObject($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjects();
				$obj2->addDigitalObject($obj1); 			}
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectPeer::USEAGE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
										$temp_obj2->addDigitalObjectRelatedByUseageId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectsRelatedByUseageId();
				$obj2->addDigitalObjectRelatedByUseageId($obj1); 			}
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
										$temp_obj2->addDigitalObjectRelatedByMimeTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectsRelatedByMimeTypeId();
				$obj2->addDigitalObjectRelatedByMimeTypeId($obj1); 			}
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
										$temp_obj2->addDigitalObjectRelatedByMediaTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectsRelatedByMediaTypeId();
				$obj2->addDigitalObjectRelatedByMediaTypeId($obj1); 			}
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
										$temp_obj2->addDigitalObjectRelatedByChecksumTypeId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectsRelatedByChecksumTypeId();
				$obj2->addDigitalObjectRelatedByChecksumTypeId($obj1); 			}
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectPeer::LOCATION_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
										$temp_obj2->addDigitalObjectRelatedByLocationId($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectsRelatedByLocationId();
				$obj2->addDigitalObjectRelatedByLocationId($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

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

		$c->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$c->addJoin(DigitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();


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
					$temp_obj2->addDigitalObject($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjects();
				$obj2->addDigitalObject($obj1);
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
					$temp_obj3->addDigitalObjectRelatedByUseageId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initDigitalObjectsRelatedByUseageId();
				$obj3->addDigitalObjectRelatedByUseageId($obj1);
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
					$temp_obj4->addDigitalObjectRelatedByMimeTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initDigitalObjectsRelatedByMimeTypeId();
				$obj4->addDigitalObjectRelatedByMimeTypeId($obj1);
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
					$temp_obj5->addDigitalObjectRelatedByMediaTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initDigitalObjectsRelatedByMediaTypeId();
				$obj5->addDigitalObjectRelatedByMediaTypeId($obj1);
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
					$temp_obj6->addDigitalObjectRelatedByChecksumTypeId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initDigitalObjectsRelatedByChecksumTypeId();
				$obj6->addDigitalObjectRelatedByChecksumTypeId($obj1);
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
					$temp_obj7->addDigitalObjectRelatedByLocationId($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj7->initDigitalObjectsRelatedByLocationId();
				$obj7->addDigitalObjectRelatedByLocationId($obj1);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(DigitalObjectPeer::LOCATION_ID, TermPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);

		$rs = DigitalObjectPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptInformationObject(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

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

		$c->addJoin(DigitalObjectPeer::USEAGE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::MIME_TYPE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::MEDIA_TYPE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::CHECKSUM_TYPE_ID, TermPeer::ID);

		$c->addJoin(DigitalObjectPeer::LOCATION_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
					$temp_obj2->addDigitalObjectRelatedByUseageId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjectsRelatedByUseageId();
				$obj2->addDigitalObjectRelatedByUseageId($obj1);
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
					$temp_obj3->addDigitalObjectRelatedByMimeTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initDigitalObjectsRelatedByMimeTypeId();
				$obj3->addDigitalObjectRelatedByMimeTypeId($obj1);
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
					$temp_obj4->addDigitalObjectRelatedByMediaTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initDigitalObjectsRelatedByMediaTypeId();
				$obj4->addDigitalObjectRelatedByMediaTypeId($obj1);
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
					$temp_obj5->addDigitalObjectRelatedByChecksumTypeId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initDigitalObjectsRelatedByChecksumTypeId();
				$obj5->addDigitalObjectRelatedByChecksumTypeId($obj1);
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
					$temp_obj6->addDigitalObjectRelatedByLocationId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initDigitalObjectsRelatedByLocationId();
				$obj6->addDigitalObjectRelatedByLocationId($obj1);
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
					$temp_obj2->addDigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjects();
				$obj2->addDigitalObject($obj1);
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
					$temp_obj2->addDigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjects();
				$obj2->addDigitalObject($obj1);
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
					$temp_obj2->addDigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjects();
				$obj2->addDigitalObject($obj1);
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
					$temp_obj2->addDigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjects();
				$obj2->addDigitalObject($obj1);
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

		DigitalObjectPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectPeer::NUM_COLUMNS - DigitalObjectPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformationObjectPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectPeer::INFORMATION_OBJECT_ID, InformationObjectPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectPeer::getOMClass();

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
					$temp_obj2->addDigitalObject($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjects();
				$obj2->addDigitalObject($obj1);
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
		return DigitalObjectPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDigitalObjectPeer', $values, $con);
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

		$criteria->remove(DigitalObjectPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDigitalObjectPeer', $values, $con);
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
			$comparison = $criteria->getComparison(DigitalObjectPeer::ID);
			$selectCriteria->add(DigitalObjectPeer::ID, $criteria->remove(DigitalObjectPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDigitalObjectPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(DigitalObjectPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DigitalObjectPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DigitalObject) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DigitalObjectPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DigitalObject $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DigitalObjectPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DigitalObjectPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DigitalObjectPeer::DATABASE_NAME, DigitalObjectPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DigitalObjectPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DigitalObjectPeer::DATABASE_NAME);

		$criteria->add(DigitalObjectPeer::ID, $pk);


		$v = DigitalObjectPeer::doSelect($criteria, $con);

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
			$criteria->add(DigitalObjectPeer::ID, $pks, Criteria::IN);
			$objs = DigitalObjectPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDigitalObjectPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DigitalObjectMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DigitalObjectMapBuilder');
}
