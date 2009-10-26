<?php



class MenuMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MenuMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitMenu::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitMenu::TABLE_NAME);
		$tMap->setPhpName('menu');
		$tMap->setClassname('QubitMenu');

		$tMap->setUseIdGenerator(true);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_menu', 'ID', false, null);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('PATH', 'path', 'VARCHAR', false, 255);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', true, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 