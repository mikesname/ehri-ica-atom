<?php



class AclUserGroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.qbAclPlugin.lib.model.map.AclUserGroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitAclUserGroup::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitAclUserGroup::TABLE_NAME);
		$tMap->setPhpName('aclUserGroup');
		$tMap->setClassname('QubitAclUserGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'userId', 'INTEGER', 'q_user', 'ID', true, null);

		$tMap->addForeignKey('GROUP_ID', 'groupId', 'INTEGER', 'q_acl_group', 'ID', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 