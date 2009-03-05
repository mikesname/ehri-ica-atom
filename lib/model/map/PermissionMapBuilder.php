<?php



class PermissionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PermissionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPermission::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPermission::TABLE_NAME);
		$tMap->setPhpName('permission');
		$tMap->setClassname('QubitPermission');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('MODULE', 'module', 'VARCHAR', false, 255);

		$tMap->addColumn('ACTION', 'action', 'VARCHAR', false, 255);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 