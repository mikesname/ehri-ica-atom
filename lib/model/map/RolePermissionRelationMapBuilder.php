<?php



class RolePermissionRelationMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_role_permission_relation');
		$tMap->setPhpName('RolePermissionRelation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('ROLE_ID', 'RoleId', 'int', CreoleTypes::INTEGER, 'q_role', 'ID', true, null);

		$tMap->addForeignKey('PERMISSION_ID', 'PermissionId', 'int', CreoleTypes::INTEGER, 'q_permission', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 