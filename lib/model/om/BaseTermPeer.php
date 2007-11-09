<?php


abstract class BaseTermPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'term';

	
	const CLASS_DEFAULT = 'lib.model.Term';

	
	const NUM_COLUMNS = 16;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'term.ID';

	
	const TAXONOMY_ID = 'term.TAXONOMY_ID';

	
	const TERM_NAME = 'term.TERM_NAME';

	
	const SCOPE_NOTE = 'term.SCOPE_NOTE';

	
	const CODE_ALPHA = 'term.CODE_ALPHA';

	
	const CODE_ALPHA2 = 'term.CODE_ALPHA2';

	
	const CODE_NUMERIC = 'term.CODE_NUMERIC';

	
	const SORT_ORDER = 'term.SORT_ORDER';

	
	const SOURCE = 'term.SOURCE';

	
	const LOCKED = 'term.LOCKED';

	
	const TREE_ID = 'term.TREE_ID';

	
	const TREE_LEFT_ID = 'term.TREE_LEFT_ID';

	
	const TREE_RIGHT_ID = 'term.TREE_RIGHT_ID';

	
	const TREE_PARENT_ID = 'term.TREE_PARENT_ID';

	
	const CREATED_AT = 'term.CREATED_AT';

	
	const UPDATED_AT = 'term.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'TaxonomyId', 'TermName', 'ScopeNote', 'CodeAlpha', 'CodeAlpha2', 'CodeNumeric', 'SortOrder', 'Source', 'Locked', 'TreeId', 'TreeLeftId', 'TreeRightId', 'TreeParentId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (TermPeer::ID, TermPeer::TAXONOMY_ID, TermPeer::TERM_NAME, TermPeer::SCOPE_NOTE, TermPeer::CODE_ALPHA, TermPeer::CODE_ALPHA2, TermPeer::CODE_NUMERIC, TermPeer::SORT_ORDER, TermPeer::SOURCE, TermPeer::LOCKED, TermPeer::TREE_ID, TermPeer::TREE_LEFT_ID, TermPeer::TREE_RIGHT_ID, TermPeer::TREE_PARENT_ID, TermPeer::CREATED_AT, TermPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'taxonomy_id', 'term_name', 'scope_note', 'code_alpha', 'code_alpha2', 'code_numeric', 'sort_order', 'source', 'locked', 'tree_id', 'tree_left_id', 'tree_right_id', 'tree_parent_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'TaxonomyId' => 1, 'TermName' => 2, 'ScopeNote' => 3, 'CodeAlpha' => 4, 'CodeAlpha2' => 5, 'CodeNumeric' => 6, 'SortOrder' => 7, 'Source' => 8, 'Locked' => 9, 'TreeId' => 10, 'TreeLeftId' => 11, 'TreeRightId' => 12, 'TreeParentId' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
		BasePeer::TYPE_COLNAME => array (TermPeer::ID => 0, TermPeer::TAXONOMY_ID => 1, TermPeer::TERM_NAME => 2, TermPeer::SCOPE_NOTE => 3, TermPeer::CODE_ALPHA => 4, TermPeer::CODE_ALPHA2 => 5, TermPeer::CODE_NUMERIC => 6, TermPeer::SORT_ORDER => 7, TermPeer::SOURCE => 8, TermPeer::LOCKED => 9, TermPeer::TREE_ID => 10, TermPeer::TREE_LEFT_ID => 11, TermPeer::TREE_RIGHT_ID => 12, TermPeer::TREE_PARENT_ID => 13, TermPeer::CREATED_AT => 14, TermPeer::UPDATED_AT => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'taxonomy_id' => 1, 'term_name' => 2, 'scope_note' => 3, 'code_alpha' => 4, 'code_alpha2' => 5, 'code_numeric' => 6, 'sort_order' => 7, 'source' => 8, 'locked' => 9, 'tree_id' => 10, 'tree_left_id' => 11, 'tree_right_id' => 12, 'tree_parent_id' => 13, 'created_at' => 14, 'updated_at' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/TermMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.TermMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = TermPeer::getTableMap();
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
		return str_replace(TermPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TermPeer::ID);

		$criteria->addSelectColumn(TermPeer::TAXONOMY_ID);

		$criteria->addSelectColumn(TermPeer::TERM_NAME);

		$criteria->addSelectColumn(TermPeer::SCOPE_NOTE);

		$criteria->addSelectColumn(TermPeer::CODE_ALPHA);

		$criteria->addSelectColumn(TermPeer::CODE_ALPHA2);

		$criteria->addSelectColumn(TermPeer::CODE_NUMERIC);

		$criteria->addSelectColumn(TermPeer::SORT_ORDER);

		$criteria->addSelectColumn(TermPeer::SOURCE);

		$criteria->addSelectColumn(TermPeer::LOCKED);

		$criteria->addSelectColumn(TermPeer::TREE_ID);

		$criteria->addSelectColumn(TermPeer::TREE_LEFT_ID);

		$criteria->addSelectColumn(TermPeer::TREE_RIGHT_ID);

		$criteria->addSelectColumn(TermPeer::TREE_PARENT_ID);

		$criteria->addSelectColumn(TermPeer::CREATED_AT);

		$criteria->addSelectColumn(TermPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(term.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT term.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TermPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TermPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TermPeer::doSelectRS($criteria, $con);
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
		$objects = TermPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return TermPeer::populateObjects(TermPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTermPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseTermPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			TermPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = TermPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinTaxonomy(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TermPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TermPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TermPeer::TAXONOMY_ID, TaxonomyPeer::ID);

		$rs = TermPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinTaxonomy(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TermPeer::addSelectColumns($c);
		$startcol = (TermPeer::NUM_COLUMNS - TermPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TaxonomyPeer::addSelectColumns($c);

		$c->addJoin(TermPeer::TAXONOMY_ID, TaxonomyPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TermPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TaxonomyPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTaxonomy(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addTerm($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initTerms();
				$obj2->addTerm($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TermPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TermPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TermPeer::TAXONOMY_ID, TaxonomyPeer::ID);

		$rs = TermPeer::doSelectRS($criteria, $con);
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

		TermPeer::addSelectColumns($c);
		$startcol2 = (TermPeer::NUM_COLUMNS - TermPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TaxonomyPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TaxonomyPeer::NUM_COLUMNS;

		$c->addJoin(TermPeer::TAXONOMY_ID, TaxonomyPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = TaxonomyPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTaxonomy(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTerm($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initTerms();
				$obj2->addTerm($obj1);
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
		return TermPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTermPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTermPeer', $values, $con);
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

		$criteria->remove(TermPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseTermPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTermPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseTermPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTermPeer', $values, $con);
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
			$comparison = $criteria->getComparison(TermPeer::ID);
			$selectCriteria->add(TermPeer::ID, $criteria->remove(TermPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTermPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTermPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(TermPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Term) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TermPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Term $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TermPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TermPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TermPeer::DATABASE_NAME, TermPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TermPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(TermPeer::DATABASE_NAME);

		$criteria->add(TermPeer::ID, $pk);


		$v = TermPeer::doSelect($criteria, $con);

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
			$criteria->add(TermPeer::ID, $pks, Criteria::IN);
			$objs = TermPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseTermPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/TermMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.TermMapBuilder');
}
