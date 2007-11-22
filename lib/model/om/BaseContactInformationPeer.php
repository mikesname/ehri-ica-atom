<?php


abstract class BaseContactInformationPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'contact_information';

	
	const CLASS_DEFAULT = 'lib.model.ContactInformation';

	
	const NUM_COLUMNS = 18;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'contact_information.ID';

	
	const ACTOR_ID = 'contact_information.ACTOR_ID';

	
	const CONTACT_TYPE = 'contact_information.CONTACT_TYPE';

	
	const PRIMARY_CONTACT = 'contact_information.PRIMARY_CONTACT';

	
	const STREET_ADDRESS = 'contact_information.STREET_ADDRESS';

	
	const CITY = 'contact_information.CITY';

	
	const REGION = 'contact_information.REGION';

	
	const POSTAL_CODE = 'contact_information.POSTAL_CODE';

	
	const COUNTRY_ID = 'contact_information.COUNTRY_ID';

	
	const LONGTITUDE = 'contact_information.LONGTITUDE';

	
	const LATITUDE = 'contact_information.LATITUDE';

	
	const TELEPHONE = 'contact_information.TELEPHONE';

	
	const FAX = 'contact_information.FAX';

	
	const WEBSITE = 'contact_information.WEBSITE';

	
	const EMAIL = 'contact_information.EMAIL';

	
	const NOTE = 'contact_information.NOTE';

	
	const CREATED_AT = 'contact_information.CREATED_AT';

	
	const UPDATED_AT = 'contact_information.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'ActorId', 'ContactType', 'PrimaryContact', 'StreetAddress', 'City', 'Region', 'PostalCode', 'CountryId', 'Longtitude', 'Latitude', 'Telephone', 'Fax', 'Website', 'Email', 'Note', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (ContactInformationPeer::ID, ContactInformationPeer::ACTOR_ID, ContactInformationPeer::CONTACT_TYPE, ContactInformationPeer::PRIMARY_CONTACT, ContactInformationPeer::STREET_ADDRESS, ContactInformationPeer::CITY, ContactInformationPeer::REGION, ContactInformationPeer::POSTAL_CODE, ContactInformationPeer::COUNTRY_ID, ContactInformationPeer::LONGTITUDE, ContactInformationPeer::LATITUDE, ContactInformationPeer::TELEPHONE, ContactInformationPeer::FAX, ContactInformationPeer::WEBSITE, ContactInformationPeer::EMAIL, ContactInformationPeer::NOTE, ContactInformationPeer::CREATED_AT, ContactInformationPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'actor_id', 'contact_type', 'primary_contact', 'street_address', 'city', 'region', 'postal_code', 'country_id', 'longtitude', 'latitude', 'telephone', 'fax', 'website', 'email', 'note', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'ActorId' => 1, 'ContactType' => 2, 'PrimaryContact' => 3, 'StreetAddress' => 4, 'City' => 5, 'Region' => 6, 'PostalCode' => 7, 'CountryId' => 8, 'Longtitude' => 9, 'Latitude' => 10, 'Telephone' => 11, 'Fax' => 12, 'Website' => 13, 'Email' => 14, 'Note' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ),
		BasePeer::TYPE_COLNAME => array (ContactInformationPeer::ID => 0, ContactInformationPeer::ACTOR_ID => 1, ContactInformationPeer::CONTACT_TYPE => 2, ContactInformationPeer::PRIMARY_CONTACT => 3, ContactInformationPeer::STREET_ADDRESS => 4, ContactInformationPeer::CITY => 5, ContactInformationPeer::REGION => 6, ContactInformationPeer::POSTAL_CODE => 7, ContactInformationPeer::COUNTRY_ID => 8, ContactInformationPeer::LONGTITUDE => 9, ContactInformationPeer::LATITUDE => 10, ContactInformationPeer::TELEPHONE => 11, ContactInformationPeer::FAX => 12, ContactInformationPeer::WEBSITE => 13, ContactInformationPeer::EMAIL => 14, ContactInformationPeer::NOTE => 15, ContactInformationPeer::CREATED_AT => 16, ContactInformationPeer::UPDATED_AT => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'actor_id' => 1, 'contact_type' => 2, 'primary_contact' => 3, 'street_address' => 4, 'city' => 5, 'region' => 6, 'postal_code' => 7, 'country_id' => 8, 'longtitude' => 9, 'latitude' => 10, 'telephone' => 11, 'fax' => 12, 'website' => 13, 'email' => 14, 'note' => 15, 'created_at' => 16, 'updated_at' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ContactInformationMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ContactInformationMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ContactInformationPeer::getTableMap();
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
		return str_replace(ContactInformationPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ContactInformationPeer::ID);

		$criteria->addSelectColumn(ContactInformationPeer::ACTOR_ID);

		$criteria->addSelectColumn(ContactInformationPeer::CONTACT_TYPE);

		$criteria->addSelectColumn(ContactInformationPeer::PRIMARY_CONTACT);

		$criteria->addSelectColumn(ContactInformationPeer::STREET_ADDRESS);

		$criteria->addSelectColumn(ContactInformationPeer::CITY);

		$criteria->addSelectColumn(ContactInformationPeer::REGION);

		$criteria->addSelectColumn(ContactInformationPeer::POSTAL_CODE);

		$criteria->addSelectColumn(ContactInformationPeer::COUNTRY_ID);

		$criteria->addSelectColumn(ContactInformationPeer::LONGTITUDE);

		$criteria->addSelectColumn(ContactInformationPeer::LATITUDE);

		$criteria->addSelectColumn(ContactInformationPeer::TELEPHONE);

		$criteria->addSelectColumn(ContactInformationPeer::FAX);

		$criteria->addSelectColumn(ContactInformationPeer::WEBSITE);

		$criteria->addSelectColumn(ContactInformationPeer::EMAIL);

		$criteria->addSelectColumn(ContactInformationPeer::NOTE);

		$criteria->addSelectColumn(ContactInformationPeer::CREATED_AT);

		$criteria->addSelectColumn(ContactInformationPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(contact_information.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT contact_information.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ContactInformationPeer::doSelectRS($criteria, $con);
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
		$objects = ContactInformationPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ContactInformationPeer::populateObjects(ContactInformationPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformationPeer:doSelectRS:doSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseContactInformationPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ContactInformationPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ContactInformationPeer::getOMClass();
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
			$criteria->addSelectColumn(ContactInformationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContactInformationPeer::ACTOR_ID, ActorPeer::ID);

		$rs = ContactInformationPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ContactInformationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContactInformationPeer::COUNTRY_ID, TermPeer::ID);

		$rs = ContactInformationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinActor(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformationPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseContactInformationPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactInformationPeer::addSelectColumns($c);
		$startcol = (ContactInformationPeer::NUM_COLUMNS - ContactInformationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ActorPeer::addSelectColumns($c);

		$c->addJoin(ContactInformationPeer::ACTOR_ID, ActorPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContactInformationPeer::getOMClass();

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
										$temp_obj2->addContactInformation($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initContactInformations();
				$obj2->addContactInformation($obj1); 			}
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

		ContactInformationPeer::addSelectColumns($c);
		$startcol = (ContactInformationPeer::NUM_COLUMNS - ContactInformationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TermPeer::addSelectColumns($c);

		$c->addJoin(ContactInformationPeer::COUNTRY_ID, TermPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContactInformationPeer::getOMClass();

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
										$temp_obj2->addContactInformation($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initContactInformations();
				$obj2->addContactInformation($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContactInformationPeer::ACTOR_ID, ActorPeer::ID);

		$criteria->addJoin(ContactInformationPeer::COUNTRY_ID, TermPeer::ID);

		$rs = ContactInformationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformationPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseContactInformationPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactInformationPeer::addSelectColumns($c);
		$startcol2 = (ContactInformationPeer::NUM_COLUMNS - ContactInformationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		TermPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ContactInformationPeer::ACTOR_ID, ActorPeer::ID);

		$c->addJoin(ContactInformationPeer::COUNTRY_ID, TermPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContactInformationPeer::getOMClass();


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
					$temp_obj2->addContactInformation($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initContactInformations();
				$obj2->addContactInformation($obj1);
			}


					
			$omClass = TermPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTerm(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addContactInformation($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initContactInformations();
				$obj3->addContactInformation($obj1);
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
			$criteria->addSelectColumn(ContactInformationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContactInformationPeer::COUNTRY_ID, TermPeer::ID);

		$rs = ContactInformationPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(ContactInformationPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactInformationPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContactInformationPeer::ACTOR_ID, ActorPeer::ID);

		$rs = ContactInformationPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptActor(Criteria $c, $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformationPeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseContactInformationPeer', $c, $con);
    }


		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactInformationPeer::addSelectColumns($c);
		$startcol2 = (ContactInformationPeer::NUM_COLUMNS - ContactInformationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TermPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TermPeer::NUM_COLUMNS;

		$c->addJoin(ContactInformationPeer::COUNTRY_ID, TermPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContactInformationPeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getTerm(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addContactInformation($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initContactInformations();
				$obj2->addContactInformation($obj1);
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

		ContactInformationPeer::addSelectColumns($c);
		$startcol2 = (ContactInformationPeer::NUM_COLUMNS - ContactInformationPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ActorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ActorPeer::NUM_COLUMNS;

		$c->addJoin(ContactInformationPeer::ACTOR_ID, ActorPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContactInformationPeer::getOMClass();

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
					$temp_obj2->addContactInformation($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initContactInformations();
				$obj2->addContactInformation($obj1);
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
		return ContactInformationPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformationPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseContactInformationPeer', $values, $con);
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

		$criteria->remove(ContactInformationPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseContactInformationPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseContactInformationPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactInformationPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseContactInformationPeer', $values, $con);
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
			$comparison = $criteria->getComparison(ContactInformationPeer::ID);
			$selectCriteria->add(ContactInformationPeer::ID, $criteria->remove(ContactInformationPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseContactInformationPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseContactInformationPeer', $values, $con, $ret);
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
			$affectedRows += BasePeer::doDeleteAll(ContactInformationPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ContactInformationPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ContactInformation) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ContactInformationPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(ContactInformation $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ContactInformationPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ContactInformationPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ContactInformationPeer::DATABASE_NAME, ContactInformationPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ContactInformationPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(ContactInformationPeer::DATABASE_NAME);

		$criteria->add(ContactInformationPeer::ID, $pk);


		$v = ContactInformationPeer::doSelect($criteria, $con);

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
			$criteria->add(ContactInformationPeer::ID, $pks, Criteria::IN);
			$objs = ContactInformationPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseContactInformationPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ContactInformationMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ContactInformationMapBuilder');
}
