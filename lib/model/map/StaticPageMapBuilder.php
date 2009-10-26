<?php



class StaticPageMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.StaticPageMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitStaticPage::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitStaticPage::TABLE_NAME);
		$tMap->setPhpName('staticPage');
		$tMap->setClassname('QubitStaticPage');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addColumn('PERMALINK', 'permalink', 'VARCHAR', false, 255);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 