<?php



class InformationObjectI18nMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.InformationObjectI18nMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('q_information_object_i18n');
		$tMap->setPhpName('InformationObjectI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('ALTERNATE_TITLE', 'AlternateTitle', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('VERSION', 'Version', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EXTENT_AND_MEDIUM', 'ExtentAndMedium', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ARCHIVAL_HISTORY', 'ArchivalHistory', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ACQUISITION', 'Acquisition', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SCOPE_AND_CONTENT', 'ScopeAndContent', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('APPRAISAL', 'Appraisal', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ACCRUALS', 'Accruals', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ARRANGEMENT', 'Arrangement', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('ACCESS_CONDITIONS', 'AccessConditions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('REPRODUCTION_CONDITIONS', 'ReproductionConditions', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PHYSICAL_CHARACTERISTICS', 'PhysicalCharacteristics', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('FINDING_AIDS', 'FindingAids', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LOCATION_OF_ORIGINALS', 'LocationOfOriginals', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('LOCATION_OF_COPIES', 'LocationOfCopies', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('RELATED_UNITS_OF_DESCRIPTION', 'RelatedUnitsOfDescription', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('INSTITUTION_RESPONSIBLE_IDENTIFIER', 'InstitutionResponsibleIdentifier', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('RULES', 'Rules', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('SOURCES', 'Sources', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('REVISION_HISTORY', 'RevisionHistory', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'int' , CreoleTypes::INTEGER, 'q_information_object', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'string', CreoleTypes::VARCHAR, true, 7);

	} 
} 