<?php


abstract class BaseNotePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'note';

	
	const CLASS_DEFAULT = 'lib.model.Note';

	
	const NUM_COLUMNS = 10;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'note.ID';

	
	const INFORMATION_OBJECT_ID = 'note.INFORMATION_OBJECT_ID';

	
	const ACTOR_ID = 'note.ACTOR_ID';

	
	const REPOSITORY_ID = 'note.REPOSITORY_ID';

	
	const FUNCTION_DESCRIPTION_ID = 'note.FUNCTION_DESCRIPTION_ID';

	
	const NOTE = 'note.NOTE';

	
	const NOTE_TYPE_ID = 'note.NOTE_TYPE_ID';

	
	const USER_ID = 'note.USER_ID';

	
	const CREATED_AT = 'note.CREATED_AT';

	
	const UPDATED_AT = 'note.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'InformationObjectId', 'ActorId', 'RepositoryId', 'FunctionDescriptionId', 'Note', 'NoteTypeId', 'UserId', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (NotePeer::ID, NotePeer::INFORMATION_OBJECT_ID, NotePeer::ACTOR_ID, NotePeer::REPOSITORY_ID, NotePeer::FUNCTION_DESCRIPTION_ID, NotePeer::NOTE, NotePeer::NOTE_TYPE_ID, NotePeer::USER_ID, NotePeer::CREATED_AT, NotePeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'information_object_id', 'actor_id', 'repository_id', 'function_description_id', 'note', 'note_type_id', 'user_id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'InformationObjectId' => 1, 'ActorId' => 2, 'RepositoryId' => 3, 'FunctionDescriptionId' => 4, 'Note' => 5, 'NoteTypeId' => 6, 'UserId' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ),
		BasePeer::TYPE_COLNAME => array (NotePeer::ID => 0, NotePeer::INFORMATION_OBJECT_ID => 1, NotePeer::ACTOR_ID => 2, NotePeer::REPOSITORY_ID => 3, NotePeer::FUNCTION_DESCRIPTION_ID => 4, NotePeer::NOTE => 5, NotePeer::NOTE_TYPE_ID => 6, NotePeer::USER_ID => 7, NotePeer::CREATED_AT => 8, NotePeer::UPDATED_AT => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'information_object_id' => 1, 'actor_id' => 2, 'repository_id' => 3, 'function_description_id' => 4, 'note' => 5, 'note_type_id' => 6, 'user_id' => 7, 'created_at' => 8, 'updated_at' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/NoteMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.NoteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = NotePeer::getTableMap();
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
		return str_replace(NotePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(NotePeer::ID);

		$criteria->addSelectColumn(NotePeer::INFORMATION_OBJECT_ID);

		$criteria->addSelectColumn(NotePeer::ACTOR_ID);

		$criteria->addSelectColumn(NotePeer::REPOSITORY_ID);

		$criteria->addSelectColumn(NotePeer::FUNCTION_DESCRIPTION_ID);

		$criteria->addSelectColumn(NotePeer::NOTE);

		$criteria->addSelectColumn(NotePeer::NOTE_TYPE_ID);

		$criteria->addSelectColumn(NotePeer::USER_ID);

		$criteria->addSelectColumn(NotePeer::CREATED_AT);

		$criteria->addSelectColumn(NotePeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(note.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT note.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = NotePeer::doSelectRS($criteria, $con);
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
		$objects = NotePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return NotePeer::populateObjects(NotePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseNotePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			NotePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = NotePeer::getOMClass();
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinfunctionDescription(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinTerm(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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

		NotePeer::addSelectColumns($c);
		$startcol = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		informationObjectPeer::addSelectColumns($c);

		$c->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
										$temp_obj2->addNote($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1); 			}
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

		NotePeer::addSelectColumns($c);
		$startcol = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
										$temp_obj2->addNote($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1); 			}
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

		NotePeer::addSelectColumns($c);
		$startcol = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		RepositoryPeer::addSelectColumns($c);

		$c->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
										$temp_obj2->addNote($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinfunctionDescription(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotePeer::addSelectColumns($c);
		$startcol = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		functionDescriptionPeer::addSelectColumns($c);

		$c->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = functionDescriptionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getfunctionDescription(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addNote($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinTerm(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotePeer::addSelectColumns($c);
		$startcol = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
										$temp_obj2->addNote($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1); 			}
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

		NotePeer::addSelectColumns($c);
		$startcol = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UserPeer::addSelectColumns($c);

		$c->addJoin(NotePeer::USER_ID, UserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
										$temp_obj2->addNote($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$criteria->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$criteria->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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

		NotePeer::addSelectColumns($c);
		$startcol2 = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		RepositoryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RepositoryPeer::NUM_COLUMNS;

		functionDescriptionPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + functionDescriptionPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + TermPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + UserPeer::NUM_COLUMNS;

		$c->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$c->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$c->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();


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
					$temp_obj2->addNote($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1);
			}


					
			$omClass = ActorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getActor(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addNote($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initNotes();
				$obj3->addNote($obj1);
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
					$temp_obj4->addNote($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj4->initNotes();
				$obj4->addNote($obj1);
			}


					
			$omClass = functionDescriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getfunctionDescription(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addNote($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj5->initNotes();
				$obj5->addNote($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getTerm(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addNote($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj6->initNotes();
				$obj6->addNote($obj1);
			}


					
			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getUser(); 				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addNote($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj7->initNotes();
				$obj7->addNote($obj1);
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$criteria->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$criteria->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$criteria->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$criteria->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$criteria->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptfunctionDescription(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$criteria->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$criteria->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptTerm(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$criteria->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$criteria->addJoin(NotePeer::USER_ID, UserPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(NotePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(NotePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$criteria->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$criteria->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$criteria->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$rs = NotePeer::doSelectRS($criteria, $con);
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

		NotePeer::addSelectColumns($c);
		$startcol2 = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		RepositoryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RepositoryPeer::NUM_COLUMNS;

		functionDescriptionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + functionDescriptionPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$c->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$c->addJoin(NotePeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
					$temp_obj2->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1);
			}

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRepository(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotes();
				$obj3->addNote($obj1);
			}

			$omClass = functionDescriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getfunctionDescription(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initNotes();
				$obj4->addNote($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTerm(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initNotes();
				$obj5->addNote($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUser(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initNotes();
				$obj6->addNote($obj1);
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

		NotePeer::addSelectColumns($c);
		$startcol2 = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		RepositoryPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + RepositoryPeer::NUM_COLUMNS;

		functionDescriptionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + functionDescriptionPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$c->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$c->addJoin(NotePeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
					$temp_obj2->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1);
			}

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getRepository(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotes();
				$obj3->addNote($obj1);
			}

			$omClass = functionDescriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getfunctionDescription(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initNotes();
				$obj4->addNote($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTerm(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initNotes();
				$obj5->addNote($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUser(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initNotes();
				$obj6->addNote($obj1);
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

		NotePeer::addSelectColumns($c);
		$startcol2 = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		functionDescriptionPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + functionDescriptionPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$c->addJoin(NotePeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
					$temp_obj2->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1);
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
					$temp_obj3->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotes();
				$obj3->addNote($obj1);
			}

			$omClass = functionDescriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getfunctionDescription(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initNotes();
				$obj4->addNote($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTerm(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initNotes();
				$obj5->addNote($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUser(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initNotes();
				$obj6->addNote($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptfunctionDescription(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotePeer::addSelectColumns($c);
		$startcol2 = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		RepositoryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RepositoryPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + TermPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);

		$c->addJoin(NotePeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
					$temp_obj2->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1);
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
					$temp_obj3->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotes();
				$obj3->addNote($obj1);
			}

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getRepository(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initNotes();
				$obj4->addNote($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getTerm(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initNotes();
				$obj5->addNote($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUser(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initNotes();
				$obj6->addNote($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptTerm(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotePeer::addSelectColumns($c);
		$startcol2 = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		RepositoryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RepositoryPeer::NUM_COLUMNS;

		functionDescriptionPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + functionDescriptionPeer::NUM_COLUMNS;

		UserPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + UserPeer::NUM_COLUMNS;

		$c->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$c->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$c->addJoin(NotePeer::USER_ID, UserPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
					$temp_obj2->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1);
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
					$temp_obj3->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotes();
				$obj3->addNote($obj1);
			}

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getRepository(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initNotes();
				$obj4->addNote($obj1);
			}

			$omClass = functionDescriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getfunctionDescription(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initNotes();
				$obj5->addNote($obj1);
			}

			$omClass = UserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getUser(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initNotes();
				$obj6->addNote($obj1);
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

		NotePeer::addSelectColumns($c);
		$startcol2 = (NotePeer::NUM_COLUMNS - NotePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		informationObjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + informationObjectPeer::NUM_COLUMNS;

		ActorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ActorPeer::NUM_COLUMNS;

		RepositoryPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + RepositoryPeer::NUM_COLUMNS;

		functionDescriptionPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + functionDescriptionPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + TermPeer::NUM_COLUMNS;

		$c->addJoin(NotePeer::INFORMATION_OBJECT_ID, informationObjectPeer::ID);

		$c->addJoin(NotePeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(NotePeer::REPOSITORY_ID, RepositoryPeer::ID);

		$c->addJoin(NotePeer::FUNCTION_DESCRIPTION_ID, functionDescriptionPeer::ID);

		$c->addJoin(NotePeer::NOTE_TYPE_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = NotePeer::getOMClass();

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
					$temp_obj2->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initNotes();
				$obj2->addNote($obj1);
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
					$temp_obj3->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initNotes();
				$obj3->addNote($obj1);
			}

			$omClass = RepositoryPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getRepository(); 				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initNotes();
				$obj4->addNote($obj1);
			}

			$omClass = functionDescriptionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getfunctionDescription(); 				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initNotes();
				$obj5->addNote($obj1);
			}

			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getTerm(); 				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addNote($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initNotes();
				$obj6->addNote($obj1);
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
		return NotePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseNotePeer', $values, $con);
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

		$criteria->remove(NotePeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseNotePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseNotePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseNotePeer', $values, $con);
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
			$comparison = $criteria->getComparison(NotePeer::ID);
			$selectCriteria->add(NotePeer::ID, $criteria->remove(NotePeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseNotePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseNotePeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(NotePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(NotePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Note) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(NotePeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Note $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(NotePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(NotePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(NotePeer::DATABASE_NAME, NotePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = NotePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(NotePeer::DATABASE_NAME);

		$criteria->add(NotePeer::ID, $pk);


		$v = NotePeer::doSelect($criteria, $con);

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
			$criteria->add(NotePeer::ID, $pks, Criteria::IN);
			$objs = NotePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseNotePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/NoteMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.NoteMapBuilder');
}
