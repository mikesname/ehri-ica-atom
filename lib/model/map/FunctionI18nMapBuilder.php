<?php



class FunctionI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.FunctionI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_function_i18n');
		$tMap->setPhpName('FunctionI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CLASSIFICATION', 'Classification', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DOMAIN', 'Domain', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DATES', 'Dates', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('HISTORY', 'History', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LEGISLATION', 'Legislation', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('GENERAL_CONTEXT', 'GeneralContext', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INSTITUTION_RESPONSIBLE_IDENTIFIER', 'InstitutionResponsibleIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RULES', 'Rules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SOURCES', 'Sources', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('REVISION_HISTORY', 'RevisionHistory', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_function', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 