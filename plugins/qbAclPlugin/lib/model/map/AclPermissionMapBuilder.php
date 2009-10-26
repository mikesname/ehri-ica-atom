<?php



class AclPermissionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.qbAclPlugin.lib.model.map.AclPermissionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitAclPermission::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitAclPermission::TABLE_NAME);
		$tMap->setPhpName('aclPermission');
		$tMap->setClassname('QubitAclPermission');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addForeignKey('USER_ID', 'userId', 'INTEGER', 'q_user', 'ID', false, null);

		$tMap->addForeignKey('GROUP_ID', 'groupId', 'INTEGER', 'q_acl_group', 'ID', false, null);

		$tMap->addForeignKey('OBJECT_ID', 'objectId', 'INTEGER', 'q_object', 'ID', false, null);

		$tMap->addForeignKey('ACTION_ID', 'actionId', 'INTEGER', 'q_acl_action', 'ID', true, null);

		$tMap->addColumn('GRANT_DENY', 'grantDeny', 'INTEGER', true, null);

		$tMap->addColumn('CONDITIONAL', 'conditional', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CONSTANTS', 'constants', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 