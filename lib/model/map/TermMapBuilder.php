<?php



class TermMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitTerm::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitTerm::TABLE_NAME);
		$tMap->setPhpName('term');
		$tMap->setClassname('QubitTerm');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_object', 'ID', true, null);

		$tMap->addForeignKey('TAXONOMY_ID', 'taxonomyId', 'INTEGER', 'q_taxonomy', 'ID', true, null);

		$tMap->addColumn('CODE', 'code', 'VARCHAR', false, 255);

		$tMap->addForeignKey('PARENT_ID', 'parentId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('LFT', 'lft', 'INTEGER', true, null);

		$tMap->addColumn('RGT', 'rgt', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('UPDATED_AT', 'updatedAt', 'TIMESTAMP', true, null);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 