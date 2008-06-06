<?php



class PlaceMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_place');
		$tMap->setPhpName('Place');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_term', 'ID', true, null);

		$tMap->addForeignKey('COUNTRY_ID', 'CountryId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('LONGTITUDE', 'Longtitude', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('LATITUDE', 'Latitude', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('ALTITUDE', 'Altitude', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 