<?php



class TaxonomyI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TaxonomyI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitTaxonomyI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitTaxonomyI18n::TABLE_NAME);
		$tMap->setPhpName('taxonomyI18n');
		$tMap->setClassname('QubitTaxonomyI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('NOTE', 'note', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_taxonomy', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 