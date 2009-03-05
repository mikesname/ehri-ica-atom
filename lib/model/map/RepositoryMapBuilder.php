<?php



class RepositoryMapBuilder implements MapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRepository::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRepository::TABLE_NAME);
		$tMap->setPhpName('repository');
		$tMap->setClassname('QubitRepository');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_actor', 'ID', true, null);

		$tMap->addColumn('IDENTIFIER', 'identifier', 'VARCHAR', false, 255);

		$tMap->addForeignKey('TYPE_ID', 'typeId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESC_STATUS_ID', 'descStatusId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addForeignKey('DESC_DETAIL_ID', 'descDetailId', 'INTEGER', 'q_term', 'ID', false, null);

		$tMap->addColumn('DESC_IDENTIFIER', 'descIdentifier', 'VARCHAR', false, 255);

		$tMap->addColumn('SOURCE_CULTURE', 'sourceCulture', 'VARCHAR', true, 7);

	} 
} 