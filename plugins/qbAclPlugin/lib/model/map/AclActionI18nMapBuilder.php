<?php



class AclActionI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.qbAclPlugin.lib.model.map.AclActionI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitAclActionI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitAclActionI18n::TABLE_NAME);
		$tMap->setPhpName('aclActionI18n');
		$tMap->setClassname('QubitAclActionI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', true, 255);

		$tMap->addColumn('DESCRIPTION', 'description', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_acl_action', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 