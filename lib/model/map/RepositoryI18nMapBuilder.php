<?php



class RepositoryI18nMapBuilder {

	
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
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('q_repository_i18n');
		$tMap->setPhpName('RepositoryI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('OFFICERS_IN_CHARGE', 'OfficersInCharge', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('GEOCULTURAL_CONTEXT', 'GeoculturalContext', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('COLLECTING_POLICIES', 'CollectingPolicies', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('BUILDINGS', 'Buildings', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('HOLDINGS', 'Holdings', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FINDING_AIDS', 'FindingAids', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('OPENING_TIMES', 'OpeningTimes', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ACCESS_CONDITIONS', 'AccessConditions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DISABLED_ACCESS', 'DisabledAccess', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('TRANSPORT', 'Transport', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RESEARCH_SERVICES', 'ResearchServices', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('REPRODUCTION_SERVICES', 'ReproductionServices', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PUBLIC_FACILITIES', 'PublicFacilities', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DESC_INSTITUTION_IDENTIFIER', 'DescInstitutionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESC_RULES', 'DescRules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DESC_SOURCES', 'DescSources', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('DESC_REVISION_HISTORY', 'DescRevisionHistory', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_repository', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 