<?php



class FunctionDescriptionMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FunctionDescriptionMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('function_description');
		$tMap->setPhpName('FunctionDescription');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('TERM_ID', 'TermId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('FUNCTION_DESCRIPTION_TYPE_ID', 'FunctionDescriptionTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('CLASSIFICATION', 'Classification', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DOMAIN', 'Domain', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DATES', 'Dates', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('HISTORY', 'History', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LEGISLATION', 'Legislation', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('GENERAL_CONTEXT', 'GeneralContext', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'DescriptionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('INSTITUTION_IDENTIFIER', 'InstitutionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RULES', 'Rules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('LEVEL_ID', 'LevelId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('SOURCES', 'Sources', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 