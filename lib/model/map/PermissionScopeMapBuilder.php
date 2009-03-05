<?php



class PermissionScopeMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PermissionScopeMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPermissionScope::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPermissionScope::TABLE_NAME);
		$tMap->setPhpName('permissionScope');
		$tMap->setClassname('QubitPermissionScope');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('PARAMETERS', 'parameters', 'VARCHAR', false, 255);

		$tMap->addForeignKey('PERMISSION_ID', 'permissionId', 'INTEGER', 'q_permission', 'ID', true, null);

		$tMap->addForeignKey('ROLE_ID', 'roleId', 'INTEGER', 'q_role', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'userId', 'INTEGER', 'q_user', 'ID', false, null);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 