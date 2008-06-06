<?php



class RepositoryMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RepositoryMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_repository');
		$tMap->setPhpName('Repository');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_actor', 'ID', true, null);

		$tMap->addColumn('IDENTIFIER', 'Identifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('TYPE_ID', 'TypeId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESC_STATUS_ID', 'DescStatusId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESC_DETAIL_ID', 'DescDetailId', 'int', CreoleTypes::INTEGER, 'q_term', 'ID', false, null);

		$tMap->addColumn('DESC_IDENTIFIER', 'DescIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('SOURCE_CULTURE', 'SourceCulture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 