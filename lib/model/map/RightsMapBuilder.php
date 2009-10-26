<?php



class RightsMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RightsMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRights::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRights::TABLE_NAME);
		$tMap->setPhpName('rights');
		$tMap->setClassname('QubitRights');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', true, null);

		$tMap->addForeignKey('PERMISSION_ID', 'permissionId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 