<?php



class StatusMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.StatusMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitStatus::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitStatus::TABLE_NAME);
		$tMap->setPhpName('status');
		$tMap->setClassname('QubitStatus');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('STATUS_ID', 'statusId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 