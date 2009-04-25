<?php



class OaiHarvestMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.OaiHarvestMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitOaiHarvest::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitOaiHarvest::TABLE_NAME);
		$tMap->setPhpName('oaiHarvest');
		$tMap->setClassname('QubitOaiHarvest');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'id', 'INTEGER', true, null);

		$tMap->addForeignKey('OAI_REPOSITORY_ID', 'oaiRepositoryId', 'INTEGER', 'q_oai_repository', 'ID', true, null);

		$tMap->addColumn('START_TIMESTAMP', 'startTimestamp', 'TIMESTAMP', false, null);

		$tMap->addColumn('END_TIMESTAMP', 'endTimestamp', 'TIMESTAMP', false, null);

		$tMap->addColumn('LAST_HARVEST', 'lastHarvest', 'TIMESTAMP', false, null);

		$tMap->addColumn('LAST_HARVEST_ATTEMPT', 'lastHarvestAttempt', 'TIMESTAMP', false, null);

		$tMap->addColumn('METADATAPREFIX', 'metadataPrefix', 'VARCHAR', false, 255);

		$tMap->addColumn('SET', 'set', 'VARCHAR', false, 255);

		$tMap->addColumn('CREATED_AT', 'createdAt', 'TIMESTAMP', true, null);

	} 
} 