<?php


abstract class BaseDigitalObjectMetadataPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'digital_object_metadata';

	
	const CLASS_DEFAULT = 'lib.model.DigitalObjectMetadata';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'digital_object_metadata.ID';

	
	const DIGITAL_OBJECT_ID = 'digital_object_metadata.DIGITAL_OBJECT_ID';

	
	const ELEMENT = 'digital_object_metadata.ELEMENT';

	
	const VALUE = 'digital_object_metadata.VALUE';

	
	const CREATED_AT = 'digital_object_metadata.CREATED_AT';

	
	const UPDATED_AT = 'digital_object_metadata.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'DigitalObjectId', 'Element', 'Value', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (DigitalObjectMetadataPeer::ID, DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, DigitalObjectMetadataPeer::ELEMENT, DigitalObjectMetadataPeer::VALUE, DigitalObjectMetadataPeer::CREATED_AT, DigitalObjectMetadataPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'digital_object_id', 'element', 'value', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'DigitalObjectId' => 1, 'Element' => 2, 'Value' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (DigitalObjectMetadataPeer::ID => 0, DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID => 1, DigitalObjectMetadataPeer::ELEMENT => 2, DigitalObjectMetadataPeer::VALUE => 3, DigitalObjectMetadataPeer::CREATED_AT => 4, DigitalObjectMetadataPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'digital_object_id' => 1, 'element' => 2, 'value' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/DigitalObjectMetadataMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.DigitalObjectMetadataMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = DigitalObjectMetadataPeer::getTableMap();
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
		return str_replace(DigitalObjectMetadataPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(DigitalObjectMetadataPeer::ID);

		$criteria->addSelectColumn(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID);

		$criteria->addSelectColumn(DigitalObjectMetadataPeer::ELEMENT);

		$criteria->addSelectColumn(DigitalObjectMetadataPeer::VALUE);

		$criteria->addSelectColumn(DigitalObjectMetadataPeer::CREATED_AT);

		$criteria->addSelectColumn(DigitalObjectMetadataPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(digital_object_metadata.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT digital_object_metadata.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectMetadataPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectMetadataPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = DigitalObjectMetadataPeer::doSelectRS($criteria, $con);
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
		$objects = DigitalObjectMetadataPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return DigitalObjectMetadataPeer::populateObjects(DigitalObjectMetadataPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadataPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectMetadataPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			DigitalObjectMetadataPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = DigitalObjectMetadataPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinDigitalObject(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectMetadataPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectMetadataPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$rs = DigitalObjectMetadataPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinDigitalObject(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadataPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectMetadataPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectMetadataPeer::addSelectColumns($c);
		$startcol = (DigitalObjectMetadataPeer::NUM_COLUMNS - DigitalObjectMetadataPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		DigitalObjectPeer::addSelectColumns($c);

		$c->addJoin(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectMetadataPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = DigitalObjectPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getDigitalObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addDigitalObjectMetadata($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initDigitalObjectMetadatas();
				$obj2->addDigitalObjectMetadata($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(DigitalObjectMetadataPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(DigitalObjectMetadataPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$rs = DigitalObjectMetadataPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadataPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectMetadataPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		DigitalObjectMetadataPeer::addSelectColumns($c);
		$startcol2 = (DigitalObjectMetadataPeer::NUM_COLUMNS - DigitalObjectMetadataPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		DigitalObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + DigitalObjectPeer::NUM_COLUMNS;

		$c->addJoin(DigitalObjectMetadataPeer::DIGITAL_OBJECT_ID, DigitalObjectPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = DigitalObjectMetadataPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = DigitalObjectPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getDigitalObject(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addDigitalObjectMetadata($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initDigitalObjectMetadatas();
				$obj2->addDigitalObjectMetadata($obj1);
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
		return DigitalObjectMetadataPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadataPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDigitalObjectMetadataPeer', $values, $con);
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

		$criteria->remove(DigitalObjectMetadataPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseDigitalObjectMetadataPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectMetadataPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadataPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseDigitalObjectMetadataPeer', $values, $con);
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
			$comparison = $criteria->getComparison(DigitalObjectMetadataPeer::ID);
			$selectCriteria->add(DigitalObjectMetadataPeer::ID, $criteria->remove(DigitalObjectMetadataPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseDigitalObjectMetadataPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseDigitalObjectMetadataPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(DigitalObjectMetadataPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(DigitalObjectMetadataPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof DigitalObjectMetadata) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(DigitalObjectMetadataPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(DigitalObjectMetadata $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(DigitalObjectMetadataPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(DigitalObjectMetadataPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(DigitalObjectMetadataPeer::DATABASE_NAME, DigitalObjectMetadataPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = DigitalObjectMetadataPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(DigitalObjectMetadataPeer::DATABASE_NAME);

		$criteria->add(DigitalObjectMetadataPeer::ID, $pk);


		$v = DigitalObjectMetadataPeer::doSelect($criteria, $con);

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
			$criteria->add(DigitalObjectMetadataPeer::ID, $pks, Criteria::IN);
			$objs = DigitalObjectMetadataPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseDigitalObjectMetadataPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/DigitalObjectMetadataMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.DigitalObjectMetadataMapBuilder');
}
