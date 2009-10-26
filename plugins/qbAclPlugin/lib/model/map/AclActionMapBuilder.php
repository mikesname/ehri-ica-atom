<?php



class AclActionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'plugins.qbAclPlugin.lib.model.map.AclActionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitAclAction::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitAclAction::TABLE_NAME);
		$tMap->setPhpName('aclAction');
		$tMap->setClassname('QubitAclAction');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 