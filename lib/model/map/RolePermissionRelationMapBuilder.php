<?php



class RolePermissionRelationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RolePermissionRelationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRolePermissionRelation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRolePermissionRelation::TABLE_NAME);
		$tMap->setPhpName('rolePermissionRelation');
		$tMap->setClassname('QubitRolePermissionRelation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('ROLE_ID', 'roleId', 'INTEGER', 'q_role', 'ID', true, null);

		$tMap->addForeignKey('PERMISSION_ID', 'permissionId', 'INTEGER', 'q_permission', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 