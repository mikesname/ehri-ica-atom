<?php



class PhysicalObjectI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PhysicalObjectI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPhysicalObjectI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPhysicalObjectI18n::TABLE_NAME);
		$tMap->setPhpName('physicalObjectI18n');
		$tMap->setClassname('QubitPhysicalObjectI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('DESCRIPTION', 'description', 'LONGVARCHAR', false, null);

		$tMap->addColumn('LOCATION', 'location', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_physical_object', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

	} 
} 