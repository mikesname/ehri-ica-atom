<?php



class SettingI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.SettingI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitSettingI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitSettingI18n::TABLE_NAME);
		$tMap->setPhpName('settingI18n');
		$tMap->setClassname('QubitSettingI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('VALUE', 'value', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_setting', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 