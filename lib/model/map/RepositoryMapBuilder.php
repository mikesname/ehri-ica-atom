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

		$tMap = $this->dbMap->addTable('repository');
		$tMap->setPhpName('Repository');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('ACTOR_ID', 'ActorId', 'int', CreoleTypes::INTEGER, 'actor', 'ID', false, null);

		$tMap->addColumn('IDENTIFIER', 'Identifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('REPOSITORY_TYPE_ID', 'RepositoryTypeId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

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

		$tMap->addColumn('DESCRIPTION_IDENTIFIER', 'DescriptionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('INSTITUTION_IDENTIFIER', 'InstitutionIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RULES', 'Rules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignKey('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addForeignKey('LEVEL_OF_DETAIL_ID', 'LevelOfDetailId', 'int', CreoleTypes::INTEGER, 'term', 'ID', false, null);

		$tMap->addColumn('SOURCES', 'Sources', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 