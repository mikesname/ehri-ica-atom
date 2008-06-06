<?php



class UserRoleRelationMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_user_role_relation');
		$tMap->setPhpName('UserRoleRelation');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'q_user', 'ID', true, null);

		$tMap->addForeignKey('ROLE_ID', 'RoleId', 'int', CreoleTypes::INTEGER, 'q_role', 'ID', true, null);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 