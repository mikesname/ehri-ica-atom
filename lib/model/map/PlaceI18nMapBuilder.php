<?php



class PlaceI18nMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitPlaceI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitPlaceI18n::TABLE_NAME);
		$tMap->setPhpName('placeI18n');
		$tMap->setClassname('QubitPlaceI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('STREET_ADDRESS', 'streetAddress', 'LONGVARCHAR', false, null);

		$tMap->addColumn('CITY', 'city', 'VARCHAR', false, 255);

		$tMap->addColumn('REGION', 'region', 'VARCHAR', false, 255);

		$tMap->addColumn('POSTAL_CODE', 'postalCode', 'VARCHAR', false, 255);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_place', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

	} 
} 