<?php



class StaticPageMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('static_page');
		$tMap->setPhpName('StaticPage');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PERMALINK', 'Permalink', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PAGE_CONTENT', 'PageContent', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('STYLESHEET', 'Stylesheet', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 