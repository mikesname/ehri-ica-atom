<?php



class StaticPageI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.StaticPageI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitStaticPageI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitStaticPageI18n::TABLE_NAME);
		$tMap->setPhpName('staticPageI18n');
		$tMap->setClassname('QubitStaticPageI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('TITLE', 'title', 'VARCHAR', false, 255);

		$tMap->addColumn('CONTENT', 'content', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_static_page', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 