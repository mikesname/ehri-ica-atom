<?php



class UserRoleRelationMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.UserRoleRelationMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitUserRoleRelation::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitUserRoleRelation::TABLE_NAME);
		$tMap->setPhpName('userRoleRelation');
		$tMap->setClassname('QubitUserRoleRelation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('USER_ID', 'userId', 'INTEGER', 'q_user', 'ID', true, null);

		$tMap->addForeignKey('ROLE_ID', 'roleId', 'INTEGER', 'q_role', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 