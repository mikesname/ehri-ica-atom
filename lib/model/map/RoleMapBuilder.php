<?php



class RoleMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RoleMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRole::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRole::TABLE_NAME);
		$tMap->setPhpName('role');
		$tMap->setClassname('QubitRole');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 