<?php



class TermI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TermI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_term_i18n');
		$tMap->setPhpName('TermI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SCOPE_NOTE', 'ScopeNote', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CODE_ALPHA', 'CodeAlpha', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('CODE_ALPHA2', 'CodeAlpha2', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SOURCE', 'Source', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_term', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 