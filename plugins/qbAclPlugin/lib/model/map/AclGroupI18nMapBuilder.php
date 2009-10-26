<?php



class AclGroupI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.qbAclPlugin.lib.model.map.AclGroupI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitAclGroupI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitAclGroupI18n::TABLE_NAME);
		$tMap->setPhpName('aclGroupI18n');
		$tMap->setClassname('QubitAclGroupI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', true, 255);

		$tMap->addColumn('DESCRIPTION', 'description', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_acl_group', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 