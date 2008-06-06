<?php



class PermissionScopeMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_permission_scope');
		$tMap->setPhpName('PermissionScope');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PARAMETERS', 'Parameters', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('PERMISSION_ID', 'PermissionId', 'int', CreoleTypes::INTEGER, 'q_permission', 'ID', true, null);

		$tMap->addForeignKey('ROLE_ID', 'RoleId', 'int', CreoleTypes::INTEGER, 'q_role', 'ID', false, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'q_user', 'ID', false, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 