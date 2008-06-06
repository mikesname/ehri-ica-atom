<?php



class PlaceI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PlaceI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_place_i18n');
		$tMap->setPhpName('PlaceI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('STREET_ADDRESS', 'StreetAddress', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CITY', 'City', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('REGION', 'Region', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('POSTAL_CODE', 'PostalCode', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_place', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 