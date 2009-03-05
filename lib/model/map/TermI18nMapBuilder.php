<?php



class TermI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TermI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitTermI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitTermI18n::TABLE_NAME);
		$tMap->setPhpName('termI18n');
		$tMap->setClassname('QubitTermI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_term', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

	} 
} 