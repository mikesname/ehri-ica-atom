<?php



class FunctionMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FunctionMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitFunction::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitFunction::TABLE_NAME);
		$tMap->setPhpName('function');
		$tMap->setClassname('QubitFunction');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_term', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_STATUS_ID', 'descriptionStatusId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_LEVEL_ID', 'descriptionLevelId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'descriptionIdentifier', 'VARCHAR', false, 255);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 