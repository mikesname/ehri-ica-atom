<?php



class OaiRepositoryMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.OaiRepositoryMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitOaiRepository::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitOaiRepository::TABLE_NAME);
		$tMap->setPhpName('oaiRepository');
		$tMap->setClassname('QubitOaiRepository');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 512);

		$tMap->addColumn('URI', 'uri', 'VARCHAR', false, 255);

		$tMap->addColumn('ADMIN_EMAIL', 'adminEmail', 'VARCHAR', false, 255);

		$tMap->addColumn('EARLIEST_TIMESTAMP', 'earliestTimestamp', 'TIMESTAMP', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 