<?php



class SettingMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitSetting::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitSetting::TABLE_NAME);
		$tMap->setPhpName('setting');
		$tMap->setClassname('QubitSetting');

		$tMap->setUseIdGenerator(true);

		$tMap->addColumn('NAME', 'name', 'VARCHAR', false, 255);

		$tMap->addColumn('SCOPE', 'scope', 'VARCHAR', false, 255);

		$tMap->addColumn('EDITABLE', 'editable', 'BOOLEAN', false, null);

		$tMap->addColumn('DELETEABLE', 'deleteable', 'BOOLEAN', false, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

	} 
} 