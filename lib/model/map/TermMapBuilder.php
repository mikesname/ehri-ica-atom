<?php



class TermMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.TermMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_term');
		$tMap->setPhpName('Term');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TAXONOMY_ID', 'TaxonomyId', 'int', CreoleTypes::INTEGER, 'q_taxonomy', 'ID', true, null);

		$tMap->addColumn('CODE_NUMERIC', 'CodeNumeric', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addForeignKey('PARENT_ID', 'ParentId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('LFT', 'Lft', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RGT', 'Rgt', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 