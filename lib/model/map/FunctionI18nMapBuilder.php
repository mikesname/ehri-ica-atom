<?php



class FunctionI18nMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitFunctionI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitFunctionI18n::TABLE_NAME);
		$tMap->setPhpName('functionI18n');
		$tMap->setClassname('QubitFunctionI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('CLASSIFICATION', 'classification', 'LONGVARCHAR', false, null);

		$tMap->addColumn('DOMAIN', 'domain', 'LONGVARCHAR', false, null);

		$tMap->addColumn('DATES', 'dates', 'LONGVARCHAR', false, null);

		$tMap->addColumn('HISTORY', 'history', 'LONGVARCHAR', false, null);

		$tMap->addColumn('LEGISLATION', 'legislation', 'LONGVARCHAR', false, null);

		$tMap->addColumn('GENERAL_CONTEXT', 'generalContext', 'LONGVARCHAR', false, null);

		$tMap->addColumn('INSTITUTION_RESPONSIBLE_IDENTIFIER', 'institutionResponsibleIdentifier', 'VARCHAR', false, 255);

		$tMap->addColumn('RULES', 'rules', 'LONGVARCHAR', false, null);

		$tMap->addColumn('SOURCES', 'sources', 'LONGVARCHAR', false, null);

		$tMap->addColumn('REVISION_HISTORY', 'revisionHistory', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_function', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 