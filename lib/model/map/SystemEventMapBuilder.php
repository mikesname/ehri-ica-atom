<?php



class SystemEventMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitSystemEvent::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitSystemEvent::TABLE_NAME);
		$tMap->setPhpName('systemEvent');
		$tMap->setClassname('QubitSystemEvent');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('OBJECT_CLASS', 'objectClass', 'VARCHAR', false, 255);

		$tMap->addColumn('OBJECT_ID', 'objectId', 'INTEGER', false, null);

		$tMap->addColumn('PRE_EVENT_SNAPSHOT', 'preEventSnapshot', 'LONGVARCHAR', false, null);

		$tMap->addColumn('POST_EVENT_SNAPSHOT', 'postEventSnapshot', 'LONGVARCHAR', false, null);

		$tMap->addColumn('DATE', 'date', 'TIMESTAMP', false, null);

		$tMap->addForeignKey('USER_ID', 'userId', 'INTEGER', 'q_user', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 