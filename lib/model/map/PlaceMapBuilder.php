<?php



class PlaceMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PlaceMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPlace::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPlace::TABLE_NAME);
		$tMap->setPhpName('place');
		$tMap->setClassname('QubitPlace');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_term', 'ID', true, null);

		$tMap->addForeignKey('COUNTRY_ID', 'countryId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('LONGTITUDE', 'longtitude', 'FLOAT', false, null);

		$tMap->addColumn('LATITUDE', 'latitude', 'FLOAT', false, null);

		$tMap->addColumn('ALTITUDE', 'altitude', 'FLOAT', false, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 