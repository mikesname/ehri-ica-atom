<?php



class RepositoryI18nMapBuilder implements MapBuilder {

	
	const CLASS_NAME = 'lib.model.map.RepositoryI18nMapBuilder';

	
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
		$this->dbMap = Propel::getDatabaseMap(QubitRepositoryI18n::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(QubitRepositoryI18n::TABLE_NAME);
		$tMap->setPhpName('repositoryI18n');
		$tMap->setClassname('QubitRepositoryI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('GEOCULTURAL_CONTEXT', 'geoculturalContext', 'LONGVARCHAR', false, null);

		$tMap->addColumn('COLLECTING_POLICIES', 'collectingPolicies', 'LONGVARCHAR', false, null);

		$tMap->addColumn('BUILDINGS', 'buildings', 'LONGVARCHAR', false, null);

		$tMap->addColumn('HOLDINGS', 'holdings', 'LONGVARCHAR', false, null);

		$tMap->addColumn('FINDING_AIDS', 'findingAids', 'LONGVARCHAR', false, null);

		$tMap->addColumn('OPENING_TIMES', 'openingTimes', 'LONGVARCHAR', false, null);

		$tMap->addColumn('ACCESS_CONDITIONS', 'accessConditions', 'LONGVARCHAR', false, null);

		$tMap->addColumn('DISABLED_ACCESS', 'disabledAccess', 'LONGVARCHAR', false, null);

		$tMap->addColumn('RESEARCH_SERVICES', 'researchServices', 'LONGVARCHAR', false, null);

		$tMap->addColumn('REPRODUCTION_SERVICES', 'reproductionServices', 'LONGVARCHAR', false, null);

		$tMap->addColumn('PUBLIC_FACILITIES', 'publicFacilities', 'LONGVARCHAR', false, null);

		$tMap->addColumn('DESC_INSTITUTION_IDENTIFIER', 'descInstitutionIdentifier', 'VARCHAR', false, 255);

		$tMap->addColumn('DESC_RULES', 'descRules', 'LONGVARCHAR', false, null);

		$tMap->addColumn('DESC_SOURCES', 'descSources', 'LONGVARCHAR', false, null);

		$tMap->addColumn('DESC_REVISION_HISTORY', 'descRevisionHistory', 'LONGVARCHAR', false, null);

		$tMap->addForeignPrimaryKey('ID', 'id', 'INTEGER' , 'q_repository', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'culture', 'VARCHAR', true, 7);

		$tMap->addColumn('SERIAL_NUMBER', 'serialNumber', 'INTEGER', true, null);

	} 
} 