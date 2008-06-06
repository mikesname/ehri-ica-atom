<?php



class SettingMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SettingMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_setting');
		$tMap->setPhpName('Setting');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SCOPE', 'Scope', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EDITABLE', 'Editable', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('DELETEABLE', 'Deleteable', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

	} 
} 