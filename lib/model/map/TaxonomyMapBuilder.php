<?php



class TaxonomyMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TaxonomyMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitTaxonomy::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitTaxonomy::TABLE_NAME);
		$tMap->setPhpName('taxonomy');
		$tMap->setClassname('QubitTaxonomy');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('USAGE', 'usage', 'VARCHAR', false, 255);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 