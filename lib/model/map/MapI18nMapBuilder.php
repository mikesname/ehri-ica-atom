<?php



class MapI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.MapI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitMapI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitMapI18n::TABLE_NAME);
		$tMap->setPhpName('mapI18n');
		$tMap->setClassname('QubitMapI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('TITLE', 'title', 'VARCHAR', false, 255);

		$tMap->addColumn('DESCRIPTION', 'description', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_map', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

	} 
} 