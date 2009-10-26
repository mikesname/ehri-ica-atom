<?php



class PropertyI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PropertyI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPropertyI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPropertyI18n::TABLE_NAME);
		$tMap->setPhpName('propertyI18n');
		$tMap->setClassname('QubitPropertyI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('VALUE', 'value', 'VARCHAR', false, 255);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_property', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 