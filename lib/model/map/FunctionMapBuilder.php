<?php



class FunctionMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_function');
		$tMap->setPhpName('Function');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_term', 'ID', true, null);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_STATUS_ID', 'DescriptionStatusId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESCRIPTION_LEVEL_ID', 'DescriptionLevelId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'DescriptionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 