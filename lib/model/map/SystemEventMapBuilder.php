<?php



class SystemEventMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SystemEventMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('system_event');
		$tMap->setPhpName('SystemEvent');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('SYSTEM_EVENT_TYPE_ID', 'SystemEventTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('OBJECT_CLASS', 'ObjectClass', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('OBJECT_ID', 'ObjectId', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PRE_EVENT_SNAPSHOT', 'PreEventSnapshot', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('POST_EVENT_SNAPSHOT', 'PostEventSnapshot', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DATE', 'Date', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('USER_NAME', 'UserName', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 