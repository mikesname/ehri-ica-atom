<?php



class MenuI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MenuI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitMenuI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitMenuI18n::TABLE_NAME);
		$tMap->setPhpName('menuI18n');
		$tMap->setClassname('QubitMenuI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('LABEL', 'label', 'VARCHAR', false, 255);

		$tMap->addColumn('DESCRIPTION', 'description', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_menu', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 