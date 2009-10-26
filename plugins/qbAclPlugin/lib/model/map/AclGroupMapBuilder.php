<?php



class AclGroupMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.qbAclPlugin.lib.model.map.AclGroupMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitAclGroup::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitAclGroup::TABLE_NAME);
		$tMap->setPhpName('aclGroup');
		$tMap->setClassname('QubitAclGroup');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_acl_group', 'ID', false, null);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', true, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 