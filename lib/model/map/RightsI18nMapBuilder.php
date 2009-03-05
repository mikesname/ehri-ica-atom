<?php



class RightsI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RightsI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRightsI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRightsI18n::TABLE_NAME);
		$tMap->setPhpName('rightsI18n');
		$tMap->setClassname('QubitRightsI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('DESCRIPTION', 'description', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_rights', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

	} 
} 